<?php
	if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing
	// set up slider array
	$sliders = Array();
	// get data based on if we're in the blog or a single post
	if (is_home()) {
		// we're looking at multiple posts
		$blogPage = get_page_by_path('blog');
		while( have_rows('gnu_feature_slider', $blogPage->ID) ):
			the_row();
			$image = get_sub_field('gnu_feature_slider_img');
			$overlayImage = get_sub_field('gnu_feature_slider_overlay_img');
			$overlayImageAlt = get_sub_field('gnu_feature_slider_overlay_img_alt');
			$overlayImageAlign = get_sub_field('gnu_feature_slider_overlay_img_align');
			$link = get_sub_field('gnu_feature_slider_url');
			array_push($sliders, Array('image' => $image, 'overlayImage' => $overlayImage, 'overlayImageAlt' => $overlayImageAlt, 'overlayImageAlign' => $overlayImageAlign, 'link' => $link));
		endwhile;
	} else {
		while( have_rows('gnu_feature_slider') ):
			the_row();
			$image = get_sub_field('gnu_feature_slider_img');
			$overlayImage = get_sub_field('gnu_feature_slider_overlay_img');
			$overlayImageAlt = get_sub_field('gnu_feature_slider_overlay_img_alt');
			$overlayImageAlign = get_sub_field('gnu_feature_slider_overlay_img_align');
			$link = get_sub_field('gnu_feature_slider_url');
			array_push($sliders, Array('image' => $image, 'overlayImage' => $overlayImage, 'overlayImageAlt' => $overlayImageAlt, 'overlayImageAlign' => $overlayImageAlign, 'link' => $link));
		endwhile;
	}
?>
		
			<?php if (count($sliders) > 0) : ?>

			<section class="featured-slider">
				<div class="slide-list owl-carousel owl-theme">
					
					<?php foreach ($sliders as $slider) : ?>

					<div class="slide-item owl-lazy" data-src="<?php echo $slider['image']['url']; ?>">
						<a href="<?php echo $slider['link']; ?>">
							<div class="takeover-overlay"></div>
							<div class="slide-details <?php echo $slider['overlayImageAlign']; ?>">
								<div class="slide-overlay">
									<img src="<?php echo $slider['overlayImage']['url']; ?>" alt="<?php echo $slider['overlayImageAlt']; ?>" />
								</div>
							</div>
						</a>
					</div><!-- .slide-item -->

					<?php endforeach; ?>

				</div><!-- .slide-list -->
			</section><!-- .featured-slider -->

			<?php endif; ?>
