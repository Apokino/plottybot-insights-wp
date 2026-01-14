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
        $server_external_ip = '95.110.231.49';

        $api_url = 'https://api-frontend-1044931876531.us-central1.run.app/books/search';

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

        $response = wp_remote_post($api_url, $request_args);

        if (is_wp_error($response)) {
            error_log('Plottybot Books: API Error - ' . $response->get_error_message());
            wp_send_json_error(['message' => $response->get_error_message()], 500);
            wp_die();
        }

        $body = wp_remote_retrieve_body($response);
        $status_code = wp_remote_retrieve_response_code($response);

        if ($status_code >= 400) {
            error_log('Plottybot Books: Error response (status ' . $status_code . '): ' . $body);
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

// AJAX handler for adding KDP profile
add_action('wp_ajax_add_kdp_profile', 'add_kdp_profile_handler');
add_action('wp_ajax_nopriv_add_kdp_profile', 'add_kdp_profile_handler');

if (!function_exists('add_kdp_profile_handler')) {
    function add_kdp_profile_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['account_name']) || !isset($payload['auth_code']) || !isset($payload['user_id'])) {
            wp_send_json_error(['message' => 'Missing required fields'], 400);
            wp_die();
        }

        // Use user_id from request (temporary - will be replaced with logged-in user later)
        $user_id = sanitize_text_field($payload['user_id']);

        // Log what we received from frontend
        error_log('Add KDP Profile: Received from frontend = ' . json_encode($payload));

        // Prepare API payload - use redirect_uri from frontend if provided, otherwise use default
        $redirect_uri = isset($payload['redirect_uri']) ? $payload['redirect_uri'] : 'https://insights.plottybot.com/ads';

        $api_payload = [
            'user_id' => (string) $user_id,
            'account_name' => (string) $payload['account_name'],
            'auth_code' => (string) $payload['auth_code'],
            'redirect_uri' => (string) $redirect_uri
        ];

        error_log('Add KDP Profile: Sending to API = ' . json_encode($api_payload));

        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/account';

        $response = wp_remote_post($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($api_payload),
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            error_log('Add KDP Profile: WP Error = ' . $response->get_error_message());
            wp_send_json_error(['message' => 'Error adding KDP profile: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        error_log('Add KDP Profile: API Response Status = ' . $status_code);
        error_log('Add KDP Profile: API Response Body = ' . $body);

        if ($status_code === 200 || $status_code === 201) {
            $response_data = json_decode($body, true);
            error_log('Add KDP Profile: Success!');
            wp_send_json_success([
                'message' => 'KDP profile added successfully',
                'data' => $response_data
            ]);
        } else {
            error_log('Add KDP Profile: Failed with status ' . $status_code);
            wp_send_json_error([
                'message' => 'Failed to add KDP profile',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for deleting KDP account
add_action('wp_ajax_delete_kdp_account', 'delete_kdp_account_handler');
add_action('wp_ajax_nopriv_delete_kdp_account', 'delete_kdp_account_handler');

if (!function_exists('delete_kdp_account_handler')) {
    function delete_kdp_account_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['user_id']) || !isset($payload['account_name'])) {
            wp_send_json_error(['message' => 'Missing required fields'], 400);
            wp_die();
        }

        $user_id = sanitize_text_field($payload['user_id']);
        $account_name = sanitize_text_field($payload['account_name']);

        // Prepare API payload
        $api_payload = [
            'user_id' => (string) $user_id,
            'account_name' => (string) $account_name
        ];

        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/account';

        $response = wp_remote_request($api_url, [
            'method' => 'DELETE',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($api_payload),
            'timeout' => 30,
            'sslverify' => true
        ]);

        // Log the response for debugging
        $status_code = is_wp_error($response) ? 0 : wp_remote_retrieve_response_code($response);
        $body = is_wp_error($response) ? '' : wp_remote_retrieve_body($response);
        error_log("Delete KDP Account - Status: {$status_code}, Body: {$body}");

        // Always return success - let the frontend reload to check actual state
        // This handles cases where API deletes but returns non-standard status codes
        wp_send_json_success([
            'message' => 'Delete request sent',
            'status' => $status_code
        ]);
        wp_die();
    }
}

// AJAX handler for getting KDP accounts
add_action('wp_ajax_get_kdp_accounts', 'get_kdp_accounts_handler');
add_action('wp_ajax_nopriv_get_kdp_accounts', 'get_kdp_accounts_handler');

if (!function_exists('get_kdp_accounts_handler')) {
    function get_kdp_accounts_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['user_id'])) {
            wp_send_json_error(['message' => 'User ID is required'], 400);
            wp_die();
        }

        $user_id = sanitize_text_field($payload['user_id']);

        // Build API URL
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/account/' . urlencode($user_id);

        $response = wp_remote_get($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Error fetching KDP accounts: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($status_code === 200) {
            $response_data = json_decode($body, true);
            wp_send_json_success($response_data);
        } else {
            wp_send_json_error([
                'message' => 'Failed to fetch KDP accounts',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for getting optimization schedules
add_action('wp_ajax_get_optimization_schedules', 'get_optimization_schedules_handler');
add_action('wp_ajax_nopriv_get_optimization_schedules', 'get_optimization_schedules_handler');

if (!function_exists('get_optimization_schedules_handler')) {
    function get_optimization_schedules_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['user_id'])) {
            wp_send_json_error(['message' => 'User ID is required'], 400);
            wp_die();
        }

        $user_id = sanitize_text_field($payload['user_id']);

        // Build API URL
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/optimisation-schedule/' . urlencode($user_id);

        $response = wp_remote_get($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Error fetching optimization schedules: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($status_code === 200) {
            $response_data = json_decode($body, true);
            wp_send_json_success($response_data);
        } else {
            wp_send_json_error([
                'message' => 'Failed to fetch optimization schedules',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for toggling optimization active status
add_action('wp_ajax_toggle_optimization', 'toggle_optimization_handler');
add_action('wp_ajax_nopriv_toggle_optimization', 'toggle_optimization_handler');

if (!function_exists('toggle_optimization_handler')) {
    function toggle_optimization_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['user_id']) || !isset($payload['kdp_profile']) || !isset($payload['active'])) {
            wp_send_json_error(['message' => 'Missing required fields: user_id, kdp_profile, and active'], 400);
            wp_die();
        }

        $user_id = sanitize_text_field($payload['user_id']);
        $kdp_profile = sanitize_text_field($payload['kdp_profile']);
        $active = (bool) $payload['active'];


        // Build API URL - using POST to toggle endpoint
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/optimisation-schedule/toggle';

        $api_payload = [
            'user_id' => (string) $user_id,
            'kdp_profile' => (string) $kdp_profile,
            'enable' => $active
        ];

        $response = wp_remote_post($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($api_payload),
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Error toggling optimization: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($status_code === 200 || $status_code === 201) {
            $response_data = json_decode($body, true);
            wp_send_json_success([
                'message' => 'Optimization toggled successfully',
                'data' => $response_data
            ]);
        } else {
            wp_send_json_error([
                'message' => 'Failed to toggle optimization',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for deleting optimization
add_action('wp_ajax_delete_optimization', 'delete_optimization_handler');
add_action('wp_ajax_nopriv_delete_optimization', 'delete_optimization_handler');

if (!function_exists('delete_optimization_handler')) {
    function delete_optimization_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['user_id']) || !isset($payload['kdp_profile'])) {
            wp_send_json_error(['message' => 'Missing required fields: user_id and kdp_profile'], 400);
            wp_die();
        }

        $user_id = sanitize_text_field($payload['user_id']);
        $kdp_profile = sanitize_text_field($payload['kdp_profile']);

        // Build API URL and payload
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/optimisation-schedule';

        $api_payload = [
            'user_id' => (string) $user_id,
            'kdp_profile' => (string) $kdp_profile
        ];

        $response = wp_remote_request($api_url, [
            'method' => 'DELETE',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($api_payload),
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Error deleting optimization: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($status_code === 200 || $status_code === 204) {
            wp_send_json_success([
                'message' => 'Optimization deleted successfully'
            ]);
        } else {
            wp_send_json_error([
                'message' => 'Failed to delete optimization',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for scheduling new optimization (placeholder)
add_action('wp_ajax_schedule_optimization', 'schedule_optimization_handler');
add_action('wp_ajax_nopriv_schedule_optimization', 'schedule_optimization_handler');

if (!function_exists('schedule_optimization_handler')) {
    function schedule_optimization_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['user_id']) || !isset($payload['account']) || !isset($payload['region'])) {
            wp_send_json_error(['message' => 'Missing required fields'], 400);
            wp_die();
        }

        $user_id = sanitize_text_field($payload['user_id']);
        $account = sanitize_text_field($payload['account']);
        $region = sanitize_text_field($payload['region']);

        // Build kdp_profile in format: [ACCOUNT_NAME]-[REGION]
        $kdp_profile = $account . '-' . $region;

        // Prepare API payload
        $api_payload = [
            'user_id' => (string) $user_id,
            'kdp_profile' => (string) $kdp_profile
        ];
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/optimisation-schedule';

        $response = wp_remote_post($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($api_payload),
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Error scheduling optimization: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($status_code === 200 || $status_code === 201) {
            $response_data = json_decode($body, true);
            wp_send_json_success([
                'message' => 'Optimization scheduled successfully',
                'data' => $response_data
            ]);
        } else {
            wp_send_json_error([
                'message' => 'Failed to schedule optimization',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for getting campaign list
add_action('wp_ajax_get_campaign_list', 'get_campaign_list_handler');
add_action('wp_ajax_nopriv_get_campaign_list', 'get_campaign_list_handler');

if (!function_exists('get_campaign_list_handler')) {
    function get_campaign_list_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['user_id']) || !isset($payload['account']) || !isset($payload['region'])) {
            wp_send_json_error(['message' => 'Missing required fields'], 400);
            wp_die();
        }

        $user_id = sanitize_text_field($payload['user_id']);
        $account = sanitize_text_field($payload['account']);
        $region = sanitize_text_field($payload['region']);

        // Build kdp_profile in format: [ACCOUNT_NAME]-[REGION]
        $kdp_profile = $account . '-' . $region;

        // Prepare API payload
        $api_payload = [
            'user_id' => (string) $user_id,
            'kdp_profile' => (string) $kdp_profile,
            'all_campaigns' => true
        ];

        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/campaign/list';

        $response = wp_remote_post($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($api_payload),
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Error fetching campaigns: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($status_code === 200 || $status_code === 201) {
            $response_data = json_decode($body, true);
            wp_send_json_success([
                'campaigns' => $response_data
            ]);
        } else {
            wp_send_json_error([
                'message' => 'Failed to fetch campaigns',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for creating campaign configuration
add_action('wp_ajax_create_campaign_config', 'create_campaign_config_handler');
add_action('wp_ajax_nopriv_create_campaign_config', 'create_campaign_config_handler');

if (!function_exists('create_campaign_config_handler')) {
    function create_campaign_config_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $raw_input = file_get_contents('php://input');
        error_log('Campaign Config: Raw input = ' . $raw_input);

        $payload = json_decode($raw_input, true);
        error_log('Campaign Config: Decoded payload = ' . print_r($payload, true));

        if (!$payload) {
            error_log('Campaign Config: Payload is null or invalid JSON');
            wp_send_json_error(['message' => 'Invalid JSON payload'], 400);
            wp_die();
        }

        if (!isset($payload['user_id'])) {
            error_log('Campaign Config: Missing user_id');
            wp_send_json_error(['message' => 'Missing user_id'], 400);
            wp_die();
        }

        if (!isset($payload['kdp_profile'])) {
            error_log('Campaign Config: Missing kdp_profile');
            wp_send_json_error(['message' => 'Missing kdp_profile'], 400);
            wp_die();
        }

        if (!isset($payload['configuration'])) {
            error_log('Campaign Config: Missing configuration');
            wp_send_json_error(['message' => 'Missing configuration'], 400);
            wp_die();
        }

        error_log('Campaign Config: All fields present, proceeding with API call');

        // Log configuration details for debugging
        if (isset($payload['configuration']) && is_array($payload['configuration'])) {
            foreach ($payload['configuration'] as $index => $config) {
                error_log("Campaign Config: Configuration[$index] includes ad_group_name: " .
                    (isset($config['ad_group_name']) ? $config['ad_group_name'] : 'NOT SET'));
            }
        }

        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/campaign/configuration';

        $response = wp_remote_post($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($payload),
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Error creating campaign configuration: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($status_code === 200 || $status_code === 201) {
            $response_data = json_decode($body, true);
            wp_send_json_success([
                'message' => 'Campaign configuration created successfully',
                'data' => $response_data
            ]);
        } else {
            wp_send_json_error([
                'message' => 'Failed to create campaign configuration',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for listing campaign configurations
add_action('wp_ajax_list_campaign_configs', 'list_campaign_configs_handler');
add_action('wp_ajax_nopriv_list_campaign_configs', 'list_campaign_configs_handler');

if (!function_exists('list_campaign_configs_handler')) {
    function list_campaign_configs_handler() {
        error_log('List Campaign Configs: Handler called');

        // Verify user is logged in
        if (!is_user_logged_in()) {
            error_log('List Campaign Configs: User not logged in');
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $raw_input = file_get_contents('php://input');
        error_log('List Campaign Configs: Raw input = ' . $raw_input);

        $payload = json_decode($raw_input, true);
        error_log('List Campaign Configs: Payload = ' . print_r($payload, true));

        if (!$payload || !isset($payload['user_id']) || !isset($payload['kdp_profile'])) {
            error_log('List Campaign Configs: Missing required fields');
            wp_send_json_error(['message' => 'Missing required fields'], 400);
            wp_die();
        }

        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/campaign/configuration/list';
        error_log('List Campaign Configs: Calling API with URL = ' . $api_url);

        $response = wp_remote_post($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($payload),
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            error_log('List Campaign Configs: WP Error - ' . $response->get_error_message());
            wp_send_json_error(['message' => 'Error fetching configurations: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        error_log('List Campaign Configs: API Status = ' . $status_code);
        error_log('List Campaign Configs: API Response Body = ' . $body);

        if ($status_code === 200 || $status_code === 201) {
            $response_data = json_decode($body, true);
            error_log('List Campaign Configs: Decoded response = ' . print_r($response_data, true));
            error_log('List Campaign Configs: Is array? ' . (is_array($response_data) ? 'yes' : 'no'));
            error_log('List Campaign Configs: Count = ' . (is_array($response_data) ? count($response_data) : 'N/A'));

            wp_send_json_success([
                'configurations' => $response_data
            ]);
        } else {
            error_log('List Campaign Configs: API returned error status ' . $status_code);
            wp_send_json_error([
                'message' => 'Failed to fetch configurations',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for updating campaign configuration
add_action('wp_ajax_update_campaign_config', 'update_campaign_config_handler');
add_action('wp_ajax_nopriv_update_campaign_config', 'update_campaign_config_handler');

if (!function_exists('update_campaign_config_handler')) {
    function update_campaign_config_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['user_id']) || !isset($payload['kdp_profile']) || !isset($payload['configuration'])) {
            wp_send_json_error(['message' => 'Missing required fields'], 400);
            wp_die();
        }

        // Log configuration details for debugging
        error_log('Update Campaign Config: Payload received');
        if (isset($payload['configuration']) && is_array($payload['configuration'])) {
            foreach ($payload['configuration'] as $index => $config) {
                error_log("Update Campaign Config: Configuration[$index] includes ad_group_name: " .
                    (isset($config['ad_group_name']) ? $config['ad_group_name'] : 'NOT SET'));
            }
        }

        // Use same endpoint as create - API should handle update if config exists
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/campaign/configuration';

        $response = wp_remote_post($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($payload),
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Error updating configuration: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($status_code === 200 || $status_code === 201) {
            $response_data = json_decode($body, true);
            wp_send_json_success([
                'message' => 'Configuration updated successfully',
                'data' => $response_data
            ]);
        } else {
            wp_send_json_error([
                'message' => 'Failed to update configuration',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for getting optimization runs for an account
add_action('wp_ajax_get_optimization_runs', 'get_optimization_runs_handler');
add_action('wp_ajax_nopriv_get_optimization_runs', 'get_optimization_runs_handler');

if (!function_exists('get_optimization_runs_handler')) {
    function get_optimization_runs_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['user_id']) || !isset($payload['account_name'])) {
            wp_send_json_error(['message' => 'Missing required fields: user_id and account_name'], 400);
            wp_die();
        }

        $user_id = sanitize_text_field($payload['user_id']);
        $account_name = sanitize_text_field($payload['account_name']);

        // Build API URL
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/optimise/logs/' . urlencode($user_id) . '/' . urlencode($account_name);

        $response = wp_remote_get($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Error fetching optimization runs: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($status_code === 200) {
            $response_data = json_decode($body, true);
            wp_send_json_success($response_data);
        } else {
            wp_send_json_error([
                'message' => 'Failed to fetch optimization runs',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for getting run details/logs
add_action('wp_ajax_get_run_details', 'get_run_details_handler');
add_action('wp_ajax_nopriv_get_run_details', 'get_run_details_handler');

if (!function_exists('get_run_details_handler')) {
    function get_run_details_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['user_id']) || !isset($payload['run_id'])) {
            wp_send_json_error(['message' => 'Missing required fields: user_id and run_id'], 400);
            wp_die();
        }

        $user_id = sanitize_text_field($payload['user_id']);
        $run_id = sanitize_text_field($payload['run_id']);
        $language = isset($payload['language']) ? sanitize_text_field($payload['language']) : 'EN';

        // Build API URL with language parameter
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/optimise/logs/run/' . urlencode($user_id) . '/' . urlencode($run_id) . '?language=' . urlencode($language);

        $response = wp_remote_get($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Error fetching run details: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($status_code === 200) {
            $response_data = json_decode($body, true);
            wp_send_json_success($response_data);
        } else {
            wp_send_json_error([
                'message' => 'Failed to fetch run details',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for getting PDF download URL (returns signed GCS URL)
add_action('wp_ajax_get_pdf_download_url', 'get_pdf_download_url_handler');
add_action('wp_ajax_nopriv_get_pdf_download_url', 'get_pdf_download_url_handler');

if (!function_exists('get_pdf_download_url_handler')) {
    function get_pdf_download_url_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized']);
            return;
        }

        // Get parameters from query string
        $user_id = isset($_GET['user_id']) ? sanitize_text_field($_GET['user_id']) : '';
        $run_id = isset($_GET['run_id']) ? sanitize_text_field($_GET['run_id']) : '';
        $language = isset($_GET['language']) ? sanitize_text_field($_GET['language']) : 'EN';

        if (empty($user_id) || empty($run_id)) {
            wp_send_json_error(['message' => 'Missing required parameters: user_id and run_id']);
            return;
        }

        // Build API URL
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/optimise/logs/pdf/' .
                   urlencode($user_id) . '/' . urlencode($run_id) . '?language=' . urlencode($language);

        // Make request to API
        $response = wp_remote_get($api_url, [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Error fetching download URL: ' . $response->get_error_message()]);
            return;
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($status_code !== 200) {
            // Try to decode error message
            $error_data = json_decode($body, true);
            $error_message = isset($error_data['error']) ? $error_data['error'] : 'Failed to get download URL. Status: ' . $status_code;
            wp_send_json_error(['message' => $error_message]);
            return;
        }

        // Parse the response
        $data = json_decode($body, true);

        if (!$data || !isset($data['download_url'])) {
            wp_send_json_error(['message' => 'Invalid response from API: missing download_url']);
            return;
        }

        // Return the signed URL and metadata to the frontend
        wp_send_json_success([
            'download_url' => $data['download_url'],
            'filename' => isset($data['filename']) ? $data['filename'] : 'optimization-report.pdf',
            'expires_in' => isset($data['expires_in']) ? $data['expires_in'] : 86400,
            'kdp_profile' => isset($data['kdp_profile']) ? $data['kdp_profile'] : null,
            'run_id' => isset($data['run_id']) ? $data['run_id'] : $run_id
        ]);
    }
}

// AJAX handler for getting suggested bids
add_action('wp_ajax_get_suggested_bids', 'get_suggested_bids_handler');
add_action('wp_ajax_nopriv_get_suggested_bids', 'get_suggested_bids_handler');

if (!function_exists('get_suggested_bids_handler')) {
    function get_suggested_bids_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['region']) || !isset($payload['targeting_expressions'])) {
            wp_send_json_error(['message' => 'Missing required fields: region and targeting_expressions'], 400);
            wp_die();
        }

        $region = sanitize_text_field($payload['region']);
        $targeting_expressions = $payload['targeting_expressions'];

        // Validate targeting expressions is an array
        if (!is_array($targeting_expressions)) {
            wp_send_json_error(['message' => 'targeting_expressions must be an array'], 400);
            wp_die();
        }

        // Build API URL
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/campaign/sp/suggested-bids';

        // Prepare API payload
        $api_payload = [
            'region' => $region,
            'targeting_expressions' => $targeting_expressions
        ];

        $response = wp_remote_post($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($api_payload),
            'timeout' => 60,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Error fetching suggested bids: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($status_code === 200) {
            $response_data = json_decode($body, true);
            wp_send_json_success($response_data);
        } else {
            wp_send_json_error([
                'message' => 'Failed to fetch suggested bids',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for deleting campaign configuration
add_action('wp_ajax_delete_campaign_config', 'delete_campaign_config_handler');
add_action('wp_ajax_nopriv_delete_campaign_config', 'delete_campaign_config_handler');

if (!function_exists('delete_campaign_config_handler')) {
    function delete_campaign_config_handler() {
        error_log('Delete Campaign Config: Handler called');

        // Verify user is logged in
        if (!is_user_logged_in()) {
            error_log('Delete Campaign Config: User not logged in');
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $raw_input = file_get_contents('php://input');
        error_log('Delete Campaign Config: Raw input = ' . $raw_input);

        $payload = json_decode($raw_input, true);
        error_log('Delete Campaign Config: Decoded payload = ' . print_r($payload, true));

        // Validate all required fields
        if (!$payload) {
            error_log('Delete Campaign Config: Invalid JSON payload');
            wp_send_json_error(['message' => 'Invalid JSON payload'], 400);
            wp_die();
        }

        if (!isset($payload['user_id'])) {
            error_log('Delete Campaign Config: Missing user_id');
            wp_send_json_error(['message' => 'Missing user_id'], 400);
            wp_die();
        }

        if (!isset($payload['kdp_profile'])) {
            error_log('Delete Campaign Config: Missing kdp_profile');
            wp_send_json_error(['message' => 'Missing kdp_profile'], 400);
            wp_die();
        }

        if (!isset($payload['campaign_id'])) {
            error_log('Delete Campaign Config: Missing campaign_id');
            wp_send_json_error(['message' => 'Missing campaign_id'], 400);
            wp_die();
        }

        if (!isset($payload['ad_group_id'])) {
            error_log('Delete Campaign Config: Missing ad_group_id');
            wp_send_json_error(['message' => 'Missing ad_group_id'], 400);
            wp_die();
        }

        error_log('Delete Campaign Config: All fields present, proceeding with API call');

        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/campaign/configuration';

        $response = wp_remote_request($api_url, [
            'method' => 'DELETE',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($payload),
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            error_log('Delete Campaign Config: WP Error - ' . $response->get_error_message());
            wp_send_json_error(['message' => 'Error deleting configuration: ' . $response->get_error_message()], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        error_log('Delete Campaign Config: API Status = ' . $status_code);
        error_log('Delete Campaign Config: API Response Body = ' . $body);

        if ($status_code === 200 || $status_code === 204) {
            error_log('Delete Campaign Config: Successfully deleted');
            wp_send_json_success([
                'message' => 'Configuration deleted successfully'
            ]);
        } else {
            error_log('Delete Campaign Config: API returned error status ' . $status_code);
            wp_send_json_error([
                'message' => 'Failed to delete configuration',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// AJAX handler for getting keyword recommendations
add_action('wp_ajax_get_keyword_recommendations', 'get_keyword_recommendations_handler');
add_action('wp_ajax_nopriv_get_keyword_recommendations', 'get_keyword_recommendations_handler');

if (!function_exists('get_keyword_recommendations_handler')) {
    function get_keyword_recommendations_handler() {
        // Set maximum execution time
        set_time_limit(300);
        ini_set('max_execution_time', '300');

        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['book_title']) || !isset($payload['asins']) || !isset($payload['kdp_profile'])) {
            wp_send_json_error(['message' => 'Missing required fields: book_title, asins, and kdp_profile are required'], 400);
            wp_die();
        }

        $book_title = sanitize_text_field($payload['book_title']);
        $asins = $payload['asins'];
        $kdp_profile = sanitize_text_field($payload['kdp_profile']);
        $use_ai = isset($payload['use_ai']) ? (bool)$payload['use_ai'] : true;
        $max_keywords = isset($payload['max_keywords']) ? intval($payload['max_keywords']) : 300;
        
        $user_id = get_current_user_id();
        
        // Build API URL
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/campaign/keywords/recommendation';
        
        $request_body = [
            'user_id' => strval($user_id),
            'kdp_profile' => $kdp_profile,
            'book_title' => $book_title,
            'asins' => $asins,
            'use_ai' => $use_ai,
            'max_keywords' => $max_keywords
        ];
        
        // Make the API call
        $response = wp_remote_post($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($request_body),
            'timeout' => 3600,
            'sslverify' => true
        ]);
        
        if (is_wp_error($response)) {
            wp_send_json_error([
                'message' => 'Error calling API: ' . $response->get_error_message(),
                'error_details' => $response->get_error_messages(),
                'sent_payload' => $request_body
            ]);
            wp_die();
        }
        
        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        
        if ($status_code === 200) {
            $response_data = json_decode($body, true);
            wp_send_json_success($response_data);
        } else {
            wp_send_json_error([
                'message' => 'API returned error status: ' . $status_code,
                'response_body' => $body,
                'sent_payload' => $request_body
            ]);
        }
        
        wp_die();
    }
}

// AJAX handler for starting keyword recommendation job (async)
add_action('wp_ajax_start_keyword_job', 'start_keyword_job_handler');
add_action('wp_ajax_nopriv_start_keyword_job', 'start_keyword_job_handler');

if (!function_exists('start_keyword_job_handler')) {
    function start_keyword_job_handler() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['user_id']) || !isset($payload['book_title']) || !isset($payload['asins']) || !isset($payload['kdp_profile'])) {
            wp_send_json_error(['message' => 'Missing required fields: user_id, book_title, asins, and kdp_profile are required'], 400);
            wp_die();
        }

        $user_id = sanitize_text_field($payload['user_id']);
        $book_title = sanitize_text_field($payload['book_title']);
        $asins = $payload['asins'];
        $kdp_profile = sanitize_text_field($payload['kdp_profile']);
        $use_ai = isset($payload['use_ai']) ? (bool)$payload['use_ai'] : true;
        $max_keywords = isset($payload['max_keywords']) ? intval($payload['max_keywords']) : 300;
        
        // Verify user is authorized
        if (intval($user_id) !== intval(get_current_user_id())) {
            wp_send_json_error(['message' => 'Unauthorized - user_id mismatch'], 403);
            wp_die();
        }
        
        // Generate unique job ID
        $job_id = 'keyword_job_' . $user_id . '_' . time() . '_' . wp_rand(1000, 9999);
        
        // Store job metadata in transient (expires in 1 hour)
        set_transient($job_id . '_meta', [
            'status' => 'pending',
            'user_id' => $user_id,
            'book_title' => $book_title,
            'started_at' => current_time('mysql'),
            'progress' => 0
        ], 3600);
        
        // Initiate background request (non-blocking)
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/campaign/keywords/recommendation';
        
        // Build request body WITHOUT job_id (API doesn't expect it)
        $request_body = [
            'user_id' => $user_id,
            'kdp_profile' => $kdp_profile,
            'book_title' => $book_title,
            'asins' => $asins,
            'use_ai' => $use_ai,
            'max_keywords' => $max_keywords
        ];
        
        // Update status to processing
        set_transient($job_id . '_meta', [
            'status' => 'processing',
            'user_id' => $user_id,
            'book_title' => $book_title,
            'started_at' => current_time('mysql'),
            'progress' => 10,
            'request_body' => $request_body
        ], 3600);
        
        // Spawn background process using wp_remote_post to our own endpoint
        // This makes an async call back to WordPress to process the job
        wp_remote_post(admin_url('admin-ajax.php'), [
            'blocking' => false,
            'timeout' => 0.01,
            'body' => [
                'action' => 'process_keyword_job_background',
                'job_id' => $job_id
            ]
        ]);
        
        // Return job ID immediately
        wp_send_json_success([
            'job_id' => $job_id,
            'message' => 'Job started successfully'
        ]);
        
        wp_die();
    }
}

// Background hook to fetch keyword job results
add_action('wp_ajax_process_keyword_job_background', 'process_keyword_job_background_handler');
add_action('wp_ajax_nopriv_process_keyword_job_background', 'process_keyword_job_background_handler');

if (!function_exists('process_keyword_job_background_handler')) {
    function process_keyword_job_background_handler() {
        // Get job ID
        $job_id = isset($_POST['job_id']) ? sanitize_text_field($_POST['job_id']) : '';
        
        if (empty($job_id)) {
            wp_die();
        }
        
        // Get job metadata
        $meta = get_transient($job_id . '_meta');
        if ($meta === false || !isset($meta['request_body'])) {
            error_log('process_keyword_job_background_handler: Job metadata not found for ' . $job_id);
            wp_die();
        }
        
        $request_body = $meta['request_body'];
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/campaign/keywords/recommendation';
        
        error_log('Starting background job: ' . $job_id);
        
        // Update progress
        set_transient($job_id . '_meta', array_merge($meta, [
            'progress' => 20,
            'api_called_at' => current_time('mysql')
        ]), 3600);
        
        // Make blocking API call
        $response = wp_remote_post($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($request_body),
            'timeout' => 300,  // 5 minutes max
            'blocking' => true,
            'sslverify' => true
        ]);
        
        if (is_wp_error($response)) {
            error_log('API Error for job ' . $job_id . ': ' . $response->get_error_message());
            // Store error (preserve user_id)
            set_transient($job_id . '_meta', array_merge($meta, [
                'status' => 'failed',
                'error' => $response->get_error_message(),
                'completed_at' => current_time('mysql')
            ]), 3600);
            wp_die();
        }
        
        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        
        error_log('API Response for job ' . $job_id . ': Status ' . $status_code);
        
        if ($status_code === 200) {
            $response_data = json_decode($body, true);
            
            // Store results
            set_transient($job_id . '_results', $response_data, 3600);
            
            // Update metadata (preserve user_id and other fields)
            set_transient($job_id . '_meta', array_merge($meta, [
                'status' => 'completed',
                'completed_at' => current_time('mysql'),
                'progress' => 100
            ]), 3600);
            
            error_log('Job completed successfully: ' . $job_id);
        } else {
            error_log('API returned error for job ' . $job_id . ': ' . $body);
            // Store error (preserve user_id)
            set_transient($job_id . '_meta', array_merge($meta, [
                'status' => 'failed',
                'error' => 'API returned status ' . $status_code,
                'response_body' => $body,
                'completed_at' => current_time('mysql')
            ]), 3600);
        }
        
        wp_die();
    }
}

// Legacy background hook (kept for compatibility)
add_action('fetch_keyword_job_results', 'fetch_keyword_job_results_handler', 10, 3);

if (!function_exists('fetch_keyword_job_results_handler')) {
    function fetch_keyword_job_results_handler($job_id, $api_url, $request_body) {
        // Get existing metadata to preserve user_id and other fields
        $existing_meta = get_transient($job_id . '_meta');
        if ($existing_meta === false) {
            error_log('fetch_keyword_job_results_handler: Job metadata not found for ' . $job_id);
            return;
        }
        
        // Make blocking API call
        $response = wp_remote_post($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($request_body),
            'timeout' => 300,  // 5 minutes max
            'blocking' => true,
            'sslverify' => true
        ]);
        
        if (is_wp_error($response)) {
            // Store error (preserve user_id)
            set_transient($job_id . '_meta', array_merge($existing_meta, [
                'status' => 'failed',
                'error' => $response->get_error_message(),
                'completed_at' => current_time('mysql')
            ]), 3600);
            return;
        }
        
        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        
        if ($status_code === 200) {
            $response_data = json_decode($body, true);
            
            // Store results
            set_transient($job_id . '_results', $response_data, 3600);
            
            // Update metadata (preserve user_id and other fields)
            set_transient($job_id . '_meta', array_merge($existing_meta, [
                'status' => 'completed',
                'completed_at' => current_time('mysql'),
                'progress' => 100
            ]), 3600);
        } else {
            // Store error (preserve user_id)
            set_transient($job_id . '_meta', array_merge($existing_meta, [
                'status' => 'failed',
                'error' => 'API returned status ' . $status_code,
                'response_body' => $body,
                'completed_at' => current_time('mysql')
            ]), 3600);
        }
    }
}

// AJAX handler for checking keyword job status
add_action('wp_ajax_check_keyword_job_status', 'check_keyword_job_status_handler');
add_action('wp_ajax_nopriv_check_keyword_job_status', 'check_keyword_job_status_handler');

if (!function_exists('check_keyword_job_status_handler')) {
    function check_keyword_job_status_handler() {
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        $job_id = isset($_GET['job_id']) ? sanitize_text_field($_GET['job_id']) : '';
        
        if (empty($job_id)) {
            wp_send_json_error(['message' => 'Missing job_id'], 400);
            wp_die();
        }
        
        // Get job metadata
        $meta = get_transient($job_id . '_meta');
        
        if ($meta === false) {
            wp_send_json_error(['message' => 'Job not found or expired'], 404);
            wp_die();
        }
        
        // Verify user owns this job (convert both to int for proper comparison)
        $job_user_id = intval($meta['user_id']);
        $current_user_id = intval(get_current_user_id());
        
        if ($job_user_id !== $current_user_id) {
            error_log('Job ownership mismatch: job_user_id=' . $job_user_id . ', current_user_id=' . $current_user_id);
            wp_send_json_error(['message' => 'Unauthorized access to job'], 403);
            wp_die();
        }
        
        wp_send_json_success($meta);
        wp_die();
    }
}

// AJAX handler for getting keyword job results
add_action('wp_ajax_get_keyword_job_results', 'get_keyword_job_results_handler');
add_action('wp_ajax_nopriv_get_keyword_job_results', 'get_keyword_job_results_handler');

if (!function_exists('get_keyword_job_results_handler')) {
    function get_keyword_job_results_handler() {
        if (!is_user_logged_in()) {
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        $job_id = isset($_GET['job_id']) ? sanitize_text_field($_GET['job_id']) : '';
        
        if (empty($job_id)) {
            wp_send_json_error(['message' => 'Missing job_id'], 400);
            wp_die();
        }
        
        // Get job metadata to verify ownership
        $meta = get_transient($job_id . '_meta');
        
        if ($meta === false) {
            wp_send_json_error(['message' => 'Job not found or expired'], 404);
            wp_die();
        }
        
        // Verify user owns this job (convert both to int for proper comparison)
        $job_user_id = intval($meta['user_id']);
        $current_user_id = intval(get_current_user_id());
        
        if ($job_user_id !== $current_user_id) {
            error_log('Job ownership mismatch: job_user_id=' . $job_user_id . ', current_user_id=' . $current_user_id);
            wp_send_json_error(['message' => 'Unauthorized access to job'], 403);
            wp_die();
        }
        
        if ($meta['status'] !== 'completed') {
            wp_send_json_error(['message' => 'Job not completed yet'], 400);
            wp_die();
        }
        
        // Get results
        $results = get_transient($job_id . '_results');
        
        if ($results === false) {
            wp_send_json_error(['message' => 'Results not found'], 404);
            wp_die();
        }
        
        // Clean up transients after fetching
        delete_transient($job_id . '_meta');
        delete_transient($job_id . '_results');
        
        wp_send_json_success($results);
        wp_die();
    }
}

// AJAX handler for retrieving campaign keywords/targets
add_action('wp_ajax_get_campaign_targets', 'get_campaign_targets_handler');
add_action('wp_ajax_nopriv_get_campaign_targets', 'get_campaign_targets_handler');

if (!function_exists('get_campaign_targets_handler')) {
    function get_campaign_targets_handler() {
        error_log('Get Campaign Targets: Handler called');

        // Verify user is logged in
        if (!is_user_logged_in()) {
            error_log('Get Campaign Targets: User not logged in');
            wp_send_json_error(['message' => 'Unauthorized'], 401);
            wp_die();
        }

        // Get POST data
        $raw_input = file_get_contents('php://input');
        error_log('Get Campaign Targets: Raw input = ' . $raw_input);

        $payload = json_decode($raw_input, true);
        error_log('Get Campaign Targets: Decoded payload = ' . print_r($payload, true));

        if (!$payload) {
            error_log('Get Campaign Targets: Invalid JSON payload');
            wp_send_json_error(['message' => 'Invalid JSON payload'], 400);
            wp_die();
        }

        // Validate required fields
        if (!isset($payload['user_id']) || !isset($payload['kdp_profile']) || 
            !isset($payload['campaign_id']) || !isset($payload['adgroups'])) {
            error_log('Get Campaign Targets: Missing required fields');
            wp_send_json_error([
                'message' => 'Missing required fields: user_id, kdp_profile, campaign_id, and adgroups are required'
            ], 400);
            wp_die();
        }

        // Validate adgroups is an array
        if (!is_array($payload['adgroups']) || empty($payload['adgroups'])) {
            error_log('Get Campaign Targets: adgroups must be a non-empty array');
            wp_send_json_error(['message' => 'adgroups must be a non-empty array'], 400);
            wp_die();
        }

        error_log('Get Campaign Targets: All fields valid, calling API');

        // Build API URL
        $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/campaign/keywords/list';

        $response = wp_remote_post($api_url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($payload),
            'timeout' => 30,
            'sslverify' => true
        ]);

        if (is_wp_error($response)) {
            error_log('Get Campaign Targets: WP Error - ' . $response->get_error_message());
            wp_send_json_error([
                'message' => 'Error fetching campaign targets: ' . $response->get_error_message()
            ], 500);
            wp_die();
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        error_log('Get Campaign Targets: API Status = ' . $status_code);
        error_log('Get Campaign Targets: API Response length = ' . strlen($body));

        if ($status_code === 200) {
            $response_data = json_decode($body, true);
            error_log('Get Campaign Targets: Successfully retrieved ' . (is_array($response_data) ? count($response_data) : 0) . ' targets');

            // Process the response to translate match types for ASINs
            if (is_array($response_data)) {
                foreach ($response_data as &$target) {
                    if (isset($target['target_type']) && $target['target_type'] === 'product') {
                        // Translate ASIN match types
                        if (isset($target['match_type'])) {
                            if ($target['match_type'] === 'ASIN_SAME_AS') {
                                $target['match_type_display'] = 'EXACT';
                            } elseif ($target['match_type'] === 'ASIN_EXPANDED_FROM') {
                                $target['match_type_display'] = 'EXPANDED';
                            } else {
                                $target['match_type_display'] = $target['match_type'];
                            }
                        }
                    } else {
                        // For keywords, use the original match type
                        $target['match_type_display'] = isset($target['match_type']) ? $target['match_type'] : '';
                    }
                }
            }

            wp_send_json_success([
                'targets' => $response_data
            ]);
        } else {
            error_log('Get Campaign Targets: API returned error status ' . $status_code);
            error_log('Get Campaign Targets: Error response = ' . $body);
            wp_send_json_error([
                'message' => 'Failed to fetch campaign targets',
                'status' => $status_code,
                'response' => $body
            ], $status_code);
        }
        wp_die();
    }
}

// ===========================================
// AJAX Handlers for Books Management
// ===========================================

/**
 * AJAX handler for listing books from Amazon Ads API
 */
add_action('wp_ajax_list_books', 'list_books_handler');
add_action('wp_ajax_nopriv_list_books', 'list_books_handler');

if (!function_exists('list_books_handler')) {
    function list_books_handler() {
        // Get JSON input
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        
        $user_id = isset($data['user_id']) ? sanitize_text_field($data['user_id']) : '';
        $kdp_profile = isset($data['kdp_profile']) ? sanitize_text_field($data['kdp_profile']) : '';
        
        if (empty($user_id) || empty($kdp_profile)) {
            wp_send_json_error(['error' => 'Missing required parameters']);
            wp_die();
        }
        
        try {
            // Call the API
            $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/books/list';
            $response = wp_remote_post($api_url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    'user_id' => $user_id,
                    'kdp_profile' => $kdp_profile
                ]),
                'timeout' => 120
            ]);
            
            if (is_wp_error($response)) {
                wp_send_json_error(['error' => 'API request failed: ' . $response->get_error_message()]);
                wp_die();
            }
            
            $body = wp_remote_retrieve_body($response);
            $result = json_decode($body, true);
            
            if (isset($result['error'])) {
                wp_send_json_error(['error' => $result['error']]);
                wp_die();
            }
            
            wp_send_json_success($result);
            
        } catch (Exception $e) {
            wp_send_json_error(['error' => 'Failed to fetch books: ' . $e->getMessage()]);
        }
        wp_die();
    }
}

/**
 * AJAX handler for getting saved books from Firestore
 */
add_action('wp_ajax_get_books', 'get_books_handler');
add_action('wp_ajax_nopriv_get_books', 'get_books_handler');

if (!function_exists('get_books_handler')) {
    function get_books_handler() {
        // Get JSON input
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        
        $user_id = isset($data['user_id']) ? sanitize_text_field($data['user_id']) : '';
        $kdp_profile = isset($data['kdp_profile']) ? sanitize_text_field($data['kdp_profile']) : '';
        
        if (empty($user_id) || empty($kdp_profile)) {
            wp_send_json_error(['error' => 'Missing required parameters']);
            wp_die();
        }
        
        try {
            // Call the API
            $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/books/get';
            $response = wp_remote_post($api_url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    'user_id' => $user_id,
                    'kdp_profile' => $kdp_profile
                ]),
                'timeout' => 30
            ]);
            
            if (is_wp_error($response)) {
                wp_send_json_error(['error' => 'API request failed: ' . $response->get_error_message()]);
                wp_die();
            }
            
            $body = wp_remote_retrieve_body($response);
            $result = json_decode($body, true);
            
            if (isset($result['error'])) {
                wp_send_json_error(['error' => $result['error']]);
                wp_die();
            }
            
            wp_send_json_success($result);
            
        } catch (Exception $e) {
            wp_send_json_error(['error' => 'Failed to fetch saved books: ' . $e->getMessage()]);
        }
        wp_die();
    }
}

/**
 * AJAX handler for saving books with royalties
 */
add_action('wp_ajax_save_books', 'save_books_handler');
add_action('wp_ajax_nopriv_save_books', 'save_books_handler');

if (!function_exists('save_books_handler')) {
    function save_books_handler() {
        // Get JSON input
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        
        $user_id = isset($data['user_id']) ? sanitize_text_field($data['user_id']) : '';
        $kdp_profile = isset($data['kdp_profile']) ? sanitize_text_field($data['kdp_profile']) : '';
        $books = isset($data['books']) ? $data['books'] : [];
        
        if (empty($user_id) || empty($kdp_profile) || empty($books)) {
            wp_send_json_error(['error' => 'Missing required parameters']);
            wp_die();
        }
        
        try {
            // Call the API
            $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/books/save';
            $response = wp_remote_post($api_url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    'user_id' => $user_id,
                    'kdp_profile' => $kdp_profile,
                    'books' => $books
                ]),
                'timeout' => 60
            ]);
            
            if (is_wp_error($response)) {
                wp_send_json_error(['error' => 'API request failed: ' . $response->get_error_message()]);
                wp_die();
            }
            
            $body = wp_remote_retrieve_body($response);
            $result = json_decode($body, true);
            
            if (isset($result['error'])) {
                wp_send_json_error(['error' => $result['error']]);
                wp_die();
            }
            
            wp_send_json_success($result);
            
        } catch (Exception $e) {
            wp_send_json_error(['error' => 'Failed to save books: ' . $e->getMessage()]);
        }
        wp_die();
    }
}

/**
 * AJAX handler for getting money wasters from Pulse endpoint
 */
add_action('wp_ajax_pulse_money_wasters', 'pulse_money_wasters_handler');
add_action('wp_ajax_nopriv_pulse_money_wasters', 'pulse_money_wasters_handler');

if (!function_exists('pulse_money_wasters_handler')) {
    function pulse_money_wasters_handler() {
        // Get JSON input
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        
        $user_id = isset($data['user_id']) ? sanitize_text_field($data['user_id']) : '';
        $kdp_profile = isset($data['kdp_profile']) ? sanitize_text_field($data['kdp_profile']) : '';
        
        if (empty($user_id) || empty($kdp_profile)) {
            wp_send_json_error(['error' => 'Missing required parameters: user_id and kdp_profile']);
            wp_die();
        }
        
        try {
            // Call the Pulse API endpoint
            $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/pulse/search-terms/money-wasters';
            $response = wp_remote_post($api_url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    'user_id' => $user_id,
                    'kdp_profile' => $kdp_profile
                ]),
                'timeout' => 60
            ]);
            
            if (is_wp_error($response)) {
                wp_send_json_error(['error' => 'API request failed: ' . $response->get_error_message()]);
                wp_die();
            }
            
            $body = wp_remote_retrieve_body($response);
            $result = json_decode($body, true);
            
            // Check if the response contains an error
            if (isset($result['error'])) {
                wp_send_json_error(['error' => $result['error']]);
                wp_die();
            }
            
            // Return the money wasters data (expecting an array)
            wp_send_json_success($result);
            
        } catch (Exception $e) {
            wp_send_json_error(['error' => 'Failed to fetch money wasters: ' . $e->getMessage()]);
        }
        wp_die();
    }
}

/**
 * AJAX handler for getting account summary from Pulse endpoint
 */
add_action('wp_ajax_pulse_account_summary', 'pulse_account_summary_handler');
add_action('wp_ajax_nopriv_pulse_account_summary', 'pulse_account_summary_handler');

if (!function_exists('pulse_account_summary_handler')) {
    function pulse_account_summary_handler() {
        // Get JSON input
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        
        $user_id = isset($data['user_id']) ? sanitize_text_field($data['user_id']) : '';
        $kdp_profile = isset($data['kdp_profile']) ? sanitize_text_field($data['kdp_profile']) : '';
        $language = isset($data['language']) ? sanitize_text_field($data['language']) : 'EN';
        
        if (empty($user_id) || empty($kdp_profile)) {
            wp_send_json_error(['error' => 'Missing required parameters: user_id and kdp_profile']);
            wp_die();
        }
        
        try {
            // Call the Pulse API endpoint
            $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/pulse/account-summary';
            
            $request_body = [
                'user_id' => $user_id,
                'kdp_profile' => $kdp_profile,
                'language' => $language
            ];
            
            // Add optional date filters if provided
            if (isset($data['date_from']) && !empty($data['date_from'])) {
                $request_body['date_from'] = sanitize_text_field($data['date_from']);
            }
            if (isset($data['date_to']) && !empty($data['date_to'])) {
                $request_body['date_to'] = sanitize_text_field($data['date_to']);
            }
            
            $response = wp_remote_post($api_url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($request_body),
                'timeout' => 60
            ]);
            
            if (is_wp_error($response)) {
                wp_send_json_error(['error' => 'API request failed: ' . $response->get_error_message()]);
                wp_die();
            }
            
            $body = wp_remote_retrieve_body($response);
            $result = json_decode($body, true);
            
            // Check if the response contains an error
            if (isset($result['error'])) {
                wp_send_json_error(['error' => $result['error']]);
                wp_die();
            }
            
            // Return the account summary data
            wp_send_json_success($result);
            
        } catch (Exception $e) {
            wp_send_json_error(['error' => 'Failed to fetch account summary: ' . $e->getMessage()]);
        }
        wp_die();
    }
}

/**
 * AJAX handler for getting spend effectiveness from Pulse endpoint
 */
add_action('wp_ajax_pulse_spend_effectiveness', 'pulse_spend_effectiveness_handler');
add_action('wp_ajax_nopriv_pulse_spend_effectiveness', 'pulse_spend_effectiveness_handler');

if (!function_exists('pulse_spend_effectiveness_handler')) {
    function pulse_spend_effectiveness_handler() {
        // Get JSON input
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        
        $user_id = isset($data['user_id']) ? sanitize_text_field($data['user_id']) : '';
        $kdp_profile = isset($data['kdp_profile']) ? sanitize_text_field($data['kdp_profile']) : '';
        $language = isset($data['language']) ? sanitize_text_field($data['language']) : 'EN';
        
        if (empty($user_id) || empty($kdp_profile)) {
            wp_send_json_error(['error' => 'Missing required parameters: user_id and kdp_profile']);
            wp_die();
        }
        
        try {
            // Call the Pulse API endpoint
            $api_url = 'https://ads-optimizer-api-1044931876531.europe-west1.run.app/pulse/spend-effectiveness';
            
            $request_body = [
                'user_id' => $user_id,
                'kdp_profile' => $kdp_profile,
                'language' => $language
            ];
            
            $response = wp_remote_post($api_url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($request_body),
                'timeout' => 60
            ]);
            
            if (is_wp_error($response)) {
                wp_send_json_error(['error' => 'API request failed: ' . $response->get_error_message()]);
                wp_die();
            }
            
            $body = wp_remote_retrieve_body($response);
            $result = json_decode($body, true);
            
            // Check if the response contains an error
            if (isset($result['error'])) {
                wp_send_json_error(['error' => $result['error']]);
                wp_die();
            }
            
            // Return the spend effectiveness data
            wp_send_json_success($result);
            
        } catch (Exception $e) {
            wp_send_json_error(['error' => 'Failed to fetch spend effectiveness: ' . $e->getMessage()]);
        }
        wp_die();
    }
}
