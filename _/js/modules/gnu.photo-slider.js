/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.PhotoSlider = function (scrollController) {
	this.config = {
		dots: false,
		loop: false,
		scene: null,
		scrollController: scrollController
	};
	// init if slider exists
	if ($('.photo-slider').length) {
		// check to see if slider should be activated
		if ($('.photo-slider .photo-list .photo-item').length > 1) {
			this.config.dots = true;
			this.config.loop = true;
		}
		this.init();
	}
};
GNU.PhotoSlider.prototype = {
	init: function () {
		var self, carousel, responsiveSize;
		self = this;
		// set up owl carousel
		carousel = $(".photo-slider .owl-carousel").owlCarousel({
			items: 1,
			dots: self.config.dots,
			lazyLoad: true,
			autoplay: true,
			autoplayTimeout: 8000,
			autoplayHoverPause: true,
			loop: self.config.loop
		});
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.photoSlider', function () {
			if ( responsiveSize != "base" && GNU.Main.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				self.scrollPhoto();
			} else if ( responsiveSize != "small" && GNU.Main.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				self.scrollPhoto();
			} else if ( responsiveSize != "medium" && GNU.Main.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				self.scrollPhoto();
			} else if ( responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				self.scrollPhoto();
			}
		});
		self.scrollPhoto();
	},
	scrollPhoto: function () {
		// set up background scroll animation functionality
		var self, tween;
		self = this;
		// reset background position css
		if ( GNU.Main.utilities.responsiveCheck() === 'large' ) {
			$('.photo-slider .photo-list .photo-item').css('background-position', '50% 100%');
		} else {
			$('.photo-slider .photo-list .photo-item').css('background-position', '50% 50%');
		}
		// if scene already exists, remove it
		if (typeof self.config.scene !== 'undefined') {
			self.config.scrollController.removeScene(self.config.scene);
		}
		// if we're large (desktop), do the scroll effect
		if ( GNU.Main.utilities.responsiveCheck() === 'large' ) {
			tween = new TweenMax.to('.photo-slider .photo-list .photo-item', 1, {backgroundPosition: "50% 0%", ease: Linear.easeNone});
			self.config.scene = new ScrollScene({triggerElement: '.photo-slider', offset: $(window).height()/2*-1, duration: $(window).height() + $('.photo-slider').outerHeight()}).setTween(tween).addTo(self.config.scrollController);
		}
	}
};
