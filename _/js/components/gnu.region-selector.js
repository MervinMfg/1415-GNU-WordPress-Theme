/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.RegionSelector = function () {
	this.init();
};
GNU.RegionSelector.prototype = {
	init: function () {
		// check language cookie on load
		var self, $body, regionCookie, currencyCookie;
		self = this;
		$body = $('body');
		regionCookie = GNU.Main.utilities.cookie.getCookie('gnu_region');
		currencyCookie = GNU.Main.utilities.cookie.getCookie('gnu_currency');

		if (regionCookie !== null || currencyCookie !== null) {
			if (currencyCookie !== 'INT') {
				$body.removeClass("international");
			} else {
				$body.addClass("international");
			}
			var currencyClass = "currency-" + currencyCookie;
			$body.addClass(currencyClass.toLowerCase());
			$(".region-toggle a").html(regionCookie);
		} else {
			if (navigator.cookieEnabled === true) {
				// if no region cookie has been set, open selector if on product page
				if ($body.hasClass('page-template-page-templatesshopping-cart-php') || $body.hasClass('page-template-page-templatesproduct-overview-php') || $body.hasClass('single-gnu_snowboards') || $body.hasClass('single-gnu_bindings') || $body.hasClass('single-gnu_apparel') || $body.hasClass('single-gnu_accessories')) {
					// Check to make sure IP Address is not Crazy Egg tracking
					$.getJSON( "/feeds/ip/", function( data ) {
						if (data.ip !== "80.74.134.135") {
							// if not crazy egg ip, show region selector
							self.overlayInit();
						}
					}).fail(function() {
						// failed, so show region selector
						self.overlayInit();
					});
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
				self.overlayInit();
			}
		});
	},
	overlayInit: function () {
		var self = this;
		$('#region-selector').toggleClass('hide');
		$('#main').toggleClass('hide');
		// scroll to top of window
		TweenMax.to(window, 0.5, {scrollTo:{y: 0, x: 0}, delay:0.2});
		// add click events
		$("#region-selector .location-group .location-list a").on('click.region', function (e) {
			var selectedCurrency, selectedRegion;
			e.preventDefault();
			selectedCurrency = $(this).attr('data-currency');
			selectedRegion = $(this).html();
			GNU.Main.utilities.cookie.setCookie('gnu_currency', selectedCurrency, 60);
			GNU.Main.utilities.cookie.setCookie('gnu_region', selectedRegion, 60);
			window.location.reload();
		});
		// listen for escape key
		$(document).on('keyup.region', function (e) {
			if (e.keyCode == 27) {
				self.overlayUninit();
			}
		});
		// don't hide if clicked within region selector
		$('#region-selector .choose-region').on('click.region', function (e) {
			e.stopPropagation();
		});
		$('#region-selector .btn-close').on('click.region', function (e) {
			self.overlayUninit();
		});
	},
	overlayUninit: function () {
		var self = this;
		$('#region-selector').toggleClass('hide');
		$('#main').toggleClass('hide');
		// kill event listeners
		$("#region-selector .location-group .location-list a").off('click.region');
		$(document).off('keyup.region').off('click.region');
		$('#region-selector .choose-region').off('click.region');
		$('#region-selector .btn-close').off('click.region');
		$(window).resize();
	}
};
