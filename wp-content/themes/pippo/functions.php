<?php
/*
 * chiude sito in modalità errore 503 con messaggio per aggiornamento
define('PLOTTYBOT_MAINTENANCE', false);

add_action('template_redirect', 'plottybot_maintenance_mode');
function plottybot_maintenance_mode() {
    if (current_user_can('administrator') || is_admin() || get_current_user_id() === 114) {
        return;
    }

    if (current_user_can('administrator') || is_admin()) {
        return;
    }

    wp_die(
        '<h1>PlottyBot è in manutenzione :-)</h1><p>Stiamo aggiornando il sistema, si prega di ritornare più tardi.</p>',
        'Sito in manutenzione',
        array('response' => 503)
    );
}
*/


/**
 * API REST personalizzata per gestire utenti via plugin esterno
 * - Registrazione (email + password)
 * - Login (email + password)
 * - Validazione token
 */

add_action('rest_api_init', function () {
    // Endpoint registrazione
    register_rest_route('custom-api/v1', '/register', array(
        'methods' => 'POST',
        'callback' => 'custom_api_register_user',
        'permission_callback' => '__return_true',
    ));

    // Endpoint login
    register_rest_route('custom-api/v1', '/login', array(
        'methods' => 'POST',
        'callback' => 'custom_api_login_user',
        'permission_callback' => '__return_true',
    ));

    // Endpoint validazione token
    register_rest_route('custom-api/v1', '/validate', array(
        'methods' => 'POST',
        'callback' => 'custom_api_validate_user',
        'permission_callback' => '__return_true',
    ));
});


/**
 * Registrazione utente
 * Input: email, password
 * Output: user_id, username, email, token
 */
function custom_api_register_user($request) {
    $email    = sanitize_email($request['email']);
    $password = $request['password'];

    if (empty($email) || empty($password)) {
        return new WP_Error('missing_fields', 'Email e password sono obbligatorie.', array('status' => 400));
    }

    if (email_exists($email)) {
        return new WP_Error('email_exists', 'Questa email è già registrata.', array('status' => 400));
    }

    // Genero username automatico a partire dall'email
    $username = sanitize_user(current(explode('@', $email)), true);
    $base_username = $username;
    $i = 1;
    while (username_exists($username)) {
        $username = $base_username . $i;
        $i++;
    }

    $user_id = wp_create_user($username, $password, $email);

    if (is_wp_error($user_id)) {
        return $user_id;
    }

    // Genero subito un token e salvo
    $token = bin2hex(random_bytes(32));
    update_user_meta($user_id, 'api_token', $token);

    return array(
        'success'  => true,
        'user_id'  => $user_id,
        'username' => $username,
        'email'    => $email,
        'token'    => $token
    );
    
    // Imposta cookie cross-domain per tutti i sottodomini di plottybot.com
    setcookie('plotty_token', $token, time() + 3600 * 24 * 7, '/', '.insights.plottybot.com', true, true);
}


/**
 * Login utente
 * Input: email, password
 * Output: user_id, username, email, token
 */
function custom_api_login_user($request) {
    $email    = sanitize_email($request['email']);
    $password = $request['password'];

    // Trovo utente da email
    $user = get_user_by('email', $email);
    if (!$user) {
        return new WP_Error('invalid_email', 'Email non trovata.', array('status' => 401));
    }

    // Creo credenziali con user_login
    $creds = array(
        'user_login'    => $user->user_login,
        'user_password' => $password,
        'remember'      => true,
    );

    $signon = wp_signon($creds, false);

    if (is_wp_error($signon)) {
        return new WP_Error('invalid_login', 'Credenziali non valide.', array('status' => 401));
    }

    // Genero nuovo token (invalidando il precedente)
    $token = bin2hex(random_bytes(32));
    update_user_meta($signon->ID, 'api_token', $token);

    return array(
        'success'  => true,
        'user_id'  => $signon->ID,
        'username' => $signon->user_login,
        'email'    => $signon->user_email,
        'token'    => $token
    );
    
    // Imposta cookie cross-domain per tutti i sottodomini di plottybot.com
    setcookie('plotty_token', $token, time() + 3600 * 24 * 7, '/', '.insights.plottybot.com', true, true);

}


/**
 * Validazione token
 * Input: token
 * Output: dati utente se valido
 */
function custom_api_validate_user($request) {
    $token = sanitize_text_field($request['token']);

    if (empty($token)) {
        return new WP_Error('missing_token', 'Token mancante.', array('status' => 400));
    }

    $users = get_users(array(
        'meta_key'   => 'api_token',
        'meta_value' => $token,
        'number'     => 1,
        'count_total'=> false
    ));

    if (empty($users)) {
        return new WP_Error('invalid_token', 'Token non valido.', array('status' => 401));
    }

    $user = $users[0];
    return array(
        'success'  => true,
        'user_id'  => $user->ID,
        'username' => $user->user_login,
        'email'    => $user->user_email,
    );
}

// Cancella il cookie di autenticazione al logout
add_action('wp_logout', function() {
    setcookie('plotty_token', '', time() - 3600, '/', '.insights.plottybot.com', true, true);
});



// personalizza mittente email
add_filter('wp_mail_from', function($email) {
    return 'info@plottybot.com';
});
add_filter('wp_mail_from_name', function($name) {
    return 'PlottyBot';
});

// Blocca login a chi non ha confermato l'email
add_filter('authenticate', function($user, $username, $password) {
	global $ita, $eng;
	
    if (is_wp_error($user)) {
        return $user;
    }

    $confirmed = get_user_meta($user->ID, 'email_confirmed', true);

    // Se è impostato e diverso da 1, blocca il login
    if ($confirmed !== '' && $confirmed != 1) {
		if ($ita) {
			$confirmation_error = "Per favore conferma la tua email prima di accedere.";
		} else {
			$confirmation_error = "";
		}
        return new WP_Error('email_not_confirmed', 'Please confirm your email before logging in.');
    }

    return $user;
}, 30, 3);


