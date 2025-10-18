<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pippo
 */

global $eng, $ita;
global $affiliate_url;
global $utm_url;
global $pro_url;
?>
</div><!-- #page -->

<footer id="colophon" class="site-footer">
	<div class="site-info">
		<h2 style="margin-bottom: var(--spacing-28);">
			<span class="icon-logo icon--sm" style="color: var(--color-neutral-40);"></span>
		</h2>
		<div class="footer_block top">
			<div class="footer_link text--buttons">
				<a href="https://plottybot.com/write/<?php echo $affiliate_url . $utm_url . $pro_url; ?>">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 8px; vertical-align: middle;">
						<path d="M10 16.6667H17.5M13.6467 3.01833C13.9784 2.68658 14.4284 2.50021 14.8975 2.50021C15.3667 2.50021 15.8166 2.68658 16.1483 3.01833C16.4801 3.35007 16.6665 3.80001 16.6665 4.26916C16.6665 4.73831 16.4801 5.18825 16.1483 5.51999L6.14001 15.5292C5.94175 15.7274 5.69669 15.8724 5.42751 15.9508L3.03417 16.6492C2.96247 16.6701 2.88646 16.6713 2.8141 16.6528C2.74174 16.6343 2.6757 16.5966 2.62288 16.5438C2.57006 16.491 2.53241 16.4249 2.51388 16.3526C2.49534 16.2802 2.49659 16.2042 2.51751 16.1325L3.21584 13.7392C3.29436 13.4703 3.43938 13.2255 3.63751 13.0275L13.6467 3.01833Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg><!-- RG-WEBDEV -->
					<?php if ($ita) { echo "Scrivi"; } else { echo "Write"; } ?>
				</a>
			</div>
            <div class="footer_link text--buttons how_it_works">
                <a href="https://plottybot.com/pricing/<?php echo $affiliate_url . $utm_url . $pro_url; ?>">
                    <?php if ($ita) { echo "Come funziona"; } else { echo "How it works"; } ?>
                </a>
            </div>
            <div class="footer_link text--buttons">
				<a href="https://plottybot.com/account/<?php echo $affiliate_url . $utm_url . $pro_url; ?>">
					<?php if (is_user_logged_in()) { echo "Account"; } else { echo "Login"; } ?>
				</a>
			</div>
			<div class="footer_link text--buttons">
				<a class="chat">
					<?php if ($ita) { echo "Assistenza"; } else { echo "Help"; } ?>
				</a>
			</div>
			<div class="footer_link text--buttons">
				<a href="https://www.facebook.com/groups/plottybot">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 8px; vertical-align: middle;">
						<path d="M15 1.66669H12.5C11.3949 1.66669 10.3351 2.10567 9.55372 2.88708C8.77232 3.66848 8.33334 4.72828 8.33334 5.83335V8.33335H5.83334V11.6667H8.33334V18.3334H11.6667V11.6667H14.1667L15 8.33335H11.6667V5.83335C11.6667 5.61234 11.7545 5.40038 11.9107 5.2441C12.067 5.08782 12.279 5.00002 12.5 5.00002H15V1.66669Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg><!-- RG-WEBDEV -->
					<!-- <span class="icon-facebook"></span> RG-WEBDEV: Rimosso -->Facebook
				</a>
			</div>
			<div class="footer_link text--buttons">
				<a href="https://www.youtube.com/@PlottyBot/playlists">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 8px; vertical-align: middle;">
						<path d="M2.08334 14.1667C1.50119 11.4194 1.50119 8.58061 2.08334 5.83333C2.15983 5.55434 2.30762 5.30006 2.51218 5.09551C2.71674 4.89095 2.97101 4.74316 3.25001 4.66667C7.71955 3.92622 12.2805 3.92622 16.75 4.66667C17.029 4.74316 17.2833 4.89095 17.4878 5.09551C17.6924 5.30006 17.8402 5.55434 17.9167 5.83333C18.4988 8.58061 18.4988 11.4194 17.9167 14.1667C17.8402 14.4457 17.6924 14.6999 17.4878 14.9045C17.2833 15.1091 17.029 15.2568 16.75 15.3333C12.2805 16.0739 7.71953 16.0739 3.25001 15.3333C2.97101 15.2568 2.71674 15.1091 2.51218 14.9045C2.30762 14.6999 2.15983 14.4457 2.08334 14.1667Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M8.33334 12.5L12.5 10L8.33334 7.5V12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<!-- <span class="icon-youtube"></span>RG-WEBDEV: Rimosso -->YouTube
				</a>
			</div>
		</div>
		<!-- <div class="footer_block bottom" style="font-size: 0.8em;"> RG-WEBDEV: Rimosso -->
		<div class="footer_block bottom text--overline" style="color: var(--color-neutral-40);">
			© <?php echo date('Y'); ?> Surf Publishing s.r.l. - Via Rignano 17/B, 52011 Bibbiena (AR) IT - <?php if ($ita) { echo "P.Iva 02485200519"; } else { echo "VAT IT02485200519"; } ?> - REA AR 220177 - Cap.Soc. 10.000€ i.v.
		</div>
		<div class="footer_block bottom">
			<div class="footer_link text--overline">
				<a href="https://plottybot.com/legal-notice/<?php echo $affiliate_url . $utm_url . $pro_url; ?>" target="_blank">
					<?php if ($ita) { ?>
					Note legali
					<?php } else { ?>
					Legal notice
					<?php } ?>
				</a>
			</div>
			<div class="footer_link text--overline">
				<a href="https://plottybot.com/terms-and-conditions/<?php echo $affiliate_url . $utm_url . $pro_url; ?>" target="_blank">
					<?php if ($ita) { ?>
					Termini & Condizioni
					<?php } else { ?>
					Terms & Conditions
					<?php } ?>
				</a>
			</div>
			<div class="footer_link text--overline">
				<a href="https://plottybot.com/privacy-policy/<?php echo $affiliate_url . $utm_url . $pro_url; ?>" target="_blank">
					Privacy
				</a>
			</div>
			<div class="footer_link text--overline">
				<a href="https://plottybot.com/cookie-policy/<?php echo $affiliate_url . $utm_url . $pro_url; ?>" target="_blank">
					Cookies
				</a>
			</div>
		</div>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
