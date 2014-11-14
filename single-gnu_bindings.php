<?php
/*
Template Name: Bindings Detail
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		// set up bindings
		$bindings = Array();
		$bindingOptions = Array();
		$productAvailUS = "No";
		$productAvailCA = "No";
		$productAvailEUR = "No";
		if(get_field('gnu_binding_options')):
			while(the_repeater_field('gnu_binding_options')):
				$optionName = get_sub_field('gnu_binding_options_color');
				$optionImage = get_sub_field('gnu_binding_options_img');
				// get variations
				$optionVariations = get_sub_field('gnu_binding_options_variations');
				$optionVariationSizes = "";
				$optionVariationSKUs = "";
				// loop through variations
				if ($optionVariations) :
					for ($i = 0; $i < count($optionVariations); $i++) {
						$variationSize = $optionVariations[$i]['gnu_binding_options_variations_size'];
						$variationSKU = $optionVariations[$i]['gnu_binding_options_variations_sku'];
						$optionVariationSizes .= $variationSize;
						$optionVariationSKUs .= $variationSKU;
						// add comas except last item
						if($i < count($optionVariations)-1){
							$optionVariationSizes .= ", ";
							$optionVariationSKUs .= ", ";
						}
						// grab availability
						$variationAvailUS = $optionVariations[$i]['gnu_binding_options_variations_availability_us'];
						$variationAvailCA = $optionVariations[$i]['gnu_binding_options_variations_availability_ca'];
						$variationAvailEUR = $optionVariations[$i]['gnu_binding_options_variations_availability_eur'];
						if($variationAvailUS == "Yes") $productAvailUS = "Yes";
						if($variationAvailCA == "Yes") $productAvailCA = "Yes";
						if($variationAvailEUR == "Yes") $productAvailEUR = "Yes";
						array_push($bindings, Array('name' => $optionName, 'size' => $variationSize, 'sku' => $variationSKU, 'availUS' => $variationAvailUS, 'availCA' => $variationAvailCA, 'availEUR' => $variationAvailEUR));
					}
				endif;
				array_push($bindingOptions, Array('name' => $optionName, 'image' => $optionImage, 'sizes' => $optionVariationSizes, 'skus' => $optionVariationSKUs));
			endwhile;
		endif;
?>

			<section class="product-main">
				<div class="section-content">
					<h1 class="product-title"><?php the_title(); ?></h1>
					<h5 class="product-slogan"><?php the_field('gnu_product_slogan'); ?></h5>
					<div class="product-images">
						<div class="image-list owl-carousel owl-theme">

							<?php foreach ($bindingOptions as $bindingOption) : if ($bindingOption['image']) : ?>

							<div class="product-image">
								<a href="<?php echo $bindingOption['image']['url']; ?>" title="<?php the_title(); ?> - <?php echo $bindingOption['sizes']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-product-detail.gif" data-src="<?php echo $bindingOption['image']['url']; ?>" alt="<?php the_title(); ?> - <?php echo $bindingOption['sizes']; ?>" class="owl-lazy" /></a>
							</div><!-- .product-image -->

							<?php endif; endforeach; ?>
							
						</div><!-- .image-list -->
						<div class="zoom-icon"></div>
					</div><!-- .product-images -->
					<?php
						// Build String of Sizes
						$sizes = Array();
						foreach ($bindings as $binding) :
							if (!in_array($binding['size'], $sizes)) {
								array_push($sizes, $binding['size']);
							}
						endforeach;
						// sort sizes
						function bindingSizeSort ($a, $b) {
							$sizeIndexes = array(
								"XS (US 1-4)" => 0,
								"S (US W 5-7)" => 1,
								"S (US M 6-8 – US W 7-9)" => 2,
								"S (US M 4-7)" => 3,
								"S/M (US W 4-7)" => 4,
								"S/M (US M 5-9)" => 5,
								"M (US W 7-9)" => 6,
								"M (US M 7-9)" => 7,
								"M (US M 8.5-11 – US W 9.5+)" => 8,
								"M (US M 7-10)" => 9,
								"M/L (US W 6-9)" => 10,
								"M/L (US M 9-14)" => 11,
								"L (US W 9-10)" => 12,
								"L (US M 9-11)" => 13,
								"L (US M 9-12)" => 14,
								"L (US M 11.5-13)" => 15,
								"XL (US M 11-14)" => 16
							);
							$aSize = $sizeIndexes[$a];
							$bSize = $sizeIndexes[$b];
							if ($aSize == $bSize) {
								return 0;
							}
							return ($aSize > $bSize) ? 1 : -1;
						}
						usort($sizes, "bindingSizeSort");
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
							<?php foreach ($bindingOptions as $bindingOption) : if ($bindingOption['image']) :?>
							
							<div class="product-thumbnail">
								<a href="<?php echo $bindingOption['image']['url']; ?>" title="<?php echo $bindingOption['name']; ?> - <?php echo $bindingOption['sizes']; ?>" data-sku="<?php echo $bindingOption['skus']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-binding.png" data-src="<?php echo $bindingOption['image']['sizes']['medium']; ?>" alt="<?php echo $bindingOption['name']; ?> - <?php echo $bindingOption['sizes']; ?>" class="owl-lazy" /><p class="small"><?php echo $bindingOption['name']; ?></p></a>
							</div><!-- .product-image -->

							<?php endif; endforeach; ?>
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

						<div class="product-price special">
							<?php echo getPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_price_eur'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
						</div><!-- .product-price -->
					</div><!-- .product-awards-price -->
					<div class="product-buy" data-avail-us="<?php echo $productAvailUS; ?>" data-avail-ca="<?php echo $productAvailCA; ?>" data-avail-eur="<?php echo $productAvailEUR; ?>">
						<div class="product-available">
							<div class="form">
								<select class="product-variation input-text">
									<option value="-1">Select a Size</option>
									<?php foreach ($bindings as $binding) : // render out bindings dropdown ?>
									<option value="<?php echo $binding['sku']; ?>" title="<?php echo $binding['name']; ?>" class="selectable-option" data-avail-us="<?php echo $binding['availUS']; ?>" data-avail-ca="<?php echo $binding['availCA']; ?>" data-avail-eur="<?php echo $binding['availEUR']; ?>"><?php echo $binding['name'] . ' - ' . bindingSizeLookup($binding['size'], false); ?></option>
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
						<li><a href="#information" class="h4 info">Info<span class="nav-icon"></span></a></li>
						<li><a href="#technology" class="h4 tech">Tech<span class="nav-icon"></span></a></li>
						<?php if (get_field('gnu_product_video')) : ?><li><a href="#video" class="h4 video">Video<span class="nav-icon"></span></a></li><?php endif; ?>
					</ul>
					<div class="clearfix"></div>
				</div><!-- .nav-container -->
			</nav><!-- .product-navigation -->
			<section id="information">
				<div class="product-info">
					<div class="section-wrapper">
						<div class="section-content">
							<?php
								the_content();
								// get binding ratings
								$flex = get_field('gnu_binding_flex');
								$response = get_field('gnu_binding_response');
								$terrain = get_field('gnu_binding_terrain');
								// find the associated tax associated with binding
								$taxTerms = get_the_terms($post->ID, 'gnu_bindings_categories');
								$categorySlugs = Array();
								foreach( $taxTerms as $term ) {
									array_push($categorySlugs, $term->slug);
								}
								// figure out gender for image name
								if (in_array('womens', $categorySlugs, true)) {
									$bindingAnimationGender = "womens";
								} else {
									$bindingAnimationGender = "mens";
								}
							?>

							<div class="binding-chart">
								<ul>
									<li class="clearfix">
										<h3>Flex</h3>
										<img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/bindings/gnu-binding-flex-<?php echo $flex; ?>.png" alt="Flex Rating" class="lazy" />
									</li>
									<li class="clearfix">
										<h3>Response</h3>
										<img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/bindings/gnu-binding-response-<?php echo $response; ?>.png" alt="Response Rating" class="lazy" />
									</li>
									<li class="clearfix">
										<h3>Terrain</h3>
										<img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/bindings/gnu-binding-terrain-<?php echo $terrain; ?>.png" alt="Terrain Rating" class="lazy" />
									</li>
								</ul>
							</div><!-- .binding-chart -->

							<?php if (get_field('gnu_binding_type') == "Rear Entry") : ?>
							
							<div class="binding-animation">
								<div class="binding-steps owl-carousel owl-theme">
									<div class="binding-step">
										<img src="<?php echo get_template_directory_uri(); ?>/_/img/bindings/gnu-binding-sequence-<?php echo $bindingAnimationGender; ?>-1.png" data-src="<?php echo get_template_directory_uri(); ?>/_/img/bindings/gnu-binding-sequence-<?php echo $bindingAnimationGender; ?>-1.png" alt="Easy Rider" class="owl-lazy" />
										<h4>Easy Rider</h4>
										<p class="small">Speed entry binding systems. Lightweight, performance and strength in an incredibly fast binding system.</p>
									</div><!-- .binding-step -->
									<div class="binding-step">
										<img src="<?php echo get_template_directory_uri(); ?>/_/img/bindings/gnu-binding-sequence-<?php echo $bindingAnimationGender; ?>-1.png" data-src="<?php echo get_template_directory_uri(); ?>/_/img/bindings/gnu-binding-sequence-<?php echo $bindingAnimationGender; ?>-2.png" alt="Reclining Highback" class="owl-lazy" />
										<h4>Reclining Highback</h4>
										<p class="small">Makes entry and exit incredibly fast and easy with one hand! No more fumbling with ratchet buckles and ladders.</p>
									</div><!-- .binding-step -->
									<div class="binding-step">
										<img src="<?php echo get_template_directory_uri(); ?>/_/img/bindings/gnu-binding-sequence-<?php echo $bindingAnimationGender; ?>-1.png" data-src="<?php echo get_template_directory_uri(); ?>/_/img/bindings/gnu-binding-sequence-<?php echo $bindingAnimationGender; ?>-3.png" alt="Auto Open Lever" class="owl-lazy" />
										<h4>Auto Open Lever</h4>
										<p class="small">Auto Open Lever opens strap automatically when highback is lowered. Close easily with one click. Magic!</p>
									</div><!-- .binding-step -->
									<div class="binding-step">
										<img src="<?php echo get_template_directory_uri(); ?>/_/img/bindings/gnu-binding-sequence-<?php echo $bindingAnimationGender; ?>-1.png" data-src="<?php echo get_template_directory_uri(); ?>/_/img/bindings/gnu-binding-sequence-<?php echo $bindingAnimationGender; ?>-4.png" alt="Micro Buckle" class="owl-lazy" />
										<h4>Micro Buckle</h4>
										<p class="small">With the Micro Buckle a rider can easily adjust strap tension on the go.</p>
									</div><!-- .binding-step -->
									<div class="binding-step">
										<img src="<?php echo get_template_directory_uri(); ?>/_/img/bindings/gnu-binding-sequence-<?php echo $bindingAnimationGender; ?>-1.png" data-src="<?php echo get_template_directory_uri(); ?>/_/img/bindings/gnu-binding-sequence-<?php echo $bindingAnimationGender; ?>-5.png" alt="Pressure Relief Button" class="owl-lazy" />
										<h4>Pressure Relief Button</h4>
										<p class="small">Relief Button can be pressed to relax ankle strap pressure and increase circulation on your front foot.</p>
									</div><!-- .binding-step -->
								</div><!-- .binding-steps -->
							</div><!-- .binding-animation -->

							<?php endif; ?>

							<div class="clearfix"></div>
						</div><!-- .section-content -->
					</div><!-- .section-wrapper -->
				</div><!-- .product-info -->
			</section><!-- #information -->

			<?php include get_template_directory() . '/_/inc/modules/photo-slider.php'; ?>

			<section id="technology">
				<div class="product-technology">
					<div class="section-content">
						<h2 class="h1">Weird Science</h2>

						<?php // grab technology if there is any
						$technology = get_field('gnu_product_technology');
						if( $technology ):
							$technologyMajor = Array();
							$technologyMinor = Array();
							foreach( $technology as $techItem):
								$title = get_the_title($techItem->ID);
								$content = $techItem->post_content;
								$image = get_field("gnu_technology_icon", $techItem->ID);
								if ($image) {
									array_push($technologyMajor, Array('title' => $title, 'content' => $content, 'image' => $image));
								} else {
									array_push($technologyMinor, Array('title' => $title, 'content' => $content));
								}
							endforeach;
							// CHECK IF WE SHOULD DISPLAY MAJOR TECHNOLOGY
							if (count($technologyMajor) > 0) :
						?>

						<ul class="tech-major clearfix">
							<?php foreach( $technologyMajor as $techItem): ?>

							<li class="clearfix">
								<h3 class="title"><?php echo $techItem['title']; ?></h3>
								<img src="<?php echo $techItem['image']['url']; ?>" alt="<?php echo $techItem['title']; ?> Icon" class="icon" />
								<p class="description small"><?php echo $techItem['content']; ?></p>
							</li>

							<?php endforeach; ?>
						</ul><!-- .tech-major -->

						<?
							endif; // end tech major check
							// CHECK IF WE SHOULD DISPLAY MINOR TECHNOLOGY
							if (count($technologyMinor) > 0) :
						?>

						<ul class="tech-minor clearfix">
							<?php foreach( $technologyMinor as $techItem): ?>

							<li>
								<h3 class="title"><?php echo $techItem['title']; ?></h3>
								<p class="description small"><?php echo $techItem['content']; ?></p>
							</li>

							<?php endforeach; ?>
						</ul><!-- .tech-minor -->

						<?
							endif; // end tech minor check
						endif;// end technology check
						?>

					</div><!-- .section-content -->
				</div><!-- .product-technology -->
			</section><!-- #technology -->

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