// Hook per cambiare la lingua di WooCommerce basata sulla lingua utente
add_filter( 'locale', 'change_woocommerce_language_based_on_global_variable' );

function change_woocommerce_language_based_on_global_variable( $locale ) {
    // Verifica se l'utente è loggato
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $user_language = get_user_meta($user_id, 'user_language', true);

        // Se la lingua dell'utente esiste e il valore è una stringa
        if (!empty($user_language) && is_string($user_language)) {
            return $user_language; // Imposta la lingua dell'utente
        }
    }

    // Se non è presente una lingua utente, ritorna la lingua predefinita
    return $locale;
}

// Funzione per impostare la lingua corrente dell'utente al momento della registrazione
add_action('user_register', 'save_user_language_on_registration');

function save_user_language_on_registration($user_id) {
    // Recupera la lingua corrente (del browser o altre impostazioni)
    $current_locale = get_locale();
    
    // Salva la lingua come meta dato dell'utente
    update_user_meta($user_id, 'user_language', $current_locale);
}

// Hook per impostare la valuta di woocommerce secondo quella dell'utente
add_filter('woocommerce_currency', function($currency) {
	if (is_user_logged_in()) {
		$user_id = get_current_user_id();
		$user_currency = get_user_meta($user_id, 'user_currency', true);

		if (!empty($user_currency)) {
			return strtoupper($user_currency); // Esempio: 'USD' o 'EUR'
		} else {
			return 'EUR'; // Fallback per utenti già registrati senza meta
		}
	}

	// Fallback per utenti non loggati
	$cached_currency = wp_cache_get('user_currency', 'custom');
	if (!empty($cached_currency)) {
		return strtoupper($cached_currency);
	}

	return strtoupper($currency); // Valuta di default WooCommerce
});

// Keep only last cart item
add_action( 'woocommerce_before_calculate_totals', 'replace_cart_item_with_same_product_id', 30, 1 );
function replace_cart_item_with_same_product_id( $cart ) {
    $products_seen = array();

    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
        $product_id = $cart_item['product_id'];

        // Se abbiamo già visto questo prodotto ID, rimuoviamo l'elemento precedente dal carrello
        if ( isset( $products_seen[$product_id] ) ) {
            $cart->remove_cart_item( $products_seen[$product_id] );
        }

        // Memorizza la chiave del prodotto attuale come l'ultimo prodotto visto con questo ID
        $products_seen[$product_id] = $cart_item_key;
    }
}

/* non serve per ora
// Svuota il carrello WooCommerce se l'utente visita una pagina diversa dal checkout
add_action( 'template_redirect', 'svuota_carrello_fuori_checkout' );

function svuota_carrello_fuori_checkout() {
    // Controlla che WooCommerce sia attivo e che il carrello esista
    if ( function_exists( 'is_checkout' ) && function_exists( 'WC' ) && WC()->cart ) {
        
        // Se NON siamo nella pagina di checkout
        if ( ! is_checkout() ) {
            WC()->cart->empty_cart();
        }
    }
}
*/

add_action( 'woocommerce_before_calculate_totals', 'woocommerce_custom_price_to_cart_item', 99 );
function woocommerce_custom_price_to_cart_item( $cart_object ) {  
	if( !WC()->session->__isset( "reload_checkout" )) {
		foreach ( $cart_object->cart_contents as $key => $value ) {
			if( isset( $value["custom_price"] ) ) {
				$value['data']->set_price($value["custom_price"]);
			}

			if( isset( $value["custom_name"] ) ) {
				$value['data']->set_name($value["custom_name"]);
			}
		}  
	} 
}

