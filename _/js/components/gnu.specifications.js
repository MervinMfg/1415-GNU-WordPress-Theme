/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.Specifications = function (scrollController) {
	this.config = {
		scene: null,
		scrollController: scrollController,
		responsiveSize: null
	};
	this.init();
};
GNU.Specifications.prototype = {
	init: function () {
		var self = this;
		self.initSpecsKey();
	},
	initSpecsKey: function () {
		var self, navOffset, specs;
		self = this;
		$specsKey = $('.specs-key');
		// if we're large or bigger, do the scroll
		if (self.config.responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large") {
			self.config.responsiveSize = "large";
			// if scene already exists, remove it
			if (typeof self.config.scene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.scene);
			}
			$specsKey.removeAttr('style');
			// if not ie8 or less, run fixed scroll code
			if ($('html').hasClass('ie-lt9') !== true) {
				navOffset = Math.floor($(window).height() / 2) - ($('.site-header').outerHeight() + $('.site-header').position().top) + 1;
				self.config.scene = new ScrollScene({triggerElement: ".specs-key", offset: navOffset}).setPin(".specs-key").addTo(self.config.scrollController);
			}
		} else if (self.config.responsiveSize != "other" && GNU.Main.utilities.responsiveCheck() != "large") {
			self.config.responsiveSize = "other";
			// if scene already exists, remove it
			if (typeof self.config.scene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.scene);
			}
			$specsKey.removeAttr('style');
		}
		// listen for resize
		$(window).on('resize.specsKey', function () {
			$(this).off('resize.specsKey');
			self.initSpecsKey();
		});
	}
};
