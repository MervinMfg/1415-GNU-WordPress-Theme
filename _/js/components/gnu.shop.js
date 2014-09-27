/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.Shop = function () {
	this.config = {
		shopKeyUS: "a29smylj",
		shopKeyCanada: "iyzc7e8i",
		shopKeyEuro: "4xbcoau0"
	};
	this.init();
};
GNU.Shop.prototype = {
	init: function () {
		var self, currency, regionCookie, shopAPIKey, shopAPIKeyString;
		self = this;
		// check the language on the cookie
		currencyCookie = GNU.Main.utilities.cookie.getCookie('gnu_currency');
		if (currencyCookie !== null || currencyCookie !== "") {
			currency = currencyCookie;
		}
		if (currency) {
			if (currency === 'CAD') {
				shopAPIKey = self.config.shopKeyCanada; // CA Key
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
				shopAPIKey = self.config.shopKeyEuro; // European key
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
				shopAPIKey = self.config.shopKeyUS; // US Key
			} else {
				shopAPIKey = self.config.shopKeyUS; // US Key
			}
		} else {
			shopAPIKey = self.config.shopKeyUS; // US Key
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
		self.displayPrices();
	},
	quickCartInit: function (visible) {
		var self;
		self = this;
		// check default
		visible = typeof visible !== 'undefined' ? visible : false;
		if (visible) {
			self.showQuickCart();
			// TODO: Hide Search
			// self.searchInit(false);
		} else {
			self.hideQuickCart();
		}
		// remove old handler
		$('.site-header .header-main .quick-cart-toggle a').off('click.cart');
		// check for click event on cart icon
		$('.site-header .header-main .quick-cart-toggle a').on('click.cart', function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill event from firing further
			if ( $('.site-header .quick-cart').hasClass('hide') ) {
				self.showQuickCart();
			} else {
				self.hideQuickCart();
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
		});
	},
	showQuickCart: function () {
		var self, quickCartEvent;
		self = this;
		// dispatch event to notify others when cart is shown
		GNU.Main.utilities.events.trigger('QuickCartShow');
		// set quik cart visuals
		$('.site-header .quick-cart').removeClass('hide');
		TweenLite.to('.site-header .quick-cart', 0.2, {opacity: 1});
		// don't hide if clicked within search area
		$('.site-header .quick-cart').on('click.cart', function (e) {
			e.stopPropagation();
		});
		// document events to kill search
		$(document).on('keyup.cart', function (e) {
			if (e.keyCode == 27) {
				self.hideQuickCart(); // listen for escape key
			}
		}).on('click.cart', function () {
			self.hideQuickCart(); // hide if clicked anywhere outside cart area
		});
		// scroll to top of page
		TweenMax.to(window, 0.5, {scrollTo:{y: 0, x: 0}});
	},
	// HIDE QUICK CART
	hideQuickCart: function () {
		var self = this;
		// kill event listeners
		$(document).off('keyup.cart').off('click.cart');
		$('.site-header .quick-cart').off('click.cart');
		// fade out search bar
		TweenLite.to('.site-header .quick-cart', 0.2, {opacity: 0, onComplete: function () {$('.site-header .quick-cart').addClass('hide');}});
	},
	shoppingCartInit: function () {
		var self, currencyCookie;
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
		currencyCookie = GNU.Main.utilities.cookie.getCookie('gnu_currency');
		if (currencyCookie !== null || currencyCookie !== "") {
			lang = currencyCookie;
		} else {
			lang = 'USD';
		}
		// update links on page
		if (lang === 'CAD') {
			$("a.link-ordering-info").prop("href", "http://gnu-ca.shptron.com/k/ordering");
			$("a.link-return-policy").prop("href", "http://gnu-ca.shptron.com/k/policies#Returns");
		} else if (lang === 'EUD') {
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
				GNU.Main.config.regionSelector.overlayInit();
			}
		});
	},
	displayPrices: function () {
		var currencyCookie;
		// CHECK AND DISPLAY CORRECT CURRENCY
		currencyCookie = GNU.Main.utilities.cookie.getCookie('gnu_currency');
		if (currencyCookie !== null || currencyCookie !== "") {
			switch(currencyCookie) {
				case 'USD':
					$('.price .us-price').addClass('active');
					break;
				case 'CAD':
					$('.price .ca-price').addClass('active');
					break;
				case 'EUD':
					$('.price .eur-price').addClass('active');
					break;
				default:
					// do nothing, international
			}
		} else {
			// no cookie, display US
			$('.price .us-price').addClass('active');
		}
	}
};
