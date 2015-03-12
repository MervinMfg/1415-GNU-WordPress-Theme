<?php
/*
Template Name: Accessories Detail
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$productSKU = get_field('gnu_accessory_sku');
		// grab availability
		$productAvailUS = "No";
		$productAvailCA = "No";
		$productAvailEUR = "No";
		// grab availability overwrite
		$optionAvailUS = get_field('gnu_accessory_availability_us');
		$optionAvailCA = get_field('gnu_accessory_availability_ca');
		$optionAvailEUR = get_field('gnu_accessory_availability_eur');
		// check availability based on overrides in WP Admin
		switch ($optionAvailUS) {
			case "Inventory":
				$optionAvailUS = getProductAvailability($productSKU, 'US');
				break;
			case "Yes":
				$optionAvailUS = Array('amount' => "Yes");
				break;
			case "No":
				$optionAvailUS = Array('amount' => "No");
				break;
			default:
				$optionAvailUS = getProductAvailability($productSKU, 'US');
		}
		switch ($optionAvailCA) {
			case "Inventory":
				$optionAvailCA = getProductAvailability($productSKU, 'CA');
				break;
			case "Yes":
				$optionAvailCA = Array('amount' => "Yes");
				break;
			case "No":
				$optionAvailCA = Array('amount' => "No");
				break;
			default:
				$optionAvailCA = getProductAvailability($productSKU, 'CA');
		}
		switch ($optionAvailEUR) {
			case "Inventory":
				$optionAvailEUR = getProductAvailability($productSKU, 'EU');
				break;
			case "Yes":
				$optionAvailEUR = Array('amount' => "Yes");
				break;
			case "No":
				$optionAvailEUR = Array('amount' => "No");
				break;
			default:
				$optionAvailEUR = getProductAvailability($productSKU, 'EU');
		}
		if($optionAvailUS['amount'] > 0 || $optionAvailUS['amount'] == "Yes") $productAvailUS = "Yes";
		if($optionAvailCA['amount'] > 0 || $optionAvailCA['amount'] == "Yes") $productAvailCA = "Yes";
		if($optionAvailEUR['amount'] > 0 || $optionAvailEUR['amount'] == "Yes") $productAvailEUR = "Yes";
?>
			<div class="schema-wrapper" itemscope itemtype="http://schema.org/Product">
				<section class="product-main">
					<div class="section-content">
						<h1 class="product-title" itemprop="name"><?php the_title(); ?></h1>
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
								<meta itemprop="image" content="<?php echo $productImage['url']; ?>" />
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

							<div class="product-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
								<?php echo getPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_price_eur'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
								<link itemprop="itemCondition" href="http://schema.org/NewCondition" />
							</div><!-- .product-price -->
						</div><!-- .product-awards-price -->
						<div class="product-buy" data-avail-us="<?php echo $productAvailUS; ?>" data-avail-ca="<?php echo $productAvailCA; ?>" data-avail-eur="<?php echo $productAvailEUR; ?>">
							<div class="product-available">
								<div class="form">
									<select class="product-variation input-text hide">
										<option value="<?php echo $productSKU; ?>" title="<?php the_title(); ?>" class="selectable-option" data-avail-us="<?php echo $optionAvailUS['amount']; ?>" data-avail-ca="<?php echo $optionAvailCA['amount']; ?>" data-avail-eur="<?php echo $optionAvailEUR['amount']; ?>"><?php the_title(); ?></option>
									</select><button class="add-to-cart btn-submit visible">Add to Cart</button>
								</div><!-- .form -->
								<div class="loading hidden"></div>
								<div class="failure hidden">
									<p class="small">There has been an error adding the item to your cart. Try again later or <a href="/support/contact/">contact us</a> if the problem persists.</p>
								</div><!-- .failure -->
								<div class="available-alert">
									<p class="small low-inventory"><span>Product Alert:</span> Currently less than 10 available.</p>
									<p class="small no-inventory"><span>Product Alert:</span> We are currently out of stock on this item in our warehouse, but we can check with our dealer network to see if they can fulfill this order.</p>
								</div><!-- .available-alert -->
							</div><!-- .product-available -->
							<div class="product-unavailable">
								<p>Item is currently not available online.</p>
							</div><!-- .product-unavailable -->
							<div class="dealer-link">
								<a href="/store-locator/" class="h5">Find a store</a>
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
							<li><a href="#information" class="h4 info">Info<span class="nav-icon"></span></a></li>
							<li><a href="#video" class="h4 video">Video<span class="nav-icon"></span></a></li>
							<?php endif; ?>
						</ul>
						<div class="clearfix"></div>
					</div><!-- .nav-container -->
				</nav><!-- .product-navigation -->
				<section id="information">
					<div class="product-info">
						<div class="section-wrapper">
							<div class="section-content" itemprop="description">
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
