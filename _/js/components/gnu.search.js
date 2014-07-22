/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.Search = function () {
	this.init();
};
GNU.Search.prototype = {
	init: function () {
		var self;
		self = this;
		// remove old listeners
		$('.site-header .header-main .search-toggle a').off('mouseenter.search').off('mouseleave.search');
		$('.site-header .header-main .search-toggle a').off('click.search');
		// SEARCH BAR FUNCTIONALITY
		// spin compass w/ gif
		$('.site-header .header-main .search-toggle a').on('mouseenter.search', function () {
			$(this).css('background-image', 'url("' + GNU.Main.config.wpImgPath + 'search-compass.gif")').css('background-position', '0px 0px');
		}).on('mouseleave.search', function () {
			$(this).removeAttr('style');
		});
		// check for click event on search icon
		$('.site-header .header-main .search-toggle a').on('click.search', function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill event from firing further
			if ( $('.site-header .search-box-wrapper').hasClass('hide') ) {
				self.showSearch();
			} else {
				self.hideSearch();
			}
		});
	},
	showSearch: function () {
		var self, searchEvent;
		self = this;
		// Create and dispatch event to notify others when search is shown
		searchEvent = document.createEvent('Event');
		searchEvent.initEvent('SearchShow', true, true);
		document.dispatchEvent(searchEvent);
		// set search box visuals
		$('.site-header .search-box-wrapper').removeClass('hide');
		TweenLite.to('.site-header .search-box-wrapper', 0.2, {opacity: 1, onComplete: function () {$('.site-header .search-box-wrapper .search-form .input-text').focus();}});
		// don't hide if clicked within search area
		$('.site-header .search-box-wrapper .search-form .input-text, .site-header .search-box-wrapper .search-form .search-submit').on('click.search', function (e) {
			e.stopPropagation();
		});
		// document events to kill search
		$(document).on('keyup.search', function (e) {
			if (e.keyCode == 27) {
				self.hideSearch(); // listen for escape key
			}
		}).on('click.search', function () {
			self.hideSearch(); // hide if clicked anywhere outside search area
		});
	},
	hideSearch: function () {
		// kill event listeners
		$(document).off('keyup.search').off('click.search');
		$('.site-header .search-box-wrapper .search-form .input-text, .site-header .search-box-wrapper .search-form .search-submit').off('click.search');
		// fade out search bar
		TweenLite.to('.site-header .search-box-wrapper', 0.2, {opacity: 0, onComplete: function () {$('.site-header .search-box-wrapper').addClass('hide');}});
	}
}
