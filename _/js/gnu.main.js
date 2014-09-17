/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.Main = {
	config: {
		wpImgPath: '/wp-content/themes/1415-GNU-WordPress-Theme/_/img/',
		shop: null,
		regionSelector: null,
		scrollController: null
	},
	init: function () {
		var self, shop, mainMenu, search, $body;
		self = this;
		$body = $('body');
		// init global components
		self.config.scrollController = new ScrollMagic({ vertical: true });
		self.config.shop = new GNU.Shop();
		self.config.regionSelector = new GNU.RegionSelector();
		mainMenu = new GNU.MainMenu(self.config.scrollController);
		search = new GNU.Search();
		// lazy load of images
		$("img.lazy").unveil();
		// trigger load before scroll or resize
		$(window).on('load.lazy', function () { $(window).resize(); $(window).off('load.lazy'); });
		// Listen for the events between quick cart and search
		document.addEventListener('QuickCartShow', function (e) {
			search.hideSearch();
		}, false);
		document.addEventListener('SearchShow', function (e) {
			self.config.shop.hideQuickCart();
		}, false);
		// init respective page template
		if ($body.hasClass('home')) {
			self.homeInit();
		} else if ($body.hasClass('page-template-page-templatespage-home-sport-php')) {
			self.homeSportInit();
		} else if ($body.hasClass('page-template-page-templatesproduct-overview-php')) {
			self.productOverviewInit();
		} else if ($body.hasClass('page-template-page-templatesstore-locator-php')) {
			self.storeLocatorInit();
		} else if ($body.hasClass('single-gnu_snowboards') || $body.hasClass('single-gnu_bindings') || $body.hasClass('single-gnu_accessories') || $body.hasClass('single-gnu_apparel')) {
			self.productDetailsInit();
		} else if ($body.hasClass('page-template-page-templatesteam-overview-php')) {
			self.teamOverviewInit();
		} else if ($body.hasClass('single-gnu_team')) {
			self.teamDetailInit();
		} else if ($body.hasClass('page-template-page-templatesabout-php')) {
			self.aboutInit();
		} else if ($body.hasClass('page-template-page-templatespartners-php')) {
			self.partnersInit();
		}
	},
	homeInit: function () {
		var self = this;
		new GNU.FeaturedSlider(self.config.scrollController);
		new GNU.SocialSlider();
		new GNU.FeaturedPosts(self.config.scrollController);
		new GNU.PhotoSlider(self.config.scrollController);
		new GNU.FeaturedProducts();
		new GNU.Follow(self.config.scrollController);
	},
	productOverviewInit: function () {
		var self = this;
		// grab all section headers and assign correct scrolling
		$('.section-header').each(function (index) {
			new GNU.SectionHeader($(this), self.config.scrollController);
		});
		new GNU.ProductOverview();
	},
	productDetailsInit: function () {
		var self = this;
		new GNU.ProductDetails(self.config.scrollController);
		new GNU.PhotoSlider(self.config.scrollController);
		new GNU.FeaturedProducts();
	},
	teamOverviewInit: function () {
		var self = this;
		new GNU.PhotoSlider(self.config.scrollController);
		// grab all section headers and assign correct scrolling
		$('.section-header').each(function (index) {
			new GNU.SectionHeader($(this), self.config.scrollController);
		});
		new GNU.ProductOverview();
	},
	teamDetailInit: function () {
		var self = this;
		new GNU.SocialSlider();
		new GNU.FeaturedPosts(self.config.scrollController);
		new GNU.PhotoSlider(self.config.scrollController);
		new GNU.FeaturedProducts();
	},
	aboutInit: function () {
		var self = this;
		new GNU.PhotoSlider(self.config.scrollController);
		new GNU.Follow(self.config.scrollController);
	},
	partnersInit: function () {
		var self = this;
		// grab all section headers and assign correct scrolling
		$('.section-header').each(function (index) {
			new GNU.SectionHeader($(this), self.config.scrollController);
		});
	},
	storeLocatorInit: function () {
		var self = this;
		// grab all section headers and assign correct scrolling
		$('.section-header').each(function (index) {
			new GNU.SectionHeader($(this), self.config.scrollController);
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
		pageScroll: function (hash, duration) {
			var yPosition;
			// check duration
			if (typeof duration === 'undefined') {
				duration = 1;
			}
			// Smooth Page Scrolling, update hash on complete of animation
			yPosition = $(hash).offset().top;
			TweenMax.to(window, duration, {scrollTo:{y: yPosition, x: 0}, onComplete: function () { window.location = hash; }});
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
};
