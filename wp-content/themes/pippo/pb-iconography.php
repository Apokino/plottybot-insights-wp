<?php

	header("Content-Type: text/css");


	function css_rule($icon_name = "", $size = "", $position = "") {
	
		ob_start();

		if ($size === "s") { $size = "16px"; $folder = "icons-s"; }
		if ($size === "l") { $size = "20px"; $folder = "icons-l"; }
		if ($size === "xl") { $size = "40px"; $folder = "icons-xl"; }

		?>
		
		content: "";
		mask: url(https://insights.plottybot.com/img/icons/pb-iconography/<?php echo $folder . "/" . $icon_name; ?>.svg) no-repeat center;
		-webkit-mask: url(https://insights.plottybot.com/img/icons/pb-iconography/<?php echo $folder . "/" . $icon_name; ?>.svg) no-repeat center;
		mask-size: contain;
		-webkit-mask-size: contain;
		display: inline-block; 
		position: relative; 
		width: <?php echo $size; ?>; 
		height: <?php echo $size; ?>; 
		margin<?php echo (($position === "before") ? "-right" : (($position === "after") ? "-left" : "")); ?>: var(--spacing-8);
		vertical-align: text-bottom;

		<?php

		return ob_get_clean();

	}

	$positions = ["before", "after"];

	$status_colors = [
		"hover" => [
			"black" => "--color-neutral-90",
			"primary" => "--color-primary-60",
			"error" => "--color-error-60",			
		],
		"disabled" => [
			"primary" => "--color-neutral-50",
			"white" => "--color-neutral-50",			
		]
	];

	$no_status_colors = [
		"white" => "--color-neutral-00",
		"black" => "--color-neutral-100",
		"gray" => "--color-neutral-70",
		"darkgray" => "--color-neutral-90",
		"primary" => "--color-primary-50",
		"secondary" => "--color-secondary-60",
		"success" => "--color-success-50",
		"warning" => "--color-warning-80",
		"error" => "--color-error-50",
		"link" => "--color-primary-20"
	];

	$icons_s = [
		"add",
		"arrow-down",
		"arrow-up",
		"back-arrow",
		"bold",
		"checkmark",
		"chevron",
		"close",
		"closed-book",
		"code",
		"credit-card",
		"download",
		"draft",
		"edit",
		"email",
		"facebook",
		"forward-arrow",
		"forward-big-arrow",
		"hamburger-menu",
		"hide",
		"hyphen",
		"home",
		"image",
		"index",
		"italic",
		"italy-flag",
		"list",
		"loading",
		"logout",
		"mastercard",
		"notebook",
		"opened-book",
		"phone",
		"pin",
		"profile",
		"remove",
		"round-alert",
		"round-checkmark",
		"round-error",
		"round-filled-play",
		"round-info",
		"round-play",
		"save",
		"search",
		"settings",
		"show",
		"sparkle",
		"square-play",
		"trash",
		"usa-flag",
		"video",
		"write",
		"youtube"
	];

	$icons_l = [
		"add",
		"arrow-down",
		"arrow-up",
		"back-arrow",
		"bold",
		"checkmark",
		"chevron",
		"close",
		"closed-book",
		"code",
		"credit-card",
		"download",
		"draft",
		"edit",
		"email",
		"facebook",
		"forward-arrow",
		"forward-big-arrow",
		"hamburger-menu",
		"hide",
		"hyphen",
		"home",
		"image",
		"index",
		"italic",
		"italy-flag",
		"list",
		"loading",
		"logout",
		"mastercard",
		"notebook",
		"opened-book",
		"phone",
		"pin",
		"play",
		"profile",
		"remove",
		"round-alert",
		"round-checkmark",
		"round-error",
		"round-filled-play",
		"round-info",
		"round-play",
		"save",
		"search",
		"settings",
		"show",
		"sparkle",
		"square-play",
		"trash",
		"usa-flag",
		"video",
		"write",
		"youtube"
	];

	$icons_xl = [
		"closed-book",
		"forward-big-arrow",
		"opened-book",
		"round-alert",
		"round-checkmark",
		"round-error",
		"round-filled-play",
		"round-info",
		"round-play"
	];

	for ($i = 0; $i < 2; $i++) {

		foreach ($icons_s as $icon_s) {

			$position = $positions[$i];

			$rule = css_rule($icon_s, "s", $position);

			foreach ($no_status_colors as $color_category => $color_value) {

				echo "\n\r.pb-icon__$position--$icon_s-s-$color_category::$position { 
					$rule 
					background-color: var($color_value);
				}";

			}

			foreach ($status_colors as $pseudo_class => $colors) {

				foreach ($colors as $color_category => $color_value) {

					echo "\n\r.pb-icon__$position--$icon_s-s-$color_category:$pseudo_class::$position { 
						$rule 
						background-color: var($color_value);
					}";

				}

			}

		}

	}

	for ($i = 0; $i < 2; $i++) {

		foreach ($icons_l as $icon_l) {

			$position = $positions[$i];

			$rule = css_rule($icon_l, "l", $position);

			foreach ($no_status_colors as $color_category => $color_value) {

				echo "\n\r.pb-icon__$position--$icon_l-l-$color_category::$position { 
					$rule 
					background-color: var($color_value);
				}";

			}

			foreach ($status_colors as $pseudo_class => $colors) {

				foreach ($colors as $color_category => $color_value) {

					echo "\n\r.pb-icon__$position--$icon_l-l-$color_category:$pseudo_class::$position { 
						$rule 
						background-color: var($color_value);
					}";

				}

			}

		}

	}

	for ($i = 0; $i < 2; $i++) {

		foreach ($icons_xl as $icon_xl) {

			$position = $positions[$i];

			$rule = css_rule($icon_xl, "xl", $position);

			foreach ($no_status_colors as $color_category => $color_value) {

				echo "\n\r.pb-icon__$position--$icon_xl-xl-$color_category::$position { 
					$rule 
					background-color: var($color_value);
				}";

			}

			foreach ($status_colors as $pseudo_class => $colors) {

				foreach ($colors as $color_category => $color_value) {

					echo "\n\r.pb-icon__$position--$icon_xl-xl-$color_category:$pseudo_class::$position { 
						$rule 
						background-color: var($color_value);
					}";

				}

			}

		}

	}