<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage 1415-GNU-WordPress-Theme
 * @since 1415 GNU WordPress Theme 1.0.0
 */
?>
		</div><!-- .site-main -->
		<div id="region-selector" class="region-selector hide<?php if ( is_front_page() ) echo ' active-takeover'; ?>">
			<button class="btn-close"><span class="offscreen">Close</span></button>
			<div class="choose-region">
				<h2 class="head">Select region</h2>
				<p class="subhead">Region selection indicates currency and shipping address</p>
				<div class="location-group north-america">
					<h3 class="location-title">North America</h3>
					<ul class="location-list">
						<li>
							<p class="small"><a href="#region-selector" data-currency="USD"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/usa.gif" alt="USA Flag" />United States <span>(USD)</span></a></p>
						</li>
						<li>
							<p class="small"><a href="#region-selector" data-currency="CAD"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/canada.gif" alt="Canada Flag" />Canada <span>(CAD)</span></a></p>
						</li>
					</ul>
				</div>
				<div class="location-group europe">
					<h3 class="location-title">Europe</h3>
					<ul class="location-list">
						<li>
							<p class="small"><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/austria.gif" alt="Austria Flag" />Austria <span>(EUR)</span></a></p>
						</li>
						<li>
							<p class="small"><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/belgium.gif" alt="Belgium Flag" />Belgium <span>(EUR)</span></a></p>
						</li>
						<li>
							<p class="small"><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/czech.gif" alt="Czech Republic Flag" />Czech Republic <span>(EUR)</span></a></p>
						</li>
						<li>
							<p class="small"><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/denmark.gif" alt="Denmark Flag" />Denmark <span>(EUR)</span></a></p>
						</li>
						<li>
							<p class="small"><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/finland.gif" alt="Finland Flag" />Finland <span>(EUR)</span></a></p>
						</li>
						<li>
							<p class="small"><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/france.gif" alt="France Flag" />France <span>(EUR)</span></a></p>
						</li>
						<li>
							<p class="small"><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/germany.gif" alt="Germany Flag" />Germany <span>(EUR)</span></a></p>
						</li>
					</ul>
					<ul class="location-list">
						<li>
							<p class="small"><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/luxembourg.gif" alt="Luxembourg Flag" />Luxembourg <span>(EUR)</span></a></p>
						</li>
						<li>
							<p class="small"><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/netherlands.gif" alt="Netherlands Flag" />Netherlands <span>(EUR)</span></a></p>
						</li>
						<li>
							<p class="small"><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/poland.gif" alt="Poland Flag" />Poland <span>(EUR)</span></a></p>
						</li>
						<li>
							<p class="small"><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/portugal.gif" alt="Portugal Flag" />Portugal <span>(EUR)</span></a></p>
						</li>
						<li>
							<p class="small"><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/slovakia.gif" alt="Slovakia Flag" />Slovakia <span>(EUR)</span></a></p>
						</li>
						<!-- <li>
							<p class="small"><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/switzerland.gif" alt="Switzerland Flag" />Switzerland <span>(EUR)</span></a></p>
						</li> -->
					</ul>
				</div>
				<div class="location-group international">
					<h3 class="location-title">Other</h3>
					<ul class="location-list">
						<li class="us">
							<p class="small"><a href="#region-selector" data-currency="INT"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/international.gif" alt="International Flag" />International</a></p>
						</li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div><!-- .choose-region -->
		</div><!-- .region-selector -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="footer-wrapper">
				<div class="footer-content">
					<nav class="footer-menu">
						<div class="nav-group">
							<h3>Gear</h3>
							<ul class="nav-menu">
								<li class="menu-item"><a href="/snowboards/">Snowboards</a></li>
								<li class="menu-item"><a href="/bindings/">Bindings</a></li>
								<li class="menu-item"><a href="/supplies/">Supplies</a></li>
							</ul>
						</div><!-- .nav-group -->
						<div class="nav-group">
							<h3>Site</h3>
							<ul class="nav-menu">
								<li class="menu-item"><a href="/team/">Team</a></li>
								<li class="menu-item"><a href="/blog/">Blog</a></li>
								<li class="menu-item"><a href="/about/">About</a></li>
								<li class="menu-item"><a href="/about/technology/">Technology</a></li>
								<!-- <li class="menu-item"><a href="/about/environmental/">Environmental</a></li> -->
								<li class="menu-item"><a href="/about/partners/">Partners</a></li>
								<li class="menu-item"><a href="/store-locator/">Store Locator</a></li>
							</ul>
						</div><!-- .nav-group -->
						<div class="nav-group">
							<h3>Support</h3>
							<ul class="nav-menu">
								<li class="menu-item"><a href="/support/contact/">Contact</a></li>
								<li class="menu-item"><a href="/support/register/">Register</a></li>
								<li class="menu-item"><a href="/support/warranty/">Warranty</a></li>
								<!-- <li class="menu-item"><a href="/support/faq/">Faq</a></li> -->
								<li class="menu-item"><a href="/support/binding-manual/">Binding Manual</a></li>
								<li class="menu-item"><a href="/support/spare-parts/">Spare Parts</a></li>
							</ul>
						</div><!-- .nav-group -->
						<div class="nav-group">
							<h3>Online</h3>
							<ul class="nav-menu">
								<li class="menu-item"><a href="http://gnu.shptron.com/account/?mfg_id=4374.6&language_id=1" target="_blank" id="link-login">My Account</a></li>
								<li class="menu-item"><a href="http://gnu.shptron.com/home/privacy/4374.6.1.1" target="_blank" id="link-privacy">Privacy</a></li>
								<li class="menu-item"><a href="http://gnu.shptron.com/home/policies/4374.6.1.1" target="_blank" id="link-policies">Policies</a></li>
								<li class="menu-item"><a href="http://gnu.shptron.com/home/security/4374.6.1.1" target="_blank" id="link-safety">Security</a></li>
								<li class="menu-item"><a href="http://gnu.shptron.com/home/policies/4374.6.1.1#Returns" target="_blank" id="link-returns">Returns</a></li>
								<li class="menu-item"><a href="http://gnu.shptron.com/home/ordering/4374.6.1.1" target="_blank" id="link-ordering">Ordering Info</a></li>
							</ul>
						</div><!-- .nav-group -->
					</nav><!-- .footer-menu -->
					<div class="region-social-wrapper">
						<div class="region-toggle">
							<h5>Select Region</h5>
							<a href="#region-selector" class="h4">United States (USD)</a>
						</div>
						<ul class="social-icons nav-menu">
							<li class="menu-item"><a href="http://www.facebook.com/gnuSnowboards" class="icon-facebook" target="_blank"><span class="offscreen">Facebook</span></a></li>
							<li class="menu-item"><a href="http://instagram.com/GNUsnowboards" class="icon-instagram" target="_blank"><span class="offscreen">Instagram</span></a></li>
							<li class="menu-item"><a href="http://twitter.com/GNUsnowboards" class="icon-twitter" target="_blank"><span class="offscreen">Twitter</span></a></li>
							<li class="menu-item"><a href="http://vimeo.com/gnu" class="icon-vimeo" target="_blank"><span class="offscreen">Vimeo</span></a></li>
							<li class="menu-item"><a href="<?php bloginfo('rss2_url'); ?>" class="icon-rss" target="_blank"><span class="offscreen">RSS</span></a></li>
						</ul>
					</div><!-- .region-social-wrapper -->
					<div class="clearfix"></div>
					<p>701 N. 34th St, Ste #100 – Seattle, WA 98103 <span>&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?></span></p>
				</div><!-- .footer-content -->
			</div><!-- .footer-wrapper -->
		</footer><!-- #colophon -->
	</div><!-- #page -->
	<div class="responsive-check">
		<div class="breakpoint-small"></div>
		<div class="breakpoint-medium"></div>
		<div class="breakpoint-large"></div>
	</div><!-- .responsive-check -->
	<?php wp_footer(); ?>

	<!-- JavaScript includes -->
<?php include '_/inc/footer-includes.php' ?>

	<!-- Init the main JS -->
	<script type="text/javascript">
		$(document).ready(function(){
			GNU.Main.init();
		});
	</script>
	<!-- Social Media Includes -->
	<div id="fb-root"></div>
	<script type="text/javascript">
		// Facebook
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=217173258409585";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		// Twitter
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
		// Google+
		(function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		})();
		// Pinterest
		(function(d){
			var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
			p.type = 'text/javascript';
			p.async = true;
			p.src = '//assets.pinterest.com/js/pinit.js';
			f.parentNode.insertBefore(p, f);
		}(document));
	</script>
</body>
</html>
