/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.FAQ = function (scrollController) {
	this.config = {
		scene: null,
		scene2: null,
		scene3: null,
		scene4: null,
		scrollController: scrollController,
		responsiveSize: null
	};
	this.init();
};
GNU.FAQ.prototype = {
	init: function () {
		var self = this;
		self.initMenu();
	},
	initMenu: function () {
		var self, $faqNav, navOffset, specs;
		self = this;
		$faqNav = $('.faq-navigation');
		// listen for click on nav items
		$faqNav.find('a').on('click.faqNav', function (e) {
			e.preventDefault();
			var url = $(this).attr('href');
			GNU.Main.utilities.pageScroll(url, 0.5);
		});
		// if we're large or bigger, do the scroll
		if ( self.config.responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
			self.config.responsiveSize = "large";
			// if scene already exists, remove it
			if (typeof self.config.scene1 !== 'undefined') {
				self.config.scrollController.removeScene(self.config.scene1);
				self.config.scrollController.removeScene(self.config.scene2);
				self.config.scrollController.removeScene(self.config.scene3);
				self.config.scrollController.removeScene(self.config.scene4);
			}
			$faqNav.removeAttr('style');
			$('.faq-navigation a').removeClass('active');
			navOffset = Math.floor($(window).height() / 2) - ($('.site-header').outerHeight() + $('.site-header').position().top) + 1;
			self.config.scene1 = new ScrollScene({triggerElement: ".faq-navigation", offset: navOffset}).setPin(".faq-navigation").addTo(self.config.scrollController);
			// fixed navigation active states
			navOffset = $(window).height() / 2 - 1;
			self.config.scene2 = new ScrollScene({triggerElement: "#general-faq", offset: navOffset, duration: $('#general-faq').height() - 1}).setClassToggle('.faq-navigation .general-faq', 'active').addTo(self.config.scrollController);
			self.config.scene3 = new ScrollScene({triggerElement: "#snowboard-faq", offset: navOffset, duration: $('#snowboard-faq').height() - 1}).setClassToggle('.faq-navigation .snowboard-faq', 'active').addTo(self.config.scrollController);
			self.config.scene4 = new ScrollScene({triggerElement: "#binding-faq", offset: navOffset, duration: $('#binding-faq').height() - 1}).setClassToggle('.faq-navigation .binding-faq', 'active').addTo(self.config.scrollController);

		} else if (self.config.responsiveSize != "other" && GNU.Main.utilities.responsiveCheck() != "large") {
			self.config.responsiveSize = "other";
			// if scene already exists, remove it
			if (typeof self.config.scene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.scene1);
				self.config.scrollController.removeScene(self.config.scene2);
				self.config.scrollController.removeScene(self.config.scene3);
				self.config.scrollController.removeScene(self.config.scene4);
			}
			$faqNav.removeAttr('style');
			$('.faq-navigation a').removeClass('active');
		}
		// listen for resize
		$(window).on('resize.faqNav', function () {
			$(this).off('resize.faqNav');
			$faqNav.find('a').off('click.faqNav');
			self.initMenu();
		});
	}
};
