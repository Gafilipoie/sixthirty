<?php
	$args = array( 'post_type' => 'projects', 'posts_per_page' => -1);
	$loop = new WP_Query( $args );
?>

<section class="projects-page content-maxwidth">
	<div>
		<?php wp_reset_query();
		if ($loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); $id = get_the_ID();?>
		<div class="single-project" data-type="<?php the_field('type'); ?>">
			<div class="single-project--tumbnail" style="background-image: url(<?php get_field('projects_thumbnail_image') ? the_field('projects_thumbnail_image') : the_field('main_image'); ?>)"></div>
			<div class="single-project--info">
				<p class="single-project--name"><?php echo get_the_title(); ?></p>

				<!-- Confidential  -->
				<?php if (get_field('type') == 'Confidential') {  ?>
				<p class="single-project--description"><?php the_field('type'); ?></p>
				<?php } ?>

				<!-- Public  -->
				<?php if (get_field('type') == 'Public') {  ?>
				<p class="single-project-tags"> <?php $categories = get_the_category($id); foreach ($categories as &$value) { echo '<span class="single-project--test">'.$value->name.'</span>'; } ?></p>
				<?php } ?>

				<div class="single-project--confidential" data-password="<?php the_field('password'); ?>" data-link="<?php the_permalink(); ?>">
					<input type='password' class="password-input" placeholder='Enter password'>
					<p class="form-error-message">That doesn't look right!</p>
					<p class="mail-request"><a href="mailto:hello@sixthirty.pm">Get in touch</a> to request access</p>
				</div>
			</div>
		</div>
		 <?php endwhile; endif;?>
	</div>
</section>
<?php include 'bottomsection.php'; ?>
