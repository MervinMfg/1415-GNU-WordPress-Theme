/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.FeaturedPosts = function (scrollController) {
	this.config = {
		scene: null,
		scrollController: scrollController
	};
	this.init();
};
GNU.FeaturedPosts.prototype = {
	init: function () {
		var self, responsiveSize;
		self = this;
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.featuredPosts', function () {
			if ( responsiveSize != "base" && GNU.Main.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				self.scrollPosts();
			} else if ( responsiveSize != "small" && GNU.Main.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				self.scrollPosts();
			} else if ( responsiveSize != "medium" && GNU.Main.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				self.scrollPosts();
			} else if ( responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				self.scrollPosts();
			}
		});
		$('.featured-posts .featured-post .post-link').on('mouseenter', function () {
			$(this).parents('.featured-post').find('.post-link').addClass('selected');
		}).on('mouseleave', function () {
			$(this).parents('.featured-post').find('.post-link').removeClass('selected');
		});
		self.scrollPosts();
	},
	scrollPosts: function () {
		var self, tween;
		self = this;
		$('.featured-posts').removeClass('animate');
		$('.featured-posts .featured-post').removeAttr('style');
		// if scene already exists, remove it
		if (typeof self.config.scene !== 'undefined') {
			self.config.scrollController.removeScene(self.config.scene);
		}
		if ( GNU.Main.utilities.responsiveCheck() === 'large' ) {
			$('.featured-posts').addClass('animate');
			tween = new TweenMax.to('.featured-posts .featured-post-list .featured-post', 1, {marginLeft: "0px", marginRight: "0px", ease: Linear.easeNone});
			self.config.scene = new ScrollScene({triggerElement: '.featured-posts', offset: $(window).height()/2*-1, duration: $(window).height()/2}).setTween(tween).addTo(self.config.scrollController);
		}
	}
};
