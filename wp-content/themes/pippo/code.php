<link href="https://unpkg.com/prismjs/themes/prism.css" rel="stylesheet" />
<script src="https://unpkg.com/prismjs/prism.js"></script>
<script src="https://unpkg.com/prismjs/plugins/line-numbers/prism-line-numbers.js"></script>
<link href="https://unpkg.com/prismjs/plugins/line-numbers/prism-line-numbers.css" rel="stylesheet" />

<?php

	// URL del file CSS
	$cssUrl = 'https://insights.plottybot.com/wp-content/themes/pippo/pb-style.php';

	// Recupera il contenuto CSS
	$cssContent = @file_get_contents($cssUrl);

?>

<pre class="line-numbers">
	
	<code class="language-css">

		<?php echo $cssContent; ?>

	</code>

</pre>