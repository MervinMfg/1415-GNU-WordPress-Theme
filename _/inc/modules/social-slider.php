<?php
	if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing
	// set up video array
	$videos = Array();
	// get data based on if we're in the blog or a single post
	if (is_home() || is_archive()) {
		// we're looking at multiple posts
		$blogPage = get_page_by_path('blog');
		$instagram = get_field('gnu_social_slider_instagram', $blogPage->ID);
		$facebook = get_field('gnu_social_slider_facebook', $blogPage->ID);
		if(have_rows('gnu_social_slider_videos', $blogPage->ID)):
			while( have_rows('gnu_social_slider_videos', $blogPage->ID) ):
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
		// we're looking at a single post
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
	}
?>

			<section class="social-slider" data-instagram="<?php echo $instagram; ?>" data-facebook="<?php echo $facebook; ?>">
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
			</section><!-- .social-slider -->
