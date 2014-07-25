/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.ProductOverview = function () {
	this.config = {
		carousel: null
	};
	this.init();
	console.log('wtf');
};
GNU.ProductOverview.prototype = {
	init: function () {
		var self, responsiveSize;
		self = this;
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.productOverview', function () {
			if ( responsiveSize != "base" && GNU.Main.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				self.setupProducts();
			} else if ( responsiveSize != "small" && GNU.Main.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				self.setupProducts();
			} else if ( responsiveSize != "medium" && GNU.Main.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				self.setupProducts();
			} else if ( responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				self.setupProducts();
			}
		});
		self.setupProducts();
	},
	setupProducts: function () {
		var self = this;
		// reset carousel
		// need to fix this, bug with destroy method currently
		// self.config.carousel.destory();
		// set up owl carousel
		self.config.carousel = $(".product-overview .owl-carousel").owlCarousel({
			items: 8,
			responsive: false,
			autoWidth: true,
			dots: false,
			lazyLoad: true,
			autoplay: true,
			autoplayTimeout: 3000,
			autoplayHoverPause: true,
			margin: 10,
			loop: true
		});
		if ( GNU.Main.utilities.responsiveCheck() === 'medium' || GNU.Main.utilities.responsiveCheck() === 'large' ) {
			TweenMax.to('.product-overview .product-list .product a .info', 0, {scale: 1, force3D: true});
			TweenMax.to('.product-overview .product-list .product a .image', 0, {scale: 0.95, force3D: true});
			// add listners for over and out
			$('.product-overview .product-list .product a').on('mouseover', function () {
				$info = $(this).find('.info');
				$image = $(this).find('.image');
				TweenMax.to($info, 0.2, {scale: 1.05, force3D: true});
				TweenMax.to($image, 0.2, {scale: 1, force3D: true});
			}).on('mouseout', function () {
				$info = $(this).find('.info');
				$image = $(this).find('.image');
				TweenMax.to($info, 0.2, {scale: 1, force3D: true});
				TweenMax.to($image, 0.2, {scale: 0.95, force3D: true});
			});
		} else {
			TweenMax.to('.product-overview .product-list .product a .info', 0, {scale: 1, force3D: true});
			TweenMax.to('.product-overview .product-list .product a .image', 0, {scale: 1, force3D: true});
			$('.product-overview .product-list .product a .info, .product-overview .product-list .product a .image').removeAttr('style');
			// remove listeners for mobile
			$('.product-overview .product-list .product a').off('mouseover.productOverview, mouseout.productOverview');
		}
	}
}













