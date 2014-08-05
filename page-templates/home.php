	<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>

			<?php include get_template_directory() . '/_/inc/modules/featured-slider.php'; ?>

			<div class="section-spacer"></div>

			<?php include get_template_directory() . '/_/inc/modules/social-slider.php'; ?>

			<?php include get_template_directory() . '/_/inc/modules/featured-posts.php'; ?>

			<?php include get_template_directory() . '/_/inc/modules/photo-slider.php'; ?>

			<?php include get_template_directory() . '/_/inc/modules/featured-products.php'; ?>

			<?php include get_template_directory() . '/_/inc/modules/follow.php'; ?>

<?php get_footer(); ?>