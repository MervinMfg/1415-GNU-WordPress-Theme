	<?php
/*
Template Name: Product Overview
*/
?>
<?php get_header(); ?>

			<?php if (get_the_title() == "Snowboards") : ?>
			<section id="mens-snowboards" class="product-overview deeplink-top-fix">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Mens Snowboards</h2>
						<h5 class="subtitle">Something about gold metal technology</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign large"><a href="#womens-snowboards">View Womens</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-1"></div>
				</header>
				<div class="product-filters">
					<button>Board Filters</button>
				</div>
				<ul class="product-list">
					<li class="list-item">
						<a href="#">
							<img src="" alt="" />
							<h4 class="product-name">Board Name</h4>
							<h5 class="product-category">Board Category</h5>
							<p class="product-price">$499.99 USD</p>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section id="womens-snowboards" class="product-overview deeplink-top-fix">
				<header class="product-header section-header alt">
					<div class="header-wrapper">
						<h2 class="title">Womens Snowboards</h2>
						<h5 class="subtitle">Something about gold metal technology</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#mens-snowboards">View Mens</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-2"></div>
				</header>
				<div class="product-filters">
					<button>Board Filters</button>
				</div>
				<ul class="product-list">
					<li class="list-item">
						<a href="#">
							<img src="" alt="" />
							<h4 class="product-name">Board Name</h4>
							<h5 class="product-category">Board Category</h5>
							<p class="product-price">$499.99 USD</p>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</section><!-- .product-overview -->

			<?php elseif (get_the_title() == "Bindings") : ?>

			<section id="mens-bindings" class="product-overview deeplink-top-fix">
				<header class="product-header section-header alt">
					<div class="header-wrapper">
						<h2 class="title">Mens Bindings</h2>
						<h5 class="subtitle">Front door or backdoor. Pick one and slide on in.</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign large"><a href="#womens-bindings">View Womens</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-6"></div>
				</header>
				<div class="product-filters">
					<button>Board Filters</button>
				</div>
				<ul class="product-list">
					<li class="list-item">
						<a href="#">
							<img src="" alt="" />
							<h4 class="product-name">Board Name</h4>
							<h5 class="product-category">Board Category</h5>
							<p class="product-price">$499.99 USD</p>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section id="womens-bindings" class="product-overview deeplink-top-fix">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Womens Bindings</h2>
						<h5 class="subtitle">Front door or backdoor. Pick one and slide on in.</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#mens-bindings">View Mens</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-3"></div>
				</header>
				<div class="product-filters">
					<button>Board Filters</button>
				</div>
				<ul class="product-list">
					<li class="list-item">
						<a href="#">
							<img src="" alt="" />
							<h4 class="product-name">Board Name</h4>
							<h5 class="product-category">Board Category</h5>
							<p class="product-price">$499.99 USD</p>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section id="compare-bindings" class="product-compare deeplink-top-fix">
				<header class="product-header section-header alt">
					<div class="header-wrapper">
						<h2 class="title">Comparison</h2>
						<h5 class="subtitle">Study the various bindings and their features</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#mens-bindings">View Mens</a></li>
									<li class="sign large"><a href="#womens-bindings">View Womens</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-5"></div>
				</header>
				<div class="product-filters">
					<button>Board Filters</button>
				</div>
				<ul class="product-list">
					<li class="list-item">
						<a href="#">
							<img src="" alt="" />
							<h4 class="product-name">Board Name</h4>
							<h5 class="product-category">Board Category</h5>
							<p class="product-price">$499.99 USD</p>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</section><!-- .product-overview -->

			<?php elseif (get_the_title() == "Supplies") : ?>

			<section id="wearables" class="product-overview deeplink-top-fix">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Wearables</h2>
						<h5 class="subtitle">Designed to help you progress to the highest level</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign small"><a href="#headwear">View Headwear</a></li>
									<li class="sign large"><a href="#accessories">View Accessories</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-2"></div>
				</header>
				<div class="product-filters">
					<button>Board Filters</button>
				</div>
				<ul class="product-list">
					<li class="list-item">
						<a href="#">
							<img src="" alt="" />
							<h4 class="product-name">Board Name</h4>
							<h5 class="product-category">Board Category</h5>
							<p class="product-price">$499.99 USD</p>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section id="headwear" class="product-overview deeplink-top-fix">
				<header class="product-header section-header alt">
					<div class="header-wrapper">
						<h2 class="title">Headwear</h2>
						<h5 class="subtitle">For the second most important head on your body</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#wearables">View Wearables</a></li>
									<li class="sign large"><a href="#accessories">View Accessories</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-5"></div>
				</header>
				<div class="product-filters">
					<button>Board Filters</button>
				</div>
				<ul class="product-list">
					<li class="list-item">
						<a href="#">
							<img src="" alt="" />
							<h4 class="product-name">Board Name</h4>
							<h5 class="product-category">Board Category</h5>
							<p class="product-price">$499.99 USD</p>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</section><!-- .product-overview -->
			<section id="accessories" class="product-overview deeplink-top-fix">
				<header class="product-header section-header">
					<div class="header-wrapper">
						<h2 class="title">Accessories</h2>
						<h5 class="subtitle">Tuning for your gold metal technology</h5>
						<div class="signs">
							<div class="post"></div>
							<nav class="sign-navigation" role="navigation">
								<ul>
									<li class="sign medium"><a href="#wearables">View Wearables</a></li>
									<li class="sign small"><a href="#headwear">View Headwear</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="vibe vibe-4"></div>
				</header>
				<div class="product-filters">
					<button>Board Filters</button>
				</div>
				<ul class="product-list">
					<li class="list-item">
						<a href="#">
							<img src="" alt="" />
							<h4 class="product-name">Board Name</h4>
							<h5 class="product-category">Board Category</h5>
							<p class="product-price">$499.99 USD</p>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</section><!-- .product-overview -->

			<?php endif; ?>

<?php get_footer(); ?>