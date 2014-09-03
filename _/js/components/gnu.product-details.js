/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.ProductDetails = function () {
	this.config = {
		pastWaypoint: false
	};
	this.init();
};
GNU.ProductDetails.prototype = {
	init: function () {
		var self = this;
		self.initThumbnailCarousel();
		self.initAvailability();
		self.initNavigation();
		$('.product-video').fitVids();
		self.initSpecs();
		// wait for images to load and build the carousel
		$(window).on('load', function () {
			self.initProductCarousel();
		});
	},
	initProductCarousel: function () {
		var self = this;
		self.updateCarouselImageSize();
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
		$(window).on('resize.productDetails', function () {
			self.updateCarouselImageSize();
		});
	},
	updateCarouselImageSize: function () {
		var self, widthPercentage, windowWidth, contentWidth, sectionWidth, productImageWidth, maxImageHeight, maxImageWidth;
		self = this;
		// check for the desktop+ width
		if ( GNU.Main.utilities.responsiveCheck() == "large" ) {
			// set vars
			widthPercentage = $('.product-image').width() / $('.product-image').height();
			windowWidth = $(window).width();
			contentWidth = $('.product-main').width();
			sectionWidth = $('.product-main .section-content').width();
			productImageWidth = (contentWidth - sectionWidth) + ((windowWidth - contentWidth) / 2);
			maxImageHeight = $(window).height() - $('.product-images').position().top;
			maxImageWidth = 536;
			// check max image height
			if (productImageWidth + (productImageWidth * widthPercentage) > maxImageHeight) {
				productImageWidth = maxImageHeight * widthPercentage;
				if (productImageWidth < maxImageWidth) {
					productImageWidth = maxImageWidth;
				}
			}
			// round to whole number
			productImageWidth = Math.floor(productImageWidth);
			// set width of image carousel
			$('.product-images').width(productImageWidth);
			// set right positioning, center in available space
			$('.product-images').css( 'right', (windowWidth - (((windowWidth - contentWidth) / 2) + sectionWidth) - productImageWidth) / 2 );
			// on scroll check for specs waypoint
			$(window).on('scroll.productDetails', function () {
				checkForSpecsWaypoint();
			});
			checkForSpecsWaypoint();
		} else {
			// any width smaller than desktop/large remove fixed width/absolute position
			$('.product-images').removeAttr('style');
			// remove scroll check for desktop specs waypoint
			$(window).off('scroll.productDetails');
		}
		// check to see if we've past the specs and update the product image carousel
		function checkForSpecsWaypoint () {
			var windowScrollTop, windowHeight, specsOffset, productImageHeight, productImageTop;
			windowScrollTop = $(window).scrollTop();
			windowHeight = $(window).height();
			specsOffset = $('#specifications').offset().top;
			productImageHeight = $('.product-image').height();
			productImageTop = $('.product-images').position().top;
			// check to see if we have past the waypoint or not
			if (specsOffset < windowScrollTop + productImageHeight + productImageTop && self.config.pastWaypoint === false) {
				// past waypoint
				// change images to absolute position and adjust top height
				$('.product-images').css('position', 'absolute').css('top', specsOffset - productImageHeight);
				self.config.pastWaypoint = true;
				
			} else if (windowScrollTop < productImageTop && self.config.pastWaypoint === true) {
				// before waypoint
				// reset image carousel to use fixed position
				$(window).off('scroll.productDetails');
				$('.product-images').removeAttr('style');
				self.config.pastWaypoint = false;
				self.updateCarouselImageSize();
			}
		}
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
	},
	initSpecs: function () {
		$('.spec-navigation ul li a').on('click', function (e) {
			e.preventDefault();
			// reset selected nav items
			$('.spec-navigation ul li a').removeClass('active');
			// hide all spec listings
			$('.spec-listing').removeClass('active');
			// select active nav item
			$(this).addClass('active');
			// select spec to show
			var objId = $(this).attr('href');
			$(objId).addClass('active');
		});
		// fire click event on first element
		$('.spec-navigation ul li:first a').click();
	}
};
