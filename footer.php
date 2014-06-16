<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage 1415-GNU-WordPress-Theme
 * @since 1415 GNU WordPress Theme 1.0.0
 */
?>

		</div><!-- #main -->
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
								<li class="menu-item"><a href="/events/">Events</a></li>
								<li class="menu-item"><a href="/store-locator/">Store Locator</a></li>
							</ul>
						</div><!-- .nav-group -->
						<div class="nav-group">
							<h3>Support</h3>
							<ul class="nav-menu">
								<li class="menu-item"><a href="http://www.mervin.com/contact/" target="_blank">Contact</a></li>
								<li class="menu-item"><a href="http://www.mervin.com/support/register/" target="_blank">Register</a></li>
								<li class="menu-item"><a href="http://www.mervin.com/support/warranty/">Warranty</a></li>
								<li class="menu-item"><a href="/faq/">Faq</a></li>
								<li class="menu-item"><a href="/partners/">Partners</a></li>
								<li class="menu-item"><a href="/binding-manual/">Manual</a></li>
								<li class="menu-item"><a href="/supplies/#">Spare Parts</a></li>
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
							<li class="menu-item"><a href="http://pinterest.com/gnugirls" class="icon-pinterest" target="_blank"><span class="offscreen">Pinterest</span></a></li>
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
			GNU.main.init();
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
	<!-- Google Analytics -->
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-10240628-1']);
		_gaq.push(['_setDomainName', '.gnu.com']);
		_gaq.push(['_setAllowHash', false]);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
</body>
</html>
