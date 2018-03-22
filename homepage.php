<?php // Template name: Home ?>
<?php
  require_once 'functions/Mobile_Detect.php';
  $detect = new Mobile_Detect;
  $isMobile = false;
  if($detect->isMobile()) : $isMobile = true; endif;
  if($detect->isTablet()) : $isMobile = true; endif;
?>
<?php get_header(); ?>
<?php
$args = array( 'post_type' => 'projects', 'posts_per_page' => -1);
$loop = new WP_Query( $args );
$newsArgs = array( 'post_type' => 'projectsnews', 'posts_per_page' => -1);
$newsLoop = new WP_Query( $newsArgs );
if (have_rows('showreel')) : while (have_rows('showreel')) : $rowShowreel = the_row(); endwhile; endif;
if (have_rows('about_section')) : while (have_rows('about_section')) : $rowAboutSection = the_row(); endwhile; endif;
?>

<!--Showreel video-->
<div id="fade-wrapper">
  <?php if (!$isMobile) { ?>
  <video class="videoOv" preload="auto" loop="loop">
    <source src="<?php echo $rowShowreel['video']; ?>"/>
  </video>
  <?php } ?>
  <div class="video-img" style="background-image:url('<?php echo $rowShowreel['image']; ?>');"></div>
</div>

<div class="container-maxwidth container-maxwidth--home">

  <!-- video(with logo)-->
  <div class="homepage-video-logo container container-video container-video--overlay">
    <div class="video-overlay"></div>
    <?php if (!$isMobile) { ?>
    <video class='video video-logo' loop="loop" muted>
      <source src="<?php echo $rowShowreel['video']; ?>"/>
    </video>
    <?php } ?>
    <div class="video-img" style="background-image:url('<?php echo $rowShowreel['image']; ?>');"></div>
    <div class="showreel expendable-border" style="display:none;">
      <a>View showreel</a>
    </div>
    <div class="logo-svg">
      <svg width="363px" height="100px" viewBox="427 298 320 71" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
    </div>
  </div>

  <div class="home-content">
    <!--text-section>-->
    <div class="two-section--wrapper">
      <div class="two-section">
        <h1 class="content-maxwidth text-anim"><?php the_field('description') ?></h1>
      </div>
    </div>

    <div id="myList">
      <?php if ($loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); $id = get_the_ID();
          if (get_field('type') == 'Confidential') {  ?>
          <div class="text-anim list-porject container container-video confidential-box conf-box"
              style="<?php if (!$isMobile) { ?>
                  background-image:url(<?php the_field('banner_image_url'); ?>);
                <?php } else { ?>
                  background-image:url(<?php the_field('main_image_mobile'); ?>);
                <?php } ?>">
            <?php if (have_rows('banner_video_url')) : while (have_rows('banner_video_url')) : $rowBannerVideo = the_row(); ?>
            <?php if (!$isMobile) { ?>
            <video class='video' id="video2" loop="loop" muted>
              <source src="<?php echo $rowBannerVideo['video']; ?>"/>
            </video>
            <?php } ?>
            <div class="video-img" style="background-image:url('<?php echo $rowBannerVideo['image']; ?>');"></div>
            <?php endwhile; endif; ?>
            <img class="box-image" src="<?php the_field('banner_image_url'); ?>" alt=""/>
            <div class="confidential-project">
              <div class="overtext title1">
                <div class="third-section">
                  <div class="confidential-project-close-button confidential-hide-element">
                    <svg class="close-svg" width="31px" height="33px" viewBox="1101 318 31 33" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <defs></defs>
                      <g id="Group-Copy-2" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(1102.000000, 320.000000)" stroke-linecap="square">
                        <path d="M0.956238678,0.315217391 L27.6068848,28.5830305" id="Line" stroke="#FFFFFF" stroke-width="2"></path>
                        <path d="M0.659054487,28.8982479 L27.3097007,0.630434783" id="Line-Copy" stroke="#FFFFFF" stroke-width="2"></path>
                      </g>
                    </svg>
                  </div>
                </div>
                <div class="confidential-hide-element">
                  <div class="single-project--confidential" data-password="<?php the_field('password'); ?>" data-link="<?php the_permalink(); ?>">
                    <input class="project-input" type='password' placeholder='Enter password'>
                    <p class="form-error-message">That doesn't look right!</p>
                    <p class="mail-request"><a href="mailto:hello@sixthirty.pm">Get in touch</a> to request access</p>
                  </div>
                </div>
                <svg class="closed-svg" width="9px" height="12px" viewBox="104 473 9 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <desc>Created with Sketch.</desc>
                  <defs><polygon id="path-1" points="4.45919464 11.4221128 0 11.4221128 0 0.000639157894 4.45919464 0.000639157894 8.91838929 0.000639157894 8.91838929 11.4221128 4.45919464 11.4221128"></polygon></defs>
                  <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(104.000000, 473.000000)">
                    <mask id="mask-3" fill="white"><use xlink:href="#path-1"></use></mask>
                    <g id="Clip-2"></g>
                    <path d="M7.43146071,4.99718653 L7.43146071,2.85461811 C7.43146071,1.28173389 6.09785357,0.000639157894 4.45760357,0.000639157894 C2.82024643,0.000639157894 1.48663929,1.28173389 1.48663929,2.85461811 L1.48663929,4.99718653 C0.665067857,4.99718653 -0.000289285716,5.63634442 -0.000289285716,6.42556547 L-0.000289285716,9.99373389 C-0.000289285716,10.7829549 0.665067857,11.4221128 1.48663929,11.4221128 L7.43146071,11.4221128 C8.25303214,11.4221128 8.91838929,10.7829549 8.91838929,9.99373389 L8.91838929,6.42556547 C8.91838929,5.63634442 8.25303214,4.99718653 7.43146071,4.99718653 L7.43146071,4.99718653 Z M5.94453214,4.99718653 L2.97356786,4.99718653 L2.97356786,2.85461811 C2.97356786,2.068176 3.638925,1.42901811 4.45760357,1.42901811 C5.279175,1.42901811 5.94453214,2.068176 5.94453214,2.85461811 L5.94453214,4.99718653 Z" id="Fill-1" fill="#FEFEFE" ></path>
                  </g>
                </svg>
                <p><?php echo get_the_title(); ?></p>
                <h1><?php the_field('subtitle'); ?></h1>
                <h1><?php  the_field('type'); ?></h1>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <div class="text-anim list-porject container container-video confidential-box public-box" data-link="<?php the_permalink(); ?>"
              style="<?php if (!$isMobile) { ?>
                      background-image:url(<?php the_field('banner_image_url'); ?>);
                    <?php } else { ?>
                      background-image:url(<?php the_field('main_image_mobile'); ?>);
                    <?php } ?>">
            <?php if (!$isMobile) { ?>
              <?php if (the_field('banner_video_url')) { ?>
              <video class='video' id="video2" loop="loop" muted>
                <source src="<?php the_field('banner_video_url'); ?>"/>
              </video>
              <?php } ?>
            <?php } ?>
            <img class="box-image" src="<?php the_field('banner_image_url'); ?>" alt=""/>
            <div class="public-project">
              <div class="overtext confidential-content">
                <p><?php echo get_the_title(); ?></p>
                <h1><?php the_field('subtitle'); ?></h1>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php endwhile; endif; ?>
    </div>

    <!-- See more -->
    <div class="see-more">
      <a id="load-more">See more work</a>
    </div>

    <!-- News Sliders -->
    <div class="conteiner-maxwidth">
      <div class="two-slider-module">
        <div class="first-slider">
          <h2 class="first-slider__title">News</h2>
          <div class="first-slider__slick">
            <?php if ($newsLoop->have_posts() ) : while ( $newsLoop->have_posts() ) : $newsLoop->the_post(); $id = get_the_ID(); ?>
            <div>
              <h1><?php echo get_the_title(); ?></h1>
              <p><?php echo get_the_content(); ?></p>
            </div>
            <?php endwhile; endif;?>
          </div>
          <div class="first-slider__buttons">
            <div class="first-slider__buttons__prev" type="button"><svg width="26px" height="17px" viewBox="97 4664 26 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs></defs><path d="M112.11005,4665.12793 L120.246231,4671.62827 L97.6457286,4671.62827 C97.30134,4671.62827 97,4671.92961 97,4672.274 C97,4672.61838 97.30134,4672.91972 97.6457286,4672.91972 L120.28928,4672.91972 L112.153099,4679.42006 C111.894807,4679.6353 111.851759,4680.02274 112.067002,4680.32408 C112.282245,4680.58237 112.669682,4680.62542 112.971022,4680.41018 L122.527806,4672.74753 C122.570854,4672.70448 122.613903,4672.70448 122.613903,4672.66143 C122.656951,4672.61838 122.656951,4672.61838 122.656951,4672.57534 C122.656951,4672.48924 122.7,4672.48924 122.7,4672.44619 L122.7,4672.274 L122.7,4672.14485 L122.7,4672.05875 C122.7,4672.0157 122.656951,4671.97266 122.613903,4671.92961 C122.570854,4671.88656 122.527806,4671.84351 122.527806,4671.80046 L112.927973,4664.13782 C112.669682,4663.92257 112.282245,4663.96562 112.023953,4664.22391 C111.80871,4664.4822 111.851759,4664.91269 112.11005,4665.12793 Z" id="Shape" stroke="none" transform="translate(109.850000, 4672.273996) rotate(-180.000000) translate(-109.850000, -4672.273996) "></path></svg>Previous</div>
            <div class="first-slider__buttons__next" type="button">Next<svg width="26px" height="18px" viewBox="296 4663 26 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs></defs><path d="M311.11005,4665.07408 L319.246231,4671.57441 L296.645729,4671.57441 C296.30134,4671.57441 296,4671.87575 296,4672.22014 C296,4672.56453 296.30134,4672.86587 296.645729,4672.86587 L319.28928,4672.86587 L311.153099,4679.3662 C310.894807,4679.58145 310.851759,4679.96888 311.067002,4680.27022 C311.282245,4680.52851 311.669682,4680.57156 311.971022,4680.35632 L321.527806,4672.69367 C321.570854,4672.65062 321.613903,4672.65062 321.613903,4672.60758 C321.656951,4672.56453 321.656951,4672.56453 321.656951,4672.52148 C321.656951,4672.43538 321.7,4672.43538 321.7,4672.39233 L321.7,4672.22014 L321.7,4672.09099 L321.7,4672.0049 C321.7,4671.96185 321.656951,4671.9188 321.613903,4671.87575 C321.570854,4671.8327 321.527806,4671.78965 321.527806,4671.7466 L311.927973,4664.08396 C311.669682,4663.86872 311.282245,4663.91176 311.023953,4664.17006 C310.80871,4664.42835 310.851759,4664.85883 311.11005,4665.07408 Z" id="Shape" stroke="none"></path></svg></div>
          </div>
        </div>
        <div class="second-slider">
          <div class="second-slider__slick">
            <?php
              if ($newsLoop->have_posts() ) : while ( $newsLoop->have_posts() ) : $newsLoop->the_post(); $id = get_the_ID();
              $thumb_id = get_post_thumbnail_id();
              $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
              $thumb_url = $thumb_url_array[0];
            ?>
              <div class="second-slider__slick__image"  style="display:block; background-image:url('<?php echo $thumb_url; ?>')"></div>
            <?php endwhile; endif;?>
          </div>
        </div>
      </div>
    </div>

    <!-- about video -->
    <div class="text-anim container container-video hompage-about">
      <div class="content-maxwidth">
        <a href="/about">
          <?php if (!$isMobile) { ?>
          <video class='video' loop="loop" muted>
            <source src="<?php echo $rowAboutSection['video']; ?>"/>
          </video>
          <?php } ?>
          <div class="video-img" style="background-image:url('<?php echo $rowAboutSection['image']; ?>');"></div>
          <div class="hompage-about-overlay">
            <a href="/about">About</a>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>

