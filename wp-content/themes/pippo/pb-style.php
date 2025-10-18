<?php

	header("Content-Type: text/css");

?>

	:root {

		/* === Colors === */

		/* Primary */
		--color-primary-00: #E6FCF9;
		--color-primary-10: #C2F7EF;
		--color-primary-20: #9CEFE3;
		--color-primary-30: #6FE5D4;
		--color-primary-40: #3FD9C3;
		--color-primary-50: #00C2A8;
		--color-primary-60: #00AE96;
		--color-primary-70: #009C86;
		--color-primary-80: #007F6E;
		--color-primary-90: #005E52;
		--color-primary-100: #003F39;

		/* Secondary */
		--color-secondary-00: #F4F7FB;
		--color-secondary-10: #E4EBF5;
		--color-secondary-20: #D3DFF0;
		--color-secondary-30: #B7CCE8;
		--color-secondary-40: #9BB8DF;
		--color-secondary-50: #7EA4D5;
		--color-secondary-60: #658DC1;
		--color-secondary-70: #5076A9;
		--color-secondary-80: #3E5F8E;
		--color-secondary-90: #2C4566;
		--color-secondary-100: #1A2E44;

		/* Neutral */
		--color-neutral-00: #FFFFFF;
		--color-neutral-10: #FAFAFA;
		--color-neutral-20: #F5F5F5;
		--color-neutral-30: #EEEEEE;
		--color-neutral-40: #E0E0E0;
		--color-neutral-50: #BDBDBD;
		--color-neutral-60: #9E9E9E;
		--color-neutral-70: #757575;
		--color-neutral-80: #616161;
		--color-neutral-90: #424242;
		--color-neutral-100: #212121;

		/* Success */
		--color-success-00: #E8F5E9;
		--color-success-10: #C8E6C9;
		--color-success-20: #A5D6A7;
		--color-success-30: #81C784;
		--color-success-40: #66BB6A;
		--color-success-50: #4CAF50;
		--color-success-60: #43A047;
		--color-success-70: #388E3C;
		--color-success-80: #2E7D32;
		--color-success-90: #1B5E20;
		--color-success-100: #0D3B12;

		/* Warning */
		--color-warning-00: #FFFDE7;
		--color-warning-10: #FFF9C4;
		--color-warning-20: #FFF59D;
		--color-warning-30: #FFF176;
		--color-warning-40: #FFEE58;
		--color-warning-50: #FFEB3B;
		--color-warning-60: #FDD835;
		--color-warning-70: #FBC02D;
		--color-warning-80: #F9A825;
		--color-warning-90: #F57F17;
		--color-warning-100: #E65100;

		/* Error */
		--color-error-00: #FFEBEE;
		--color-error-10: #FFCDD2;
		--color-error-20: #EF9A9A;
		--color-error-30: #E57373;
		--color-error-40: #EF5350;
		--color-error-50: #F44336;
		--color-error-60: #E53935;
		--color-error-70: #D32F2F;
		--color-error-80: #C62828;
		--color-error-90: #B71C1C;
		--color-error-100: #8B0000;

		/* Accent */
		--color-accent-10: #FF6B5A;
		--color-accent-20: #2563EB;

		/* === Spacing Scale (4px Grid) === */

		--spacing-0: 0px;
		--spacing-4: 4px;
		--spacing-8: 8px;
		--spacing-12: 12px;
		--spacing-16: 16px;
		--spacing-20: 20px;
		--spacing-24: 24px;
		--spacing-28: 28px;
		--spacing-32: 32px;
		--spacing-40: 40px;
		--spacing-48: 48px;
		--spacing-64: 64px;

		/* === Elevation / Shadow Tokens === */

		--elevation-light: 0px 1px 3px 0px #0000001F;
		--elevation-medium: 0px 2px 6px 0px #00000029;
		--elevation-heavy: 0px 4px 12px 0px #0000003D;

		/* === Border Radius Tokens === */
		
		--radius-small: 4px;
		--radius-medium: 8px;
		--radius-large: 16px;
		--radius-round: 9999px;

		/* === Responsive Grid Breakpoint === */

		--breakpoint-sm: 375px;
		--breakpoint-lg: 1024px;
		--breakpoint-xl: 1440px;

	}

	/* === Typography === */

	@import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=League+Spartan:wght@100..900&display=swap');

	@font-face {
		font-family: 'Satoshi Variable';
		src: url('fonts/Satoshi_Complete/Fonts/TTF/Satoshi-Variable.ttf') format('truetype');
		font-weight: 100 900;
		font-style: normal;
	}

	html, body {
		font-family: "Inter", sans-serif !important;
		background-color: var(--color-neutral-10) !important;
	}

	<?php

		$i = "!important";
		$f1 = "font-family: \"Inter\", sans-serif $i";
		$f2 = "font-family: \"Satoshi Variable\", sans-serif $i";
		$m1 = "margin: var(--spacing-4) 0 $i";
		$m2 = "margin: var(--spacing-8) 0 $i";

		$text_overline = "$f1; font-weight: 500 $i;	font-size: 11px $i; font-style: normal $i; 11px $i; letter-spacing: 1px $i;";
		$text_buttons = "$f1; font-weight: 600 $i; font-size: 14px $i; font-style: normal $i; letter-spacing: 0.5px $i;";
		$text_caption = "$f1; font-weight: 500 $i; font-size: 12px $i; font-style: normal $i; letter-spacing: 0.5px $i;";
		$text_body_sm = "$f1; $m1; font-weight: 400 $i; font-size: 13px $i; font-style: normal $i; letter-spacing: 0.25px $i;";
		$text_body_md = "$f1; $m1; font-weight: 400 $i; font-size: 14px $i; font-style: normal $i; letter-spacing: 0 $i;";
		$text_body_lg = "$f1; $m1; font-weight: 400 $i; font-size: 16px $i; font-style: normal $i; letter-spacing: 0 $i;";
		$text_heading_sm = "$f2; $m2; font-weight: 500 $i; font-size: 20px $i; font-style: normal $i; letter-spacing: 0 $i;";
		$text_heading_md = "$f2; $m2; font-weight: 600 $i; font-size: 28px $i; font-style: normal $i; letter-spacing: -0.25px $i;";
		$text_heading_lg = "$f2; $m2; font-weight: 600 $i; font-size: 36px $i; font-style: normal $i; letter-spacing: -0.5px $i;";
		$text_heading_xl = "$f2; $m2; font-weight: 700 $i; font-size: 48px $i; font-style: normal $i; letter-spacing: -0.5px $i;";
		$text_heading_xxl = "$f2; $m2; font-weight: 700 $i; font-size: 64px $i; font-style: normal $i; letter-spacing: -1px $i;";
	
	?>

	.text--overline { <?php echo $text_overline; ?> }
	.text--buttons { <?php echo $text_buttons; ?> }
	.text--caption { <?php echo $text_caption; ?> }
	.text--body-sm { <?php echo $text_body_sm; ?> }
	.text--body-md { <?php echo $text_body_md; ?> }
	.text--body-lg { <?php echo $text_body_lg; ?> }
	.text--heading-sm { <?php echo $text_heading_sm; ?> }
	.text--heading-md { <?php echo $text_heading_md; ?> }
	.text--heading-lg { <?php echo $text_heading_lg; ?> }
	.text--heading-xl { <?php echo $text_heading_xl; ?> }
	.text--heading-xxl { <?php echo $text_heading_xxl; ?> }

	/* === Logo === */

	.logo {
		width: 100%;
	}

	.icon--sm { font-size: 27px; }
	.icon--md { font-size: 47px; }
	.icon--lg { font-size: 94px; }
	.logo--black { color: var(--color-neutral-100); }
	.logo--white { color: var(--color-neutral-00); }
	.logo--primary { color: var(--color-primary-50); }

	/* === Buttons === */

	.button {
		display: flex;
		flex-direction: row;
		justify-content: center;
		align-items: center;
		/* min-width: 120px; */
		<?php echo $text_buttons; ?>
		border-radius: var(--radius-medium);
		cursor: pointer;
		white-space: nowrap;
	}

	/* Primary */

	.button--primary {
		background-color: var(--color-primary-50);
		color: var(--color-neutral-00);
		box-shadow: var(--elevation-light);
		border: none;
	}

	.button--primary:hover {
		background-color: var(--color-primary-60);
	}

	.button--primary:active {
		background-color: var(--color-primary-70);
		box-shadow: var(--elevation-medium);
	}

	.button--primary:disabled {
		background-color: var(--color-neutral-30);
		color: var(--color-neutral-50);
		box-shadow: none;
	}

	/**/

	.button--primary.button--error:hover {
		background-color: var(--color-error-60);
	}

	.button--primary.button--error:active {
		background-color: var(--color-error-70);
		box-shadow: var(--elevation-medium);
	}

	.button--primary.button--error:disabled {
		background-color: var(--color-neutral-30);
		color: var(--color-neutral-50);
		box-shadow: none;
	}

	/* Secondary */

	.button--secondary {
		background-color: transparent;
		color: var(--color-primary-50);
		border: 2px solid var(--color-primary-50);
		box-shadow: var(--elevation-light);
	}

	.button--secondary:hover {
		color: var(--color-primary-70);
		border-color: var(--color-primary-70);
	}

	.button--secondary:active {
		color: var(--color-primary-80);
		border-color: var(--color-primary-80);
		box-shadow: var(--elevation-medium);
	}

	.button--secondary:disabled {
		color: var(--color-neutral-50);
		border-color: var(--color-neutral-30);
		box-shadow: none;
	}

	/**/

	.button--secondary.button--error:hover {
		color: var(--color-error-70);
		border-color: var(--color-error-70);
	}

	.button--secondary.button--error:active {
		color: var(--color-error-80);
		border-color: var(--color-error-80);
		box-shadow: var(--elevation-medium);
	}

	.button--secondary.button--error:disabled {
		color: var(--color-neutral-50);
		border-color: var(--color-neutral-30);
		box-shadow: none;
	}

	/* Tertiary */

	.button--tertiary {
		background-color: transparent;
		color: var(--color-primary-50);
		border: none;
	}

	.button--tertiary:hover {
		color: var(--color-primary-60);
		text-decoration: underline;
		text-underline-offset: 4px; /* aumenta la distanza */
	}

	.button--tertiary:active {
		color: var(--color-primary-70);
	}

	.button--tertiary:disabled {
		color: var(--color-neutral-50);
	}

	/* Index */

	.button--index {
		background-color: transparent;
		color: var(--color-neutral-100);
		border: none;
	}

	.button--index:hover {
		color: var(--color-neutral-90);
		text-decoration: underline;
		text-underline-offset: 4px;
	}

	.button--index:active {
		color: var(--color-neutral-100);
	}

	.button--index:disabled {
		color: var(--color-neutral-50);
	}

	/* Error */

	.button--primary.button--error {
		background-color: var(--color-error-50);
		color: var(--color-neutral-00);
	}

	.button--secondary.button--error {
		color: var(--color-error-50);
		border-color: var(--color-error-50);
	}

	.button--tertiary.button--error {
		color: var(--color-error-50);
	}

	.button--index.button--error {
		color: var(--color-error-50);
	}

	/* Generico */

	.button--sm {
		height: 32px;
		padding: var(--spacing-4) var(--spacing-12);
	}

	.button--md {
		height: 40px;
		padding: var(--spacing-8) var(--spacing-16);
	}

	.button--lg {
		height: 48px;
		padding: var(--spacing-12) var(--spacing-20);
	}

	.button--xl {
		height: 48px;
		padding: var(--spacing-16) var(--spacing-40) !important;
	}

	/**/

	.button--icon-left::before {
		content: "";
		display: inline-block;
		width: 20px;
		height: 20px;
		margin-right: var(--spacing-8);
		background-image: url('/img/icons/true.svg');
		background-size: contain;
		background-repeat: no-repeat;
		background-position: center;
	}

	.button--icon-right::after {
		content: "";
		display: inline-block;
		width: 20px;
		height: 20px;
		margin-left: var(--spacing-8);
		background-image: url('/img/icons/true.svg');
		background-size: contain;
		background-repeat: no-repeat;
		background-position: center;
	}

	/* === Inputs === */

	label {
		display: inline-block;
		<?php echo $text_buttons; ?>
		color: var(--color-neutral-100);
		/* margin-bottom: var(--spacing-8); */
		cursor: pointer;
		user-select: none;
	}

	label.radio--label, label.checkbox--label {
		display: flex;
		justify-content: flex-start;
		align-items: center;
		gap: var(--spacing-8);
		<?php echo $text_body_md; ?>
		flex-wrap: wrap;
	}

	input, textarea, select {
		display: block;
		min-height: 22px;
		/* margin: 5px 0; */
		padding: var(--spacing-8) var(--spacing-16);
		border: 1px solid var(--color-neutral-50);
		border-radius: var(--radius-medium);
		background-color: var(--color-neutral-00);
		color: var(--color-neutral-100);
		outline: none;
		cursor: pointer;
		<?php echo $text_body_md; ?>
	}

	input:not([type="radio"]):not([type="checkbox"]), select {
		width: 100%;
		height: 40px !important;
	}

	textarea {
		padding: 10px var(--spacing-16) var(--spacing-8) var(--spacing-16);
	}

	input::placeholder,
	textarea::placeholder {
		<?php echo $text_body_md; ?>
	}

	input:hover, textarea:hover, select:hover {
		border-color: var(--color-neutral-60);
	}

	input:focus, textarea:focus, select:focus {
		border-color: var(--color-primary-60);
		color: var(--color-neutral-100);
		border-shadow: var(--elevation-light);
	}

	input:disabled, textarea:disabled, select:disabled {
		border-color: var(--color-neutral-20);
		color: var(--color-neutral-50);
	}

	input.input--error, textarea.input--error, select.input--error {
		border-color: var(--color-error-60);
	}

	select option:hover {
		background-color: var(--color-primary-10);
	}

	input[type="radio"] {
		appearance: none;
		-webkit-appearance: none;
		outline: none;
		display: inline-block;
		min-width: 20px;
		min-height: 20px;
		padding: 0;
		border: 2px solid var(--color-neutral-50);
		border-radius: 50%;
		cursor: pointer;
	}

	input[type="radio"]:checked {
		background: #fff;
		border: 6px solid var(--color-primary-50);
		box-shadow: var(--elevation-light);
	}

	label.radio--label > input[type="radio"]:hover {
		box-shadow: var(--elevation-medium);
	}

	label.radio--label > input[type="radio"]:focus {
		box-shadow: var(--elevation-heavy);
	}

	label.radio--label > input[type="radio"]:hover + span {
		color: var(--color-neutral-100);
	}

	label.radio--label > input[type="radio"]:focus + span {
		color: var(--color-neutral-100);
	}

	label.radio--label > input[type="radio"]:disabled + span {
		color: var(--color-neutral-60);
	}

	input[type="checkbox"] {
		appearance: none;
		-webkit-appearance: none;
		outline: none;
		display: inline-block;
		position: relative;
		min-width: 20px;
		min-height: 20px;
		padding: 0;
		border: 2px solid var(--color-neutral-50);
		border-radius: var(--radius-small);
		cursor: pointer;
	}

	input[type="checkbox"]:checked::before {
		content: "";
		mask: url(https://insights.plottybot.com/img/icons/pb-iconography/icons-s/checkmark.svg) no-repeat center;
		-webkit-mask: url(https://insights.plottybot.com/img/icons/pb-iconography/icons-s/checkmark.svg) no-repeat center;
		mask-size: contain;
		-webkit-mask-size: contain;
		position: relative; 
		display: block;
		/* align-items: center;
		justify-content: center; */
		width: 16px; 
		height: 16px;
		/* color: var(--color-neutral-00); */
		background-color: var(--color-neutral-00); 
	}

	input[type="checkbox"]:checked {
		background: var(--color-primary-50);
		border-color: var(--color-primary-60);
		box-shadow: var(--elevation-light);
	}

	
	label.checkbox--label > input[type="checkbox"]:hover {
		box-shadow: var(--elevation-medium);
	}

	label.checkbox--label > input[type="checkbox"]:focus {
		box-shadow: var(--elevation-heavy);
	}

	label.checkbox--label > input[type="checkbox"]:hover + span {
		color: var(--color-neutral-100);
	}

	label.checkbox--label > input[type="checkbox"]:focus + span {
		color: var(--color-neutral-100);
	}

	label.checkbox--label > input[type="checkbox"]:disabled + span {
		color: var(--color-neutral-60);
	}

	small.error--message {
		display: none;
	}

	input.input--error + small.error--message, 
	textarea.input--error + small.error--message {
		display: block;
		margin: 5px 0;
		color: var(--color-error-60);
		<?php echo $text_body_md; ?>
	}

	/*****/ 

	label.switch {
		position: relative;
		display: flex;
		gap: 15px;
		align-items: center;
		width: 36px;
		height: 14px;
		user-select: none;
	}

	/* Hide default HTML checkbox */
	label.switch input {
		opacity: 0;
		width: 0;
		height: 0;
	}

	label.switch span.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: var(--color-neutral-50);
		-webkit-transition: .4s;
		transition: .4s;
	}

	label.switch span.slider:before {
		position: absolute;
		content: "";
		height: 20px;
		width: 20px;
		left: -2px;
		bottom: -3px;
		background-color: var(--color-neutral-00);
		border: 1px solid var(--color-neutral-20);
		-webkit-transition: .4s;
		transition: .4s;
	}

	/***/

	label.switch input:checked + span.slider {
		background-color: var(--color-primary-20);
	}

	label.switch input:checked + span.slider:before {
		-webkit-transform: translateX(18px);
		-ms-transform: translateX(18px);
		transform: translateX(18px);
		background-color: var(--color-primary-50);
		border: none;
		box-shadow: none;
	}

	/** Problema transizione comune colore

	label.switch input:checked:disabled + span.slider {
		background-color: var(--color-primary-00);
	}

	label.switch input:checked:disabled + span.slider:before {
		background-color: var(--color-primary-30);
		border: none;
		box-shadow: none;
	}

	**/

	label.switch input:checked:focus + span.slider,
	label.switch input:checked:hover + span.slider {
		background-color: var(--color-primary-20);
	}

	label.switch input:checked:focus + span.slider:before,
	label.switch input:checked:hover + span.slider:before {
		background-color: var(--color-primary-50);
		border: none;
		box-shadow: var(--elevation-medium);
	}

	/** Problema transizione comune colore

	label.switch input:disabled + span.slider {
		background-color: var(--color-neutral-40);
	}

	label.switch input:disabled + span.slider:before {
		background-color: var(--color-neutral-00);
		border: 1px solid var(--color-neutral-40);
		box-shadow: none;
	}

	**/

	label.switch input:focus + span.slider {
		background-color: var(--color-neutral-40);
	}

	label.switch input:hover + span.slider {
		background-color: var(--color-neutral-50);
	}

	label.switch input:focus + span.slider:before {
		background-color: var(--color-neutral-00);
		border: 1px solid var(--color-neutral-40);
		box-shadow: var(--elevation-medium);
	}

	label.switch input:hover + span.slider:before {
		background-color: var(--color-neutral-00);
		border: 1px solid var(--color-neutral-20);
		box-shadow: var(--elevation-medium);
	}

	/***/

	/* Rounded sliders */
	label.switch span.slider.round {
		border-radius: 34px;
	}

	label.switch span.slider.round:before {
		border-radius: 50%;
	}

	/* == Tooltips == */

	.tooltip-container {
		position: relative;
		display: inline-flex;
		justify-content: center;
		cursor: pointer;
	}

	.tooltip-container.top {
		justify-content: center;
	}

	.tooltip-container.top .tooltip {
		top: -10px;
		transform: translate(0, -100%);
	}

	.tooltip-container.bottom {
		justify-content: center;
	}

	.tooltip-container.bottom .tooltip {
		bottom: -10px;
		transform: translate(0, 100%);
	}

	.tooltip-container.right {
		justify-content: normal;
		align-items: center;
	}

	.tooltip-container.right .tooltip {
		right: -10px;
		transform: translateX(100%);
	}

	.tooltip-container.left {
		justify-content: normal;
		align-items: center;
	}
	
	.tooltip-container.left .tooltip {
		left: -10px;
		transform: translateX(-100%);
	}

	.tooltip-container .tooltip.start {
		top: 0px;
		left: 0px;
		transform: translateX(-50%);
	}

	.tooltip-container .tooltip.center {
		transform: translateX(-50%);
	}

	.tooltip-container .tooltip.end {
		top: 0px;
		right: 0px;
		transform: translateX(-50%);
	}

	.tooltip-container .info {
		display: inline-block;
		background-image: url(https://insights.plottybot.com/img/icons/pb-iconography/icons-l/round-info.svg);
		background-repeat: no-repeat;
		width: 20px;
		height: 20px;
		display: flex;
		justify-content: center;
		align-items: center;
		background-color: transparent;
		color: #fff;
		border-radius: 50%;
	}

	.tooltip-container .tooltip {
		position: absolute;
		padding: var(--spacing-8) var(--spacing-12);
		background-color: var(--color-neutral-90);
		color: var(--color-neutral-00);
		border-radius: var(--radius-small);
		white-space: nowrap;
		opacity: 0;
		visibility: hidden;
		transition: opacity 0.3s ease, visibility 0.3s ease;
		<?php echo $text_caption; ?>
	}

	@media only screen and (max-width: 800px) {

		.tooltip-container .tooltip {

			white-space: wrap;

		}

	}

	.tooltip-container.top .tooltip::after {
		content: '';
		position: absolute;
		top: 100%;
		left: 50%;
		transform: translateX(-50%);
		border-width: 5px;
		border-style: solid;
		border-color: var(--color-neutral-90) transparent transparent transparent;
	}

	.tooltip-container.bottom .tooltip::after {
		content: '';
		position: absolute;
		top: 0;
		left: 50%;
		transform: translate(-50%, -100%) rotate(180deg);
		border-width: 5px;
		border-style: solid;
		border-color: var(--color-neutral-90) transparent transparent transparent;
	}

	.tooltip-container.left .tooltip::after {
		content: '';
		position: absolute;
		top: 50%;
		left: 100%;
		transform: translate(0, -50%) rotate(-90deg);
		border-width: 5px;
		border-style: solid;
		border-color: var(--color-neutral-90) transparent transparent transparent;
	}

	.tooltip-container.right .tooltip::after {
		content: '';
		position: absolute;
		top: 50%;
		left: 0;
		transform: translate(-100%, -50%) rotate(90deg);
		border-width: 5px;
		border-style: solid;
		border-color: var(--color-neutral-90) transparent transparent transparent;
	}

	.tooltip-container:hover .tooltip {
		opacity: 1;
		visibility: visible;
	}

	.tooltip-container .tooltip:hover {
		opacity: 0;
		visibility: hidden;
	}

	.tooltip-container .info:hover + .tooltip {
		opacity: 1;
		visibility: visible;
	}

	.tooltip-container:hover:not(:hover) .tooltip {
		opacity: 1;
		visibility: visible;
	}

	/* === Navigation === */

	nav.dark ul li a {
		color: var(--color-neutral-100);
		padding: var(--spacing-8);
		gap: var(--spacing-8);
		<?php echo $text_buttons; ?>
	}

	nav.light ul li a {
		color: var(--color-neutral-00);
		<?php echo $text_buttons; ?>
	}

	nav.dark ul li a:hover, 
	nav.dark ul li a:focus {
		color: var(--color-primary-60);
		text-decoration: underline;
		text-underline-offset: 4px;
	}

	nav.dark ul li a:active,
	nav.dark ul li a.active {
		color: var(--color-primary-70);
		text-decoration: underline;
		text-underline-offset: 4px;
	}

	nav.light ul li a:hover, 
	nav.light ul li a:focus {
		color: var(--color-primary-20);
		text-decoration: underline;
		text-underline-offset: 4px;
	}

	nav.light ul li a:active,
	nav.light ul li a.active {
		color: var(--color-primary-30);
		text-decoration: underline;
		text-underline-offset: 4px;
	}

	/* == Altro == */

	.tags {
		display: inline-block;
		min-width: 24px;
		height: 24px;
		padding: var(--spacing-4) var(--spacing-8);
		border: 1px solid var(--color-primary-60);
		border-radius: var(--radius-large);
		background-color: var(--color-neutral-00);
		<?php echo $text_caption; ?>
		cursor: pointer;
	}

	.tags:not(.no-hover-tags):hover {
		background-color: var(--color-primary-60);
		color: var(--color-neutral-00);
	}

	.tags--accent {
		border: 1px solid var(--color-accent-10);
		color: var(--color-accent-10);
	}

	/**/

	.link {
		text-decoration: underline;
		color: var(--color-accent-20);
		<?php echo $text_caption; ?>
	}

	/**/

	hr {
		display: block;
		width: 100%;
		background-color: var(--color-neutral-40);
		border: none;
		margin: var(--spacing-24) 0;
	}

	.hide + hr {
		display: none;
	}

	hr.hr-ligth {
		height: 2px;
	}

	hr.hr-medium {
		height: 4px;
	}

	hr.hr-heavy {
		height: 8px;
	}

	/* == Componenti == */

	/* Toast */

	.toast-component {
		display: flex;
		justify-content: flex-start;
		align-items: center;
		flex-direction: row;
		flex-wrap: wrap;
		width: 100%;
		/* min-height: 60px; */
		margin: var(--spacing-8) 0;
		padding: var(--spacing-8) var(--spacing-16);
		border: 2px solid var(--color-primary-50);
		background-color: var(--color-neutral-00);
		border-radius: var(--radius-medium);
		box-sizing: border-box;
	}

	.toast-component.toast--success {
		border: 2px solid var(--color-success-50);
		background-color: var(--color-success-00);
	}

	.toast-component.toast--success > div:first-of-type svg {
		color: var(--color-primary-50);
	}

	.toast-component.toast--error {
		border: 2px solid var(--color-error-50);
		background-color: var(--color-error-00);
	}

	.toast-component.toast--error > div:first-of-type svg {
		color: var(--color-error-50);
	}

	.toast-component.toast--warning {
		border: 2px solid var(--color-warning-80);
		background-color: var(--color-warning-00);
	}

	.toast-component.toast--warning > div:first-of-type svg {
		color: var(--color-warning-80);
	}

	.toast-component.toast--info {
		border: 2px solid var(--color-secondary-60);
		background-color: var(--color-secondary-00);
	}

	.toast-component.toast--info > div:first-of-type svg {
		color: var(--color-secondary-60);
	}

	.toast-component > div:first-of-type {
		display: flex;
		justify-content: center;
		align-items: center;
		margin-right: var(--spacing-8);
		/*width: 10%;*/
		height: 100%;
	}
	
	.toast-component > div > div:last-of-type {
		margin-left: var(--spacing-8);
	}

	.toast-component > div:last-of-type h4,
	.toast-component > div:last-of-type p {
		margin: 0 !important;
		padding: 0 !important;
	}

	.toast-component > div:last-of-type p {
		margin-top: var(--spacing-4) !important;
	}

	/* Dialog */

	.dialog-component {
		position: fixed;
		top: 50%;
		left: 50%;
		z-index: 888888;
		display: flex;
		justify-content: space-between;
		align-items: flex-start;
		flex-direction: column;
		width: 100%;
		max-width: 614px;
		/*min-height: 290px;*/
		transform: translate(-50%, -50%);
		background-color: var(--color-neutral-00);
		border: 1px solid var(--color-neutral-40);
		border-radius: var(--radius-large);
		box-shadow: var(--elevation-heavy);
		padding: var(--spacing-24);
		box-sizing: border-box;
	}

	.dialog-component h3,
	.dialog-component p {
		padding: 0 !important;
	}

	.dialog-component h3 {
		width: 94%;
		margin: 0 0 var(--spacing-16) 0 !important;
		line-height: 1.4;
	}

	.dialog-component p {
		margin: var(--spacing-20) 0 !important;
	}

	.dialog-component .close {
		position: absolute;
		right: 24px;
		top: 24px;
		color: #000;
		cursor: pointer;
	}

	@media (max-width: 620px) {
		.dialog-component {
			width: 90%;
		}
	}

	/* === Tabs === */
	
	.tabs {
		display: flex;
		justify-content: center;
		align-items: center;
		margin: 0 auto;
		border-bottom: 1px solid var(--color-neutral-40);
	}

	.tab-buttons {
		position: relative;
		top: 2px;
		display: flex;
		justify-content: center;
		align-items: center;
		flex-wrap: wrap;
		max-width: 600px;
		width: 100%;
	}
				
	.tabs .tab {
		position: relative;
		display: flex;
		justify-content: center;
		align-items: center;
		flex: 1;
		padding: var(--spacing-16) var(--spacing-32);
		background: none;
		border: none;
		cursor: pointer;
		color: var(--color-neutral-100);
	}

	.tabs .tab:focus,
	.tabs .tab.active {
		color: var(--color-primary-50);
	}

	.tabs .tab:hover {
		color: var(--color-primary-60);
	}

	.tabs .tab.active::after,
	.tabs .tab:focus::after {
		width: 100%;
	}

	.tab-indicator {
		position: absolute;
		bottom: 0;
		height: 3px;
		width: 100px; /* Larghezza fissa */
		background-color: var(--color-primary-60);
		transition: left 0.3s ease;
		pointer-events: none;
	}

	.tab-content {
		display: none !important;
	}

	.tab-content.active {
		display: flex !important;
	}

	.tabs .tab {
		<?php echo $text_buttons; ?>
	}