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
		var self, responsiveObject, responsiveSize;
		self = this;
		// set up owl carousel(s)
		if ($('#mens-snowboards').length) {
			// we're viewing snowboards
			responsiveObject = {
				0:{ items: 1, dots: false },
				310: { items: 2, dots: false },
				430: { items: 3, dots: false },
				550:{ items: 4, dots: false },
				670:{ items: 5, dots: false },
				748:{ items: 3, dots: true },
				950:{ items: 4, dots: true },
				1170:{ items: 5, dots: true },
				1390:{ items: 6, dots: true },
				1610:{ items: 7, dots: true },
				1830:{ items: 8, dots: true },
				2050:{ items: 9, dots: true },
				2270:{ items: 10, dots: true },
				2490:{ items: 11, dots: true },
				2710:{ items: 12, dots: true },
				2930:{ items: 13, dots: true },
				3150:{ items: 14, dots: true },
				3370:{ items: 15, dots: true }
			};
		} else if ($('#mens-team').length) {
			// we're viewing team
			responsiveObject = {
				0:{ items: 1, dots: false },
				550: { items: 2, dots: false },
				748: { items: 1, dots: true },
				970: { items: 2, dots: true },
				1420: { items: 3, dots: true },
				1870:{ items: 4, dots: true },
				2320:{ items: 5, dots: true },
				2770:{ items: 6, dots: true },
				3220:{ items: 7, dots: true },
				3670:{ items: 8, dots: true },
				4120:{ items: 9, dots: true }
			};
		} else {
			// we're viewing bindings and supplies
			responsiveObject = {
				0:{ items: 1, dots: false },
				320: { items: 2, dots: false, stagePadding: 5 },
				390: { items: 2, dots: false },
				550: { items: 3, dots: false },
				710:{ items: 4, dots: false },
				748:{ items: 2, dots: true, stagePadding: 20 },
				790:{ items: 2, dots: true },
				1150:{ items: 3, dots: true },
				1510:{ items: 4, dots: true },
				1870:{ items: 5, dots: true },
				2230:{ items: 6, dots: true },
				2590:{ items: 7, dots: true },
				2950:{ items: 8, dots: true },
				3310:{ items: 9, dots: true },
				3670:{ items: 10, dots: true },
				4030:{ items: 11, dots: true },
				4390:{ items: 12, dots: true }
			};
		}
		$(".product-overview .owl-carousel").owlCarousel({
			lazyLoad: true,
			slideBy: 2,
			stagePadding: 40,
			margin: 10,
			responsive: responsiveObject
		});
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
		} else {
			TweenMax.to('.product-overview .product-list .product a .info', 0, {scale: 1, force3D: true});
			TweenMax.to('.product-overview .product-list .product a .image', 0, {scale: 1, force3D: true});
			$('.product-overview .product-list .product a .info, .product-overview .product-list .product a .image').removeAttr('style');
			// remove listeners for mobile
			$('.product-overview .product-list .product a').off('mouseover.productOverview, mouseout.productOverview');
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
