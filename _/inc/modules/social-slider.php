<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>

			<section class="social-slider" data-instagram="<?php the_field('gnu_social_slider_instagram'); ?>" data-facebook="<?php the_field('gnu_social_slider_facebook'); ?>">
				<div class="social-list owl-carousel loading">

					<?php
						if(have_rows('gnu_social_slider_videos')):
							while( have_rows('gnu_social_slider_videos') ):
								the_row();
								$videoEmbed = get_sub_field('gnu_social_slider_videos_vid');
								// find vimeo ID
								preg_match('/src="\/\/player.vimeo.com\/video\/([^"]+)"/', $videoEmbed, $match);
								$vimeoID = $match[1];
								$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vimeoID.php"));
					?>
					<div class="social-item vimeo">
						<a href="https://vimeo.com/<?php echo $vimeoID ?>" target="_blank" class="owl-lazy" data-src="<?php echo $hash[0]['thumbnail_large']; ?>" title="<?php echo $hash[0]['title']; ?>">
							<div class="item-icon">
								<div class="icon"></div>
							</div>
						</a>
					</div>
					<?php
							endwhile;
						endif;
					?>

				</div><!-- .social-list -->
				<div class="video-player">
					<h3 class="video-title">Headline for video</h3>
					<button class="btn-close white"><span class="offscreen">Close</span></button>
					<div class="video-wrapper"><!-- rendered by JavaScript --></div>
				</div><!-- .video-player -->
			</section><!-- .social-slider -->
