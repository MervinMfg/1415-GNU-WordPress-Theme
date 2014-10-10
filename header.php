<?php
/**
 * The Header for our theme
 *
 * @package WordPress
 * @subpackage 1415-GNU-WordPress-Theme
 * @since 1415 GNU WordPress Theme 1.0.0
 */

// GET THE REGION
getCurrencyCode();
// GET THE PAGE TITLE
$GLOBALS['pageTitle'] = "";
if (function_exists('is_tag') && is_tag()) {
	$GLOBALS['pageTitle'] .= single_tag_title("Tag Archive for &quot;", false) . '&quot; - ';
} elseif (is_archive()) {
	$GLOBALS['pageTitle'] .= wp_title('', false) . ' Archive - ';
} elseif (is_search()) {
	$GLOBALS['pageTitle'] .= 'Search for &quot;'.wp_specialchars($s).'&quot; - ';
} elseif (!(is_404()) && (is_single()) || (is_page()) && !(is_front_page())) {
	$GLOBALS['pageTitle'] .= wp_title('-',false,'right');
} elseif (is_404()) {
	$GLOBALS['pageTitle'] .=  'Not Found - ';
}
if (is_home() || is_front_page()) {
	$GLOBALS['pageTitle'] .= get_bloginfo('name') . ' - ' . get_bloginfo('description');
} else {
	$GLOBALS['pageTitle'] .= get_bloginfo('name');
}
if ($paged>1) {
	$GLOBALS['pageTitle'] .=  ' - page '. $paged;
}
// SET DEFAULT PAGE IMAGE
$GLOBALS['pageImage'] = get_template_directory_uri() . "/_/img/social-share.jpg";
$pageDescriptionDefault = "GNU speed-entry performance bindings and snowboards handbuilt by snowboarders with jobs in the USA since 1977. Keep snowboarding weird!";
// GET THE PAGE DESCRIPTION, AND IMAGE IF IT'S SINGLE
if (is_single()){
	if (have_posts()){
		while (have_posts()){
			the_post();
			$pageDescription = strip_tags(get_the_excerpt());
			// set page thumbnail now that we know we have a single post, used for FB likes
			$GLOBALS['pageImage'] = get_post_image('medium');
			$GLOBALS['pageImage'] = $GLOBALS['pageImage'][0];
		}
	}else{
		$pageDescription = $pageDescriptionDefault;
	}
	// check for product image
	if( get_field('libtech_product_image') ) {
        $GLOBALS['pageImage'] = get_field('gnu_product_image');
        $GLOBALS['pageImage'] = $GLOBALS['pageImage']['sizes']['medium'];
    }
}else{
	if($post) {
		if(has_post_thumbnail($post->ID) && !is_home()){
			$GLOBALS['pageImage'] = get_post_image('medium');
			$GLOBALS['pageImage'] = $GLOBALS['pageImage'][0];
		}
	}
	if (have_posts() && !is_home()){
		while (have_posts()){
			the_post();
			$pageDescription = strip_tags(get_the_excerpt());
			if($pageDescription == ""){
				$pageDescription = $pageDescriptionDefault;
			}
		}
	}else {
		$pageDescription = $pageDescriptionDefault;
	}
}
?><!doctype html>
<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!--
                G                                           GGGGGGGGGGG
               GGG          GGGGGGGGGGGGGGGGGGGGGGGGGG   GGGGGGGGGGGGGGGGG
              GGGGG         GGGGGGGGGGGGGGGGGGGGGGGGGG GGGGGGGGGGGGGGGGGGGGGG
             GGG GGG        GG        GGGGGGGG     GGGGGG    GGGGGGGGG    GGG
            GGG   GGG       GG         GGGGGGG     GGGGGG    GGGGGGGGG    GGGG
           GGG     GGG      GG          GGGGGG     GGGGGG    GGGGGGGGG    GGGGG
          GGG       GGG     GG           GGGGG     GGGGGG    GGGGGGGGG    GGGGG
         GGG    G    GGG    GG     G      GGGG     GGGGGG    GGGGGGGGG    GGGGGG
        GGG    GGG    GGG   GG     GG      GGG     GGGGGG    GGGGGGGGG    GGGGGG
       GGG    GGGGGGGGGGGG  GG     GGG      GG     GGGGGG    GGGGGGGGG    GGGGGG
      GGG    GGGGGGGGGGGGGG GG     GGGG      G     GGGGGG    GGGGGGGGG    GGGGG
     GGG    GGG         GGGGGG     GGGGG           GGGGGG    GGGGGGGGG    GGGGG
    GGG    GGGGGGGGGGG   GGGGG     GGGGGG          GGGGGG     GGGGGGG     GGGG
   GGG    GGGGGGGGGGGGG   GGGG     GGGGGGG         GGGGGGG     GGGGG     GGGGG
  GGG                      GGG     GGGGGGGG        GGGGGGGG             GGGGG
 GGG                        GG     GGGGGGGGG       GGG  GGGGGGG     GGGGGGG
GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG     GGGGGGGGGGGGGG
GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG         GGGGGG

               - HANDBUILT IN THE USA BY SNOWBOARDERS WITH JOBS -
