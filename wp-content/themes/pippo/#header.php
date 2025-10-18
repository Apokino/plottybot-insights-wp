<?php

	/* Template Name: Header */

	require_once("pb-components.php"); // RG-WEBDEV: Nuovo

    // UNCOMMENTED: Language and currency logic restored
	$affiliate_url = "";
	$utm_url = "";
    $pro_url = "";

	// Verifica se l'utente non è loggato
	if (!is_user_logged_in()) {

		// Recupera la lingua del browser dell'utente
		$serverLang = 'en_US';

		if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			$serverLang = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE'])[0]; // Prendi solo la prima lingua
		}

		$browser_language = substr($serverLang, 0, 2);
		$user_currency = 'eur';

		// Imposta la lingua in base a quella del browser
		switch ($browser_language) {
			case 'it':
				switch_to_locale('it_IT'); // Italiano
				$user_currency = 'eur';
				$currency_change = 1;
				break;

			case 'en':
				if (stripos($serverLang, 'en-GB') !== false) {
					switch_to_locale('en_US');
					$user_currency = 'gbp';
					$currency_change = get_user_meta(1, 'eur_to_gbp', true);
				} elseif (stripos($serverLang, 'en-IE') !== false) {
					switch_to_locale('en_US');
					$user_currency = 'eur';
					$currency_change = 1;
				} else {
					switch_to_locale('en_US');
					$user_currency = 'usd';
					$currency_change = get_user_meta(1, 'eur_to_usd', true);
				}
				break;
			default:
				switch_to_locale('en_US');
				$user_currency = 'eur';
				$currency_change = 1;
				break;
		}

		// Visualizza contenuto dinamico in base alla lingua attuale
		$user_language = get_locale();

		// cerca parametro affiliate
		$affiliate_param = isset($_GET['link']) ? htmlspecialchars($_GET['link']) : '';

		$GLOBALS["affiliate_url"] = "";

		if ($affiliate_param) {
			$GLOBALS["affiliate_url"] = "?link=" . $affiliate_param;
		}

		global $affiliate_url;

		// parametro utm (ads)
		$GLOBALS["utm_param"] = isset($_GET['utm_source']) ? htmlspecialchars($_GET['utm_source']) : '';

		global $utm_param;

		$GLOBALS["utm_url"] = "";

		if ($utm_param) {
			$GLOBALS["utm_url"] = "?utm_source=" . $utm_param;
		}

		global $utm_url;

        // parametro pb-pro (newsletter)
		$GLOBALS["pro_param"] = isset($_GET['pb-pro']) ? htmlspecialchars($_GET['pb-pro']) : '';

		global $pro_param;

		$GLOBALS["pro_url"] = "";

		if ($pro_param) {
			$GLOBALS["pro_url"] = "?pb-pro=true";
		}

		global $pro_url;

		// ridirigi al login
		if (!is_front_page() && !is_page(array(3, 4238, 967, 970, 1012, 5031, 2520, 7986))) {

			// Ottieni l'URL corrente
			global $wp;

			$current_url = home_url(add_query_arg(array(), $wp->request));

			// Verifica se l'URL corrente è quello della pagina di recupero password
			if (strpos($current_url, 'lost-password') === false) {

				$redirect = "/login/" . $affiliate_url . $utm_url . $pro_url;
				// Redirect alla pagina di login
				wp_redirect(site_url($redirect));

				exit;

			}

		}

	}

	// Imposta le variabili globali in base alla lingua e alla valuta
	$GLOBALS["user_language"] = $user_language;
	$GLOBALS["user_currency"] = $user_currency;

	$all_currencies = ["eur", "usd", "gbp"];

	$GLOBALS["currency_change"] = $currency_change;
	$GLOBALS["eng"] = $user_language == 'en_US';
	$GLOBALS["ita"] = $user_language == 'it_IT';

	global $eng, $ita, $user_currency, $currency_change;


?>