<script class="paceJS" type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/pace.js"></script>
<script type="text/javascript">
     // Get saved data from sessionStorage
    var data = sessionStorage.getItem('homeCached');
    $(document).ready(function(){

        if(data){
            $('body').addClass('cached');
            $(window).trigger('slideNav');
            window.Pace.trigger('done');
        } else {
            sessionStorage.setItem('homeCached', 'true');
        }
    });

    if( data || window.isLoaded ){
        $('.paceJS').remove();
        $('.paceCSS').remove();
    }
</script>
<!-- Hotjar Tracking Code for http://sixthirty.pm -->
<script>
  (function(h,o,t,j,a,r){
  h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
  h._hjSettings={hjid:317614,hjsv:5};
  a=o.getElementsByTagName('head')[0];
  r=o.createElement('script');r.async=1;
  r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
  a.appendChild(r);
  })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<?php include 'bottomsection.php'; ?>
<?php get_footer(); ?>

<script type="text/javascript">require('modules/header-controller')</script>
<script type="text/javascript">require('modules/homepage-skin')</script>
<script type="text/javascript">require('modules/homepage-preloader')</script>
<script type="text/javascript">require('modules/homepage-slider')</script>
<script type="text/javascript">
  window.siteURL = "<?php echo site_url(); ?>";
</script>
<script type="text/javascript">
  window.siteUrl = "<?php echo site_url(); ?>";
  require('modules/about-skin');
</script>
