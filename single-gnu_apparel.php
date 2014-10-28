<?php
/*
Template Name: Apparel Detail
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		// set up apparel
		$apparelVariations = Array();
		$apparelImages = Array();
		$productAvailUS = "No";
		$productAvailCA = "No";
		$productAvailEUR = "No";
		// get variation values
		if (get_field('gnu_apparel_variations')) :
			while(the_repeater_field('gnu_apparel_variations')):
				$optionSize = get_sub_field('gnu_apparel_variations_size');
				$optionColor = get_sub_field('gnu_apparel_variations_color');
				$optionSKU = get_sub_field('gnu_apparel_variations_sku');
				// grab availability
				$optionAvailUS = get_sub_field('gnu_apparel_variations_availability_us');
				$optionAvailCA = get_sub_field('gnu_apparel_variations_availability_ca');
				$optionAvailEUR = get_sub_field('gnu_apparel_variations_availability_eur');
				if($optionAvailUS == "Yes") $productAvailUS = "Yes";
				if($optionAvailCA == "Yes") $productAvailCA = "Yes";
				if($optionAvailEUR == "Yes") $productAvailEUR = "Yes";
				array_push($apparelVariations, Array('size' => $optionSize, 'color' => $optionColor, 'sku' => $optionSKU, 'availUS' => $optionAvailUS, 'availCA' => $optionAvailCA, 'availEUR' => $optionAvailEUR));
			endwhile;
		endif;
		// get images
		if (get_field('gnu_apparel_images')) :
			while (the_repeater_field('gnu_apparel_images')) :
				$apparelImage = get_sub_field('gnu_apparel_images_img');
				$apparelColor = get_sub_field('gnu_apparel_images_color');
				array_push($apparelImages, Array('image' => $apparelImage, 'color' => $apparelColor));
			endwhile;
		endif;
?>

			<section class="product-main">
				<div class="section-content">
					<h1 class="product-title"><?php the_title(); ?></h1>
					<h5 class="product-slogan"><?php the_field('gnu_product_slogan'); ?></h5>
					<div class="product-images">
						<div class="image-list owl-carousel owl-theme">

							<?php foreach ($apparelImages as $apparelImage) : ?>

							<div class="product-image">
								<a href="<?php echo $apparelImage['image']['url']; ?>" title="<?php the_title(); ?> - <?php echo $apparelImage['color']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-product-detail.gif" data-src="<?php echo $apparelImage['image']['url']; ?>" alt="<?php the_title(); ?> - <?php echo $apparelImage['color']; ?>" class="owl-lazy" /></a>
							</div><!-- .product-image -->

							<?php endforeach; ?>
							
						</div><!-- .image-list -->
						<div class="zoom-icon"></div>
					</div><!-- .product-images -->
					<?php
						// Build String of Sizes
						$sizes = Array();
						foreach ($apparelVariations as $apparelVariation) :
							if (!in_array($apparelVariation['size'], $sizes)) {
								array_push($sizes, $apparelVariation['size']);
							}
						endforeach;
						// setup sizes text display
						$sizesString = "";
						for ($i = 0; $i < count($sizes); $i++) {
							$sizesString .= ' <span>' . $sizes[$i] . '</span> ';
						}
					?>

					<div class="product-sizes">
						<p class="small"><span class="size-title">SIZES</span> <?php echo $sizesString; ?></p>
					</div><!-- product-sizes -->
					<div class="product-thumbnails">
						<div class="image-list owl-carousel">
							<?php
							foreach ($apparelImages as $apparelImage) :
								// determine skus associated with apparel images color
								$skus = "";
								for ($i = 0; $i < count($apparelVariations); $i++) :
									if ($apparelVariations[$i]['color'] == $apparelImage['color']) {
										$skus .= $apparelVariations[$i]['sku'];
										// add comas except last item
										if($i < count($apparelVariations) - 1){
											$skus .= ", ";
										}
									}
								endfor;
							?>
							
							<div class="product-thumbnail">
								<a href="<?php echo $apparelImage['image']['url']; ?>" title="<?php the_title(); ?> - <?php echo $apparelImage['color']; ?>" data-sku="<?php echo $skus; ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-apparel.png" data-src="<?php echo $apparelImage['image']['sizes']['medium']; ?>" alt="<?php the_title(); ?> - <?php echo $apparelImage['color']; ?>" class="owl-lazy" /><p class="small"><?php echo $apparelImage['color']; ?></p></a>
							</div><!-- .product-image -->

							<?php endforeach; ?>
						</div>
					</div><!-- product-thumbnails -->
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
								<select class="product-variation input-text">
									<option value="-1">Select a Size</option>
									<?php foreach ($apparelVariations as $apparelVariation) : // render out apparel dropdown ?>
									<option value="<?php echo $apparelVariation['sku']; ?>" title="<?php echo $apparelVariation['color'] . ' - ' . $apparelVariation['size']; ?>" class="selectable-option" data-avail-us="<?php echo $apparelVariation['availUS']; ?>" data-avail-ca="<?php echo $apparelVariation['availCA']; ?>" data-avail-eur="<?php echo $apparelVariation['availEUR']; ?>"><?php echo $apparelVariation['color'] . ' - ' . $apparelVariation['size']; ?></option>
									<?php endforeach; ?>
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