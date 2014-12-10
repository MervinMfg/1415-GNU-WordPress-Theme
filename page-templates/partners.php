<?php
/*
Template Name: Partners
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
?>
			<section class="partners">
				<header class="product-header section-header alt">
					<div class="header-wrapper">
						<h2 class="title"><?php the_title(); ?></h2>
						<h5 class="subtitle"><?php echo get_the_content(); ?></h5>
					</div>
					<div class="vibe vibe-4"></div>
				</header>
				<div class="content">
					<ul class="partner-list">
						<?php
							// GET ACADEMIES AND CLUBS
							$args = array(
								'post_type' => 'gnu_partners',
								'posts_per_page' => -1,
								'orderby' => 'menu_order',
								'order' => 'ASC'
							);
							$partnerList = Array();
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
								$title = get_the_title();
								$content = get_the_content();
								$slug = $post->post_name; 
								$link = get_field('gnu_partners_link');
								$logo = get_field('gnu_partners_logo');
								// get category name
								$taxTerms = get_the_terms($post->ID, 'gnu_partner_categories');
								$categoryName = "";
								foreach( $taxTerms as $term ) {
									$categoryName = $term->name;
									unset($taxTerms);
								}
						?>
						<li class="partner" id="<?php echo $slug; ?>">
							<div class="partner-wrapper">
								<div class="partner-images">
									<div class="partner-image logo"><img src="<?php echo $logo['url']; ?>" alt="<?php echo $title; ?> Logo" /></div>
									<?php while(the_repeater_field('gnu_partners_photos')): $partnerPhoto = get_sub_field('gnu_partners_photos_img'); ?>
									<div class="partner-image"><a href="<?php echo $partnerPhoto['url']; ?>"><img src="<?php echo $partnerPhoto['url']; ?>" alt="<?php echo $title; ?> Photo" /></a></div>
									<?php endwhile; ?>
								</div>
								<h3 class="partner-title"><?php echo $title; ?></h3>
								<div class="partner-description">
									<p class="small"><span class="category"><?php echo $categoryName; ?></span> <?php echo $content; ?></p>
									<div class="partner-link"><a href="<?php echo $link; ?>" target="_blank" class="bold-black">view site</a></div>
								</div>
							</div><!-- .partner-wrapper -->
							<div class="clearfix"></div>
						</li>
						<?php
							endwhile;
							wp_reset_query();
						?>
					</ul>
				</div>
				<div class="clearfix"></div>
			</section><!-- .partners -->

<?php
	endwhile; endif;
	get_footer();
?>