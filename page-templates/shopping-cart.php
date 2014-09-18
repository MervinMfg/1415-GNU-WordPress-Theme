<?php
/*
Template Name: Shopping Cart
*/
?>
<?php
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
?>

			<section class="shopping-cart">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h1 class="title"><?php the_title(); ?></h1>
						<h5 class="subtitle">We’ll send it so you can send it</h5>
					</div>
					<div class="vibe vibe-6"></div>
				</header>
				<div class="shopping-cart-wrapper">
					<div id="shopping-cart">
						<span class="loading"></span>
					</div>

					<?php the_content(); ?>

				</div>
			</section>

<?php
	endwhile; endif;
	get_footer();
?>