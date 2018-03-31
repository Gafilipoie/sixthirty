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
      <a class="projects-overlay">See more work</a>
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
