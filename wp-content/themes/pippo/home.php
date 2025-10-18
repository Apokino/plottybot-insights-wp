<?php 



		get_header();
	
		// if (current_user_can("administrator")) { RG-WEBDEV: BK
		
		if (is_user_logged_in()) { 
		
?>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const textarea = document.getElementById("book-description");

            const prefix = "<?php echo $ita ? 'Descrivi qui la tua idea. Esempio: ' : 'Describe your idea here. Example: '; ?>";
            const suffix = "";

            const variations = [
                "<?php echo $ita ? 'Un corso di chitarra adatto ai miei gusti musicali e livello' : 'A guitar course tailored to my music tastes and skill level'; ?>",
                "<?php echo $ita ? 'Un romanzo d’avventura con il mio cane come eroe' : 'A novel starring my dog as the hero'; ?>",
                "<?php echo $ita ? 'Un’avventura spaziale con il mio gatto come astronauta' : 'A space adventure with my cat as an astronaut'; ?>",
                "<?php echo $ita ? 'Un romanzo fantasy ambientato nel mio piccolo paese' : 'A fantasy novel set in my small hometown'; ?>",
                "<?php echo $ita ? 'Un corso di fotografia per il mio livello e la mia macchina fotografica' : 'A photography course designed for my level and my camera'; ?>",
                "<?php echo $ita ? 'Un ricettario costruito sui miei gusti e le mie intolleranze' : 'A cookbook built around my tastes and food intolerances'; ?>",
                "<?php echo $ita ? 'Un metodo di studio personalizzato per il mio corso universitario' : 'A personalized study method for my university course'; ?>",
                "<?php echo $ita ? 'Un manuale di risparmio personale cucito sulle mie abitudini' : 'A personal finance guide tailored to my habits'; ?>",
                "<?php echo $ita ? 'Un manuale di yoga personalizzato per le mie esigenze fisiche' : 'A yoga guide tailored to my physical needs'; ?>",
                "<?php echo $ita ? 'Un romanzo storico ambientato nel paese dei miei nonni' : 'A historical novel set in my grandparents’ hometown'; ?>",
                "<?php echo $ita ? 'Una raccolta di fiabe con i miei figli come protagonisti' : 'A collection of fairy tales starring my children'; ?>",
                "<?php echo $ita ? 'Un corso di fitness che si adatta al mio spazio e attrezzatura' : 'A fitness course adapted to my space and equipment'; ?>",
                "<?php echo $ita ? 'Un corso di lingue con esercizi basati sul mio livello' : 'A language course with exercises based on my level'; ?>",
                "<?php echo $ita ? 'Un manuale pratico per curare le piante del mio balcone' : 'A practical guide to taking care of the plants on my balcony'; ?>",
                "<?php echo $ita ? 'Un manuale per organizzare viaggi secondo le mie esigenze e budget' : 'A guide to planning trips according to my needs and budget'; ?>",
                "<?php echo $ita ? 'Un romanzo noir con me come detective privato' : 'A noir novel with me as a private investigator'; ?>",
                "<?php echo $ita ? 'Un diario di crescita personale con esercizi su misura per me' : 'A personal growth diary with exercises tailored to me'; ?>",
                "<?php echo $ita ? 'Un corso di cucina con ricette adatte ai miei gusti e abilità' : 'A cooking course with recipes suited to my taste and skills'; ?>",
                "<?php echo $ita ? 'Un manuale di scrittura creativa basato sul mio stile personale' : 'A creative writing guide based on my personal style'; ?>",
                "<?php echo $ita ? 'Un manuale di sopravvivenza digitale per gestire il mio smartphone' : 'A digital survival guide for managing my smartphone'; ?>",
                "<?php echo $ita ? 'Una guida di viaggio nei luoghi che sogno di visitare' : 'A travel guide to the places I dream of visiting'; ?>",
                "<?php echo $ita ? 'Un romanzo romantico ispirato alla mia storia d’amore' : 'A romantic novel inspired by my love story'; ?>",
                "<?php echo $ita ? 'Una guida motivazionale basata sui miei obiettivi personali' : 'A motivational guide based on my personal goals'; ?>",
                "<?php echo $ita ? 'Un giallo ambientato nella mia scuola con i miei compagni come sospettati' : 'A mystery set in my school with my classmates as suspects'; ?>",
                "<?php echo $ita ? 'Un’avventura piratesca con me e i miei amici come ciurma' : 'A pirate adventure with me and my friends as the crew'; ?>",
                "<?php echo $ita ? 'Un romanzo distopico con la mia città sotto dittatura' : 'A dystopian novel with my city under dictatorship'; ?>",
                "<?php echo $ita ? 'Un thriller ambientato nel posto dove lavoro ogni giorno' : 'A thriller set in the place where I work every day'; ?>",
                "<?php echo $ita ? 'Un thriller psicologico con il mio vicino come enigma da svelare' : 'A psychological thriller with my neighbor as the enigma to uncover'; ?>",
                "<?php echo $ita ? 'Un’avventura urbana nella mia città con me come supereroe' : 'An urban adventure set in my city with me as a superhero'; ?>",
                "<?php echo $ita ? 'Un romanzo di guerra con me come soldato protagonista' : 'A war novel with me as the main soldier'; ?>",
                "<?php echo $ita ? 'Un romanzo fantasy con me come eroe prescelto' : 'A fantasy novel with me as the chosen hero'; ?>",
                "<?php echo $ita ? 'Un racconto horror con me come unico sopravvissuto' : 'A horror story with me as the sole survivor'; ?>"
            ];

            const variationsCount = variations.length; // numero totale di frasi
            let typingTimer;
            let placeholderActive = true;

            // Array che tiene traccia degli ultimi picks
            let lastPicks = [];

            function getRandomIndexExcludingRecent() {
                const availableIndexes = variations.map((_, i) => i).filter(i => !lastPicks.includes(i));
                if (availableIndexes.length === 0) {
                    // Tutti gli ultimi "variations.length - 1" sono stati usati → reset
                    lastPicks = [];
                    return Math.floor(Math.random() * variationsCount);
                }
                return availableIndexes[Math.floor(Math.random() * availableIndexes.length)];
            }

            function typeWriterEffect(variableText, callback) {
                let i = 0;
                textarea.placeholder = prefix + "" + suffix;

                function typing() {
                    if (!placeholderActive) return;
                    if (i < variableText.length) {
                        const currentVar = variableText.slice(0, i + 1);
                        textarea.placeholder = prefix + currentVar + suffix;
                        i++;
                        typingTimer = setTimeout(typing, 40);
                    } else {
                        typingTimer = setTimeout(() => {
                            if (!placeholderActive) return;
                            eraseEffect(variableText, callback);
                        }, 3000);
                    }
                }
                typing();
            }

            function eraseEffect(variableText, callback) {
                let n = variableText.length;

                function erasing() {
                    if (!placeholderActive) return;
                    if (n > 0) {
                        n--;
                        const currentVar = variableText.slice(0, n);
                        textarea.placeholder = prefix + currentVar + suffix;
                        typingTimer = setTimeout(erasing, 10);
                    } else {
                        callback();
                    }
                }
                erasing();
            }

            function cyclePlaceholders() {
                const randomIndex = getRandomIndexExcludingRecent();
                const variableText = variations[randomIndex];

                // Aggiorna la lista degli ultimi picks, memorizzando variations.length - 1
                lastPicks.push(randomIndex);
                if (lastPicks.length > variationsCount - 1) lastPicks.shift();

                typeWriterEffect(variableText, cyclePlaceholders);
            }

            cyclePlaceholders();

            textarea.addEventListener("focus", () => {
                placeholderActive = false;
                clearTimeout(typingTimer);
                textarea.placeholder = "";
            });

            textarea.addEventListener("blur", () => {
                if (textarea.value.trim() === "") {
                    placeholderActive = true;
                    cyclePlaceholders();
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
	<script>

		$(document).ready(function() {
            
            
            function inviaModulo(description) {

                // updateTemplateField(); // <--- PAOLO M UPDATE - AGGIUNGO CAMPO TEMPLATE

                // Carica la libreria FingerprintJS e ottieni la fingerprint
                FingerprintJS.load().then(fp => {
                    fp.get().then(result => {
                        const visitorId = result.visitorId; // fingerprint unica del browser

                        // Raccogli i dati del modulo
                        var formData = new FormData();

                        // Aggiungi dati statici
                        formData.append('language', $('select[name="language"]').val());
                        formData.append('index', description);
                        formData.append('visitorId', visitorId); // aggiunta fingerprint

                        // Esegui la chiamata AJAX
                        $.ajax({
                            url: 'https://plottybot.com/wp-content/themes/pippo/action/add_to_cart.php',
                            type: 'POST',
                            data: formData,
                            processData: false, // Necessario per FormData
                            contentType: false, // Necessario per FormData

                            beforeSend: function () {
                                $('body').css('pointer-events', 'none');
                                $('body').css('opacity', '0.4');
                            },

                            success: function (result) {
                                if (result.success === false) {
                                    /*
                                    alert(result.data?.message || 'Error!');
                                    $('#write, #improve').prop('disabled', false); // riabilita pulsanti
                                    $('#write').html($('#write').data('original-html'));
                                    */
                                    var error_id = result.data.message;
                                    var error_path = "#save-alert-container " + error_id;
                                    $('#write, #improve').prop('disabled', true); // RG-WEBDEV
                                    $('#above-the-fold').css('pointer-events', 'none'); // RG-WEBDEV
                                    $('body').css('overflow', 'hidden'); // RG-WEBDEV
                                    $('#save-alert-container .single-express-error').addClass('hide'); // nasconde gli altri errori
                                    $('#save-alert-container').fadeIn(50);
                                    $(error_path).removeClass('hide');
                                    $('#above-the-fold').addClass('blur'); // RG-WEBDEV
                                } else {
                                    window.location.href = 'https://plottybot.com/checkout';
                                }
                            },

                            error: function (xhr, status, error) {
                                // Gestisci gli errori di comunicazione o di altro genere
                                $('#write, #improve').prop('disabled', false);
                                $('#write').html($('#write').data('original-html'));
                            },

                            complete: function () {
                                $('body').css('pointer-events', 'auto');
                                $('body').css('opacity', '1');
                            }

                        });

                    });
                });

            }
            
            /*
			// RG-WEBDEV: Aggiunto come implementazione per pb express
			function inviaModulo(description) {

				// updateTemplateField(); // <--- PAOLO M UPDATE - AGGIUNGO CAMPO TEMPLATE

				// Raccogli i dati del modulo
				var formData = new FormData();

				// Aggiungi dati statici
				formData.append('language', $('select[name="language"]').val());
				formData.append('index', description);

				// Esegui la chiamata AJAX

				$.ajax({

					url: 'https://plottybot.com/wp-content/themes/pippo/action/add_to_cart.php',
					type: 'POST',
					data: formData,
					//timeout: 21600000, // 6 ore
					processData: false, // Necessario per FormData
					contentType: false, // Necessario per FormData

					success: function (result) {
						if (result.success === false) {
							alert(result.data?.message || 'Error!');
						} else {
							window.location.href = 'https://plottybot.com/checkout';
						}
					},
					error: function(xhr, status, error) {
						// Gestisci gli errori di comunicazione o di altro genere
						$('#write, #improve').prop('disabled', false); // RG-WEBDEV
						$('#write').html($('#write').data('original-html')); // Salva l'HTML originale
					},
					beforeSend: function () {
						$('body').css('pointer-events', 'none');
						$('body').css('opacity', '0.4');
					},
					complete: function () {
						$('body').css('pointer-events', 'auto');
						$('body').css('opacity', '1');
					}

				});

			}
            */
			// ----

			function attachAutoExpand(textarea) {

				textarea.style.overflow = "hidden"; // Nasconde lo scrolling interno
				textarea.style.resize = "none"; // Evita il ridimensionamento manuale

				function adjustHeight() {

					let currentLines = textarea.value.split("\n").length; // Conta le righe attuali

					// Se non è memorizzato il numero di righe iniziale, lo salva
					if (!textarea.dataset.prevLines) {
						textarea.dataset.prevLines = textarea.rows || 1; // Usa l'attributo rows o imposta 1 di default
					}

					let prevLines = parseInt(textarea.dataset.prevLines, 10);

					if (currentLines > prevLines) {
						textarea.style.height = textarea.scrollHeight + "px";
					}

					// Aggiorna il numero di righe precedente
					textarea.dataset.prevLines = currentLines;

					// Resetta temporaneamente l'altezza per ricalcolarla
					textarea.style.height = "auto";

					// Se il contenuto supera l'altezza attuale, espande la textarea
					if (textarea.scrollHeight > textarea.clientHeight) {
						textarea.style.height = textarea.scrollHeight + "px";
					}

				}

				textarea.addEventListener('keyup', adjustHeight);
				textarea.addEventListener('keypress', adjustHeight);
				textarea.addEventListener('paste', () => setTimeout(adjustHeight, 100));

				adjustHeight(); // Inizializza l'altezza al caricamento

			}

			// Osserva il DOM per nuove textarea
			const observer = new MutationObserver(mutations => {
				mutations.forEach(mutation => {
					mutation.addedNodes.forEach(node => {
						if (node.tagName === "TEXTAREA") {
							attachAutoExpand(node);
							// updateCounters(node, 350);
						} else if (node.querySelectorAll) {
							node.querySelectorAll('textarea').forEach(attachAutoExpand);
							// node.querySelectorAll('textarea.plot_section').forEach((textarea) => textarea.addEventListener('input', (e) => updateCounters(textarea, 350)));
							// node.querySelectorAll('textarea.characters_section').forEach((textarea) => textarea.addEventListener('input', (e) => updateCounters(textarea, 200)));
						}
					});
				});
			});

			// Avvia l'osservatore sul `body`
			observer.observe(document.body, { childList: true, subtree: true });
			document.querySelectorAll('textarea').forEach(attachAutoExpand);

			$('#improve').on('click', function(e) {

				e.preventDefault();

				var text_length = $('#book-description').val();

				if (text_length.length < 10) {

					// alert('Inserisci un\'idea per il tuo libro, dopodiché potrò migliorarla.'); // RG-WEBDEV: Rimosso

					$('#write, #improve').prop('disabled', true); // RG-WEBDEV
					$('#above-the-fold').css('pointer-events', 'none'); // RG-WEBDEV
					$('body').css('overflow', 'hidden'); // RG-WEBDEV
					$('#save-alert-container .single-express-error').addClass('hide'); // nasconde gli altri errori
					$('#save-alert-container').fadeIn(50);
					$('#save-alert-container #pb-express-error-1').removeClass('hide');
					$('#above-the-fold').addClass('blur'); // RG-WEBDEV

				} else {

					const $textarea = $('#book-description');
					const originalText = $textarea.val();

					const $button = $(this);
					$textarea.addClass('analyzing');
					$button.prop('disabled', true).text('In corso...');

					var formData = new FormData();
					formData.append('input', originalText);

					console.log(originalText);

					$.ajax({
						url: 'https://plottybot.com/wp-content/themes/pippo/action/improve.php',
						type: 'POST',
						data: formData,
						processData: false, // Necessario per FormData
						contentType: false, // Necessario per FormData
						success: function(response) {
							if (response.output) {
								animateMagicText($textarea, response.output);
								$textarea.removeClass('analyzing');
							} else {
								alert("Errore: nessuna risposta ricevuta.");
								$textarea.removeClass('analyzing');
								$button.prop('disabled', false).text('Migliora prompt');
							}
						},
						error: function() {
							alert("Errore nella richiesta. Riprova.");
							$textarea.removeClass('analyzing');
							$button.prop('disabled', false).text('Migliora prompt');
						}
					});
				}
			});

			$('#write').on('click', function(e) {

				e.preventDefault();

				var selectedLang = $('#lang').val();

				if (selectedLang === 'x') {

					$('#write, #improve').prop('disabled', true); // RG-WEBDEV
					$('#above-the-fold').css('pointer-events', 'none'); // RG-WEBDEV
					$('body').css('overflow', 'hidden'); // RG-WEBDEV
					$('#save-alert-container .single-express-error').addClass('hide'); // nasconde gli altri errori
					$('#save-alert-container').fadeIn(50);
					$('#save-alert-container #pb-express-error-3').removeClass('hide');
					$('#above-the-fold').addClass('blur'); // RG-WEBDEV

				} else {

					var text_length = $('#book-description').val();

					if (text_length.length < 10) {

						$('#write, #improve').prop('disabled', true); // RG-WEBDEV
						$('#above-the-fold').css('pointer-events', 'none'); // RG-WEBDEV
						$('body').css('overflow', 'hidden'); // RG-WEBDEV
						$('#save-alert-container .single-express-error').addClass('hide'); // nasconde gli altri errori
						$('#save-alert-container').fadeIn(50);
						$('#save-alert-container #pb-express-error-2').removeClass('hide');
						$('#above-the-fold').addClass('blur'); // RG-WEBDEV

					} else {

						const $textarea = $('#book-description');
						const originalText = $textarea.val();

						inviaModulo(originalText);
					}
				}

			});

			function adjustHeightNow(textarea) {
				textarea.style.height = 'auto';
				textarea.style.height = textarea.scrollHeight + 'px';
			}

			function animateMagicText($el, newText) {

				$el.css({
					color: 'rgba(0, 0, 0, 0.7)',
					transition: 'color 0.3s ease-in-out'
				});

				const textarea = $el[0];
				textarea.value = '';
				let index = 0;

				const interval = setInterval(() => {
					if (index < newText.length) {
						textarea.value += newText.charAt(index);
						adjustHeightNow(textarea);
						index++;
					} else {
						clearInterval(interval);
						setTimeout(() => {
							$el.css('color', '');
							$("#improve").prop('disabled', false).text('Migliora prompt');
						}, 100);
					}
				}, 20);

			}

			// RG-WEBDEV
			$('.close-save-alert').on('click', function(e) { 
				$('#save-alert-container').fadeOut(50);
				$('#save-alert-container #pb-express-error-1').addClass('hide');
				$('#save-alert-container #pb-express-error-2').addClass('hide');
				$('#above-the-fold').removeClass('blur'); 
				$('#above-the-fold').css('pointer-events', 'auto'); // RG-WEBDEV
				$('body').css('overflow', 'auto'); // RG-WEBDEV
				$('#write, #improve').prop('disabled', false); // RG-WEBDEV
			});

			const tutorialLoader = (e) => {

				let videonum = '';

				const lang = "<?php echo ($ita) ? 'ita' : 'eng'; ?>";

				// ALBERTO: AGGIUNTO I CASI 04 E 05
				if ($(e.target).attr('id') === 'tutorial1') { // RG-WEBDEV: NUOVO --> $(this) con $(e.target)
					videonum = '01';
				} else if ($(e.target).attr('id') === 'tutorial2') { // RG-WEBDEV: NUOVO --> $(this) con $(e.target)
					videonum = '02';
				} else if ($(e.target).attr('id') === 'tutorial3') { // RG-WEBDEV: NUOVO --> $(this) con $(e.target)
					videonum = '03';
				} else if ($(e.target).attr('id') === 'tutorial4') { // RG-WEBDEV: NUOVO --> $(this) con $(e.target)
					videonum = '04';
				} else if ($(e.target).attr('id') === 'tutorial5') { // RG-WEBDEV: NUOVO --> $(this) con $(e.target)
					videonum = '05';
				} else if ($(e.target).attr('id') === 'tutorial6') { // RG-WEBDEV: NUOVO --> $(this) con $(e.target)
					videonum = '06';
				}

				if (lang === 'ita') {
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
					<div class="video-container small" style="display: none;">
					<video id="custom-video" class="custom-video small">
					<source src="https://plottybot.com/video/` + lang_short + `/tutorial/${videonum}.mp4" type="video/mp4">
					` + no_video + `
					</video>
					<span id="play-btn" class="play-btn">
					<!-- <span class="icon-play"> RG-WEBDEV: BK -->
					<!-- RG-WEBDEV: NUOVO -->
					<span class="pb-icon__before--round-filled-play-xl-primary"></span>
					<!-- **** -->
					</span>
					</div>
					<!--<span class="close-video-alert">CHIUDI</span> RG-WEBDEB: Rimosso -->
				`;

				$('#video-alert-2 .video').html(videoHtml);
				$('#video-alert-container-2').fadeIn(50);
				$('#alert-wrapper-2').addClass('alert-wrapper-enabled-2'); // RG-WEBDEV
				$('#above-the-fold').addClass('blur');
				$('#above-the-fold').css('pointer-events', 'none'); // RG-WEBDEV

				let video = document.getElementById('custom-video');

				if (video) {

					video.load();

					// Mostra il video solo quando è pronto
					$(video).on('canplay', function () {
						$('.video-loading').remove(); // Rimuove il messaggio
						$('.video-container').fadeIn(50); // Mostra il video
						$('#alert-wrapper-2').addClass('alert-wrapper-enabled-2'); // RG-WEBDEV
						video.play().catch(error => console.error('Autoplay bloccato:', error));
					});

					// Riassocia gli eventi
					let container = $('.video-container');
					let playBtn = container.find('.play-btn');

					playBtn.click(function () {
						if (video.paused) {
							$('.custom-video').each(function () {
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
					$('.close-video-alert').click(function () {
						if (video) {
							video.pause();
						}
						$('#video-alert-container-2').fadeOut(50);
						$('#alert-wrapper-2').removeClass('alert-wrapper-enabled-2'); // RG-WEBDEV
						$('#above-the-fold').removeClass('blur');
						$('#above-the-fold').css('pointer-events', 'auto'); // RG-WEBDEV
					});

				}

			}

			$('.hp_tutorial_remainder').on('click', (e) => tutorialLoader(e)); // RG-WEBDEV: NUOVO
			// -----

		});

	</script>

	<style>

		#plottybot-lite {
			width: 100%;
			max-width: 766px;
		}

		#write {
			background: -webkit-linear-gradient(-45deg, #24838C, #00c2a8);
            position: relative;
            overflow: hidden;
		}
        
        #write::after {
            content: "";
            position: absolute;
            top: 0;
            left: -110%;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.3);
            transform: skewX(-20deg);
        }
        #write:hover::after {
            left: 110%;
            transition: left 0.6s ease;
        }
		
		.gradient-color {
			position: relative;
			display: inline-block;
			vertical-align: text-top;
			background: linear-gradient(135deg, #31ddc5, #31A3DD);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			white-space: nowrap;
			overflow: hidden;
		}

		/* Shine overlay */
		.gradient-color::before {
			content: '';
			position: absolute;
			top: 0;
			left: -75%;
			height: 100%;
			width: 50%;
			background: linear-gradient(
				120deg,
				rgba(255, 255, 255, 0) 0%,
				rgba(255, 255, 255, 0.4) 50%,
				rgba(255, 255, 255, 0) 100%
			);
			transform: skewX(-20deg);
			animation: shine 3s infinite;
		}

		/* Keyframe per il riflesso */
		@keyframes shine {
			0% {
				left: -75%;
			}
			100% {
				left: 125%;
			}
		}

		.home-gradient {
			display: inline-block;
			text-align: center;
			background: -webkit-linear-gradient(0deg, #24838C, #1abc9c);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		.textarea-container {
			display: flex;
			flex-direction: column;
			position: relative;
			overflow: hidden;
			/* box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
			border-radius: 24px;
			background: -webkit-linear-gradient(0deg, #24838C, #1abc9c); RG-WEBDEV: Rimosso */
			padding: 1px;
		}

		.textarea-container textarea {
			/*width: 100%;
			padding: 16px;
			box-sizing: border-box;
			border: none;
			resize: vertical;
			font-size: 16px;
			line-height: 1.5;
			border-radius: 0;*//* RG-WEBDEV: Rimosso */
			outline: none;
		}

		#book-description {
			/* border-radius: 23px 23px 0 0; RG-WEBDEV: Rimosso */
			min-height: 40px !important; /* RG-WEBDEV */
			border-bottom: none; /* RG-WEBDEV */
			border-bottom-left-radius: unset; /* RG-WEBDEV */
			border-bottom-right-radius: unset; /* RG-WEBDEV */
			margin-bottom: 0 !important; /* RG-WEBDEV */
			color: var(--color-neutral-100);
		}

		#options-bar-container {
			display: flex;
			height: 80px;
			justify-content: space-between;
			align-items: end;
			border: 1px solid var(--color-neutral-50); /* RG-WEBDEV */
			border-top: none; /* RG-WEBDEV */
			border-bottom-left-radius: var(--radius-medium); /* RG-WEBDEV: Modificato */
			border-bottom-right-radius: var(--radius-medium); /* RG-WEBDEV: Modificato */
			background: var(--color-neutral-00); /* RG-WEBDEV: Modificato #f5f5f5; */
			/*padding: 4px; RG-WEBDEV: Modificato */
		}

		/* RG-WEBDEV: Aggiunto */
		.textarea-container textarea:hover + #options-bar-container {
			border-bottom: 1px solid var(--color-neutral-60);
			border-left: 1px solid var(--color-neutral-60);
			border-right: 1px solid var(--color-neutral-60);
		}

		.textarea-container textarea:focus + #options-bar-container {
			border-bottom: 1px solid var(--color-primary-60);
			border-left: 1px solid var(--color-primary-60);
			border-right: 1px solid var(--color-primary-60);
		}

		/**/

		.options-bar {
			bottom: 0;
			left: 0;
			/* background: #f5f5f5; RG-WEBDEV: Rimosso */
			margin: 8px 10px;
			display: flex;
			justify-content: flex-start;
			align-items: center;
			gap: 8px;
		}

		/*.options-bar button, select {
		padding: 4px 16px;
		border-radius: 99px;
		cursor: pointer;
		font-size: 14px;
		transition: background 0.2s;
		font-weight: 400;
		}*//* RG-WEBDEV: Rimosso */

		/*.options-bar button {
		background: #e5e5e5;
		border: none;
		}*//* RG-WEBDEV: Rimosso */

		/*.options-bar #write {
		padding: 4px 16px;
		border-radius: 99px;
		cursor: pointer;
		font-size: 14px;
		color: #fff;
		font-weight: 700;
		border: none;
		background: -webkit-linear-gradient(0deg, #24838C, #1abc9c);
		} RG-WEBDEV: Rimosso */

		/*.options-bar select {
		background: #fff;
		border: 1px solid #e5e5e5;
		-webkit-appearance: none;
		appearance: none;
		-moz-appearance: none;
		} RG-WEBDEV: Rimosso */

		.options-bar select:focus {
			outline: none;
		}

		/* .options-bar button:hover {
		background: #d2d2d2;
		} RG-WEBDEV: Rimosso */

		@keyframes analyzingPulse {
			0% { color: rgba(26,188,156,1); }
			100% { color: rgba(26,188,156,0); }
		}

		textarea.analyzing {
			animation: analyzingPulse 1.5s forwards;
		}
        
        .shimmer {
            line-height: 1.2;
            display: inline-block;
            background: linear-gradient(90deg, #009c86, #c7e1dd, #009c86);
            background-size: 200% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 4s infinite linear;
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        .waiting-box {
            background: rgba(255,255,255,0.5);
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 12px;
            padding: 1em 1.4em;
            margin: 1em auto 0.5em !important;
            max-width: 800px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            line-height: 1.5em;
            font-weight: 700 !important;
        }
        
        .waiting-box a, .waiting-box a:visited {
            background: -webkit-linear-gradient(0deg, #24838C, #1abc9c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .toast-component.toast--warning {
            border: 2px solid var(--color-warning-80);
            background-color: var(--color-warning-00);
        }
        .toast-component {
            text-align: left;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-direction: row;
            flex-wrap: wrap;
            width: 100%;
            margin: var(--spacing-8) 0;
            padding: var(--spacing-8) var(--spacing-16);
            border: 2px solid var(--color-primary-50);
            background-color: var(--color-neutral-00);
            border-radius: var(--radius-medium);
            box-sizing: border-box;
            font-size: 12px !important;
        }
        
        .toast-component > div:first-of-type {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: var(--spacing-8);
            /* width: 10%; */
            height: 100%;
            font-size: 12px !important;
        }
        
        .toast-component > div > div:last-of-type {
            margin-left: var(--spacing-8);
            font-size: 12px !important;
        }

	</style>

<?php 

		// }

?>

	<script>

		document.addEventListener('DOMContentLoaded', () => {

			// Osserva gli elementi .pop
			const popElements = document.querySelectorAll('.pop');

			const observer = new IntersectionObserver((entries) => {

				entries.forEach(entry => {
					if (entry.isIntersecting) {
						entry.target.classList.add('show');
						observer.unobserve(entry.target);
					}
				});

			}, { threshold: 0.1 });

			popElements.forEach(element => {
				observer.observe(element);
			});

			// Osserva gli elementi .why_block
			const whyBlockElements = document.querySelectorAll('#why_container .why_block');

			const whyBlockObserver = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					if (entry.isIntersecting) {
						entry.target.classList.add('show');
						whyBlockObserver.unobserve(entry.target);
					}
				});
			}, { threshold: 0.1 });

			whyBlockElements.forEach(element => {
				whyBlockObserver.observe(element);
			});

		});

	</script>

	<style>

		#above-the-fold {
			position: relative;
			height: 100vh;
			background: transparent;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.container {
			width: 100%;
			height: 100%;
			position: relative;
			text-align: center;
			opacity: var(--sds-size-stroke-border);
			background: var(--gradient-home, linear-gradient(to bottom right, rgba(255, 193, 170, 0.20) 22%, rgba(255, 193, 170, 0.00) 50%) bottom right / 50% 50% no-repeat, linear-gradient(to bottom left, rgba(255, 193, 170, 0.20) 22%, rgba(255, 193, 170, 0.00) 50%) bottom left / 50% 50% no-repeat, linear-gradient(to top left, rgba(255, 193, 170, 0.20) 22%, rgba(255, 193, 170, 0.00) 50%) top left / 50% 50% no-repeat, linear-gradient(to top right, rgba(255, 193, 170, 0.20) 22%, rgba(255, 193, 170, 0.00) 50%) top right / 50% 50% no-repeat, conic-gradient(from 167deg at 83.65% 32.26%, rgba(205, 171, 255, 0.00) 0deg, rgba(205, 171, 255, 0.16) 360deg), linear-gradient(to bottom right, rgba(255, 252, 171, 0.20) 19%, rgba(255, 252, 171, 0.00) 50%) bottom right / 50% 50% no-repeat, linear-gradient(to bottom left, rgba(255, 252, 171, 0.20) 19%, rgba(255, 252, 171, 0.00) 50%) bottom left / 50% 50% no-repeat, linear-gradient(to top left, rgba(255, 252, 171, 0.20) 19%, rgba(255, 252, 171, 0.00) 50%) top left / 50% 50% no-repeat, linear-gradient(to top right, rgba(255, 252, 171, 0.20) 19%, rgba(255, 252, 171, 0.00) 50%) top right / 50% 50% no-repeat, conic-gradient(from 233deg at 90.9% 69.01%, #FCF8F8 0deg, #CAF9FF 179.4901978969574deg, rgba(69, 157, 166, 0.05) 360deg));
		}

		.logo {
			position: absolute;
			top: 20px;
			left: 20px;
		}

		.logo h1 {
			margin: 0;
			font-size: 24px;
			color: #333;
		}

		.hero-text {
			height: calc(100vh - 162px);
			padding-bottom: 87px;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
		}

		.hero-text h2 {
			margin: 0;
			font-size: 48px;
			color: #333;
		}

		.home_block {
			margin: var(--spacing-64); /* RG-WEBDEV: Modificato da 96px 0; */
		}

		.home_block h2 {
			margin: 0 4% 30px;
		}

		#how_it_works {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			background: #fff;
			padding: 24px 24px 48px;
			border-radius: 48px;
		}

		#how_it_works .vertical_section {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
		}

		.story_left, .story_right {
			flex: 1;
			height: 200px;
			padding: 48px;
		}

		.story_left {
			text-align: right;
		}

		.story_right {
			text-align: left;
		}

		.story_center {
			width: 0;
			border: 2px dashed #1abc9c;
			height: 200px;
			position: relative; /* Necessario per posizionare il cerchio assolutamente */
			margin: 0 auto;
		}

		.circle {
			width: 48px;
			height: 48px;
			background-color: #fff;
			border: 2px solid #24838C;
			border-radius: 50%;
			position: absolute;
			left: 50%; /* Centra orizzontalmente */
			transform: translateX(-50%); /* Corregge l'offset per il cerchio */
			display: flex;
			justify-content: center;
			align-items: center;
			font-size: 24px;
			font-weight: bold;
			color: #24838C;
		}

		/* Centra il cerchio verticalmente in ogni story */
		#story_1 .circle {
			top: 50%; /* Al centro verticale della story */
			transform: translate(-50%, -50%);
		}

		#story_2 .circle {
			top: 50%;
			transform: translate(-50%, -50%);
		}

		#story_3 .circle {
			top: 50%;
			transform: translate(-50%, -50%);
		}

		#why_container {
			display: flex;
			justify-content: space-evenly;
			align-items: stretch;
			flex-direction: row;
		}

		#why_us h3 {
			margin-top: 0;
			display: flex;
			align-items: center;
		}

		.why_block {
			background-color: white;
			padding: 24px;
			border-radius: 16px;
			width: 28%;
		}

		.why_block img {
			margin-right: 16px;
		}

		.why_block:nth-child(1).show {
			animation-delay: 0s;
		}

		.why_block:nth-child(2).show {
			animation-delay: 0.3s;
		}

		.why_block:nth-child(3).show {
			animation-delay: 0.6s;
		}

		/* Animazione per .pop */
		.pop {
			opacity: 0; /* Iniziamo con l'elemento invisibile */
			transform: translateY(20px); /* Posizioniamo l'elemento un po' più in basso */
			transition: opacity 0.5s ease, transform 0.5s ease;
		}

		.pop.show {
			opacity: 1;
			animation: bounceIn 0.9s forwards;
		}

		@keyframes bounceIn {
			0% {
				transform: translateY(20px);
				opacity: 0;
			}
			30% {
				transform: translateY(-10px);
				opacity: 0.5;
			}
			60% {
				transform: translateY(5px);
				opacity: 1;
			}
			100% {
				transform: translateY(0);
			}
		}

		@media screen and (max-width:999px) {

			.hero-text { /* RG-WEBDEV */
				height: auto !important;
				padding: 16px;
			}
			
			#improve {
				font-size: 0 !important;
				width: 48px;
				height: 40px;
				border-radius: 99px;
				padding: 0;
				text-align: center;
                display: inline-block;
			}
			
			#options-bar-container, 
			#options-bar-container .options-bar {
				flex-direction: row;
				justify-content: center;
				align-items: center;
				height: auto;
			}
			
			#options-bar-container { /* sovrascrive sopra */
				flex-direction: column;
				padding-bottom: 8px;
			}
			
			.pb-icon__before--sparkle-s-white::before {
				margin-left: 0 !important;
				width: 24px;
				height: 24px;
				margin-right: 0 !important;
                display: inline-block;
			}
			
			.text--heading-xl {
				font-size: 36px !important;
			}

			#how_it_works .vertical_section {
				flex-direction: column;
			}

			#why_container {
				flex-direction: column;
			}

			.story_center {
				display: none;
			}

			.story_left, .story_right {
				padding: 24px;
			}

			#story_2 .story_left {
				order: 1;
			}

			.why_block {
				padding: 16px;
				width: 100%;
				margin: 12px 0;
			}

		}

		@media screen and (max-width:499px) {

			#book-description { /* RG-WEBDEV */
				height: auto;
				min-height: 80px !important;
			}


			.hero-text h2 {
				font-size: 24px;
			}

			.home_block {
				margin: 48px 0;
			}

			.home_block h2 {
				margin: 0 4% 12px;
			}

			.story_left, .story_right {
				padding: 0;
			}

			#story_2, #story_3 {
				margin-top: 24px;
			}
            
            
            #options-bar-container, 
			#options-bar-container .options-bar {
                width: 100%;
                padding: 0 4%;
			}
            
            #options-bar-container {
                padding-bottom: 4%;
			}
            
            #write {
                width: 100%;
            }

		}

	</style>

<?php 

	} else { 
		
?>

	<script>

		document.addEventListener('DOMContentLoaded', () => {
			
			// Osserva gli elementi .pop
			const popElements = document.querySelectorAll('.pop');

			const observer = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					if (entry.isIntersecting) {
						entry.target.classList.add('show');
						observer.unobserve(entry.target);
					}
				});
			}, { threshold: 0.1 });

			popElements.forEach(element => {
				observer.observe(element);
			});

			// Osserva gli elementi .why_block
			const whyBlockElements = document.querySelectorAll('#why_container .why_block');

			const whyBlockObserver = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					if (entry.isIntersecting) {
						entry.target.classList.add('show');
						whyBlockObserver.unobserve(entry.target);
					}
				});
			}, { threshold: 0.1 });

			whyBlockElements.forEach(element => {
				whyBlockObserver.observe(element);
			});

		});

	</script>

	<style>
		
		#above-the-fold {
			position: relative;
			height: 100vh;
			background: transparent;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.container {
			width: 100%;
			height: 100%;
			position: relative;
			text-align: center;
			opacity: var(--sds-size-stroke-border);
			background: var(--gradient-home, linear-gradient(to bottom right, rgba(255, 193, 170, 0.20) 22%, rgba(255, 193, 170, 0.00) 50%) bottom right / 50% 50% no-repeat, linear-gradient(to bottom left, rgba(255, 193, 170, 0.20) 22%, rgba(255, 193, 170, 0.00) 50%) bottom left / 50% 50% no-repeat, linear-gradient(to top left, rgba(255, 193, 170, 0.20) 22%, rgba(255, 193, 170, 0.00) 50%) top left / 50% 50% no-repeat, linear-gradient(to top right, rgba(255, 193, 170, 0.20) 22%, rgba(255, 193, 170, 0.00) 50%) top right / 50% 50% no-repeat, conic-gradient(from 167deg at 83.65% 32.26%, rgba(205, 171, 255, 0.00) 0deg, rgba(205, 171, 255, 0.16) 360deg), linear-gradient(to bottom right, rgba(255, 252, 171, 0.20) 19%, rgba(255, 252, 171, 0.00) 50%) bottom right / 50% 50% no-repeat, linear-gradient(to bottom left, rgba(255, 252, 171, 0.20) 19%, rgba(255, 252, 171, 0.00) 50%) bottom left / 50% 50% no-repeat, linear-gradient(to top left, rgba(255, 252, 171, 0.20) 19%, rgba(255, 252, 171, 0.00) 50%) top left / 50% 50% no-repeat, linear-gradient(to top right, rgba(255, 252, 171, 0.20) 19%, rgba(255, 252, 171, 0.00) 50%) top right / 50% 50% no-repeat, conic-gradient(from 233deg at 90.9% 69.01%, #FCF8F8 0deg, #CAF9FF 179.4901978969574deg, rgba(69, 157, 166, 0.05) 360deg));
		}

		.logo {
			position: absolute;
			top: 20px;
			left: 20px;
		}

		.logo h1 {
			margin: 0;
			font-size: 24px;
			color: #333;
		}

		.hero-text {
			height: calc(100vh - 192px);
			padding-bottom: 87px;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
		}

		.hero-text h2 {
			margin: 0;
			font-size: 48px;
			color: #333;
		}

		.home_block {
			margin: var(--spacing-64); /* RG-WEBDEV: Modificato da 96px 0; */
		}

		.home_block h2 {
			margin: 0 4% 30px;
		}

		#how_it_works {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			background: #fff;
			padding: 24px 24px 48px;
			border-radius: 48px;
			border: 1px solid var(--color-neutral-40); /* RG-WEBDEV */
		}

		#how_it_works .vertical_section {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
		}

		.story_left, .story_right { /* RG-WEBDEV: Modificato */
			flex: 1;
			height: 200px;
			padding: 0 var(--spacing-64); /* RG-WEBDEV: Modificato da 48px */
			display: flex; /* RG-WEBDEV */
			justify-content: center; /* RG-WEBDEV */
			flex-direction: column; /* RG-WEBDEV */
		}

		.story_left {
			text-align: right;
			align-items: flex-end; /* RG-WEBDEV */
		}

		.story_right {
			text-align: left;
			align-items: flex-start; /* RG-WEBDEV */
		}

		.story_center {
			width: 0;
			/*border: 2px dashed #1abc9c; RG-WEBDEV */
			height: 200px;
			position: relative; /* Necessario per posizionare il cerchio assolutamente */
			margin: 0 auto;
		}

		.circle {
			width: 48px;
			height: 48px;
			background-color: #fff;
			border: 2px solid #24838C;
			border-radius: 50%;
			position: absolute;
			left: 50%; /* Centra orizzontalmente */
			transform: translateX(-50%); /* Corregge l'offset per il cerchio */
			display: flex;
			justify-content: center;
			align-items: center;
			font-size: 24px;
			font-weight: bold;
			color: #24838C;
		}

		/* Centra il cerchio verticalmente in ogni story */
		#story_1 .circle {
			top: 50%; /* Al centro verticale della story */
			transform: translate(-50%, -50%);
		}

		#story_2 .circle {
			top: 50%;
			transform: translate(-50%, -50%);
		}

		#story_3 .circle {
			top: 50%;
			transform: translate(-50%, -50%);
		}

		#why_container {
			display: flex;
			justify-content: space-between; /* RG-WEBDEV: modificato da space-evenly */
			align-items: stretch;
			flex-direction: row;
		}

		#why_us h3 {
			margin-top: 0;
			display: flex;
			align-items: center;
		}

		.why_block {
			background-color: white;
			padding: 24px;
			border-radius: 16px;
			width: 28%;
			border: 1px solid var(--color-neutral-40); /* RG-WEBDEV */
		}

		.why_block img {
			margin-right: 16px;
		}

		.why_block:nth-child(1).show {
			animation-delay: 0s;
		}

		.why_block:nth-child(2).show {
			animation-delay: 0.3s;
		}

		.why_block:nth-child(3).show {
			animation-delay: 0.6s;
		}

		/* Animazione per .pop */
		.pop {
			opacity: 0; /* Iniziamo con l'elemento invisibile */
			transform: translateY(20px); /* Posizioniamo l'elemento un po' più in basso */
			transition: opacity 0.5s ease, transform 0.5s ease;
		}

		.pop.show {
			opacity: 1;
			animation: bounceIn 0.9s forwards;
		}

		@keyframes bounceIn {
			0% {
				transform: translateY(20px);
				opacity: 0;
			}
			30% {
				transform: translateY(-10px);
				opacity: 0.5;
			}
			60% {
				transform: translateY(5px);
				opacity: 1;
			}
			100% {
				transform: translateY(0);
			}
		}

		@media screen and (max-width:999px) {
			#how_it_works .vertical_section {
				flex-direction: column;
			}

			#why_container {
				flex-direction: column;
			}

			.story_center {
				display: none;
			}

			.story_left, .story_right {
				padding: 24px;
			}

			#story_2 .story_left {
				order: 1;
			}

			.why_block {
				padding: 16px;
				width: 100%;
				margin: 12px 0;
			}
		}

		@media screen and (max-width:499px) {

			.hero-text h2 {
				font-size: 24px;
			}

			.home_block {
				margin: 48px 0;
			}

			.home_block h2 {
				margin: 0 4% 12px;
			}

			.story_left, .story_right {
				padding: 0;
			}

			#story_2, #story_3 {
				margin-top: 24px;
			}
		}

		/* RG-WEBDEV */

		#masthead + div.hero-text > h2 {
			font-family: "Raleway", sans-serif;
			font-optical-sizing: auto;
			font-weight: 600;
			font-size: 48px;
			font-style: normal;
		}

		#masthead + div.hero-text > div button#write {
			border: none;
			font-family: "Raleway", sans-serif;
			font-optical-sizing: auto;
			font-style: normal;
		}

		#how_it_works > h2 {
			font-family: "Raleway", sans-serif;
			font-optical-sizing: auto;
			font-weight: 600;
			font-size: 45px;
			font-style: normal;
			margin: var(--spacing-16) var(--spacing-40) var(--spacing-64) var(--spacing-40);
		}

		#how_it_works h3, 
		#why_container h3 {
			font-family: "Raleway", sans-serif;
			font-optical-sizing: auto;
			font-weight: 700;
			font-size: 24px;
			font-style: normal;
		}

		#why_us > h2 {
			font-family: "Raleway", sans-serif;
			font-optical-sizing: auto;
			font-weight: 700;
			font-size: 32px;
			font-style: normal;
			margin: var(--spacing-64) 0;			
		}

		div.story_left, 
		div.story_right {
			font-family: "Roboto", sans-serif;
			font-optical-sizing: auto;
			font-weight: 400;
			font-style: normal;
			font-size: 16px;
			font-variation-settings: "wdth" 100;
		}

		div.story_center > span {
			border: 2px dashed #1abc9c;
			width: 100%;
			display: flex;
			position: absolute;
			right: -3px;
		}

		#story_1 div.story_center > span {
			top: 50%;
			height: 50%;
		}

		#story_2 div.story_center > span {
			top: 0%;
			height: 100%;
		}

		#story_3 div.story_center > span {
			bottom: 50%;
			height: 50%;
		}

		div.why_block {
			font-family: "Roboto", sans-serif;
			font-optical-sizing: auto;
			font-weight: 400;
			font-style: normal;
			font-size: 16px;
			font-variation-settings: "wdth" 100;
		}

	</style>

<?php
	
	}

	get_footer();