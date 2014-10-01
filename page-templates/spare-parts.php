<?php
/*
Template Name: Spare Parts
*/
?>
<?php get_header(); ?>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<section id="spare-parts" class="product-overview deeplink-top-fix">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title"><?php the_title(); ?></h2>
					</div>
					<div class="vibe vibe-4"></div>
				</header>
				<div class="product-filters">
					<div class="instructions"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/carousel-instructions-supplies.gif" alt="Click and Drag Supplies" class="lazy" /></div>
				</div>
				<div class="product-list owl-carousel owl-theme">
					<?php
						// Get Accessories
						$args = array(
							'post_type' => 'gnu_accessories',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_accessories_categories',
									'field' => 'slug',
									'terms' => 'binding-parts',
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$image = get_field('gnu_product_image');
							$detail = 'Accessories';
					?>

					<div class="product">
						<a href="<? the_permalink(); ?>">
							<div class="info">
								<div class="vertical-center">
									<h4 class="name"><?php the_title(); ?></h4>
									<p class="detail"><?php echo $detail; ?></p>
									<div class="price">
										<?php echo getPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_price_eur'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
									</div>
								</div>
							</div>
							<?php if($image): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-accessory.png" data-src="<?php echo $image['sizes']['medium']; ?>" data-src-retina="<?php echo $image['sizes']['large']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div><!-- .product -->

					<?
						endwhile;
						wp_reset_query();
					?>
				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section class="default-section post" id="post-<?php the_ID(); ?>">
				<div class="default-content">
					<?php the_content(); ?>
					<div class="clearfix"></div>
				</div><!-- .content -->
			</section><!-- .default-section -->
		
			<?php comments_template(); ?>

			<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
