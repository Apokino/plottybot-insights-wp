<?php

	function pb_toast_component($heading = "", $text = "", $type = "default", $code = "") {

		ob_start();

		?>

		<div class="toast-component toast--<?php echo $type; ?>">

			<?php 
			
				if ($code !== "") echo $code;

			?>

			<div>

				<div>
					
					<?php
					
						if ($type === "success") {

					?>

						<span class="pb-icon__before--round-checkmark-l-success"></span>

					<?php
					
						}
					
						if ($type === "error") {

					?>

						<span class="pb-icon__before--round-error-l-error"></span>

					<?php
					
						}
						
						if ($type === "warning") {

					?>

						<span class="pb-icon__before--round-info-l-warning"></span>

					<?php
					
						}
						
						if ($type === "info") {

					?>

						<span class="pb-icon__before--round-info-l-secondary"></span>

					<?php
					
						}
						
						if ($type === "default") {

					?>

						<svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g clip-path="url(#clip0_449_1128)">
						<path d="M8.00016 10.6666V7.99992M8.00016 5.33325H8.00683M14.6668 7.99992C14.6668 11.6818 11.6821 14.6666 8.00016 14.6666C4.31826 14.6666 1.3335 11.6818 1.3335 7.99992C1.3335 4.31802 4.31826 1.33325 8.00016 1.33325C11.6821 1.33325 14.6668 4.31802 14.6668 7.99992Z"
						stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</g>
						<defs>
						<clipPath id="clip0_449_1128">
						<rect width="16" height="16" fill="white" />
						</clipPath>
						</defs>
						</svg>

					<?php
					
						}
					
					?>

				</div>

				<div>

					<?php 

						if ($heading !== "") {
					
					?>

					<h4 class="text--buttons"><?php echo $heading; ?></h4>
					
					<?php 

						}

						if ($text !== "") {
					
					?>
					
					<p class="text--body-md"><?php echo $text; ?></p>

					<?php

						}

					?>
					
				</div>

			</div>

		</div>

		<?php

		return ob_get_clean();

	}


	function pb_dialog_component($heading = "", $text_1 = "", $video = false, $button_1_enable = true, $button_1_type = "primary", $button_1_size = "sm", $button_1_text = "", $button_1_error = false, $button_2_enable = false, $button_2_type = "primary", $button_2_size = "sm", $button_2_text = "", $button_2_error = false, $text_2 = "", $input = "", $code = "", $button_1_class = "", $button_2_class = "", $close_class = "", $close_button_enable = true, $size = "lg", $button_1_id = "", $button_2_id = "", $uniq_id = "") {

		ob_start();

		if (is_bool($video) && $video) {

		?>

		<div id="video-alert-container">
	
			<div id="video-alert">

		<?php

		}

		?>

		<div class="dialog-component" style="width: 90%; max-width: <?php echo (($size === "md") ? "620px" : (($size === "lg") ? "900px" : "320px")); ?>">

		<?php

			if (isset($heading) && $heading !== "") {

		?>

			<h3 class="dialog-title text--heading-md"><?php echo $heading; ?></h3>

		<?php

			}

			if (is_bool($video) && $video) {

		?>

			<div id="video<?php echo '-' . $uniq_id; ?>" class="video" style="display: block; width: 100%; min-height: 50px; margin: var(--spacing-24) 0 var(--spacing-40) 0;"></div>

		<?php

			} else {

				if (isset($text_1) && $text_1 !== "") {

		?>

				<p class="dialog-message text--body-md"><?php echo $text_1; ?></p>
		
		<?php 
		
				echo $input; 

				}

				if (isset($text_2) && $text_2 !== "") {
			
		?>
		
				<p class="dialog-message text--body-md"><?php echo $text_2; ?></p>

		<?php

				}

				if (isset($code) && $code !== "") echo "<div id=\"code-wrapper\">$code</div>";

			}

			if (is_bool($button_1_enable) && $button_1_enable) {

		?>

			<hr class="hr-ligth">

			<div style="display: flex; flex-direction: row; justify-content: center; align-items: center; gap: 16px;">

				<button type="button" id="<?php echo $button_1_id; ?>" class="<?php echo $button_1_class; ?> dialog-text-button button button--<?php echo $button_1_type; ?> button--<?php echo $button_1_size; ?><?php echo ($button_1_error) ? ' button--error' : ''; ?>"><?php echo $button_1_text; ?></button>
		
		<?php

				if (is_bool($button_2_enable) && $button_2_enable) {

		?>

				<button type="button" class="<?php echo $button_2_class; ?> button button--<?php echo $button_2_type; ?> button--<?php echo $button_2_size; ?><?php echo ($button_2_error) ? ' button--error' : ''; ?>"><?php echo $button_2_text; ?></button>

		<?php

				}

		?>

			</div>

		<?php

			}

			if (is_bool($close_button_enable) && $close_button_enable) {

		?>

			<span class="close-dialog <?php echo $close_class; ?> pb-icon__before--close-l-black"></span>
		
		<?php

			}

		?>

		</div>

		<?php

		if (is_bool($video) && $video) {

		?>

			</div>

		</div>

		<?php

		}

		?>

		<style>
			.close-dialog {
				display: inline-block;
				width: 20px;
				height: 20px;
				/*background-color: transparent;
				background-image: url(https://plottybot.com/img/icons/close.svg);
				background-repeat: no-repeat;
				background-size: 20px;
				background-position: 50% 50%;*/
				position: absolute;
				top: 30px;
				right: 25px;
				cursor: pointer;
			}
			
			@media only screen and (max-width: 600px) {
				#code-wrapper {
					max-height: 200px;
					overflow-y: scroll;
				}
			}

			@media only screen and (max-width: 840px) {
				.dialog-component {
					width: 90%;
				}
			}

			#code-wrapper {
				width: 100%;
			}

			p.dialog-message {
				width: 100%;
			}

		</style>

		<?php

		return ob_get_clean();

	}

	function pb_switch($value = "", $checked = false, $label = "") {

		ob_start();

		?>

		<label class="switch">
			<input type="checkbox" value="<?php echo $value; ?>" <?php echo $checked ? "checked" : ""; ?>>
			<span class="slider round"></span>
			<span class="text--body-md" style="float: left; cursor: pointer;"><?php echo $label; ?></span>
		</label>

		<?php

		return ob_get_clean();

	}

	function pb_tabs($tabs = [], $tabs_content = [], $icons = [], $active_icons = []) {

		?>

			<div id="account-nav" class="tabs">
				
				<div class="tab-buttons">

		<?php

			foreach ($tabs as $index => $tab) {

		?>

					<span id="tab<?php echo $index + 1; ?>" class="<?php echo $icons[$index]; ?> tab tab-button<?php ($index === 0) ? " active" : "" ?>" data-tab="tab<?php echo $index + 1; ?>" data-icon="<?php echo $icons[$index]; ?>" data-active-icon="<?php echo $active_icons[$index]; ?>"><?php echo $tab; ?></span>
					<script>
						(($) => {
							$(document).ready(function() {
								const icon = "<?php echo $icons[$index]; ?>";
								const active_icon = "<?php echo $active_icons[$index]; ?>";
								<?php if ($index === 0) { ?> $("#tab<?php echo $index + 1; ?>").removeClass(icon).addClass(active_icon); <?php } ?>
								$("#tab<?php echo $index + 1; ?>").on('click', function() {
									$("div.tab-buttons > .tab").each(function(index, el) {
										$(this).removeClass($(this).attr("data-active-icon")).addClass($(this).attr("data-icon"));
									});
									$(this).removeClass(icon).addClass(active_icon);
									$(".tab-content").each(function(index, el) {
										$(this).removeClass('active');
									});
									$("#<?php echo $tabs_content[$index]; ?>").addClass('active');
								});
								$("#tab<?php echo $index + 1; ?>").on('mouseover', function() {
									if (!($(this).hasClass("active"))) $(this).removeClass(icon).addClass(active_icon);
								});
								$("#tab<?php echo $index + 1; ?>").on('mouseleave', function() {
									if (!($(this).hasClass("active"))) $(this).addClass(icon).removeClass(active_icon);
								});
							});
						})(jQuery);
					</script>

		<?php

			}

		?>
					<div class="tab-indicator" style="visibility: hidden;"></div>
				</div>

			</div>

			<script>

				document.addEventListener('DOMContentLoaded', () => {

					const tabs = document.querySelectorAll('.tab');
					const indicator = document.querySelector('.tab-indicator');

					function moveIndicator(tab) {
						const parentRect = tab.parentElement.getBoundingClientRect();
						const tabRect = tab.getBoundingClientRect();
						// Larghezza fissa (es. 100px)
						const indicatorWidth = indicator.offsetWidth;
						// Allinea centrato rispetto alla tab
						const leftPosition = tabRect.left - parentRect.left + (tabRect.width - indicatorWidth) / 2;
						indicator.style.left = `${leftPosition}px`;
						indicator.style.visibility = 'visible';
					}

					tabs.forEach(tab => {
						tab.addEventListener('click', () => {
							tabs.forEach(t => t.classList.remove('active'));
							tab.classList.add('active');
							moveIndicator(tab);
						});
					});

					// Attiva la prima tab se nessuna è attiva
					let activeTab = document.querySelector('.tab.active');
		
					if (!activeTab && tabs.length > 0) {
						activeTab = tabs[0];
						activeTab.classList.add('active');
					}

					// Inizializza posizione indicatore
					moveIndicator(activeTab);
				
				});

				document.addEventListener('DOMContentLoaded', () => {

					document.querySelectorAll('.tab-button').forEach(button => {
						button.addEventListener('click', () => {
							const tabId = button.getAttribute('data-tab');
							// Disattiva tutti i bottoni e tab
							document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
							document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
							// Attiva il bottone e il contenuto selezionato
							button.classList.add('active');
							document.getElementById(tabId).classList.add('active');
						});
					});

				});

			</script>

		<?php

	}

	/*****/

	function pb_dialog_shortcode($atts, $content = null) {

		$dialog_id = uniqid();

		// Imposta i valori di default
		$atts = shortcode_atts(
			array(
				'trigger_element' => null,
				'language' => 'ita',
				'dialog_id' => $dialog_id,
				'heading_ita' => '',
				'text_1_ita' => '',
				'text_2_ita' => '',
				'button_1_text_ita' => '',
				'button_2_text_ita' => '',
				'heading_eng' => '',
				'text_1_eng' => '',
				'text_2_eng' => '',
				'button_1_text_eng' => '',
				'button_2_text_eng' => '',
				'video' => false,
				'video_url' => null,
				'input' => '',
				'code' => '',
				'button_1_id' => null,
				'button_1_class' => 'close',
				'button_1_enable' => true,
				'button_1_type' => 'primary',
				'button_1_size' => 'sm',
				'button_1_error' => false,
				'button_2_id' => null,
				'button_2_class' => null,
				'button_2_enable' => false,
				'button_2_type' => 'primary',
				'button_2_size' => 'sm',
				'button_2_error' => false,
				'close_class' => null,
				'close_button_enable' => true,
				'size' => 'lg'
			), $atts, 'pb_dialog'
		);

		if (empty($atts['trigger_element'])) return '';

		if (empty($atts['dialog_id'])) $dialog_id = $atts['dialog_id'];

		// Correzione parametri vuoti
		if (empty($atts['button_1_id'])) $atts['button_1_id'] = 'button_1';
		if (empty($atts['button_1_class'])) $atts['button_1_class'] = 'button_1';
		if (empty($atts['button_2_id'])) $atts['button_2_id'] = 'button_2';
		if (empty($atts['button_2_class'])) $atts['button_2_class'] = 'button_2';
		if (empty($atts['close_class'])) $atts['close_class'] = 'close';

		// Lingua corrente
		$ita = ($atts['language'] === 'ita');

		// ID univoci
		$atts['button_1_id'] .= '_' . $dialog_id;
		$atts['button_1_class'] .= '_' . $dialog_id;	
		$atts['button_2_id'] .= '_' . $dialog_id;
		$atts['button_2_class'] .= '_' . $dialog_id;
		$atts['close_class'] .= '_' . $dialog_id;	

		ob_start();
		
		?>

		<div id="blur-overlay"></div>

		<div id="alert-container-<?php echo $dialog_id; ?>" style="display: none;">

			<div id="alert-<?php echo $dialog_id; ?>" class="hide">
		
		<?php 
		
			echo pb_dialog_component(
				($ita) ? $atts['heading_ita'] : $atts['heading_eng'], // heading 
				($ita) ? $atts['text_1_ita'] : $atts['text_1_eng'],  // text-1
				filter_var($atts['video'], FILTER_VALIDATE_BOOLEAN), // video
				filter_var($atts['button_1_enable'], FILTER_VALIDATE_BOOLEAN), // button-1-enable
				$atts['button_1_type'], // button-1-type
				$atts['button_1_size'], // button-1-size
				($ita) ? $atts['button_1_text_ita'] : $atts['button_1_text_eng'], // button-1-text 
				filter_var($atts['button_1_error'], FILTER_VALIDATE_BOOLEAN), // button-1-error
				filter_var($atts['button_2_enable'], FILTER_VALIDATE_BOOLEAN), // button-2-enable
				$atts['button_2_type'], // button-2-type
				$atts['button_2_size'], //button-2-size
				($ita) ? $atts['button_2_text_ita'] : $atts['button_2_text_eng'], // button-2-text
				filter_var($atts['button_2_error'], FILTER_VALIDATE_BOOLEAN), // button-2-error
				($ita) ? $atts['text_2_ita'] : $atts['text_2_eng'], // text-2
				$atts['input'], // input
				$atts['code'], // code
				$atts['button_1_class'], // button-1-class
				$atts['button_2_class'], // button-2-class
				$atts['close_class'], // close-class
				filter_var($atts['close_button_enable'], FILTER_VALIDATE_BOOLEAN), // close-button-enable
				$atts['size'], // size
				$atts['button_1_id'], // button-1-id
				$atts['button_2_id'], // button-2-id
				$dialog_id, // uniq-id
			);
		
		?>		

			</div>

		</div>

		<!-- **** -->	

		<script>
			
			globalDialogValue['<?php echo $dialog_id; ?>'] = false; // variabile globale per tutti gli script

			document.addEventListener('DOMContentLoaded', () => {

				// Definisce oggetto globale di callback se non esiste
				window.pbDialogCallbacks = window.pbDialogCallbacks || {};

				// Callback specifica per questa modale
				window.pbDialogCallbacks['<?php echo $dialog_id; ?>'] = function(returnValue) {
					console.log("Valore ricevuto dalla modale:", returnValue);
					globalDialogValue['<?php echo $dialog_id; ?>'] = returnValue;
				};

			});

			(function($) {

				<?php

					if (filter_var($atts['video'], FILTER_VALIDATE_BOOLEAN)) {
				
				?>
				
					const tutorialLoader = (e) => {

					console.log('Start video');

					if (<?php echo $ita; ?>) {
						var lang_short = "ita";
						var video_loading = "Video in caricamento";
						var no_video = "Il tuo browser non supporta il video. Aggiorna il browser o prova un altro dispositivo.";
					} else {
						var lang_short = "eng";
						var video_loading = "Loading Video";
						var no_video = "Your browser doesn’t support the video. Update your browser or try another device.";
					}

					// HTML iniziale con il video nascosto
					let videoHtml = `
						<div class="video-loading">
							<p>` + video_loading + `...</p>
						</div>
						<div class="video-container small">
							<video id="custom-video-<?php echo $dialog_id; ?>" class="custom-video small">
								<source src="<?php echo $atts['video_url']; ?>" type="video/mp4">
								` + no_video + `
							</video>
							<span id="play-btn" class="play-btn">
								<span class="pb-icon__before--round-filled-play-xl-primary"></span>
							</span>
						</div>
					`;

					$('#video-alert #video<?php echo '-' . $dialog_id; ?>').html(videoHtml);

					let video = document.getElementById('custom-video-<?php echo $dialog_id; ?>');

					if (video) {
					
						video.load();

						// Mostra il video solo quando è pronto
						$(video).on('canplay', function () {
							$('.video-loading').remove(); // Rimuove il messaggio
							$('.video-container').fadeIn(50); // Mostra il video
							video.play().catch(error => console.error('Autoplay bloccato:', error));
						});

						// Riassocia gli eventi
						let container = $('.video-container');
						let playBtn = container.find('.play-btn');

						playBtn.click(function () {
							if (video.paused) {
								$('.custom-video-<?php echo $dialog_id; ?>').each(function () {
									if (!this.paused && this !== video) {
										this.pause();
										$(this).closest('.video-container').find('.play-btn').removeClass('hidden');
									}
								});
								video.play();
								playBtn.addClass('hidden');
							}
						});

						$(video).on('pause', function () {
							playBtn.removeClass('hidden');
						});

						$(video).on('play', function () {
							playBtn.addClass('hidden');
						});

						$(video).click(function () {
							if (!video.paused) {
								video.pause();
								playBtn.removeClass('hidden');
							}
						});

						// Interrompe il video quando si chiude l'alert
						$('.close_<?php echo $dialog_id; ?>').click(function () {
							if (video) {
								video.pause();
							}
						});

					}

				}

					tutorialLoader();

				<?php

					}

				?>

			// ****

			// Chiude Dialog
			$('.<?php echo $atts['close_class']; ?>').on('click', function(e) {
			$('#alert-container-<?php echo $dialog_id; ?>').fadeOut(50);
			$('#alert-<?php echo $dialog_id; ?>').addClass('hide');	
			$('#blur-overlay').removeClass('blur-active');
			$('#blur-overlay').css('pointer-events', 'auto');
			$('body').css('overflow', 'auto'); 
			});

			// Apre Dialog
			$('#<?php echo $atts['trigger_element']; ?>').on('click', function(e) {
			$('#alert-container-<?php echo $dialog_id; ?>').fadeIn(50);	
			$('#alert-<?php echo $dialog_id; ?>').removeClass('hide');	
			$('#blur-overlay').addClass('blur-active'); 
			$('#blur-overlay').css('pointer-events', 'auto');
			$('body').css('overflow', 'auto');
			});

			// Pulsante conferma
			$('#<?php echo $atts['button_1_id']; ?>').on('click', function(e) {
			e.preventDefault();
			if(typeof window.pbDialogCallbacks['<?php echo $dialog_id; ?>'] === "function"){
			window.pbDialogCallbacks['<?php echo $dialog_id; ?>']('btn-01');
			}
			});

			// Pulsante annulla
			$('#<?php echo $atts['button_2_id']; ?>').on('click', function(e) {
			e.preventDefault();
			if(typeof window.pbDialogCallbacks['<?php echo $dialog_id; ?>'] === "function"){
			window.pbDialogCallbacks['<?php echo $dialog_id; ?>']('btn-02');
			}
			});

			})(jQuery);

		</script>

		<style>
			#blur-overlay.blur-active {
				position: fixed;
				z-index: 1;
				top: 0;
				left: 0;
				width: 100vw;
				height: 100vh;
				inset: 0;
				background: rgba(0,0,0,0.3); /* colore + trasparenza */
				backdrop-filter: blur(8px);
				-webkit-backdrop-filter: blur(8px); /* Safari support */
			}
		</style>

		<?php

			$o = ob_get_clean();
			
			return $o;
		
	}

	add_shortcode('pb_dialog', 'pb_dialog_shortcode');
