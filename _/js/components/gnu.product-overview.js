/**
 * 1415 GNU WordPress Theme - http://www.gnu.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var GNU = GNU || {};

GNU.ProductOverview = function () {
	this.config = {
		overviewGroups: [],
		carouselBreakpoints: {}
	};
	this.init();
};
GNU.ProductOverview.prototype = {
	init: function () {
		var self, responsiveSize;
		self = this;
		// set up owl carousel(s)
		if ($('#mens-snowboards').length) {
			// we're viewing snowboards
			self.config.carouselBreakpoints = {
				0:{ items: 1, dots: false },
				310: { items: 2, dots: false },
				430: { items: 3, dots: false },
				550:{ items: 4, dots: false },
				670:{ items: 5, dots: false },
				748:{ items: 3, dots: true },
				950:{ items: 4, dots: true },
				1170:{ items: 5, dots: true },
				1390:{ items: 6, dots: true },
				1610:{ items: 7, dots: true },
				1830:{ items: 8, dots: true },
				2050:{ items: 9, dots: true },
				2270:{ items: 10, dots: true },
				2490:{ items: 11, dots: true },
				2710:{ items: 12, dots: true },
				2930:{ items: 13, dots: true },
				3150:{ items: 14, dots: true },
				3370:{ items: 15, dots: true }
			};
		} else {
			// we're viewing bindings, supplies and team
			self.config.carouselBreakpoints = {
				0:{ items: 1, dots: false },
				320: { items: 2, dots: false, stagePadding: 5 },
				390: { items: 2, dots: false },
				550: { items: 3, dots: false },
				710:{ items: 4, dots: false },
				748:{ items: 2, dots: true, stagePadding: 20 },
				790:{ items: 2, dots: true },
				1150:{ items: 3, dots: true },
				1510:{ items: 4, dots: true },
				1870:{ items: 5, dots: true },
				2230:{ items: 6, dots: true },
				2590:{ items: 7, dots: true },
				2950:{ items: 8, dots: true },
				3310:{ items: 9, dots: true },
				3670:{ items: 10, dots: true },
				4030:{ items: 11, dots: true },
				4390:{ items: 12, dots: true }
			};
		}
		// setup default overviews
		$('.product-overview .product-list').each(function (index) {
			self.config.overviewGroups.push($(this).html());
		});
		// set up carousels
		$(".product-overview .owl-carousel").owlCarousel({
			lazyLoad: true,
			slideBy: 2,
			stagePadding: 40,
			margin: 10,
			responsive: self.config.carouselBreakpoints
		});
		//$(".product-overview .owl-carousel").data('owl.carousel').destroy();
		// (RE)INIT MENU ON RESIZE
		$(window).on('resize.productOverview', function () {
			if ( responsiveSize != "base" && GNU.Main.utilities.responsiveCheck() == "base" ) {
				responsiveSize = "base";
				self.productsInit();
			} else if ( responsiveSize != "small" && GNU.Main.utilities.responsiveCheck() == "small" ) {
				responsiveSize = "small";
				self.productsInit();
			} else if ( responsiveSize != "medium" && GNU.Main.utilities.responsiveCheck() == "medium" ) {
				responsiveSize = "medium";
				self.productsInit();
			} else if ( responsiveSize != "large" && GNU.Main.utilities.responsiveCheck() == "large" ) {
				responsiveSize = "large";
				self.productsInit();
			}
		});
		self.productsInit();
		self.instructionsInit();
		self.filtersInit();
	},
	productsInit: function () {
		var self = this;
		if ( GNU.Main.utilities.responsiveCheck() === 'medium' || GNU.Main.utilities.responsiveCheck() === 'large' ) {
			TweenMax.to('.product-overview .product-list .product a .info', 0, {scale: 1, force3D: true});
			TweenMax.to('.product-overview .product-list .product a .image', 0, {scale: 0.95, force3D: true});
			// add listners for over and out
			$('.product-overview .product-list .product a').on('mouseover.productOverview', function () {
				$info = $(this).find('.info');
				$image = $(this).find('.image');
				TweenMax.to($info, 0.2, {scale: 1.05, force3D: true});
				TweenMax.to($image, 0.2, {scale: 1, force3D: true});
			}).on('mouseout.productOverview', function () {
				$info = $(this).find('.info');
				$image = $(this).find('.image');
				TweenMax.to($info, 0.2, {scale: 1, force3D: true});
				TweenMax.to($image, 0.2, {scale: 0.95, force3D: true});
			});
		} else {
			TweenMax.to('.product-overview .product-list .product a .info', 0, {scale: 1, force3D: true});
			TweenMax.to('.product-overview .product-list .product a .image', 0, {scale: 1, force3D: true});
			$('.product-overview .product-list .product a .info, .product-overview .product-list .product a .image').removeAttr('style');
			// remove listeners for mobile
			$('.product-overview .product-list .product a').off('mouseover.productOverview, mouseout.productOverview');
		}
	},
	instructionsInit: function () {
		var instructionTimeout = window.setTimeout( function () {
			$('.product-overview .product-utility .instructions').addClass('show');
		}, 3000);
		$('.product-list').on('mousedown.instructions', function () {
			window.clearTimeout(instructionTimeout);
			$('.product-overview .product-utility .instructions').removeClass('show');
		});	
	},
	filtersInit: function () {
		var self = this;
		// add open and close handlers
		$('.product-filters .filter-controls .btn-open').on('click', function () {
			$(this).parents('.product-utility').addClass('filters-active');
		});
		$('.product-filters .filter-controls .btn-close').on('click', function () {
			$(this).parents('.product-utility').removeClass('filters-active');
			$(this).parents('.product-filters').addClass('categories').removeClass('categories contours sizes pricing');
		});
		// add filter handlers
		$('.product-filters .filter-controls .categories .btn-filter').on('click', function () {
			$(this).parents('.product-filters').addClass('categories').removeClass('contours sizes pricing');
		});
		$('.product-filters .filter-controls .contours .btn-filter').on('click', function () {
			$(this).parents('.product-filters').addClass('contours').removeClass('categories sizes pricing');
		});
		$('.product-filters .filter-controls .sizes .btn-filter').on('click', function () {
			$(this).parents('.product-filters').addClass('sizes').removeClass('categories contours pricing');
		});
		$('.product-filters .filter-controls .pricing .btn-filter').on('click', function () {
			$(this).parents('.product-filters').addClass('pricing').removeClass('categories contours sizes');
		});
		// add filter option handlers
		$('.product-filters .filter-collection .filter-list .filter-item .btn-option').on('click', function () {
			self.filtersUpdate($(this).parents('.product-overview'), this);
		});
		// add filter remove handlers
		$('.product-filters .filter-controls .btn-wrapper .btn-remove').on('click', function () {
			$this = $(this);
			$this.parent().removeClass('set');
			if ($this.parent().hasClass('categories')) {
				$this.parents('.product-filters').find('.filter-collection.categories .btn-option').removeClass('selected');
			} else if ($this.parent().hasClass('contours')) {
				$this.parents('.product-filters').find('.filter-collection.contours .btn-option').removeClass('selected');
			} else if ($this.parent().hasClass('sizes')) {
				$this.parents('.product-filters').find('.filter-collection.sizes .btn-option').removeClass('selected');
			} else if ($this.parent().hasClass('pricing')) {
				$this.parents('.product-filters').find('.filter-collection.pricing .btn-option').removeClass('selected');
			}
			self.filtersUpdate($(this).parents('.product-overview'));
		});
		// add size listeners and set default to standard
		$('.product-filters .filter-collection.sizes').addClass('standard');
		$('.product-filters .filter-collection.sizes .btn-size-group.standard-width').on('click', function () {
			$(this).parent().addClass('standard').removeClass('wide');
		});
		$('.product-filters .filter-collection.sizes .btn-size-group.wide-width').on('click', function () {
			$(this).parent().addClass('wide').removeClass('standard');
		});
	},
	filtersUpdate: function ($overviewGroup, toggledFilter) {
		var self, toggledData;
		self = this;
		$overviewGroup.categoryFilters = [];
		$overviewGroup.contourFilters = [];
		$overviewGroup.sizeFilters = [];
		$overviewGroup.pricingFilter = "";
		// if toggledFilter is set
		if (toggledFilter) {
			$(toggledFilter).toggleClass('selected').blur();
			$overviewGroup.find('.product-filters .filter-controls .btn-wrapper').removeClass('set');
			// check pricing filter, only one can be toggled for pricing
			toggledData = $(toggledFilter).attr('data-filter');
			if (toggledData == "Low" || toggledData == "High" || toggledData == "Available") {
				$overviewGroup.find('.product-filters .filter-collection.pricing .btn-option').removeClass('selected');
				$(toggledFilter).addClass('selected');
			}
		}
		// loop through filters and set values
		$overviewGroup.find('.product-filters .filter-collection').each(function (index) {
			var $filterCollection = $(this);
			$(this).find('.selected').each(function (index) {
				var filterValue = $(this).attr('data-filter');
				// filter is set
				if ($filterCollection.hasClass('categories')) {
					$overviewGroup.categoryFilters.push(filterValue);
					$overviewGroup.find('.product-filters .filter-controls .categories').addClass('set');
				} else if ($filterCollection.hasClass('contours')) {
					$overviewGroup.contourFilters.push(filterValue);
					$overviewGroup.find('.product-filters .filter-controls .contours').addClass('set');
				} else if ($filterCollection.hasClass('sizes')) {
					$overviewGroup.sizeFilters.push(filterValue);
					$overviewGroup.find('.product-filters .filter-controls .sizes').addClass('set');
				} else if ($filterCollection.hasClass('pricing')) {
					$overviewGroup.pricingFilter = filterValue;
					$overviewGroup.find('.product-filters .filter-controls .pricing').addClass('set');
				}
			});
		});
		// disable carousels
		$overviewGroup.find('.owl-carousel').data('owl.carousel').destroy();
		// resetup default overviews
		// clear html, add default back
		$overviewGroup.find('.product-list').html('').html(self.config.overviewGroups[$overviewGroup.index()]);
		// find which products to display
		$overviewGroup.find('.product-list .product').each(function (index) {
			var filters, i, filterValue, categoryMatch, contourMatch, sizeMatch, priceMatch;
			// reset old filter
			$(this).removeClass('hide');
			// check categories
			if ($overviewGroup.categoryFilters.length > 0) {
				filters = $(this).attr('data-categories');
				for (i = 0; i < $overviewGroup.categoryFilters.length; i++) {
					filterValue = $overviewGroup.categoryFilters[i];
					if (filters.indexOf(filterValue) != -1) {
						categoryMatch = true;
					}
				}
			} else {
				categoryMatch = true;
			}
			// check contours
			if ($overviewGroup.contourFilters.length > 0) {
				filters = $(this).attr('data-contour');
				for (i = 0; i < $overviewGroup.contourFilters.length; i++) {
					filterValue = $overviewGroup.contourFilters[i];
					if (filters.indexOf(filterValue) != -1) {
						contourMatch = true;
					}
				}
			} else {
				contourMatch = true;
			}
			// check sizes
			if ($overviewGroup.sizeFilters.length > 0) {
				filters = $(this).attr('data-sizes');
				for (i = 0; i < $overviewGroup.sizeFilters.length; i++) {
					filterValue = $overviewGroup.sizeFilters[i];
					if (filters.indexOf(filterValue) != -1) {
						sizeMatch = true;
					}
				}
			} else {
				sizeMatch = true;
			}
			if ($overviewGroup.pricingFilter.length > 0) {
				var products;
				if ($overviewGroup.pricingFilter == "Available" && $(this).attr('data-avail-us') == "Yes") {
					priceMatch = true;
				} else if ($overviewGroup.pricingFilter == "High") {
					// sort by low to high
					products = $overviewGroup.find('.product-list .product');
					products.sort(function(a, b){
						var an = b.getAttribute('data-price'),
						bn = a.getAttribute('data-price');
						if(an > bn) {
							return 1;
						}
						if(an < bn) {
							return -1;
						}
						return 0;
					});
					products.detach().appendTo($overviewGroup.find('.product-list'));
					priceMatch = true;
				} else if ($overviewGroup.pricingFilter == "Low") {
					// sort by low to high
					products = $overviewGroup.find('.product-list .product');
					products.sort(function(a, b){
						var an = a.getAttribute('data-price'),
						bn = b.getAttribute('data-price');
						if(an > bn) {
							return 1;
						}
						if(an < bn) {
							return -1;
						}
						return 0;
					});
					products.detach().appendTo($overviewGroup.find('.product-list'));
					priceMatch = true;
				}
			} else {
				priceMatch = true;
			}
			if (categoryMatch !== true || contourMatch !== true || sizeMatch !== true || priceMatch !== true) {
				$(this).remove();
			}
		});
		// reinit owl carousel
		$overviewGroup.find('.owl-carousel').owlCarousel({
			lazyLoad: true,
			slideBy: 2,
			stagePadding: 40,
			margin: 10,
			responsive: self.config.carouselBreakpoints
		});
		self.productsInit();
	}
};
