<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>
			
			<?php if(have_rows('gnu_feature_slider')): ?>
			<section class="featured-slider">
				<div class="slide-list owl-carousel">
					<?php
						while( have_rows('gnu_feature_slider') ):
							the_row();
							$image = get_sub_field('gnu_feature_slider_img');
							$overlayImage = get_sub_field('gnu_feature_slider_overlay_img');
							$overlayImageAlt = get_sub_field('gnu_feature_slider_overlay_img_alt');
					?>
					<div class="slide-item owl-lazy" data-src="<?php echo $image['url']; ?>" data-src-retina="<?php echo $image['url']; ?>">
						<div class="slide-details right">
							<div class="slide-overlay">
								<img src="<?php echo $overlayImage['url']; ?>" alt="<?php echo $overlayImageAlt; ?>" />
							</div>
						</div>
					</div><!-- .slide-item -->
					<?php endwhile; ?>
				</div><!-- .slide-list -->
			</section><!-- .featured-slider -->
			<?php endif; ?>
