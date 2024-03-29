<?php
/*
Template Name: Product Overview
*/
?>
<?php get_header(); ?>

			<?php if (get_the_title() == "Snowboards") : ?>
			<?php
				// Get Mens Snowboards
				$products = Array();
				$standardWidths = Array();
				$wideWidths = Array();
				$args = array(
					'post_type' => 'gnu_snowboards',
					'posts_per_page' => -1,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'tax_query' => array(
						array(
							'taxonomy' => 'gnu_snowboard_categories',
							'field' => 'slug',
							'terms' => array('mens', 'mens-splitboards', 'mens-youth'),
							'include_children' => false
						)
					)
				);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					$title = get_the_title();
					$url = get_the_permalink();
					$image = "";
					$detail = get_field('gnu_snowboard_contour');
					$price = getPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_price_eur'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') );
					$filterPrice = str_replace('.', '', get_field('gnu_product_price_us'));
					// start list of items to filter by
					$categoryFilters = "";
					$sizeFilters = "";
					$contourFilter = "(" . str_replace(array(' ', '!'), '_', $detail) . ")";
					// build filter list of categories
					$categories = get_the_terms( $post->ID , 'gnu_snowboard_categories' );
					foreach ( $categories as $category ) {
						$categoryFilters .= $category->slug . " ";
					}
					$availUS = "No";
					$availCA = "No";
					$availEUR = "No";
					$standardWidth = Array();
					$wideWidth = Array();
					$colorways = Array();
					if(get_field('gnu_snowboard_options')):
						while(the_repeater_field('gnu_snowboard_options')):
							if ($image == "") {
								$image = get_sub_field('gnu_snowboard_options_overview_img');
							}
							// get colorways
							$optionColor = get_the_title();
							if (get_sub_field('gnu_snowboard_options_name')) {
								$optionColor .= " " . get_sub_field('gnu_snowboard_options_name');
							}
							$optionSlug = str_replace(' ', '-', strtolower($optionColor));
							$optionSlug = str_replace('&#8243;', '', strtolower($optionSlug));
							$optionSlug = str_replace('ñ', 'n', strtolower($optionSlug));
							$optionSlug = str_replace('.', '_', strtolower($optionSlug));
							$optionSlug = 'snowboards/' . str_replace('/', '', strtolower($optionSlug));
							$optionImage = get_sub_field('gnu_snowboard_options_overview_img');
							array_push($colorways, Array('color' => $optionColor, 'slug' => $optionSlug, 'img' => $optionImage));
							// get variations
							$optionVariations = get_sub_field('gnu_snowboard_options_variations');
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
									$variationAvailEURAmount = getProductAvailability($variationSKU, 'EU');
									if($variationAvailUS != "No") $availUS = "Yes";
									if($variationAvailCA != "No") $availCA = "Yes";
									// snowboards in europe are handled as direct
									if($variationAvailEUR != "No" && $variationAvailEURAmount['amount'] > 0) $availEUR = "Yes";
									// setup readable short form of length and width
									if($variationWidth == "Standard"){
										$sizeFilters .= str_replace('.', '_', $variationLength) . " ";
										array_push($standardWidth, $variationLength);
										// add value to array if it does not exist
										if (!in_array($variationLength, $standardWidths)) {
											array_push($standardWidths, $variationLength);
										}
									}else if($variationWidth == "Wide" || $variationWidth == "Mid Wide"){
										$sizeFilters .= str_replace('.', '_', $variationLength) . "W ";
										array_push($wideWidth, $variationLength);
										// add value to array if it does not exist
										if (!in_array($variationLength, $wideWidths)) {
											array_push($wideWidths, $variationLength);
										}
									}
								}
							endif;
						endwhile;
					endif;
					array_multisort($standardWidths, SORT_ASC);
					array_multisort($wideWidths, SORT_ASC);
					array_push($products, Array('title' => $title, 'url' => $url, 'image' => $image, 'detail' => $detail, 'standardWidth' => $standardWidth, 'wideWidth' => $wideWidth, 'price' => $price, 'filterPrice' => $filterPrice, 'availUS' => $availUS, 'availCA' => $availCA, 'availEUR' => $availEUR, 'categoryFilters' => $categoryFilters, 'sizeFilters' => $sizeFilters, 'contourFilter' => $contourFilter, 'colorways' => $colorways));
				endwhile;
				wp_reset_query();
			?>
			<section id="mens-snowboards" class="product-overview deeplink-top-fix">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Men's Snowboards</h2>
						<h5 class="subtitle">Innovation Creation Since 1977</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign large"><a href="#womens-snowboards">View Women's</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-1"></div>
				</header>
				<div class="product-utility">
					<div class="product-filters">
						<div class="filter-controls">
							<button class="btn-open">Board Filters<span></span></button>
							<button class="btn-close"></button>
							<div class="btn-wrapper categories">
								<button class="btn-filter">Categories</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
							<div class="btn-wrapper contours">
								<button class="btn-filter">Contours</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
							<div class="btn-wrapper sizes">
								<button class="btn-filter">Sizes</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
							<div class="btn-wrapper pricing">
								<button class="btn-filter">Pricing</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
						</div><!-- .filter-collection -->
						<div class="filter-collection categories">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="asymmetric">Asymmetric</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="club-collection">Club Collection</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="splitboard">Splitboard</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="youth">Youth</button></li>
							</ul>
						</div><!-- .filter-collection -->
						<div class="filter-collection contours">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="(BTX)">BTX</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="(EC2_BTX)">EC2 BTX</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="(C2_BTX)">C2 BTX</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="(XC2_BTX)">XC2 BTX</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="(C3_BTX)">C3 BTX</button></li>
							</ul>
						</div><!-- .filter-collection -->
						<div class="filter-collection sizes">
							<button class="btn-size-group standard-width">Standard</button>
							<button class="btn-size-group wide-width">Wide</button>
							<ul class="filter-list standard-widths">
								<?php foreach ($standardWidths as $length) : ?>
								<li class="filter-item"><button class="btn-option" data-filter="<?php echo str_replace('.', '_', $length); ?>"><?php echo $length; ?></button></li>
								<?php endforeach; ?>
							</ul>
							<ul class="filter-list wide-widths">
								<?php foreach ($wideWidths as $length) : ?>
								<li class="filter-item"><button class="btn-option" data-filter="<?php echo str_replace('.', '_', $length) . "W"; ?>"><?php echo $length; ?></button></li>
								<?php endforeach; ?>
							</ul>
						</div><!-- .filter-collection -->
						<div class="filter-collection pricing">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="Low">Low - High</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="High">High - Low</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="Available">Available</button></li>
							</ul>
						</div><!-- .filter-collection -->
					</div><!-- .product-filters -->
					<div class="instructions"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/carousel-instructions-snowboards.gif" alt="Click and Drag Boards" class="lazy" /></div>
				</div><!-- .product-utility -->
				<div class="product-list owl-carousel owl-theme">

					<?php foreach ($products as $product) : ?>

					<div class="product" data-categories="<?php echo $product['categoryFilters']; ?>" data-sizes="<?php echo $product['sizeFilters']; ?>" data-contour="<?php echo $product['contourFilter']; ?>" data-price="<?php echo $product['filterPrice']; ?>" data-avail-us="<?php echo $product['availUS']; ?>" data-avail-ca="<?php echo $product['availCA']; ?>" data-avail-eur="<?php echo $product['availEUR']; ?>">
						<a href="<?php echo $product['url']; ?>">
							<div class="info">
								<div class="vertical-center">
									<h4 class="name"><?php echo $product['title']; ?></h4>
									<p class="detail"><?php echo $product['detail']; ?></p>
									<?php echo $product['price']; if (count($product['colorways']) > 1) : ?>
									<div class="colorways">
										<?php foreach ($product['colorways'] as $colorway) : ?>
										<div class="swatch" data-src="<?php echo $colorway['img']['sizes']['medium']; ?>" title="<?php echo $colorway['color']; ?>"><img src="<?php bloginfo('template_directory'); ?>/_/img/colorways/<?php echo $colorway['slug']; ?>.jpg" alt="" /></div>
										<?php endforeach; ?>
									</div>
									<?php endif; ?>
								</div>
							</div>
							<?php if($product['image']): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-board.png" data-src="<?php echo $product['image']['sizes']['medium']; ?>" data-src-retina="<?php echo $product['image']['sizes']['large']; ?>"  alt="<?php $product['title']; ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div>

					<?php endforeach; ?>

				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->

			<?php
				// Get Womens Snowboards
				$products = Array();
				$lengths = Array();
				$wideWidths = Array();
				$args = array(
					'post_type' => 'gnu_snowboards',
					'posts_per_page' => -1,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'tax_query' => array(
						array(
							'taxonomy' => 'gnu_snowboard_categories',
							'field' => 'slug',
							'terms' => array('womens', 'womens-splitboards', 'womens-youth'),
							'include_children' => false
						)
					)
				);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					$title = get_the_title();
					$url = get_the_permalink();
					$image = "";
					$detail = get_field('gnu_snowboard_contour');
					$price = getPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_price_eur'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') );
					$filterPrice = str_replace('.', '', get_field('gnu_product_price_us'));
					// start list of items to filter by
					// create list and add contour
					$categoryFilters = "";
					$sizeFilters = "";
					$contourFilter = "(" . str_replace(array(' ', '!'), '_', $detail) . ")";
					// build filter list of categories
					$categories = get_the_terms( $post->ID , 'gnu_snowboard_categories' );
					foreach ( $categories as $category ) {
						$categoryFilters .= $category->slug . " ";
					}
					$availUS = "No";
					$availCA = "No";
					$availEUR = "No";
					$standardWidth = Array();
					$length = Array();
					$colorways = Array();
					if(get_field('gnu_snowboard_options')):
						while(the_repeater_field('gnu_snowboard_options')):
							if ($image == "") {
								$image = get_sub_field('gnu_snowboard_options_overview_img');
							}
							// get colorways
							$optionColor = get_the_title();
							if (get_sub_field('gnu_snowboard_options_name')) {
								$optionColor .= " " . get_sub_field('gnu_snowboard_options_name');
							}
							$optionSlug = str_replace(' ', '-', strtolower($optionColor));
							$optionSlug = str_replace('&#8243;', '', strtolower($optionSlug));
							$optionSlug = str_replace('ñ', 'n', strtolower($optionSlug));
							$optionSlug = str_replace('.', '_', strtolower($optionSlug));
							$optionSlug = 'snowboards/' . str_replace('/', '', strtolower($optionSlug));
							$optionImage = get_sub_field('gnu_snowboard_options_overview_img');
							array_push($colorways, Array('color' => $optionColor, 'slug' => $optionSlug, 'img' => $optionImage));
							// get variations
							$optionVariations = get_sub_field('gnu_snowboard_options_variations');
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
									$variationAvailEURAmount = getProductAvailability($variationSKU, 'EU');
									if($variationAvailUS != "No") $availUS = "Yes";
									if($variationAvailCA != "No") $availCA = "Yes";
									// snowboards in europe are handled as direct
									if($variationAvailEUR != "No" && $variationAvailEURAmount['amount'] > 0) $availEUR = "Yes";
									// setup readable short form of length and width
									$sizeFilters .= str_replace('.', '_', $variationLength) . " ";
									array_push($length, $variationLength);
									// add value to array if it does not exist
									if (!in_array($variationLength, $lengths)) {
										array_push($lengths, $variationLength);
									}
								}
							endif;
						endwhile;
					endif;
					array_multisort($lengths, SORT_ASC);
					array_multisort($length, SORT_ASC);
					array_push($products, Array('title' => $title, 'url' => $url, 'image' => $image, 'detail' => $detail, 'length' => $length, 'price' => $price, 'filterPrice' => $filterPrice, 'availUS' => $availUS, 'availCA' => $availCA, 'availEUR' => $availEUR, 'categoryFilters' => $categoryFilters, 'sizeFilters' => $sizeFilters, 'contourFilter' => $contourFilter, 'colorways' => $colorways));
				endwhile;
				wp_reset_query();
			?>
			<section id="womens-snowboards" class="product-overview deeplink-top-fix">
				<header class="product-header section-header alt">
					<div class="header-wrapper">
						<h2 class="title">Women's Snowboards</h2>
						<h5 class="subtitle">Gold Metal Technology To Make Magic On</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#mens-snowboards">View Men's</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-2"></div>
				</header>
				<div class="product-utility">
					<div class="product-filters">
						<div class="filter-controls">
							<button class="btn-open">Board Filters<span></span></button>
							<button class="btn-close"></button>
							<div class="btn-wrapper categories">
								<button class="btn-filter">Categories</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
							<div class="btn-wrapper contours">
								<button class="btn-filter">Contours</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
							<div class="btn-wrapper sizes">
								<button class="btn-filter">Sizes</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
							<div class="btn-wrapper pricing">
								<button class="btn-filter">Pricing</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
						</div><!-- .filter-collection -->
						<div class="filter-collection categories">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="asymmetric">Asymmetric</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="club-collection">Club Collection</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="splitboard">Splitboard</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="youth">Youth</button></li>
							</ul>
						</div><!-- .filter-collection -->
						<div class="filter-collection contours">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="(BTX)">BTX</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="(EC2_BTX)">EC2 BTX</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="(C2_BTX)">C2 BTX</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="(C3_BTX)">C3 BTX</button></li>
							</ul>
						</div><!-- .filter-collection -->
						<div class="filter-collection sizes womens">
							<ul class="filter-list standard-widths">
								<?php foreach ($lengths as $length) : ?>
								<li class="filter-item"><button class="btn-option" data-filter="<?php echo str_replace('.', '_', $length); ?>"><?php echo $length; ?></button></li>
								<?php endforeach; ?>
							</ul>
						</div><!-- .filter-collection -->
						<div class="filter-collection pricing">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="Low">Low - High</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="High">High - Low</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="Available">Available</button></li>
							</ul>
						</div><!-- .filter-collection -->
					</div><!-- .product-filters -->
					<div class="instructions"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/carousel-instructions-snowboards.gif" alt="Click and Drag Boards" class="lazy" /></div>
				</div><!-- .product-utility -->
				<div class="product-list owl-carousel owl-theme">

					<?php foreach ($products as $product) : ?>

					<div class="product" data-categories="<?php echo $product['categoryFilters']; ?>" data-sizes="<?php echo $product['sizeFilters']; ?>" data-contour="<?php echo $product['contourFilter']; ?>" data-price="<?php echo $product['filterPrice']; ?>" data-avail-us="<?php echo $product['availUS']; ?>" data-avail-ca="<?php echo $product['availCA']; ?>" data-avail-eur="<?php echo $product['availEUR']; ?>">
						<a href="<?php echo $product['url']; ?>">
							<div class="info">
								<div class="vertical-center">
									<h4 class="name"><?php echo $product['title']; ?></h4>
									<p class="detail"><?php echo $product['detail']; ?></p>
									<?php echo $product['price']; if (count($product['colorways']) > 1) : ?>
									<div class="colorways">
										<?php foreach ($product['colorways'] as $colorway) : ?>
										<div class="swatch" data-src="<?php echo $colorway['img']['sizes']['medium']; ?>" title="<?php echo $colorway['color']; ?>"><img src="<?php bloginfo('template_directory'); ?>/_/img/colorways/<?php echo $colorway['slug']; ?>.jpg" alt="" /></div>
										<?php endforeach; ?>
									</div>
									<?php endif; ?>
								</div>
							</div>
							<?php if($product['image']): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-board.png" data-src="<?php echo $product['image']['sizes']['medium']; ?>" data-src-retina="<?php echo $product['image']['sizes']['large']; ?>"  alt="<?php $product['title']; ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div>

					<?php endforeach; ?>

				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->

			<?php elseif (get_the_title() == "Bindings") : ?>

			<section id="mens-bindings" class="product-overview deeplink-top-fix">
				<header class="product-header section-header alt">
					<div class="header-wrapper">
						<h2 class="title">Men's Bindings</h2>
						<h5 class="subtitle">Click, Click, Ride</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign large"><a href="#womens-bindings">View Women's</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-6"></div>
				</header>
				<div class="product-utility">
					<div class="product-filters">
						<div class="filter-controls">
							<button class="btn-open">Binding Filters<span></span></button>
							<button class="btn-close"></button>
							<div class="btn-wrapper categories">
								<button class="btn-filter">Categories</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
							<div class="btn-wrapper pricing">
								<button class="btn-filter">Pricing</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
						</div><!-- .filter-collection -->
						<div class="filter-collection categories">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="rear-entry">Rear Entry</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="front-entry">Front Entry</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="splitboard">Splitboard</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="youth">Youth</button></li>
							</ul>
						</div><!-- .filter-collection -->
						<div class="filter-collection pricing">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="Low">Low - High</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="High">High - Low</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="Available">Available</button></li>
							</ul>
						</div><!-- .filter-collection -->
					</div><!-- .product-filters -->
					<div class="instructions"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/carousel-instructions-bindings.gif" alt="Click and Drag Bindings" class="lazy" /></div>
				</div><!-- .product-utility -->
				<div class="product-list owl-carousel owl-theme">
					<?php
						// Get Mens Bindings
						$args = array(
							'post_type' => 'gnu_bindings',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_bindings_categories',
									'field' => 'slug',
									'terms' => array('mens', 'youth'),
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$image = get_field('gnu_product_image');
							$detail = get_field('gnu_binding_type');
							// build filter list of categories
							$categoryFilters = "";
							$categories = get_the_terms( $post->ID , 'gnu_bindings_categories' );
							foreach ( $categories as $category ) {
								$categoryFilters .= $category->slug . " ";
							}
							$filterPrice = str_replace('.', '', get_field('gnu_product_price_us'));
							$availUS = "No";
							$availCA = "No";
							$availEUR = "No";
							$colorways = Array();
							if(get_field('gnu_binding_options')):
								while(the_repeater_field('gnu_binding_options')):
									// get variations
									$optionColor = get_sub_field('gnu_binding_options_color');
									$optionClass = str_replace(' ', '-', strtolower($optionColor));
									$optionImage = get_sub_field('gnu_binding_options_img');
									array_push($colorways, Array('color' => $optionColor, 'class' => $optionClass, 'img' => $optionImage));
									$optionVariations = get_sub_field('gnu_binding_options_variations');
									// loop through variations
									if ($optionVariations) :
										for ($i = 0; $i < count($optionVariations); $i++) {
											$variationSKU = $optionVariations[$i]['gnu_binding_options_variations_sku'];
											// grab availability
											$variationAvailUS = $optionVariations[$i]['gnu_binding_options_variations_availability_us'];
											$variationAvailCA = $optionVariations[$i]['gnu_binding_options_variations_availability_ca'];
											$variationAvailEUR = $optionVariations[$i]['gnu_binding_options_variations_availability_eur'];
											// check availability based on overrides in WP Admin
											switch ($variationAvailUS) {
												case "Inventory":
													$variationAvailUS = getProductAvailability($variationSKU, 'US');
													break;
												case "Yes":
													$variationAvailUS = Array('amount' => "Yes");
													break;
												case "No":
													$variationAvailUS = Array('amount' => "No");
													break;
												default:
													$variationAvailUS = getProductAvailability($variationSKU, 'US');
											}
											switch ($variationAvailCA) {
												case "Inventory":
													$variationAvailCA = getProductAvailability($variationSKU, 'CA');
													break;
												case "Yes":
													$variationAvailCA = Array('amount' => "Yes");
													break;
												case "No":
													$variationAvailCA = Array('amount' => "No");
													break;
												default:
													$variationAvailCA = getProductAvailability($variationSKU, 'CA');
											}
											switch ($variationAvailEUR) {
												case "Inventory":
													$variationAvailEUR = getProductAvailability($variationSKU, 'EU');
													break;
												case "Yes":
													$variationAvailEUR = Array('amount' => "Yes");
													break;
												case "No":
													$variationAvailEUR = Array('amount' => "No");
													break;
												default:
													$variationAvailEUR = getProductAvailability($variationSKU, 'EU');
											}
											if($variationAvailUS['amount'] > 0 || $variationAvailUS['amount'] == "Yes") $availUS = "Yes";
											if($variationAvailCA['amount'] > 0 || $variationAvailCA['amount'] == "Yes") $availCA = "Yes";
											if($variationAvailEUR['amount'] > 0 || $variationAvailEUR['amount'] == "Yes") $availEUR = "Yes";
										}
									endif;
								endwhile;
							endif;
					?>

					<div class="product" data-categories="<?php echo $categoryFilters; ?>" data-price="<?php echo $filterPrice; ?>" data-avail-us="<?php echo $availUS; ?>" data-avail-ca="<?php echo $availCA; ?>" data-avail-eur="<?php echo $availEUR; ?>">
						<a href="<? the_permalink(); ?>">
							<div class="info">
								<div class="vertical-center">
									<h4 class="name"><?php the_title(); ?></h4>
									<p class="detail"><?php echo $detail; ?></p>
									<div class="price">
										<?php echo getPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_price_eur'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
									</div>
									<?php if (count($colorways) > 1) : ?>
									<div class="colorways">
										<?php foreach ($colorways as $colorway) : ?>
										<div class="swatch <?php echo $colorway['class']; ?>" data-src="<?php echo $colorway['img']['sizes']['medium']; ?>" title="<?php echo $colorway['color']; ?>"></div>
										<?php endforeach; ?>
									</div>
									<?php endif; ?>
								</div>
							</div>
							<?php if($image): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-binding.png" data-src="<?php echo $image['sizes']['medium']; ?>" data-src-retina="<?php echo $image['sizes']['large']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div>

					<?
						endwhile;
						wp_reset_query();
					?>
				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section id="womens-bindings" class="product-overview deeplink-top-fix">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Women's Bindings</h2>
						<h5 class="subtitle">Faster, Easier, Smarter</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#mens-bindings">View Men's</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-3"></div>
				</header>
				<div class="product-utility">
					<div class="product-filters">
						<div class="filter-controls">
							<button class="btn-open">Binding Filters<span></span></button>
							<button class="btn-close"></button>
							<div class="btn-wrapper categories">
								<button class="btn-filter">Categories</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
							<div class="btn-wrapper pricing">
								<button class="btn-filter">Pricing</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
						</div><!-- .filter-collection -->
						<div class="filter-collection categories">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="rear-entry">Rear Entry</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="splitboard">Splitboard</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="youth">Youth</button></li>
							</ul>
						</div><!-- .filter-collection -->
						<div class="filter-collection pricing">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="Low">Low - High</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="High">High - Low</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="Available">Available</button></li>
							</ul>
						</div><!-- .filter-collection -->
					</div><!-- .product-filters -->
					<div class="instructions"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/carousel-instructions-bindings.gif" alt="Click and Drag Bindings" class="lazy" /></div>
				</div><!-- .product-utility -->
				<div class="product-list owl-carousel owl-theme">
					<?php
						// Get Womens Bindings
						$args = array(
							'post_type' => 'gnu_bindings',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_bindings_categories',
									'field' => 'slug',
									'terms' => array('womens', 'youth'),
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$image = get_field('gnu_product_image');
							$detail = get_field('gnu_binding_type');
							// build filter list of categories
							$categoryFilters = "";
							$categories = get_the_terms( $post->ID , 'gnu_bindings_categories' );
							foreach ( $categories as $category ) {
								$categoryFilters .= $category->slug . " ";
							}
							$filterPrice = str_replace('.', '', get_field('gnu_product_price_us'));
							$availUS = "No";
							$availCA = "No";
							$availEUR = "No";
							$colorways = Array();
							if(get_field('gnu_binding_options')):
								while(the_repeater_field('gnu_binding_options')):
									// get variations
									$optionColor = get_sub_field('gnu_binding_options_color');
									$optionClass = str_replace(' ', '-', strtolower($optionColor));
									$optionImage = get_sub_field('gnu_binding_options_img');
									array_push($colorways, Array('color' => $optionColor, 'class' => $optionClass, 'img' => $optionImage));
									$optionVariations = get_sub_field('gnu_binding_options_variations');
									// loop through variations
									if ($optionVariations) :
										for ($i = 0; $i < count($optionVariations); $i++) {
											$variationSKU = $optionVariations[$i]['gnu_binding_options_variations_sku'];
											// grab availability
											$variationAvailUS = $optionVariations[$i]['gnu_binding_options_variations_availability_us'];
											$variationAvailCA = $optionVariations[$i]['gnu_binding_options_variations_availability_ca'];
											$variationAvailEUR = $optionVariations[$i]['gnu_binding_options_variations_availability_eur'];
											// check availability based on overrides in WP Admin
											switch ($variationAvailUS) {
												case "Inventory":
													$variationAvailUS = getProductAvailability($variationSKU, 'US');
													break;
												case "Yes":
													$variationAvailUS = Array('amount' => "Yes");
													break;
												case "No":
													$variationAvailUS = Array('amount' => "No");
													break;
												default:
													$variationAvailUS = getProductAvailability($variationSKU, 'US');
											}
											switch ($variationAvailCA) {
												case "Inventory":
													$variationAvailCA = getProductAvailability($variationSKU, 'CA');
													break;
												case "Yes":
													$variationAvailCA = Array('amount' => "Yes");
													break;
												case "No":
													$variationAvailCA = Array('amount' => "No");
													break;
												default:
													$variationAvailCA = getProductAvailability($variationSKU, 'CA');
											}
											switch ($variationAvailEUR) {
												case "Inventory":
													$variationAvailEUR = getProductAvailability($variationSKU, 'EU');
													break;
												case "Yes":
													$variationAvailEUR = Array('amount' => "Yes");
													break;
												case "No":
													$variationAvailEUR = Array('amount' => "No");
													break;
												default:
													$variationAvailEUR = getProductAvailability($variationSKU, 'EU');
											}
											if($variationAvailUS['amount'] > 0 || $variationAvailUS['amount'] == "Yes") $availUS = "Yes";
											if($variationAvailCA['amount'] > 0 || $variationAvailCA['amount'] == "Yes") $availCA = "Yes";
											if($variationAvailEUR['amount'] > 0 || $variationAvailEUR['amount'] == "Yes") $availEUR = "Yes";
										}
									endif;
								endwhile;
							endif;
					?>

					<div class="product" data-categories="<?php echo $categoryFilters; ?>" data-price="<?php echo $filterPrice; ?>" data-avail-us="<?php echo $availUS; ?>" data-avail-ca="<?php echo $availCA; ?>" data-avail-eur="<?php echo $availEUR; ?>">
						<a href="<? the_permalink(); ?>">
							<div class="info">
								<div class="vertical-center">
									<h4 class="name"><?php the_title(); ?></h4>
									<p class="detail"><?php echo $detail; ?></p>
									<div class="price">
										<?php echo getPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_price_eur'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
									</div>
									<?php if (count($colorways) > 1) : ?>
									<div class="colorways">
										<?php foreach ($colorways as $colorway) : ?>
										<div class="swatch <?php echo $colorway['class']; ?>" data-src="<?php echo $colorway['img']['sizes']['medium']; ?>" title="<?php echo $colorway['color']; ?>"></div>
										<?php endforeach; ?>
									</div>
									<?php endif; ?>
								</div>
							</div>
							<?php if($image): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-binding.png" data-src="<?php echo $image['sizes']['medium']; ?>" data-src-retina="<?php echo $image['sizes']['large']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div>

					<?
						endwhile;
						wp_reset_query();
					?>
				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->

			<?php elseif (get_the_title() == "Supplies") : ?>

			<section id="wearables" class="product-overview deeplink-top-fix">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Wearables</h2>
						<h5 class="subtitle">The Weirdwear Collection</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign small"><a href="#headwear">View Headwear</a></li>
									<li class="sign large"><a href="#accessories">View Accessories</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-2"></div>
				</header>
				<div class="product-utility">
					<div class="product-filters">
						<div class="filter-controls">
							<button class="btn-open">Supply Filters<span></span></button>
							<button class="btn-close"></button>
							<div class="btn-wrapper categories">
								<button class="btn-filter">Categories</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
							<div class="btn-wrapper pricing">
								<button class="btn-filter">Pricing</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
						</div><!-- .filter-collection -->
						<div class="filter-collection categories">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="sweatshirts">Sweatshirts</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="t-shirts">T-shirts</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="socks">Socks</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="space-collection">Space Collection</button></li>
							</ul>
						</div><!-- .filter-collection -->
						<div class="filter-collection pricing">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="Low">Low - High</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="High">High - Low</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="Available">Available</button></li>
							</ul>
						</div><!-- .filter-collection -->
					</div><!-- .product-filters -->
					<div class="instructions"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/carousel-instructions-supplies.gif" alt="Click and Drag Supplies" class="lazy" /></div>
				</div><!-- .product-utility -->
				<div class="product-list owl-carousel owl-theme">
					<?php
						// Get Wearables
						$args = array(
							'post_type' => 'gnu_apparel',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_apparel_categories',
									'field' => 'slug',
									'terms' => array('sweatshirts', 't-shirts', 'socks'),
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$image = get_field('gnu_product_image');
							$detail = 'Wearables';
							// build filter list of categories
							$categoryFilters = "";
							$categories = get_the_terms( $post->ID , 'gnu_apparel_categories' );
							foreach ( $categories as $category ) {
								$categoryFilters .= $category->slug . " ";
							}
							// determine load image
							if (strpos($categoryFilters, 'sweatshirts') !== false) {
								$loadImage = "loading-sweatshirt.png";
							} else if (strpos($categoryFilters, 't-shirts') !== false) {
								$loadImage = "loading-t-shirt.png";
							} else if (strpos($categoryFilters, 'socks') !== false) {
								$loadImage = "loading-sock.png";
							} else {
								$loadImage = "loading-t-shirt.png";
							}
							$filterPrice = str_replace('.', '', get_field('gnu_product_price_us'));
							$availUS = "No";
							$availCA = "No";
							$availEUR = "No";
							if (get_field('gnu_apparel_variations')) :
								while(the_repeater_field('gnu_apparel_variations')):
									$optionSKU = get_sub_field('gnu_apparel_variations_sku');
									// grab availability overwrite
									$optionAvailUS = get_sub_field('gnu_apparel_variations_availability_us');
									$optionAvailCA = get_sub_field('gnu_apparel_variations_availability_ca');
									$optionAvailEUR = get_sub_field('gnu_apparel_variations_availability_eur');
									// check availability based on overrides in WP Admin
									switch ($optionAvailUS) {
										case "Inventory":
											$optionAvailUS = getProductAvailability($optionSKU, 'US');
											break;
										case "Yes":
											$optionAvailUS = Array('amount' => "Yes");
											break;
										case "No":
											$optionAvailUS = Array('amount' => "No");
											break;
										default:
											$optionAvailUS = getProductAvailability($optionSKU, 'US');
									}
									switch ($optionAvailCA) {
										case "Inventory":
											$optionAvailCA = getProductAvailability($optionSKU, 'CA');
											break;
										case "Yes":
											$optionAvailCA = Array('amount' => "Yes");
											break;
										case "No":
											$optionAvailCA = Array('amount' => "No");
											break;
										default:
											$optionAvailCA = getProductAvailability($optionSKU, 'CA');
									}
									switch ($optionAvailEUR) {
										case "Inventory":
											$optionAvailEUR = getProductAvailability($optionSKU, 'EU');
											break;
										case "Yes":
											$optionAvailEUR = Array('amount' => "Yes");
											break;
										case "No":
											$optionAvailEUR = Array('amount' => "No");
											break;
										default:
											$optionAvailEUR = getProductAvailability($optionSKU, 'EU');
									}
									if($optionAvailUS['amount'] > 0 || $optionAvailUS['amount'] == "Yes") $availUS = "Yes";
									if($optionAvailCA['amount'] > 0 || $optionAvailCA['amount'] == "Yes") $availCA = "Yes";
									if($optionAvailEUR['amount'] > 0 || $optionAvailEUR['amount'] == "Yes") $availEUR = "Yes";
								endwhile;
							endif;
							$colorways = Array();
							if (get_field('gnu_apparel_images')) :
								while(the_repeater_field('gnu_apparel_images')):
									// get variations
									$optionColor = get_sub_field('gnu_apparel_images_color');
									$optionClass = str_replace(' ', '-', strtolower($optionColor));
									$optionImage = get_sub_field('gnu_apparel_images_img');
									// don't add duplicate colors
									$colorFound = false;
									foreach ($colorways as $colorway) {
										if ($optionColor == $colorway['color']) {
											$colorFound = true;
										}
									}
									if (!$colorFound) {
										array_push($colorways, Array('color' => $optionColor, 'class' => $optionClass, 'img' => $optionImage));
									}	
								endwhile;
							endif;
					?>

					<div class="product" data-categories="<?php echo $categoryFilters; ?>" data-price="<?php echo $filterPrice; ?>" data-avail-us="<?php echo $availUS; ?>" data-avail-ca="<?php echo $availCA; ?>" data-avail-eur="<?php echo $availEUR; ?>">
						<a href="<? the_permalink(); ?>">
							<div class="info">
								<div class="vertical-center">
									<h4 class="name"><?php the_title(); ?></h4>
									<p class="detail"><?php echo $detail; ?></p>
									<div class="price">
										<?php echo getPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_price_eur'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
									</div>
									<?php if (count($colorways) > 1) : ?>
									<div class="colorways">
										<?php foreach ($colorways as $colorway) : ?>
										<div class="swatch <?php echo $colorway['class']; ?>" data-src="<?php echo $colorway['img']['sizes']['medium']; ?>" title="<?php echo $colorway['color']; ?>"></div>
										<?php endforeach; ?>
									</div>
									<?php endif; ?>
								</div>
							</div>
							<?php if($image): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/<?php echo $loadImage; ?>" data-src="<?php echo $image['sizes']['medium']; ?>" data-src-retina="<?php echo $image['sizes']['large']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div>

					<?
						endwhile;
						wp_reset_query();
					?>
				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section id="headwear" class="product-overview deeplink-top-fix">
				<header class="product-header section-header alt">
					<div class="header-wrapper">
						<h2 class="title">Headwear</h2>
						<h5 class="subtitle">Advanced Dome Enhancers</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#wearables">View Wearables</a></li>
									<li class="sign large"><a href="#accessories">View Accessories</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-5"></div>
				</header>
				<div class="product-utility">
					<div class="product-filters">
						<div class="filter-controls">
							<button class="btn-open">Supply Filters<span></span></button>
							<button class="btn-close"></button>
							<div class="btn-wrapper categories">
								<button class="btn-filter">Categories</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
							<div class="btn-wrapper pricing">
								<button class="btn-filter">Pricing</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
						</div><!-- .filter-collection -->
						<div class="filter-collection categories">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="hats">Hats</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="beanies">Beanies</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="space-collection">Space Collection</button></li>
							</ul>
						</div><!-- .filter-collection -->
						<div class="filter-collection pricing">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="Low">Low - High</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="High">High - Low</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="Available">Available</button></li>
							</ul>
						</div><!-- .filter-collection -->
					</div><!-- .product-filters -->
					<div class="instructions"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/carousel-instructions-supplies.gif" alt="Click and Drag Supplies" class="lazy" /></div>
				</div><!-- .product-utility -->
				<div class="product-list owl-carousel owl-theme">
					<?php
						// Get Wearables
						$args = array(
							'post_type' => 'gnu_apparel',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_apparel_categories',
									'field' => 'slug',
									'terms' => array('hats', 'beanies'),
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$image = get_field('gnu_product_image');
							$detail = 'Headwear';
							// build filter list of categories
							$categoryFilters = "";
							$categories = get_the_terms( $post->ID , 'gnu_apparel_categories' );
							foreach ( $categories as $category ) {
								$categoryFilters .= $category->slug . " ";
							}
							$filterPrice = str_replace('.', '', get_field('gnu_product_price_us'));
							$availUS = "No";
							$availCA = "No";
							$availEUR = "No";
							if (get_field('gnu_apparel_variations')) :
								while(the_repeater_field('gnu_apparel_variations')):
									$optionSKU = get_sub_field('gnu_apparel_variations_sku');
									// grab availability overwrite
									$optionAvailUS = get_sub_field('gnu_apparel_variations_availability_us');
									$optionAvailCA = get_sub_field('gnu_apparel_variations_availability_ca');
									$optionAvailEUR = get_sub_field('gnu_apparel_variations_availability_eur');
									// check availability based on overrides in WP Admin
									switch ($optionAvailUS) {
										case "Inventory":
											$optionAvailUS = getProductAvailability($optionSKU, 'US');
											break;
										case "Yes":
											$optionAvailUS = Array('amount' => "Yes");
											break;
										case "No":
											$optionAvailUS = Array('amount' => "No");
											break;
										default:
											$optionAvailUS = getProductAvailability($optionSKU, 'US');
									}
									switch ($optionAvailCA) {
										case "Inventory":
											$optionAvailCA = getProductAvailability($optionSKU, 'CA');
											break;
										case "Yes":
											$optionAvailCA = Array('amount' => "Yes");
											break;
										case "No":
											$optionAvailCA = Array('amount' => "No");
											break;
										default:
											$optionAvailCA = getProductAvailability($optionSKU, 'CA');
									}
									switch ($optionAvailEUR) {
										case "Inventory":
											$optionAvailEUR = getProductAvailability($optionSKU, 'EU');
											break;
										case "Yes":
											$optionAvailEUR = Array('amount' => "Yes");
											break;
										case "No":
											$optionAvailEUR = Array('amount' => "No");
											break;
										default:
											$optionAvailEUR = getProductAvailability($optionSKU, 'EU');
									}
									if($optionAvailUS['amount'] > 0 || $optionAvailUS['amount'] == "Yes") $availUS = "Yes";
									if($optionAvailCA['amount'] > 0 || $optionAvailCA['amount'] == "Yes") $availCA = "Yes";
									if($optionAvailEUR['amount'] > 0 || $optionAvailEUR['amount'] == "Yes") $availEUR = "Yes";
								endwhile;
							endif;
							$colorways = Array();
							if (get_field('gnu_apparel_images')) :
								while(the_repeater_field('gnu_apparel_images')):
									// get variations
									$optionColor = get_sub_field('gnu_apparel_images_color');
									$optionClass = str_replace(' ', '-', strtolower($optionColor));
									$optionImage = get_sub_field('gnu_apparel_images_img');
									// don't add duplicate colors
									$colorFound = false;
									foreach ($colorways as $colorway) {
										if ($optionColor == $colorway['color']) {
											$colorFound = true;
										}
									}
									if (!$colorFound) {
										array_push($colorways, Array('color' => $optionColor, 'class' => $optionClass, 'img' => $optionImage));
									}	
								endwhile;
							endif;
					?>

					<div class="product" data-categories="<?php echo $categoryFilters; ?>" data-price="<?php echo $filterPrice; ?>" data-avail-us="<?php echo $availUS; ?>" data-avail-ca="<?php echo $availCA; ?>" data-avail-eur="<?php echo $availEUR; ?>">
						<a href="<? the_permalink(); ?>">
							<div class="info">
								<div class="vertical-center">
									<h4 class="name"><?php the_title(); ?></h4>
									<p class="detail"><?php echo $detail; ?></p>
									<div class="price">
										<?php echo getPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_price_eur'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
									</div>
									<?php if (count($colorways) > 1) : ?>
									<div class="colorways">
										<?php foreach ($colorways as $colorway) : ?>
										<div class="swatch <?php echo $colorway['class']; ?>" data-src="<?php echo $colorway['img']['sizes']['medium']; ?>" title="<?php echo $colorway['color']; ?>"></div>
										<?php endforeach; ?>
									</div>
									<?php endif; ?>
								</div>
							</div>
							<?php if($image): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-headwear.png" data-src="<?php echo $image['sizes']['medium']; ?>" data-src-retina="<?php echo $image['sizes']['large']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div>

					<?
						endwhile;
						wp_reset_query();
					?>
				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section id="accessories" class="product-overview deeplink-top-fix">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Accessories</h2>
						<h5 class="subtitle">Tuning for Your Gold Metal Technology</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#wearables">View Wearables</a></li>
									<li class="sign small"><a href="#headwear">View Headwear</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-4"></div>
				</header>
				<div class="product-utility">
					<div class="product-filters">
						<div class="filter-controls">
							<button class="btn-open">Supply Filters<span></span></button>
							<button class="btn-close"></button>
							<div class="btn-wrapper categories">
								<button class="btn-filter">Categories</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
							<div class="btn-wrapper pricing">
								<button class="btn-filter">Pricing</button>
								<button class="btn-remove">(<span>X</span>)</button>
							</div>
						</div><!-- .filter-collection -->
						<div class="filter-collection categories">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="wax">Wax</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="tools">Tools</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="stomp-pads">Stomp Pads</button></li>
							</ul>
						</div><!-- .filter-collection -->
						<div class="filter-collection pricing">
							<ul class="filter-list">
								<li class="filter-item"><button class="btn-option" data-filter="Low">Low - High</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="High">High - Low</button></li>
								<li class="filter-item"><button class="btn-option" data-filter="Available">Available</button></li>
							</ul>
						</div><!-- .filter-collection -->
					</div><!-- .product-filters -->
					<div class="instructions"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/carousel-instructions-supplies.gif" alt="Click and Drag Supplies" class="lazy" /></div>
				</div><!-- .product-utility -->
				<div class="product-list owl-carousel owl-theme">
					<?php
						// Get Wearables
						$args = array(
							'post_type' => 'gnu_accessories',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'gnu_accessories_categories',
									'field' => 'slug',
									'terms' => 'snowboard-accessories',
									'include_children' => false
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$image = get_field('gnu_product_image');
							$detail = 'Accessories';
							// build filter list of categories
							$categoryFilters = "";
							$categories = get_the_terms( $post->ID , 'gnu_accessories_categories' );
							foreach ( $categories as $category ) {
								$categoryFilters .= $category->slug . " ";
							}
							$filterPrice = str_replace('.', '', get_field('gnu_product_price_us'));
							$availUS = "No";
							$availCA = "No";
							$availEUR = "No";
							// grab sku
							$productSKU = get_field('gnu_accessory_sku');
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
							if($optionAvailUS['amount'] > 0 || $optionAvailUS['amount'] == "Yes") $availUS = "Yes";
							if($optionAvailCA['amount'] > 0 || $optionAvailCA['amount'] == "Yes") $availCA = "Yes";
							if($optionAvailEUR['amount'] > 0 || $optionAvailEUR['amount'] == "Yes") $availEUR = "Yes";
					?>

					<div class="product" data-categories="<?php echo $categoryFilters; ?>" data-price="<?php echo $filterPrice; ?>" data-avail-us="<?php echo $availUS; ?>" data-avail-ca="<?php echo $availCA; ?>" data-avail-eur="<?php echo $availEUR; ?>">
						<a href="<? the_permalink(); ?>">
							<div class="info">
								<div class="vertical-center">
									<h4 class="name"><?php the_title(); ?></h4>
									<p class="detail"><?php echo $detail; ?></p>
									<div class="price">
										<?php echo getPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_price_eur'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
									</div>
								</div>
							</div>
							<?php if($image): ?><img src="<?php echo get_template_directory_uri(); ?>/_/img/loading-accessory.png" data-src="<?php echo $image['sizes']['medium']; ?>" data-src-retina="<?php echo $image['sizes']['large']; ?>" alt="<?php the_title(); ?> Image" class="image owl-lazy" /><?php endif; ?>
						</a>
					</div>

					<?
						endwhile;
						wp_reset_query();
					?>
				</div><!-- .product-list -->
				<div class="clearfix"></div>
			</section><!-- .product-overview -->

			<?php endif; ?>

<?php get_footer(); ?>