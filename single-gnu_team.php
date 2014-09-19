<?php
/*
Template Name: Team Detail
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
?>
			<section class="team-details">
				<div class="team-content">
					<h1 class="team-title"><?php the_title(); ?></h1>
					<h5 class="team-subtitle"><?php echo get_the_content(); ?></h5>
					<ul class="social-icons black nav-menu">
						<?php if(get_field('gnu_team_facebook_username')) : ?><li class="menu-item"><a href="http://www.facebook.com/<?php the_field('gnu_team_facebook_username'); ?>" class="icon-facebook" target="_blank"><span class="offscreen">Facebook</span></a></li><?php endif; ?>
						<?php if(get_field('gnu_team_twitter_username')) : ?><li class="menu-item"><a href="http://twitter.com/<?php the_field('gnu_team_twitter_username'); ?>" class="icon-twitter" target="_blank"><span class="offscreen">Twitter</span></a></li><?php endif; ?>
						<?php if(get_field('gnu_team_vimeo_username')) : ?><li class="menu-item"><a href="http://vimeo.com/<?php the_field('gnu_team_vimeo_username'); ?>" class="icon-vimeo" target="_blank"><span class="offscreen">Vimeo</span></a></li><?php endif; ?>
						<?php if(get_field('gnu_team_instagram_username')) : ?><li class="menu-item"><a href="http://instagram.com/<?php the_field('gnu_team_instagram_username'); ?>" class="icon-instagram" target="_blank"><span class="offscreen">Instagram</span></a></li><?php endif; ?>
					</ul>
					<?php if(get_field('gnu_team_personal_website')) : ?><p class="team-website"><a href="<?php the_field('gnu_team_personal_website'); ?>" target="_blank">Personal Website</a></p><?php endif; ?>
				</div>

				<?php if (get_field('gnu_team_profile_photo')) : ?>

				<div class="team-photo"><img src="<?php echo get_field('gnu_team_profile_photo')['url']; ?>" alt="<?php the_title(); ?> Profile Photo" /></div>

				<?php endif; ?>

				<div class="clearfix"></div>
			</section><!-- .team-details -->

			<?php include get_template_directory() . '/_/inc/modules/social-slider.php'; ?>

			<?php include get_template_directory() . '/_/inc/modules/photo-slider.php'; ?>

			<?php include get_template_directory() . '/_/inc/modules/featured-posts.php'; ?>

			<?php include get_template_directory() . '/_/inc/modules/featured-products.php'; ?>

<?php
	endwhile; endif;
	get_footer();
?>