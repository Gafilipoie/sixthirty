<?php
// Template name: About
get_header();
if (have_posts()) : while (have_posts()) : the_post(); endwhile;
if (have_rows('header_video')) : while (have_rows('header_video')) : $rowHeaderVideo = the_row(); endwhile; endif;
if (have_rows('bottom_video')) : while (have_rows('bottom_video')) : $rowBottomVideo = the_row(); endwhile; endif;
require_once 'functions/Mobile_Detect.php';
$detect = new Mobile_Detect;
$isMobile = false;
if($detect->isMobile()) : $isMobile = true; endif;
if($detect->isTablet()) : $isMobile = true; endif;
?>

<article class="structured-line-page about-page loading">
  <div class="container-maxwidth">
    <div class="content-maxwidth">
      <!-- Description Header -->
      <section class="about-description">
        <p class="text-anim">
          <?php the_field('description_header') ?>
        </p>
      </section>

      <!-- Image/Video -->
      <section class="container container-video text-anim">
        <div class="about-image_video">
          <?php if (!$isMobile) { ?>
          <video class="video" preload="auto"  loop="loop" muted>
            <source src="<?php echo $rowHeaderVideo['video']; ?>" type="video/mp4">
          </video>
          <?php } ?>
          <div class="about-video-img" style="background-image:url('<?php echo $rowHeaderVideo['image']; ?>');"></div>
        </div>
      </section>

      <!-- About Us -->
      <?php while (have_rows('about_us')) : the_row(); ?>
      <section class="about-section">
        <div class="col-9 content-col content-title-col">
          <div class="content-title text-anim"><?php the_sub_field('title'); ?></div>
        </div>
        <div class="content-col col-10">
          <div class="about-content-details text-anim">
            <?php the_sub_field('content'); ?>
          </div>
        </div>
      </section>

      <!-- Two image -->
      <?php while (have_rows('two_images_module')) : the_row(); ?>
      <section class="two-images" style="<?php if(!get_sub_field('first_image') && !get_sub_field('second_image')){ ?>display:none;<?php }?>">
        <div class="two-images--dimensions text-anim">
          <div class="two-images__container" style="background-image: url(<?php the_sub_field('first_image') ?>);">
            <img src="<?php the_sub_field('first_image') ?>">
          </div><!--
          --><div class="two-images__container" style="background-image: url(<?php the_sub_field('second_image') ?>);">
            <img src="<?php the_sub_field('second_image') ?>">
          </div>
        </div>
      </section>
      <?php endwhile; ?>
    </div>
  </div>

  <!-- Branding -->
  <?php while (have_rows('first_info_module')) : the_row(); ?>
  <section class="info-module">
    <div class="content-maxwidth">
      <div class="info-header">
        <p class="info-header__title"><?php the_sub_field('title')?></p>
      </div>
      <?php while (have_rows('columns')) : the_row(); ?>
      <div class="info-body">
        <div class="info-body__col">
          <p class="info-body__col__title">1.</p>
          <p class="info-body__col__subtitle"><?php the_sub_field('1st_title')?></p>
          <p class="info-body__col__description"><?php the_sub_field('1st_content')?></p>
        </div>
        <div class="info-body__col">
          <p class="info-body__col__title">2.</p>
          <p class="info-body__col__subtitle"><?php the_sub_field('2nd_title')?></p>
          <p class="info-body__col__description"><?php the_sub_field('2nd_content')?></p>
        </div>
        <div class="info-body__col">
          <p class="info-body__col__title">3.</p>
          <p class="info-body__col__subtitle"><?php the_sub_field('3rd_title')?></p>
          <p class="info-body__col__description"><?php the_sub_field('3rd_content')?></p>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </section>
  <?php endwhile; ?>

  <!-- First Image -->
  <section class="text-anim">
    <div class="about-image_video">
      <div class="fullwidth-image__mobile" style="background-image:url(<?php the_field('first_image') ?>)"></div>
      <img src="<?php the_field('first_image') ?>"/>
    </div>
  </section>

  <!-- User Experience -->
  <?php while (have_rows('second_info_module')) : the_row(); ?>
  <section class="info-module">
    <div class="content-maxwidth">
      <div class="info-header">
        <p class="info-header__title"><?php the_sub_field('title')?></p>
      </div>
      <?php while (have_rows('columns')) : the_row(); ?>
      <div class="info-body">
        <div class="info-body__col">
          <p class="info-body__col__title">1.</p>
          <p class="info-body__col__subtitle"><?php the_sub_field('1st_title')?></p>
          <p class="info-body__col__description"><?php the_sub_field('1st_content')?></p>
        </div>
        <div class="info-body__col">
          <p class="info-body__col__title">2.</p>
          <p class="info-body__col__subtitle"><?php the_sub_field('2nd_title')?></p>
          <p class="info-body__col__description"><?php the_sub_field('2nd_content')?></p>
        </div>
        <div class="info-body__col">
          <p class="info-body__col__title">3.</p>
          <p class="info-body__col__subtitle"><?php the_sub_field('3rd_title')?></p>
          <p class="info-body__col__description"><?php the_sub_field('3rd_content')?></p>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </section>
  <?php endwhile; ?>

  <!-- Second Image -->
  <section class="text-anim">
    <div class="about-image_video">
      <div class="fullwidth-image__mobile" style="background-image:url(<?php the_field('second_image') ?>)"></div>
      <img src="<?php the_field('second_image') ?>"/>
    </div>
  </section>

  <div class="container-maxwidth">
    <div class="content-maxwidth">
      <!-- Services -->
      <section class="services-section">
        <div class="col-9 content-col content-title-col text-anim">
          <?php while (have_rows('section_4')) : the_row(); ?>
            <div class="content-title text-anim"><?php the_sub_field('title') ?></div>
          <?php endwhile; ?>
          <div class="content-wrap-detail" ></div>
        </div><!--
        --><div class="content-col col-10">
          <div class="services-list text-anim">
            <?php while (have_rows('section_4')) : the_row(); ?>
              <div class="col-one">
                <?php
                  $i = 0;
                  while (have_rows('services')) : the_row();
                    if ($i % 2 == 0) {
                ?>
                    <div class="services-list-content">
                      <ul>
                        <?php while (have_rows('description')) : the_row(); ?>
                        <li><span class="text-anim" href="#"><?php the_sub_field('services') ?></span></li>
                        <?php endwhile; ?>
                      </ul>
                    </div>
                <?php }; $i++; endwhile; ?>
              </div>
              <div class="col-two">
                <?php
                  $i = 0;
                  while (have_rows('services')) : the_row();
                    if ($i % 2 == 1) {
                ?>
                    <div class="services-list-content">
                      <ul>
                        <?php while (have_rows('description')) : the_row(); ?>
                        <li><span class="text-anim" href="#"><?php the_sub_field('services') ?></span></li>
                        <?php endwhile; ?>
                      </ul>
                    </div>
                <?php }; $i++; endwhile; ?>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      </section>

      <!-- Founders -->
      <section class="founders-section">
        <div class="col-9 content-col content-title-col text-anim">
          <div class="content-title text-anim ">Founders</div>
          <div class="content-wrap-detail" ></div>
        </div>
        <div class="content-col">
          <div class="founders">
            <?php while (have_rows('founders')) : the_row(); ?>
              <div class="founders-description text-anim">
                <div class="founders-image" style="background-image: url(<?php the_sub_field('image') ?>);">
                  <img src="<?php the_sub_field('image') ?>"/>
                </div>
                <p class="text-anim"><?php the_sub_field('name') ?></p>
                <p class="text-anim"><?php the_sub_field('description') ?></p>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      </section>
    </div>

    <!-- Contact -->
    <section class="text-anim contact-border contact-section container container-video container-video--overlay" id="contact">
      <div class="video-overlay"></div>
      <?php if (!$isMobile) { ?>
      <video class='video' id="video2" preload="auto"  loop="loop" muted>
        <source src="<?php echo $rowBottomVideo['video']; ?>" type="video/mp4"/>
      </video>
      <?php } ?>
      <div class="video-img" style="background-image:url('<?php echo $rowBottomVideo['image']; ?>');"></div>
      <div class="overlay">
        <div class="contact-information content-maxwidth ">
          <?php if (have_rows('description_bottom_video')) : the_row(); ?>
            <div class="col-9 content-col content-title-col">
            <div class="content-title"><?php the_sub_field('say_hello') ?></div>
            <div class="content-wrap-detail" ></div>
            </div>
            <div class="content-col col-10 contacts-info">
              <ul>
                <div class="contact-info--padings">
                  <li><a href="mailto:<?php the_sub_field('mail') ?>"><span><?php the_sub_field('mail') ?></a></li>
                  <li><a href="tel:<?php the_sub_field('telephone') ?>"><?php the_sub_field('telephone') ?></a></li>
                </div>
                <div class="contact-info--padings">
                  <li><?php the_sub_field('address1') ?><br> <?php the_sub_field('address2') ?></li>
                </div>
                <li><a href="https://www.google.co.uk/maps/place/Six+Thirty/@51.5369533,-0.0813707,17z/data=!3m1!4b1!4m5!3m4!1s0x48761c96356bb24d:0xae8cb4dc2b1513e1!8m2!3d51.53695!4d-0.079182" target="_blank">View Map</a></li>
              </ul>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </div>

  <!-- Twitter -->
  <section class="twitter-section content-maxwidth text-anim">
    <div class="twitter">
      <div class="col-9 content-col content-title-col">
        <div class="twitter-link">
          <a class="double-expand-border" href="<?php the_field('twitter') ?>">Follow us on twitter</a>
          <!-- <a class="double-expand-border" href="#">Follow us on twitter</a> -->
        </div>
      </div>
      <div class="content-col col-10">
        <div id="example1"></div>
      </div>
    </div>
  </section>

  <!-- Instagram -->
  <div class="instagram-section content-maxwidth text-anim instagram-small-device">
    <div id="instafeed"></div>
    <!-- <div class="slick-bittons">
      <div type="button" class="prev-arrow"><svg width="26px" height="17px" viewBox="97 4664 26 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs></defs><path d="M112.11005,4665.12793 L120.246231,4671.62827 L97.6457286,4671.62827 C97.30134,4671.62827 97,4671.92961 97,4672.274 C97,4672.61838 97.30134,4672.91972 97.6457286,4672.91972 L120.28928,4672.91972 L112.153099,4679.42006 C111.894807,4679.6353 111.851759,4680.02274 112.067002,4680.32408 C112.282245,4680.58237 112.669682,4680.62542 112.971022,4680.41018 L122.527806,4672.74753 C122.570854,4672.70448 122.613903,4672.70448 122.613903,4672.66143 C122.656951,4672.61838 122.656951,4672.61838 122.656951,4672.57534 C122.656951,4672.48924 122.7,4672.48924 122.7,4672.44619 L122.7,4672.274 L122.7,4672.14485 L122.7,4672.05875 C122.7,4672.0157 122.656951,4671.97266 122.613903,4671.92961 C122.570854,4671.88656 122.527806,4671.84351 122.527806,4671.80046 L112.927973,4664.13782 C112.669682,4663.92257 112.282245,4663.96562 112.023953,4664.22391 C111.80871,4664.4822 111.851759,4664.91269 112.11005,4665.12793 Z" id="Shape" stroke="none" transform="translate(109.850000, 4672.273996) rotate(-180.000000) translate(-109.850000, -4672.273996) "></path></svg>Previous</div>
      <div type="button" class="next-arrow">Next<svg class="test" width="26px" height="18px" viewBox="296 4663 26 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs></defs><path d="M311.11005,4665.07408 L319.246231,4671.57441 L296.645729,4671.57441 C296.30134,4671.57441 296,4671.87575 296,4672.22014 C296,4672.56453 296.30134,4672.86587 296.645729,4672.86587 L319.28928,4672.86587 L311.153099,4679.3662 C310.894807,4679.58145 310.851759,4679.96888 311.067002,4680.27022 C311.282245,4680.52851 311.669682,4680.57156 311.971022,4680.35632 L321.527806,4672.69367 C321.570854,4672.65062 321.613903,4672.65062 321.613903,4672.60758 C321.656951,4672.56453 321.656951,4672.56453 321.656951,4672.52148 C321.656951,4672.43538 321.7,4672.43538 321.7,4672.39233 L321.7,4672.22014 L321.7,4672.09099 L321.7,4672.0049 C321.7,4671.96185 321.656951,4671.9188 321.613903,4671.87575 C321.570854,4671.8327 321.527806,4671.78965 321.527806,4671.7466 L311.927973,4664.08396 C311.669682,4663.86872 311.282245,4663.91176 311.023953,4664.17006 C310.80871,4664.42835 310.851759,4664.85883 311.11005,4665.07408 Z" id="Shape" stroke="none"></path></svg></div>
    </div> -->
  </div>
</article>
<?php endwhile; endif; ?>

<?php include 'bottomsection.php'; ?>
<?php get_footer(); ?>
<script type="text/javascript">
  window.siteUrl = "<?php echo site_url(); ?>";
  require('modules/about-skin');
</script>
<script type="text/javascript">require('modules/lazy-load')</script>
<script type="text/javascript">require('modules/back-to-top')</script>
