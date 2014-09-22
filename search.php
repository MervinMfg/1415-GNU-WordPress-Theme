<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage 1415-GNU-WordPress-Theme
 * @since 1415 GNU WordPress Theme 1.0.0
 */
 get_header(); ?>

			<section class="search">
				<header class="search-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Search</h2>
						<h5 class="subtitle"><?php echo htmlspecialchars($_GET["s"]); ?></h5>
					</div>
					<div class="vibe vibe-2"></div>
				</header>
				<div class="search-results">
					<script>
						(function() {
							var cx = '015302828112823652423:xozeufniryq';
							var gcse = document.createElement('script');
							gcse.type = 'text/javascript';
							gcse.async = true;
							gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//www.google.com/cse/cse.js?cx=' + cx;
							var s = document.getElementsByTagName('script')[0];
							s.parentNode.insertBefore(gcse, s);
						})();
					</script>
					<gcse:search queryParameterName="s"><div class="loading"></div></gcse:search>
				</div><!-- .search-results -->
			</section><!-- .search -->

<?php get_footer(); ?>
