/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.FeaturedProducts = function () {
	this.config = {
		dots: false,
		loop: false
	};
	// check to see if slider should be activated
	if ($('.featured-products .featured-products-list .featured-product').length > 1) {
		this.config.dots = true;
	}
	if ($('.featured-products .featured-products-list .featured-product').length > 4) {
		this.config.loop = true;
	}
	this.init();
};
GNU.FeaturedProducts.prototype = {
	init: function () {
		var self, carousel;
		self = this;
		// set up owl carousel
		carousel = $(".featured-products .owl-carousel").owlCarousel({
			items: 1,
			dots: self.config.dots,
			lazyLoad: true,
			autoplay: true,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			loop: self.config.loop,
			responsiveClass:true,
			responsive:{
				0:{
					items: 1
				},
				748:{
					items: 2,
					margin: 10
				},
				1056:{
					items: 3,
					margin: 10
				},
				1424:{
					items: 4,
					margin: 10
				}
			}
		});
	}
};
