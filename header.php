<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
	<head>
		<?php wp_head(); ?>
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		<meta charset='utf-8'>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
		<meta http-equiv="x-ua-compatible" content="ie=11">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta name="pinterest" content="nopin" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" href="<?php bloginfo('template_url'); ?>/img/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/icons/style.css">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/nanoscroller.css">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/slick.css"/>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/slick-theme.css"/>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/common.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/imagesloaded.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/application.vendor.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/application.js"></script>
		<script type="text/javascript" src="path/to/instafeed.min.js"></script>
		<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/favicon.ico">
	</head>

	<?php
		$args = array( 'post_type' => 'projects', 'posts_per_page' => -1);
		$loop = new WP_Query( $args );
	?>

	<body>
		<div class="projects-overlay-image">
			<div class="clone-wrapper">
				<img class="project-image-clone" src="" alt=""/>
				<div class="project-tags-clone"></div>
			</div>
		</div>
		<div class="projects-overlay-wrapper">

			<div class="projects-overlay-filter">
				<ul>
					<li><a href="#" class="project-filter all active">All</a></li>
					<?php $categories = get_categories(); foreach ($categories as &$cat) { echo '<li><a href="#" class="project-filter">'.$cat->name.'</a></li>'; } ?>
				</ul>
			</div>

			<div class="projects-overlay-close-button">
				<div class="bar"></div>
			</div>
			<div class="nano">
				<div class="projects-list nano-content"><?php include 'archive-projects.php';?></div>
			</div>
		</div>
		<div class="header-wrapper">
			<nav class="" >
				<div class="content-maxwidth header-inner-wrapper">
					<a class="return-home-logo" href="/">
						<svg width="95px" height="35px" viewBox="97 40 112 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<defs>
								<polygon id="path-2" points="0 25.8136029 111.889647 25.8136029 111.889647 0 0 0"></polygon>
							</defs>
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(97.000000, 40.000000)">
								<path fill="#000000" d="M17.0402876,0.00879411765 C15.9367582,0.00879411765 15.0722353,0.890117647 15.0722353,2.015 C15.0722353,3.14007353 15.9367582,4.02120588 17.0402876,4.02120588 C18.143817,4.02120588 19.0083399,3.14007353 19.0083399,2.015 C19.0083399,0.908661765 18.1255163,0.00879411765 17.0402876,0.00879411765 L17.0402876,0.00879411765 Z"></path>
								<path fill="#000000" d="M72.9742222,0.00879411765 C71.8706928,0.00879411765 71.0061699,0.890117647 71.0061699,2.015 C71.0061699,3.14007353 71.8706928,4.02120588 72.9742222,4.02120588 C74.0777516,4.02120588 74.9422745,3.14007353 74.9422745,2.015 C74.9422745,0.908661765 74.059451,0.00879411765 72.9742222,0.00879411765"></path>
								<path id="Fill-5" fill="#000000" d="M38.8231895,5.64448529 C37.7196601,5.64448529 36.8551373,6.52561765 36.8551373,7.65069118 C36.8551373,8.77576471 37.7196601,9.65689706 38.8231895,9.65689706 C39.926719,9.65689706 40.7912418,8.77576471 40.7912418,7.65069118 C40.7912418,6.54435294 39.9082353,5.64448529 38.8231895,5.64448529"></path>
								<path id="Fill-7" fill="#000000" d="M38.8231895,15.90875 C37.7196601,15.90875 36.8551373,16.7898824 36.8551373,17.9145735 C36.8551373,19.0396471 37.7196601,19.9207794 38.8231895,19.9207794 C39.926719,19.9207794 40.7912418,19.0396471 40.7912418,17.9145735 C40.7912418,16.8086176 39.9082353,15.90875 38.8231895,15.90875"></path>
								<mask id="mask-2" fill="white">
									<use xlink:href="#path-2"></use>
								</mask>
								<polygon fill="#000000" points="15.2233987 19.8815882 18.8569935 19.8815882 18.8569935 5.68367647 15.2233987 5.68367647"></polygon>
								<polygon fill="#000000" points="33.8821961 5.68367647 29.6589542 5.68367647 27.2582745 9.67467647 24.8835817 5.68367647 20.6607059 5.68367647 24.7633464 12.6585588 20.5020392 19.8815882 24.7254641 19.8815882 27.2582745 15.5621471 29.8170719 19.8815882 34.0406797 19.8815882 29.7526536 12.6585588"></polygon>
								<path fill="#000000" d="M63.3658301,5.38008824 C61.5806013,5.38008824 60.5702222,6.25797059 60.058719,6.93014706 L60.058719,0.358647059 L56.4514771,0.358647059 L56.4514771,19.8815882 L60.058719,19.8815882 L60.058719,12.3826912 C60.058719,10.3367206 60.9312941,9.06597059 62.3356863,9.06597059 C63.8248105,9.06597059 64.1373856,10.3745735 64.1373856,11.4723088 L64.1373856,19.8815882 L67.7975163,19.8815882 L67.7975163,10.6995735 C67.7973333,7.31919118 66.1819346,5.38008824 63.3658301,5.38008824"></path>
								<polygon fill="#000000" points="71.1575163 19.8815882 74.7911111 19.8815882 74.7911111 5.68367647 71.1575163 5.68367647"></polygon>
								<path fill="#000000" d="M81.5744314,7.64782353 L81.2960784,5.68386765 L78.1511111,5.68386765 L78.1511111,19.8817794 L81.7850719,19.8817794 L81.7850719,12.6631471 C81.8328366,11.5120735 82.0517124,10.5768382 82.8289412,9.95475 C83.5437647,9.38236765 84.2988497,9.14875 85.4355033,9.14875 L85.5356078,9.14875 L85.5356078,5.68367647 L85.4355033,5.68367647 C83.6017778,5.68367647 82.2160523,6.30652941 81.5744314,7.64782353"></path>
								<polygon fill="#000000" points="107.949516 5.68367647 105.310379 14.3464559 105.14366 15.1119265 104.975111 14.3378529 102.337987 5.68367647 98.4249412 5.68367647 103.215137 19.6124118 101.146797 25.8136029 104.92332 25.8136029 111.889647 5.68367647"></polygon>
								<path fill="#000000" d="M96.4382222,16.3503676 L96.3538562,16.3757941 C96.0335948,16.4713824 95.6637386,16.5646765 94.9816732,16.5646765 C93.7531503,16.5646765 93.3386405,16.0829118 93.3386405,14.6563529 L93.3472418,9.14855882 L96.4384052,9.14855882 L96.4384052,5.68367647 L93.3472418,5.68367647 L93.3472418,2.29010294 L89.7138301,2.29010294 L89.7138301,5.68367647 L87.5221438,5.68367647 L87.5221438,9.14855882 L89.7138301,9.14855882 L89.7046797,15.5095735 C89.6922353,17.0378382 90.0276863,18.1409265 90.7306144,18.8817353 C91.4635556,19.6538971 92.6036863,20.0295588 94.2157908,20.0295588 C95.3806275,20.0295588 96.0555556,19.8611324 96.4166275,19.7196618 L96.4382222,19.7110588 L96.4382222,16.3503676 Z"></path>
								<path fill="#000000" d="M7.46355556,8.20051471 C5.15419608,7.34920588 4.28162092,6.89917647 4.28162092,5.53991176 C4.28162092,4.29133824 5.00577778,3.575 6.26815686,3.575 C7.48258824,3.575 8.27775163,4.38119118 8.39267974,5.68367647 L12.2705882,5.68367647 C12.0535425,2.01882353 9.95884967,0 6.34739869,0 C2.74070588,0 0.410300654,2.30444118 0.410300654,5.87102941 C0.410300654,8.84707353 1.9684183,10.5867794 5.78776471,11.8747353 C8.12530719,12.6885735 8.99440523,13.4318676 8.99440523,14.6175441 C8.99440523,15.8781618 8.07992157,16.6927647 6.66436601,16.6927647 C4.94575163,16.6927647 4.0151634,15.8015 3.87937255,14.0600735 L0,14.0600735 C0.18648366,17.9321618 2.64261438,20.2404265 6.61166013,20.2404265 C10.3523137,20.2404265 12.8657255,17.8476618 12.8657255,14.2862353 C12.8657255,11.2694706 11.3507974,9.56302941 7.46355556,8.20051471"></path>
								<polygon fill="#000000" points="54.4649412 0.365720588 41.2330196 0.365720588 41.2330196 4.10647059 45.9395817 4.10647059 45.9395817 19.8815882 49.7581961 19.8815882 49.7581961 4.10647059 54.4649412 4.10647059"></polygon>
							</g>
						</svg>
					</a>
					<div class="mobile-menu-btn">
						<div class="bar"></div>
					</div>
					<div class="mobile-menu-overlay">
						<!-- <div class="menu-overlay-close-button">
							<svg viewBox="873 40 33 33" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Group-12" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(874.000000, 42.000000)" stroke-linecap="square"><path d="M0.956238678,0.315217391 L27.6068848,28.5830305" id="Line" stroke="#393939" stroke-width="2"></path><path d="M0.659054487,28.8982479 L27.3097007,0.630434783" id="Line-Copy" stroke="#393939" stroke-width="2"></path></g></svg>
						</div> -->
						<?php wp_nav_menu( array( 'theme_location' => 'language-menu', 'menu_class' => 'overthrow nano-content', 'container_class' => 'nano-disabled' ) ); ?>
					</div>
					<div class="expendable-border header-nav--wrapper language-menu">
						<?php wp_nav_menu( array( 'theme_location' => 'language-menu', 'menu_class' => 'overthrow nano-content', 'container_class' => 'nano-disabled' ) ); ?>
					</div>
				</div>
			</nav>
		</div>
		<script type="text/javascript">require('modules/header-controller')</script>

		<div class="ajax-response"></div>
		<div class="main-wrapper">
