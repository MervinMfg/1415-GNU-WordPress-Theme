/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.Technology = function (scrollController) {
	this.config = {
		scene: null,
		scrollController: scrollController
	};
	this.init();
};
GNU.Technology.prototype = {
	init: function () {
		var self = this;
		self.initMenu();
	},
	initMenu: function () {
		var self, $techNav, responsiveSize, navOffset, specs;
		self = this;
		$techNav = $('.technology-navigation');
		// listen for click on nav items
		$techNav.find('a').on('click', function (e) {
			e.preventDefault();
			var url = $(this).attr('href');
			GNU.Main.utilities.pageScroll(url, 0.5);
		});
		// if we're large or bigger, do the scroll
		if ( responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
			responsiveSize = "large";
			// if scene already exists, remove it
			if (typeof self.config.scene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.scene);
			}
			$techNav.removeAttr('style');
			navOffset = Math.floor($(window).height() / 2) - ($('.site-header').outerHeight() + $('.site-header').position().top) + 1;
			self.config.scene = new ScrollScene({triggerElement: ".technology-navigation", offset: navOffset}).setPin(".technology-navigation").addTo(self.config.scrollController);
		} else if ( responsiveSize != "medium" && GNU.Main.utilities.responsiveCheck() == "medium" ) {
			responsiveSize = "medium";
			// if scene already exists, remove it
			if (typeof self.config.scene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.scene);
			}
			$techNav.removeAttr('style');
			navOffset = Math.floor($(window).height() / 2) - ($('.site-header').outerHeight() + $('.site-header').position().top) + 1;
			self.config.scene = new ScrollScene({triggerElement: ".technology-navigation", offset: navOffset}).setPin(".technology-navigation").addTo(self.config.scrollController);
		} else if (GNU.Main.utilities.responsiveCheck() != "other") {
			responsiveSize = "other";
			// if scene already exists, remove it
			if (typeof self.config.scene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.scene);
			}
			$techNav.removeAttr('style');
		}
		// listen for resize
		$(window).on('resize.techNav', function () {
			$(this).off('resize.techNav');
			self.initMenu();
		});
	}
};
