<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage 1415-GNU-WordPress-Theme
 * @since 1415 GNU WordPress Theme 1.0.0
 */
?>

            <?php include get_template_directory() . '/_/inc/modules/social-slider.php'; ?>

            <section class="featured-posts">
				<ul class="featured-post-list">
					<?php
						// RELATED POSTS BY CATEGORY
						// Only grab posts with shared categories and within the same year
						$relatedPosts = Array();
						$categories = get_the_category($post->ID);
						if ($categories) {
							$category_ids = array();
							foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
							$args = array(
								'category__in' => $category_ids,
								'post__not_in' => array($post->ID),
								'posts_per_page' => 10,
								'ignore_sticky_posts' => 1,
								'date_query' => array(
									array(
										'year' => get_the_time('Y')
									)
								)
							);
							$my_query = new WP_Query( $args );
							if( $my_query->have_posts() ) {
								while( $my_query->have_posts() ) {
									$my_query->the_post();
									$postImage = get_post_image('blog-feature');
									// get the main parent category
									$category = get_the_category();
									$catTree = get_category_parents($category[0]->term_id, true, '!', true);
									$topCat = preg_split('/!/', $catTree);
									$mainCategory = $topCat[0];
									array_push($relatedPosts, Array('title' => get_the_title(), 'url' => get_permalink(), 'image' => $postImage, 'dateTime' => get_the_time('c'), 'displayTime' => get_the_time('F jS, Y'), 'category' => $mainCategory));
								}
							}
						}
						wp_reset_query();
						// randomize posts
						shuffle($relatedPosts);
						$i = 1;
						// loop through posts and break after 2
						foreach ($relatedPosts as $relatedPost) :
					?>

					<li class="blog-post <?php echo 'post-' . $i; ?>">
						<div class="post-wrapper">
							<div class="post-image">
								<a href="<?php echo $relatedPost['url']; ?>" class="post-link"><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-blog.gif" data-src="<?php echo $relatedPost['image'][0]; ?>" alt="Image From <?php echo $relatedPost['title']; ?>" class="lazy" /></a>
							</div>
							<p class="post-meta small"><?php echo $relatedPost['category']; ?> | <a href="<?php echo $relatedPost['url']; ?>" class="post-link"><time datetime="<?php echo $relatedPost['dateTime']; ?>"><?php echo $relatedPost['displayTime']; ?></time></a></p>
							<div class="post-title"><a href="<?php echo $relatedPost['url']; ?>" class="post-link"><h3><?php echo $relatedPost['title']; ?></h3></a></div>
						</div>
					</li>

					<?
							$i++;
							if ($i == 3) {
								break; // onto the 3rd post, so break
							}
						endforeach;
					?>
				</ul>
				<div class="clearfix"></div>
			</section><!-- .featured-posts -->

            <?php include get_template_directory() . '/_/inc/modules/follow.php'; ?>
