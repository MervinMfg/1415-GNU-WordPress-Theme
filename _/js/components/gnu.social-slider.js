/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.SocialSlider = function () {
	this.config = {
		carousel: null,
		instagramUsername: null,
		instagramPosts: 0,
		facebookUsername: null,
		facebookPosts: 0,
		completedLoads: 0
	};
	this.init();
};
GNU.SocialSlider.prototype = {
	init: function () {
		var self = this;
		self.loadInstagram();
		self.loadFacebook();
		self.grabVideo();
	},
	loadInstagram: function () {
		var self = this;
		// INSTAGRAM POSTS
		if ($('.social-slider').attr('data-instagram') !== "") {
			self.config.instagramUsername = $('.social-slider').attr('data-instagram');
			self.config.instagramPosts = [];
			$.ajax({
				dataType: "json",
				url: '/feeds/instagram/?username=' + self.config.instagramUsername + '&limit=4',
				success: function (photosJSON) {
					var photosData = photosJSON.data;
					for (var i = 0; i < photosData.length; i++) {
						var photoData, postItem;
						photoData = photosData[i];
						// set up instagram item
						postItem = '<div class="social-item instagram"><a href="' + photoData.link + '" target="_blank" class="owl-lazy" data-src="' + photoData.images.low_resolution.url + '" title="' + photoData.caption.text + '"><div class="item-icon"><div class="icon"></div></div></a></div>';
						self.config.instagramPosts.push(postItem);
					}
					// randomize/shuffle instagram posts with underscore.js
					self.config.instagramPosts = _.shuffle(self.config.instagramPosts);
					self.loadComplete();
				}
			});
		} else {
			self.loadComplete(); // trigger load even though not complete
		}
	},
	loadFacebook: function () {
		var self = this;
		// FACEBOOK POSTS
		if ($('.social-slider').attr('data-facebook') !== "") {
			self.config.facebookUsername = $('.social-slider').attr('data-facebook');
			self.config.facebookPosts = [];
			$.ajax({
				dataType: "json",
				url: '/feeds/facebook/?username=' + self.config.facebookUsername + '&limit=16',
				success: function (postsJSON) {
					var postsData;
					postsData = postsJSON.data;
					for (var i = 0; i < postsData.length; i++) {
						var postData, postItem;
						postData = postsData[i];
						if (postData.type != "status") {
							var postDate, monthArray, postImage, postMessage;
							// process date stamp
							postDate = postData.created_time;
							monthArray = {
								Jan: "January", Feb: "February", Mar: "March", Apr: "April", May: "May", Jun: "June", Jul: "July", Aug: "August", Sep: "September", Oct: "October", Nov: "November", Dec: "December"
							};
							// make friendly for Safari and IE
							postDate = postDate.replace(/-/g, '/').replace(/T/, ' ').replace(/\+/, ' +');
							// create date string
							postDate = String(new Date(postDate)).replace(
								/\w{3} (\w{3}) (\d{2}) (\d{4}) (\d{2}):(\d{2}):[^(]+\(([A-Z]{3})\)/,
								function ($0, $1, $2, $3, $4, $5, $6) {
									return monthArray[$1] + " " + $2 + ", " + $3; //+ " - " + $4%12 + ":" + $5 + ( + $4 > 12 ? "PM" : "AM") + " " + $6 hide time and date
								}
							);
							// if still invalid, make it blank
							if(postDate == "Invalid Date") postDate = "";
							// get larger picture
							postImage = postData.picture;
							postImage = postImage.replace("_s", "_n");
							// get message
							postMessage = postData.message;
							if(postMessage === undefined) postMessage = "";
							// set up facebook item
							postItem = '<a href="' + postData.link + '" target="_blank"><div class="item-icon"><div class="icon"></div></div><div class="item-photo"><img src="' + GNU.Main.config.wpImgPath + 'square.gif" alt="" class="lazy" data-src="' + postImage + '" /></div><div class="item-copy"><p class="fb-page">' + postData.from.name + ' on Facebook</p><p class="fb-date">' + postDate + '</p><p class="fb-excerpt">' + postMessage + '</p></div></a>';
							self.config.facebookPosts.push(postItem);
						}
					}
					self.loadComplete();
				}
			});
		} else {
			self.loadComplete(); // trigger load even though not complete
		}
	},
	loadComplete: function () {
		var self = this;
		// incriment # of loads completed
		self.config.completedLoads ++;
		// make sure both insta and fb have loaded, or at least been called
		if (self.config.completedLoads > 1) {
			// Check if both facebook and insta have loaded, and if so render the carousel
			if (self.config.instagramPosts.length > 0) {
				i = 0; // used for incrimenting through the dom elements
				while(self.config.instagramPosts.length > 0) {
					$('.social-slider .social-list').append(self.config.instagramPosts[0]);
					self.config.instagramPosts.shift();
					// move slides to the correct location
					$('.social-slider .social-list .instagram:eq(' + i + ')').insertBefore($('.social-slider .social-list .vimeo:eq(' + i + ')'));
					i++;
				}
			}
			if (self.config.facebookPosts.length > 1) {
				i = 0; // used for incrimenting through the dom elements
				while(self.config.facebookPosts.length > 1) {
					$('.social-slider .social-list').append('<div class="social-item facebook">' + self.config.facebookPosts[0] + self.config.facebookPosts[1] + '</div>');
					self.config.facebookPosts.shift();
					self.config.facebookPosts.shift();
					// move slides to the correct location
					$('.social-slider .social-list .facebook:eq(' + i + ')').insertBefore($('.social-slider .social-list .vimeo:eq(' + i + ')'));
					i++;
				}
			}
			// done loading, so show the items
			$(".social-slider .social-list").removeClass('loading');
			// set up owl carousel
			self.config.carousel = $(".social-slider .owl-carousel").owlCarousel({
				items: 8,
				responsive: false,
				autoWidth: true,
				dots: false,
				lazyLoad: true,
				autoplay: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				margin: 10,
				loop: true
			});
			$(".social-slider .social-list .facebook img.lazy").unveil();
			// auto-clamp based on available height
			$('.social-slider .social-list .facebook .item-copy .fb-excerpt').each(function () {
				$clamp(this, {clamp: 'auto'});
			});
		}
	},
	grabVideo: function () {
		var self;
		self = this;
		// overwrite vimeo links
		$('.social-slider .social-list .vimeo a').on('mousedown.video', function (e) {
			var $this, videoID, videoTitle, timeout;
			$this = $(this);
			videoID = $this.attr('href');
			videoID = self.utilities.getVimeoId(videoID);
			videoTitle = $this.attr('title');
			timeout = setTimeout(function() { $this.off('mouseup.video'); clearTimeout(timeout); }, 300);
			// on mouseup, init the video, unless we timeout and this is removed
			$this.on('mouseup.video', function (e) {
				$this.off('mouseup.video');
				clearTimeout(timeout);
				self.initVideo(videoID, videoTitle);
			});
		}).on('click.video', function (e) {
			e.preventDefault();
			e.stopPropagation();
		});
	},
	initVideo: function (videoID, videoTitle) {
		console.log('init video');
		$('.social-slider').addClass('video');
		$('.social-slider .video-player .video-title').html(videoTitle);
		$('.social-slider .video-player .video-wrapper').html('<iframe src="http://player.vimeo.com/video/' + videoID + '?title=0&amp;byline=0&amp;portrait=0&amp;color=99CC33&amp;autoplay=1&amp;loop=1" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');
		$('.social-slider .video-player .video-wrapper').fitVids();
		$('.social-slider .video-player .btn-close').on('click', function () {
			$('.social-slider .video-player .video-title').html("");
			$('.social-slider .video-player .video-wrapper').html("");
			$('.social-slider .video-player .btn-close').off('click');
			$('.social-slider').removeClass('video');
		});
	},
	utilities: {
		getVimeoId: function (url) {
			// look for a string with 'vimeo', then whatever, then a 
			// forward slash and a group of digits.
			var match = /vimeo.*\/(\d+)/i.exec( url );
			// if the match isn't null (i.e. it matched)
			if ( match ) {
				// the grouped/matched digits from the regex
				return match[1];
			}
		}
	}
};