<!-- Bottone per aprire la chat -->

<!-- Pannello della chat -->
<div id="chat-panel" class="chat-panel">
    <div class="chat-header">
        <button id="close-chat" class="close-chat"><span class="icon-close"></span></button>
	</div>
	<div class="chat-body" id="chat-body">
		<div class="message left">
			<span class="icon-logo"></span>
		</div>
		<div class="bot-msg"><?php if ($ita) { echo "Ciao"; } else { echo "Hi"; } 
			$user_id = get_current_user_id();
if ( isset( $user_id ) ) {
	$user_info = get_userdata($user_id);
	if ($user_info) {
		$user_first_name = $user_info->first_name;
		echo " " . $user_first_name;
	}
} if ($ita) { echo ". Come posso aiutarti"; } else { echo ". How can I help you"; } ?>?</div>
	</div>
	<div class="chat-footer">
		<input type="text" id="chat-input" class="chat-input" placeholder="<?php if ($ita) { echo "Scrivi un messaggio"; } else { echo "Write a message"; } ?>..." />
        <button id="send-btn" class="send-btn gradient"><span class="icon-send"></span></button>
    </div>
</div>
<script>
	jQuery(document).ready(function($) {
		// Variabile per memorizzare l'intera conversazione
		var conversationHistory = '';

		// Apri il pannello della chat con un rimbalzo
		
		$('.chat').click(function() {
			$('#chat-panel').show(200, function() { // RG-WEBDEV: Modificato
				$(this).css('right', '0');
			});
		});
		
		var spostamento = "-25%";
		if ($(window).width() < 1500) {
			var spostamento = "-30%";
		}
		if ($(window).width() < 1000) {
			var spostamento = "-100%";
		}

		// Chiudi il pannello della chat
		$('#close-chat').click(function() {

			// RG-WEBDEV: Modificato
			$('#chat-panel').queue(function(next) {
				$(this).css('right', spostamento);
				next(); // passa subito alla prossima azione
			}).queue(function(next) {
				setTimeout(next, 1000); // aspetta 1000 ms (1 secondo) prima di continuare
			}).queue(function(next) {
				$(this).hide();
				next(); // se vuoi farla partire subito (fadeIn è async, quindi serve attenzione qui)
			});
			// -------

		});

		// Invia il messaggio dell'utente con AJAX
		$('#send-btn').click(function() {
			var userInput = $('#chat-input').val();

			if (userInput.trim() !== "") {
				// Aggiungi il messaggio dell'utente alla conversazione
				conversationHistory += "User: " + userInput + "\n";

				// Crea e aggiungi il messaggio utente nella chat
				var userMessage = '<div class="message right"><?php if ($ita) { echo "Tu"; } else { echo "You"; } ?></div><div class="user-msg">' + userInput + '</div>';
				$('#chat-body').append(userMessage);
				$('#chat-body').scrollTop($('#chat-body')[0].scrollHeight); // Scroll automatico
				$('#chat-input').val(''); // Svuota l'input

				// Disabilita l'input mentre si elabora la risposta
				$('#chat-input').prop('disabled', true);
				$('#send-btn').prop('disabled', true);

				// Aggiungi i pallini di typing-indicator
				var typingIndicator = '<div id="typing-indicator" class="typing-indicator">' +
					'<div class="dot"></div>' +
					'<div class="dot"></div>' +
					'<div class="dot"></div>' +
					'</div>';
				$('#chat-body').append(typingIndicator);
				$('#chat-body').scrollTop($('#chat-body')[0].scrollHeight); // Scroll automatico
				
				console.log(conversationHistory);

				// Invio AJAX al chatbot con l'intera conversazione
				$.ajax({
					url: 'https://plottybot.com/wp-content/themes/pippo/action/chat.php',
					type: 'POST',
					data: {
						action: 'send_to_chatbot',
						message: userInput,
						conversation: conversationHistory // Passiamo tutto il contesto
					},
					beforeSend: function() {
						// Mostra l'indicatore "typing" prima di inviare la richiesta
						$('#typing-indicator').show();
					},
					success: function(response) {
						// Rimuovi i pallini "typing..."
						$('#typing-indicator').remove();
						
						if (response === "#*_close_*#") {
							$('#chat-panel').css('right', spostamento);
							// Riabilita l'input dopo la risposta
							$('#chat-input').prop('disabled', false);
							$('#send-btn').prop('disabled', false);
						} else {
							// Aggiungi la risposta del bot alla conversazione
						conversationHistory += "Bot: " + response + "\n";

						// Crea e aggiungi il messaggio del bot nella chat
						var botMessage = '<div class="message left"><span class="icon-logo"></span></div><div class="bot-msg">' + response + '</div>';
						$('#chat-body').append(botMessage);
						$('#chat-body').scrollTop($('#chat-body')[0].scrollHeight); // Scroll automatico

						// Riabilita l'input dopo la risposta
						$('#chat-input').prop('disabled', false);
						$('#send-btn').prop('disabled', false);
					}
					},
					error: function() {
						// Rimuovi i pallini "typing..." in caso di errore
						$('#typing-indicator').remove();

						var errorMessage = '<div class="bot-msg"><?php if ($ita) { echo "Errore nella risposta. Riprova più tardi."; } else { echo "Response error. Please try again later."; } ?></div>';
						$('#chat-body').append(errorMessage);
						$('#chat-body').scrollTop($('#chat-body')[0].scrollHeight); // Scroll automatico

						$('#chat-input').prop('disabled', false);
						$('#send-btn').prop('disabled', false);
					}
				});
			}
		});
	});

</script>

<?php wp_footer(); ?>

</body>
</html>