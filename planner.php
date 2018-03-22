<?php // Template name: Planner ?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article class="structured-line-page about-page planner-page slide-in-page loading">

	<div class="content-maxwidth">
		<!-- Our story -->
		<section class="content-head-info">
			<?php while (have_rows('section_1')) : the_row(); ?>
				<div class="col-2 content-col content-title-col">
					<div class="content-title"><?php the_sub_field('title'); ?></div>
					<div class="content-wrap-detail" ><?php the_sub_field('description'); ?></div>
				</div><!--
			 --><div class="content-col marL col-6">
			 		<div class="content-details">
			 			<?php the_sub_field('content'); ?>
					</div>
					<div class="form-wrapper">
						<form>
							<div class="input-wrapper">
								<input type="text" placeholder="Name *" class="input required name" />
							</div><!--
							 --><div class="input-wrapper">
								<input type="text" placeholder="Email address *" class="input email required" />
							</div>
							<div class="input-wrapper company-wrapper">
								<input class="input company" placeholder="Leave this blank" />
							</div>
							<div class="input-wrapper">
								<textarea class="input textarea about required" placeholder="Tell us about your project *"></textarea>
							</div>
							<div class="input-wrapper">
								<select class="select budget required">
									<option value="" disabled selected>What is your budget? *</option>
									<option value="5,000 EUR - 10,000 EUR">5,000 EUR - 10,000 EUR</option>
									<option value="10,000 EUR - 25,000 EUR">10,000 EUR - 25,000 EUR</option>
									<option value="25,000 EUR - 50,000 EUR">25,000 EUR - 50,000 EUR</option>
									<option value="50,000+ EUR">50,000+ EUR</option>
								</select>
							</div>
							<div class="input-wrapper">
								<select class="select deadline required">
									<option value="" disabled selected>When do you want to finish? *</option>
									<option value="Under 2 months">Under 2 months</option>
									<option value="2-3 months">2-3 months</option>
									<option value="3-6 months">3-6 months</option>
									<option value="6 months+">6 months+</option>
								</select>
							</div>
							<div class="input-wrapper">
								<button>Submit</button>
							</div>
						</form>
						<div class="thank-you--message">
							<div class="wrap">
								Message on it's way, we'll get back to you in no-time!
								<span>Team Vuzum</span>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>

		</section>

	</div>

</article>
<?php endwhile; endif; ?>

<?php include 'bottomsection.php'; ?>

<script type="text/javascript">
	window.ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
	require('modules/planner-skin');
</script>
<script type="text/javascript">require('modules/lazy-load')</script>
<script type="text/javascript">require('modules/back-to-top')</script>
