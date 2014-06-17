<?php
/**
 * The Header for our theme
 *
 * @package WordPress
 * @subpackage 1415-GNU-WordPress-Theme
 * @since 1415 GNU WordPress Theme 1.0.0
 */
?><!doctype html>
<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head id="mervinmfg-template" data-template-set="mervinmfg-wordpress-theme-template">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<meta name="keywords" content="XXXXXXXXXX" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="google-site-verification" content="XXXXXXXXXX" />
<?php if (is_search()) echo "\t" . '<meta name="robots" content="noindex, nofollow" />' . "\n"; ?>
	<meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?>" />
	<meta property="og:description" content="<?php bloginfo('description'); ?>" />
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/_/img/social-icon.png" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="XXXXXXXXXX" />
	<meta property="fb:app_id" content="XXXXXXXXXX"/>
	<meta itemprop="name" content="<?php wp_title( '|', true, 'right' ); ?>" />
	<meta itemprop="description" content="<?php bloginfo('description'); ?>" />
	<meta itemprop="image" content="<?php echo get_template_directory_uri(); ?>/_/img/social-icon.png" />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="@XXXXXXXXXX" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/_/img/favicon.ico" />
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/_/img/apple-touch-icon-precomposed.png" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php include '_/inc/header-includes.php' ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/_/js/lib/respond-1.4.2.min.js"></script>
	<![endif]-->
	<!-- WordPress Head -->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page">
		<header id="masthead" class="site-header<?php if ( is_front_page() ) echo ' active-takeover'; ?>" role="banner">
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
					<div class="takeover">
						<div class="logo">
							<img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/gnu-logo-takeover.png" alt="<?php bloginfo( 'name' ); ?>" class="lazy" />
						</div>
						<div class="h1">KAITLYN FARRINGTON</div>
						<div class="h5">B Pro Splitboard</div>
						<div class="photo"><img src="<?php echo get_template_directory_uri(); ?>/_/img/square.gif" data-src="<?php echo get_template_directory_uri(); ?>/_/img/takeovers/takeover-kaitlyn-farrington.png" alt="Maria Debari" class="lazy" /></div>
					</div><!-- .takeover -->
					<div class="clearfix"></div>
				</div>
			</div><!-- .header-wrapper -->
			<div class="takeover-green-bar"></div>
			<div class="takeover-white-fade"></div>
			<div id="search" class="search-box-wrapper hide">
				<?php get_search_form(); ?>
			</div>
		</header><!-- #masthead -->
		<div id="main" class="site-main">