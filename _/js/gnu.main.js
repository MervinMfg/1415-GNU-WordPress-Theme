/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

 var GNU = GNU || {};

GNU.main = {
	config: {},
	init: function () {
		var self = this;
	},
	utilities: {
		cookie: {
			getCookie: function (name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for (var i = 0; i < ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') c = c.substring(1, c.length);
					if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
				}
				return null;
			},
			setCookie: function (name, value, days) {
				var date, expires;
				if (days) {
					date = new Date();
					date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
					expires = "; expires=" + date.toGMTString();
				} else {
					expires = "";
				}
				document.cookie = name + "=" + value + expires + "; path=/";
			}
		},
		pageScroll: function (hash) {
			// Smooth Page Scrolling, update hash on complete of animation
			$('html,body').animate({
				scrollTop: $(hash).offset().top
			}, 'slow', function () {
				window.location = hash;
			});
		},
		getMediaWidth: function () {
			var self = this,
				width;
			// Check on this with gavin
			/*
            if (typeof matchMedia !== 'undefined') {
                width = self.bruteForceMediaWidth();
            } else {
            */
			width = window.innerWidth || document.documentElement.clientWidth;
			//}
			return width;
		},
		bruteForceMediaWidth: function () {
			var i = 0,
				found = false;
			while (!found) {
				if (matchMedia('(width: ' + i + 'px)').matches) {
					found = true;
				} else {
					i++;
				}
				// Prevent infinite loop if something goes horribly wrong
				if (i === 9999) {
					break;
				}
			}
			return i;
		}
	}
}