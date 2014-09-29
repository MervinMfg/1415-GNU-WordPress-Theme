<?php
	if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing
	// set up video array
	$videos = Array();
	// get data based on if we're in a single team post or anywhere else on the site
	if (is_singular('gnu_team')) {
		// grab data specific to individual team member
		$instagram = get_field('gnu_social_slider_instagram');
		$facebook = get_field('gnu_social_slider_facebook');
		if(have_rows('gnu_social_slider_videos')):
			while( have_rows('gnu_social_slider_videos') ):
				the_row();
				$videoEmbed = get_sub_field('gnu_social_slider_videos_vid');
				// find vimeo video ID
				preg_match('/src="\/\/player.vimeo.com\/video\/([^"]+)"/', $videoEmbed, $match);
				$videoID = $match[1];
				$videoDetails = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$videoID.php"));
				array_push($videos, Array('embed' => $videoEmbed, 'id' => $videoID, 'details' => $videoDetails));
			endwhile;
		endif;
	} else {
		// grab data based on what's entered in homepage acf
		$homePage = get_page_by_title('Home');
		$instagram = get_field('gnu_social_slider_instagram', $homePage->ID);
		$facebook = get_field('gnu_social_slider_facebook', $homePage->ID);
		if(have_rows('gnu_social_slider_videos', $homePage->ID)):
			while( have_rows('gnu_social_slider_videos', $homePage->ID) ):
				the_row();
				$videoEmbed = get_sub_field('gnu_social_slider_videos_vid');
				// find vimeo video ID
				preg_match('/src="\/\/player.vimeo.com\/video\/([^"]+)"/', $videoEmbed, $match);
				$videoID = $match[1];
				$videoDetails = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$videoID.php"));
				array_push($videos, Array('embed' => $videoEmbed, 'id' => $videoID, 'details' => $videoDetails));
			endwhile;
		endif;
	}
?>

			<section id="social-slider">
				<div class="social-slider" data-instagram="<?php echo $instagram; ?>" data-facebook="<?php echo $facebook; ?>">
					<div class="social-list owl-carousel loading">

						<?php foreach ($videos as $video) : ?>

						<div class="social-item vimeo">
							<a href="https://vimeo.com/<?php echo $video['id']; ?>" target="_blank" class="owl-lazy" data-src="<?php echo $video['details'][0]['thumbnail_large']; ?>" title="<?php echo $video['details'][0]['title']; ?>">
								<div class="item-icon">
									<div class="icon"></div>
								</div>
							</a>
						</div>
						
						<?php endforeach; ?>

					</div><!-- .social-list -->
					<div class="video-player">
						<h3 class="video-title">Headline for video</h3>
						<button class="btn-close white"><span class="offscreen">Close</span></button>
						<div class="video-wrapper"><!-- rendered by JavaScript --></div>
					</div><!-- .video-player -->
				</div><!-- .social-slider -->
			</section><!-- #social-slider -->
