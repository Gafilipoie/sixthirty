<?php
// Template name: Press
get_header();
if (have_posts()) : while (have_posts()) : the_post(); endwhile; endif;
$newsArgs = array( 'post_type' => 'projectsnews', 'posts_per_page' => -1);
$newsLoop = new WP_Query( $newsArgs );
?>

<article class="press-page loading">
  <div class="container-maxwidth">
    <div class="content-maxwidth">
      <!-- Description Header -->
      <div class="press-description">
        <p class="text-anim">For press enquiries; <a href="mailto:hello@sixthirty.pm">get in touch</a>, or  download media assets below.</p>
      </div>

      <!-- Press -->
      <div class="press-module">
        <div class="press-header">
          <p class="press-header__title">Press</p>
        </div>
        <div class="press-body">
          <?php while (have_rows('press')) : the_row(); ?>
          <p class="press-body__copy">
            <a href="<?php echo the_sub_field('press_link')?>" target="_blank">
              <?php the_sub_field('press_news')?>
            </a>
          </p>
          <?php endwhile; ?>
        </div>
      </div>

      <!-- Talks -->
      <div class="press-module">
        <div class="press-header">
          <p class="press-header__title">Talks</p>
        </div>
        <div class="press-body">
          <?php while (have_rows('talk')) : the_row(); ?>
          <p class="press-body__copy">
            <a href="<?php echo the_sub_field('talk_link')?>" target="_blank">
              <?php the_sub_field('talk_news')?>
            </a>
          </p>
          <?php endwhile; ?>
        </div>
      </div>

      <!-- Media Assets -->
      <div class="press-module">
        <div class="press-header press-header--media">
          <p class="press-header__title">Media Assets</p>
        </div>
        <div class="press-body press-body--media">
          <div class="press-body__download">
            <a href="<?php echo the_field('media_asset_download_url')?>" target="_blank">
              <svg width="56px" height="56px" viewBox="603 949 56 56" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <circle stroke="#979797" stroke-width="1" fill="none" cx="631" cy="977" r="27"></circle>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(621.000000, 968.000000)">
                  <polygon fill="#000000" points="9.641376 0.0817854545 9.641376 16.5786218 0.600256 7.33202182 0.113216 7.83029455 9.991616 17.93304 19.870016 7.83029455 19.382816 7.33202182 10.330336 16.59024 10.330336 0.0817854545"></polygon>
                  <polygon stroke="#9B9B9B" points="19.382832 7.33208727 10.330192 16.5903055 10.330192 0.0818509091 9.641392 0.0818509091 9.641392 16.5785236 0.600272 7.33208727 0.113072 7.83019636 9.991632 17.9331055 19.870032 7.83019636"></polygon>
                </g>
              </svg>
              <span>Download</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- News Sliders -->
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
        <div class="second-slider__slick__image" style="background-image:url('<?php echo $thumb_url; ?>')"></div>
        <?php endwhile; endif;?>
      </div>
    </div>
  </div>
</article>

<?php include 'bottomsection.php'; ?>
<?php get_footer(); ?>
<script type="text/javascript">
	window.siteUrl = "<?php echo site_url(); ?>";
	require('modules/press-skin');
</script>
<script type="text/javascript">require('modules/lazy-load')</script>
<script type="text/javascript">require('modules/back-to-top')</script>
