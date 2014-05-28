<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage 1415-GNU-WordPress-Theme
 * @since 1415 GNU WordPress Theme 1.0.0
 */
?>
		<footer id="footer" class="source-org vcard copyright" role="contentinfo">
			<small>&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?></small>
		</footer>
	</div><!-- END #wrapper -->

	<?php wp_footer(); ?>

	<!-- JavaScript includes -->
<?php include '_/inc/footer-includes.php' ?>
	
	<!-- Init the main JS -->
	<script type="text/javascript">
		$(document).ready(function(){
			APP.main.init();
		});
	</script>
	<!-- Social Media Includes -->
	<!--
	<div id="fb-root"></div>
	<script type="text/javascript">
		// Facebook
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=352899581451617";
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
	</script>
	<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
	-->
	<!-- Google Analytics -->
	<!--
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
		_gaq.push(['_setDomainName', '.XXXXXXXXX.com']);
		_gaq.push(['_setAllowHash', false]);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
	-->
</body>
</html>
