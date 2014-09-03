<?php
/*
Template Name: Snowboards Detail Template
*/

	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$thePostID = $post->ID;
		$slug = $post->post_name;
		// find the associated tax associated with post
		$taxTerms = get_the_terms($thePostID, 'gnu_snowboard_categories');

		// display video if we have an id
		$videoID = get_field('gnu_product_video');
		if( $videoID ){
			$productImagesClass = " video";
		} else {
			$productImagesClass = "";
		}
		// set up snowboards
		$snowboards = Array();
		$snowboardOptions = Array();
		$productAvailUS = "No";
		$productAvailCA = "No";
		$productAvailEUR = "No";

		if(get_field('gnu_snowboard_options')):
			while(the_repeater_field('gnu_snowboard_options')):
				$optionName = get_sub_field('gnu_snowboard_options_name');
				$optionImage = get_sub_field('gnu_snowboard_options_img');
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
				array_push($snowboardOptions, Array('image' => $optionImage, 'name' => $optionName, 'sizes' => $optionVariationSizes, 'skus' => $optionVariationSKUs));
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
						<div class="image-list owl-carousel">

							<?php foreach ($snowboardOptions as $snowboardOption) : if ($snowboardOption['image']) : ?>

							<div class="product-image">
								<a href="<?php echo $snowboardOption['image']['url']; ?>" title="<?php the_title(); ?> - <?php echo $snowboardOption['sizes']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo $snowboardOption['image']['sizes']['medium']; ?>" alt="<?php the_title(); ?> - <?php echo $snowboardOption['sizes']; ?>" class="owl-lazy" /></a>
							</div><!-- .product-image -->

							<?php endif; endforeach; ?>
							
						</div><!-- .image-list -->
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
							<?php foreach ($snowboardOptions as $snowboardOption) : if ($snowboardOption['image']) :?>
							
							<div class="product-thumbnail">
								<a href="<?php echo $snowboardOption['image']['url']; ?>" title="<?php echo $snowboardOption['name']; ?> - <?php echo $snowboardOption['sizes']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo $snowboardOption['image']['sizes']['medium']; ?>" alt="<?php echo $snowboardOption['name']; ?> - <?php echo $snowboardOption['sizes']; ?>" class="owl-lazy" /></a>
							</div><!-- .product-image -->

							<?php endif; endforeach; ?>
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

						<div class="product-price">
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
								</select><button class="btn-submit visible">Add to Cart</button>
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
						<li><a href="#information" class="h3 info">Info<span class="nav-icon"></span></a></li>
						<li><a href="#technology" class="h3 tech">Tech<span class="nav-icon"></span></a></li>
						<?php if (get_field('gnu_product_video')) : ?><li><a href="#video" class="h3 video">Video<span class="nav-icon"></span></a></li><?php endif; ?>
						<li><a href="#specifications" class="h3 specs">Specs<span class="nav-icon"></span></a></li>
					</ul>
					<div class="clearfix"></div>
				</div><!-- .nav-container -->
			</nav><!-- .product-navigation -->
			<section id="information" class="product-info">
				<div class="section-wrapper">
					<div class="section-content">
						<?php the_content(); ?>
						<div class="clearfix"></div>
					</div><!-- .section-content -->
				</div><!-- .section-wrapper -->
			</section><!-- #information -->

			<?php include get_template_directory() . '/_/inc/modules/photo-slider.php'; ?>

			<section id="technology" class="product-technology">
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
			</section><!-- #technology -->

			<?php
				// display video if we have an id
				$videoID = get_field('gnu_product_video');
				if( $videoID ):
			?>
			<section id="video" class="product-video">
				<div class="section-content">
					<div class="video-wrapper">
						<iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					</div>
				</div>
			</section><!-- #video -->
			<?php
				endif;
			?>

			<section id="specifications" class="product-specifications">
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
			</section><!-- #specifications -->

			<?php include get_template_directory() . '/_/inc/modules/featured-products.php'; ?>

			<?php comments_template(); ?>

<?php
		endwhile;
	endif;
	get_footer();
?>