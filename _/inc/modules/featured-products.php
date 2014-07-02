<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>

			<?php
			$posts = get_field('gnu_featured_products');
    		if( $posts ):
    			$featuredProducts = Array();
	    		$imageSize = 'square-medium';
				// get each featured/related product
				foreach( $posts as $post):
					// get product values
					$productTitle = get_the_title($post->ID);
					$productLink = get_permalink($post->ID);
					$productSlogan = get_field('gnu_product_slogan', $post->ID);
					$productImage = get_field('gnu_product_image', $post->ID);
					$productType = substr($post->post_type, 4); // remove gnu_ from post type
					// add to related product array
					array_push($featuredProducts, Array($productTitle, $productLink, $productSlogan, $productImage, $productType));
				endforeach;
				// randomly sort featured products array
				shuffle($featuredProducts);
			?>

			<section class="featured-products">
				<div class="product-list owl-carousel">

					<?php
						// loop through products
						for($i = 0; $i < count($featuredProducts); ++$i) :
							if($i == 6){
								break;
							}
					?>

					<div class="product <?php echo $featuredProducts[$i][4]; ?>">
						<div class="product-details">
							<a href="<?php echo $featuredProducts[$i][1]; ?>">
								<div class="product-image">
									<img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo $featuredProducts[$i][3]['sizes'][$imageSize]; ?>" alt="<?php echo $featuredProducts[$i][0]; ?>" class="owl-lazy" />
								</div>
								<div class="product-copy">
									<h3 class="product-title"><?php echo $featuredProducts[$i][0]; ?></h3>
									<p class="product-slogan"><?php echo $featuredProducts[$i][2]; ?></p>
									<button class="btn-submit">Buy</button>
								</div>
							</a>
						</div>
					</div><!-- .product -->

					<? endfor; ?>

				</div><!-- .product-list -->
			</section><!-- .featured-products -->
			<? endif; ?>