-->
<head id="www-gnu-com" data-template-set="gnu-wordpress-theme">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<title><?php echo $GLOBALS['pageTitle']; ?></title>
	<meta name="description" content="<?php echo $pageDescription; ?>" />
	<meta name="keywords" content="GNU, snowboarding, snowboard, snowboards, Outerwear, Clothing, Apparel, Accessories, snow, snowboard technology, technology, mage-traction" />
	<meta name="author" content="GNU" />
	<meta name="Copyright" content="Copyright GNU <?php echo date('Y'); ?>. All Rights Reserved." />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="google-site-verification" content="6YUIRABPjekB2v-5E5jCD-uMTBL0rUjqGsQveG2_BL0" />
<?php if (is_search()) echo "\t" . '<meta name="robots" content="noindex, nofollow" />' . "\n"; ?>
	<meta property="og:title" content="<?php echo $GLOBALS['pageTitle']; ?>" />
	<meta property="og:description" content="<?php echo $pageDescription; ?>" />
	<meta property="og:url" content="<? the_permalink(); ?>" />
	<meta property="og:image" content="<?php echo $GLOBALS['pageImage']; ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="GNU Snowboards" />
	<meta property="fb:app_id" content="217173258409585"/>
	<meta itemprop="name" content="<?php echo $GLOBALS['pageTitle']; ?>" />
	<meta itemprop="description" content="<?php echo $pageDescription; ?>" />
	<meta itemprop="image" content="<?php echo $GLOBALS['pageImage']; ?>" />
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@gnuSnowboards">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/_/img/favicon.ico" />
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/_/img/apple-touch-icon-precomposed.png" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php include '_/inc/header-includes.php' ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/_/js/lib/respond-1.4.2.min.js"></script>
	<link href="http://cdn.gnu.com/respond-proxy/" id="respond-proxy" rel="respond-proxy" />
	<link href="<?php echo get_template_directory_uri(); ?>/_/img/respond.proxy.gif" id="respond-redirect" rel="respond-redirect" />
	<script src="<?php echo get_template_directory_uri(); ?>/_/js/lib/respond.proxy.js"></script>
	<![endif]-->
	<!-- WordPress Head -->
	<?php
		wp_head();
		$bodyClass = "";
		if ( is_front_page() ) {
			if ( get_field('gnu_takeover_active') == "Yes" ) $bodyClass = 'active-takeover';
		}
	?>
</head>
<body <?php body_class($bodyClass); ?>>
	<div id="page">
		<header id="masthead" class="site-header" role="banner">
			<div class="header-wrapper">
				<div class="header-main">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="logo" class="site-title" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/_/img/gnu-logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<a href="#primary-navigation" class="menu-toggle"><span class="toggle-icon"></span>Menu</a>
					<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
						<a class="screen-reader-text skip-link" href="#content">Skip to content</a>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
					</nav>
					<nav id="secondary-navigation" class="secondary-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu' ) ); ?>
					</nav>
					<div class="black-bar"></div>
					<div class="quick-cart-toggle">
						<a href="/shopping-cart/" title="Shopping Cart"><span class="offscreen">Quick Cart</span></a>
					</div>
					<div class="search-toggle">
						<a href="#search" title="Search"><span class="offscreen">Search</span></a>
					</div>

					<?php
						if ( is_front_page() ) :
							if ( get_field('gnu_takeover_active') == "Yes" ) :
								$teamName = get_field('gnu_takeover_team_name');
								$teamUrl = get_field('gnu_takeover_team_url');
								$teamImg = get_field('gnu_takeover_team_img');
								$productName = get_field('gnu_takeover_product_name');
								$productUrl = get_field('gnu_takeover_product_url');
					?>

					<div class="takeover">
						<div class="logo">
							<img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/gnu-logo-takeover.png" alt="<?php bloginfo( 'name' ); ?>" class="lazy" />
						</div>
						<div class="h1"><a href="<?php echo $teamUrl; ?>"><?php echo $teamName; ?></a></div>
						<div class="h5"><a href="<?php echo $productUrl; ?>"><?php echo $productName; ?></a></div>
						<div class="photo"><a href="<?php echo $teamUrl; ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo $teamImg['url']; ?>" alt="<?php echo $teamName; ?>" class="lazy" /></a></div>
					</div><!-- .takeover -->

					<?php endif; endif; ?>

					<div class="clearfix"></div>
				</div>
			</div><!-- .header-wrapper -->

			<?php if ( is_front_page() ) : ?>

			<div class="takeover-green-bar"></div>
			<div class="takeover-white-fade"></div>

			<?php endif; ?>

			<div id="quick-cart" class="quick-cart hide">
				<div class="quick-cart-wrapper">
					<div class="cart-default-image">
						<img src="<?php echo get_template_directory_uri(); ?>/_/img/quick-cart-default.jpg" alt="Default product image" />
					</div>
					<div class="cart-item-image">
						<img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" alt="Last product added" />
					</div>
					<div class="cart-details">
						<p class="cart-default-title"><a href="https://www.youtube.com/watch?v=L7SkrYF8lCU" target="_blank">Feed me Seymour!</a></p>
						<p class="cart-item-title"></p>
						<div class="cart-item-price">
							<div class="cart-item-amount"></div>
							<button class="cart-item-remove">REMOVE X</button>
						</div>
						<p class="total-items"><a href="/shopping-cart/">View <span>0</span> Item(s) in Cart</a></p>
						<a href="/shopping-cart/" class="cart-checkout green-box">Checkout</a>
					</div>
				</div>
			</div>
			<div id="search" class="search-box-wrapper hide">
				<?php get_search_form(); ?>
			</div>
		</header><!-- .site-header -->
		<div id="main" class="site-main">