// QUANDO SI COMPLETA L'ACQUISTO, SPOSTA IL LIBRO DA DRAFT A PENDING_BOOK + check per free trial
add_action('woocommerce_order_status_completed', 'ordine_completato');
function ordine_completato($order_id) {
    global $wpdb;
	global $ita, $eng;

	$order = wc_get_order($order_id);
	if ($order) {
		$user_id = $order->get_user_id();
		$items = $order->get_items();
		foreach ($items as $item_id => $item) {
			$umeta = $item->get_meta('id');
			if ($umeta) {
				$umeta_id = $umeta;
			}
		}

		if ($umeta_id !== null) {
			// Costruisci la query SQL con prepare
			$query = $wpdb->prepare("
    SELECT umeta_id, format
    FROM books
    WHERE status = %s 
    AND user_id = %d 
    AND umeta_id = %d 
    LIMIT 1
", 'draft', $user_id, $umeta_id);

			// Esegui la query
			$row = $wpdb->get_row($query, ARRAY_A);

			if ($row) {
				// Aggiorna il campo meta_key
                $update_query = $wpdb->prepare("
                    UPDATE books
                    SET status = %s
                    WHERE umeta_id = %d AND status = %s
                ", 'pending_book', $row['umeta_id'], 'draft');

				// Esegui l'aggiornamento
				$result = $wpdb->query($update_query);
				
				// check se libro gratis
				$format = $row['format'] ?? null;
				$total_paid = floatval($order->get_total());

                // Conto libri gratis
				if (abs($total_paid) < 0.01 && $format === "express") {
					$free_books = get_user_meta($user_id, 'free_books', true);
					$free_books = is_numeric($free_books) ? intval($free_books) : 0;

					$free_books++;
					update_user_meta($user_id, 'free_books', $free_books);
				}
                
			}
		}
	}
}

// Rimuovi i link dalla pagina di checkout (link al prodotto)
function remove_links_from_order_item_name($item_name, $item) {
    if (is_checkout()) {
        // Rimuovi i link dal nome dell'elemento dell'ordine
        return strip_tags($item_name);
    }
    return $item_name;
}

add_filter('woocommerce_order_item_name', 'remove_links_from_order_item_name', 10, 2);


// appendi data ultima modifica al css
function my_theme_enqueue_styles() {
    $version = filemtime(get_template_directory() . '/style.css'); // Ottieni la data di modifica del file
    wp_enqueue_style('my-theme-style', get_template_directory_uri() . '/style.css?ver=' . $version, array(), $version);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// carica sempre ultima versione style.css
function pippo_enqueue_styles() {
    // Percorso relativo al file CSS
    $css_file = get_template_directory() . '/style.css';
    // Ottieni la data di modifica del file
    $version = filemtime($css_file);
    
    // Carica il file CSS con la versione basata sulla data di modifica
    wp_enqueue_style( 'pippo-style', get_template_directory_uri() . '/style.css?ver=' . $version, array(), $version );
}
add_action( 'wp_enqueue_scripts', 'pippo_enqueue_styles' );

// integra testo di conferma pagamento e ordine se si compra un libro
add_filter( 'woocommerce_thankyou_order_received_text', 'personalizza_testo_conferma_ordine', 10, 2 );

function personalizza_testo_conferma_ordine( $thank_you_text, $order ) {
    // Controlla se l'ordine contiene l'articolo con ID 39
    $item_id_target = 39;
    $found = false;

    foreach ( $order->get_items() as $item ) {
        if ( $item->get_product_id() == $item_id_target ) {
            $found = true;
            break;
        }
    }

    // Ottiene l'ID utente associato all'ordine
    $user_id = $order->get_user_id();

    // Recupera l'email dell'utente dal suo profilo
    if ( $user_id ) {
        $user_info = get_userdata( $user_id );
		$user_email = $user_info->user_email;
		$user_language = get_user_meta($user_id, 'user_language', true);
		$eng = $user_language == 'en_US';
		$ita = $user_language == 'it_IT';
    } else {
        // Se non c'è un utente collegato (ad es. per un ospite)
        $user_email = $order->get_billing_email();
		$eng = 'en_US';
    }

    // Modifica il testo solo se l'articolo con ID 39 è presente nell'ordine
	if ( $found ) {
		if ($ita) {
			$thank_you_text = '<div style="margin-bottom: 36px; background: rgba(0, 0, 0, 0.07); padding: 8px;">Grazie. Il tuo ordine è stato ricevuto.
		<br><strong>Nel momento in cui leggi questo messaggio, io ho già iniziato a scrivere il tuo libro ed entro qualche ora esso sarà completato e formattato.</strong>.<br>Appena pronto, ti avviserò con una email all\'indirizzo ' . $user_email . ' e potrai leggerlo e/o scaricarlo.</div>';
		} else {
			$thank_you_text = '<div style="margin-bottom: 36px; background: rgba(0, 0, 0, 0.07); padding: 8px;">Thank you. Your order has been received.<br><strong>By the time you read this, I\'ve already started writing your book and it will be finished and formatted within a few hours.</strong>.<br>As soon as it\'s ready, I\'ll notify you by email at ' . $user_email . ' and you\'ll be able to read and/or download it.</div>';
		}
	}

    return $thank_you_text;
}

// rimuovi link dagli articoli acquistati (pag. account)
add_filter( 'woocommerce_order_item_name', 'remove_order_item_link_in_view_order', 10, 2 );

function remove_order_item_link_in_view_order( $product_name, $item ) {
    // Controlla se siamo nella pagina di visualizzazione dell'ordine
    if ( is_account_page() && is_wc_endpoint_url( 'view-order' ) ) {
        // Rimuovi il link dal titolo del prodotto
        $product_name = $item->get_name(); // Ottieni solo il nome del prodotto senza il link
    }

    return $product_name;
}
// forza gli url in inglese
add_action('template_redirect', 'redirect_fatturazione_to_billing');

function redirect_fatturazione_to_billing() {
    // Controlla se l'utente si trova su /fatturazione/
    if (strpos($_SERVER['REQUEST_URI'], '/account/edit-address/fatturazione/') !== false) {
        // Effettua un redirect 301 a /billing/
        wp_redirect(home_url('/account/edit-address/billing/'), 301);
        exit;
    }
}

// FATTURAZIONE
// Aggiungi il campo VAT al modulo di modifica dell'account
add_action('woocommerce_edit_account_form', 'add_vat_field_to_account_form');

function add_vat_field_to_account_form() {
	$user_id = get_current_user_id();
	$vat_number = get_user_meta($user_id, 'vat', true);
?>
<p class="form-row form-row-wide">
	<label for="vat"><?php _e('VAT Number', 'woocommerce'); ?></label>
<span id="vat">
	<?php echo esc_attr($vat_number); ?>
</span>
</p>
<?php
}
/*
function add_vat_field_to_account_form() {
    $user_id = get_current_user_id();
    $vat_number = get_user_meta($user_id, 'vat', true);
    ?>
    <p class="form-row form-row-wide">
        <label for="vat"><?php _e('VAT Number', 'woocommerce'); ?></label>
        <input type="text" name="vat" id="vat" value="<?php echo esc_attr($vat_number); ?>" class="input-text" />
    </p>
    <?php
}
*/

/* Salva il campo VAT quando l'utente aggiorna i dettagli dell'account
add_action('woocommerce_save_account_details', 'save_vat_field_from_account_form', 10, 1);

function save_vat_field_from_account_form($user_id) {
    if (isset($_POST['vat'])) {
        $vat_number = sanitize_text_field($_POST['vat']);
        update_user_meta($user_id, 'vat', $vat_number);
    }
}
*/

// Controlla ordine completato per 1. FATTURAZIONE e 2.GUADAGNI AFFILIATO
add_action('woocommerce_order_status_completed', 'update_affiliate_and_send_billing_email_on_coupon_use', 10, 1);

function update_affiliate_and_send_billing_email_on_coupon_use($order_id) {
	global $wpdb;
    // Ottieni i dettagli dell'ordine
    $order = wc_get_order($order_id);
	
	$user_id = $order->get_user_id();
	
	$date_paid = $order->get_date_paid();
	if ($date_paid) {
		$date_paid->setTimezone(new DateTimeZone('Europe/Rome'));
		$formatted_date_paid = $date_paid->format('Y-m-d H:i:s'); // formato compatibile con DATETIME MySQL
	} else {
		$formatted_date_paid = "N/A"; // In caso non ci sia una data di pagamento
	}
	
	$user_currency = get_user_meta($user_id, 'user_currency', true);
	$to = strtoupper($user_currency);
	
	$total_paid = floatval($order->get_total());
	$usd_report = "";
	$gbp_report = "";
	
	if ($user_currency == "usd") {
		$usd_report = $total_paid;
		$url = "https://api.frankfurter.app/latest?amount=1&from=EUR&to=" . $to;
		$response = file_get_contents($url);
		$data = json_decode($response, true);
		if ($data && isset($data['rates'][$to])) {
			$currency_change = $data['rates'][$to];
		} else {
			$currency_change = get_user_meta(1, 'eur_to_usd', true);
		}
		$eur_report = $total_paid / $currency_change;
		
	} elseif ($user_currency == "gbp") {
		$gbp_report = $total_paid;
		$url = "https://api.frankfurter.app/latest?amount=1&from=EUR&to=" . strtoupper($user_currency);
		$response = file_get_contents($url);
		$data = json_decode($response, true);
		if ($data && isset($data['rates'][$to])) {
			$currency_change = $data['rates'][$to];
		} else {
			$currency_change = get_user_meta(1, 'eur_to_gbp', true);
		}
		$eur_report = $total_paid / $currency_change;
		
	} else {
		$currency_change = 1;
		$eur_report = $total_paid;
	}
	    
    // 1. Verifica se l'utente ha il meta key "vat"
    $user_vat = get_user_meta($user_id, 'vat', true);

	if ($user_vat) { // fattura
		$user_vatcode = get_user_meta($user_id, 'vatcode', true);
		$user_vat_amount = intval(get_user_meta($user_id, 'vat-amount', true));

		// Ottieni i dettagli di fatturazione dall'ordine
		$billing_first_name = $order->get_billing_first_name();
		$billing_last_name = $order->get_billing_last_name();
		$billing_company = $order->get_billing_company();
		$billing_address_1 = $order->get_billing_address_1();
        $billing_address_2 = $order->get_billing_address_2();
        $billing_city = $order->get_billing_city();
        $billing_postcode = $order->get_billing_postcode();
        $billing_country = $order->get_billing_country();
        $billing_state = $order->get_billing_state();
        $billing_phone = $order->get_billing_phone();
        $billing_email = $order->get_billing_email();
		
		$net_paid = $total_paid / (1 + ($user_vat_amount / 100));
		
		if ($user_currency && $user_currency !== "eur") {
			$currency_billing = "- - - - - -<br>";
			$currency_billing .= "ATTENZIONE: PAGATO IN " . strtoupper($user_currency) . "<br>";
			$currency_billing .= "Totale netto pagato: " . $user_currency . " " . number_format($net_paid, 2) . "<br>";
			$currency_billing .= "Imposte: " . $user_vat_amount . "%<br>";
			$currency_billing .= "Totale lordo pagato: " . $user_currency . " " . number_format($total_paid, 2) . "<br>";
			
		} else {
			$currency_billing = "";
		}
		
		// converto in euro per dopo
		$net_paid = $net_paid / $currency_change;
		$total_paid = $total_paid / $currency_change;
		$eur_report = $total_paid;

        // Crea una stringa con tutti i dettagli di fatturazione e VAT
        $billing = "Dettagli di fatturazione:<br>";
        $billing .= "Azienda: $billing_company<br>";
		$billing .= "VAT/IVA: $user_vat<br>";
		if ($user_vatcode) {
			$billing .= "Cod. Univoco: $user_vatcode<br>";
		}
		$billing .= "Nome: $billing_first_name $billing_last_name<br>";
        $billing .= "Indirizzo: $billing_address_1 $billing_address_2<br>";
        $billing .= "Città: $billing_city, $billing_state, $billing_postcode<br>";
        $billing .= "Paese: $billing_country<br>";
        $billing .= "Telefono: $billing_phone<br>";
		$billing .= "Email: $billing_email<br>";
		$billing .= $currency_billing;
		$billing .= "- - - - - -<br>";
		$billing .= "Totale netto pagato: €" . number_format($net_paid, 2) . "<br>";
		$billing .= "Imposte: " . $user_vat_amount . "%<br>";
		$billing .= "Totale lordo pagato: €" . number_format($total_paid, 2) . "<br>";
		$billing .= "Data del pagamento: $formatted_date_paid<br>";

        // Imposta l'header dell'email
        $from = "Plotty <info@plottybot.com>";
        $headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: $from";

		// Preparare la query di inserimento
		$table_name = 'fatture';
		$data = array(
			'user_id' => $user_id,
			'order_id' => $order_id,
			'date' => $formatted_date_paid,
			'eur' => $eur_report,
			'usd' => $usd_report,
			'gbp' => $gbp_report,
			'company' => $billing_company,
			'vat' => $user_vat,
			'vatcode' => $user_vatcode,
			'vat_amount' => $user_vat_amount,
			'first_name' => $billing_first_name,
			'last_name' => $billing_last_name,
			'address_1' => $billing_address_1,
			'address_2' => $billing_address_2,
			'city' => $billing_city,
			'state' => $billing_state,
			'postcode' => $billing_postcode,
			'country' => $billing_country,
			'phone' => $billing_phone,
			'email' => $billing_email,
			'check' => 0
		);

		// Inserisci nella tabella
		$inserted = $wpdb->insert($table_name, $data);

        // Invia la mail
		mail("albertomoneti@gmail.com, accounts@plottybot.com", "Fattura commerciale", $billing, $headers);
		
	} else { // corrispettivi
		// Preparare la query di inserimento
		$table_name = 'corrispettivi';
		$data = array(
			'user_id' => $user_id,
			'order_id' => $order_id,
			'date' => $formatted_date_paid,
			'eur' => $eur_report,
			'usd' => $usd_report,
			'gbp' => $gbp_report
		);

		// Inserisci nella tabella
		$inserted = $wpdb->insert($table_name, $data);
	}

	// 2. Verifica se i coupon affiliati
	$used_coupons = $order->get_coupon_codes();
	if (in_array('aleaccademia', $used_coupons)) {
        // Ottieni l'utente affiliato (in questo caso con user_id = 1)
        $affiliate_user_id = 35; // arnao
        // Ottieni il meta_value dell'affiliato
        $affiliate_commission = get_user_meta($affiliate_user_id, 'affiliate', true);
        // Se non esiste, impostalo a 0
        if (!$affiliate_commission) {
            $affiliate_commission = 0;
        }

		// Calcola il 10% del totale
		$commission_to_add = $total_paid * 0.10;
		// Aggiungi la commissione al valore corrente e arrotonda a 2 cifre decimali
		$new_commission_value = round($affiliate_commission + $commission_to_add, 2);
		// Aggiorna il valore del meta "affiliate" per user_id = 1
		update_user_meta($affiliate_user_id, 'affiliate', $new_commission_value);
        
    } elseif (in_array('titans5', $used_coupons)) {
        // Ottieni l'utente affiliato (in questo caso con user_id = 1)
        $affiliate_user_id = 1364; // corvin
        // Ottieni il meta_value dell'affiliato
        $affiliate_commission = get_user_meta($affiliate_user_id, 'affiliate', true);
        // Se non esiste, impostalo a 0
        if (!$affiliate_commission) {
            $affiliate_commission = 0;
        }

		// Calcola il 10% del totale
		$commission_to_add = $total_paid * 0.10;
		// Aggiungi la commissione al valore corrente e arrotonda a 2 cifre decimali
		$new_commission_value = round($affiliate_commission + $commission_to_add, 2);
		// Aggiorna il valore del meta "affiliate" per user_id = 1
		update_user_meta($affiliate_user_id, 'affiliate', $new_commission_value);
    }
	
	// 3. verifica affiliati "sponsored" (10% a vita)
	$sponsor_user_id = get_user_meta($user_id, 'sponsored', true);
	if ($sponsor_user_id) {
		$sponsor_commission = get_user_meta($sponsor_user_id, 'sponsor', true);
        // Se non esiste, impostalo a 0
        if (!$sponsor_commission) {
            $sponsor_commission = 0;
        }
		$commission_to_add = $total_paid * 0.10;
        if (intval($sponsor_user_id) === 1362) { // filippo celentano
            $commission_to_add = $total_paid * 0.15;
        }
		elseif (intval($sponsor_user_id) === 822) { // gabrielle nunez
            $commission_to_add = $total_paid * 0.20;
        }
		$new_commission_value = round($sponsor_commission + $commission_to_add, 2);
		update_user_meta($sponsor_user_id, 'sponsor', $new_commission_value);
	}
}

// Disabilita i coupon per chi ha un meta value "discount" associato
add_filter( 'woocommerce_coupon_is_valid', 'deny_coupon_if_discount_meta', 10, 2 );

function deny_coupon_if_discount_meta( $valid, $coupon ) {
    // Ottieni l'ID dell'utente corrente
    $user_id = get_current_user_id();

    // Verifica se esiste il metadato 'discount'
    $discount = get_user_meta( $user_id, 'discount', true );

    // Se l'utente ha un metadato 'discount', disabilita i coupon
    if ( ! empty( $discount ) ) {
        wc_add_notice( __( 'Hai già uno sconto applicato al tuo account, i coupon non sono necessari.' ), 'error' );
        return false;
    }

    return $valid;
}




/**
 * pippo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pippo
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'pippo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pippo_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on pippo, use a find and replace
		 * to change 'pippo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pippo', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'pippo' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'pippo_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'pippo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pippo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pippo_content_width', 640 );
}
add_action( 'after_setup_theme', 'pippo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pippo_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pippo' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pippo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pippo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pippo_scripts() {
	wp_enqueue_style( 'pippo-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'pippo-style', 'rtl', 'replace' );

	wp_enqueue_script( 'pippo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pippo_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/** RG-WEBDEV **/

// Disattiva il caricamento automatico del foglio di stile del tema
add_action('wp_enqueue_scripts', function() {
    wp_dequeue_style('my-theme-style');
    wp_dequeue_style('pippo-style'); // eventualmente cambia questi ID se diversi
}, 100);


function pb_block_fouc() {
    $theme_style = get_stylesheet_uri();

    // Carica il CSS con preload o async
    echo '<link rel="stylesheet" href="' . esc_url($theme_style) . '?ver=' . uniqid() . '" media="print" onload="this.onload=null;this.media=\'all\';">' . "\n";
    echo '<noscript><link rel="stylesheet" href="' . esc_url($theme_style) . '"></noscript>' . "\n";
    
}
add_action('wp_head', 'pb_block_fouc', 1);

function pb_add_no_css_class($classes) {
    $classes[] = 'no-css';
    return $classes;
}
add_filter('body_class', 'pb_add_no_css_class');



// ************
// Last updated: 2025-11-02 14:30 UTC - Server-side AJAX handlers

/**
 * Plottybot API Proxy - Server-side API calls to hide API key
 */
if (!defined('PLOTTYBOT_API_KEY')) {
    define('PLOTTYBOT_API_KEY', 'fF7LkPzDP9Qm8dOP8Zg6ROlY');
}

// Log that our AJAX handlers are being registered
error_log('Plottybot: Registering AJAX handlers - ' . date('Y-m-d H:i:s'));

// Test endpoint to verify AJAX is working
add_action('wp_ajax_plottybot_test', 'plottybot_test_handler');
add_action('wp_ajax_nopriv_plottybot_test', 'plottybot_test_handler');
error_log('Plottybot: Test handler registered');

if (!function_exists('plottybot_test_handler')) {
    function plottybot_test_handler() {
        error_log('Plottybot: Test handler called');
        wp_send_json_success([
            'message' => 'AJAX is working!',
            'user_logged_in' => is_user_logged_in(),
            'user_id' => get_current_user_id()
        ]);
    }
}

// AJAX handler for books search
add_action('wp_ajax_plottybot_search_books', 'plottybot_search_books_handler');
add_action('wp_ajax_nopriv_plottybot_search_books', 'plottybot_search_books_handler');

if (!function_exists('plottybot_search_books_handler')) {
    function plottybot_search_books_handler() {
        error_log('Plottybot Books: Handler called');
        error_log('Plottybot Books: User logged in = ' . (is_user_logged_in() ? 'yes' : 'no'));

        // Verify user is logged in
        if (!is_user_logged_in()) {
            error_log('Plottybot Books: Auth failed - not logged in');
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);
        error_log('Plottybot Books: Payload = ' . json_encode($payload));

        if (!$payload) {
            error_log('Plottybot Books: Invalid payload');
            wp_send_json_error(['message' => 'Invalid payload'], 400);
            wp_die();
        }

        // Make API call with explicit server IP
        // Use the actual external IP of the WordPress server
        $server_external_ip = '95.110.231.49';
        error_log('Plottybot Books: Using external IP = ' . $server_external_ip);
        error_log('Plottybot Books: API Key = ' . substr(PLOTTYBOT_API_KEY, 0, 8) . '...');

        $api_url = 'https://api-frontend-1044931876531.us-central1.run.app/books/search';
        error_log('Plottybot Books: API URL = ' . $api_url);

        $request_args = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . PLOTTYBOT_API_KEY,
                'X-Forwarded-For' => $server_external_ip,
                'X-Real-IP' => $server_external_ip,
                'X-Forwarded-Proto' => 'https',
                'X-Forwarded-Host' => 'insights.plottybot.com'
            ],
            'body' => json_encode($payload),
            'timeout' => 30,
            'sslverify' => true
        ];

        error_log('Plottybot Books: Request headers being sent = ' . json_encode($request_args['headers']));

        $response = wp_remote_post($api_url, $request_args);

        error_log('Plottybot Books: Request sent to API');

        if (is_wp_error($response)) {
            error_log('Plottybot Books: WP Error - ' . $response->get_error_message());
            wp_send_json_error(['message' => $response->get_error_message()], 500);
            wp_die();
        }

        $body = wp_remote_retrieve_body($response);
        $status_code = wp_remote_retrieve_response_code($response);
        $response_headers = wp_remote_retrieve_headers($response);

        error_log('Plottybot Books: API response status = ' . $status_code);
        error_log('Plottybot Books: API response body length = ' . strlen($body));
        if ($status_code >= 400) {
            error_log('Plottybot Books: Error response body = ' . $body);
        }

        // Send the successful response
        status_header($status_code);
        header('Content-Type: application/json');
        echo $body;
        wp_die();
    }
}

// AJAX handler for categories search
add_action('wp_ajax_plottybot_search_categories', 'plottybot_search_categories_handler');
add_action('wp_ajax_nopriv_plottybot_search_categories', 'plottybot_search_categories_handler');

if (!function_exists('plottybot_search_categories_handler')) {
    function plottybot_search_categories_handler() {
        error_log('Plottybot: Categories search handler called');
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload) {
            wp_send_json_error(['message' => 'Invalid payload'], 400);
            wp_die();
        }

        // Make API call with explicit server IP
        // Use the actual external IP of the WordPress server
        $server_external_ip = '95.110.231.49';

        $response = wp_remote_post('https://api-frontend-q66rh5ei3a-uc.a.run.app/categories/search', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . PLOTTYBOT_API_KEY,
                'X-Forwarded-For' => $server_external_ip,
                'X-Real-IP' => $server_external_ip
            ],
            'body' => json_encode($payload),
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => $response->get_error_message()], 500);
            wp_die();
        }

        $body = wp_remote_retrieve_body($response);
        $status_code = wp_remote_retrieve_response_code($response);

        // Send the successful response
        status_header($status_code);
        header('Content-Type: application/json');
        echo $body;
        wp_die();
    }
}

