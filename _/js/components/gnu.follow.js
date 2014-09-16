/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.Follow = function (scrollController) {
	this.config = {
		scene: null,
		scrollController: scrollController
	};
	this.init();
};
GNU.Follow.prototype = {
	init: function () {
		var self, responsiveSize;
		self = this;
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.follow', function () {
			if ( responsiveSize != "base" && GNU.Main.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				self.scrollBG();
			} else if ( responsiveSize != "small" && GNU.Main.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				self.scrollBG();
			} else if ( responsiveSize != "medium" && GNU.Main.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				self.scrollBG();
			} else if ( responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				self.scrollBG();
			}
		});
		self.scrollBG();
	},
	scrollBG: function () {
		var self, tween;
		self = this;
		$('.follow').removeAttr('style');
		// if scene already exists, remove it
		if (typeof self.config.scene !== 'undefined') {
			self.config.scrollController.removeScene(self.config.scene);
		}
		// if we're large (desktop), do the scroll effect
		if ( GNU.Main.utilities.responsiveCheck() === 'large' ) {
			tween = new TweenMax.to('.follow', 1, {backgroundPosition: "50% 30%", ease: Linear.easeNone});
			self.config.scene = new ScrollScene({triggerElement: '.follow', offset: $(window).height()/2*-1, duration: $('.follow').outerHeight() + $('.site-footer').outerHeight()}).setTween(tween).addTo(self.config.scrollController);
		}
	}
};
