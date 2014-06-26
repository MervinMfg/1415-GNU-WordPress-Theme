<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>

			<section class="featured-slider">
				<h2>Featured Slider</h2>
			</section>
			<section class="social-slider">
				<h2>Social Slider</h2>
			</section>

			<?php include get_template_directory() . '/_/inc/modules/featured-posts.php'; ?>

			<?php include get_template_directory() . '/_/inc/modules/photo-slider.php'; ?>

			<section class="featured-products">
				<h2>Featured Products</h2>
			</section>

			<?php include get_template_directory() . '/_/inc/modules/follow.php'; ?>

<?php get_footer(); ?>