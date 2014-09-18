<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage 1415-GNU-WordPress-Theme
 * @since 1415 GNU WordPress Theme 1.0.0
 */
 get_header();
 if (have_posts()) :
 ?>

			<?php include get_template_directory() . '/_/inc/modules/featured-slider.php'; ?>

			<nav class="blog-navigation">
				<div class="nav-container">
					<ul>
						<li><a href="/category/team/mens/" class="h4 mens">Men's</a></li>
						<li><a href="/category/team/womens/" class="h4 womens">Women's</a></li>
						<li><a href="/category/events/" class="h4 events">Events</a></li>
						<li><a href="/category/product/" class="h4 product">Product</a></li>
						<li><a href="/category/art/" class="h4 art">Art</a></li>
					</ul>
					<div class="clearfix"></div>
				</div><!-- .nav-container -->
			</nav><!-- .blog-navigation -->
			<section class="blog-posts">

				<?php
					$i = 0;
					while (have_posts()) :
						the_post();
						$i ++;
						$postImage = get_post_image('blog-feature');
						// get the main parent category
						$category = get_the_category();
						$catTree = get_category_parents($category[0]->term_id, true, '!', true);
						$topCat = preg_split('/!/', $catTree);
						$mainCategory = $topCat[0];
						$postClass = 'blog-post post-' . $i;

						if ($i == 3) :
							// break out and include social slider
							echo '</section><!-- .blog-posts -->';
							include get_template_directory() . '/_/inc/modules/social-slider.php';
							echo '<section class="blog-posts">';
						endif;
				?>

				<article <?php post_class($postClass); ?> id="post-<?php the_ID(); ?>">	
					<div class="post-wrapper">
						<div class="post-image">
							<a href="<?php the_permalink() ?>" class="post-link"><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-blog.gif" data-src="<?php echo $postImage[0]; ?>" alt="Image From <?php echo get_the_title(); ?>" class="lazy" /></a>
							<ul class="post-share">
								<li class="facebook"><div class="fb-like" data-href="<? the_permalink(); ?>" data-layout="button" data-action="like" data-share="false" data-show-faces="false" data-colorscheme="light"></div></li>
								<li class="twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-via="GNUsnowboards" data-count="none">Tweet</a></li>
								<li class="g-plus"><div class="g-plusone" data-size="tall" data-annotation="none" data-href="<? the_permalink(); ?>"></div></li>
								<li class="pinterest"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" data-pin-do="buttonPin" data-pin-config="none" data-pin-color="white"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_white_20.png" alt="Pin It" /></a></li>
							</ul><!-- .post-share -->
						</div>
						<p class="post-meta small"><?php echo $mainCategory; ?> | <a href="<?php the_permalink() ?>" class="post-link"><time datetime="<?php the_time('c') ?>"><?php the_time('F jS, Y') ?></time></a></p>
						<div class="post-title"><a href="<?php the_permalink() ?>" class="post-link"><h3><?php the_title(); ?></h3></a></div>
						<p class="post-excerpt"><?php echo gnu_excerpt('gnu_excerptlength_blog', false); ?></p>
					</div>
				</article>

				<?php endwhile; ?>

			</section><!-- .blog-posts -->

			<?php post_navigation(); ?>

<?php else : ?>

			<section class="blog-posts">
				<h2>Nothing Found</h2>
			</section>

<?php endif; ?>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>