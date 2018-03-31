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
						<svg width="112.5px" height="25px" viewBox="427 298 320 71" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			        <defs>
			          <polygon id="path-1" points="0 70.2618778 319.684706 70.2618778 319.684706 0 0 0"></polygon>
			        </defs>
			        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(427.000000, 298.000000)">
			          <path fill="#FFFFFF" d="M48.6866928,0.0237285068 C45.5337516,0.0237285068 43.0636863,2.42259729 43.0636863,5.48440724 C43.0636863,8.54621719 45.5337516,10.945086 48.6866928,10.945086 C51.839634,10.945086 54.3096993,8.54621719 54.3096993,5.48440724 C54.3096993,2.47359276 51.7873464,0.0237285068 48.6866928,0.0237285068 L48.6866928,0.0237285068 Z"></path>
			          <path fill="#FFFFFF" d="M208.497987,0.0237285068 C205.345046,0.0237285068 202.87498,2.42259729 202.87498,5.48440724 C202.87498,8.54621719 205.345046,10.945086 208.497987,10.945086 C211.650928,10.945086 214.120993,8.54621719 214.120993,5.48440724 C214.120993,2.47359276 211.598641,0.0237285068 208.497987,0.0237285068"></path>
			          <path id="Fill-5" fill="#FFFFFF" d="M110.92319,15.3634796 C107.770248,15.3634796 105.300183,17.7618281 105.300183,20.8241584 C105.300183,23.8859683 107.770248,26.2848371 110.92319,26.2848371 C114.076131,26.2848371 116.546196,23.8859683 116.546196,20.8241584 C116.546196,17.8128235 114.023843,15.3634796 110.92319,15.3634796"></path>
			          <path id="Fill-7" fill="#FFFFFF" d="M110.92319,43.3016629 C107.770248,43.3016629 105.300183,45.7000113 105.300183,48.7613009 C105.300183,51.8236312 107.770248,54.2219796 110.92319,54.2219796 C114.076131,54.2219796 116.546196,51.8236312 116.546196,48.7613009 C116.546196,45.7510068 114.023843,43.3016629 110.92319,43.3016629"></path>
			          <mask id="mask-1" fill="white">
			              <use xlink:href="#path-1"></use>
			          </mask>
			          <polygon fill="#FFFFFF" points="43.4959477 54.1155656 53.8776471 54.1155656 53.8776471 15.470362 43.4959477 15.470362"></polygon>
			          <polygon fill="#FFFFFF" points="96.8060654 15.470414 84.7396601 15.470414 77.881098 26.333491 71.0962614 15.470414 59.0303791 15.470414 70.752732 34.4553009 58.5770458 54.1156176 70.6444967 54.1156176 77.881098 42.3585588 85.1914248 54.1156176 97.2593987 54.1156176 85.0073725 34.4553009"></polygon>
			          <path fill="#FFFFFF" d="M171.596078,18.8627059 L171.596078,0.975782805 L161.289673,0.975782805 L161.289673,54.1156697 L171.596078,54.1156697 L171.596078,33.7039502 C171.596078,28.1350362 174.088627,24.67619 178.101699,24.67619 C182.35634,24.67619 183.249412,28.2380679 183.249412,31.2259864 L183.249412,54.1156697 L193.706928,54.1156697 L193.706928,29.1232036 C193.706928,19.9216425 189.091503,14.6441312 181.044967,14.6441312 C175.944314,14.6441312 173.057516,17.0336335 171.596078,18.8627059 Z"></path>
			          <polygon fill="#FFFFFF" points="203.30719 54.1155656 213.688889 54.1155656 213.688889 15.470362 203.30719 15.470362"></polygon>
			          <path fill="#FFFFFF" d="M233.069595,20.8163529 L232.274301,15.4706742 L223.289203,15.4706742 L223.289203,54.1153575 L233.671425,54.1153575 L233.671425,34.4675294 C233.807895,31.3344299 234.433255,28.788819 236.653908,27.0950407 C238.696784,25.5370769 240.85417,24.9011946 244.101752,24.9011946 L244.387765,24.9011946 L244.387765,15.4706742 L244.101752,15.4706742 C238.862013,15.4706742 234.90332,17.1654932 233.069595,20.8163529"></path>
			          <polygon fill="#FFFFFF" points="308.427033 15.470414 300.886641 39.0495769 300.410301 41.132586 299.928732 39.0261606 292.394092 15.470414 281.213961 15.470414 294.900758 53.3824276 288.990693 70.2619299 299.781281 70.2619299 319.684549 15.470414"></polygon>
			          <path fill="#FFFFFF" d="M275.537935,44.5039593 L275.296889,44.5731674 C274.381856,44.8333484 273.325124,45.0872851 271.376366,45.0872851 C267.866301,45.0872851 266.681464,43.7764932 266.681464,39.8930317 L266.706039,24.9014027 L275.537935,24.9014027 L275.537935,15.470362 L266.706039,15.470362 L266.706039,6.23289593 L256.324863,6.23289593 L256.324863,15.470362 L250.062902,15.470362 L250.062902,24.9014027 L256.324863,24.9014027 L256.298719,42.2154072 C256.263163,46.375181 257.221595,49.3771493 259.229961,51.393552 C261.324078,53.4952941 264.582118,54.5178054 269.187608,54.5178054 C272.516235,54.5178054 274.444078,54.0593665 275.476235,53.6742986 L275.537935,53.6508824 L275.537935,44.5039593 Z"></path>
			          <path fill="#FFFFFF"d="M21.324549,22.3207715 C14.7263791,20.0035995 12.2333072,18.7786674 12.2333072,15.079414 C12.2333072,11.6809299 14.3023268,9.73113348 17.9096471,9.73113348 C21.379451,9.73113348 23.6508235,11.9249796 23.9797124,15.4702059 L35.059451,15.4702059 C34.4387974,5.49486652 28.4539608,-0.000156108597 18.1355294,-0.000156108597 C7.83069281,-0.000156108597 1.17186928,6.27228733 1.17186928,15.9801606 C1.17186928,24.0811561 5.62415686,28.8159299 16.5360523,32.3216086 C23.2147451,34.5367896 25.6984052,36.5604774 25.6984052,39.7872421 C25.6984052,43.218509 23.0855948,45.4357715 19.0411503,45.4357715 C14.1308235,45.4357715 11.472,43.0098439 11.0835033,38.2698665 L0.000104575163,38.2698665 C0.532915033,48.8092783 7.55043137,55.092129 18.8905621,55.092129 C29.5781438,55.092129 36.7593203,48.5792783 36.7593203,38.8859751 C36.7593203,30.6741425 32.4309542,26.0293914 21.324549,22.3207715"></path>
			          <polygon fill="#FFFFFF" points="155.614013 0.995556561 117.808523 0.995556561 117.808523 11.1774796 131.256366 11.1774796 131.256366 54.1156697 142.16617 54.1156697 142.16617 11.1774796 155.614013 11.1774796"></polygon>
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
