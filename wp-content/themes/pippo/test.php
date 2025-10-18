<?php

	/* Template Name: Test */

	get_header();	

	/** Connessione al DB del sito principale (Plotty) */
    
    $wpdb2 = new wpdb('insights', '+1nS16H7s+', 'admin_plotty', 'localhost');

    $count = $wpdb2->get_var("SELECT COUNT(*) FROM wp_users"); // gli unici consentiti sono wp_users e wp_usermeta
    echo "Connessione DB Plotty ok: {$count} utenti trovati";

phpinfo();

	
	// }

	get_footer();