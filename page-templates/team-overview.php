<?php
/*
Template Name: Team Overview
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
?>

			<?php include get_template_directory() . '/_/inc/modules/photo-slider.php'; ?>

			<section id="mens-team" class="product-overview deeplink-top-fix team-overview">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Men's Team</h2>
						<h5 class="subtitle">Putting the Wild on Mt. Weird</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign large"><a href="#womens-team">View Women's</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-2"></div>
				</header>
				<div class="product-utility">
					<div class="instructions"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/carousel-instructions-team.gif" alt="Click and Drag Team" class="lazy" /></div>
				</div>
				<div class="product-list owl-carousel owl-theme">

					<?php
						$args = array(
							'post_type' => 'gnu_team',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_team_categories',
									'field' => 'slug',
									'terms' => 'mens-team',
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$profilePhoto = get_field('gnu_team_overview_photo');
							$detail = get_the_content();
					?>

					<div class="product">
						<a href="<? the_permalink(); ?>">
							<div class="info">
								<div class="vertical-center">
									<h4 class="name"><?php the_title(); ?></h4>
									<p class="detail"><?php echo $detail; ?></p>
								</div>
							</div>
							<?php if($profilePhoto): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-team.png" data-src="<?php echo $profilePhoto['sizes']['medium']; ?>" data-src-retina="<?php echo $profilePhoto['sizes']['large']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div><!-- .product -->

					<?php
						endwhile;
						wp_reset_query();
					?>

				</div><!-- .product-list -->
				<div class="more-riders">
					<h3 class="title">More Riders</h3>
					<ul class="rider-list">
						<li class="list-item p"><a href="/category/team/mens/ams-mens/hunter-wood/">Hunter Wood</a></li>
						<li class="list-item p"><a href="/category/team/mens/ulrik-badertscher/">Ulrik Badertscher</a></li>
						<li class="list-item p"><a href="/category/team/mens/ams-mens/alex-lopez/">Alex Lopez</a></li>
						<li class="list-item p">Teo Konttinen</li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</section>
			<section id="womens-team" class="product-overview deeplink-top-fix team-overview">
				<header class="product-header section-header alt">
					<div class="header-wrapper">
						<h2 class="title">Women's Team</h2>
						<h5 class="subtitle">Gold Metal Technology, We Did It!</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#mens-team">View Men's</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-6"></div>
				</header>
				<div class="product-utility">
					<div class="instructions"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/carousel-instructions-team.gif" alt="Click and Drag Team" class="lazy" /></div>
				</div>
				<div class="product-list owl-carousel owl-theme">

					<?php
						$args = array(
							'post_type' => 'gnu_team',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_team_categories',
									'field' => 'slug',
									'terms' => 'womens-team',
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$profilePhoto = get_field('gnu_team_overview_photo');
							$detail = get_the_content();
					?>

					<div class="product">
						<a href="<? the_permalink(); ?>">
							<div class="info">
								<div class="vertical-center">
									<h4 class="name"><?php the_title(); ?></h4>
									<p class="detail"><?php echo $detail; ?></p>
								</div>
							</div>
							<?php if($profilePhoto): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-team.png" data-src="<?php echo $profilePhoto['sizes']['medium']; ?>" data-src-retina="<?php echo $profilePhoto['sizes']['large']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div><!-- .product -->

					<?php
						endwhile;
						wp_reset_query();
					?>

				</div><!-- .product-list -->
				<div class="more-riders">
					<h3 class="title">More Riders</h3>
					<ul class="rider-list">
						<li class="list-item p"><a href="/category/team/womens/regional-womens/jenna-blasman/">Jenna Blasman</a></li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</section>

<?php
	endwhile; endif;
	get_footer();
?>