// AJAX handler for fetching categories
add_action('wp_ajax_plottybot_fetch_categories', 'plottybot_fetch_categories_handler');
add_action('wp_ajax_nopriv_plottybot_fetch_categories', 'plottybot_fetch_categories_handler');

if (!function_exists('plottybot_fetch_categories_handler')) {
    function plottybot_fetch_categories_handler() {
        // Log the request for debugging
        error_log('Plottybot fetch categories called - User logged in: ' . (is_user_logged_in() ? 'yes' : 'no'));

        // Verify user is logged in
        if (!is_user_logged_in()) {
            error_log('Plottybot fetch categories: User not logged in');
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get country parameter and convert to uppercase
        $country = isset($_GET['country']) ? strtoupper(sanitize_text_field($_GET['country'])) : 'US';
        error_log('Plottybot fetch categories: Country = ' . $country);

        // Make API call
        $api_url = 'https://api-frontend-1044931876531.us-central1.run.app/categories?country=' . $country;
        error_log('Plottybot fetch categories: API URL = ' . $api_url);

        // Use the actual external IP of the WordPress server
        $server_external_ip = '95.110.231.49';
        error_log('Plottybot fetch categories: Using external server IP = ' . $server_external_ip);

        $response = wp_remote_get($api_url, [
            'headers' => [
                'Authorization' => 'Bearer ' . PLOTTYBOT_API_KEY,
                'X-Forwarded-For' => $server_external_ip,
                'X-Real-IP' => $server_external_ip
            ],
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            error_log('Plottybot fetch categories: WP Error - ' . $response->get_error_message());
            wp_send_json_error(['message' => $response->get_error_message()], 500);
            wp_die();
        }

        $body = wp_remote_retrieve_body($response);
        $status_code = wp_remote_retrieve_response_code($response);
        error_log('Plottybot fetch categories: API Status = ' . $status_code);

        // Check if the API returned an error status
        if ($status_code >= 400) {
            error_log('Plottybot fetch categories: API returned error ' . $status_code);
            status_header($status_code);
            header('Content-Type: application/json');
            echo $body;
            wp_die();
        }

        // Send the successful response
        status_header(200);
        header('Content-Type: application/json');
        echo $body;
        wp_die();
    }
}

// AJAX handler for royalties calculation
add_action('wp_ajax_plottybot_calculate_royalties', 'plottybot_calculate_royalties_handler');
add_action('wp_ajax_nopriv_plottybot_calculate_royalties', 'plottybot_calculate_royalties_handler');

if (!function_exists('plottybot_calculate_royalties_handler')) {
    function plottybot_calculate_royalties_handler() {
        error_log('Plottybot Royalties: Handler called');

        // Verify user is logged in
        if (!is_user_logged_in()) {
            error_log('Plottybot Royalties: Auth failed - not logged in');
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);
        error_log('Plottybot Royalties: Payload = ' . json_encode($payload));

        if (!$payload) {
            error_log('Plottybot Royalties: Invalid payload');
            wp_send_json_error(['message' => 'Invalid payload'], 400);
            wp_die();
        }

        // Use the actual external IP of the WordPress server
        $server_external_ip = '95.110.231.49';
        error_log('Plottybot Royalties: Using external IP = ' . $server_external_ip);

        $api_url = 'https://api-frontend-1044931876531.us-central1.run.app/books/royalties_per_copy';
        error_log('Plottybot Royalties: API URL = ' . $api_url);

        $request_args = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . PLOTTYBOT_API_KEY,
                'X-Forwarded-For' => $server_external_ip,
                'X-Real-IP' => $server_external_ip,
                'X-Forwarded-Proto' => 'https',
                'X-Forwarded-Host' => 'insights.plottybot.com'
            ],
            'body' => json_encode($payload),
            'timeout' => 30,
            'sslverify' => true
        ];

        error_log('Plottybot Royalties: Request sent to API');

        $response = wp_remote_post($api_url, $request_args);

        if (is_wp_error($response)) {
            error_log('Plottybot Royalties: WP Error - ' . $response->get_error_message());
            wp_send_json_error(['message' => $response->get_error_message()], 500);
            wp_die();
        }

        $body = wp_remote_retrieve_body($response);
        $status_code = wp_remote_retrieve_response_code($response);

        error_log('Plottybot Royalties: API response status = ' . $status_code);
        error_log('Plottybot Royalties: API response body length = ' . strlen($body));

        if ($status_code >= 400) {
            error_log('Plottybot Royalties: Error response body = ' . $body);
            status_header($status_code);
            header('Content-Type: application/json');
            echo $body;
            wp_die();
        }

        // Parse royalties response
        $royalties_data = json_decode($body, true);

        if (!$royalties_data || !isset($royalties_data['royalties_per_copy'][0])) {
            error_log('Plottybot Royalties: Invalid royalties response');
            wp_send_json_error(['message' => 'Invalid royalties response'], 500);
            wp_die();
        }

        // Extract book price and royalty per copy from the first item
        $first_book = $royalties_data['royalties_per_copy'][0];
        $book_price = $first_book['list_price'];

        // Get the royalty for the requested ink type (from original payload)
        $requested_ink_type = 'black'; // default
        if (isset($payload[0]['ink_type'])) {
            $requested_ink_type = $payload[0]['ink_type'];
        }

        // Find the matching ink type or use first one
        $royalty_per_copy = null;
        foreach ($first_book['by_ink_type'] as $ink_data) {
            if ($ink_data['ink_type'] === $requested_ink_type) {
                $royalty_per_copy = $ink_data['royalties_per_copy'];
                break;
            }
        }

        // If not found, use first available
        if ($royalty_per_copy === null && !empty($first_book['by_ink_type'])) {
            $royalty_per_copy = $first_book['by_ink_type'][0]['royalties_per_copy'];
        }

        error_log('Plottybot Royalties: Book price = ' . $book_price . ', Royalty per copy = ' . $royalty_per_copy);

        // Now call ACOS metrics API
        $acos_url = 'https://api-frontend-1044931876531.us-central1.run.app/books/acos_metrics';
        error_log('Plottybot Royalties: Calling ACOS API URL = ' . $acos_url);

        $acos_payload = [
            'book_price' => $book_price,
            'royalty_per_copy' => $royalty_per_copy
        ];

        $acos_request_args = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . PLOTTYBOT_API_KEY,
                'X-Forwarded-For' => $server_external_ip,
                'X-Real-IP' => $server_external_ip,
                'X-Forwarded-Proto' => 'https',
                'X-Forwarded-Host' => 'insights.plottybot.com'
            ],
            'body' => json_encode($acos_payload),
            'timeout' => 30,
            'sslverify' => true
        ];

        $acos_response = wp_remote_post($acos_url, $acos_request_args);

        if (is_wp_error($acos_response)) {
            error_log('Plottybot Royalties: ACOS API WP Error - ' . $acos_response->get_error_message());
            // Continue without ACOS data
            $acos_data = null;
        } else {
            $acos_body = wp_remote_retrieve_body($acos_response);
            $acos_status = wp_remote_retrieve_response_code($acos_response);
            error_log('Plottybot Royalties: ACOS API response status = ' . $acos_status);

            if ($acos_status >= 400) {
                error_log('Plottybot Royalties: ACOS API error response = ' . $acos_body);
                $acos_data = null;
            } else {
                $acos_data = json_decode($acos_body, true);
            }
        }

        // Combine both responses
        $combined_response = [
            'royalties_per_copy' => $royalties_data['royalties_per_copy'],
            'acos_metrics' => $acos_data ? $acos_data['acos_metrics'] : null
        ];

        error_log('Plottybot Royalties: Sending combined response');

        // Send the combined response
        status_header(200);
        header('Content-Type: application/json');
        echo json_encode($combined_response);
        wp_die();
    }
}

