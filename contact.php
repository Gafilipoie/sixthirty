<?php // Template name: Contact ?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article class="structured-line-page contact-page">

	<?php if(get_field('widget')) : ?>
		<div class="widget-wrapper"><?php the_field('widget'); ?></div>
	<?php endif; ?>


	<section class="footer-details">
		<!-- Enquires -->
		<?php while (have_rows('section_2')) : the_row(); ?>
			<div class="content-maxwidth content-wrap">
				<div class="col-2 content-col content-title-col content-title" data-expanded="false"><?php the_sub_field('label'); ?></div><!--
				--><?php if(have_rows('enquires')) : while(have_rows('enquires')) : the_row() ; ?><!--
					 --><div class="expand-element content-detail-col col-2 content-col">
					 		<div class="inline">
								<div class="content-title"><?php the_sub_field('title'); ?></div>
								<?php if(have_rows('link')) : while(have_rows('link')) : the_row() ; ?>
									<div class="content-wrap-detail">
										<?php if(get_sub_field('url')) : ?>
											<a <?php if(get_sub_field('target')){ ?>target="_blank"<?php } ?> href="<?php the_sub_field('url'); ?>" class="content-wrap-contact"><?php the_sub_field('label'); ?></a>
										<?php else : ?>
											<p><?php the_sub_field('label'); ?></p>
										<?php endif; ?>
									</div>
								<?php endwhile; endif; ?>
							</div>
						</div><!--
				--><?php endwhile; endif; ?>
			</div>
		<?php endwhile; ?>

	</section>

</article>

<?php endwhile; endif; ?>

<?php include 'bottomsection.php'; ?>



<script type="text/javascript">require('modules/contact-skin')</script>
<script type="text/javascript">require('modules/structured-page')</script>
<script type="text/javascript">require('modules/back-to-top')</script>
