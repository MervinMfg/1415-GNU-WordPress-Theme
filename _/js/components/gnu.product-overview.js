/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.ProductOverview = function () {
	this.config = {};
	this.init();
};
GNU.ProductOverview.prototype = {
	init: function () {
		var self, responsiveSize;
		self = this;
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.productOverview', function () {
			if ( responsiveSize != "base" && GNU.Main.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				self.productsInit();
			} else if ( responsiveSize != "small" && GNU.Main.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				self.productsInit();
			} else if ( responsiveSize != "medium" && GNU.Main.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				self.productsInit();
			} else if ( responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				self.productsInit();
			}
		});
		self.productsInit();
		self.instructionsInit();
	},
	productsInit: function () {
		var self = this;
		// reset owl carousel(s)
		if (typeof $(".product-overview .owl-carousel").data('owl.carousel') !== 'undefined') {
			$(".product-overview .owl-carousel").each(function() {
				$(this).data('owl.carousel').destroy();
			});
		}
		if ( GNU.Main.utilities.responsiveCheck() === 'medium' || GNU.Main.utilities.responsiveCheck() === 'large' ) {
			TweenMax.to('.product-overview .product-list .product a .info', 0, {scale: 1, force3D: true});
			TweenMax.to('.product-overview .product-list .product a .image', 0, {scale: 0.95, force3D: true});
			// add listners for over and out
			$('.product-overview .product-list .product a').on('mouseover.productOverview', function () {
				$info = $(this).find('.info');
				$image = $(this).find('.image');
				TweenMax.to($info, 0.2, {scale: 1.05, force3D: true});
				TweenMax.to($image, 0.2, {scale: 1, force3D: true});
			}).on('mouseout.productOverview', function () {
				$info = $(this).find('.info');
				$image = $(this).find('.image');
				TweenMax.to($info, 0.2, {scale: 1, force3D: true});
				TweenMax.to($image, 0.2, {scale: 0.95, force3D: true});
			});
			// set up owl carousel(s)
			$(".product-overview .owl-carousel").owlCarousel({
				items: 8,
				responsive: false,
				autoWidth: true,
				dots: false,
				lazyLoad: true,
				autoplay: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				margin: 20,
				loop: true,
				nav: false
			});
		} else {
			TweenMax.to('.product-overview .product-list .product a .info', 0, {scale: 1, force3D: true});
			TweenMax.to('.product-overview .product-list .product a .image', 0, {scale: 1, force3D: true});
			$('.product-overview .product-list .product a .info').removeAttr('style'); // omit '.product-overview .product-list .product a .image'
			// remove listeners for mobile
			$('.product-overview .product-list .product a').off('mouseover.productOverview, mouseout.productOverview');
			// set up owl carousel(s)
			$(".product-overview .owl-carousel").owlCarousel({
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
		}
	},
	instructionsInit: function () {
		var instructionTimeout = window.setTimeout( function () {
			$('.product-overview .product-filters .instructions').addClass('show');
		}, 3000);
		$('.product-list').on('mousedown.instructions', function () {
			window.clearTimeout(instructionTimeout);
			$('.product-overview .product-filters .instructions').removeClass('show');
		});	
	}
};
