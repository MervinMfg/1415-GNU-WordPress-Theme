<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>

			<?php if(have_rows('gnu_photo_slider')): ?>
			<section class="photo-slider">
				<div class="photo-list owl-carousel">
					<?php
						while( have_rows('gnu_photo_slider') ):
							the_row();
							$image = get_sub_field('gnu_photo_slider_img');
							$title = get_sub_field('gnu_photo_slider_title');
							$credit = get_sub_field('gnu_photo_slider_credit');
							$color = get_sub_field('gnu_photo_slider_text_color');
							$align = get_sub_field('gnu_photo_slider_text_align');
					?>
					<div class="photo-item owl-lazy" data-src="<?php echo $image['url']; ?>">
						<div class="photo-details <?php echo $color . ' ' . $align; ?> ">
							<h5 class="photo-title"><?php echo $title; ?></h5>
							<?php if ($credit != ""): ?><p class="photo-credits">P: <?php echo $credit; ?></p><?php endif; ?>
						</div>
					</div><!-- .photo-item -->
					<?php endwhile; ?>
				</div><!-- .photo-list -->
			</section><!-- .photo-slider -->
			<?php endif; ?>