<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Vibur&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"><!-- RG-WEBDEV -->
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"><!-- RG-WEBDEV -->
		<link rel="icon" type="image/gif" href="https://plottybot.com/img/favicon.gif" id="icon"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script defer src="https://cloud.umami.is/script.js" data-website-id="b687a72d-1ab5-475f-b27f-5e47bb26daaf"></script>


		<?php
			wp_head();
		?>
	</head>
	<body <?php body_class(); ?>>

		<?php wp_body_open(); ?>

		<header id="masthead" class="site-header">
			<div class="site-branding">
				<!-- <p class="site-title big"><a href="<?php echo esc_url(home_url($affiliate_url . $utm_url . $pro_url)); ?>" rel="home"><span class="icon-logo title-logo gradient"></span></a></p> RG-WEBDEV: Rimosso -->
				<a href="<?php echo esc_url(home_url($affiliate_url . $utm_url . $pro_url)); ?>" rel="home" style="text-decoration: none;"><span class="icon-logo icon--sm logo--black"></span></a>
				<?php
					$pippo_description = get_bloginfo('description', 'display');
					if ($pippo_description || is_customize_preview()) :
				?>
						<p class="site-description"><?php echo $pippo_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
			</div>
			<!-- .site-branding -->
			<!--
			<nav id="site-navigation" class="main-navigation dark">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'pippo'); ?></button>
				<div class="menu-menu-1-container">
					<ul id="primary-menu" class="menu nav-menu">
						<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-99">
							<a href="https://plottybot.com/write/<?php echo $affiliate_url . $utm_url . $pro_url; ?>" class="nav-gradient">
								<?php if ($ita) { echo "Scrivi"; } else { echo "Write"; } ?>
							</a>
						</li>
						<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-99">
								<a href="https://plottybot.com/pricing/<?php echo $affiliate_url . $utm_url . $pro_url; ?>">
									<?php if ($ita) { echo "Come funziona"; } else { echo "How it works"; } ?>
							</a>
						</li>
						<?php if (is_user_logged_in()) { ?>
						<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-99">
							<a href="#">
								<img class="flag" src="https://plottybot.com/img/flags/<?php if ($ita) { echo "ita"; } else { echo "usa"; } ?>.png"><span class="navigation-text"><?php if ($ita) { echo "Italiano"; } else { echo "English"; } ?></span>
							</a>
							<!- Sottomenù per la seconda lingua ->
							<ul class="dropdown-menu">
								<li>
									<a class="change-flag" lang="<?php if ($ita) { echo "en_US"; } else { echo "it_IT"; } ?>" href="#">
										<img class="flag" src="https://plottybot.com/img/flags/<?php if ($ita) { echo "usa"; } else { echo "ita"; } ?>.png">
										<span class="navigation-text"><?php if ($ita) { echo "English"; } else { echo "Italiano"; } ?></span>
									</a>
								</li>
							</ul>
							</li>
							<?php if (is_user_logged_in()) { // RG-WEBDEV: Modificato 31052025 ?>
								<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-99">
									<a href="#">
										<img class="currency" src="https://plottybot.com/img/currencies/<?php echo $user_currency; ?>.png"><span class="navigation-text"><?php echo strtoupper($user_currency); ?></span>
									</a>
									<!- Sottomenù per la seconda lingua ->
									<ul class="dropdown-menu">
										<?php
											foreach ($all_currencies as $this_currency) {
												if ($this_currency !== $user_currency) {
										?>
										<li>
											<a class="change-currency" currency="<?php echo $this_currency; ?>" href="#">
												<img class="currency" src="https://plottybot.com/img/currencies/<?php echo $this_currency; ?>.png">
												<span class="navigation-text"><?php echo strtoupper($this_currency); ?></span>
											</a>
										</li>
										<?php
												}
											}
										?>
									</ul>
								</li>
							<?php } ?>
						<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-99">
							<a href="https://plottybot.com/account/">
								<span class="icon-circle-user"></span><span class="navigation-text">Account</span>
							</a>
						</li>
						<?php } else { ?>
						<li class="login_button menu-item menu-item-type-post_type menu-item-object-page menu-item-99">
							<a class="gradient" href="https://plottybot.com/login/<?php echo $affiliate_url . $utm_url . $pro_url; ?>">
								Login
							</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</nav><!- #site-navigation -->
			<nav id="site-navigation" class="main-navigation dark">
				<button class="button button--tertiary button--md menu-toggle pb-icon__before--hamburger-menu-l-black" aria-controls="primary-menu" aria-expanded="false"><?php // esc_html_e('Primary Menu', 'pippo'); ?></button>
				<div class="menu-menu-1-container">
					<span id="close-mobile-modal" class="pb-icon__before--close-l-black" style="display: none;"></span>
					<ul id="primary-menu" class="menu nav-menu<?php echo (wp_is_mobile()) ? "icon-logo icon--sm logo--black" : ""; ?>">
						<li class="menu-item language-menu menu-item-type-post_type menu-item-object-page menu-item-99">
							<!-- <a href="https://plottybot.com/write/<?php echo $affiliate_url . $utm_url . $pro_url; ?>" class="nav-gradient"> RG-WEBDEV: Modificato -->
							<a href="https://plottybot.com/write/<?php echo $affiliate_url . $utm_url . $pro_url; ?>">
								<?php // if ($eng) { echo "Write"; } elseif ($ita) { echo "Scrivi"; } RG-WEBDEV: Modificato ?>
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M10 16.6667H17.5M13.6467 3.01833C13.9784 2.68658 14.4284 2.50021 14.8975 2.50021C15.3667 2.50021 15.8166 2.68658 16.1483 3.01833C16.4801 3.35007 16.6665 3.80001 16.6665 4.26916C16.6665 4.73831 16.4801 5.18825 16.1483 5.51999L6.14001 15.5292C5.94175 15.7274 5.69669 15.8724 5.42751 15.9508L3.03417 16.6492C2.96247 16.6701 2.88646 16.6713 2.8141 16.6528C2.74174 16.6343 2.6757 16.5966 2.62288 16.5438C2.57006 16.491 2.53241 16.4249 2.51388 16.3526C2.49534 16.2802 2.49659 16.2042 2.51751 16.1325L3.21584 13.7392C3.29436 13.4703 3.43938 13.2255 3.63751 13.0275L13.6467 3.01833Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
								<?php if ($ita) { echo "Scrivi"; } else { echo "Write"; } ?>
							</a>
						</li>
						<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-99">
							<a href="https://plottybot.com/pricing/<?php echo $affiliate_url . $utm_url . $pro_url; ?>">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g clip-path="url(#clip0_751_83)">
										<path d="M9.99999 13.3333V10M9.99999 6.66667H10.0083M3.20833 7.18333C3.08669 6.63544 3.10537 6.0657 3.26262 5.52695C3.41988 4.9882 3.71062 4.49787 4.10788 4.10143C4.50515 3.705 4.99608 3.41529 5.53517 3.25916C6.07425 3.10304 6.64402 3.08555 7.19166 3.20833C7.49308 2.73692 7.90833 2.34897 8.39912 2.08024C8.88991 1.81151 9.44045 1.67065 9.99999 1.67065C10.5595 1.67065 11.1101 1.81151 11.6009 2.08024C12.0917 2.34897 12.5069 2.73692 12.8083 3.20833C13.3568 3.08502 13.9276 3.10242 14.4675 3.25893C15.0074 3.41543 15.499 3.70595 15.8965 4.10346C16.294 4.50097 16.5846 4.99256 16.7411 5.5325C16.8976 6.07244 16.915 6.64319 16.7917 7.19167C17.2631 7.49309 17.651 7.90834 17.9198 8.39913C18.1885 8.88992 18.3293 9.44046 18.3293 10C18.3293 10.5595 18.1885 11.1101 17.9198 11.6009C17.651 12.0917 17.2631 12.5069 16.7917 12.8083C16.9144 13.356 16.897 13.9257 16.7408 14.4648C16.5847 15.0039 16.295 15.4948 15.8986 15.8921C15.5021 16.2894 15.0118 16.5801 14.473 16.7374C13.9343 16.8946 13.3646 16.9133 12.8167 16.7917C12.5156 17.2649 12.1001 17.6545 11.6084 17.9244C11.1168 18.1944 10.565 18.3359 10.0042 18.3359C9.4433 18.3359 8.89151 18.1944 8.39989 17.9244C7.90826 17.6545 7.49269 17.2649 7.19166 16.7917C6.64402 16.9144 6.07425 16.897 5.53517 16.7408C4.99608 16.5847 4.50515 16.295 4.10788 15.8986C3.71062 15.5021 3.41988 15.0118 3.26262 14.4731C3.10537 13.9343 3.08669 13.3646 3.20833 12.8167C2.73329 12.516 2.342 12.1001 2.07087 11.6077C1.79973 11.1152 1.65755 10.5622 1.65755 10C1.65755 9.43783 1.79973 8.88479 2.07087 8.39232C2.342 7.89986 2.73329 7.48396 3.20833 7.18333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</g>
									<defs>
										<clipPath id="clip0_751_83">
											<rect width="20" height="20" fill="white"/>
										</clipPath>
									</defs>
								</svg>
								<?php if ($ita) { echo "Come funziona"; } else { echo "How it works"; } ?>
							</a>
						</li>
						<!-- <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-99">
							<a class="chat">
								<?php if ($ita) { echo "Assistenza"; } else { echo "Help"; } ?>
							</a>
						</li> RG-WEBDEV: Rimosso -->
						<?php if (is_user_logged_in()) { ?>
						<?php if (!wp_is_mobile()) { ?>
						<li class="menu-item language-menu menu-item-type-post_type menu-item-object-page menu-item-99">
							<a href="#">
								<!-- <img class="flag" src="https://plottybot.com/img/flags/<?php if ($ita) { echo "ita"; } else { echo "usa"; } ?>.png"><span class="navigation-text"><?php if ($ita) { echo "Italiano"; } else { echo "English"; } ?></span> RG-WEBDEV -->
								<?php
									if ($ita) {
								?>
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									<rect width="20" height="20" fill="url(#pattern0_76_1029)"/>
									<defs>
									<pattern id="pattern0_76_1029" patternContentUnits="objectBoundingBox" width="1" height="1">
									<use xlink:href="#image0_76_1029" transform="scale(0.0104167)"/>
									</pattern>
									<image id="image0_76_1029" width="96" height="96" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAAFcUlEQVR4nO2dS2zcRBjH/0H0QcuFtDxUaAuquPTAJTQzmziN+i6HqlAICAnBoWg9SV9QENdeQZwCAZS2mWkjceGAEBJUlIcocC0tEgltoUTpi4cdexwuPASDvJugKhCStb3rx34/6bsku17t/7czHq+9nwGCIAiCIAiCIIgMMTk5udzx/Y2Op/tcPxhwveAjxw/Oul5w0fGCCcfTv1UrmKj8zQ/OOl7wYfjY8Dnhc8NtpP0+csOlS+amCa23uZ5+2fWCM46n/3L9wMSpyja84Exlm1pvDV8j7feZORyt2xxf9zueduMGPqcQPwhcXw+7Wm82xrSgWXlKdS8WQ6zX8fVovUOfXYYeNV0QZjsWoVnY1799UVmyg0Lya0LxVIK/vkwXwrpqLDxr1mIhikxZ8h1Csu/C4KfLzYaA6Ro3nXgSRaNPrbtDKP7O9cFnVICZqhOG404UAXuo9Lgtmfdf4YvsCghrwqzHo8grhw5132gr/uJswedAgJmqwdztG/YcX7dMSPbFXOGLfAgI63PD0Yo80He0tFpI9s18whf5EWCMhVHTiVXIMrZk9wrJrsw3fJEnAVUJl00H1iCL9Mr7VwrJx2oJX+RNQFXCJdONu5ElyoNty23Fvq01fJFHAdU6bzZhGbJAebBtgS35J1HCF/kVEI6EzzKxOhKSH44avsizgGq9nm74ij0cJ3yRfwFhPZZK+OXjnav+7wi3iQR4pgsrGy5AKPZu3PBFMQSE9X5Dw7eH2h9JInxRHAHGdOKhxp1IUfwyCcBMCeMNObEjFHsuqfBFkUZAWOtxoK7h9w1032wr9jMJwGzHBj+aLVhaNwFCsf1Jhi+KNgKqEvrqk75Bi63YORKAuQRcMMANiecvjrEHkg5fFHEEVGtr4gJsxd4kAZivgOOJhl8ebFtiK/YLCcB8BUwajuSuwOtVpQfrEb4o7hQUHpjtSEyAUPw1EoBaJbySpIALJAC1LkdHkwl/uHRbvcIXRZ6CwkrirJmQpW0kANEEWNgUW4Ct+AskAFFHwfMJCGBDJABRBRyOLUAofpIEIKqAE/FHgOSjJABRBXydgAD2EwlA1J3wtdgChGKTJABRBej4I0CxP0gAok5Bv5MAP+cCaApCylMQ7YRNqjthWoYi7WUo/4B2wkjvijkh2VESgKgCBuOPAPoyzsTYBxyML0CyLTQCEFXCxtgC9g1Zt5IARBOQ1E9bbcnP0xkx1CpgJJHwqwLYAAlArQL6ExTQvpMEIL3LUqZ+E6DppDzmKyBI9MKsEFvyYRKA+QqQSJreY+1bSQAadzXEvzBoqaUJRxNfF3TOAPVpBmhLvpcEYC4BAvXiieH7lib99bRbpBFg4QfThiWoJ0LxZ0gAZpOwF/WmsiSVbJxGAGZ++sca1n+0LNkuEoCZn/6daCTUqgDptSqY7pBFzToQhj+RSrOOpKYiN/+roHTa1UwjJHujaQVYeBWZaFmm+MdNJ8DCqUy0LPunUWvE35G5+RRwLnONXJ8+3H6XkPz7JhAwbkpYjSxSPtaxptZeQm6+BIybLtyDLLPnaMcKW/KvCihgJLXlZq3sPsJbhWSnCiTgU2PhFuSJQrWvb8MC5JVeVeqxJXdzJ8CCY9ZjF4rA7iPsdiHZ27kRYOE904EVKBq9Q3yzUHwkswIsXDAWelBket5au9CW7ICt2NUMCbhiLOzPzJFtw+4nprhwfD2SVvjhazfdjdwycCtDTbcynIWxMbPY1XqL6+mXXC847Xj6z9iBh9vwgtOVbWq9OXyNxn68cozWutXx/Q3OhA6nqn7HC066XvBl9Xa22g1vZet6+tfKyPGCi+H/wsdUHlt5jr8h3Eba74MgCIIgCIIgCALX8TcNaNsO33vf3QAAAABJRU5ErkJggg=="/>
									</defs>
									</svg>
									<span class="navigation-text"><?php echo ($ita) ? "Italiano" : "Italian"; ?></span>
								<?php
									} else {
								?>
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									<rect width="20" height="20" fill="url(#pattern0_76_1034)"/>
									<defs>
									<pattern id="pattern0_76_1034" patternContentUnits="objectBoundingBox" width="1" height="1">
									<use xlink:href="#image0_76_1034" transform="scale(0.0104167)"/>
									</pattern>
									<image id="image0_76_1034" width="96" height="96" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
									</defs>
									</svg>
									<span class="navigation-text"><?php echo ($ita) ? "Italiano" : "Italian"; ?></span>
								<?php
									}
								?>
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top: 2px;">
									<path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
							<!-- Sottomenù per la seconda lingua -->
							<ul class="dropdown-menu">
								<li>
									<a class="change-flag" lang="<?php if ($ita) { echo "en_US"; } else { echo "it_IT"; } ?>" href="#">
										<?php
											if ($ita) {
										?>
											<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
											<rect width="20" height="20" fill="url(#pattern0_76_1034)"/>
											<defs>
											<pattern id="pattern0_76_1034" patternContentUnits="objectBoundingBox" width="1" height="1">
											<use xlink:href="#image0_76_1034" transform="scale(0.0104167)"/>
											</pattern>
											<image id="image0_76_1034" width="96" height="96" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
									</defs>
									</svg>
									<span class="navigation-text"><?php echo ($ita) ? "Inglese" : "English"; ?></span>
								<?php
									}
								?>
							</a>
						</li>
						<?php } else { ?>
						<li class="menu-item language-menu menu-item-type-post_type menu-item-object-page menu-item-99">
							<a href="#">
								<!-- <img class="flag" src="https://plottybot.com/img/flags/<?php if ($ita) { echo "ita"; } else { echo "usa"; } ?>.png"><span class="navigation-text"><?php if ($ita) { echo "Italiano"; } else { echo "English"; } ?></span> RG-WEBDEV -->
								<?php
									if ($ita) {
								?>
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									<rect width="20" height="20" fill="url(#pattern0_76_1029)"/>
									<defs>
									<pattern id="pattern0_76_1029" patternContentUnits="objectBoundingBox" width="1" height="1">
									<use xlink:href="#image0_76_1029" transform="scale(0.0104167)"/>
									</pattern>
									<image id="image0_76_1029" width="96" height="96" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAAFcUlEQVR4nO2dS2zcRBjH/0H0QcuFtDxUaAuquPTAJTQzmziN+i6HqlAICAnBoWg9SV9QENdeQZwCAZS2mWkjceGAEBJUlIcocC0tEgltoUTpi4cdexwuPASDvJugKhCStb3rx34/6bsku17t/7czHq+9nwGCIAiCIAiCIIgMMTk5udzx/Y2Op/tcPxhwveAjxw/Oul5w0fGCCcfTv1UrmKj8zQ/OOl7wYfjY8Dnhc8NtpP0+csOlS+amCa23uZ5+2fWCM46n/3L9wMSpyja84Exlm1pvDV8j7feZORyt2xxf9zueduMGPqcQPwhcXw+7Wm82xrSgWXlKdS8WQ6zX8fVovUOfXYYeNV0QZjsWoVnY1799UVmyg0Lya0LxVIK/vkwXwrpqLDxr1mIhikxZ8h1Csu/C4KfLzYaA6Ro3nXgSRaNPrbtDKP7O9cFnVICZqhOG404UAXuo9Lgtmfdf4YvsCghrwqzHo8grhw5132gr/uJswedAgJmqwdztG/YcX7dMSPbFXOGLfAgI63PD0Yo80He0tFpI9s18whf5EWCMhVHTiVXIMrZk9wrJrsw3fJEnAVUJl00H1iCL9Mr7VwrJx2oJX+RNQFXCJdONu5ElyoNty23Fvq01fJFHAdU6bzZhGbJAebBtgS35J1HCF/kVEI6EzzKxOhKSH44avsizgGq9nm74ij0cJ3yRfwFhPZZK+OXjnav+7wi3iQR4pgsrGy5AKPZu3PBFMQSE9X5Dw7eH2h9JInxRHAHGdOKhxp1IUfwyCcBMCeMNObEjFHsuqfBFkUZAWOtxoK7h9w1032wr9jMJwGzHBj+aLVhaNwFCsf1Jhi+KNgKqEvrqk75Bi63YORKAuQRcMMANiecvjrEHkg5fFHEEVGtr4gJsxd4kAZivgOOJhl8ebFtiK/YLCcB8BUwajuSuwOtVpQfrEb4o7hQUHpjtSEyAUPw1EoBaJbySpIALJAC1LkdHkwl/uHRbvcIXRZ6CwkrirJmQpW0kANEEWNgUW4Ct+AskAFFHwfMJCGBDJABRBRyOLUAofpIEIKqAE/FHgOSjJABRBXydgAD2EwlA1J3wtdgChGKTJABRBej4I0CxP0gAok5Bv5MAP+cCaApCylMQ7YRNqjthWoYi7WUo/4B2wkjvijkh2VESgKgCBuOPAPoyzsTYBxyML0CyLTQCEFXCxtgC9g1Zt5IARBOQ1E9bbcnP0xkx1CpgJJHwqwLYAAlArQL6ExTQvpMEIL3LUqZ+E6DppDzmKyBI9MKsEFvyYRKA+QqQSJreY+1bSQAadzXEvzBoqaUJRxNfF3TOAPVpBmhLvpcEYC4BAvXiieH7lib99bRbpBFg4QfThiWoJ0LxZ0gAZpOwF/WmsiSVbJxGAGZ++sca1n+0LNkuEoCZn/6daCTUqgDptSqY7pBFzToQhj+RSrOOpKYiN/+roHTa1UwjJHujaQVYeBWZaFmm+MdNJ8DCqUy0LPunUWvE35G5+RRwLnONXJ8+3H6XkPz7JhAwbkpYjSxSPtaxptZeQm6+BIybLtyDLLPnaMcKW/KvCihgJLXlZq3sPsJbhWSnCiTgU2PhFuSJQrWvb8MC5JVeVeqxJXdzJ8CCY9ZjF4rA7iPsdiHZ27kRYOE904EVKBq9Q3yzUHwkswIsXDAWelBket5au9CW7ICt2NUMCbhiLOzPzJFtw+4nprhwfD2SVvjhazfdjdwycCtDTbcynIWxMbPY1XqL6+mXXC847Xj6z9iBh9vwgtOVbWq9OXyNxn68cozWutXx/Q3OhA6nqn7HC066XvBl9Xa22g1vZet6+tfKyPGCi+H/wsdUHlt5jr8h3Eba74MgCIIgCIIgCALX8TcNaNsO33vf3QAAAABJRU5ErkJggg=="/>
									</defs>
									</svg>
									<span class="navigation-text"><?php echo ($ita) ? "Italiano" : "Italian"; ?></span>
								<?php
									}
								?>
						</a>
						</li>
						<?php } ?>
						<?php
							// if (current_user_can("administrator")) {

						/*
						?>
						<li class="menu-item currency-menu menu-item-type-post_type menu-item-object-page menu-item-99">
							<a href="#">
								<img class="currency" src="https://plottybot.com/img/currencies/<?php echo $user_currency; ?>.png"><span class="navigation-text"><?php echo strtoupper($user_currency); ?></span>
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top: 2px;">
									<path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
							<ul class="dropdown-menu">
							<?php
								foreach ($all_currencies as $this_currency) {
									if ($this_currency !== $user_currency) {
							?>
								<li>
									<a class="change-currency" currency="<?php echo $this_currency; ?>" href="#">
										<img class="currency" src="https://plottybot.com/img/currencies/<?php echo $this_currency; ?>.png">
										<span class="navigation-text"><?php echo strtoupper($this_currency); ?></span>
									</a>
								</li>

							<?php
									}
								}
							?>
							</ul>
						</li>
						<?php // } */ ?>
						<?php

							if (is_user_logged_in()) { // RG-WEBDEV: Modificato 31052025

						?>

								<li class="menu-item currency-menu menu-item-type-post_type menu-item-object-page menu-item-99">

									<a href="#">

										<!--<img class="currency" src="https://plottybot.com/img/currencies/<?php echo $user_currency; ?>.png">-->

										<?php

											if ($user_currency === "eur") {

												?>

												<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
													<g clip-path="url(#clip0_644_81)">
														<path d="M5.83333 10H10M12.5 7.83333C12.0571 7.31553 11.4662 6.9459 10.8068 6.77421C10.1474 6.60253 9.4512 6.63705 8.81203 6.87312C8.17285 7.10918 7.62137 7.53546 7.23187 8.09454C6.84237 8.65361 6.63355 9.31862 6.63355 10C6.63355 10.6814 6.84237 11.3464 7.23187 11.9055C7.62137 12.4645 8.17285 12.8908 8.81203 13.1269C9.4512 13.363 10.1474 13.3975 10.8068 13.2258C11.4662 13.0541 12.0571 12.6845 12.5 12.1667M3.20833 7.18333C3.0867 6.63544 3.10538 6.0657 3.26263 5.52695C3.41988 4.9882 3.71062 4.49787 4.10789 4.10143C4.50516 3.705 4.99609 3.41529 5.53517 3.25916C6.07425 3.10304 6.64403 3.08555 7.19167 3.20833C7.49309 2.73692 7.90834 2.34897 8.39912 2.08024C8.88991 1.81151 9.44045 1.67065 9.99999 1.67065C10.5595 1.67065 11.1101 1.81151 11.6009 2.08024C12.0917 2.34897 12.5069 2.73692 12.8083 3.20833C13.3568 3.08502 13.9276 3.10242 14.4675 3.25893C15.0074 3.41543 15.499 3.70595 15.8965 4.10346C16.294 4.50097 16.5846 4.99256 16.7411 5.5325C16.8976 6.07244 16.915 6.64319 16.7917 7.19167C17.2631 7.49309 17.651 7.90834 17.9198 8.39913C18.1885 8.88992 18.3293 9.44046 18.3293 10C18.3293 10.5595 18.1885 11.1101 17.9198 11.6009C17.651 12.0917 17.2631 12.5069 16.7917 12.8083C16.9144 13.356 16.897 13.9257 16.7408 14.4648C16.5847 15.0039 16.295 15.4948 15.8986 15.8921C15.5021 16.2894 15.0118 16.5801 14.473 16.7374C13.9343 16.8946 13.3646 16.9133 12.8167 16.7917C12.5156 17.2649 12.1001 17.6545 11.6084 17.9244C11.1168 18.1944 10.565 18.3359 10.0042 18.3359C9.44331 18.3359 8.89152 18.1944 8.3999 17.9244C7.90827 17.6545 7.4927 17.2649 7.19167 16.7917C6.64403 16.9144 6.07425 16.897 5.53517 16.7408C4.99609 16.5847 4.50516 16.295 4.10789 15.8986C3.71062 15.5021 3.41988 15.0118 3.26263 14.4731C3.10538 13.9343 3.0867 13.3646 3.20833 12.8167C2.73329 12.516 2.342 12.1001 2.07087 11.6077C1.79973 11.1152 1.65755 10.5622 1.65755 10C1.65755 9.43783 1.79973 8.88479 2.07087 8.39232C2.342 7.89986 2.73329 7.48396 3.20833 7.18333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													</g>
													<defs>
														<clipPath id="clip0_644_81">
															<rect width="20" height="20" fill="white"/>
														</clipPath>
													</defs>
												</svg>

												<?php

											} elseif ($user_currency === "usd") {

												?>

													<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
														<g clip-path="url(#clip0_644_82)">
															<path d="M13.3333 6.66667H8.33333C7.89131 6.66667 7.46738 6.84226 7.15482 7.15482C6.84226 7.46738 6.66667 7.89131 6.66667 8.33333C6.66667 8.77536 6.84226 9.19928 7.15482 9.51184C7.46738 9.82441 7.89131 10 8.33333 10H11.6667C12.1087 10 12.5326 10.1756 12.8452 10.4882C13.1577 10.8007 13.3333 11.2246 13.3333 11.6667C13.3333 12.1087 13.1577 12.5326 12.8452 12.8452C12.5326 13.1577 12.1087 13.3333 11.6667 13.3333H6.66667M10 15V5M3.20833 7.18333C3.0867 6.63544 3.10538 6.0657 3.26263 5.52695C3.41988 4.9882 3.71062 4.49787 4.10789 4.10143C4.50516 3.705 4.99609 3.41529 5.53517 3.25916C6.07425 3.10304 6.64403 3.08555 7.19167 3.20833C7.49309 2.73692 7.90834 2.34897 8.39912 2.08024C8.88991 1.81151 9.44045 1.67065 9.99999 1.67065C10.5595 1.67065 11.1101 1.81151 11.6009 2.08024C12.0917 2.34897 12.5069 2.73692 12.8083 3.20833C13.3568 3.08502 13.9276 3.10242 14.4675 3.25893C15.0074 3.41543 15.499 3.70595 15.8965 4.10346C16.294 4.50097 16.5846 4.99256 16.7411 5.5325C16.8976 6.07244 16.915 6.64319 16.7917 7.19167C17.2631 7.49309 17.651 7.90834 17.9198 8.39913C18.1885 8.88992 18.3293 9.44046 18.3293 10C18.3293 10.5595 18.1885 11.1101 17.9198 11.6009C17.651 12.0917 17.2631 12.5069 16.7917 12.8083C16.9144 13.356 16.897 13.9257 16.7408 14.4648C16.5847 15.0039 16.295 15.4948 15.8986 15.8921C15.5021 16.2894 15.0118 16.5801 14.473 16.7374C13.9343 16.8946 13.3646 16.9133 12.8167 16.7917C12.5156 17.2649 12.1001 17.6545 11.6084 17.9244C11.1168 18.1944 10.565 18.3359 10.0042 18.3359C9.44331 18.3359 8.89152 18.1944 8.39989 17.9244C7.90826 17.6545 7.49269 17.2649 7.19166 16.7917C6.64402 16.9144 6.07425 16.897 5.53517 16.7408C4.99609 16.5847 4.50516 16.295 4.10789 15.8986C3.71062 15.5021 3.41988 15.0118 3.26262 14.4731C3.10537 13.9343 3.08669 13.3646 3.20833 12.8167C2.7333 12.516 2.34201 12.1001 2.07087 11.6077C1.79973 11.1152 1.65755 10.5622 1.65755 10C1.65755 9.43783 1.79973 8.88479 2.07087 8.39232C2.34201 7.89986 2.7333 7.48396 3.20833 7.18333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														</g>
														<defs>
															<clipPath id="clip0_644_82">
																<rect width="20" height="20" fill="white"/>
															</clipPath>
														</defs>
													</svg>

												<?php

											} elseif ($user_currency === "gbp") {

												?>

													<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
														<g clip-path="url(#clip0_644_83)">
															<path d="M6.66666 10H9.99999M8.33333 13.3333V7.91667C8.33333 7.36413 8.55282 6.83423 8.94352 6.44353C9.33422 6.05283 9.86412 5.83333 10.4167 5.83333C10.9692 5.83333 11.4991 6.05283 11.8898 6.44353C12.2805 6.83423 12.5 7.36413 12.5 7.91667M6.66666 13.3333H12.5M3.20833 7.18333C3.08669 6.63544 3.10537 6.0657 3.26262 5.52695C3.41988 4.9882 3.71062 4.49787 4.10788 4.10143C4.50515 3.705 4.99608 3.41529 5.53517 3.25916C6.07425 3.10304 6.64402 3.08555 7.19166 3.20833C7.49308 2.73692 7.90834 2.34897 8.39912 2.08024C8.88991 1.81151 9.44045 1.67065 9.99999 1.67065C10.5595 1.67065 11.1101 1.81151 11.6009 2.08024C12.0917 2.34897 12.5069 2.73692 12.8083 3.20833C13.3568 3.08502 13.9276 3.10242 14.4675 3.25893C15.0074 3.41543 15.499 3.70595 15.8965 4.10346C16.294 4.50097 16.5846 4.99256 16.7411 5.5325C16.8976 6.07244 16.915 6.64319 16.7917 7.19167C17.2631 7.49309 17.651 7.90834 17.9198 8.39913C18.1885 8.88992 18.3293 9.44046 18.3293 10C18.3293 10.5595 18.1885 11.1101 17.9198 11.6009C17.651 12.0917 17.2631 12.5069 16.7917 12.8083C16.9144 13.356 16.897 13.9257 16.7408 14.4648C16.5847 15.0039 16.295 15.4948 15.8986 15.8921C15.5021 16.2894 15.0118 16.5801 14.473 16.7374C13.9343 16.8946 13.3646 16.9133 12.8167 16.7917C12.5156 17.2649 12.1001 17.6545 11.6084 17.9244C11.1168 18.1944 10.565 18.3359 10.0042 18.3359C9.4433 18.3359 8.89151 18.1944 8.39989 17.9244C7.90826 17.6545 7.49269 17.2649 7.19166 16.7917C6.64402 16.9144 6.07425 16.897 5.53517 16.7408C4.99609 16.5847 4.50515 16.295 4.10788 15.8986C3.71062 15.5021 3.41988 15.0118 3.26262 14.4731C3.10537 13.9343 3.08669 13.3646 3.20833 12.8167C2.73329 12.516 2.342 12.1001 2.07087 11.6077C1.79973 11.1152 1.65755 10.5622 1.65755 10C1.65755 9.43783 1.79973 8.88479 2.07087 8.39232C2.342 7.89986 2.73329 7.48396 3.20833 7.18333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														</g>
														<defs>
															<clipPath id="clip0_644_83">
																<rect width="20" height="20" fill="white"/>
															</clipPath>
														</defs>
													</svg>

												<?php

											}

										?>

										<span class="navigation-text"><?php echo strtoupper($user_currency); ?></span>
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top: 2px;">
											<path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</a>
									<ul class="dropdown-menu">
									<?php
										foreach ($all_currencies as $this_currency) {
											if ($this_currency !== $user_currency) {
									?>
										<li>
											<a class="change-currency" currency="<?php echo $this_currency; ?>" href="#">
												<!-- <img class="currency" src="https://plottybot.com/img/currencies/<?php echo $this_currency; ?>.png"> -->
												<?php

													if ($this_currency === "eur") {

														?>

														<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
															<g clip-path="url(#clip0_644_81)">
																<path d="M5.83333 10H10M12.5 7.83333C12.0571 7.31553 11.4662 6.9459 10.8068 6.77421C10.1474 6.60253 9.4512 6.63705 8.81203 6.87312C8.17285 7.10918 7.62137 7.53546 7.23187 8.09454C6.84237 8.65361 6.63355 9.31862 6.63355 10C6.63355 10.6814 6.84237 11.3464 7.23187 11.9055C7.62137 12.4645 8.17285 12.8908 8.81203 13.1269C9.4512 13.363 10.1474 13.3975 10.8068 13.2258C11.4662 13.0541 12.0571 12.6845 12.5 12.1667M3.20833 7.18333C3.0867 6.63544 3.10538 6.0657 3.26263 5.52695C3.41988 4.9882 3.71062 4.49787 4.10789 4.10143C4.50516 3.705 4.99609 3.41529 5.53517 3.25916C6.07425 3.10304 6.64403 3.08555 7.19167 3.20833C7.49309 2.73692 7.90834 2.34897 8.39912 2.08024C8.88991 1.81151 9.44045 1.67065 9.99999 1.67065C10.5595 1.67065 11.1101 1.81151 11.6009 2.08024C12.0917 2.34897 12.5069 2.73692 12.8083 3.20833C13.3568 3.08502 13.9276 3.10242 14.4675 3.25893C15.0074 3.41543 15.499 3.70595 15.8965 4.10346C16.294 4.50097 16.5846 4.99256 16.7411 5.5325C16.8976 6.07244 16.915 6.64319 16.7917 7.19167C17.2631 7.49309 17.651 7.90834 17.9198 8.39913C18.1885 8.88992 18.3293 9.44046 18.3293 10C18.3293 10.5595 18.1885 11.1101 17.9198 11.6009C17.651 12.0917 17.2631 12.5069 16.7917 12.8083C16.9144 13.356 16.897 13.9257 16.7408 14.4648C16.5847 15.0039 16.295 15.4948 15.8986 15.8921C15.5021 16.2894 15.0118 16.5801 14.473 16.7374C13.9343 16.8946 13.3646 16.9133 12.8167 16.7917C12.5156 17.2649 12.1001 17.6545 11.6084 17.9244C11.1168 18.1944 10.565 18.3359 10.0042 18.3359C9.44331 18.3359 8.89152 18.1944 8.3999 17.9244C7.90827 17.6545 7.4927 17.2649 7.19167 16.7917C6.64403 16.9144 6.07425 16.897 5.53517 16.7408C4.99609 16.5847 4.50516 16.295 4.10789 15.8986C3.71062 15.5021 3.41988 15.0118 3.26262 14.4731C3.10538 13.9343 3.08669 13.3646 3.20833 12.8167C2.7333 12.516 2.34201 12.1001 2.07087 11.6077C1.79973 11.1152 1.65755 10.5622 1.65755 10C1.65755 9.43783 1.79973 8.88479 2.07087 8.39232C2.34201 7.89986 2.7333 7.48396 3.20833 7.18333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
															</g>
															<defs>
																<clipPath id="clip0_644_81">
																	<rect width="20" height="20" fill="white"/>
																</clipPath>
															</defs>
														</svg>

														<?php

													} elseif ($this_currency === "usd") {

														?>

															<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
																<g clip-path="url(#clip0_644_82)">
																	<path d="M13.3333 6.66667H8.33333C7.89131 6.66667 7.46738 6.84226 7.15482 7.15482C6.84226 7.46738 6.66667 7.89131 6.66667 8.33333C6.66667 8.77536 6.84226 9.19928 7.15482 9.51184C7.46738 9.82441 7.89131 10 8.33333 10H11.6667C12.1087 10 12.5326 10.1756 12.8452 10.4882C13.1577 10.8007 13.3333 11.2246 13.3333 11.6667C13.3333 12.1087 13.1577 12.5326 12.8452 12.8452C12.5326 13.1577 12.1087 13.3333 11.6667 13.3333H6.66667M10 15V5M3.20833 7.18333C3.0867 6.63544 3.10538 6.0657 3.26263 5.52695C3.41988 4.9882 3.71062 4.49787 4.10789 4.10143C4.50516 3.705 4.99609 3.41529 5.53517 3.25916C6.07425 3.10304 6.64403 3.08555 7.19167 3.20833C7.49309 2.73692 7.90834 2.34897 8.39912 2.08024C8.88991 1.81151 9.44045 1.67065 9.99999 1.67065C10.5595 1.67065 11.1101 1.81151 11.6009 2.08024C12.0917 2.34897 12.5069 2.73692 12.8083 3.20833C13.3568 3.08502 13.9276 3.10242 14.4675 3.25893C15.0074 3.41543 15.499 3.70595 15.8965 4.10346C16.294 4.50097 16.5846 4.99256 16.7411 5.5325C16.8976 6.07244 16.915 6.64319 16.7917 7.19167C17.2631 7.49309 17.651 7.90834 17.9198 8.39913C18.1885 8.88992 18.3293 9.44046 18.3293 10C18.3293 10.5595 18.1885 11.1101 17.9198 11.6009C17.651 12.0917 17.2631 12.5069 16.7917 12.8083C16.9144 13.356 16.897 13.9257 16.7408 14.4648C16.5847 15.0039 16.295 15.4948 15.8986 15.8921C15.5021 16.2894 15.0118 16.5801 14.473 16.7374C13.9343 16.8946 13.3646 16.9133 12.8167 16.7917C12.5156 17.2649 12.1001 17.6545 11.6084 17.9244C11.1168 18.1944 10.565 18.3359 10.0042 18.3359C9.4433 18.3359 8.89151 18.1944 8.39989 17.9244C7.90826 17.6545 7.49269 17.2649 7.19166 16.7917C6.64402 16.9144 6.07425 16.897 5.53517 16.7408C4.99609 16.5847 4.50515 16.295 4.10788 15.8986C3.71062 15.5021 3.41988 15.0118 3.26262 14.4731C3.10537 13.9343 3.08669 13.3646 3.20833 12.8167C2.7333 12.516 2.34201 12.1001 2.07087 11.6077C1.79973 11.1152 1.65755 10.5622 1.65755 10C1.65755 9.43783 1.79973 8.88479 2.07087 8.39232C2.34201 7.89986 2.7333 7.48396 3.20833 7.18333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
																</g>
																<defs>
																	<clipPath id="clip0_644_82">
																		<rect width="20" height="20" fill="white"/>
																	</clipPath>
																</defs>
															</svg>

														<?php

													} elseif ($this_currency === "gbp") {

														?>

															<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
																<g clip-path="url(#clip0_644_83)">
																	<path d="M6.66666 10H9.99999M8.33333 13.3333V7.91667C8.33333 7.36413 8.55282 6.83423 8.94352 6.44353C9.33422 6.05283 9.86412 5.83333 10.4167 5.83333C10.9692 5.83333 11.4991 6.05283 11.8898 6.44353C12.2805 6.83423 12.5 7.36413 12.5 7.91667M6.66666 13.3333H12.5M3.20833 7.18333C3.08669 6.63544 3.10537 6.0657 3.26262 5.52695C3.41988 4.9882 3.71062 4.49787 4.10788 4.10143C4.50515 3.705 4.99608 3.41529 5.53517 3.25916C6.07425 3.10304 6.64402 3.08555 7.19166 3.20833C7.49308 2.73692 7.90834 2.34897 8.39912 2.08024C8.88991 1.81151 9.44045 1.67065 9.99999 1.67065C10.5595 1.67065 11.1101 1.81151 11.6009 2.08024C12.0917 2.34897 12.5069 2.73692 12.8083 3.20833C13.3568 3.08502 13.9276 3.10242 14.4675 3.25893C15.0074 3.41543 15.499 3.70595 15.8965 4.10346C16.294 4.50097 16.5846 4.99256 16.7411 5.5325C16.8976 6.07244 16.915 6.64319 16.7917 7.19167C17.2631 7.49309 17.651 7.90834 17.9198 8.39913C18.1885 8.88992 18.3293 9.44046 18.3293 10C18.3293 10.5595 18.1885 11.1101 17.9198 11.6009C17.651 12.0917 17.2631 12.5069 16.7917 12.8083C16.9144 13.356 16.897 13.9257 16.7408 14.4648C16.5847 15.0039 16.295 15.4948 15.8986 15.8921C15.5021 16.2894 15.0118 16.5801 14.473 16.7374C13.9343 16.8946 13.3646 16.9133 12.8167 16.7917C12.5156 17.2649 12.1001 17.6545 11.6084 17.9244C11.1168 18.1944 10.565 18.3359 10.0042 18.3359C9.4433 18.3359 8.89151 18.1944 8.39989 17.9244C7.90826 17.6545 7.49269 17.2649 7.19166 16.7917C6.64402 16.9144 6.07425 16.897 5.53517 16.7408C4.99609 16.5847 4.50515 16.295 4.10788 15.8986C3.71062 15.5021 3.41988 15.0118 3.26262 14.4731C3.10537 13.9343 3.08669 13.3646 3.20833 12.8167C2.73329 12.516 2.342 12.1001 2.07087 11.6077C1.79973 11.1152 1.65755 10.5622 1.65755 10C1.65755 9.43783 1.79973 8.88479 2.07087 8.39232C2.342 7.89986 2.73329 7.48396 3.20833 7.18333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
																</g>
																<defs>
																	<clipPath id="clip0_644_83">
																		<rect width="20" height="20" fill="white"/>
																	</clipPath>
																</defs>
															</svg>

														<?php

													}

												?>
												<span class="navigation-text"><?php echo strtoupper($this_currency); ?></span>
											</a>
										</li>

									<?php

											}

										}

									?>

								</ul>
							</li>

						<?php

							}

						?>
						<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-99">
							<a href="https://plottybot.com/account/">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g clip-path="url(#clip0_76_880)">
										<path d="M15 16.6667C15 15.3406 14.4732 14.0688 13.5355 13.1311C12.5978 12.1934 11.3261 11.6667 10 11.6667M10 11.6667C8.67391 11.6667 7.40215 12.1934 6.46446 13.1311C5.52678 14.0688 5 15.3406 5 16.6667M10 11.6667C11.8409 11.6667 13.3333 10.1743 13.3333 8.33332C13.3333 6.49237 11.8409 4.99999 10 4.99999C8.15905 4.99999 6.66666 6.49237 6.66666 8.33332C6.66666 10.1743 8.15905 11.6667 10 11.6667ZM18.3333 9.99999C18.3333 14.6024 14.6024 18.3333 10 18.3333C5.39762 18.3333 1.66666 14.6024 1.66666 9.99999C1.66666 5.39762 5.39762 1.66666 10 1.66666C14.6024 1.66666 18.3333 5.39762 18.3333 9.99999Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</g>
									<defs>
										<clipPath id="clip0_76_880">
											<rect width="20" height="20" fill="white"/>
										</clipPath>
									</defs>
								</svg><!-- RG-WEBDEV: Aggiunto -->
								<!-- <span class="icon-circle-user"></span><span class="navigation-text">Account</span> RG-WEBDEV: Modificato -->
								<span class="navigation-text">Account</span>
							</a>
						</li>
						<?php } else { ?>
						<li class="login_button menu-item menu-item-type-post_type menu-item-object-page menu-item-99">
							<!--<a class="gradient" href="https://plottybot.com/login/<?php echo $affiliate_url . $utm_url . $pro_url; ?>"> RG-WEBDEV: Rimosso -->
							<a href="https://plottybot.com/login/<?php echo $affiliate_url . $utm_url . $pro_url; ?>" style="text-decoration: none;">
								<button type="button" class="button button--primary button--sm" style="width: 120px;">Login</button>
							</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->

		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'pippo'); ?></a>

