/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.Blog = function (scrollController) {
	this.config = {
		scene: null,
		scrollController: scrollController,
		responsiveSize: null
	};
	this.init();
};
GNU.Blog.prototype = {
	init: function () {
		var self = this;
		self.initMenu();
		self.postLinkHoverInit();
	},
	postLinkHoverInit: function () {
		// hover links
		$('.blog-posts .blog-post .post-link').on('mouseenter', function () {
			$(this).parents('.blog-post').find('.post-link').addClass('selected');
		}).on('mouseleave', function () {
			$(this).parents('.blog-post').find('.post-link').removeClass('selected');
		});
	},
	initMenu: function () {
		var self, $blogNav, navOffset, specs;
		self = this;
		$blogNav = $('.blog-navigation');
		// if we're large or bigger, do the scroll
		if ( self.config.responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
			self.config.responsiveSize = "large";
			// if scene already exists, remove it
			if (typeof self.config.scene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.scene);
			}
			$blogNav.removeAttr('style');
			navOffset = Math.floor($(window).height() / 2) - ($('.site-header').outerHeight() + $('.site-header').position().top) + 1;
			self.config.scene = new ScrollScene({triggerElement: ".blog-navigation", offset: navOffset}).setPin(".blog-navigation").addTo(self.config.scrollController);
		} else if (self.config.responsiveSize != "other" && GNU.Main.utilities.responsiveCheck() != "large") {
			self.config.responsiveSize = "other";
			// if scene already exists, remove it
			if (typeof self.config.scene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.scene);
			}
			$blogNav.removeAttr('style');
		}
		// listen for resize
		$(window).on('resize.blogNav', function () {
			$(this).off('resize.blogNav');
			$blogNav.find('a').off('click.blogNav');
			self.initMenu();
		});
	}
};
