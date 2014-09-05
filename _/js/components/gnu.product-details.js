/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.ProductDetails = function (scrollController) {
	this.config = {
		productCarousel: null,
		pastWaypoint: false,
		scene: null,
		scrollController: scrollController
	};
	this.init();
};
GNU.ProductDetails.prototype = {
	init: function () {
		var self = this;
		self.initAvailability();
		self.initNavigation();
		$('.product-video').fitVids();
		self.initSpecs();
		self.initProductNavigation();
		self.initBuy();
		// wait for images to load and build the carousel
		$(window).on('load', function () {
			self.initProductCarousel();
			self.initThumbnailCarousel();
		});
	},
	initProductCarousel: function () {
		var self = this;
		self.updateCarouselImageSize();
		// set up owl carousel
		self.config.productCarousel = $(".product-images .owl-carousel").owlCarousel({
			items: 1,
			dots: false,
			lazyLoad: true,
			mouseDrag: false,
			touchDrag: false,
			animateIn: 'pulse'
		});
		$(window).on('resize.productCarousel', function () {
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
		var self = this;
		if ($(".product-thumbnails .image-list .product-thumbnail").length > 1) {
			// set up owl carousel
			$(".product-thumbnails .owl-carousel").owlCarousel({
				items: 3,
				responsive: false,
				dots: false,
				lazyLoad: true,
				nav: false
			});
		} else {
			$(".product-thumbnails").addClass('hidden');
		}
		$('.product-thumbnails .image-list .product-thumbnail a').on('click', function (e) {
			var imageIndex;
			e.preventDefault();
			if ($(".product-thumbnails .image-list .product-thumbnail").length == 1) {
				// only 1 thumbnail
				imageIndex = $(this).parent().index();
			} else {
				imageIndex = $(this).parent().parent().index();
			}
			// trigger owl event to display appropriate product image 
			self.config.productCarousel.trigger('to.owl.carousel', [imageIndex, 1, 1]);
		});
	},
	initProductNavigation: function () {
		var self, responsiveSize, navOffset;
		self = this;
		// if we're large or bigger, do the scroll
		if ( responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
			responsiveSize = "large";
			// if scene already exists, remove it
			if (typeof self.config.scene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.scene);
			}
			$('.product-navigation').removeAttr('style');
			navOffset = Math.floor($(window).height() / 2) - $('.site-header').outerHeight() + 1;
			self.config.scene = new ScrollScene({triggerElement: ".product-navigation", offset: navOffset}).setPin(".product-navigation").addTo(self.config.scrollController);
		} else if (GNU.Main.utilities.responsiveCheck() != "other") {
			responsiveSize = "other";
			// if scene already exists, remove it
			if (typeof self.config.scene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.scene);
			}
			$('.product-navigation').removeAttr('style');
		}
		$(window).on('resize.productNavigation', function () {
			$(this).off('resize.productNavigation');
			self.initProductNavigation();
		});
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
	},
	initBuy: function () {
		var self = this;
		// ADD TO CART COMPLETION METHODS
		function addToCartSuccess() {
			// update quickcart
			GNU.Main.config.shop.quickCartInit();
			GNU.Main.config.shop.showQuickCart();
		}
		function addToCartError() {
			$('.product-buy .product-available .failure').removeClass('hidden');
		}
		function addToCartComplete() {
			$('.product-buy .product-available .loading').addClass('hidden');
			$('.product-buy .product-available .form').removeClass('hidden');
		}
		// FUNCTIONALITY FOR PRODUCTS WITH ONLY 1 SELECTION
		$('.product-variation').change(function () {
			// display the correct image matching selected option
			var productSKU, productSKUs, productThumbs;
			productSKU = $(this).val();
			productSKUs = [];
			if (productSKU != "-1") {
				$(this).removeClass('alert');
			}
			$(".product-thumbnails .product-thumbnail a").each(function () {
				var skus = $(this).attr('data-sku');
				productSKUs.push([$(this), skus]);
				$(this).removeClass('active');
			});
			for (var i = 0; i < productSKUs.length; i++) {
				var skus = productSKUs[i][1];
				if (skus.indexOf(productSKU) != -1) {
					productSKUs[i][0].click();
					break;
				}
			}
		});
		// add to cart api btn
		$('.add-to-cart').on('click', function (e) {
			var productSKU;
			e.preventDefault();
			// check size selection
			productSKU = $('.product-variation').val();
			if (productSKU === "-1") {
				// add alert to class
				$('#product-variation').addClass('alert');
				return;
			}
			// hide add to cart, show loading while request is made
			$('.product-buy .product-available .loading').removeClass('hidden');
			$('.product-buy .product-available .form').addClass('hidden');
			// make sure to hide cart failure message on each add
			$('.product-buy .product-available .failure').addClass('hidden');
			// call shopatron's api
			Shopatron.addToCart({
				quantity: '1', // Optional: Defaults to 1 if not set
				partNumber: productSKU // Required: This is the product that will be added to the cart.
			}, {
				// All event handlers are optional
				success: function (data, textStatus) {
					addToCartSuccess();
				},
				error: function (textStatus, errorThrown) {
					addToCartError();
				},
				complete: function (textStatus) {
					addToCartComplete();
				}
			});
		});
	}
};
