<?php
/*
Template Name: FAQ
*/
?>
<?php
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
?>
		<header class="section-header">
			<div class="header-wrapper">
				<h1 class="title">GNU FAQ</h1>
			</div>
			<div class="vibe vibe-6"></div>
		</header>

		<nav class="faq-navigation">
			<div class="nav-container">
				<ul>
					<li><a href="#general-faq" class="general-faq">General</a></li>
					<li><a href="#snowboard-faq" class="snowboard-faq">Snowboards</a></li>
					<li><a href="#binding-faq" class="binding-faq">Bindings</a></li>
				</ul>
			</div>
		</nav>
		<div class="content-wrapper">
			<section id="general-faq">
				<h3>General</h3>
				<div class="faq-wrapper">
					<ul>
						<?php
							//Get FAQs
							$args = array(
								'post_type' => 'gnu_faqs',
								'posts_per_page' => -1,
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'tax_query' => array(
									array(
										'taxonomy' => 'gnu_faq_categories',
										'field' => 'slug',
										'terms' => 'general',
										'include_children' => false
									)
								)
							);
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
						?>
							<li>
								<div class="question">
									<p><?php the_title(); ?></p>
								</div>
								<div class="answer">
									<?php the_content(); ?>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</section><!-- #general-faq -->
			<section id="snowboard-faq">
				<h3>Snowboards</h3>
				<div class="faq-wrapper">
					<ul>
						<?php
							//Get FAQs
							$args = array(
								'post_type' => 'gnu_faqs',
								'posts_per_page' => -1,
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'tax_query' => array(
									array(
										'taxonomy' => 'gnu_faq_categories',
										'field' => 'slug',
										'terms' => 'snowboards',
										'include_children' => false
									)
								)
							);
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
						?>
							<li>
								<div class="question">
									<p><?php the_title(); ?></p>
								</div>
								<div class="answer">
									<?php the_content(); ?>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</section><!-- #snowboard-faq -->
			<section id="binding-faq">
				<h3>Bindings</h3>
				<div class="faq-wrapper">
					<ul>
						<?php
							//Get FAQs
							$args = array(
								'post_type' => 'gnu_faqs',
								'posts_per_page' => -1,
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'tax_query' => array(
									array(
										'taxonomy' => 'gnu_faq_categories',
										'field' => 'slug',
										'terms' => 'bindings',
										'include_children' => false
									)
								)
							);
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
						?>
							<li>
								<div class="question">
									<p><?php the_title(); ?></p>
								</div>
								<div class="answer">
									<?php the_content(); ?>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</section><!-- #binding-faq -->
		</div><!-- .content-wrapper -->
<?php
	endwhile; endif;
	get_footer();
?>