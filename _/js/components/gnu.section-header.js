/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.SectionHeader = function ($header, scrollController) {
	this.config = {
		$sectionHeader: $header,
		scene: null,
		scrollController: scrollController
	};
	this.init();
};
GNU.SectionHeader.prototype = {
	init: function () {
		var self, responsiveSize;
		self = this;
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.sectionHeader', function () {
			if ( responsiveSize != "base" && GNU.Main.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				self.scrollVibe();
			} else if ( responsiveSize != "small" && GNU.Main.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				self.scrollVibe();
			} else if ( responsiveSize != "medium" && GNU.Main.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				self.scrollVibe();
			} else if ( responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				self.scrollVibe();
			}
		});
		self.scrollVibe();
	},
	scrollVibe: function () {
		// set up background scroll animation functionality
		var self, $vibe, tween, windowHeight, scrollDuration;
		self = this;
		$vibe = self.config.$sectionHeader.find('.vibe');
		// reset background position css
		$vibe.removeAttr('style');
		TweenMax.to($vibe, 0, {x: "0px", force3D: true, ease: Linear.easeNone});
		// if scene already exists, remove it
		if (typeof self.config.scene !== 'undefined') {
			self.config.scrollController.removeScene(self.config.scene);
		}
		// if we're medium or bigger, do the scroll. hidden on base and small
		if ( GNU.Main.utilities.responsiveCheck() === 'medium' || GNU.Main.utilities.responsiveCheck() === 'large' ) {
			windowHeight = $(window).height();
			tween = new TweenMax.to($vibe, 1, {x: "100px", force3D: true, ease: Linear.easeNone});
			if(windowHeight > self.config.$sectionHeader.position().top) {
				scrollDuration = (self.config.$sectionHeader.outerHeight() + self.config.$sectionHeader.position().top) - ($('.site-header').outerHeight() + $('.site-header').position().top);
				self.config.scene = new ScrollScene({duration: scrollDuration}).setTween(tween).addTo(self.config.scrollController);
			} else {
				scrollDuration = windowHeight;
				self.config.scene = new ScrollScene({triggerElement: self.config.$sectionHeader, offset: windowHeight/2*-1, duration: scrollDuration}).setTween(tween).addTo(self.config.scrollController);
			}
		}
	}
};
