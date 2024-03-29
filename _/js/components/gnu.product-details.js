/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.ProductDetails = function (scrollController) {
	this.config = {
		currency: null,
		productCarousel: null,
		pastWaypoint: false,
		scene: null,
		scene2: null,
		scene3: null,
		scene4: null,
		scene5: null,
		scrollController: scrollController,
		responsiveSize: null
	};
	this.init();
};
GNU.ProductDetails.prototype = {
	init: function () {
		var self = this;
		self.initAvailability();
		$('.product-video').fitVids();
		self.initSpecs();
		self.initProductNavigation();
		self.initBuy();
		if ($('body').hasClass('single-gnu_bindings')) self.initBindingAnimation();
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
			dots: true,
			lazyLoad: true,
			mouseDrag: false,
			touchDrag: false,
			animateIn: 'pulse'
		});
		$(window).on('resize.productCarousel', function () {
			self.updateCarouselImageSize();
		});
		// listen for click of images / zoom
		$(".product-images .image-list .product-image a").on('click', function (e) {
			// only run zoom functionality if we're on tablet or bigger
			if (GNU.Main.utilities.responsiveCheck() == "medium" || GNU.Main.utilities.responsiveCheck() == "large") {
				var prevPosition = $(".owl-carousel").data('owl.carousel').current();
				e.preventDefault();
				$(".product-main").toggleClass('zoom-active');
				// destory and rebuild, calling refresh seems to do nothing
				$('.product-images').removeAttr('style');
				$(".owl-carousel").data('owl.carousel').destroy();
				if (!$('.product-main').hasClass('zoom-active')) {
					// reset image when zoom is not active
					self.updateCarouselImageSize();
				} else {
					// make sure we are scrolled to top when zoom is selected
					TweenMax.to(window, 0.5, {scrollTo:{y: 0, x: 0}, delay:0.2});
				}
				// build new carousel, refresh doesn't seem to work
				self.config.productCarousel = $(".product-images .owl-carousel").owlCarousel({
					items: 1,
					dots: true,
					lazyLoad: true,
					mouseDrag: false,
					touchDrag: false,
					animateIn: 'pulse',
					startPosition: prevPosition
				});
			}
		});
	},
	updateCarouselImageSize: function () {
		var self, widthPercentage, windowWidth, contentWidth, sectionWidth, productImageWidth, maxImageHeight, minImageWidth;
		self = this;
		// check for the desktop+ width
		if ( GNU.Main.utilities.responsiveCheck() == "large" && !$('.product-main').hasClass('zoom-active')) {
			// set vars
			widthPercentage = $('.product-image').width() / $('.product-image').height();
			windowWidth = $(window).width();
			contentWidth = $('.product-main').width();
			sectionWidth = $('.product-main .section-content').width();
			productImageWidth = (contentWidth - sectionWidth) + ((windowWidth - contentWidth) / 2);
			maxImageHeight = $(window).height() - $('.product-images').position().top;
			minImageWidth = 536;
			// check max image height if it's a snowboard (not square, but vertical)
			if ($('body').hasClass('single-gnu_snowboards') && productImageWidth + (productImageWidth * widthPercentage) > maxImageHeight) {
				productImageWidth = maxImageHeight * widthPercentage;
				if (productImageWidth < minImageWidth) {
					productImageWidth = minImageWidth;
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
			if ($('#specifications').length > 0) {
				specsOffset = $('#specifications').offset().top;
			} else {
				specsOffset = $('#disqus_thread').offset().top;
			}
			productImageHeight = $('.product-image').height();
			productImageTop = $('.product-images').position().top;
			// check to see if we have past the waypoint or not
			if (specsOffset < windowScrollTop + productImageHeight + productImageTop && self.config.pastWaypoint === false && !$('.product-main').hasClass('zoom-active')) {
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
				dots: false,
				lazyLoad: true,
				nav: false,
				responsive: {
					0: { items: 1 },
					210: { items: 2 },
					320: { items: 3 },
					420: { items: 4 },
					525: { items: 5 },
					630: { items: 6 },
					735: { items: 7 },
					840: { items: 8 },
					945: { items: 9 },
					1056: { items: 5 }
				}
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
		var self, navOffset;
		self = this;
		// if we're large or bigger, do the scroll
		if ( self.config.responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
			self.config.responsiveSize = "large";
			// if scene already exists, remove it
			if (typeof self.config.scene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.scene);
				self.config.scrollController.removeScene(self.config.scene2);
				self.config.scrollController.removeScene(self.config.scene3);
				self.config.scrollController.removeScene(self.config.scene4);
				self.config.scrollController.removeScene(self.config.scene5);
			}
			$('.product-navigation').removeAttr('style');
			$('.product-navigation a').removeClass('active');
			// if not ie8 or less, run fixed scroll code
			if ($('html').hasClass('ie-lt9') !== true) {
				navOffset = Math.floor($(window).height() / 2) - ($('.site-header').outerHeight() + $('.site-header').position().top) + 1;
				self.config.scene = new ScrollScene({triggerElement: ".product-navigation", offset: navOffset}).setPin(".product-navigation").addTo(self.config.scrollController);
			}
			// fixed navigation active states
			navOffset = $(window).height() / 2 - 1;
			if ($("#information").length) self.config.scene2 = new ScrollScene({triggerElement: "#information", offset: navOffset, duration: $('#information').height() }).setClassToggle('.product-navigation .info', 'active').addTo(self.config.scrollController);
			if ($("#technology").length) self.config.scene3 = new ScrollScene({triggerElement: "#technology", offset: navOffset, duration: $('#technology').height() }).setClassToggle('.product-navigation .tech', 'active').addTo(self.config.scrollController);
			if ($("#video").length) self.config.scene4 = new ScrollScene({triggerElement: "#video", offset: navOffset, duration: $('#video').height() }).setClassToggle('.product-navigation .video', 'active').addTo(self.config.scrollController);
			if ($("#specifications").length) self.config.scene5 = new ScrollScene({triggerElement: "#specifications", offset: navOffset, duration: $('#specifications').height() }).setClassToggle('.product-navigation .specs', 'active').addTo(self.config.scrollController);
		} else if (self.config.responsiveSize != "other" && GNU.Main.utilities.responsiveCheck() != "large") {
			self.config.responsiveSize = "other";
			// if scene already exists, remove it
			if (typeof self.config.scene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.scene);
				self.config.scrollController.removeScene(self.config.scene2);
				self.config.scrollController.removeScene(self.config.scene3);
				self.config.scrollController.removeScene(self.config.scene4);
				self.config.scrollController.removeScene(self.config.scene5);
			}
			$('.product-navigation').removeAttr('style');
			$('.product-navigation').removeClass('active');
		}
		// listen for click on nav items
		$('.product-navigation a').on('click.productNavigation', function (e) {
			e.preventDefault();
			var url = $(this).attr('href');
			GNU.Main.utilities.pageScroll(url, 0.5);
		});
		// listen for resize
		$(window).on('resize.productNavigation', function () {
			$(this).off('resize.productNavigation');
			$('.product-navigation a').off('click.productNavigation');
			self.initProductNavigation();
		});
	},
	initAvailability: function () {
		var self, currencyCookie;
		self = this;
		currencyCookie = GNU.Main.utilities.cookie.getCookie('gnu_currency');
		if (currencyCookie !== null || currencyCookie !== "") {
			self.config.currency = currencyCookie;
		} else {
			self.config.currency = "USD";
		}
		if (self.config.currency) {
			if (self.config.currency === 'CAD') {
				if ($('.product-buy').data('avail-ca') == "Yes") {
					$('.product-buy').addClass('available');
					// disable unavailable options for specific currency
					$('.product-buy .product-variation option').each(function(index) {
						// snowboards in CA are not handled direct
						if ($('body').hasClass('single-gnu_snowboards')) {
							if ($(this).data('avail-ca') == "No") {
								$(this).attr('disabled', 'disabled');
							}
						} else if ($(this).data('avail-ca') < 1 || $(this).data('avail-ca') == "No") {
							// all other products are handled direct
							$(this).attr('disabled', 'disabled');
						}
					});
				} else {
					$(".product-buy").addClass('unavailable');
				}
			} else if (self.config.currency === 'EUR') {
				if ($('.product-buy').data('avail-eur') == "Yes") {
					$(".product-buy").addClass('available');
					// disable unavailable options for specific currency
					$('.product-buy .product-variation option').each(function(index) {
						// all products are handled direct
						if ($(this).data('avail-eur') < 1 || $(this).data('avail-eur') == "No") {
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
						// snowboards in US are not handled direct
						if ($('body').hasClass('single-gnu_snowboards')) {
							if ($(this).data('avail-us') == "No") {
								$(this).attr('disabled', 'disabled');
							}
						} else if ($(this).data('avail-us') < 1 || $(this).data('avail-us') == "No") {
							// all other products are handled direct
							$(this).attr('disabled', 'disabled');
						}
					});
				} else {
					$(".product-buy").addClass('unavailable');
				}
			}
		}
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
			var productSKU, productSKUs, productAvail, productThumbs;
			productSKU = $(this).val();
			productSKUs = [];
			if (productSKU != "-1") {
				$(this).removeClass('alert');
			}
			// check current stock based on currency
			if (self.config.currency == "CAD") {
				productAvail = $(this).find(':selected').attr('data-avail-ca');
			} else if (self.config.currency == "EUR") {
				productAvail = $(this).find(':selected').attr('data-avail-eur');
			} else {
				productAvail = $(this).find(':selected').attr('data-avail-us');
			}
			// reset available alert message
			$('.product-buy .available-alert').removeClass('no low');
			// check if we're a snowboard with none avail, or if we're a product with low avail
			if ( ($('body').hasClass('single-gnu_snowboards') && productAvail == "0") || ($('body').hasClass('single-gnu_snowboards') && productAvail === "")) {
				$('.product-buy .available-alert').addClass('no');
			} else if (productAvail < 10) {
				$('.product-buy .available-alert').addClass('low');
			}
			// remove active states from product thumbnails
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
				$('.product-variation').addClass('alert');
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
	},
	initBindingAnimation: function () {
		$(".binding-animation .owl-carousel").owlCarousel({
			items: 1,
			dots: true,
			lazyLoad: true,
			mouseDrag: false,
			touchDrag: false,
			animateIn: 'fadeIn'
		});
	}
};
