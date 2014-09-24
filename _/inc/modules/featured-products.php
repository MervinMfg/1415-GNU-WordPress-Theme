<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>

			<?php
			$products = get_field('gnu_featured_products');
			if( $products ):
				$featuredProducts = Array();
				$imageSize = 'square-medium';
				// get each featured/related product
				foreach( $products as $product):
					// get product values
					$productTitle = get_the_title($product->ID);
					$productLink = get_permalink($product->ID);
					$productSlogan = get_field('gnu_product_slogan', $product->ID);
					$productImage = get_field('gnu_product_image', $product->ID);
					$productType = substr($product->post_type, 4); // remove gnu_ from post type
					// add to related product array
					array_push($featuredProducts, Array($productTitle, $productLink, $productSlogan, $productImage, $productType));
				endforeach;
				// randomly sort featured products array
				shuffle($featuredProducts);
			?>

			<section class="featured-products">
				<div class="featured-products-list owl-carousel owl-theme">

					<?php
						// loop through products
						for($i = 0; $i < count($featuredProducts); ++$i) :
							if($i == 6){
								break;
							}
					?>

					<div class="featured-product <?php echo $featuredProducts[$i][4]; ?>">
						<div class="featured-product-details">
							<a href="<?php echo $featuredProducts[$i][1]; ?>">
								<div class="featured-product-image">
									<img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo $featuredProducts[$i][3]['sizes'][$imageSize]; ?>" alt="<?php echo $featuredProducts[$i][0]; ?>" class="owl-lazy" />
								</div>
								<div class="featured-product-copy">
									<h3 class="featured-product-title"><?php echo $featuredProducts[$i][0]; ?></h3>
									<p class="featured-product-slogan"><?php echo $featuredProducts[$i][2]; ?></p>
									<button class="btn-submit">Buy</button>
								</div>
							</a>
						</div>
					</div><!-- .product -->

					<? endfor; ?>

				</div><!-- .product-list -->
			</section><!-- .featured-products -->
			<? endif; ?>