// AJAX handler for book analysis
add_action('wp_ajax_plottybot_analyze_book', 'plottybot_analyze_book_handler');
add_action('wp_ajax_nopriv_plottybot_analyze_book', 'plottybot_analyze_book_handler');

if (!function_exists('plottybot_analyze_book_handler')) {
    function plottybot_analyze_book_handler() {
        error_log('Plottybot Book Analysis: Handler called');

        // Verify user is logged in
        if (!is_user_logged_in()) {
            error_log('Plottybot Book Analysis: Auth failed - not logged in');
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);
        error_log('Plottybot Book Analysis: Payload = ' . json_encode($payload));

        if (!$payload || !isset($payload['asin']) || !isset($payload['market'])) {
            error_log('Plottybot Book Analysis: Invalid payload');
            wp_send_json_error(['message' => 'Invalid payload - asin and market required'], 400);
            wp_die();
        }

        // Use the actual external IP of the WordPress server
        $server_external_ip = '95.110.231.49';
        error_log('Plottybot Book Analysis: Using external IP = ' . $server_external_ip);

        $api_url = 'https://api-frontend-1044931876531.us-central1.run.app/books/analyze';
        error_log('Plottybot Book Analysis: API URL = ' . $api_url);

        $request_args = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . PLOTTYBOT_API_KEY,
                'X-Forwarded-For' => $server_external_ip,
                'X-Real-IP' => $server_external_ip,
                'X-Forwarded-Proto' => 'https',
                'X-Forwarded-Host' => 'insights.plottybot.com'
            ],
            'body' => json_encode($payload),
            'timeout' => 30,
            'sslverify' => true
        ];

        error_log('Plottybot Book Analysis: Request sent to API');

        $response = wp_remote_post($api_url, $request_args);

        if (is_wp_error($response)) {
            error_log('Plottybot Book Analysis: WP Error - ' . $response->get_error_message());
            wp_send_json_error(['message' => $response->get_error_message()], 500);
            wp_die();
        }

        $body = wp_remote_retrieve_body($response);
        $status_code = wp_remote_retrieve_response_code($response);

        error_log('Plottybot Book Analysis: API response status = ' . $status_code);
        error_log('Plottybot Book Analysis: API response body length = ' . strlen($body));

        if ($status_code >= 400) {
            error_log('Plottybot Book Analysis: Error response body = ' . $body);
        }

        // Send the successful response
        status_header($status_code);
        header('Content-Type: application/json');
        echo $body;
        wp_die();
    }
}

