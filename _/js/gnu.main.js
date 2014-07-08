/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

 var GNU = GNU || {};

GNU.main = {
	config: {
		wpImgPath: '/wp-content/themes/1415-GNU-WordPress-Theme/_/img/'
	},
	init: function () {
		var self, $body;
		self = this;
		$body = $('body');
		// init global components
		self.shopatronInit();
		self.regionSelectorInit();
		self.menuInit();
		self.searchInit();
		// lazy load of images
		$("img.lazy").unveil();
		// trigger load before scroll or resize
		$(window).on('load.lazy', function () { $(window).resize(); $(window).off('load.lazy')});
		// init respective page template
		if ($body.hasClass('home')) {
			self.homeInit();
		} else if ($body.hasClass('page-template-page-templatespage-home-sport-php')) {
			self.homeSportInit();
		}
	},
	homeInit: function () {
		var self = this;
		self.featuredSliderInit();
		self.featuredPostsInit();
		self.photoSliderInit();
		self.featuredProductsInit();
		self.followInit();
	},
	featuredSliderInit: function () {
		var self, carousel, displayDots;
		self = this;
		// check to see if pagination on slider should be displayed
		if ($('.featured-slider .slide-list .slide-item').length > 1) {
			displayDots = true;
		} else {
			displayDots = false;
		}
		// set up owl carousel
		carousel = $(".featured-slider .owl-carousel").owlCarousel({
			items: 1,
			dots: displayDots,
			lazyLoad: true,
			autoplay: true,
			autoplayTimeout: 8000,
			autoplayHoverPause: true,
			loop: true
		});
		// set up background scroll animation functionality
		function initFeaturedScroll() {
			// reset background position css
			$('.featured-slider .slide-list .slide-item').css('background-position', '50% 100%');
			// set up controller
			if (typeof controller !== 'undefined') {
				controller.destroy();
			}
			// if we're medium or bigger, do the scroll. hidden on base and small
			if ( self.utilities.responsiveCheck() === 'medium' || self.utilities.responsiveCheck() === 'large' ) {
				controller = new ScrollMagic({vertical: true});
				tween = new TweenMax.to('.featured-slider .slide-list .slide-item', 1, {backgroundPosition: "50% 0%", ease: Linear.easeNone});
				scene = new ScrollScene({triggerElement: '.featured-slider', offset: $(window).height()/2*-1, duration: $(window).height() + $('.featured-slider').outerHeight()}).setTween(tween).addTo(controller);
			}
		}
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.featuredSlider', function () {
			if ( responsiveSize != "base" && self.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				initFeaturedScroll();
			} else if ( responsiveSize != "small" && self.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				initFeaturedScroll();
			} else if ( responsiveSize != "medium" && self.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				initFeaturedScroll();
			} else if ( responsiveSize != "large" && self.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				initFeaturedScroll();
			}
		});
		initFeaturedScroll();
	},
	photoSliderInit: function () {
		var self, carousel, controller, tween, scene, responsiveSize, displayDots;
		self = this;
		// check to see if pagination on slider should be displayed
		if ($('.photo-slider .photo-list .photo-item').length > 1) {
			displayDots = true;
		} else {
			displayDots = false;
		}
		// set up owl carousel
		carousel = $(".photo-slider .owl-carousel").owlCarousel({
			items: 1,
			dots: displayDots,
			lazyLoad: true,
			autoplay: true,
			autoplayTimeout: 8000,
			autoplayHoverPause: true,
			loop: true
		});
		// set up background scroll animation functionality
		function initPhotoScroll() {
			// reset background position css
			$('.photo-slider .photo-list .photo-item').css('background-position', '50% 100%');
			// set up controller
			if (typeof controller !== 'undefined') {
				controller.destroy();
			}
			// if we're medium or bigger, do the scroll. hidden on base and small
			if ( self.utilities.responsiveCheck() === 'medium' || self.utilities.responsiveCheck() === 'large' ) {
				controller = new ScrollMagic({vertical: true});
				tween = new TweenMax.to('.photo-slider .photo-list .photo-item', 1, {backgroundPosition: "50% 0%", ease: Linear.easeNone});
				scene = new ScrollScene({triggerElement: '.photo-slider', offset: $(window).height()/2*-1, duration: $(window).height() + $('.photo-slider').outerHeight()}).setTween(tween).addTo(controller);
			}
		}
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.photoSlider', function () {
			if ( responsiveSize != "base" && self.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				initPhotoScroll();
			} else if ( responsiveSize != "small" && self.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				initPhotoScroll();
			} else if ( responsiveSize != "medium" && self.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				initPhotoScroll();
			} else if ( responsiveSize != "large" && self.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				initPhotoScroll();
			}
		});
		initPhotoScroll();
	},
	featuredPostsInit: function () {
		var self, controller, tween, scene, responsiveSize;
		self = this;
		function initPostsScroll() {
			$('.featured-posts').removeClass('animate');
			$('.featured-posts .featured-post').removeAttr('style');
			// set up controller
			if (typeof controller !== 'undefined') {
				controller.destroy();
			}
			if ( self.utilities.responsiveCheck() === 'medium' || self.utilities.responsiveCheck() === 'large' ) {
				$('.featured-posts').addClass('animate');
				controller = new ScrollMagic({vertical: true});
				tween = new TweenMax.to('.featured-posts .featured-post-list .featured-post', 1, {marginLeft: "0px", marginRight: "0px", ease: Linear.easeNone});
				scene = new ScrollScene({triggerElement: '.featured-posts', offset: $(window).height()/2*-1, duration: $(window).height()/2}).setTween(tween).addTo(controller);
			}
		}
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.featuredPosts', function () {
			if ( responsiveSize != "base" && self.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				initPostsScroll();
			} else if ( responsiveSize != "small" && self.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				initPostsScroll();
			} else if ( responsiveSize != "medium" && self.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				initPostsScroll();
			} else if ( responsiveSize != "large" && self.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				initPostsScroll();
			}
		});
		$('.featured-posts .featured-post .post-link').on('mouseenter', function () {
			$(this).parents('.featured-post').find('.post-link').addClass('selected');
		}).on('mouseleave', function () {
			$(this).parents('.featured-post').find('.post-link').removeClass('selected');
		});
		initPostsScroll();
	},
	featuredProductsInit: function () {
		var self, carousel;
		self = this;
		// check to see if pagination on slider should be displayed
		if ($('.featured-products .product-list .product').length > 1) {
			displayDots = true;
		} else {
			displayDots = false;
		}
		// set up owl carousel
		carousel = $(".featured-products .owl-carousel").owlCarousel({
			items: 1,
			dots: displayDots,
			lazyLoad: true,
			autoplay: true,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			loop: true
		});
	},
	followInit: function () {
		var self, controller, tween, scene, responsiveSize;
		self = this;
		function initBGScroll() {
			$('.follow').removeAttr('style');
			// set up controller
			if (typeof controller !== 'undefined') {
				controller.destroy();
			}
			controller = new ScrollMagic({vertical: true});
			tween = new TweenMax.to('.follow', 1, {backgroundPosition: "50% 30%", ease: Linear.easeNone});
			scene = new ScrollScene({triggerElement: '.follow', offset: $(window).height()/2*-1, duration: $('.follow').outerHeight() + $('.site-footer').outerHeight()}).setTween(tween).addTo(controller);
		}
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.follow', function () {
			if ( responsiveSize != "base" && self.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				initBGScroll();
			} else if ( responsiveSize != "small" && self.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				initBGScroll();
			} else if ( responsiveSize != "medium" && self.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				initBGScroll();
			} else if ( responsiveSize != "large" && self.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				initBGScroll();
			}
		});
		initBGScroll();
	},
	menuInit: function () {
		var self, controller, tween, scene, responsiveSize;
		self = this;
		// DROPDOWN MENU
		function initJSMenu() {
			// MOBILE DROPDOWN MENU
			// remove old active styles and event listeners
			$('.site-header .header-main, .site-header .header-main .primary-navigation').removeAttr('style');
			$('.site-header .header-main .menu-toggle').removeClass('active');
			$('.site-header .header-main .menu-toggle').off('click.menu');
			// check size and it proper menu settings
			if ( self.utilities.responsiveCheck() === 'base' ) {
				$('.site-header .header-main .menu-toggle').on('click.menu', function (e) {
					var menuHeight, headerHeight;
					e.preventDefault();
					if ($(this).hasClass('active')) {
						$(this).removeClass('active');
						menuHeight = 0;
						headerHeight = menuHeight + $('.site-header .header-main .site-title').height() + 20;
						TweenLite.to('.site-header .header-main .primary-navigation', .5, {height: menuHeight});
						TweenLite.to('.site-header .header-main', .5, {height: headerHeight});
					} else {
						$(this).addClass('active');
						menuHeight = $('.site-header .header-main .primary-navigation .menu-item').outerHeight() * $('.site-header .header-main .primary-navigation .nav-menu').children().length;
						headerHeight = menuHeight + $('.site-header .header-main .site-title').height() + 20;
						TweenLite.to('.site-header .header-main .primary-navigation', .5, {height: menuHeight});
						TweenLite.to('.site-header .header-main', .5, {height: headerHeight});
					}
					
				});
			} else if ( self.utilities.responsiveCheck() === 'small' ) {
				$('.site-header .header-main .menu-toggle').on('click.menu', function (e) {
					var menuHeight, headerHeight;
					e.preventDefault();
					if ($(this).hasClass('active')) {
						$(this).removeClass('active');
						menuHeight = 0;
						headerHeight = menuHeight + $('.site-header .header-main .site-title').height() + 20;
						TweenLite.to('.site-header .header-main .primary-navigation', .3, {height: menuHeight});
						TweenLite.to('.site-header .header-main', .3, {height: headerHeight});
					} else {
						$(this).addClass('active');
						menuHeight = $('.site-header .header-main .primary-navigation .menu-item').outerHeight();
						headerHeight = menuHeight + $('.site-header .header-main .site-title').height() + 20;
						TweenLite.to('.site-header .header-main .primary-navigation', .3, {height: menuHeight});
						TweenLite.to('.site-header .header-main', .3, {height: headerHeight});
					}
				});
			}
			// check if takeover should be initialized
			if ( $('body').hasClass('active-takeover') ) {
				if ($('html').hasClass('ie-lt9')) {
					// if IE8 or earlier, remove takeover
					$('body').removeClass('active-takeover');
				} else {
					initTakeoverScroll();
				}
			}
		}
		// TAKEOVER SCROLLING
		function initTakeoverScroll() {
			// remove previous scroll attributes
			$('.site-header, .site-header .header-wrapper, .site-header .header-main, .site-header .header-main .takeover, .site-header .header-main .takeover .photo, .site-header .header-main .site-title, .site-header .header-main .primary-navigation, .site-header .header-main .primary-navigation .nav-menu, .site-header .header-main .quick-cart-toggle, .site-header .header-main .search-toggle, .site-header .takeover-green-bar, .site-header .takeover-white-fade').removeAttr('style');
			// set up controller
			if (typeof controller !== 'undefined') {
				controller.destroy();
			} 
			// check browser size
			if ( self.utilities.responsiveCheck() == 'medium' ) {
				// TABLET SIZE ANIMATION
				controller = new ScrollMagic({vertical: true});
				// set up scenes/tweens
				tween = new TweenMax.to(".site-header .header-main", 1, {height: "71px", display: 'block', ease: Linear.easeNone});
				scene = new ScrollScene({duration: 409}).setTween(tween).addTo(controller);
				tween = new TimelineMax().add([
					TweenMax.to(".site-header", 1, {backgroundPosition: 'top center', ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-wrapper", 1, {backgroundPosition: '0 20px', ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .takeover", 1, {opacity: 0, ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .takeover .photo", 1, {top: 0, ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .site-title", 1, {display: 'block', top: '20px', left: '0px', ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .primary-navigation", 1, {top: '20px', left: '146px', backgroundPosition: '-590px 0px', width: 'auto', ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .primary-navigation .nav-menu", 1, {fontSize: '22px', ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .quick-cart-toggle", 1, {display: 'block', opacity: 1, ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .search-toggle", 1, {display: 'block', opacity: 1, ease: Linear.easeNone}),
					TweenMax.to(".site-header .takeover-green-bar", 1, {display: 'block', opacity: 1, ease: Linear.easeNone}),
					TweenMax.to(".site-header .takeover-white-fade", 1, {display: 'none', opacity: 0, ease: Linear.easeNone})
				]);
				scene = new ScrollScene({offset: 227, duration: 182}).setTween(tween).addTo(controller);
			} else if ( self.utilities.responsiveCheck() == 'large') {
				// DESKTOP SIZE ANIMATION
				controller = new ScrollMagic({vertical: true});
				// set up scenes/tweens
				tween = new TweenMax.to(".site-header .header-main", 1, {height: "51px", display: 'block', ease: Linear.easeNone});
				scene = new ScrollScene({duration: 429}).setTween(tween).addTo(controller);
				tween = new TimelineMax().add([
					TweenMax.to(".site-header", 1, {backgroundPosition: 'top center', ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-wrapper", 1, {backgroundPosition: '0 0px', ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .takeover", 1, {opacity: 0, ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .takeover .photo", 1, {top: 0, ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .site-title", 1, {display: 'block', opacity: 1, top: '0px', left: '0px', ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .primary-navigation", 1, {top: '0px', left: '146px', backgroundPosition: '-590px 0px', width: 'auto', ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .primary-navigation .nav-menu", 1, {fontSize: '22px', ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .quick-cart-toggle", 1, {display: 'block', opacity: 1, ease: Linear.easeNone}),
					TweenMax.to(".site-header .header-main .search-toggle", 1, {display: 'block', opacity: 1, ease: Linear.easeNone}),
					TweenMax.to(".site-header .takeover-green-bar", 1, {display: 'block', opacity: 1, ease: Linear.easeNone}),
					TweenMax.to(".site-header .takeover-white-fade", 1, {display: 'none', opacity: 0, ease: Linear.easeNone})
				]);
				scene = new ScrollScene({offset: 227, duration: 202}).setTween(tween).addTo(controller);
			}
		}
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.menu', function () {
			if ( responsiveSize != "base" && self.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				initJSMenu();
			} else if ( responsiveSize != "small" && self.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				initJSMenu();
			} else if ( responsiveSize != "medium" && self.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				initJSMenu();
			} else if ( responsiveSize != "large" && self.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				initJSMenu();
			}
		});
		$(window).resize(); // trigger resize to init features
		// SWAP LOGO
		$('.site-header .header-main .site-title').on('mouseenter', function () {
			$(this).find('img').attr('src', self.config.wpImgPath + 'gnu-logo.gif');
		}).on('mouseleave', function () {
			$(this).find('img').attr('src', self.config.wpImgPath + 'gnu-logo.png');
		});
	},
	searchInit: function (visible) {
		var self;
		self = this;
		// check default
		visible = typeof visible !== 'undefined' ? visible : false;
		if (visible) {
			showSearch();
			self.quickCartInit(false);
		} else {
			hideSearch();
		}
		// remove old listeners
		$('.site-header .header-main .search-toggle a').off('mouseenter.search').off('mouseleave.search');
		$('.site-header .header-main .search-toggle a').off('click.search');
		// SHOW SEARCH BAR
		function showSearch() {
			self.quickCartInit(false);
			$('.site-header .search-box-wrapper').removeClass('hide');
			TweenLite.to('.site-header .search-box-wrapper', 0.2, {opacity: 1, onComplete: function () {$('.site-header .search-box-wrapper .search-form .input-text').focus();}});
			// don't hide if clicked within search area
			$('.site-header .search-box-wrapper .search-form .input-text, .site-header .search-box-wrapper .search-form .search-submit').on('click.search', function (e) {
				e.stopPropagation();
			});
			// document events to kill search
			$(document).on('keyup.search', function (e) {
				if (e.keyCode == 27) {
					hideSearch(); // listen for escape key
				}
			}).on('click.search', function () {
				hideSearch(); // hide if clicked anywhere outside search area
			});
		}
		// HIDE SEARCH BAR
		function hideSearch() {
			// kill event listeners
			$(document).off('keyup.search').off('click.search');
			$('.site-header .search-box-wrapper .search-form .input-text, .site-header .search-box-wrapper .search-form .search-submit').off('click.search');
			// fade out search bar
			TweenLite.to('.site-header .search-box-wrapper', 0.2, {opacity: 0, onComplete: function () {$('.site-header .search-box-wrapper').addClass('hide');}});
		}
		// SEARCH BAR FUNCTIONALITY
		// spin compass w/ gif
		$('.site-header .header-main .search-toggle a').on('mouseenter.search', function () {
			$(this).css('background-image', 'url("' + self.config.wpImgPath + 'search-compass.gif")').css('background-position', '0px 0px');
		}).on('mouseleave.search', function () {
			$(this).removeAttr('style');
		});
		// check for click event on search icon
		$('.site-header .header-main .search-toggle a').on('click.search', function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill event from firing further
			if ( $('.site-header .search-box-wrapper').hasClass('hide') ) {
				showSearch();
			} else {
				hideSearch();
			}
		});
	},
	regionSelectorInit: function () {
		// check language cookie on load
		var self, $body, regionCookie, currencyCookie;
		self = this;
		$body = $('body');
		regionCookie = self.utilities.cookie.getCookie('gnu_region');
		currencyCookie = self.utilities.cookie.getCookie('gnu_currency');

		if (regionCookie !== null || currencyCookie !== null) {
			if (currencyCookie !== 'INT') {
				$body.removeClass("international");
			} else {
				$body.addClass("international");
			}
			$(".region-toggle a").html(regionCookie);
		} else {
			if (navigator.cookieEnabled === true) {
				// if no region cookie has been set, open selector if on product page
				if ($body.hasClass('page-template-page-templatesshopping-cart-php') || $body.hasClass('page-template-page-templatesoverview-products-php') || $body.hasClass('single-gnu_supplies') || $body.hasClass('single-gnu_bindings') || $body.hasClass('single-gnu_snowboards')) {
					self.regionSelectorOverlayInit();
				}
				// pick us by default, but don't set cookie
				$('.region-toggle a').html('United States <span>(USD)</span>');
			} else {
				// cookies are disabled, pick USD
				$('.region-toggle a').html('United States <span>(USD)</span>');
			}
		}
		// add click events
		$(".region-toggle a").click(function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill even from firing further
			if (navigator.cookieEnabled === false) {
				alert('Enable cookies in your browser in order to select your region.');
			} else {
				self.regionSelectorOverlayInit();
			}
		});
	},
	regionSelectorOverlayInit: function () {
		var self = this;
		$('#region-selector').toggleClass('hide');
		$('#main').toggleClass('hide');
		// scroll to selector
		self.utilities.pageScroll('#region-selector');
		// add click events
		$("#region-selector .location-group .location-list a").on('click.region', function (e) {
			var selectedCurrency, selectedRegion;
			e.preventDefault();
			selectedCurrency = $(this).attr('data-currency');
			selectedRegion = $(this).html();
			self.utilities.cookie.setCookie('gnu_currency', selectedCurrency, 60);
			self.utilities.cookie.setCookie('gnu_region', selectedRegion, 60);
			window.location.reload();
		});
		// listen for escape key
		$(document).on('keyup.region', function (e) {
			if (e.keyCode == 27) {
				closeOverlay();
			}
		}).on('click.region', function () {
			closeOverlay(); // hide if clicked anywhere outside region selector
		});
		// don't hide if clicked within region selector
		$('#region-selector .choose-region').on('click.region', function (e) {
			e.stopPropagation();
		});
		$('#region-selector .btn-close').on('click.region', function (e) {
			closeOverlay();
		});
		function closeOverlay() {
			$('#region-selector').toggleClass('hide');
			$('#main').toggleClass('hide');
			// kill event listeners
			$("#region-selector .location-group .location-list a").off('click.region');
			$(document).off('keyup.region').off('click.region');
			$('#region-selector .choose-region').off('click.region');
			$('#region-selector .btn-close').off('click.region');
		}
	},
	shopatronInit: function () {
		var self, currency, regionCookie, shopAPIKey, shopAPIKeyString;
		self = this;
		// check the language on the cookie
		currencyCookie = self.utilities.cookie.getCookie('gnu_currency');
		if (currencyCookie !== null || currencyCookie !== "") {
			currency = currencyCookie;
		}
		if (currency) {
			if (currency === 'CAD') {
				shopAPIKey = "iyzc7e8i"; // CA Key
				// set shopatron footer links for Canada
				$('#link-privacy').attr('href', 'http://gnu-ca.shptron.com/home/privacy/4374.7.1.2');
				$('#link-policies').attr('href', 'http://gnu-ca.shptron.com/home/policies/4374.7.1.2');
				$('#link-login').attr('href', 'http://gnu-ca.shptron.com/account/?mfg_id=4374.7&language_id=1');
				$('#link-safety').attr('href', 'http://gnu-ca.shptron.com/home/security/4374.7.1.2');
				$('#link-returns').attr('href', 'http://gnu-ca.shptron.com/home/policies/4374.7.1.2#Returns');
				$('#link-ordering').attr('href', 'http://gnu-ca.shptron.com/home/ordering/4374.7.1.2');
				// set my account in header for Canada
				$('header .nav-utility .link-account a').attr('href', 'http://gnu-ca.shptron.com/account/?mfg_id=4374.7&language_id=1');
			} else if (currency === 'EUR') {
				shopAPIKey = "4xbcoau0"; // European key
				// set shopatron footer links for Europe
				$('#link-privacy').attr('href', 'http://gnu-euro.shptron.com/home/privacy/4374.7.1.2');
				$('#link-policies').attr('href', 'http://gnu-euro.shptron.com/home/policies/4374.7.1.2');
				$('#link-login').attr('href', 'http://gnu-euro.shptron.com/account/?mfg_id=4374.7&language_id=1');
				$('#link-safety').attr('href', 'http://gnu-euro.shptron.com/home/security/4374.7.1.2');
				$('#link-returns').attr('href', 'http://gnu-euro.shptron.com/home/policies/4374.7.1.2#Returns');
				$('#link-ordering').attr('href', 'http://gnu-euro.shptron.com/home/ordering/4374.7.1.2');
				// set my account in header for Europe
				$('header .nav-utility .link-account a').attr('href', 'http://gnu-euro.shptron.com/account/?mfg_id=4374.7&language_id=1');
			} else if (currency === 'INT') {
				// INTERNATIONAL
				shopAPIKey = "a29smylj"; // US Key
			} else {
				shopAPIKey = "a29smylj"; // US Key
			}
		} else {
			shopAPIKey = "a29smylj"; // US Key
		}
		shopAPIKeyString = '{"apiKey": "' + shopAPIKey + '"}';
		// add key to the body of the page for shopatron's api to grab via ID
		$("body").append('<div id="shopatronCart">' + shopAPIKeyString + '</div>');
		// request the shopatron api
		$.ajax({
			url: "//mediacdn.shopatron.com/media/js/product/shopatronAPI-2.5.0.min.js",
			dataType: "script",
			success: function (data) {
				// request other aditional api for quick cart and shopping cart
				$.ajax({
					url: "//mediacdn.shopatron.com/media/js/product/shopatronJST-2.5.0.min.js",
					dataType: "script",
					success: function (data) {
						// init the shopatron page elements
						self.quickCartInit();
						if ($('body').hasClass('page-template-page-templatesshopping-cart-php')) {
							self.shoppingCartInit();
						}
					}
				});
			}
		});
	},
	quickCartInit: function (visible) {
		var self;
		self = this;
		// check default
		visible = typeof visible !== 'undefined' ? visible : false;
		if (visible) {
			showQuickCart();
			self.searchInit(false);
		} else {
			hideQuickCart();
		}
		// remove old handler
		$('.site-header .header-main .quick-cart-toggle a').off('click.cart');
		// SHOW QUICK CART
		function showQuickCart() {
			self.searchInit(false);
			$('.site-header .quick-cart').removeClass('hide');
			TweenLite.to('.site-header .quick-cart', 0.2, {opacity: 1});
			// don't hide if clicked within search area
			$('.site-header .quick-cart').on('click.cart', function (e) {
				e.stopPropagation();
			});
			// document events to kill search
			$(document).on('keyup.cart', function (e) {
				if (e.keyCode == 27) {
					hideQuickCart(); // listen for escape key
				}
			}).on('click.cart', function () {
				hideQuickCart(); // hide if clicked anywhere outside cart area
			});
		}
		// HIDE QUICK CART
		function hideQuickCart() {
			// kill event listeners
			$(document).off('keyup.cart').off('click.cart');
			$('.site-header .quick-cart').off('click.cart');
			// fade out search bar
			TweenLite.to('.site-header .quick-cart', 0.2, {opacity: 0, onComplete: function () {$('.site-header .quick-cart').addClass('hide');}});
		}
		// check for click event on cart icon
		$('.site-header .header-main .quick-cart-toggle a').on('click.cart', function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill event from firing further
			if ( $('.site-header .quick-cart').hasClass('hide') ) {
				showQuickCart();
			} else {
				hideQuickCart();
			}
		});
		// REQUEST CART DATA
		Shopatron.getCart({
			success: function (cartData, textStatus) {
				var itemsInCart, lastCartItem;
				itemsInCart = 0;
				// remove old remove handler
				$('.quick-cart .cart-details .cart-item-price .cart-item-remove').off('click.cart');
				// find quantity of items in cart
				$.each(cartData.cartItems, function (key, value) {
					itemsInCart += parseInt(value.quantity, 10);
				});
				// check if there is more than 1 item in cart
				if (itemsInCart > 0) {
					// change display of cart
					$('.site-header .quick-cart').addClass('full');
					// update amount of items in cart
					$('.quick-cart .cart-details .total-items a span').html(itemsInCart);
					// grab last item in cart
					lastCartItem = cartData.cartItems[cartData.cartItems.length - 1];
					// set the image of last item added
					$('.quick-cart .cart-item-image img').attr('src', lastCartItem.image);
					// get the name of the last item added
					// got the regular expression from Shopatron's API
					// this decodes the funky string to just the product sku - "/product/3214710?api_key=a29smylj"
					// http://mediacdn.shopatron.com/media/js/product/shopatronAPI-2.5.0.js
					var lastCartItemPN = decodeURIComponent((lastCartItem.product).match(/\/product\/([^\/\?]*)/)[1]);
					// get the name and price of the latest product, kinda dumb you don't get it with the cart request
					Shopatron.getProduct({
						partNumber: lastCartItemPN
					}, {
						success: function (productData, textStatus) {
							$('.quick-cart .cart-details .cart-item-title').html(productData.name);
							// set the price of the last item added
							$('.quick-cart .cart-details .cart-item-price .cart-item-amount').html(productData.priceDisplay + " " + cartData.currency);
						},
						error: function (textStatus, errorThrown) {},
						complete: function (textStatus) {}
					});
					// add handler to remove item from cart
					$('.quick-cart .cart-details .cart-item-price .cart-item-remove').on('click.cart', function () {
						Shopatron.removeItem({
							cartItemID: lastCartItem.cartItemID
						}, {
							success: function (data, textStatus) {
								// item removed, update cart
								self.quickCartInit(true);
							},
							error: function (textStatus, errorThrown) {},
							complete: function (textStatus) {}
						});
						$(this).blur();
					});
				} else {
					// change display of cart
					$('.site-header .quick-cart').removeClass('full');
					$('.quick-cart .cart-details .total-items a span').html('0');
				}
			}
			/*
			SAMPLE ADD TO CART - Use to get product in the cart
			ASS PICKLE - 3211905
			AGRO - 3214710

			Shopatron.addToCart({
				quantity: '1',
				partNumber: 3211905
			}, {
				success: function (data, textStatus) {
					console.log(data);
				},
				error: function (textStatus, errorThrown) {},
				complete: function (textStatus) {}
			});
			*/
		});
	},
	shoppingCartInit: function () {
		var self, lang, regionCookie;
		self = this;
		
		Shopatron('#shopping-cart').getCart({
			imageWidth: 100,
			imageHeight: 100
		}, {
			success: function (cartData) {},
			error: function () {},
			complete: function () {}
		});
		// check for the region
		regionCookie = self.utilities.cookie.getCookie('gnu_region');
		if (regionCookie !== null || regionCookie !== "") {
			lang = regionCookie;
		} else {
			lang = 'us';
		}
		// update links on page
		if (lang === 'ca') {
			$("a.link-ordering-info").prop("href", "http://gnu-ca.shptron.com/k/ordering");
			$("a.link-return-policy").prop("href", "http://gnu-ca.shptron.com/k/policies#Returns");
		} else if (lang === 'euro') {
			$("a.link-ordering-info").prop("href", "http://gnu-euro.shptron.com/k/ordering");
			$("a.link-return-policy").prop("href", "http://gnu-euro.shptron.com/k/policies#Returns");
		} else {
			$("a.link-ordering-info").prop("href", "http://gnu.shptron.com/k/ordering");
			$("a.link-return-policy").prop("href", "http://gnu.shptron.com/k/policies#Returns");
		}
		// region selector trigger
		$('.link-region-selector').click(function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill even from firing further
			if (navigator.cookieEnabled === false) {
				alert('Enable cookies in your browser in order to select your region.');
			} else {
				self.regionSelectorOverlayInit();
			}
		});
	},
	utilities: {
		cookie: {
			getCookie: function (name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for (var i = 0; i < ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') c = c.substring(1, c.length);
					if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
				}
				return null;
			},
			setCookie: function (name, value, days) {
				var date, expires;
				if (days) {
					date = new Date();
					date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
					expires = "; expires=" + date.toGMTString();
				} else {
					expires = "";
				}
				document.cookie = name + "=" + value + expires + "; path=/";
			}
		},
		pageScroll: function (hash) {
			// Smooth Page Scrolling, update hash on complete of animation
			$('html,body').animate({
				scrollTop: $(hash).offset().top
			}, 'slow', function () {
				window.location = hash;
			});
		},
		getMediaWidth: function () {
			var self = this,
				width;
			// Check on this with gavin
			/*
            if (typeof matchMedia !== 'undefined') {
                width = self.bruteForceMediaWidth();
            } else {
            */
			width = window.innerWidth || document.documentElement.clientWidth;
			//}
			return width;
		},
		bruteForceMediaWidth: function () {
			var i = 0,
				found = false;
			while (!found) {
				if (matchMedia('(width: ' + i + 'px)').matches) {
					found = true;
				} else {
					i++;
				}
				// Prevent infinite loop if something goes horribly wrong
				if (i === 9999) {
					break;
				}
			}
			return i;
		},
		responsiveCheck: function () {
			var size;
			if ( $('.responsive-check .breakpoint-small').css('display') == 'block' ) {
				size = 'small';
			} else if ( $('.responsive-check .breakpoint-medium').css('display') == 'block' ) {
				size = 'medium';
			} else if ( $('.responsive-check .breakpoint-large').css('display') == 'block' ) {
				size = 'large';
			} else {
				size = 'base';
			}
			return size;
		}
	}
}