<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage 1415-GNU-WordPress-Theme
 * @since 1415 GNU WordPress Theme 1.0.0
 */
 get_header(); ?>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<section class="default-section post" id="post-<?php the_ID(); ?>">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h1 class="title"><?php the_title(); ?></h1>
					</div>
					<div class="vibe vibe-3"></div>
				</header>
				<div class="default-content">
					<?php the_content(); ?>
					<div class="clearfix"></div>
				</div><!-- .content -->
			</section><!-- .default-section -->
		
			<?php comments_template(); ?>

			<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
