<?php get_header(); ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article class="homepage--main-wrapper" style="margin-top: 0">
    <?php while (have_rows('section_1')) : the_row(); ?>
        <section class="content-maxwidth">
            <div class="homepage-heading-quote col-5">
                <?php if(get_sub_field('title')) : ?>
                    <div class="heading--title-wrapper">
                        <h2 class="heading-title section-title"><?php the_sub_field('title'); ?></h2>
                    </div>
                <?php endif; ?>
                <div class="heading--desc-wrapper">
                    <div class="heading-desc">
                        <?php the_sub_field('content'); ?>
                    </div>
                </div>
            </div><!--

            --><?php if(have_rows('read_more_link')) : while (have_rows('read_more_link')) : the_row(); ?><!--
                 --><div class="homepage--bottom-section col-3 marL">
                    <a href="<?php the_sub_field('url'); ?>"><?php the_sub_field('label'); ?></a>
                    <span class="link-arrow--decoration">
                        <svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.0" id="Layer_1" x="0px" y="0px" width="12.18px" height="16.77px" viewBox="0 0 12.18 16.77" enable-background="new 0 0 12.18 16.77" xml:space="preserve">
                        <text transform="matrix(1 0 0 1 0 12.5996)" fill="#010101" font-family="'Theinhardt-Lt'" font-size="15">→</text>
                        </svg>
                    </span>
                </div>
            <?php endwhile; endif; ?>

        </section>
    <?php endwhile; ?>
</article>
<?php endwhile; endif; ?>

<?php include 'bottomsection.php'; ?>
<?php get_footer(); ?>


<script type="text/javascript">require('modules/contact-skin')</script>
<script type="text/javascript">require('modules/homepage-skin')</script>
<script type="text/javascript">
    window.siteURL = "<?php echo site_url(); ?>";
</script>
