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
						<li class="us">
							<p class="small"><a href="#region-selector" data-currency="USD"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/usa.gif" alt="USA Flag" />United States <span>(USD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="CAD"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/canada.gif" alt="Canada Flag" />Canada <span>(CAD)</span></a></p>
						</li>
					</ul>
				</div>
				<div class="location-group europe">
					<h3 class="location-title">Europe</h3>
					<ul class="location-list">
						<li class="us">
							<p class="small"><a href="#region-selector" data-currency="EUD">Austria <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Belgium <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Czech Republic <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Denmark <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Estonia <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">France <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Germany <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Hungary <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Ireland <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Italy <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Latvia <span>(EUD)</span></a></p>
						</li>
					</ul>
					<ul class="location-list">
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Liechtenstein <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Lithuania <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Luxembourg <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Netherlands <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Poland <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Portugal <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Romania <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Slovakia <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Slovenia <span>(EUD)</span></a></p>
						</li>
						<li class="ca">
							<p class="small"><a href="#region-selector" data-currency="EUD">Spain <span>(EUD)</span></a></p>
						</li>
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
								<li class="menu-item"><a href="http://www.mervin.com/support/register/" target="_blank">Register</a></li>
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
	<!-- AdRoll -->
	<script type="text/javascript">
		adroll_adv_id = "OPXHQUBUYRGNZHAWFBAHVE";
		adroll_pix_id = "YFARZDWU5BEYPLORNYCKQI";
		(function () {
			var oldonload = window.onload;
			window.onload = function(){
				__adroll_loaded=true;
				var scr = document.createElement("script");
				var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
				scr.setAttribute('async', 'true');
				scr.type = "text/javascript";
				scr.src = host + "/j/roundtrip.js";
				((document.getElementsByTagName('head') || [null])[0] ||
				document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
				if(oldonload){oldonload();}
			};
		}());
	</script>
	<!-- Google Analytics -->
	<script type="text/javascript">
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-10240628-1', 'auto');
		ga('send', 'pageview');
	</script>
</body>
</html>
