<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>

			<section class="featured-posts">
				<ul class="featured-post-list">

					<?php
						// CHECK IF WE'RE ON A TEAM PAGE OR HOME
						if (get_field('gnu_team_blog_category_slug')) {
							// get recent blog posts by category slug
							$categoryIDObj = get_category_by_slug(get_field('gnu_team_blog_category_slug'));
							$categoryID = $categoryIDObj->term_id;
							$categoryLink = get_category_link($categoryID);
						} else {
							// default, home page
							$categoryID = "";
							$categoryLink = "/blog/";
						}
						$args = array(
							'posts_per_page' => 2,
							'post__in'  => get_option( 'sticky_posts' ),
							'ignore_sticky_posts' => 1,
							'category' => $categoryID
						);
						$myposts = get_posts($args);
						$i=1;
						foreach ($myposts as $post) :
							$postImage = get_post_image('blog-thumb');
							// get the main parent category
							$category = get_the_category();
							$catTree = get_category_parents($category[0]->term_id, true, '!', true);
							$topCat = preg_split('/!/', $catTree);
							$mainCategory = $topCat[0];
					?>

					<li class="featured-post <?php echo 'post-' . $i; ?>">
						<div class="post-wrapper">
							<a href="<?php the_permalink() ?>" class="post-link"><img src="<?php echo $postImage[0]; ?>" alt="Image From <?php echo get_the_title(); ?>" /></a>
							<p class="post-meta small"><?php echo $mainCategory; ?> | <a href="<?php the_permalink() ?>" class="post-link"><time datetime="<?php the_time('c') ?>"><?php the_time('F jS, Y') ?></time></a></p>
							<a href="<?php the_permalink() ?>" class="post-link"><h3 class="post-title"><?php the_title(); ?></h3></a>
						</div>
					</li>

					<?php
							$post_thumbnail = ""; $i++; // resetting image value, incrementing $i
						endforeach;
						// Reset Post Data
						wp_reset_query();
					?>

				</ul>
				<div class="clearfix"></div>
				<a href="<?php echo $categoryLink; ?>" class="bold-black more-news">More News</a>
			</section><!-- .featured-posts -->
