/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.MainMenu = function (scrollController) {
	this.config = {
		scene1: null,
		scene2: null,
		scrollController: scrollController
	};
	this.init();
};
GNU.MainMenu.prototype = {
	init: function () {
		var self, responsiveSize;
		self = this;
		// SWAP LOGO
		$('.site-header .header-main .site-title').on('mouseenter', function () {
			$(this).find('img').attr('src', GNU.Main.config.wpImgPath + 'gnu-logo.gif');
		}).on('mouseleave', function () {
			$(this).find('img').attr('src', GNU.Main.config.wpImgPath + 'gnu-logo.png');
		});
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.menu', function () {
			if ( responsiveSize != "base" && GNU.Main.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				self.activateMenu();
			} else if ( responsiveSize != "small" && GNU.Main.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				self.activateMenu();
			} else if ( responsiveSize != "medium" && GNU.Main.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				self.activateMenu();
			} else if ( responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				self.activateMenu();
			}
		});
		self.activateMenu();
	},
	activateMenu: function () {
		var self = this;
		// DROPDOWN MENU
		// MOBILE DROPDOWN MENU
		// remove old active styles and event listeners
		$('.site-header .header-main, .site-header .header-main .primary-navigation').removeAttr('style');
		$('.site-header .header-main .menu-toggle').removeClass('active');
		$('.site-header .header-main .menu-toggle').off('click.menu');
		// check size and it proper menu settings
		if ( GNU.Main.utilities.responsiveCheck() === 'base' ) {
			$('.site-header .header-main .menu-toggle').on('click.menu', function (e) {
				var menuHeight, headerHeight;
				e.preventDefault();
				if ($(this).hasClass('active')) {
					$(this).removeClass('active');
					menuHeight = 0;
					headerHeight = menuHeight + $('.site-header .header-main .site-title').height() + 20;
					TweenLite.to('.site-header .header-main .primary-navigation', 0.5, {height: menuHeight});
					TweenLite.to('.site-header .header-main', 0.5, {height: headerHeight});
				} else {
					$(this).addClass('active');
					menuHeight = $('.site-header .header-main .primary-navigation .menu-item').outerHeight() * $('.site-header .header-main .primary-navigation .nav-menu').children().length;
					headerHeight = menuHeight + $('.site-header .header-main .site-title').height() + 20;
					TweenLite.to('.site-header .header-main .primary-navigation', 0.5, {height: menuHeight});
					TweenLite.to('.site-header .header-main', 0.5, {height: headerHeight});
				}
				
			});
		} else if ( GNU.Main.utilities.responsiveCheck() === 'small' ) {
			$('.site-header .header-main .menu-toggle').on('click.menu', function (e) {
				var menuHeight, headerHeight;
				e.preventDefault();
				if ($(this).hasClass('active')) {
					$(this).removeClass('active');
					menuHeight = 0;
					headerHeight = menuHeight + $('.site-header .header-main .site-title').height() + 20;
					TweenLite.to('.site-header .header-main .primary-navigation', 0.3, {height: menuHeight});
					TweenLite.to('.site-header .header-main', 0.3, {height: headerHeight});
				} else {
					$(this).addClass('active');
					menuHeight = $('.site-header .header-main .primary-navigation .menu-item').outerHeight();
					headerHeight = menuHeight + $('.site-header .header-main .site-title').height() + 20;
					TweenLite.to('.site-header .header-main .primary-navigation', 0.3, {height: menuHeight});
					TweenLite.to('.site-header .header-main', 0.3, {height: headerHeight});
				}
			});
		}
		// check if takeover should be initialized
		if ( $('body').hasClass('active-takeover') ) {
			if ($('html').hasClass('ie-lt9')) {
				// if IE8 or earlier, remove takeover
				$('body').removeClass('active-takeover');
			} else {
				// passed checks, so show the takeover
				self.activateTakeover();
			}
		}
	},
	activateTakeover: function () {
		var self, tween;
		self = this;
		// remove previous scroll attributes
		$('.site-header, .site-header .header-wrapper, .site-header .header-main, .site-header .header-main .takeover, .site-header .header-main .takeover .photo, .site-header .header-main .site-title, .site-header .header-main .primary-navigation, .site-header .header-main .primary-navigation .nav-menu, .site-header .header-main .quick-cart-toggle, .site-header .header-main .search-toggle, .site-header .takeover-green-bar, .site-header .takeover-white-fade').removeAttr('style');
		// if scene already exists, remove it
		if (typeof self.config.scene1 !== 'undefined') {
			self.config.scrollController.removeScene(self.config.scene1);
		}
		if (typeof self.config.scene2 !== 'undefined') {
			self.config.scrollController.removeScene(self.config.scene2);
		}
		// check browser size
		if ( GNU.Main.utilities.responsiveCheck() == 'large') {
			// DESKTOP SIZE ANIMATION
			// set up scenes/tweens
			tween = new TweenMax.to(".site-header .header-main", 1, {height: "51px", display: 'block', ease: Linear.easeNone});
			self.config.scene1 = new ScrollScene({duration: 429}).setTween(tween).addTo(self.config.scrollController);
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
			self.config.scene2 = new ScrollScene({offset: 227, duration: 202}).setTween(tween).addTo(self.config.scrollController);
		}
	}
};
