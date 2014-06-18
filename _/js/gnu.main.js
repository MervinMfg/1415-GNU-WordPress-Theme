/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

 var GNU = GNU || {};

GNU.main = {
	config: {
		responsiveSize: '',
		wpImgPath: '/wp-content/themes/1415-GNU-WordPress-Theme/_/img/'
	},
	init: function () {
		var self = this;

		self.shopatronInit();
		self.menuInit();
		self.searchInit();
		// lazy load
		$("img.lazy").unveil();
	},
	menuInit: function () {
		var self, controller, tween, scene;
		self = this;
		// DROPDOWN MENU
		function initJSMenu() {
			// MOBILE DROPDOWN MENU
			// remove old active styles and event listeners
			$('.site-header .header-main, .site-header .header-main .primary-navigation').removeAttr('style');
			$('.site-header .header-main .menu-toggle').removeClass('active');
			$('.site-header .header-main .menu-toggle').off('click.menu');
			// check size and it proper menu settings
			if ( self.config.responsiveSize === 'base' ) {
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
			} else if ( self.config.responsiveSize === 'small' ) {
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
			if ($('.site-header').hasClass('active-takeover')) initTakeoverScroll();
		}
		// TAKEOVER SCROLLING
		function initTakeoverScroll() {
			// remove previous scroll attributes
			$('.active-takeover, .active-takeover .header-wrapper, .active-takeover .header-main, .active-takeover .header-main .takeover, .active-takeover .header-main .takeover .photo, .active-takeover .header-main .site-title, .active-takeover .header-main .primary-navigation, .active-takeover .header-main .primary-navigation .nav-menu, .active-takeover .header-main .quick-cart-toggle, .active-takeover .header-main .search-toggle, .active-takeover .takeover-green-bar, .active-takeover .takeover-white-fade').removeAttr('style');
			// set up controller
			if (typeof controller !== 'undefined') {
				controller.destroy();
			} 
			// check browser size
			if ( self.config.responsiveSize == 'medium' ) {
				// TABLET SIZE ANIMATION
				controller = new ScrollMagic({vertical: true});
				// set up scenes/tweens
				tween = new TweenMax.to(".active-takeover .header-main", 1, {height: "71px", display: 'block', ease: Linear.easeNone});
				scene = new ScrollScene({duration: 409}).setTween(tween).addTo(controller);
				tween = new TimelineMax().add([
					TweenMax.to(".active-takeover", 1, {backgroundPosition: 'top center', ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-wrapper", 1, {backgroundPosition: '0 20px', ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .takeover", 1, {opacity: 0, ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .takeover .photo", 1, {top: 0, ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .site-title", 1, {display: 'block', top: '20px', left: '0px', ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .primary-navigation", 1, {top: '20px', left: '146px', backgroundPosition: '-590px 0px', width: 'auto', ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .primary-navigation .nav-menu", 1, {fontSize: '22px', ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .quick-cart-toggle", 1, {display: 'block', opacity: 1, ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .search-toggle", 1, {display: 'block', opacity: 1, ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .takeover-green-bar", 1, {display: 'block', opacity: 1, ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .takeover-white-fade", 1, {display: 'none', opacity: 0, ease: Linear.easeNone})
				]);
				scene = new ScrollScene({offset: 227, duration: 182}).setTween(tween).addTo(controller);
			} else if ( self.config.responsiveSize == 'large') {
				// DESKTOP SIZE ANIMATION
				controller = new ScrollMagic({vertical: true});
				// set up scenes/tweens
				tween = new TweenMax.to(".active-takeover .header-main", 1, {height: "51px", display: 'block', ease: Linear.easeNone});
				scene = new ScrollScene({duration: 429}).setTween(tween).addTo(controller);
				tween = new TimelineMax().add([
					TweenMax.to(".active-takeover", 1, {backgroundPosition: 'top center', ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-wrapper", 1, {backgroundPosition: '0 0px', ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .takeover", 1, {opacity: 0, ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .takeover .photo", 1, {top: 0, ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .site-title", 1, {display: 'block', opacity: 1, top: '0px', left: '0px', ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .primary-navigation", 1, {top: '0px', left: '146px', backgroundPosition: '-590px 0px', width: 'auto', ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .primary-navigation .nav-menu", 1, {fontSize: '22px', ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .quick-cart-toggle", 1, {display: 'block', opacity: 1, ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .header-main .search-toggle", 1, {display: 'block', opacity: 1, ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .takeover-green-bar", 1, {display: 'block', opacity: 1, ease: Linear.easeNone}),
					TweenMax.to(".active-takeover .takeover-white-fade", 1, {display: 'none', opacity: 0, ease: Linear.easeNone})
				]);
				scene = new ScrollScene({offset: 227, duration: 202}).setTween(tween).addTo(controller);
			}
		}
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.menu', function () {
			if ( self.config.responsiveSize != "base" && self.utilities.responsiveCheck() == "base" ) {
				self.config.responsiveSize = "base";
				initJSMenu();
			} else if ( self.config.responsiveSize != "small" && self.utilities.responsiveCheck() == "small" ) {
				self.config.responsiveSize = "small";
				initJSMenu();
			} else if ( self.config.responsiveSize != "medium" && self.utilities.responsiveCheck() == "medium" ) {
				self.config.responsiveSize = "medium";
				initJSMenu();
			} else if ( self.config.responsiveSize != "large" && self.utilities.responsiveCheck() == "large" ) {
				self.config.responsiveSize = "large";
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
			TweenLite.to('.site-header .search-box-wrapper', 0.2, {opacity: 1, onComplete: function () {$('.site-header .search-box-wrapper .search-form .search-field').focus();}});
			// don't hide if clicked within search area
			$('.site-header .search-box-wrapper .search-form .search-field, .site-header .search-box-wrapper .search-form .search-submit').on('click.search', function (e) {
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
			$('.site-header .search-box-wrapper .search-form .search-field, .site-header .search-box-wrapper .search-form .search-submit').off('click.search');
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
	shopatronInit: function () {
		var self, lang, regionCookie, shopAPIKey, shopAPIKeyString;
		self = this;
		// check the language on the cookie
		regionCookie = self.utilities.cookie.getCookie('gnu_region');
		if (regionCookie !== null || regionCookie !== "") {
			lang = regionCookie;
		}
		if (lang) {
			if (lang === 'ca') {
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
			} else if (lang === 'euro') {
				shopAPIKey = "95tuotu0"; // International key
				// set shopatron footer links for International
				$('#link-privacy').attr('href', 'http://gnu-euro.shptron.com/home/privacy/4374.7.1.2');
				$('#link-policies').attr('href', 'http://gnu-euro.shptron.com/home/policies/4374.7.1.2');
				$('#link-login').attr('href', 'http://gnu-euro.shptron.com/account/?mfg_id=4374.7&language_id=1');
				$('#link-safety').attr('href', 'http://gnu-euro.shptron.com/home/security/4374.7.1.2');
				$('#link-returns').attr('href', 'http://gnu-euro.shptron.com/home/policies/4374.7.1.2#Returns');
				$('#link-ordering').attr('href', 'http://gnu-euro.shptron.com/home/ordering/4374.7.1.2');
				// set my account in header for International
				$('header .nav-utility .link-account a').attr('href', 'http://gnu-euro.shptron.com/account/?mfg_id=4374.7&language_id=1');
			} else if (lang === 'int') {
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

		console.log('init shopping cart');
		
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