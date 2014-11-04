<?php
/*
Template Name: Product Feed
*/
header('Content-Type: application/xml');
?>
<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
	<channel>
		<title>GNU</title>
		<link>http://www.gnu.com</link>
		<description>Snowboards Handbuilt in the USA by Weirdos with Jobs</description>
		<?php
			$args = array(
				'post_type' => array( 'gnu_snowboards', 'gnu_bindings', 'gnu_apparel', 'gnu_accessories' ),
				'posts_per_page' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);
			// Get Products
			$loop = new WP_Query( $args );
			if (have_posts()) :
				while ( $loop->have_posts() ) : $loop->the_post();
					$title = get_the_title();
					$content = get_the_content();
					$type = $post->post_type;
					switch ($type) {
						case "gnu_snowboards":
							$type = "Snowboard";
							break;
						case "gnu_bindings":
							$type = "Bindings";
							break;
						case "gnu_apparel":
							$type = "Apparel";
							break;
						case "gnu_accessories":
							$type = "Accessory";
							break;
					}
					$link = get_permalink();
					$image = get_field('gnu_product_image');
					$usPrice = get_field('gnu_product_price_us');
					$caPrice = get_field('gnu_product_price_ca');
					$euPrice = get_field('gnu_product_price_eur');
					$tagline = get_field('gnu_product_slogan');
		?>
<product>
			<title><![CDATA[<?php echo $title; ?>]]></title>
			<product_type><?php echo $type; ?></product_type>
			<description><![CDATA[<?php the_excerpt(); ?>]]></description>
			<link><?php echo $link; ?></link>
			<id></id>
			<image_link><?php echo $image['sizes']['large']; ?></image_link>
			<price>
				<us><?php echo $usPrice; ?></us>
				<ca><?php echo $caPrice; ?></ca>
				<eu><?php echo $euPrice; ?></eu>
			</price>
			<tagline><![CDATA[<?php echo $tagline; ?>]]></tagline>
		</product>
		<?php
			endwhile; endif;
			wp_reset_query();
		?>

	</channel>
</rss>
