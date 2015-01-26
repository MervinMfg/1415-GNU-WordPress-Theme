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
					<h3 class="title">Step 1</h3>
					<div class="finder-step-content">
						<ul class="step-selection-list">
							<li><a href="#" class="selection-title h2 mens">Mens</a></li>
							<li><a href="#" class="selection-title h2 last womens">Womens</a></li>
						</ul>
					</div>
				</section><!-- .bf-step-1 -->
				<section class="bf-step-2 finder-step">
					<h3 class="title">Step 2</h3>
					<div class="finder-step-content">
						<div class="control-input weight">
							<h3 class="control-title">Weight:</h3>
							<input type="range" min="0" max="100" value="50" step="5" list="none">
							<datalist id="tickmarks">
								<option>0</option>
								<option>5</option>
								<option>10</option>
								<option>15</option>
								<option>20</option>
								<option>25</option>
								<option>30</option>
								<option>35</option>
								<option>40</option>
								<option>45</option>
								<option>50</option>
								<option>55</option>
								<option>60</option>
								<option>65</option>
								<option>70</option>
								<option>75</option>
								<option>80</option>
								<option>85</option>
								<option>90</option>
								<option>95</option>
								<option>100</option>
							</datalist>
						</div>
						<div class="control-input height">
							<h3 class="control-title">Height:</h3>
							<input type="range" min="0" max="100" value="50" step="10">
						</div>
						<div class="control-input boot">
							<h3 class="control-title">Boot Size:</h3>
							<input type="range" min="0" max="100" value="50" step="10">
						</div>
						<div class="measurement-options">
							<input type="radio" name="measurements" value="imperial" class="h3"><label for="imperial" class="h4">Imperial</label>
							<input type="radio" name="measurements" value="metric" class="h3 right"><label for="metric" class="h4">Metric</label>
						</div>
					</div>
				</section><!-- .bf-step-2 -->
				<section class="bf-step-3 finder-step">
					<h3 class="title">Step 3</h3>
					<div class="finder-step-content">
						<ul class="step-selection-list">
							<li><a href="#" class="selection-title h2">Beginner</a></li>
							<li><a href="#" class="selection-title h2">Intermediate</a></li>
							<li><a href="#" class="selection-title h2 last">Advanced</a></li>
						</ul>
						<ul class="step-selection-list">
							<li><a href="#" class="selection-title h2">Freeride</a></li>
							<li><a href="#" class="selection-title h2">Freestyle</a></li>
							<li><a href="#" class="selection-title h2 last">Powder</a></li>
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