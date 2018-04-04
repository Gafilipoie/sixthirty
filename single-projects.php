<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php require_once 'functions/Mobile_Detect.php'; $detect = new Mobile_Detect; ?>
<?php
	$id = get_the_ID();
	$isMobile = false;
	if($detect->isMobile() || $detect->isTablet()){
		$isMobile = true;
		$main_image = get_field('main_image_mobile', $id);
		if(!$main_image) {
			$main_image = get_field('main_image', $id);
		}
	} else {
		$main_image = get_field('main_image', $id);
	}
	$main_content = get_field('main_content', $id);
	$title        = get_the_title();
	$subtitle     = get_field('subtitle', $id);
	$details      = get_field('details');
	$client       = $details[0]['client'];
	$client_name  = $client->name;
?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/pace.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/pace.css">
<script type="text/javascript"> window.Pace.on('done', function(){ $(window).trigger('onPageLoad'); }) </script>

<div class="project--preload-overlay" id="preload-overlay">
	<!-- <p class="overlay--page-title" style="display: none;"><?php echo $title; ?></p> -->
	<div class="project--preload-overlay-wrapper">
		<svg style="width:10%;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 280" style="enable-background:new 0 0 100 280;" xml:space="preserve">
			<style type="text/css">.st0{clip-path:url(#SVGID_2_);}.st1{clip-path:url(#SVGID_4_);fill:#323232;}.st2{clip-path:url(#SVGID_6_);}.st3{clip-path:url(#SVGID_8_);fill:#323232;}</style>
			<g><defs><path id="SVGID_1_" d="M50,0C22,0,0,21.4,0,48.6c0,27.3,22,48.6,50,48.6s50-21.4,50-48.6C100,21.8,77.6,0,50,0"/></defs><clipPath id="SVGID_2_"><use xlink:href="#SVGID_1_"  style="overflow:visible;"/></clipPath><g class="st0"><defs><rect id="SVGID_3_" x="-482.6" y="-175.9" width="1063.9" height="609.1"/></defs><clipPath id="SVGID_4_"><use xlink:href="#SVGID_3_"  style="overflow:visible;"/></clipPath><rect x="-5.4" y="-5.4" class="st1" width="110.7" height="108"/></g></g>
			<g><defs><path id="SVGID_5_" d="M50,181c-28,0-50,21.4-50,48.6c0,27.3,22,48.6,50,48.6s50-21.4,50-48.6C100,202.8,77.6,181,50,181"/></defs><clipPath id="SVGID_6_"><use xlink:href="#SVGID_5_"  style="overflow:visible;"/></clipPath><g class="st2"><defs><rect id="SVGID_7_" x="-482.6" y="5.1" width="1063.9" height="609.1"/></defs><clipPath id="SVGID_8_"><use xlink:href="#SVGID_7_"  style="overflow:visible;"/></clipPath><rect x="-5.4" y="175.6" class="st3" width="110.7" height="108"/></g></g>
		</svg>
	</div>
</div>

<?php
	$tabs = array();
	if(have_rows('section_template', $id)) : while (have_rows('section_template', $id)) : the_row();
		$tab_name = get_sub_field('tab_name');
		if($tab_name){
			array_push($tabs, $tab_name);
		}
	endwhile; endif;

	$tabs = array_reverse($tabs);
?>

<div class="project-hero-image lazy menu-offset-delimiter" data-original="<?php echo $main_image; ?>">
	<div class="info-pane">
		<div class="content-maxwidth">
			<p class="info-pane__title"><?php echo $title; ?></p>
			<p class="info-pane__subtitle"><?php echo $subtitle; ?></p>
		</div>
	</div>
</div>

<div class="project-content-wrapper">
	<!-- Project Info -->
	<!-- <div class="container-maxwidth"> -->
	<div class="project-overview-wrapper setting-up">

		<?php
			$section_opened = false;
			$needs_opened = false;
			$c = 0;
			if(have_rows('section_template', $id)) : while (have_rows('section_template', $id)) : the_row();
				$tab_name = get_sub_field('tab_name');
				$c++;
				if($tab_name){
					if($section_opened == true){
						echo '</div></div>';
					}
					$tab_section = 'project-'.str_replace(' ', '-', strtolower($tab_name));
					$section_opened = true;
					$needs_opened = true;
				} else if($c == 1){
					$section_opened = true;
					$needs_opened = true;
					$tab_section = '';
				}
				if($needs_opened == true){
					$needs_opened = false;
					echo '<div class="project-section '.$tab_section.'">';
				}

				$image1 = get_sub_field('image_1');
				$image2 = get_sub_field('image_2');
				$image3 = get_sub_field('image_3');
				$video1 = get_sub_field('video_1');
				$video2 = get_sub_field('video_2');
				$video3 = get_sub_field('video_3');
				$textModule1 = get_sub_field('text_module_1');
				$textModule2 = get_sub_field('text_module_2');
				$textModule3 = get_sub_field('text_module_3');
				$textModule4 = get_sub_field('text_module_4');
				$content = get_sub_field('content');
				$textColor = get_sub_field('text_color');
				$quoteBackgroundColor = get_sub_field('text_background_color');
				$backgroundColor1 = get_sub_field('background_color_1');
				$backgroundColor2 = get_sub_field('background_color_2');
				$backgroundColor3 = get_sub_field('background_color_3');
				$category = get_sub_field('category');
				switch ($category) {
					case 'temp_1':
						# ONE IMAGE TEMPLATES
						$layout = get_sub_field('layout_1');
						switch ($layout) {
							case 'temp_standard':
								# standard template
								?>
								<section class="one-image one-image--standard col-8 project-block section-animation">
									<div class="project-block--slider">
										<img class="lazy" data-original="<?php echo $image1[0]['image']; ?>">
										<!-- <div class="project-image lazy" data-original="<?php echo $image1[0]['image']; ?>"> -->
											<?php if($image1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($image1[0]['caption_bg']){ ?>
																background-color: <?php echo $image1[0]['caption_bg']; } ?>">
													<?php echo $image1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										<!-- </div> -->
									</div>
								</section>
								<?php break;
							case 'temp_browser':
								# browser template
								?>
								<section class="one-image col-8 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
									<div class="browser-frame">
										<div class="project-block--slider">
											<!-- <img class="content lazy" data-original="<?php echo $image1[0]['image']; ?>"> -->
											<div class="project-image lazy" data-original="<?php echo $image1[0]['image']; ?>">
												<?php if($image1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($image1[0]['caption_bg']){ ?>
																	background-color: <?php echo $image1[0]['caption_bg']; } ?>">
														<?php echo $image1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</section>
								<?php break;
							case 'temp_ipad_portrait':
								# ipad portrait template
								?>
								<section id="<?php echo $template_id; ?>" class="one-image col-8 portrait project-block project-block--template" style="background-color:<?php if($backgroundColor1){ ?><?php echo $backgroundColor1; ?><?php } ?>">
									<div class="tablet">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
											xml:space="preserve">
											<g>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
													c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
												<g>
													<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
														c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
														c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
														v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
														c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
												</g>
											</g>
										</svg>
										<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>">
											<div style="position:relative;">
												<?php if($image1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($image1[0]['caption_bg']){ ?>
																	background-color: <?php echo $image1[0]['caption_bg']; } ?>">
														<?php echo $image1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</section>
								<?php break;
							case 'temp_ipad_landscape':
								# ipad landscape template
								?>
								<section id="<?php echo $template_id; ?>" class="one-image col-8 landscape project-block project-block--template" style="background-color:<?php if($backgroundColor1){ ?><?php echo $backgroundColor1; ?><?php } ?>">
									<div class="tablet">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
											xml:space="preserve">
											<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
												s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
											<g>
												<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
													c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
													c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
													h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
													c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
													/>
											</g>
										</svg>
										<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>">
											<div style="position:relative;">
												<?php if($image1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($image1[0]['caption_bg']){ ?>
																	background-color: <?php echo $image1[0]['caption_bg']; } ?>">
														<?php echo $image1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</section>
								<?php break;
							case 'temp_iphone':
								# iphone template
								?>
								<style>#<?php echo $template_id; ?> .mobile:before, #<?php echo $template_id; ?> .mobile:after{background: <?php echo $backgroundColor3; ?>}</style>
								<section id="<?php echo $template_id; ?>" class="one-image col-8 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
									<div class="mobile">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
											xml:space="preserve">
											<g>
												<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
													c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
													c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
													C232.771,828.127,223.188,837.708,211.414,837.708z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
													c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
													c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
													c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
													C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
											</g>
										</svg>
										<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>">
											<div style="position:relative;">
												<?php if($image1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($image1[0]['caption_bg']){ ?>
																	background-color: <?php echo $image1[0]['caption_bg']; } ?>">
														<?php echo $image1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>

										</div>
									</div>
								</section>
								<?php break;
						}
						break;
					case 'temp_2':
						# ONE IMAGE + TEXT
						$layout = get_sub_field('layout_1');
						$content_position = get_sub_field('content_position');
						$content = get_sub_field('content');
						$headline = $content[0]['headline'];
						$description = $content[0]['description'];
						switch ($layout) {
							case 'temp_standard':
								# standard template
								if($content_position == 'left'){
									# content on left
								?>
								<section class="one-image-text project-block sticky-row--wrapper section-animation">
									<div class="col-2">
											<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
											<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
											<?php } ?>
									</div>
									<div class="col-4">
										<div class="project-block--slider">
											<?php foreach ($image1 as $img) { ?>
											<div class="project-image lazy" data-original="<?php echo $img['image']; ?>" >
												<div style="position:relative;">
													<?php if($image1[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($image1[0]['caption_bg']){ ?>
																		background-color: <?php echo $image1[0]['caption_bg']; } ?>">
															<?php echo $image1[0]['caption_text']; ?>
														</div>
													<?php } ?>
												</div>
											</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<section class="one-image-text project-block sticky-row--wrapper section-animation">
									<div class="col-4">
										<div class="project-block--slider">
											<?php foreach ($image1 as $img) { ?>
											<div class="project-image lazy" data-original="<?php echo $img['image']; ?>" >
												<div style="position:relative;">
													<?php if($image1[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($image1[0]['caption_bg']){ ?>
																		background-color: <?php echo $image1[0]['caption_bg']; } ?>">
															<?php echo $image1[0]['caption_text']; ?>
														</div>
													<?php } ?>
												</div>
											</div>
											<?php } ?>
										</div>
									</div><!--
									--><div class="col-2">
											<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
											<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
											<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
							case 'temp_browser':
								# browser template
								if($content_position == 'left'){
									# content on left
								?>
								<section class="one-image-text sticky-row--wrapper">
									<div class="col-2 row-section-wrapper project-block">
											<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
											<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
											<?php } ?>
									</div><!--
								 --><div class="col-4 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="browser-frame">
											<img class="content lazy" data-original="<?php echo $image1[0]['image']; ?>"></img>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<section class="one-image-text sticky-row--wrapper">
									<div class="col-4 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="browser-frame">
											<img class="content lazy" data-original="<?php echo $image1[0]['image']; ?>"></img>
										</div>
									</div><!--
								 --><div class="col-2 row-section-wrapper project-block">
											<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
											<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
											<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
							case 'temp_ipad_portrait':
								# ipad portrait template
								if($content_position == 'left'){
									# content on left
								?>
								<section class="one-image-text sticky-row--wrapper">
									<div class="col-2 row-section-wrapper project-block">
											<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
											<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
											<?php } ?>
									</div>
									<div id="<?php echo $template_id; ?>" class="col-4 portrait half-width project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="tablet">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
												xml:space="preserve">
												<g>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
														c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
													<g>
														<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
															c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
														<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
															c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
															v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
															c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
													</g>
												</g>
											</svg>
											<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>"></div>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<section class="one-image-text sticky-row--wrapper">
									<div id="<?php echo $template_id; ?>" class="col-4 portrait half-width project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="tablet">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
												xml:space="preserve">
												<g>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
														c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
													<g>
														<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
															c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
														<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
															c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
															v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
															c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
													</g>
												</g>
											</svg>
											<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>"></div>
										</div>
									</div>
									<div class="col-2 row-section-wrapper project-block">
											<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
											<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
											<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
							case 'temp_ipad_landscape':
								# ipad landscape template
								if($content_position == 'left'){
									# content on left
								?>
								<section class="one-image-text one-image-text--landscape sticky-row--wrapper">
									<div class="col-2 row-section-wrapper project-block">
											<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
											<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
											<?php } ?>
									</div>
									<div id="<?php echo $template_id; ?>" class="col-4 half-width--tab landscape project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="tablet">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
												xml:space="preserve">
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
													s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
												<g>
													<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
														c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
														c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
														h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
														c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
														/>
												</g>
											</svg>
											<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>"></div>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<section class="one-image-text one-image-text--landscape sticky-row--wrapper">
									<div id="<?php echo $template_id; ?>" class="col-4 half-width--tab landscape project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="tablet">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
												xml:space="preserve">
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
													s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
												<g>
													<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
														c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
														c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
														h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
														c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
														/>
												</g>
											</svg>
											<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>"></div>
										</div>
									</div>
									<div class="col-2 row-section-wrapper project-block">
										<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
							case 'temp_iphone':
								# iphone template
								if($content_position == 'left'){
									# content on left
								?>
								<style>#<?php echo $template_id; ?> .mobile:before, #<?php echo $template_id; ?> .mobile:after{background: <?php echo $backgroundColor3; ?>}</style>
								<section class="one-image-text sticky-row--wrapper">
									<div class="col-2 row-section-wrapper project-block">
											<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
											<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
											<?php } ?>
									</div>
									<div id="<?php echo $template_id; ?>" class="col-4 half-width project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="mobile">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
												xml:space="preserve">
												<g>
													<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
														c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
														c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
														C232.771,828.127,223.188,837.708,211.414,837.708z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
														c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
														c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
														c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
														C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
												</g>
											</svg>
											<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>"></div>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<style>#<?php echo $template_id; ?> .mobile:before, #<?php echo $template_id; ?> .mobile:after{background: <?php echo $backgroundColor3; ?>}</style>
								<section class="one-image-text sticky-row--wrapper">
									<div id="<?php echo $template_id; ?>" class="col-4 half-width project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="mobile">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
												xml:space="preserve">
												<g>
													<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
														c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
														c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
														C232.771,828.127,223.188,837.708,211.414,837.708z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
														c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
														c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
														c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
														C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
												</g>
											</svg>
											<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>"></div>
										</div>
									</div>
									<div class="col-2 row-section-wrapper project-block">
											<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
											<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
											<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
						}
						break;
					case 'temp_3':
						# TWO IMAGES TEMPLATES
						$layout = get_sub_field('layout_1');
						switch ($layout) {
							case 'temp_standard':
								# standard template
								?>
								<section class="two-images-module two-images--template">
									<div class="col-4 marR project-block project-block--image">
										<div class="project-image lazy" data-original="<?php echo $image1[0]['image']; ?>">
											<?php if($image1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($image1[0]['caption_bg']){ ?>
																background-color: <?php echo $image1[0]['caption_bg']; } ?>">
													<?php echo $image1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="col-4 project-block project-block--image">
										<div class="project-image lazy" data-original="<?php echo $image2[0]['image']; ?>">
											<?php if($image2[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($image2[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($image2[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($image2[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($image2[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($image2[0]['caption_bg']){ ?>
																background-color: <?php echo $image2[0]['caption_bg']; } ?>">
													<?php echo $image2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php break;
							case 'temp_browser':
								# browser template
								?>
								<section class="two-images-module two-images--template">
									<div class="col-4 project-block project-block--template marR" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="browser-frame">
											<img class="content lazy" data-original="<?php echo $image1[0]['image']; ?>">
											<?php if($image1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($image1[0]['caption_bg']){ ?>
																background-color: <?php echo $image1[0]['caption_bg']; } ?>">
													<?php echo $image1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div><!--
									--><div class="col-4 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="browser-frame">
											<img class="content lazy" data-original="<?php echo $image2[0]['image']; ?>">
											<?php if($image2[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($image2[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($image2[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($image2[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($image2[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($image2[0]['caption_bg']){ ?>
																background-color: <?php echo $image2[0]['caption_bg']; } ?>">
													<?php echo $image2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php
								break;
							case 'temp_ipad_portrait':
								# ipad portrait template
								$style = get_sub_field('images_style_ipad');
								if($style == 'same_container'){
									# same container
								?>
								<section id="<?php echo $template_id; ?>" class="two-images-module col-8 portrait fw-multiple project-block project-block--template" style="background-color:<?php if($backgroundColor1){ ?><?php echo $backgroundColor1; ?><?php } ?>">
									<div class="tablet">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
											xml:space="preserve">
											<g>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
													c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
												<g>
													<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
														c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
														c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
														v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
														c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
												</g>
											</g>
										</svg>
										<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>"></div>
									</div>
									<div class="tablet">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
											xml:space="preserve">
											<g>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
													c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
												<g>
													<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
														c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
														c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
														v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
														c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
												</g>
											</g>
										</svg>
										<div class="screen lazy" data-original="<?php echo $image2[0]['image']; ?>"></div>
									</div>
								</section>
								<?php
								} else {
									# separated containers
								?>
								<section class="two-images-module">
									<div id="<?php echo $template_id; ?>" class="col-4 portrait project-block half-width project-block--template marR" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="tablet">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
												xml:space="preserve">
												<g>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
														c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
													<g>
														<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
															c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
														<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
															c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
															v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
															c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
													</g>
												</g>
											</svg>
											<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>"></div>
										</div>
									</div>
									<div class="col-4 portrait project-block half-width project-block--template" <?php if($backgroundColor2){ ?>style="background-color: <?php echo $backgroundColor2; ?>"<?php } ?>>
										<div class="tablet">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
												xml:space="preserve">
												<g>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
														c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
													<g>
														<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
															c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
														<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
															c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
															v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
															c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
													</g>
												</g>
											</svg>
											<div class="screen lazy" data-original="<?php echo $image2[0]['image']; ?>"></div>
										</div>
									</div>
								</section>
								<?php } ?>
								<?php
								break;
							case 'temp_ipad_landscape':
								# ipad landscape template
								$style = get_sub_field('images_style_ipad');
								if($style == 'same_container'){
									# same container
								?>
								<section id="<?php echo $template_id; ?>" class="two-images-module col-8 landscape fw-multiple project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
									<div class="tablet landscape">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
											xml:space="preserve">
											<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
												s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
											<g>
												<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
													c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
													c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
													h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
													c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
													/>
											</g>
										</svg>
										<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>"></div>
									</div>
									<div class="tablet landscape">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
											xml:space="preserve">
											<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
												s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
											<g>
												<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
													c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
													c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
													h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
													c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
													/>
											</g>
										</svg>
										<div class="screen lazy" data-original="<?php echo $image2[0]['image']; ?>"></div>
									</div>
								</section>
								<?php
								} else {
									// separated containers
								?>
								<section class="two-images-module">
									<div id="<?php echo $template_id; ?>" class="col-4 landscape project-block half-width--tab project-block--template marR larger" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="tablet landscape">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
												xml:space="preserve">
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
													s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
												<g>
													<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
														c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
														c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
														h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
														c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
														/>
												</g>
											</svg>
											<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>"></div>
										</div>
									</div>
									<div class="col-4 landscape project-block half-width--tab project-block--template larger" <?php if($backgroundColor2){ ?>style="background-color: <?php echo $backgroundColor2; ?>"<?php } ?>>
										<div class="tablet landscape">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
												xml:space="preserve">
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
													s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
												<g>
													<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
														c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
														c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
														h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
														c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
														/>
												</g>
											</svg>
											<div class="screen lazy" data-original="<?php echo $image2[0]['image']; ?>"></div>
										</div>
									</div>
								</div>
								<?php
								}
								break;
							case 'temp_iphone':
								# iphone template
								$style = get_sub_field('images_style_iphone');
								if($style == 'same_container'){
									# same container
								?>
								<style>#<?php echo $template_id; ?> .mobile:before, #<?php echo $template_id; ?> .mobile:after{background: <?php echo $backgroundColor3; ?>}</style>
								<section id="<?php echo $template_id; ?>" class="two-images-module col-8 fw-multiple project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
									<div class="mobile">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
											xml:space="preserve">
											<g>
												<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
													c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
													c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
													C232.771,828.127,223.188,837.708,211.414,837.708z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
													c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
													c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
													c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
													C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
											</g>
										</svg>
										<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>"></div>
									</div>
									<div class="mobile">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
											xml:space="preserve">
											<g>
												<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
													c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
													c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
													C232.771,828.127,223.188,837.708,211.414,837.708z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
													c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
													c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
													c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
													C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
											</g>
										</svg>
										<div class="screen lazy" data-original="<?php echo $image2[0]['image']; ?>"></div>
									</div>
								</section>
								<?php
								} else {
									# separated containers
								?>
								<style>#<?php echo $template_id; ?> .mobile:before, #<?php echo $template_id; ?> .mobile:after{background: <?php echo $backgroundColor3; ?>}</style>
								<section id="<?php echo $template_id; ?>" class="two-images-module col-8 fw-multiple project-block--template collapsed">
									<div class="col-4 project-block half-width marR" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="mobile">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
												xml:space="preserve">
												<g>
													<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
														c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
														c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
														C232.771,828.127,223.188,837.708,211.414,837.708z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
														c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
														c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
														c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
														C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
												</g>
											</svg>
											<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>"></div>
										</div>
									</div>
									<div class="col-4 project-block half-width" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="mobile">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
												xml:space="preserve">
												<g>
													<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
														c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
														c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
														C232.771,828.127,223.188,837.708,211.414,837.708z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
														c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
														c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
														c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
														C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
												</g>
											</svg>
											<div class="screen lazy" data-original="<?php echo $image2[0]['image']; ?>"></div>
										</div>
									</div>
								</section>
								<?php
								}
								?>
								<?php
								break;
						}
						break;
					case 'temp_4':
						# TWO IMAGES + TEXT TEMPLATES
						$layout = get_sub_field('layout_2');
						$content_position = get_sub_field('content_position');
						$content = get_sub_field('content');
						$headline = $content[0]['headline'];
						$description = $content[0]['description'];
						switch ($layout) {
							case 'temp_standard':
								# standard template
								if($content_position == 'left'){
									# content on left
								?>
								<section class="two-images sticky-row--wrapper">
									<div class="row-section-wrapper col-2 project-block">
											<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
											<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
											<?php } ?>
									</div><!--
									--><div class="col-4 offset-2">
										<div class="two-images--stacked">
											<div class="stacked-image--wrapper project-block project-block--image">
												<img class="project-image lazy" data-original="<?php echo $image1[0]['image']; ?>">
											</div>
											<div class="stacked-image--wrapper project-block project-block--image">
												<img class="project-image lazy" data-original="<?php echo $image2[0]['image']; ?>">
											</div>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<section class="two-images sticky-row--wrapper">
									<div class="col-4 project-block--image">
										<div class="two-images--stacked">
											<div class="stacked-image--wrapper project-block">
												<img class="project-image lazy" data-original="<?php echo $image1[0]['image']; ?>">
											</div>
											<div class="stacked-image--wrapper project-block">
												<img class="project-image lazy" data-original="<?php echo $image2[0]['image']; ?>">
											</div>
										</div>
									</div><!--
									--><div class="row-section-wrapper col-2 project-block">
											<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
											<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
											<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
							case 'temp_browser':
								# browser template
								if($content_position == 'left'){
									# content on left
								?>
								<section class="two-images sticky-row--wrapper">
									<div class="row-section-wrapper col-2 project-block">
											<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
											<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
											<?php } ?>
									</div><!--
								 --><div class="col-4 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="browser-frame">
											<img class="content lazy" data-original="<?php echo $image1[0]['image']; ?>"></img>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<section class="two-images sticky-row--wrapper">
									<div class="col-4 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="browser-frame">
											<img class="content lazy" data-original="<?php echo $image1[0]['image']; ?>"></img>
										</div>
									</div><!--
									--><div class="row-section-wrapper col-2 project-block">
											<?php if($headline){ ?>
											<div class="row-section-title"><?php echo $headline; ?></div>
											<?php } if($description){ ?>
											<div class="row-section-description"><?php echo $description; ?></div>
											<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
						}
						break;
					case 'temp_5':
						# THREE IMAGES TEMPLATES
						$layout = get_sub_field('layout_3');
						switch ($layout) {
							case 'temp_standard':
								$images_position = get_sub_field('images_position');
								# standard template
								if($images_position == 'right2'){
									# 1 image left / 2 images right
								?>
								<section class="three-images mosaic-gallery mosaic-right">
									<div class="three-images__two-image col-4 project-block project-block--template marR stacked-images-col">
										<div class="project-image stacked-images lazy" data-original="<?php echo $image1[0]['image']; ?>">
											<?php if($image1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($image1[0]['caption_bg']){ ?>
																background-color: <?php echo $image1[0]['caption_bg']; } ?>">
													<?php echo $image1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
										<div class="project-image stacked-images lazy" data-original="<?php echo $image2[0]['image']; ?>">
											<?php if($image2[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($image2[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($image2[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($image2[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($image2[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($image2[0]['caption_bg']){ ?>
																background-color: <?php echo $image2[0]['caption_bg']; } ?>">
													<?php echo $image2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div><!--
									--><div class="three-images__one-image col-4 project-block project-block--template project-image-img">
										<img class="three-images__img project-image lazy" data-original="<?php echo $image3[0]['image']; ?>">
										<?php if($image3[0]['caption_text']){ ?>
												<div class="image-caption"
													style=" <?php if($image3[0]['caption_position'] === 'topRight'){ ?>
															top: 0px; right: 0px;
														<?php } else if($image3[0]['caption_position'] === 'center'){ ?>
															top: 50%; left: 50%; transform: translate(-50%,50%);
														<?php } else if($image3[0]['caption_position'] === 'bottomLeft'){ ?>
															bottom: 0px; left: 0px;
														<?php } else if($image3[0]['caption_position'] === 'bottomRight'){ ?>
															bottom: 0px; right: 0px;
														<?php } else { ?>
															top: 0px; left: 0px;
														<?php } if($image3[0]['caption_bg']){ ?>
															background-color: <?php echo $image3[0]['caption_bg']; } ?>">
												<?php echo $image3[0]['caption_text']; ?>
											</div>
										<?php } ?>
									</div>
								</section>
								<?php
								} else {
									# 2 image left / 1 image right
								?>
								<section class="three-images mosaic-gallery mosaic-left">
									<div class="three-images__one-image col-4 project-block project-block--template marR project-image-img">
										<img class="three-images__img project-image lazy" data-original="<?php echo $image1[0]['image']; ?>">
										<?php if($image1[0]['caption_text']){ ?>
												<div class="image-caption"
													style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
															top: 0px; right: 0px;
														<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
															top: 50%; left: 50%; transform: translate(-50%,50%);
														<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
															bottom: 0px; left: 0px;
														<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
															bottom: 0px; right: 0px;
														<?php } else { ?>
															top: 0px; left: 0px;
														<?php } if($image1[0]['caption_bg']){ ?>
															background-color: <?php echo $image1[0]['caption_bg']; } ?>">
												<?php echo $image1[0]['caption_text']; ?>
											</div>
										<?php } ?>
									</div><!--
									--><div class="three-images__two-image col-4 project-block project-block--template stacked-images-col">
										<div class="project-image stacked-images lazy" data-original="<?php echo $image2[0]['image']; ?>">
											<?php if($image2[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($image2[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($image2[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($image2[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($image2[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($image2[0]['caption_bg']){ ?>
																background-color: <?php echo $image2[0]['caption_bg']; } ?>">
													<?php echo $image2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
										<div class="project-image stacked-images lazy" data-original="<?php echo $image3[0]['image']; ?>">
											<?php if($image3[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($image3[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($image3[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($image3[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($image3[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($image3[0]['caption_bg']){ ?>
																background-color: <?php echo $image3[0]['caption_bg']; } ?>">
													<?php echo $image3[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php
								}
								break;
							case 'temp_iphone':
								# iphone template
								?>
								<section id="<?php echo $template_id; ?>" class="three-images col-8 fw-multiple project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
									<div class="mobile">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
											xml:space="preserve">
											<g>
												<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
													c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
													c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
													C232.771,828.127,223.188,837.708,211.414,837.708z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
													c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
													c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
													c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
													C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
											</g>
										</svg>
										<div class="screen lazy" data-original="<?php echo $image1[0]['image']; ?>"></div>
									</div>
									<div class="mobile">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
											xml:space="preserve">
											<g>
												<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
													c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
													c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
													C232.771,828.127,223.188,837.708,211.414,837.708z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
													c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
													c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
													c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
													C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
											</g>
										</svg>
										<div class="screen lazy" data-original="<?php echo $image2[0]['image']; ?>"></div>
									</div>
									<div class="mobile">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
											xml:space="preserve">
											<g>
												<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
													c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
													c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
													C232.771,828.127,223.188,837.708,211.414,837.708z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
													c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
													c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
													c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
													C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
											</g>
										</svg>
										<div class="screen lazy" data-original="<?php echo $image3[0]['image']; ?>"></div>
									</div>
								</section>
								<?php
								break;
						}
						break;
					case 'temp_6':
						# Widget
						?>
						<section class="row-section-wrapper project-block project-block--image">
							<?php the_sub_field('widget'); ?>
						</section>
						<?php
						break;
					case 'temp_7':
						# ONE VIDEO TEMPLATES
						$layout = get_sub_field('layout_1');
						switch ($layout) {
							case 'temp_standard':
								# standard template
								?>
								<section class="one-video col-8 project-block project-block--image section-animation">
									<div class="container container-video with-controls">
										<div class="video-img video-img--primary mobile-playable" style="background-image:url('<?php echo $video1[0]['image']; ?>');">
											<svg version="1.1" id="Play_Showreel" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-1045 1046 35 35" style="enable-background:new -1045 1046 35 35;" xml:space="preserve">
											<style type="text/css">.Play_Showreel_st1{fill:#333333;}.Play_Showreel_st2{fill:#FFFFFF;}</style><g class="Play_Showreel_st0"><circle class="Play_Showreel_st1" cx="-1027.5" cy="1063.5" r="17"/></g><g><path class="Play_Showreel_st2" d="M-1030.8,1070.8c-0.2,0-0.3,0-0.4-0.1c-0.5-0.3-0.5-0.9-0.5-1v-12.4c0-0.6,0.3-0.9,0.5-1 c0.5-0.3,1,0.1,1.1,0.2l8.7,6c0.2,0.1,0.3,0.2,0.4,0.4c0.3,0.5,0.1,1.2-0.5,1.5l-8.7,6C-1030.3,1070.7-1030.6,1070.8-1030.8,1070.8 z"/></g></svg>
										</div>
										<video class="video fullwidth-video mobile-video" autobuffer>
											<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
										</video>
										<!-- Video Controls -->
										<div class="video-controls">
											<button type="button" class="play-button">
												<div class="play-button__pause active">
													<div></div>
													<div></div>
												</div>
												<div class="play-button__play"></div>
											</button>
											<input type="range" class="seek-bar" value="0">
											<button type="button" class="mute-button">
												<svg class="mute-button__on" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
													<path d="M36.583,43.552c-1.42,0-2.583,1.163-2.583,2.583v12.108c0,1.421,1.163,2.584,2.583,2.584h5.489  c1.42,0,3.531,0.673,4.69,1.495l13.062,9.278c1.159,0.823,2.106,0.333,2.106-1.087V34.511c0-1.42-0.965-1.934-2.143-1.142  L46.799,42.11c-1.178,0.792-3.306,1.442-4.727,1.442H36.583z"/>
												</svg>
												<svg class="mute-button__off" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
													<g>
														<path d="M17.583,43.431c-1.42,0-2.583,1.163-2.583,2.583v12.108c0,1.421,1.163,2.584,2.583,2.584h5.489   c1.42,0,3.531,0.673,4.69,1.495l13.062,9.278c1.159,0.823,2.106,0.333,2.106-1.087V34.39c0-1.42-0.965-1.934-2.143-1.142   l-12.989,8.741c-1.178,0.792-3.306,1.442-4.727,1.442H17.583z"/>
														<path d="M50.643,41.047c5.343,6.735,3.92,14.402-0.354,21.264c-1.544,2.48,2.366,4.748,3.905,2.28   c5.491-8.818,6.302-18.353-0.354-26.74C52.027,35.567,48.852,38.789,50.643,41.047z"/>
														<path d="M64.282,31.393c-1.897-2.22-5.081,0.993-3.198,3.196c7.426,8.692,7.378,26.309,0,35.013   c-1.872,2.209,1.309,5.424,3.198,3.196C73.336,62.116,73.394,42.06,64.282,31.393z"/>
														<path d="M73.538,22.889c-1.96-2.166-5.149,1.041-3.199,3.196c11.173,12.342,12.041,38.982,0,51.051   c-2.059,2.064,1.138,5.262,3.199,3.196C87.367,66.468,86.343,37.04,73.538,22.889z"/>
													</g>
												</svg>
											</button>
										</div>
										<?php if($video1[0]['caption_text']){ ?>
												<div class="image-caption"
													style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
															top: 0px; right: 0px;
														<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
															top: 50%; left: 50%; transform: translate(-50%,50%);
														<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
															bottom: 0px; left: 0px;
														<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
															bottom: 0px; right: 0px;
														<?php } else { ?>
															top: 0px; left: 0px;
														<?php } if($video1[0]['caption_bg']){ ?>
															background-color: <?php echo $video1[0]['caption_bg']; } ?>">
												<?php echo $video1[0]['caption_text']; ?>
											</div>
										<?php } ?>
									</div>
								</section>
								<?php break;
							case 'temp_browser':
								# browser template
								?>
								<section class="one-video col-8 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
									<div class="browser-frame">
										<div class="container container-video">
											<div class="video-img video-img--primary mobile-playable" style="background-image:url('<?php echo $video1[0]['image']; ?>');"></div>
											<?php if (!$isMobile) { ?>
											<video class="video fullwidth-video mobile-video" preload="auto" webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php } ?>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php break;
							case 'temp_ipad_portrait':
								# ipad portrait template
								?>
								<section id="<?php echo $template_id; ?>" class="one-video col-8 portrait project-block project-block--template" style="background-color:<?php if($backgroundColor1){ ?><?php echo $backgroundColor1; ?><?php } ?>">
									<div class="tablet">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
											 xml:space="preserve">
											<g>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
													c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
												<g>
													<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
														c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
														c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
														v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
														c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
												</g>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php break;
							case 'temp_ipad_landscape':
								# ipad landscape template
								?>
								<section id="<?php echo $template_id; ?>" class="one-video col-8 landscape project-block project-block--template" style="background-color:<?php if($backgroundColor1){ ?><?php echo $backgroundColor1; ?><?php } ?>">
									<div class="tablet">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
											 xml:space="preserve">
											<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
												s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
											<g>
												<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
													c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
													c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
													h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
													c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
													/>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php break;
							case 'temp_iphone':
								# iphone template
								?>
								<style>#<?php echo $template_id; ?> .mobile:before, #<?php echo $template_id; ?> .mobile:after{background: <?php echo $backgroundColor3; ?>}</style>
								<section id="<?php echo $template_id; ?>" class="one-video one-video--mobile col-8 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
									<div class="mobile">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
											xml:space="preserve">
											<g>
												<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
													c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
													c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
													C232.771,828.127,223.188,837.708,211.414,837.708z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
													c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
													c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
													c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
													C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
											</g>
										</svg>
										<div class="container container-video">
											<div class="video-img video-img--primary screen lazy" data-original="<?php echo $video1[0]['image']; ?>"></div>
											<?php if (!$isMobile) { ?>
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php } ?>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php break;
						}
						break;
					case 'temp_8':
						# ONE VIDEO + TEXT
						$layout = get_sub_field('layout_1');
						$content_position = get_sub_field('content_position');
						$content = get_sub_field('content');
						$headline = $content[0]['headline'];
						$description = $content[0]['description'];
						switch ($layout) {
							case 'temp_standard':
								# standard template
								if($content_position == 'left'){
									# content on left
								?>
								<section class="video_text">
									<div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
									<div class="col-4 offset-2 project-block project-block--image ">
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<section class="video_text">
									<div class="col-4 project-block project-block--image">
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
							case 'temp_browser':
								# browser template
								if($content_position == 'left'){
									# content on left
								?>
								<section class="video_text sticky-row--wrapper">
									<div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
									<div class="col-4 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="browser-frame">
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video1[0]['caption_bg']){ ?>
																	background-color: <?php echo $video1[0]['caption_bg']; } ?>">
														<?php echo $video1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<section class="video_text sticky-row--wrapper">
									<div class="col-4 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="browser-frame">
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video1[0]['caption_bg']){ ?>
																	background-color: <?php echo $video1[0]['caption_bg']; } ?>">
														<?php echo $video1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div><!--
									--><div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
							case 'temp_ipad_portrait':
								# ipad portrait template
								if($content_position == 'left'){
									# content on left
								?>
								<section class="video_text sticky-row--wrapper">
									<div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
									<div id="<?php echo $template_id; ?>" class="col-4 portrait half-width project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="tablet">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
											 xml:space="preserve">
												<g>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
														c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
													<g>
														<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
															c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
														<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
															c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
															v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
															c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
													</g>
												</g>
											</svg>
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video1[0]['caption_bg']){ ?>
																	background-color: <?php echo $video1[0]['caption_bg']; } ?>">
														<?php echo $video1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<section class="video_text sticky-row--wrapper">
									<div id="<?php echo $template_id; ?>" class="col-4 portrait half-width project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="tablet">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
												 xml:space="preserve">
												<g>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
														c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
													<g>
														<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
															c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
														<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
															c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
															v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
															c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
													</g>
												</g>
											</svg>
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video1[0]['caption_bg']){ ?>
																	background-color: <?php echo $video1[0]['caption_bg']; } ?>">
														<?php echo $video1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											 </div>
										</div>
									</div>
									<div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
							case 'temp_ipad_landscape':
								# ipad landscape template
								if($content_position == 'left'){
									# content on left
								?>
								<section class="video_text sticky-row--wrapper">
									<div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
									<div id="<?php echo $template_id; ?>" class="col-4 half-width--tab landscape project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="tablet">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
												 xml:space="preserve">
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
													s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
												<g>
													<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
														c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
														c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
														h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
														c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
														/>
												</g>
											</svg>
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video1[0]['caption_bg']){ ?>
																	background-color: <?php echo $video1[0]['caption_bg']; } ?>">
														<?php echo $video1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<section class="video_text sticky-row--wrapper">
									<div id="<?php echo $template_id; ?>" class="col-4 half-width--tab landscape project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="tablet">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
												 xml:space="preserve">
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
													s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
												<g>
													<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
														c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
														c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
														h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
														c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
														/>
												</g>
											</svg>
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video1[0]['caption_bg']){ ?>
																	background-color: <?php echo $video1[0]['caption_bg']; } ?>">
														<?php echo $video1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											 </div>
										</div>
									</div>
									<div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
							case 'temp_iphone':
								# iphone template
								if($content_position == 'left'){
									# content on left
								?>
								<style>#<?php echo $template_id; ?> .mobile:before, #<?php echo $template_id; ?> .mobile:after{background: <?php echo $backgroundColor3; ?>}</style>
								<section class="video_text sticky-row--wrapper">
									<div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
									<div id="<?php echo $template_id; ?>" class="col-4 half-width project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="mobile">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
												 xml:space="preserve">
												<g>
													<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
														c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
														c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
														C232.771,828.127,223.188,837.708,211.414,837.708z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
														c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
														c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
														c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
														C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
												</g>
											</svg>
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video1[0]['caption_bg']){ ?>
																	background-color: <?php echo $video1[0]['caption_bg']; } ?>">
														<?php echo $video1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<style>#<?php echo $template_id; ?> .mobile:before, #<?php echo $template_id; ?> .mobile:after{background: <?php echo $backgroundColor3; ?>}</style>
								<section class="video_text sticky-row--wrapper">
									<div id="<?php echo $template_id; ?>" class="col-4 half-width project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="mobile">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
												 xml:space="preserve">
												<g>
													<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
														c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
														c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
														C232.771,828.127,223.188,837.708,211.414,837.708z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
														c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
														c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
														c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
														C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
												</g>
											</svg>
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video1[0]['caption_bg']){ ?>
																	background-color: <?php echo $video1[0]['caption_bg']; } ?>">
														<?php echo $video1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
									<div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
						}
						break;
					case 'temp_9':
						# TWO VIDEOS TEMPLATES
						$layout = get_sub_field('layout_1');
						switch ($layout) {
							case 'temp_standard':
								# standard template
								?>
								<section class="two-videos section-animation">
									<div class="col-4">
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="col-4">
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video2[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video2[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video2[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video2[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video2[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video2[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video2[0]['caption_bg']){ ?>
																background-color: <?php echo $video2[0]['caption_bg']; } ?>">
													<?php echo $video2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php break;
							case 'temp_browser':
								# browser template
								?>
								<section class="two-videos two-images--template">
									<div class="col-4 project-block project-block--template marR" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="browser-frame">
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video1[0]['caption_bg']){ ?>
																	background-color: <?php echo $video1[0]['caption_bg']; } ?>">
														<?php echo $video1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div><!--
									--><div class="col-4 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="browser-frame">
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video2[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video2[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video2[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video2[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video2[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video2[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video2[0]['caption_bg']){ ?>
																	background-color: <?php echo $video2[0]['caption_bg']; } ?>">
														<?php echo $video2[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</section>
								<?php
								break;
							case 'temp_ipad_portrait':
								# ipad portrait template
								$style = get_sub_field('images_style_ipad');
								if($style == 'same_container'){
									# same container
								?>
								<section id="<?php echo $template_id; ?>" class="two-videos col-8 portrait fw-multiple project-block project-block--template" style="background-color:<?php if($backgroundColor1){ ?><?php echo $backgroundColor1; ?><?php } ?>">
									<div class="tablet">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
											 xml:space="preserve">
											<g>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
													c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
												<g>
													<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
														c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
														c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
														v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
														c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
												</g>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="tablet">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
											 xml:space="preserve">
											<g>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
													c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
												<g>
													<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
														c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
														c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
														v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
														c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
												</g>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video2[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video2[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video2[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video2[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video2[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video2[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video2[0]['caption_bg']){ ?>
																background-color: <?php echo $video2[0]['caption_bg']; } ?>">
													<?php echo $video2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php
								} else {
									# separated containers
								?>
								<section id="<?php echo $template_id; ?>" class="two-videos col-4 portrait project-block half-width project-block--template marR" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
									<div class="tablet">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
												 xml:space="preserve">
											<g>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
													c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
												<g>
													<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
														c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
														c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
														v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
														c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
												</g>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section><!--
								--><section class="two-videos col-4 portrait project-block half-width project-block--template" <?php if($backgroundColor2){ ?>style="background-color: <?php echo $backgroundColor2; ?>"<?php } ?>>
									<div class="tablet">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 width="576.841px" height="860.202px" viewBox="0 0 576.841 860.202" enable-background="new 0 0 576.841 860.202"
											 xml:space="preserve">
											<g>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M309.778,816.349c0-11.777-9.582-21.358-21.358-21.358c-11.777,0-21.358,9.581-21.358,21.358
													c0,11.777,9.581,21.358,21.358,21.358C300.196,837.707,309.778,828.126,309.778,816.349z"/>
												<g>
													<path fill="none" d="M312.208,816.349c0-13.115-10.672-23.786-23.786-23.786c-13.118,0-23.787,10.671-23.787,23.786
														c0,13.116,10.669,23.787,23.787,23.787C301.536,840.136,312.208,829.465,312.208,816.349z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M576.841,829.137V31.066C576.841,13.979,562.862,0,545.774,0H31.066C13.98,0,0,13.979,0,31.066v798.071
														c0,17.086,13.98,31.065,31.066,31.065h514.708C562.862,860.202,576.841,846.223,576.841,829.137z M30.922,773.058V87.145h514.997
														v685.913H30.922z M264.635,816.349c0-13.115,10.669-23.786,23.787-23.786c13.114,0,23.786,10.671,23.786,23.786
														c0,13.116-10.672,23.787-23.786,23.787C275.304,840.136,264.635,829.465,264.635,816.349z"/>
												</g>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video2[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video2[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video2[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video2[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video2[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video2[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video2[0]['caption_bg']){ ?>
																background-color: <?php echo $video2[0]['caption_bg']; } ?>">
													<?php echo $video2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php

								}
								?>
								<?php
								break;
							case 'temp_ipad_landscape':
								# ipad landscape template
								$style = get_sub_field('images_style_ipad');
								if($style == 'same_container'){
									# same container
								?>
								<section id="<?php echo $template_id; ?>" class="two-videos col-8 landscape fw-multiple project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
									<div class="tablet landscape">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
											 xml:space="preserve">
											<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
												s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
											<g>
												<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
													c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
													c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
													h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
													c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
													/>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="tablet landscape">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
											 xml:space="preserve">
											<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
												s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
											<g>
												<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
													c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
													c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
													h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
													c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
													/>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video2[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video2[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video2[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video2[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video2[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video2[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video2[0]['caption_bg']){ ?>
																background-color: <?php echo $video2[0]['caption_bg']; } ?>">
													<?php echo $video2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php
								} else {
									// separated containers
								?>
								<section id="<?php echo $template_id; ?>" class="two-videos col-4 landscape project-block half-width--tab project-block--template marR larger" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
									<div class="tablet landscape">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
											 xml:space="preserve">
											<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
												s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
											<g>
												<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
													c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
													c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
													h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
													c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
													/>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section><!--
								--><section class="two-videos col-4 landscape project-block half-width--tab project-block--template larger" <?php if($backgroundColor2){ ?>style="background-color: <?php echo $backgroundColor2; ?>"<?php } ?>>
									<div class="tablet landscape">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 width="1106.19px" height="741.798px" viewBox="0 0 1106.19 741.798" enable-background="new 0 0 1106.19 741.798"
											 xml:space="preserve">
											<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1049.796,342.306c-15.766,0-28.592,12.827-28.592,28.592c0,15.766,12.826,28.591,28.592,28.591
												s28.591-12.825,28.591-28.591C1078.387,355.133,1065.562,342.306,1049.796,342.306z"/>
											<g>
												<path fill="none" d="M1049.796,340.309c-16.865,0-30.589,13.724-30.589,30.589c0,16.869,13.724,30.589,30.589,30.589
													c16.866,0,30.59-13.72,30.59-30.589C1080.386,354.032,1066.662,340.309,1049.796,340.309z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M1066.24,0H39.948C17.977,0,0,17.977,0,39.95v661.898c0,21.972,17.977,39.95,39.948,39.95H1066.24
													c21.972,0,39.95-17.979,39.95-39.95V39.95C1106.19,17.977,1088.212,0,1066.24,0z M994.126,79.713v582.369v39.951h-39.951H152.013
													h-39.947v-39.951V79.713V39.765h39.947h802.162h39.951V79.713z M1049.796,401.486c-16.865,0-30.589-13.72-30.589-30.589
													c0-16.865,13.724-30.589,30.589-30.589c16.866,0,30.59,13.724,30.59,30.589C1080.386,387.767,1066.662,401.486,1049.796,401.486z"
													/>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video2[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video2[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video2[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video2[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video2[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video2[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video2[0]['caption_bg']){ ?>
																background-color: <?php echo $video2[0]['caption_bg']; } ?>">
													<?php echo $video2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php
								}
								break;
							case 'temp_iphone':
								# iphone template
								$style = get_sub_field('images_style_iphone');
								if($style == 'same_container'){
									# same container
								?>
								<style>#<?php echo $template_id; ?> .mobile:before, #<?php echo $template_id; ?> .mobile:after{background: <?php echo $backgroundColor3; ?>}</style>
								<section id="<?php echo $template_id; ?>" class="two-videos col-8 fw-multiple project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
									<div class="mobile">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
												 xml:space="preserve">
											<g>
												<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
													c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
													c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
													C232.771,828.127,223.188,837.708,211.414,837.708z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
													c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
													c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
													c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
													C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="mobile">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
												 xml:space="preserve">
											<g>
												<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
													c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
													c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
													C232.771,828.127,223.188,837.708,211.414,837.708z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
													c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
													c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
													c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
													C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video2[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video2[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video2[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video2[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video2[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video2[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video2[0]['caption_bg']){ ?>
																background-color: <?php echo $video2[0]['caption_bg']; } ?>">
													<?php echo $video2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php
								} else {
									# separated containers
								?>
								<style>#<?php echo $template_id; ?> .mobile:before, #<?php echo $template_id; ?> .mobile:after{background: <?php echo $backgroundColor3; ?>}</style>
								<section id="<?php echo $template_id; ?>" class="two-videos col-8 fw-multiple project-block--template collapsed">
									<div class="col-4 project-block half-width marR" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="mobile">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
												 xml:space="preserve">
												<g>
													<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
														c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
														c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
														C232.771,828.127,223.188,837.708,211.414,837.708z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
														c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
														c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
														c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
														C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
												</g>
											</svg>
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video1[0]['caption_bg']){ ?>
																	background-color: <?php echo $video1[0]['caption_bg']; } ?>">
														<?php echo $video1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div><!--
									--><div class="col-4 project-block half-width" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="mobile">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
												 xml:space="preserve">
												<g>
													<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
														c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
														c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
														C232.771,828.127,223.188,837.708,211.414,837.708z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
														c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
													<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
														c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
														c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
														C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
												</g>
											</svg>
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video2[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video2[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video2[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video2[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video2[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video2[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video2[0]['caption_bg']){ ?>
																	background-color: <?php echo $video2[0]['caption_bg']; } ?>">
														<?php echo $video2[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</section>
								<?php } ?>
								<?php
								break;
						}
						break;
					case 'temp_10':
						# TWO VIDEOS + TEXT TEMPLATES
						$layout = get_sub_field('layout_2');
						$content_position = get_sub_field('content_position');
						$content = get_sub_field('content');
						$headline = $content[0]['headline'];
						$description = $content[0]['description'];
						switch ($layout) {
							case 'temp_standard':
								# standard template
								if($content_position == 'left'){
									# content on left
								?>
								<section class="two-videos-text sticky-row--wrapper">
									<div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div><!--
									--><div class="col-4 offset-2">
										<div class="two-images--stacked">
											<div class="stacked-image--wrapper project-block project-block--image">
												<div class="container container-video">
													<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
														<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
													</video>
													<?php if($video1[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($video1[0]['caption_bg']){ ?>
																		background-color: <?php echo $video1[0]['caption_bg']; } ?>">
															<?php echo $video1[0]['caption_text']; ?>
														</div>
													<?php } ?>
												</div>
											</div>
											<div class="stacked-image--wrapper project-block project-block--image">
												<div class="container container-video">
													<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
														<source src="<?php echo $video2[0]['video_url']; ?>" type="video/mp4">
													</video>
													<?php if($video2[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($video2[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($video2[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($video2[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($video2[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($video2[0]['caption_bg']){ ?>
																		background-color: <?php echo $video2[0]['caption_bg']; } ?>">
															<?php echo $video2[0]['caption_text']; ?>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<section class="two-videos-text sticky-row--wrapper">
									<div class="col-4 project-block--image">
										<div class=" two-images--stacked">
											<div class="stacked-image--wrapper project-block project-block--image">
												<div class="container container-video">
													<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
														<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
													</video>
													<?php if($video1[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($video1[0]['caption_bg']){ ?>
																		background-color: <?php echo $video1[0]['caption_bg']; } ?>">
															<?php echo $video1[0]['caption_text']; ?>
														</div>
													<?php } ?>
												</div>
											</div>
											<div class="stacked-image--wrapper project-block project-block--image">
												<div class="container container-video">
													<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
														<source src="<?php echo $video2[0]['video_url']; ?>" type="video/mp4">
													</video>
													<?php if($video2[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($video2[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($video2[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($video2[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($video2[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($video2[0]['caption_bg']){ ?>
																		background-color: <?php echo $video2[0]['caption_bg']; } ?>">
															<?php echo $video2[0]['caption_text']; ?>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div><!--
									--><div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
							case 'temp_browser':
								# browser template
								if($content_position == 'left'){
									# content on left
								?>
								<section class="two-videos-text sticky-row--wrapper">
									<div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div><!--
									--><div class="col-4 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="browser-frame">
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video1[0]['caption_bg']){ ?>
																	background-color: <?php echo $video1[0]['caption_bg']; } ?>">
														<?php echo $video1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</section>
								<?php
								}else{
									# content on right
								?>
								<section class="two-videos-text sticky-row--wrapper">
									<div class="col-4 project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
										<div class="browser-frame">
											<div class="container container-video">
												<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
													<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
												</video>
												<?php if($video1[0]['caption_text']){ ?>
														<div class="image-caption"
															style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																	top: 0px; right: 0px;
																<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																	top: 50%; left: 50%; transform: translate(-50%,50%);
																<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																	bottom: 0px; left: 0px;
																<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																	bottom: 0px; right: 0px;
																<?php } else { ?>
																	top: 0px; left: 0px;
																<?php } if($video1[0]['caption_bg']){ ?>
																	background-color: <?php echo $video1[0]['caption_bg']; } ?>">
														<?php echo $video1[0]['caption_text']; ?>
													</div>
												<?php } ?>
											</div>
										</div>
									</div><!--
									--><div class="row-section-wrapper col-2 project-block">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
						}
						break;
					case 'temp_11':
						# THREE IMAGES TEMPLATES
						$layout = get_sub_field('layout_3');
						switch ($layout) {
							case 'temp_standard':
								$video_position = get_sub_field('video_position');
								# standard template
								if($video_position == 'right2'){
									# 1 image left / 2 images right
								?>
								<section class="three-videos mosaic-gallery mosaic-right">
									<div class="col-4 project-block project-block--template marR">
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video2[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video2[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video2[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video2[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video2[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video2[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video2[0]['caption_bg']){ ?>
																background-color: <?php echo $video2[0]['caption_bg']; } ?>">
													<?php echo $video2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div><!--
									--><div class="col-4 project-block project-block--template">
											<div class="container container-video">
											 <video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video3[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video3[0]['caption_text']){ ?>
												<div class="image-caption"
													style=" <?php if($video3[0]['caption_position'] === 'topRight'){ ?>
															top: 0px; right: 0px;
														<?php } else if($video3[0]['caption_position'] === 'center'){ ?>
															top: 50%; left: 50%; transform: translate(-50%,50%);
														<?php } else if($video3[0]['caption_position'] === 'bottomLeft'){ ?>
															bottom: 0px; left: 0px;
														<?php } else if($video3[0]['caption_position'] === 'bottomRight'){ ?>
															bottom: 0px; right: 0px;
														<?php } else { ?>
															top: 0px; left: 0px;
														<?php } if($video3[0]['caption_bg']){ ?>
															background-color: <?php echo $video3[0]['caption_bg']; } ?>">
													<?php echo $video3[0]['caption_text']; ?>
												</div>
												<?php } ?>
										</div>
									</div>
								</section>
								<?php
								} else {
									# 2 image left / 1 image right
								?>
								<section class="three-videos mosaic-gallery mosaic-left">
									<div class="col-4 project-block project-block--template marR">
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div><!--
									--><div class="col-4 project-block project-block--template">
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video2[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video2[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video2[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video2[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video2[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video2[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video2[0]['caption_bg']){ ?>
																background-color: <?php echo $video2[0]['caption_bg']; } ?>">
													<?php echo $video2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video3[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video3[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video3[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video3[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video3[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video3[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video3[0]['caption_bg']){ ?>
																background-color: <?php echo $video3[0]['caption_bg']; } ?>">
													<?php echo $video3[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php
								}
								break;
							case 'temp_iphone':
								# iphone template
								?>
								<section id="<?php echo $template_id; ?>" class="three-videos col-8 fw-multiple project-block project-block--template" <?php if($backgroundColor1){ ?>style="background-color: <?php echo $backgroundColor1; ?>"<?php } ?>>
									<div class="mobile">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
												 xml:space="preserve">
											<g>
												<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
													c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
													c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
													C232.771,828.127,223.188,837.708,211.414,837.708z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
													c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
													c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
													c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
													C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video1[0]['caption_bg']){ ?>
																background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="mobile">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
													 width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
													 xml:space="preserve">
											<g>
												<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
													c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
													c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
													C232.771,828.127,223.188,837.708,211.414,837.708z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
													c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
													c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
													c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
													C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video2[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video2[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video2[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video2[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video2[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video2[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video2[0]['caption_bg']){ ?>
																background-color: <?php echo $video2[0]['caption_bg']; } ?>">
													<?php echo $video2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="mobile">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="421.826px" height="860.202px" viewBox="0 0 421.826 860.202" enable-background="new 0 0 421.826 860.202"
												 xml:space="preserve">
											<g>
												<path fill="none" d="M211.414,792.562c-13.117,0-23.788,10.672-23.788,23.785c0,13.117,10.671,23.789,23.788,23.789
													c13.113,0,23.786-10.672,23.786-23.789C235.2,803.234,224.527,792.562,211.414,792.562z M211.414,837.708
													c-11.777,0-21.359-9.581-21.359-21.36c0-11.775,9.582-21.357,21.359-21.357c11.774,0,21.357,9.582,21.357,21.357
													C232.771,828.127,223.188,837.708,211.414,837.708z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M211.414,794.99c-11.777,0-21.359,9.582-21.359,21.357c0,11.779,9.582,21.36,21.359,21.36
													c11.774,0,21.357-9.581,21.357-21.36C232.771,804.572,223.188,794.99,211.414,794.99z"/>
												<path fill="<?php if($backgroundColor3){ ?><?php echo $backgroundColor3; ?><?php } ?>" d="M390.76,0H31.066C13.98,0,0,13.979,0,31.066v798.07c0,17.086,13.98,31.065,31.066,31.065H390.76
													c17.087,0,31.066-13.979,31.066-31.065V31.066C421.826,13.979,407.847,0,390.76,0z M211.414,840.137
													c-13.117,0-23.788-10.672-23.788-23.789c0-13.113,10.671-23.785,23.788-23.785c13.113,0,23.786,10.672,23.786,23.785
													C235.2,829.465,224.527,840.137,211.414,840.137z M398.409,773.092H23.416V87.135h374.993V773.092z"/>
											</g>
										</svg>
										<div class="container container-video">
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video3[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video3[0]['caption_text']){ ?>
													<div class="image-caption"
														style=" <?php if($video3[0]['caption_position'] === 'topRight'){ ?>
																top: 0px; right: 0px;
															<?php } else if($video3[0]['caption_position'] === 'center'){ ?>
																top: 50%; left: 50%; transform: translate(-50%,50%);
															<?php } else if($video3[0]['caption_position'] === 'bottomLeft'){ ?>
																bottom: 0px; left: 0px;
															<?php } else if($video3[0]['caption_position'] === 'bottomRight'){ ?>
																bottom: 0px; right: 0px;
															<?php } else { ?>
																top: 0px; left: 0px;
															<?php } if($video3[0]['caption_bg']){ ?>
																background-color: <?php echo $video3[0]['caption_bg']; } ?>">
													<?php echo $video3[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php
								break;
						}
						break;
					case 'temp_12':
						# TITLE + DESCRIPTION
						$layout = get_sub_field('layout_4');
						$text_module_position = get_sub_field('text_module_position');
						$title = $textModule1[0]['title'];
						$description = $textModule1[0]['description'];
						switch ($layout) {
							case 'temp_standard':
								# standard template
								if($text_module_position == 'left'){
									# Title / Description
								?>
								<section class="title-description content-maxwidth section-animation">
									<div class="col-9 content-col">
										<?php if($title){ ?>
											<div class="content-title text-anim slide-in-page"><?php echo $title; ?></div>
									</div>
									<div class="col-10 content-col">
										<?php } if($description){ ?>
											<div class="content-details text-anim slide-in-page row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
								</section>
								<?php
								} else {
									# Description / Title
								?>
								<section class="title-description content-maxwidth section-animation">
									<div class="col-9 content-col">
										<?php if($description){ ?>
											<div class="content-details text-anim slide-in-page row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
									<div class="col-10 content-col">
										<?php if($title){ ?>
											<div class="content-title text-anim slide-in-page"><?php echo $title; ?></div>
										<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
						}
						break;
					case 'temp_13':
						# TAGS + DESCRIPTION
						$layout = get_sub_field('layout_4');
						$text_module_position = get_sub_field('text_module_position_2');
						$tags = $textModule2[0]['tags'];
						$numTags = count($tags);
						$i = 0;
						$description = $textModule2[0]['description'];
						switch ($layout) {
							case 'temp_standard':
								# standard template
								if($text_module_position == 'left'){
									# Tags / Description
								?>
								<section class="title-description content-maxwidth">
									<div class="col-9 content-col">
										<?php foreach ($tags as $tag) { ?>
											<span class="content-tag"> <?php echo $tag['tag']; ?> </span>
										<?php } ?>
									</div>
									<div class="col-10 content-col">
										<?php if($description){ ?>
											<div class="content-details text-anim slide-in-page row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
								</section>
								<?php
								} else {
									# Description / Tags
								?>
								<section class="title-description tag-descr content-maxwidth">
									<div class="col-10 content-col">
										<?php if($description){ ?>
											<div class="content-details text-anim slide-in-page row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
									<div class="col-9 content-col">
										<?php foreach ($tags as $tag) { ?>
											<span class="content-tag"> <?php echo $tag['tag']; ?> </span>
										<?php } ?>
									</div>
								</section>
								<?php
								}
								break;
						}
						break;
					case 'temp_14':
						# SLIDER
						$layout = get_sub_field('layout_4');
						switch ($layout) {
							case 'temp_standard':
								# standard template
								?>
								<section class="slick-template">
									<div class="slick-nav slick-nav--prev"></div>
									<div class="slick-module">
										<?php foreach ($image1 as $img) { ?>
											<div>
												<!-- <div class="screen lazy" data-original="<?php echo $img['image']; ?>"></div> -->
												<img class="lazy" data-original="<?php echo $img['image']; ?>">
											</div>
										<?php } ?>
									</div>
									<div class="slick-nav slick-nav--next"></div>
								</section>
								<?php
								break;
						}
						break;
					case 'temp_15':
						# Quote
						$layout = get_sub_field('layout_4');
						$quote = $textModule3[0]['quote'];
						$title = $textModule3[0]['title'];
						switch ($layout) {
							case 'temp_standard':
								# standard template
								?>
								<section class="quote-template" <?php if($quoteBackgroundColor){ ?>style="background-color:<?php echo $quoteBackgroundColor; ?>;"<?php } ?>>
									<div class="content-maxwidth">
										<?php if($quote){ ?>
										<div class="content-details content-details--quote"
												<?php if($textColor){ ?>style="color:<?php echo $textColor; ?>;"<?php } ?>>
											<?php echo $quote; ?>
										</div>
										<?php } ?>
										<?php if($title){ ?>
										<div class="content-details content-details--title"
												<?php if($textColor){ ?>style="color:<?php echo $textColor; ?>;"<?php } ?>>
											<?php echo $title; ?>
										</div>
										<?php } ?>
									</div>
								</section>
								<?php
								break;
						}
						break;
					case 'temp_16':
						# Portrait & Landscape + Text
						$layout = get_sub_field('layout_4');
						$images_position = get_sub_field('images_position_2');
						$content = get_sub_field('content');
						$headline = $content[0]['headline'];
						$description = $content[0]['description'];
						switch ($layout) {
							case 'temp_standard':
								# standard template
								if($images_position == 'tlp'){ # Text + Land / Portrait ?>
								<section class="port-land-text-module project-block sticky-row--wrapper section-animation">
									<div class="col-2 col-4">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
										<div class="project-block--slider">
											<div class="project-image lazy" data-original="<?php echo $image2[0]['image']; ?>" >
												<div style="position:relative;">
													<?php if($image2[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($image2[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($image2[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($image2[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($image2[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($image2[0]['caption_bg']){ ?>
																		background-color: <?php echo $image2[0]['caption_bg']; } ?>">
															<?php echo $image2[0]['caption_text']; ?>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
									<div class="col-4">
										<div class="project-block--slider">
											<div class="project-image lazy" data-original="<?php echo $image1[0]['image']; ?>" >
												<div style="position:relative;">
													<?php if($image1[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($image1[0]['caption_bg']){ ?>
																		background-color: <?php echo $image1[0]['caption_bg']; } ?>">
															<?php echo $image1[0]['caption_text']; ?>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</section>
								<?php } else if($images_position == 'ltp'){ # Land + Text / Portrait ?>
								<section class="port-land-text-module project-block sticky-row--wrapper section-animation">
									<div class="col-2 col-4">
										<div class="project-block--slider">
											<div class="project-image lazy" data-original="<?php echo $image2[0]['image']; ?>" >
												<div style="position:relative;">
													<?php if($image2[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($image2[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($image2[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($image2[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($image2[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($image2[0]['caption_bg']){ ?>
																		background-color: <?php echo $image2[0]['caption_bg']; } ?>">
															<?php echo $image2[0]['caption_text']; ?>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
									<div class="col-4">
										<div class="project-block--slider">
											<div class="project-image lazy" data-original="<?php echo $image1[0]['image']; ?>" >
												<div style="position:relative;">
													<?php if($image1[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($image1[0]['caption_bg']){ ?>
																		background-color: <?php echo $image1[0]['caption_bg']; } ?>">
															<?php echo $image1[0]['caption_text']; ?>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</section>
								<?php } else if($images_position == 'ptl'){ # Portrait / Text + Land ?>
								<section class="port-land-text-module project-block sticky-row--wrapper section-animation">
									<div class="col-4">
										<div class="project-block--slider">
											<div class="project-image lazy" data-original="<?php echo $image1[0]['image']; ?>" >
												<div style="position:relative;">
													<?php if($image1[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($image1[0]['caption_bg']){ ?>
																		background-color: <?php echo $image1[0]['caption_bg']; } ?>">
															<?php echo $image1[0]['caption_text']; ?>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
									<div class="col-2 col-4">
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
										<div class="project-block--slider">
											<div class="project-image lazy" data-original="<?php echo $image2[0]['image']; ?>" >
												<div style="position:relative;">
													<?php if($image2[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($image2[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($image2[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($image2[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($image2[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($image2[0]['caption_bg']){ ?>
																		background-color: <?php echo $image2[0]['caption_bg']; } ?>">
															<?php echo $image2[0]['caption_text']; ?>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</section>
								<?php } else { # Portrait / Land + Text ?>
								<section class="port-land-text-module project-block sticky-row--wrapper section-animation">
									<div class="col-4">
										<div class="project-block--slider">
											<div class="project-image lazy" data-original="<?php echo $image1[0]['image']; ?>" >
												<div style="position:relative;">
													<?php if($image1[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($image1[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($image1[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($image1[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($image1[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($image1[0]['caption_bg']){ ?>
																		background-color: <?php echo $image1[0]['caption_bg']; } ?>">
																<?php echo $image1[0]['caption_text']; ?>
															</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
									<div class="col-2 col-4">
										<div class="project-block--slider">
											<div class="project-image lazy" data-original="<?php echo $image2[0]['image']; ?>" >
												<div style="position:relative;">
													<?php if($image2[0]['caption_text']){ ?>
															<div class="image-caption"
																style=" <?php if($image2[0]['caption_position'] === 'topRight'){ ?>
																		top: 0px; right: 0px;
																	<?php } else if($image2[0]['caption_position'] === 'center'){ ?>
																		top: 50%; left: 50%; transform: translate(-50%,50%);
																	<?php } else if($image2[0]['caption_position'] === 'bottomLeft'){ ?>
																		bottom: 0px; left: 0px;
																	<?php } else if($image2[0]['caption_position'] === 'bottomRight'){ ?>
																		bottom: 0px; right: 0px;
																	<?php } else { ?>
																		top: 0px; left: 0px;
																	<?php } if($image2[0]['caption_bg']){ ?>
																		background-color: <?php echo $image2[0]['caption_bg']; } ?>">
																<?php echo $image2[0]['caption_text']; ?>
															</div>
													<?php } ?>
												</div>
											</div>
										</div>
										<?php if($headline){ ?>
										<div class="row-section-title"><?php echo $headline; ?></div>
										<?php } if($description){ ?>
										<div class="row-section-description"><?php echo $description; ?></div>
										<?php } ?>
									</div>
								</section>
								<?php }
								break;
						}
						break;
					case 'temp_17':
						# Description
						$layout = get_sub_field('layout_4');
						switch ($layout) {
							case 'temp_standard':
								# standard template
								?>
								<section class="quote-template" <?php if($quoteBackgroundColor){ ?>style="background-color:<?php echo $quoteBackgroundColor; ?>;"<?php } ?>>
									<div class="content-maxwidth">
										<?php if($textModule4){ ?>
										<div class="content-details content-details--quote content-details--description"
												<?php if($textColor){ ?>style="color:<?php echo $textColor; ?>;"<?php } ?>>
											<?php echo $textModule4; ?>
										</div>
										<?php } ?>
									</div>
								</section>
								<?php
								break;
						}
						break;
					case 'temp_18':
						# VIDEO + IMAGE TEMPLATE
						$layout = get_sub_field('layout_4');
						switch ($layout) {
							case 'temp_standard':
								$position = get_sub_field('position');
								# standard template
								if($position == 'videoFirst'){
									# Video / Image
								?>
								<section class="two-images-module two-images--template">
									<div class="col-4 marR project-block project-block--image videoo_text">
										<div class="container container-video">
											<div class="video-img" style="background-image:url('<?php echo $video1[0]['image']; ?>');"></div>
											<?php if (!$isMobile) { ?>
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php } ?>
											<?php if($video1[0]['caption_text']){ ?>
												<div class="image-caption"
													style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
															top: 0px; right: 0px;
														<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
															top: 50%; left: 50%; transform: translate(-50%,50%);
														<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
															bottom: 0px; left: 0px;
														<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
															bottom: 0px; right: 0px;
														<?php } else { ?>
															top: 0px; left: 0px;
														<?php } if($video1[0]['caption_bg']){ ?>
															background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="col-4 project-block project-block--image image-text">
										<div class="project-image lazy" data-original="<?php echo $image2[0]['image']; ?>">
											<?php if($image2[0]['caption_text']){ ?>
												<div class="image-caption"
													style=" <?php if($image2[0]['caption_position'] === 'topRight'){ ?>
															top: 0px; right: 0px;
														<?php } else if($image2[0]['caption_position'] === 'center'){ ?>
															top: 50%; left: 50%; transform: translate(-50%,50%);
														<?php } else if($image2[0]['caption_position'] === 'bottomLeft'){ ?>
															bottom: 0px; left: 0px;
														<?php } else if($image2[0]['caption_position'] === 'bottomRight'){ ?>
															bottom: 0px; right: 0px;
														<?php } else { ?>
															top: 0px; left: 0px;
														<?php } if($image2[0]['caption_bg']){ ?>
															background-color: <?php echo $image2[0]['caption_bg']; } ?>">
													<?php echo $image2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php
								} else {
									# Image / Video
								?>
								<section class="two-images-module two-images--template">
									<div class="col-4 project-block project-block--image image-text">
										<div class="project-image lazy" data-original="<?php echo $image2[0]['image']; ?>">
											<?php if($image2[0]['caption_text']){ ?>
												<div class="image-caption"
													style=" <?php if($image2[0]['caption_position'] === 'topRight'){ ?>
															top: 0px; right: 0px;
														<?php } else if($image2[0]['caption_position'] === 'center'){ ?>
															top: 50%; left: 50%; transform: translate(-50%,50%);
														<?php } else if($image2[0]['caption_position'] === 'bottomLeft'){ ?>
															bottom: 0px; left: 0px;
														<?php } else if($image2[0]['caption_position'] === 'bottomRight'){ ?>
															bottom: 0px; right: 0px;
														<?php } else { ?>
															top: 0px; left: 0px;
														<?php } if($image2[0]['caption_bg']){ ?>
															background-color: <?php echo $image2[0]['caption_bg']; } ?>">
													<?php echo $image2[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="col-4 marR project-block project-block--image videoo_text">
										<div class="container container-video">
											<div class="video-img" style="background-image:url('<?php echo $video1[0]['image']; ?>');"></div>
											<video class="video fullwidth-video" preload="auto" loop="loop" muted webkit-playsinline="true" playsinline="true">
												<source src="<?php echo $video1[0]['video_url']; ?>" type="video/mp4">
											</video>
											<?php if($video1[0]['caption_text']){ ?>
												<div class="image-caption"
													style=" <?php if($video1[0]['caption_position'] === 'topRight'){ ?>
															top: 0px; right: 0px;
														<?php } else if($video1[0]['caption_position'] === 'center'){ ?>
															top: 50%; left: 50%; transform: translate(-50%,50%);
														<?php } else if($video1[0]['caption_position'] === 'bottomLeft'){ ?>
															bottom: 0px; left: 0px;
														<?php } else if($video1[0]['caption_position'] === 'bottomRight'){ ?>
															bottom: 0px; right: 0px;
														<?php } else { ?>
															top: 0px; left: 0px;
														<?php } if($video1[0]['caption_bg']){ ?>
															background-color: <?php echo $video1[0]['caption_bg']; } ?>">
													<?php echo $video1[0]['caption_text']; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</section>
								<?php
								}
								break;
							}
						break;
				}
			endwhile; endif;
		?>
	</div>
	<div class="above-footer">
		<div class="above-footer__link">
			<p class="above-footer__link__text">See more work</p>
		</div>
	</div>
	<!-- </div> -->
</div>

<?php include 'bottomsection.php'; ?>
<?php get_footer(); ?>

<script type="text/javascript">require('modules/mobile-template')</script>
<script type="text/javascript">require('modules/tablet-template')</script>
<script type="text/javascript">require('modules/project-skin')</script>
<script type="text/javascript">require('modules/back-to-top')</script>
<script type="text/javascript">require('modules/project-sidebar')</script>
<script type="text/javascript">require('modules/project-scrolling')</script>
<script type="text/javascript">require('modules/lazy-load_sporty')</script>
<?php endwhile; endif;?>
