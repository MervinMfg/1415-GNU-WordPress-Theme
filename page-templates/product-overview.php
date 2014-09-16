<?php
/*
Template Name: Product Overview
*/
?>
<?php get_header(); ?>

			<?php if (get_the_title() == "Snowboards") : ?>
			<section id="mens-snowboards" class="product-overview deeplink-top-fix">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Mens Snowboards</h2>
						<h5 class="subtitle">Innovation Creation Since 1977</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign large"><a href="#womens-snowboards">View Womens</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-1"></div>
				</header>
				<div class="product-filters">
					<button class="btn-filter">Board Filters</button>
				</div>
				<div class="product-list owl-carousel">

					<?php
						// Get Mens
						$args = array(
							'post_type' => 'gnu_snowboards',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_snowboard_categories',
									'field' => 'slug',
									'terms' => array('mens', 'mens-splitboards', 'mens-youth'),
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$image = get_field('gnu_snowboard_overview_img');
							$detail = get_field('gnu_snowboard_contour');
					?>

					<div class="product">
						<a href="<? the_permalink(); ?>">
							<div class="info">
								<div class="vertical-center">
									<h4 class="name"><?php the_title(); ?></h4>
									<p class="detail"><?php echo $detail; ?></p>
									<?php echo getPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_price_eur'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
								</div>
							</div>
							<?php if($image): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-board.png" data-src="<?php echo $image['sizes']['large']; ?>" data-src-retina="<?php echo $image['url']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div><!-- .product -->

					<?
						endwhile;
						wp_reset_query();
					?>

				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section id="womens-snowboards" class="product-overview deeplink-top-fix">
				<header class="product-header section-header alt">
					<div class="header-wrapper">
						<h2 class="title">Womens Snowboards</h2>
						<h5 class="subtitle">Barrett Christy’s High Performance Vision</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#mens-snowboards">View Mens</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-2"></div>
				</header>
				<div class="product-filters">
					<button class="btn-filter">Board Filters</button>
				</div>
				<div class="product-list owl-carousel">
					<?php
						// Get Womens
						$args = array(
							'post_type' => 'gnu_snowboards',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_snowboard_categories',
									'field' => 'slug',
									'terms' => array('womens', 'womens-splitboards', 'womens-youth'),
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$image = get_field('gnu_snowboard_overview_img');
							$detail = get_field('gnu_snowboard_contour');
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
							<?php if($image): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-board.png" data-src="<?php echo $image['sizes']['large']; ?>" data-src-retina="<?php echo $image['url']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div><!-- .product -->

					<?
						endwhile;
						wp_reset_query();
					?>
				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->

			<?php elseif (get_the_title() == "Bindings") : ?>

			<section id="mens-bindings" class="product-overview deeplink-top-fix">
				<header class="product-header section-header alt">
					<div class="header-wrapper">
						<h2 class="title">Mens Bindings</h2>
						<h5 class="subtitle">Front door or backdoor. Pick one and slide on in.</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign large"><a href="#womens-bindings">View Womens</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-6"></div>
				</header>
				<div class="product-filters"></div>
				<div class="product-list owl-carousel">
					<?php
						// Get Mens Bindings
						$args = array(
							'post_type' => 'gnu_bindings',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_bindings_categories',
									'field' => 'slug',
									'terms' => array('mens', 'youth'),
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$image = get_field('gnu_product_image');
							$detail = get_field('gnu_binding_type');
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
							<?php if($image): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-binding.png" data-src="<?php echo $image['sizes']['large']; ?>" data-src-retina="<?php echo $image['url']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div><!-- .product -->

					<?
						endwhile;
						wp_reset_query();
					?>
				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section id="womens-bindings" class="product-overview deeplink-top-fix">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Womens Bindings</h2>
						<h5 class="subtitle">Front door or backdoor. Pick one and slide on in.</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#mens-bindings">View Mens</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-3"></div>
				</header>
				<div class="product-filters"></div>
				<div class="product-list owl-carousel">
					<?php
						// Get Womens Bindings
						$args = array(
							'post_type' => 'gnu_bindings',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_bindings_categories',
									'field' => 'slug',
									'terms' => array('womens', 'youth'),
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$image = get_field('gnu_product_image');
							$detail = get_field('gnu_binding_type');
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
							<?php if($image): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-binding.png" data-src="<?php echo $image['sizes']['large']; ?>" data-src-retina="<?php echo $image['url']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div><!-- .product -->

					<?
						endwhile;
						wp_reset_query();
					?>
				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section id="compare-bindings" class="product-compare deeplink-top-fix">
				<header class="product-header section-header alt">
					<div class="header-wrapper">
						<h2 class="title">Comparison</h2>
						<h5 class="subtitle">Study the various bindings and their features</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#mens-bindings">View Mens</a></li>
									<li class="sign large"><a href="#womens-bindings">View Womens</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-5"></div>
				</header>
				<div class="product-filters"></div>
				<ul class="product-list">
					<li class="list-item">
						<a href="#">
							<img src="" alt="" />
							<h4 class="product-name">Board Name</h4>
							<h5 class="product-category">Board Category</h5>
							<p class="product-price">$499.99 USD</p>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</section><!-- .product-overview -->

			<?php elseif (get_the_title() == "Supplies") : ?>

			<section id="wearables" class="product-overview deeplink-top-fix">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Wearables</h2>
						<h5 class="subtitle">The Weirdwear Collection</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign small"><a href="#headwear">View Headwear</a></li>
									<li class="sign large"><a href="#accessories">View Accessories</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-2"></div>
				</header>
				<div class="product-filters">
					<button class="btn-filter">Supply Filters</button>
				</div>
				<div class="product-list owl-carousel">
					<?php
						// Get Wearables
						$args = array(
							'post_type' => 'gnu_apparel',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_apparel_categories',
									'field' => 'slug',
									'terms' => array('sweatshirts', 't-shirts', 'socks'),
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$image = get_field('gnu_product_image');
							$detail = 'Wearables';
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
							<?php if($image): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo $image['sizes']['large']; ?>" data-src-retina="<?php echo $image['url']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div><!-- .product -->

					<?
						endwhile;
						wp_reset_query();
					?>
				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section id="headwear" class="product-overview deeplink-top-fix">
				<header class="product-header section-header alt">
					<div class="header-wrapper">
						<h2 class="title">Headwear</h2>
						<h5 class="subtitle">For the second most important head on your body</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#wearables">View Wearables</a></li>
									<li class="sign large"><a href="#accessories">View Accessories</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-5"></div>
				</header>
				<div class="product-filters">
					<button class="btn-filter">Supply Filters</button>
				</div>
				<div class="product-list owl-carousel">
					<?php
						// Get Wearables
						$args = array(
							'post_type' => 'gnu_apparel',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_apparel_categories',
									'field' => 'slug',
									'terms' => array('hats', 'beanies'),
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$image = get_field('gnu_product_image');
							$detail = 'Headwear';
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
							<?php if($image): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo $image['sizes']['large']; ?>" data-src-retina="<?php echo $image['url']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div><!-- .product -->

					<?
						endwhile;
						wp_reset_query();
					?>
				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section id="accessories" class="product-overview deeplink-top-fix">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Accessories</h2>
						<h5 class="subtitle">Tuning for your gold metal technology</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#wearables">View Wearables</a></li>
									<li class="sign small"><a href="#headwear">View Headwear</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-4"></div>
				</header>
				<div class="product-filters">
					<button class="btn-filter">Supply Filters</button>
				</div>
				<div class="product-list owl-carousel">
					<?php
						// Get Wearables
						$args = array(
							'post_type' => 'gnu_accessories',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC'
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
							<?php if($image): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo $image['sizes']['large']; ?>" data-src-retina="<?php echo $image['url']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div><!-- .product -->

					<?
						endwhile;
						wp_reset_query();
					?>
				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->

			<?php endif; ?>

<?php get_footer(); ?>