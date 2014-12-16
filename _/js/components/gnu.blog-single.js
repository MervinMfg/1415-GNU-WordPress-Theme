/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.BlogSingle = function () {
	this.config = {
		firstMediaFound: false
	};
	this.init();
};
GNU.BlogSingle.prototype = {
	init: function () {
		var self = this;
		self.checkVideos();
		if($('body').hasClass('single-format-image')) {
			self.checkImages();
		}
		if($('body').hasClass('single-format-gallery')) {
			self.checkGallery();
		}
		// check for gallery, init if exists
		if($('gallery')) {
			self.galleryInit();
		}
	},
	checkVideos: function () {
		var self = this;
		// setup responsive video
		$('.post .post-content').fitVids();
		// check to see if parent is 'p' and remove it if so
		$('.fluid-width-video-wrapper').each(function (index) {
			// check if parent is a paragraph and remove / replace with div
			if ($(this).parent().is('p')) {
				$(this).unwrap();
			}
			$(this).wrap('<div class="post-video"></div>');
			// check if it's the first element
			if ($('body').hasClass('single-format-video') && index === 0) {
				$('.post-video').prependTo('.post .post-content');
				self.config.firstMediaFound = true;
			}
		});
	},
	checkImages: function () {
		var self, firstImage;
		self = this;
		// if no video was found, find the first image
		if (!self.config.firstMediaFound) {
			firstImage = $('.post .post-content').find('img:first');
			if (firstImage.length) {
				if (firstImage.parent().is('a')) {
					firstImage = firstImage.parent();
				}
				// check if it's wrapped by a caption
				if (firstImage.parent().is('.wp-caption')) {
					firstImage = firstImage.parent();
					firstImage.wrap('<div class="first-image"></div>');
					self.config.firstMediaFound = true;
				} else if (firstImage.parent().is('.gallery-icon')) {
					// wrapped by gallery, do nothing
				} else {
					// not wrapped by caption, so add paragraph
					firstImage.wrap('<p class="first-image"></p>');
					self.config.firstMediaFound = true;
				}
				// image was found, prepend it
				if (self.config.firstMediaFound) {
					$('.first-image').prependTo('.post .post-content');
				}
			}
		}
	},
	checkGallery: function () {
		var self, $firstGallery;
		self = this;
		// if no video was found, find the first image
		if (!self.config.firstMediaFound) {
			$firstGallery = $('.post .post-content').find('.gallery:first');
			if ($firstGallery.length) {
				self.config.firstMediaFound = true;
				// image was found, prepend it
				$firstGallery.prependTo('.post .post-content');
			}
		}
	},
	galleryInit: function () {
		var self, carousel;
		self = this;
		// set up owl carousel
		carousel = $(".gallery .owl-carousel").owlCarousel({
			items: 1,
			dots: true,
			lazyLoad: true,
			autoplay: true,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			loop: true
		});
	}
};
