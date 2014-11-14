<?php
/*
Template Name: Snowboards Detail
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		// set up snowboards
		$snowboards = Array();
		$snowboardOptions = Array();
		$productAvailUS = "No";
		$productAvailCA = "No";
		$productAvailEUR = "No";
		if(get_field('gnu_snowboard_options')):
			while(the_repeater_field('gnu_snowboard_options')):
				$optionName = get_sub_field('gnu_snowboard_options_name');
				// get variations
				$optionVariations = get_sub_field('gnu_snowboard_options_variations');
				$optionVariationSizes = "";
				$optionVariationSKUs = "";
				// loop through variations
				if ($optionVariations) :
					for ($i = 0; $i < count($optionVariations); $i++) {
						$variationWidth = $optionVariations[$i]['gnu_snowboard_options_variations_width'];
						$variationLength = $optionVariations[$i]['gnu_snowboard_options_variations_length'];
						$variationSKU = $optionVariations[$i]['gnu_snowboard_options_variations_sku'];
						// grab availability
						$variationAvailUS = $optionVariations[$i]['gnu_snowboard_options_variations_availability_us'];
						$variationAvailCA = $optionVariations[$i]['gnu_snowboard_options_variations_availability_ca'];
						$variationAvailEUR = $optionVariations[$i]['gnu_snowboard_options_variations_availability_eur'];
						if($variationAvailUS == "Yes") $productAvailUS = "Yes";
						if($variationAvailCA == "Yes") $productAvailCA = "Yes";
						if($variationAvailEUR == "Yes") $productAvailEUR = "Yes";
						// setup readable short form of length and width
						if($variationWidth == "Narrow"){
							$variationLength = $variationLength . "N";
						}else if($variationWidth == "Wide"){
							$variationLength = $variationLength . "W";
						}
						// set up sizes and skus list
						$optionVariationSizes .= $variationLength;
						$optionVariationSKUs .= $variationSKU;
						// add comas except last item
						if($i < count($optionVariations)-1){
							$optionVariationSizes .= ", ";
							$optionVariationSKUs .= ", ";
						}
						// setup variation name
						if($optionName != ""){
							$variationName = $variationLength . " - " . $optionName;
						} else {
							$variationName = $variationLength;
						}
						array_push($snowboards, Array('name' => $variationName, 'sku' => $variationSKU, 'availUS' => $variationAvailUS, 'availCA' => $variationAvailCA, 'availEUR' => $variationAvailEUR));
					}
				endif;
				$optionImages = Array();
				if(get_sub_field('gnu_snowboard_options_images')):
					while(the_repeater_field('gnu_snowboard_options_images')):
						$optionImage = get_sub_field('gnu_snowboard_options_images_img');
						array_push($optionImages, $optionImage);
					endwhile;
				endif;
				array_push($snowboardOptions, Array('images' => $optionImages, 'name' => $optionName, 'sizes' => $optionVariationSizes, 'skus' => $optionVariationSKUs));
			endwhile;
		endif;
		// sort by variation name
		asort($snowboards);				
?>

			<section class="product-main">
				<div class="section-content">
					<h1 class="product-title"><?php the_title(); ?></h1>
					<h5 class="product-slogan"><span><?php the_field('gnu_snowboard_contour'); ?></span> <?php the_field('gnu_product_slogan'); ?></h5>
					<div class="product-images">
						<div class="image-list owl-carousel owl-theme">

							<?php foreach ($snowboardOptions as $snowboardOption) : if ($snowboardOption['images']) : foreach ($snowboardOption['images'] as $snowboardImage) : ?>

							<div class="product-image">
								<a href="<?php echo $snowboardImage['url']; ?>" title="<?php the_title(); ?> - <?php echo $snowboardOption['sizes']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-product-detail.gif" data-src="<?php echo $snowboardImage['url']; ?>" alt="<?php the_title(); ?> - <?php echo $snowboardOption['sizes']; ?>" class="owl-lazy" /></a>
							</div><!-- .product-image -->

							<?php endforeach; endif; endforeach; ?>
							
						</div><!-- .image-list -->
						<div class="zoom-icon"></div>
					</div><!-- .product-images -->
					<?php
						// Build String of Sizes
						$normalSizes = Array();
						$midWideSizes = Array();
						$wideSizes = Array();
						if(get_field('gnu_snowboard_specs')):
							while(the_repeater_field('gnu_snowboard_specs')):
								$snowboardLength = get_sub_field('gnu_snowboard_specs_length');
								$snowboardWidth = get_sub_field('gnu_snowboard_specs_width');
								// add the proper width abbreviation if not standard
								if ($snowboardWidth == "Wide") {
									$snowboardLength = $snowboardLength . "W";
									array_push($wideSizes, $snowboardLength);
								} else if ($snowboardWidth == "Mid Wide") {
									$snowboardLength = $snowboardLength . "MW";
									array_push($midWideSizes, $snowboardLength);
								} else {
									array_push($normalSizes, $snowboardLength);
								}
							endwhile;
						endif;
						// sort sizes
						array_multisort($normalSizes, SORT_ASC);
						array_multisort($midWideSizes, SORT_ASC);
						array_multisort($wideSizes, SORT_ASC);
						// setup sizes text display
						$normalSizesString = "";
						for ($i = 0; $i < count($normalSizes); $i++) {
							$normalSizesString .= ' <span>' . $normalSizes[$i] . '</span> ';
						}
						$midWideSizesString = "";
						for ($i = 0; $i < count($midWideSizes); $i++) {
							$midWideSizesString .= ' <span>' . $midWideSizes[$i] . '</span> ';
						}
						$wideSizesString = "";
						for ($i = 0; $i < count($wideSizes); $i++) {
							$wideSizesString .= ' <span>' . $wideSizes[$i] . '</span> ';
						}
					?>

					<div class="product-sizes">
						<p class="small"><span class="size-title">SIZES</span> <?php echo $normalSizesString . $midWideSizesString . $wideSizesString; ?></p>
					</div><!-- product-sizes -->
					<div class="product-thumbnails">
						<div class="image-list owl-carousel">
							<?php foreach ($snowboardOptions as $snowboardOption) : if ($snowboardOption['images']) : foreach ($snowboardOption['images'] as $snowboardImage) : ?>
							
							<div class="product-thumbnail">
								<a href="<?php echo $snowboardImage['url']; ?>" title="<?php echo $snowboardOption['name']; ?> - <?php echo $snowboardOption['sizes']; ?>" data-sku="<?php echo $snowboardOption['skus']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-board-detail.png" data-src="<?php echo $snowboardImage['sizes']['medium']; ?>" alt="<?php echo $snowboardOption['name']; ?> - <?php echo $snowboardOption['sizes']; ?>" class="owl-lazy" /><p class="small"><?php echo $snowboardOption['name']; ?></p></a>
							</div><!-- .product-image -->

							<?php endforeach; endif; endforeach; ?>
						</div>
					</div><!-- product-thumbnails -->

					<?php
						if (get_field('gnu_snowboard_colorways')) {
							// check for base / colorway disclaimer
							if (in_array('Random Bases', get_field('gnu_snowboard_colorways'))) {
								echo '<p class="small product-note">Bases come in random colorways</p>';
							}
							if (in_array('Alternate Colorways', get_field('gnu_snowboard_colorways'))) {
								echo '<p class="small product-note">Alternate Colorways</p>';
							}
						}
					?>

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
									<?php foreach ($snowboards as $snowboard) : // render out snowboards dropdown ?>
									<option value="<?php echo $snowboard['sku']; ?>" title="<?php echo $snowboard['name']; ?>" class="selectable-option" data-avail-us="<?php echo $snowboard['availUS']; ?>" data-avail-ca="<?php echo $snowboard['availCA']; ?>" data-avail-eur="<?php echo $snowboard['availEUR']; ?>"><?php echo $snowboard['name']; ?></option>
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
						<li><a href="#specifications" class="h4 specs">Specs<span class="nav-icon"></span></a></li>
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
								if (get_field('gnu_snowboard_artists_name')) {
									echo '<h3><a href="' . get_field('gnu_snowboard_artists_url') . '" target="_blank">Art by ' . get_field('gnu_snowboard_artists_name') . '</a></h3>';
								}
							?>
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
				// display video or binding if we have an id
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
			</section>
			<?php endif; ?>

			<?php
				$bindings = get_field('gnu_snowboard_collab');
				if( $bindings ):
			?>
			<section id="collaboration">
				<div class="product-collab<?php if( $videoID ){ echo " video-active"; } ?>">
					<div class="section-content">
						<div class="collab-wrapper">
							<?php
								// get each related product
								foreach( $bindings as $binding):
									$postType = $binding->post_type;
									// check which image size to use based on post type
									$bindingImage = get_field('gnu_product_image', $binding->ID);
									$bindingLink = get_permalink($binding->ID);
									$bindingTitle = get_the_title($binding->ID);
									// render out co-lab product
							?>
							<a href="<?php echo $bindingLink; ?>" class="collab-link">
								<div class="collab-image">
									<img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo $bindingImage['sizes']['square-medium']; ?>" alt="<?php echo $bindingImage['alt']; ?>" class="lazy" />
								</div>
								<div class="collab-details">
									<h4>Co - Lab Binding</h4>
									<h3><?php echo $bindingTitle; ?></h3>
									<button class="btn-submit">Buy</button>
								</div>
								<div class="clearfix"></div>
							</a>
							<?php endforeach; ?>
						</div>
					</div>
				</div><!-- .product-collab -->
			</section>
			<?php endif; ?>

			<section id="specifications">
				<div class="product-specifications">
					<h3 class="specs-title">Sizing Information</h3>

					<?php
						$specs = Array();
						if(get_field('gnu_snowboard_specs')):
							while(the_repeater_field('gnu_snowboard_specs')):
								$snowboardLength = get_sub_field('gnu_snowboard_specs_length');
								$snowboardWidth = get_sub_field('gnu_snowboard_specs_width');
								if ($snowboardWidth == "Narrow") {
									$snowboardLength = $snowboardLength . "N";
								} else if ($snowboardWidth == "Mid Wide") {
									$snowboardLength = $snowboardLength . "MW";
								} else if($snowboardWidth == "Wide") {
									$snowboardLength = $snowboardLength . "W";
								}
								array_push($specs, Array(
									'length' => $snowboardLength,
									'contact' => get_sub_field('gnu_snowboard_specs_contact_length'),
									'sideCut' => get_sub_field('gnu_snowboard_specs_sidecut'),
									'noseWidth' => get_sub_field('gnu_snowboard_specs_nose_width'),
									'waistWidth' => get_sub_field('gnu_snowboard_specs_waist_width'),
									'tailWidth' => get_sub_field('gnu_snowboard_specs_tail_width'),
									'stance' => get_sub_field('gnu_snowboard_specs_stance_range'),
									'flex' => get_sub_field('gnu_snowboard_specs_flex_rating'),
									'weightRange' => get_sub_field('gnu_snowboard_specs_weight_range')
								));
							endwhile;
						endif;
					?>

					<nav class="spec-navigation">
						<ul>
							<?php foreach( $specs as $spec): ?>
							<li><a href="#board-<?php echo str_replace('.', '_', $spec['length']); ?>" class="h4"><?php echo $spec['length']; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</nav>
					<?php foreach( $specs as $spec): ?>
					<div id="board-<?php echo str_replace('.', '_', $spec['length']); ?>" class="spec-listing clearfix">
						<div class="group-1">
							<p><span class="spec-title">Contact</span> <span class="spec-value"><?php echo $spec['contact']; ?></span></p>
							<p><span class="spec-title">Side Cut</span> <span class="spec-value"><?php echo $spec['sideCut']; ?></span></p>
							<p><span class="spec-title">Nose Width</span> <span class="spec-value"><?php echo $spec['noseWidth']; ?></span></p>
						</div>
						<div class="group-2">
							<p><span class="spec-title">Waist Width</span> <span class="spec-value"><?php echo $spec['waistWidth']; ?></span></p>
							<p><span class="spec-title">Tail Width</span> <span class="spec-value"><?php echo $spec['tailWidth']; ?></span></p>
							<p><span class="spec-title">Stance<br /><span class="spec-small">Min-Max / Set Back</span></span> <span class="spec-value"><?php echo $spec['stance']; ?></span></p>
						</div>
						<div class="group-3">
							<p><span class="spec-title">Flex</span> <span class="spec-value"><?php echo $spec['flex']; ?></span></p>
							<p><span class="spec-title">Weight Range</span> <span class="spec-value"><?php echo $spec['weightRange']; ?> +</span></p>
						</div>
					</div>
					<?php endforeach; ?>
					<div class="specs-link-container">
						<a href="/snowboard-specifications/" class="all-specs-link" >All Board Specs</a>
					</div>
				</div><!-- .product-specifications -->
			</section><!-- #specifications -->

			<?php comments_template(); ?>

			<?php include get_template_directory() . '/_/inc/modules/featured-products.php'; ?>

<?php
	endwhile; endif;
	get_footer();
?>