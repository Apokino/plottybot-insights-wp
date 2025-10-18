<?php

	header("Content-Type: text/css");

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

	
	body.woocommerce-checkout h1 {
		<?php echo $text_heading_lg; ?>
	}

	body.woocommerce-checkout h2 {
		<?php echo $text_heading_md; ?>
	}

	body.woocommerce-checkout p {
		<?php echo $text_body_md; ?>
	}

	body.woocommerce-checkout label {
		position: relative !important;
		top: 0 !important;
		left: 0 !important;
		display: inline-block;
		<?php echo $text_buttons; ?>
		color: var(--color-neutral-100) !important;
		cursor: pointer !important;
		user-select: none;
		transform: none !important;
		order: -1;
	}

	body.woocommerce-checkout input, 
	body.woocommerce-checkout textarea, 
	body.woocommerce-checkout select {
		display: block;
		min-height: 22px;
		padding: var(--spacing-8) var(--spacing-16) !important;
		border: 1px solid var(--color-neutral-50) !important;
		border-radius: var(--radius-medium) !important;
		background-color: var(--color-neutral-00) !important;
		color: var(--color-neutral-100) !important;
		outline: none;
		cursor: pointer;
		<?php echo $text_body_md; ?>
	}

	body.woocommerce-checkout input:hover, 
	body.woocommerce-checkout textarea:hover, 
	body.woocommerce-checkout select:hover {
		border-color: var(--color-neutral-60) !important;
	}

	body.woocommerce-checkout select {
		width: 100% !important;
		height: 40px !important;
	}

	body.woocommerce-checkout div.wc-block-components-text-input,
	body.woocommerce-checkout div.wc-block-components-country-input {
		display: grid;
		margin: var(--spacing-16) 0 !important;
	}

	body.woocommerce-checkout div.wc-block-components-text-input div.wc-block-components-validation-error {
		padding: 0 !important;
	}

	body.woocommerce-checkout div.wc-block-components-text-input div.wc-block-components-validation-error p {
		display: block;
		margin: 5px 0;
		color: var(--color-error-60) !important;
		font-family: "Inter", sans-serif !important;
		margin: var(--spacing-4) 0 !important;
		font-weight: 400 !important;
		font-size: 14px !important !important;
		font-style: normal !important;
		letter-spacing: 0 !important;
	}

	body.woocommerce-checkout div.wc-block-components-text-input div.wc-block-components-validation-error svg {
		display: none;
	}

	body.woocommerce-checkout div.wc-block-components-text-input.is-active input:focus, 
	body.woocommerce-checkout div.wc-block-components-text-input.is-active textarea:focus {
		border-color: var(--color-primary-60) !important;
		color: var(--color-neutral-100) !important;
		box-shadow: var(--elevation-light) !important;
	}

	body.woocommerce-checkout div.wc-block-components-text-input.has-error input, 
	body.woocommerce-checkout div.wc-block-components-text-input.has-error textarea {
		border-color: var(--color-error-60) !important;
	}

	body.woocommerce-checkout div.wc-block-components-text-input.has-error input:focus, 
	body.woocommerce-checkout div.wc-block-components-text-input.has-error textarea:focus {
		border-color: var(--color-error-60) !important;
	}

	body.woocommerce-checkout .wc-block-components-form .wc-block-components-text-input.has-error input:focus, 
	body.woocommerce-checkout .wc-block-components-text-input.has-error input:focus {
		box-shadow: unset !important;
	}

	body.woocommerce-checkout .wc-blocks-components-select .wc-blocks-components-select__container {
		background: transparent !important;
		border-radius: unset !important;
		height: auto !important;
	}

	body.woocommerce-checkout .wc-blocks-components-select .wc-blocks-components-select__container .wc-blocks-components-select__expand {
		transform: none !important;
	}

	body.woocommerce-checkout .wc-blocks-components-select .wc-blocks-components-select__select:focus {
		border-color: var(--color-primary-60) !important;
		color: var(--color-neutral-100) !important;
		box-shadow: var(--elevation-light) !important;
	}

	body.woocommerce-checkout div.wc-block-components-text-input:not(.has-error):not(.wc-block-components-totals-coupon__input)::after {
		content: "";
		display: block;
		height: 22px;
	}

	body.woocommerce-checkout #order-notes,
	a.wc-block-components-checkout-return-to-cart-button {
		display: none !important;
	}

	.wc-block-components-button:not(.is-link) {
		text-align: inherit !important;
		transition: none !important;
	}

	body.woocommerce-checkout #primary button {
		display: flex !important;
		flex-direction: row;
		justify-content: center;
		align-items: center;
		<?php echo $text_buttons; ?>
		width: auto !important;
		border-radius: var(--radius-medium);
		cursor: pointer;
		white-space: nowrap;
		/**/
		background-color: var(--color-primary-50);
		color: var(--color-neutral-00);
		box-shadow: var(--elevation-light);
		border: none;
		/**/
		height: 48px !important;
		padding: var(--spacing-12) var(--spacing-20) !important;
	}

    body.woocommerce-checkout #primary button.wc-block-components-chip__remove {
            height: 16px !important;
            padding: 0 !important;
    }

	body.woocommerce-checkout #primary button:hover {
		background-color: var(--color-primary-60);
	}

	body.woocommerce-checkout #primary button:active {
		background-color: var(--color-primary-70);
		box-shadow: var(--elevation-medium);
	}

	body.woocommerce-checkout .wp-block-woocommerce-checkout-order-summary-block {
		background-color: var(--color-neutral-00) !important;
		border: 1px solid var(--color-neutral-40) !important;
		border-radius: var(--radius-medium) !important;
		padding: var(--spacing-16);
	}

	body.woocommerce-checkout .wp-block-woocommerce-checkout-order-summary-block .wc-block-components-checkout-order-summary__title-text {
		<?php echo $text_heading_sm; ?>
		padding: 0 var(--spacing-16) !important;
	}

	body.woocommerce-checkout .wp-block-woocommerce-checkout-order-summary-block .wc-block-components-product-name,
	body.woocommerce-checkout .wp-block-woocommerce-checkout-order-summary-block .wc-block-components-panel__button {
		<?php echo $text_heading_sm; ?>
	}

	body.woocommerce-checkout .wp-block-woocommerce-checkout-order-summary-coupon-form-block .wc-block-components-panel__button {
		<?php echo $text_body_md; ?>
	}

	body.woocommerce-checkout .wp-block-woocommerce-checkout-order-summary-block .wc-block-components-order-summary-item__image {
		display: none;
	}

	body.woocommerce-checkout .wp-block-woocommerce-checkout-order-summary-block .wc-block-components-order-summary-item__description {
		padding: 0 !important;
	}

	body.woocommerce-checkout .wp-block-woocommerce-checkout-order-summary-block form#wc-block-components-totals-coupon__form {
		flex-direction: column;
	}

	body.woocommerce-checkout .wp-block-woocommerce-checkout-order-summary-block form#wc-block-components-totals-coupon__form button {
		background-color: transparent;
		color: var(--color-primary-50);
		border: 2px solid var(--color-primary-50);
		box-shadow: var(--elevation-light);
	}

	body.woocommerce-checkout .wp-block-woocommerce-checkout-order-summary-block form#wc-block-components-totals-coupon__form button[style*="pointer-events: none"] {
		color: var(--color-neutral-50);
		border-color: var(--color-neutral-30);
		box-shadow: none;
	}

	body.woocommerce-checkout .wp-block-woocommerce-checkout-order-summary-block form#wc-block-components-totals-coupon__form button:hover {
		color: var(--color-primary-70);
		border-color: var(--color-primary-70);
	}

	body.woocommerce-checkout .wp-block-woocommerce-checkout-order-summary-block form#wc-block-components-totals-coupon__form button:active {
		color: var(--color-primary-80);
		border-color: var(--color-primary-80);
		box-shadow: var(--elevation-medium);
	}

	body.woocommerce-checkout .wc-block-components-totals-item__label, 
	body.woocommerce-checkout .wp-block-woocommerce-checkout-order-summary-block .wc-block-components-formatted-money-amount {
		<?php echo $text_heading_sm; ?>
	}

	body.woocommerce-checkout .wc-block-components-button:not(.is-link):disabled .wc-block-components-button__text {
		opacity: unset !important;
	}
	
	body.woocommerce-checkout h3.wc-block-components-product-name {
		display: flex;
		justify-content: center;
		align-items: center;
	}

	body.woocommerce-checkout h3.wc-block-components-product-name::before {
		content: "";
		mask: url(https://plottybot.com/img/icons/pb-iconography/icons-xl/closed-book.svg) no-repeat center;
		-webkit-mask: url(https://plottybot.com/img/icons/pb-iconography/icons-xl/closed-book.svg) no-repeat center;
		mask-size: contain;
		-webkit-mask-size: contain;
		display: inline-block; 
		position: relative; 
		width: 40px; 
		height: 40px; 
		margin-right: var(--spacing-8);
		vertical-align: text-bottom;
		background-color: var(--color-neutral-90);
	}

	body.woocommerce-checkout .wc-block-components-totals-coupon__form .wc-block-components-totals-coupon__input {
		flex: unset !important;
	}

	body.woocommerce-checkout .wc-block-components-checkbox label {
		display: flex;
		justify-content: flex-start;
		align-items: center;
		gap: var(--spacing-8);
		<?php echo $text_body_md; ?>
		flex-wrap: wrap;
	}

	body.woocommerce-checkout input[type="checkbox"] {
		appearance: none !important;
		-webkit-appearance: none !important;
		outline: none !important;
		display: inline-block !important;
		position: relative !important;
		width: 20px !important;
		height: 20px !important;
		min-width: 20px !important;
		min-height: 20px !important;
		padding: 0 !important;
		border: 2px solid var(--color-neutral-50) !important;
		border-radius: var(--radius-small) !important;
		cursor: pointer !important;
	}

	body.woocommerce-checkout input[type="checkbox"] + svg {
		display: none;
	}

	body.woocommerce-checkout input[type="checkbox"]:checked::before {
		content: "";
		mask: url(https://plottybot.com/img/icons/pb-iconography/icons-s/checkmark.svg) no-repeat center !important;
		-webkit-mask: url(https://plottybot.com/img/icons/pb-iconography/icons-s/checkmark.svg) no-repeat center !important;
		mask-size: contain !important;
		-webkit-mask-size: contain !important;
		position: relative !important; 
		display: block !important;
		width: 16px !important; 
		height: 16px !important;
		background-color: var(--color-neutral-00) !important; 
	}

	body.woocommerce-checkout input[type="checkbox"]:checked {
		background: var(--color-primary-50) !important;
		border-color: var(--color-primary-60) !important;
		box-shadow: var(--elevation-light) !important;
	}

	body.woocommerce-checkout .wc-block-components-checkbox label > input[type="checkbox"]:hover {
		box-shadow: var(--elevation-medium) !important;
	}

	body.woocommerce-checkout .wc-block-components-checkbox label > input[type="checkbox"]:focus {
		box-shadow: var(--elevation-heavy) !important;
	}

	.wc-block-components-checkbox .wc-block-components-checkbox__input[type=checkbox]:focus {
		outline: none !important;
		outline-offset: unset !important;
	}

	div.wc-block-components-sidebar-layout.wc-block-checkout.is-mobile div.wp-block-woocommerce-checkout-order-summary-block.checkout-order-summary-block-fill-wrapper {
		display: none;
	}

	div.wc-block-components-totals-wrapper div.wc-block-components-totals-item__value {
		display: flex;
		justify-content: center;
		align-items: center;
	}

	body.woocommerce-checkout #company-alert {
		display: flex;
		justify-content: flex-start;
		align-items: center;
		flex-direction: row;
		flex-wrap: wrap;
		width: 100%;
		margin: var(--spacing-8) 0;
		padding: var(--spacing-8) var(--spacing-16);
		border-radius: var(--radius-medium);
		box-sizing: border-box;
		border: 2px solid var(--color-warning-80);
		background-color: var(--color-warning-00);
		<?php echo $text_buttons; ?>
		color: #000;
		padding-left: 44px;
		position: relative;
		margin: 40px 0;
	}

	body.woocommerce-checkout #company-alert::before {
		content: "";
		mask: url(https://plottybot.com/img/icons/pb-iconography/icons-l/round-info.svg) no-repeat center;
		-webkit-mask: url(https://plottybot.com/img/icons/pb-iconography/icons-l/round-info.svg) no-repeat center;
		mask-size: contain;
		-webkit-mask-size: contain;
		display: inline-block;
		position: absolute;
		left: 15px;
		width: 20px;
		height: 20px;
		margin-right: var(--spacing-8);
		vertical-align: text-bottom;
		background-color: var(--color-warning-80);
	}

	body.woocommerce-checkout span.wc-block-components-order-summary-item__individual-prices.price.wc-block-components-product-price,
	body.woocommerce-checkout div.wc-block-components-product-metadata {
		display: none;
	}

	body.woocommerce-checkout .wc-block-components-express-payment--checkout .wc-block-components-express-payment__content {
		border: none !important;
		padding: var(--spacing-24) 0;
	}

	body.woocommerce-checkout div.wc-block-components-express-payment.wc-block-components-express-payment--checkout {
		display: flex;
		justify-content: center;
		align-items: center;
		height: 135px;
	}

	body.woocommerce-checkout .wc-block-components-express-payment--checkout .wc-block-components-express-payment__title-container::after {
		border: none !important;
		height: 0 !important;
	}

	body.woocommerce-checkout .wc-block-components-express-payment--checkout .wc-block-components-express-payment__title-container::before {
		border: none !important;
		height: 0 !important;
	}

	body.woocommerce-checkout div.wc-block-components-express-payment-continue-rule.wc-block-components-express-payment-continue-rule--checkout {
		<?php echo $text_body_md; ?>
		margin-bottom: var(--spacing-64) !important;
	}

	body.woocommerce-checkout span#radio-control-wc-payment-method-options-stripe__label span {
		<?php echo $text_heading_sm; ?>
	}

	body.woocommerce-checkout span#radio-control-wc-payment-method-options-stripe__label span span {
		display: none !important;
	}

	body.woocommerce-checkout div.wc-block-components-radio-control-accordion-option.wc-block-components-radio-control-accordion-option--checked-option-highlighted {
		border: 1px solid var(--color-neutral-40) !important;
		border-radius: var(--radius-medium) !important;
	}

	body.woocommerce-checkout ul.wc-block-components-express-payment__event-buttons {
		display: flex !important;
	}