// AJAX handler for checking/creating ads optimizer user
add_action('wp_ajax_ads_check_create_user', 'ads_check_create_user_handler');
add_action('wp_ajax_nopriv_ads_check_create_user', 'ads_check_create_user_handler');

if (!function_exists('ads_check_create_user_handler')) {
    function ads_check_create_user_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get current user data
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;
        $username = $current_user->user_login;
        $email = $current_user->user_email;

        // Check if user exists in ads optimizer
        $check_url = "https://ads-optimizer-api-1044931876531.europe-west1.run.app/user/{$user_id}";

        $check_response = wp_remote_get($check_url, [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($check_response)) {
            wp_send_json_error(['message' => 'Error checking user'], 500);
            wp_die();
        }

        $check_status = wp_remote_retrieve_response_code($check_response);

        // If user exists (200), return success
        if ($check_status === 200) {
            $check_body = wp_remote_retrieve_body($check_response);
            wp_send_json_success([
                'message' => 'User already exists',
                'user_data' => json_decode($check_body, true),
                'created' => false
            ]);
            wp_die();
        }

        // If user doesn't exist (404), create them
        if ($check_status === 404) {
            $create_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/user';
            $payload = [
                'name' => (string) $username,
                'id' => (string) $user_id,
                'email' => (string) $email,
                'support_email' => (string) $email
            ];

            $create_response = wp_remote_post($create_url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($payload),
                'timeout' => 30,
                'sslverify' => true
            ]);

            if (is_wp_error($create_response)) {
                wp_send_json_error(['message' => 'Error creating user'], 500);
                wp_die();
            }

            $create_status = wp_remote_retrieve_response_code($create_response);
            $create_body = wp_remote_retrieve_body($create_response);

            if ($create_status === 200 || $create_status === 201) {
                $response_data = json_decode($create_body, true);
                wp_send_json_success([
                    'message' => 'User created successfully',
                    'user_data' => $response_data,
                    'created' => true
                ]);
            } else {
                wp_send_json_error([
                    'message' => 'Failed to create user',
                    'status' => $create_status
                ], $create_status);
            }
            wp_die();
        }

        // Unexpected status code
        wp_send_json_error([
            'message' => 'Unexpected response from server',
            'status' => $check_status
        ], 500);
        wp_die();
    }
}

