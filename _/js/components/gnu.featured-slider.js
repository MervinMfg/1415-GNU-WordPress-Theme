/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.FeaturedSlider = function (scrollController) {
	this.config = {
		dots: false,
		loop: false,
		scene1: null,
		scene2: null,
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
		// reset takeover overlay
		$('.active-takeover .featured-slider .slide-list .slide-item .takeover-overlay').removeAttr('style');
		// if scene already exists, remove it
		if (typeof self.config.scene1 !== 'undefined') {
			self.config.scrollController.removeScene(self.config.scene1);
		}
		if (typeof self.config.scene2 !== 'undefined') {
			self.config.scrollController.removeScene(self.config.scene2);
		}
		// if we're medium or bigger, do the scroll. hidden on base and small
		if ( GNU.Main.utilities.responsiveCheck() === 'medium' || GNU.Main.utilities.responsiveCheck() === 'large' ) {
			//controller = new ScrollMagic({vertical: true, container: '#page'});
			tween = new TweenMax.to('.featured-slider .slide-list .slide-item', 1, {backgroundPosition: "50% 0%", ease: Linear.easeNone});
			self.config.scene1 = new ScrollScene({triggerElement: '.featured-slider', offset: $(window).height()/2*-1, duration: $(window).height() + $('.featured-slider').outerHeight()}).setTween(tween).addTo(self.config.scrollController);
			// check if takeover is active, if so, active takeover scroll overlay
			if ($('body').hasClass('active-takeover')) {
				tween = new TweenMax.to('.active-takeover .featured-slider .slide-list .slide-item .takeover-overlay', 1, {opacity: "0", display: 'none', ease: Linear.easeNone});
				self.config.scene2 = new ScrollScene({duration: $('.featured-slider').position().top/1.75}).setTween(tween).addTo(self.config.scrollController);
			}
		}
	}
};
