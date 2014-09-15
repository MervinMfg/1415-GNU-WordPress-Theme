<?php
/*
Template Name: Accessories Detail
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$productSKU = get_field('gnu_accessory_sku');
		// grab availability
		$productAvailUS = get_field('gnu_accessory_availability_us');
		$productAvailCA = get_field('gnu_accessory_availability_ca');
		$productAvailEUR = get_field('gnu_accessory_availability_eur');
?>

			<section class="product-main">
				<div class="section-content">
					<h1 class="product-title"><?php the_title(); ?></h1>
					<h5 class="product-slogan"><?php the_field('gnu_product_slogan'); ?></h5>
					<div class="product-images">
						<div class="image-list owl-carousel owl-theme">

							<?php
								if(get_field('gnu_product_image')):
									$productImage = get_field('gnu_product_image');
							?>

							<div class="product-image">
								<a href="<?php echo $productImage['url']; ?>" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-product-detail.gif" data-src="<?php echo $productImage['url']; ?>" alt="<?php the_title(); ?>" class="owl-lazy" /></a>
							</div><!-- .product-image -->
							
							<?php endif; ?>
							
						</div><!-- .image-list -->
						<div class="zoom-icon"></div>
					</div><!-- .product-images -->
					<div class="product-awards-price">

						<?php
							// display awards if there are any
							$awards = get_field('gnu_product_awards');
							if( $awards ):
						?>
						<div class="product-awards">
							<ul>
							<?php
								foreach( $awards as $award):
									$imageID = get_field('gnu_award_image', $award->ID);
									$imageFile = wp_get_attachment_image_src($imageID, 'thumbnail');
									echo '<li><img src="'.$imageFile[0].'" width="'.$imageFile[1].'" height="'.$imageFile[2].'" /><div class="tool-tip">' . get_the_title($award->ID) . '</div></li>';
								endforeach;
							?>

							</ul>
						</div><!-- .product-awards -->
						<? endif; // end awards ?>

						<div class="product-price">
							<?php echo getPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_price_eur'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
						</div><!-- .product-price -->
					</div><!-- .product-awards-price -->
					<div class="product-buy" data-avail-us="<?php echo $productAvailUS; ?>" data-avail-ca="<?php echo $productAvailCA; ?>" data-avail-eur="<?php echo $productAvailEUR; ?>">
						<div class="product-available">
							<div class="form">
								<select class="product-variation input-text hide">
									<option value="<?php echo $productSKU; ?>" title="<?php the_title(); ?>" class="selectable-option" data-avail-us="<?php echo $productAvailUS; ?>" data-avail-ca="<?php echo $productAvailCA; ?>" data-avail-eur="<?php echo $productAvailEUR; ?>"><?php the_title(); ?></option>
								</select><button class="add-to-cart btn-submit visible">Add to Cart</button>
							</div><!-- .form -->
							<div class="loading hidden"></div>
							<div class="failure hidden">
								<p class="small">There has been an error adding the item to your cart. Try again later or <a href="/contact/">contact us</a> if the problem persists.</p>
							</div><!-- .failure -->
						</div><!-- .product-available -->
						<div class="product-unavailable">
							<p>Item is currently not available online.</p>
						</div><!-- .product-unavailable -->
						<div class="dealer-link">
							<a href="/dealer-locator/" class="h5">Find a dealer</a>
						</div>
						<div class="shopatron-secure">
							<img src="<?php echo get_template_directory_uri(); ?>/_/img/shopatron-secure-logo.png" alt="Shopatron Secure"/>
						</div>
					</div><!-- .product-buy -->
					<ul class="product-share">
						<li class="facebook"><div class="fb-like" data-href="<? the_permalink(); ?>" data-layout="button" data-action="like" data-share="false" data-show-faces="false" data-colorscheme="light"></div></li>
						<li class="twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-via="GNUsnowboards" data-count="none">Tweet</a></li>
						<li class="g-plus"><div class="g-plusone" data-size="tall" data-annotation="none" data-href="<? the_permalink(); ?>"></div></li>
						<li class="pinterest"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" data-pin-do="buttonPin" data-pin-config="none" data-pin-color="white"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_white_20.png" alt="Pin It" /></a></li>
					</ul><!-- .product-share -->
				</div><!-- .section-content -->
			</section><!-- product-main -->
			<nav class="product-navigation">
				<div class="nav-container">
					<ul>
						<?php if (get_field('gnu_product_video')) : ?>
						<li><a href="#information" class="h3 info">Info<span class="nav-icon"></span></a></li>
						<li><a href="#video" class="h3 video">Video<span class="nav-icon"></span></a></li>
						<?php endif; ?>
					</ul>
					<div class="clearfix"></div>
				</div><!-- .nav-container -->
			</nav><!-- .product-navigation -->
			<section id="information">
				<div class="product-info">
					<div class="section-wrapper">
						<div class="section-content">
							<?php the_content(); ?>
							<div class="clearfix"></div>
						</div><!-- .section-content -->
					</div><!-- .section-wrapper -->
				</div><!-- .product-info -->
			</section><!-- #information -->

			<?php include get_template_directory() . '/_/inc/modules/photo-slider.php'; ?>

			<?php
				// display video if we have an id
				$videoID = get_field('gnu_product_video');
				if( $videoID ):
			?>
			<section id="video">
				<div class="product-video">
					<div class="section-content">
						<div class="video-wrapper">
							<iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100&amp;loop=1" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						</div>
					</div>
				</div><!-- .product-video -->
			</section><!-- #video -->
			<?php
				endif;
			?>

			<?php comments_template(); ?>

			<?php include get_template_directory() . '/_/inc/modules/featured-products.php'; ?>

<?php
	endwhile; endif;
	get_footer();
?>