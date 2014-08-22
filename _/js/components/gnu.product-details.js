/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.ProductDetails = function () {
	this.config = {};
	this.init();
};
GNU.ProductDetails.prototype = {
	init: function () {
		var self = this;
		self.initProductCarousel();
		self.initThumbnailCarousel();
		self.initAvailability();
		self.initNavigation();
		$('.product-video').fitVids();
	},
	initProductCarousel: function () {
		// set up owl carousel
		$(".product-images .owl-carousel").owlCarousel({
			items: 1,
			dots: false,
			lazyLoad: true,
			nav: true,
			mouseDrag: false,
			touchDrag: false,
			animateIn: 'pulse'
		});
	},
	initThumbnailCarousel: function () {
		if ($(".product-thumbnails .image-list .product-thumbnail").length > 3) {
			// set up owl carousel
			$(".product-thumbnails .owl-carousel").owlCarousel({
				items: 3,
				responsive: false,
				dots: false,
				lazyLoad: true,
				nav: false
			});
		} else {
			$("img.owl-lazy").unveil();
		}
	},
	initAvailability: function () {
		var currencyCookie, currency;
		currencyCookie = GNU.Main.utilities.cookie.getCookie('gnu_currency');
		if (currencyCookie !== null || currencyCookie !== "") {
			currency = currencyCookie;
		}
		if (currency) {
			if (currency === 'CAD') {
				if ($('.product-buy').data('avail-ca') == "Yes") {
					$('.product-buy').addClass('available');
					// disable unavailable options for specific currency
					$('.product-buy .product-variation option').each(function(index) {
						if ($(this).data('avail-ca') == "No") {
							$(this).attr('disabled', 'disabled');
						}
					});
				} else {
					$(".product-buy").addClass('unavailable');
				}
			} else if (currency === 'EUD') {
				if ($('.product-buy').data('avail-eur') == "Yes") {
					$(".product-buy").addClass('available');
					// disable unavailable options for specific currency
					$('.product-buy .product-variation option').each(function(index) {
						if ($(this).data('avail-eur') == "No") {
							$(this).attr('disabled', 'disabled');
						}
					});
				} else {
					$(".product-buy").addClass('unavailable');
				}
			} else {
				if ($('.product-buy').data('avail-us') == "Yes") {
					$(".product-buy").addClass('available');
					// disable unavailable options for specific currency
					$('.product-buy .product-variation option').each(function(index) {
						if ($(this).data('avail-us') == "No") {
							$(this).attr('disabled', 'disabled');
						}
					});
				} else {
					$(".product-buy").addClass('unavailable');
				}
			}
		}
	},
	initNavigation: function () {
		$('.product-navigation a').on('click', function (e) {
			e.preventDefault();
			var url = $(this).attr('href');
			GNU.Main.utilities.pageScroll(url, 0.5);
		});
	}
}
