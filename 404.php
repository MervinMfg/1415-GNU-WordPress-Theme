<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage 1415-GNU-WordPress-Theme
 * @since 1415 GNU WordPress Theme 1.0.0
 */

get_header(); ?>

			<section class="error-404">
				<header class="search-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Error</h2>
						<h5 class="subtitle">Page Not Found</h5>
					</div>
					<div class="vibe vibe-4"></div>
				</header>
				<div class="error-content">
					<h3 class="title">Search for what you seek</h3>
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
					<div class="gcse-searchbox-only" data-queryParameterName="s" data-enableHistory="true" data-resultsUrl="/"><div class="loading"></div></div>
				</div><!-- .error-content -->
			</section><!-- .error-page -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>