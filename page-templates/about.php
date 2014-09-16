<?php
/*
Template Name: About
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
?>

			<section class="about-section about-info">
				<h2 class="title">Weird Times For A Long Time</h2>
				<h5 class="subtitle">Handbuilt in the U.S.A. SINCE 1977</h5>
				<div class="content">
					<?php the_content(); ?>
				</div><!-- .content -->
			</section><!-- .about-section -->

			<?php include get_template_directory() . '/_/inc/modules/photo-slider.php'; ?>

			<section class="about-section about-technology">
				<h2 class="title">GNU Technology</h2>
				<h5 class="subtitle">Gold Metal Technology</h5>
				<div class="content">
					<p>The wonders of science are our playground: impossibly light and strong metals that burn, polymers that travel through space, trees that grow to 20 feet in oe year or cover hundreds of acres as a single organism. We test in all on Mt. Weird and have ecologically applied them to this year's Gnu snowboards.</p>
					<a href="/about/technology/" class="h3">View Technology</a>
				</div><!-- .content -->
			</section><!-- .about-section -->
			<section class="about-section about-partners">
				<h2 class="title">Partners</h2>
				<div class="content">
					<p> Gnu is proud to work with these partners and sponsorship programs. Below is a list of our featured partners. If you’re interested in partnering with Gnu, <a href="http://www.mervin.com/contact/" target="_blank">contact us here</a>.</p>
					<ul class="partners-list">
						<?php
							// get full list of partners and render logos
							$args = array(
								'post_type' => 'gnu_partners',
								'posts_per_page' => -1,
								'orderby' => 'menu_order',
								'order' => 'ASC'
							);
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
								$title = get_the_title();
								$link = get_field('gnu_partners_link');
								$logo = get_field('gnu_partners_logo');
						?>
						<li><a href="<?php echo $link; ?>" target="_blank" title="<?php echo $title; ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo $logo['url']; ?>" alt="<?php echo $title; ?>" class="lazy" /></a></li>
						<?php
							endwhile;
							wp_reset_query();
						?>
					</ul><!-- .partners-list -->
					<a href="/about/partners/" class="h3">View Partners</a>
				</div><!-- .content -->
			</section><!-- .about-section -->

			<?php include get_template_directory() . '/_/inc/modules/follow.php'; ?>

<?php
	endwhile; endif;
	get_footer();
?>