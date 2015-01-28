<?php
/*
Template Name: Snowboard Finder
*/
?>
<?php
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
?>
		<header class="section-header">
			<div class="header-wrapper">
				<h1 class="title">Board Finder</h1>
				<h5 class="subtitle">Find the right board for you</h5>
			</div>
			<div class="vibe vibe-1"></div>
		</header>
		
		<div class="product-utility"></div>
		
		<div class="content-wrapper">
			<div class="content-top">
				<section class="bf-step-1 finder-step">
					<h4 class="title">Gender</h3>
					<div class="finder-step-content">
						<ul class="step-selection-list">
							<li><a href="#" class="selection-title bold-black mens">Mens</a></li>
							<li><a href="#" class="selection-title bold-black last womens">Womens</a></li>
						</ul>
					</div>
				</section><!-- .bf-step-1 -->
				<section class="bf-step-2 finder-step">
					<h4 class="title">Type</h3>
					<div class="finder-step-content">
						<div class="slider-weight-wrapper">
							<p class="control-title bold">Weight: <span class="weight-result h5"></span></p>
							<div  class="slider-weight" class="control-input weight"></div>
						</div>
						<div class="slider-height-wrapper">
							<p class="control-title bold">Height: <span class="height-result h5"></span></p>
							<div class="slider-height" class="control-input height"></div>
						</div>
						<div class="slider-boot-wrapper">
							<p class="control-title bold">Boot Size: <span class="boot-result h5"></span></p>
							<div class="slider-boot" class="control-input boot"></div>
						</div>
						<div class="measurement-options">
							<input type="radio" name="measurements" value="imperial" class="h3" checked><label for="imperial" class="h4">Imperial</label>
							<input type="radio" name="measurements" value="metric" class="h3 right"><label for="metric" class="h4">Metric</label>
						</div>
					</div>
				</section><!-- .bf-step-2 -->
				<section class="bf-step-3 finder-step">
					<h4 class="title">Style</h3>
					<div class="finder-step-content">
						<ul class="step-selection-list">
							<li><a href="#" class="selection-title bold-black">Beginner</a></li>
							<li><a href="#" class="selection-title bold-black">Intermediate</a></li>
							<li><a href="#" class="selection-title bold-black last">Advanced</a></li>
						</ul>
						<ul class="step-selection-list">
							<li><a href="#" class="selection-title bold-black">Freeride</a></li>
							<li><a href="#" class="selection-title bold-black">Freestyle</a></li>
							<li><a href="#" class="selection-title bold-black last">Powder</a></li>
						</ul>
					</div>
				</section><!-- .bf-step-3 -->
				<button class="btn-submit">Find</button>
			</div><!-- .content-top -->
			<div class="content-bottom">
				<header class="section-header">
					<div class="header-wrapper">
						<h1 class="title">Results</h1>
						<h5 class="subtitle">These are the right boards for you</h5>
					</div>
					<div class="vibe vibe-2"></div>
				</header>
				<div class="product-utility"></div>
				<div class="product-list">

				</div>

			</div><!-- .content-bottom -->
		</div><!-- .content-wrapper -->
<?php
	endwhile; endif;
	get_footer();
?>

<script>
	// board finder weight slider
	$(function() {
		$( ".slider-weight" ).slider({
			min: 0,
			max: 300,
			value:150,
			step: 5,
			slide: function( event, ui ) {
				$( ".control-title .weight-result" ).html( ui.value );
			}
		});
		var value = $( ".slider-weight" ).slider( "value" );
		$( ".control-title .weight-result" ).html( value );
	});

	// board finder height slider
	function toInches(n) {
		return Math.floor(n /12) + "' " + (n % 12) + '"';
	}

	$(function(){
		$(".slider-height").slider({
			min: 45,
			max: 85,
			value: 65,
			slide: function( event, ui ) {
				$( ".control-title .height-result" ).html(toInches( ui.value ));
			}
		});
		var value = $( ".slider-height" ).slider( "value" );
		$( ".control-title .height-result" ).html( toInches( value ));
	});

	// board finder boot slider
	$(function() {
		$( ".slider-boot" ).slider({
			min: 4,
			max: 16,
			value: 10,
			step: .5,
			slide: function( event, ui ) {
				$( ".control-title .boot-result" ).html( ui.value );
			}
		});
		var value = $( ".slider-boot" ).slider( "value" );
		$( ".control-title .boot-result" ).html( value );
	});
</script>

