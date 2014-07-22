/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.FeaturedSlider = function (scrollController) {
	this.config = {
		dots: false,
		loop: false,
		scene: null,
		scrollController: scrollController
	};
	// check to see if slider should be activated
	if ($('.featured-slider .slide-list .slide-item').length > 1) {
		this.config.dots = true;
		this.config.loop = true;
	}
	this.init();
};
GNU.FeaturedSlider.prototype = {
	init: function () {
		var self, carousel, responsiveSize;
		self = this;
		// set up owl carousel
		carousel = $(".featured-slider .owl-carousel").owlCarousel({
			items: 1,
			dots: self.config.dots,
			lazyLoad: true,
			autoplay: true,
			autoplayTimeout: 8000,
			autoplayHoverPause: true,
			loop: self.config.loop
		});
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.featuredSlider', function () {
			if ( responsiveSize != "base" && GNU.Main.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				self.scrollFeatures();
			} else if ( responsiveSize != "small" && GNU.Main.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				self.scrollFeatures();
			} else if ( responsiveSize != "medium" && GNU.Main.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				self.scrollFeatures();
			} else if ( responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				self.scrollFeatures();
			}
		});
		self.scrollFeatures();
	},
	scrollFeatures: function () {
		var self, tween;
		self = this;
		// set up background scroll animation functionality
		// reset background position css
		$('.featured-slider .slide-list .slide-item').css('background-position', '50% 100%');
		// if scene already exists, remove it
		if (typeof self.config.scene !== 'undefined') {
			self.config.scrollController.removeScene(self.config.scene);
		}
		// if we're medium or bigger, do the scroll. hidden on base and small
		if ( GNU.Main.utilities.responsiveCheck() === 'medium' || GNU.Main.utilities.responsiveCheck() === 'large' ) {
			//controller = new ScrollMagic({vertical: true, container: '#page'});
			tween = new TweenMax.to('.featured-slider .slide-list .slide-item', 1, {backgroundPosition: "50% 0%", ease: Linear.easeNone});
			self.config.scene = new ScrollScene({triggerElement: '.featured-slider', offset: $(window).height()/2*-1, duration: $(window).height() + $('.featured-slider').outerHeight()}).setTween(tween).addTo(self.config.scrollController);
		}
	}
};
