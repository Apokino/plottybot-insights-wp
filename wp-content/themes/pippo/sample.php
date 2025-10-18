<?php 

	/* Template Name: Sample */

	get_header();
		
	// if (is_user_logged_in()) { 

?>

	<style>
		code {
			width: 100%;
			height: 100%;
			display: block;
			padding: 20px;
			font-size: 10px !important;
			background-color: lightgray;
		}
		div.code {
			width: 100%;
			height: 100%;
			display: block;
			background-color: lavenderblush;
			padding: 20px;
			font-size: 14px;
			font-family: system-ui;
		}
	</style>

	<style>
		pre {
			counter-reset: line;
			background: #f6f8fa;
			padding: 1em;
			border-radius: 6px;
			font-family: monospace;
		}
		code {
			counter-increment: line;
			display: block;
		}
		code::before {
			content: counter(line);
			display: inline-block;
			width: 2em;
			margin-right: 1em;
			color: #888;
			text-align: right;
		}
		table {
			font-size: 12px;
		}
	</style>

	<!-- **** -->

	<h2>STILE GENERALE</h2>

	<br><br>

	<h4>CSS del design system</h4>
	<small>Definzione delle regole CSS di base e dei componenti HTML come previsto da design system.</small>
	<br><br>
	<iframe src="https://insights.plottybot.com/wp-content/themes/pippo/code.php" width="100%" height="600" style="border:1px solid black;"></iframe>

	<br><br>
	
	<table style="width:100%; border-collapse:collapse; font-family:sans-serif;">
		<thead style="background:#f3f3f3;">
			<tr>
				<th style="border:1px solid #ccc; padding:8px; text-align:left;">Righe</th>
				<th style="border:1px solid #ccc; padding:8px; text-align:left;">Descrizione</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="border:1px solid #ccc; padding:8px;">6–88</td>
				<td style="border:1px solid #ccc; padding:8px;">Definizione dei colori di base su livelli 00–100 di tonalità e suddivisi per gruppi</td>
			</tr>
			<tr>
				<td style="border:1px solid #ccc; padding:8px;">90–103</td>
				<td style="border:1px solid #ccc; padding:8px;">Definizione dei valori di spacing (utilizzabili nelle proprietà CSS di distanziamento: margin, padding, line-height...)</td>
			</tr>
			<tr>
				<td style="border:1px solid #ccc; padding:8px;">105–109</td>
				<td style="border:1px solid #ccc; padding:8px;">Definizione dei valori di ombreggiatura (proprietà CSS box-shadow)</td>
			</tr>
			<tr>
				<td style="border:1px solid #ccc; padding:8px;">118–122</td>
				<td style="border:1px solid #ccc; padding:8px;">Definizione dei valori responsive di breakpoint</td>
			</tr>
			<tr>
				<td style="border:1px solid #ccc; padding:8px;">143–153</td>
				<td style="border:1px solid #ccc; padding:8px;">Definizione delle classi tipografiche</td>
			</tr>
			<tr>
				<td style="border:1px solid #ccc; padding:8px;">168–377</td>
				<td style="border:1px solid #ccc; padding:8px;">Definizione delle classi da utilizzare per stilizzare i <strong>buttons</strong> secondo il design system</td>
			</tr>
			<tr>
				<td style="border:1px solid #ccc; padding:8px;">379–682</td>
				<td style="border:1px solid #ccc; padding:8px;">Definizione delle classi da utilizzare per stilizzare gli elementi di <strong>form</strong> secondo il design system</td>
			</tr>
			<tr>
				<td style="border:1px solid #ccc; padding:8px;">683–844</td>
				<td style="border:1px solid #ccc; padding:8px;">Definizione dei colori di base su livelli 00–100 di tonalità e suddivisi per gruppi</td>
			</tr>
			<tr>
				<td style="border:1px solid #ccc; padding:8px;">846–884</td>
				<td style="border:1px solid #ccc; padding:8px;">Definizione delle classi per il tag nav impiegato nei menù di navigazione del sito</td>
			</tr>
			<tr>
				<td style="border:1px solid #ccc; padding:8px;">886–1140</td>
				<td style="border:1px solid #ccc; padding:8px;">Definizione di classi helper e di classi relative a componenti strutturati</td>
			</tr>
		</tbody>
	</table>

	<h5>Esempio</h5>

	<div class="code">

		...

	</div>


	<br><br><br>

	<!-- **** -->

	<h2>ICONE DI PLOTTYBOT</h2>

	<br><br>

	<h4>Icone</h4>
	<small>Le icone del design system di PlottyBot. Sono associabili a buttons e altri componenti. Ogni icona è disponibile in diversi formati (su variazione di dimensione e colore). Per fare uso di una icona, applicare la classe all'elemento HTML scelto.</small>
	<br><br>
	<iframe src="https://insights.plottybot.com/wp-content/themes/pippo/pb-iconography.php" width="100%" height="300" style="border:1px solid black;"></iframe>

	<h5>Esempio</h5>

	<div class="code">

		<h5 style="font-size: 12px;"><i><b>Codice HTML</b></i></h5>
		
		&lt;button type="button" class="button button--primary button--sm pb-icon__before--search-s-white"&gt;TEST&lt;/button&gt;

		<br><br>

		<h5 style="font-size: 12px;"><i><b>Render</b></i></h5>

		<br>

		<button type="button" class="button button--primary button--sm pb-icon__before--search-s-white">TEST</button>

	</div>

	<?php

		// URL del file CSS
		$cssUrl = 'https://insights.plottybot.com/wp-content/themes/pippo/pb-iconography.php';

		// Recupera il contenuto CSS
		$cssContent = @file_get_contents($cssUrl);

		if ($cssContent === false) {
			die('Errore nel caricamento del file CSS');
		}

		// Estrae tutte le classi icon (solo le classi base, non hover/disabled)
		preg_match_all(
			'/\.pb-icon__before--([a-z-]+)-(s|l|xl)-([a-z]+)::before\s*{/',
			$cssContent,
			$matches
		);

		$icons = [];

		if (!empty($matches[1]) && !empty($matches[2]) && !empty($matches[3])) {
		
			for ($i = 0; $i < count($matches[1]); $i++) {
				
				$iconName = $matches[1][$i];
				$size = $matches[2][$i];
				$color = $matches[3][$i];

				$className = 'pb-icon__before--' . $iconName . '-' . $size . '-' . $color;

				// Evita duplicati (considerando anche la dimensione)
				$key = $iconName . '-' . $size . '-' . $color;
				
				if (!isset($icons[$key])) {
				
					$icons[$key] = [
						'name' => $iconName,
						'size' => $size,
						'color' => $color,
						'className' => $className
					];

				}

			}
		
		}

		// Ottieni parametri filtro
		$searchTerm = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
		$colorFilter = isset($_GET['color']) ? $_GET['color'] : 'all';
		$background = isset($_GET['bg']) ? $_GET['bg'] : 'light';

		// Filtra le icone
		$filteredIcons = $icons;

		if (!empty($searchTerm)) {
			$filteredIcons = array_filter($filteredIcons, function($icon) use ($searchTerm) {
				return strpos($icon['name'], $searchTerm) !== false || 
					strpos($icon['className'], $searchTerm) !== false;
			});
		}

		if ($colorFilter !== 'all') {
			$filteredIcons = array_filter($filteredIcons, function($icon) use ($colorFilter) {
				return $icon['color'] === $colorFilter;
			});
		}

		// Estrai lista colori unici
		$uniqueColors = array_unique(array_column($icons, 'color'));
		
		sort($uniqueColors);

	?>

	<style>

		.container {
			margin: 0 auto;
			margin-top: 50px;
			background: white;
			padding: 30px;
			max-height: 80vh;
			overflow-y: scroll;
		}

		h1 {
			color: #333;
			margin-bottom: 10px;
		}

		.subtitle {
			color: #666;
			margin-bottom: 30px;
		}

		.filter-container {
			margin-bottom: 30px;
		}

		.filter-form {
			display: flex;
			gap: 15px;
			flex-wrap: wrap;
			align-items: center;
		}

		.filter-form label {
			font-weight: 500;
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.filter-form select,
		.filter-form input[type="text"] {
			padding: 8px 12px;
			border: 1px solid #ddd;
			border-radius: 4px;
			font-size: 14px;
		}

		.filter-form input[type="text"] {
			min-width: 250px;
		}

		.filter-form button {
			padding: 8px 20px;
			background: #0066cc;
			color: white;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 14px;
			font-weight: 500;
		}

		.filter-form button:hover {
			background: #0052a3;
		}

		.background-toggle {
			display: flex;
			gap: 10px;
			align-items: center;
			margin-top: 15px;
		}

		.background-toggle a {
			padding: 8px 16px;
			border: 1px solid #ddd;
			background: white;
			border-radius: 4px;
			text-decoration: none;
			color: #333;
			transition: all 0.2s;
		}

		.background-toggle a.active {
			background: #0066cc;
			color: white;
			border-color: #0066cc;
		}

		.icon-grid {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
			gap: 20px;
			margin-top: 20px;
			height: auto !important;
		}

		.icon-item {
			border: 1px solid #e0e0e0;
			border-radius: 6px;
			padding: 20px;
			text-align: center;
			transition: all 0.2s;
			background: #bbbbbb4a;
			height: auto !important;
		}

		.icon-item:hover {
			box-shadow: 0 4px 12px rgba(0,0,0,0.1);
			transform: translateY(-2px);
		}

		.icon-display {
			font-size: 32px;
			min-height: 40px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 15px;
			height: auto !important;
		}

		.icon-name {
			font-size: 12px;
			color: #666;
			word-break: break-word;
			font-family: monospace;
			background: #f8f8f8;
			padding: 6px;
			border-radius: 4px;
			height: auto !important;
		}

		.color-badge {
			display: inline-block;
			padding: 2px 8px;
			border-radius: 3px;
			font-size: 11px;
			margin-top: 5px;
			font-weight: 500;
		}

		.color-white { background: var(--color-neutral-00); color: black; }
		.color-black { background: var(--color-neutral-100); color: white; }
		.color-gray { background: var(--color-neutral-70); color: white; }
		.color-darkgray { background: var(--color-neutral-90); color: white; }
		.color-primary { background: var(--color-primary-50); color: white; }
		.color-secondary { background: var(--color-secondary-60); color: white; }
		.color-success { background: var(--color-success-50); color: white; }
		.color-warning { background: var(--color-warning-80); color: white; }
		.color-error { background: var(--color-error-50); color: white; }
		.color-link { background: var(--color-primary-20); color: #0066cc; }

		.icon-item.bg-dark {
			background: #2c3e50;
		}

		.icon-item.bg-dark .icon-name {
			background: #34495e;
			color: #ecf0f1;
		}

		.stats {
			background: #f8f9fa;
			padding: 15px;
			border-radius: 6px;
			margin-bottom: 20px;
			font-size: 14px;
			color: #666;
		}

		.reset-link {
			margin-left: 10px;
			color: #0066cc;
			text-decoration: none;
			font-size: 13px;
		}

		.reset-link:hover {
			text-decoration: underline;
		}

	</style>

	<div class="container">

		<div class="stats">
			Visualizzando <strong><?php echo count($filteredIcons); ?></strong> icone su <strong><?php echo count($icons); ?></strong> totali
			<?php if ($searchTerm || $colorFilter !== 'all'): ?>
			<a href="?" class="reset-link">Rimuovi filtri</a>
			<?php endif; ?>
		</div>

		<div class="filter-container">
			
			<form method="GET" class="filter-form">
			
				<label>
					Cerca:
					<input type="text" name="search" placeholder="Cerca icona..." value="<?php echo htmlspecialchars($searchTerm); ?>">
				</label>

				<label>
					Colore:
					<select name="color">
						<option value="all" <?php echo $colorFilter === 'all' ? 'selected' : ''; ?>>
							Tutti i colori
						</option>
						<?php foreach ($uniqueColors as $color): ?>
							<option value="<?php echo htmlspecialchars($color); ?>" 
								<?php echo $colorFilter === $color ? 'selected' : ''; ?>>
								<?php echo ucfirst($color); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</label>

				<input type="hidden" name="bg" value="<?php echo htmlspecialchars($background); ?>">
			
				<button type="submit">Filtra</button>

			</form>

			<div class="background-toggle">
			
				<span>Sfondo:</span>
				<?php
					$lightUrl = '?' . http_build_query(array_merge($_GET, ['bg' => 'light']));
					$darkUrl = '?' . http_build_query(array_merge($_GET, ['bg' => 'dark']));
				?>
				<a href="<?php echo htmlspecialchars($lightUrl); ?>" class="<?php echo $background === 'light' ? 'active' : ''; ?>">Chiaro</a>
				<a href="<?php echo htmlspecialchars($darkUrl); ?>" class="<?php echo $background === 'dark' ? 'active' : ''; ?>">Scuro</a>

			</div>
			
		</div>

		<div class="icon-grid">

			<?php if (empty($filteredIcons)): ?>
			<p style="grid-column: 1/-1; text-align: center; padding: 40px; color: #999;">
				Nessuna icona trovata con i filtri applicati.
			</p>
			<?php else: ?>
			<?php foreach ($filteredIcons as $icon): ?>
				<div class="icon-item <?php echo $background === 'dark' ? 'bg-dark' : ''; ?>">
					<div class="icon-display">
						<span class="<?php echo htmlspecialchars($icon['className']); ?>"></span>
					</div>
					<div class="icon-name"><?php echo htmlspecialchars($icon['className']); ?></div>
					<div class="color-badge color-<?php echo htmlspecialchars($icon['color']); ?>">
						<?php echo htmlspecialchars($icon['color']); ?>
					</div>
				</div>
			<?php endforeach; ?>
			<?php endif; ?>

		</div>

	</div>

	<br><br><br>

	<!-- **** -->

	<h2>DIALOG</h2>

	<br><br>

	<h4>Dialog (modali)</h4>
	<small>Modali da design system di PlottyBot.</small>
	<br><br>

	<h5>Esempio</h5>

	<div class="code">

		<h4><i><b>Shortcode WordPress (PHP)</b></i></h4>

		<br><br>
		
		<b><i>Dialog semplice</i></b><br><br>

		echo do_shortcode('[pb_dialog trigger_element="open-dialog-1" language="eng" heading_eng="Hello!" text_1_eng="Sample message" button_1_text_eng="OK"]');

		<br><br>

		<b><i>Dialog video</i></b><br><br>

		echo do_shortcode('[pb_dialog trigger_element="open-dialog-2" language="ita" heading_eng="Tutorial" video=true video=url="https://2050today.org/wp-content/uploads/2020/07/Video-Placeholder.mp4" button_1_text_ita="OK"]');

		<br><br>

		<h5 style="font-size: 12px;"><i><b>Render</b></i></h5>

		<br>

		<button id="open-dialog-1" type="button" class="button button--primary button--sm pb-icon__before--search-s-white">Dialog semplice</button>
		<br><br>
		<button id="open-dialog-2" type="button" class="button button--primary button--sm pb-icon__before--search-s-white">Dialog video</button>

		<?php echo do_shortcode('[pb_dialog trigger_element="open-dialog-1" language="eng" heading_eng="Hello!" text_1_eng="Sample message" button_1_text_eng="OK"]'); ?>
		<?php echo do_shortcode('[pb_dialog trigger_element="open-dialog-2" language="ita" heading_ita="Tutorial" video="true" video_url="https://2050today.org/wp-content/uploads/2020/07/Video-Placeholder.mp4" button_1_text_ita="OK"]'); ?>

	</div>

	<br><br>

	<h5>Elenco completo dei parametri</h5>

	<table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width:100%; text-align:left;">
	<thead style="background:#f3f3f3;">
	<tr>
	<th>Parametro</th>
	<th>Descrizione / Utilizzo</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td>trigger_element</td>
	<td>Se impostato (es. #bottone-apri o .classe-apri), il dialog viene mostrato solo al click su quell’elemento invece che automaticamente.</td>
	</tr>
	<tr>
	<td>language</td>
	<td>Lingua del dialog. Valori accettati: ita o eng o variaabille dinamica. Determina quali testi (ITA o ENG) vengono mostrati.</td>
	</tr>
	<tr>
	<td>dialog_id</td>
	<td>ID univoco generato automaticamente. Puoi impostarlo manualmente per riferimenti specifici.</td>
	</tr>
	<tr>
	<td>heading_ita</td>
	<td>Titolo del dialog in italiano (mostrato se language="ita").</td>
	</tr>
	<tr>
	<td>text_1_ita</td>
	<td>Primo paragrafo o messaggio principale del dialog in italiano.</td>
	</tr>
	<tr>
	<td>text_2_ita</td>
	<td>Testo secondario o di dettaglio del dialog in italiano.</td>
	</tr>
	<tr>
	<td>button_1_text_ita</td>
	<td>Testo del primo pulsante in italiano (es. “Conferma”).</td>
	</tr>
	<tr>
	<td>button_2_text_ita</td>
	<td>Testo del secondo pulsante in italiano (es. “Annulla”).</td>
	</tr>
	<tr>
	<td>heading_eng</td>
	<td>Titolo del dialog in inglese (mostrato se language="eng").</td>
	</tr>
	<tr>
	<td>text_1_eng</td>
	<td>Primo paragrafo o messaggio principale del dialog in inglese.</td>
	</tr>
	<tr>
	<td>text_2_eng</td>
	<td>Testo secondario o di dettaglio del dialog in inglese.</td>
	</tr>
	<tr>
	<td>button_1_text_eng</td>
	<td>Testo del primo pulsante in inglese (es. “Confirm”).</td>
	</tr>
	<tr>
	<td>button_2_text_eng</td>
	<td>Testo del secondo pulsante in inglese (es. “Cancel”).</td>
	</tr>
	<tr>
	<td>video</td>
	<td>Attiva la possibilità di visualizzare un video nel dialog.</td>
	</tr>
	<tr>
	<td>video_url</td>
	<td>URL diretto al video da mostrare nel dialog.</td>
	</tr>
	<tr>
	<td>input</td>
	<td>Campo o markup HTML per input utente all’interno del dialog (opzionale).</td>
	</tr>
	<tr>
	<td>code</td>
	<td>Codice HTML o testo aggiuntivo da visualizzare (es. snippet o shortcode).</td>
	</tr>
	<tr>
	<td>button_1_id</td>
	<td>ID univoco del primo pulsante. Se vuoto, viene generato automaticamente.</td>
	</tr>
	<tr>
	<td>button_1_class</td>
	<td>Classe CSS del primo pulsante. Puoi aggiungere stili personalizzati.</td>
	</tr>
	<tr>
	<td>button_1_enable</td>
	<td>Mostra o nasconde il primo pulsante. Valori accettati: true / false.</td>
	</tr>
	<tr>
	<td>button_1_type</td>
	<td>Stile del primo pulsante (es. primary, secondary, danger).</td>
	</tr>
	<tr>
	<td>button_1_size</td>
	<td>Dimensione del primo pulsante (es. sm, md, lg).</td>
	</tr>
	<tr>
	<td>button_1_error</td>
	<td>Se impostato su true, applica lo stato di errore al pulsante 1 (es. colore rosso).</td>
	</tr>
	<tr>
	<td>button_2_id</td>
	<td>ID univoco del secondo pulsante. Se vuoto, viene generato automaticamente.</td>
	</tr>
	<tr>
	<td>button_2_class</td>
	<td>Classe CSS del secondo pulsante. Puoi aggiungere stili personalizzati.</td>
	</tr>
	<tr>
	<td>button_2_enable</td>
	<td>Mostra o nasconde il secondo pulsante. Valori accettati: true / false.</td>
	</tr>
	<tr>
	<td>button_2_type</td>
	<td>Stile del secondo pulsante (es. primary, secondary).</td>
	</tr>
	<tr>
	<td>button_2_size</td>
	<td>Dimensione del secondo pulsante (es. sm, md, lg).</td>
	</tr>
	<tr>
	<td>button_2_error</td>
	<td>Se impostato su true, applica lo stato di errore al pulsante 2.</td>
	</tr>
	<tr>
	<td>close_class</td>
	<td>Classe CSS per il bottone di chiusura del dialog (default: close).</td>
	</tr>
	<tr>
	<td>close_button_enable</td>
	<td>Mostra o nasconde il pulsante di chiusura. Valori: true / false.</td>
	</tr>
	<tr>
	<td>size</td>
	<td>Dimensione generale del dialog. Valori: sm, md, lg.</td>
	</tr>
	</tbody>
	</table>

	<br><br>

	<h5>Valori di ritorno al click</h5>

	<p>I valori di ritorno possono essere visualizzati per mezzo della variabile globale "globalDialogValue", un array che ha come chiave associata al valore il parametro "dialog_id".</p>

	<table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width:100%; text-align:left;">
	<thead style="background:#f3f3f3;">
	<tr>
	<th>Pulsante e/o elemento di input</th>
	<th>Valore di ritorno</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td>button_1</td>
	<td>btn-1</td>
	</tr>
	<tr>
	<td>button_2</td>
	<td>btn-2</td>
	</tr>
	</tbody>
	</table>

	<h5>Link utili (documentazione esterna)</h5>

	<a href="https://codex.wordpress.org/Shortcode" target="_blank">https://codex.wordpress.org/Shortcode</a>


	<?php
	
	// }

		get_footer();