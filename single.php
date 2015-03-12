<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage 1415-GNU-WordPress-Theme
 * @since 1415 GNU WordPress Theme 1.0.0
 */
 get_header(); ?>

	<?php
		if (have_posts()) :
			while (have_posts()) :
				the_post();
				// get the main parent category
				$category = get_the_category();
				$catTree = get_category_parents($category[0]->term_id, true, '!', true);
				$topCat = preg_split('/!/', $catTree);
				$mainCategory = $topCat[0];
	?>

			<article <?php post_class('blog-post-details') ?> id="post-<?php the_ID(); ?>" itemscope="" itemtype="http://schema.org/BlogPosting">
				<h1 class="post-title h2" itemprop="name"><?php the_title(); ?></h1>
				<div class="post-meta"><?php echo $mainCategory; ?> | <time datetime="<?php the_time('c') ?>"><span itemprop="datePublished"><?php the_time('F jS, Y') ?></span></time></div>
				<div class="post-content" itemprop="articleBody">

					<?php the_content(); ?>

					<div class="clearfix"></div>
				</div>
				<div class="post-categories">Categories | <?php the_category(' ') ?></div>
				<ul class="post-share product-share">
					<li class="title"><p class="small">SHARE</p></li>
					<li class="facebook"><div class="fb-like" data-href="<? the_permalink(); ?>" data-layout="button" data-action="like" data-share="false" data-show-faces="false" data-colorscheme="light"></div></li>
					<li class="twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-via="GNUsnowboards" data-count="none">Tweet</a></li>
					<li class="g-plus"><div class="g-plusone" data-size="tall" data-annotation="none" data-href="<? the_permalink(); ?>"></div></li>
					<li class="pinterest"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" data-pin-do="buttonPin" data-pin-config="none" data-pin-color="white"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_white_20.png" alt="Pin It" /></a></li>
				</ul><!-- .product-share -->
			</article>

			<?php comments_template(); ?>

	<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
