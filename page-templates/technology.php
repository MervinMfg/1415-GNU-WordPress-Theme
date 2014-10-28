<?php
/*
Template Name: Technology
*/
?>
<?php
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
?>

			<header class="section-header">
				<div class="header-wrapper">
					<h1 class="title"><span>Gold Metal</span> Technology</h1>
					<h5 class="subtitle">Congratulations to Kaitlyn Farrington &amp; Jamie Anderson on their Gold Medal wins in 2014</h5>
				</div>
				<div class="vibe vibe-6"></div>
			</header>

			<?php include get_template_directory() . '/_/inc/modules/featured-slider.php'; ?>

			<div class="section-spacer"></div>
			<nav class="technology-navigation">
				<div class="nav-container">
					<ul>
						<li class="large"><a href="#magne-traction" class="magne-traction">Magne-Traction</a></li>
						<li class="padding-left"><a href="#banana-tech" class="banana-tech">Banana Tech</a></li>
						<li class="padding-left"><a href="#asymmetry" class="asymmetry">Asymmetry</a></li>
						<li class"small"><a href="#bindings-tech" class="bindings">Bindings</a></li>
					</ul>
				</div>
			</nav>
			<section id="magne-traction">
				<div class="section-content-magnetrac">
					<div class="section-photo-wrapper">
						<img src="<?php echo get_template_directory_uri(); ?>/_/img/tech/gnu-magne-traction.jpg" alt="magne-traction photo" class="section-photo" />
					</div>
					<h2>Magne-traction</h2>
					<p>Serrated edge "steak knife technology"  adds control, reduces fatigue and makes snowboarding easier and more fun in any terrain especially hardpack and ice.</p>
					<h3>Turns ice into powder</h3>
					<h4>7 strategically sized and located<span>&nbsp;serrations along the edge length</span></h4>
					<div class="magne-traction-description">
						<div class="description-part">
							<h3>3 large teeth</h3>
							<p class="small">Located in the "unpressurable section" between your feet combine with banana technology to bring the middle of your board to life with control and positive edge hook up where you need it most.</p>
						</div>
						<div class="description-part">
							<h3>2 small teeth</h3>
							<p class="small">Located outside each of your feet add overall edge control without restricting freestyle freedom and looseness.</p>
						</div>
						<div class="description-part">
							<h3>2 outer teeth</h3>
							<p class="small">Traditional contact points out near the tip and tail turn create a smooth positive turn initiation and catchfree freestyle freedom.</p>
						</div>
					</div>
					<div class="clearfix"></div>
					<h3 class="section-link"><a href="/snowboards/">View mag boards</a></h3>
				</div><!-- .section-content-magnetrac -->
			</section><!-- #magne-traction -->
			<section id="banana-tech">
				<div class="section-content-banana">
					<div class="section-photo-wrapper">
						<img src="<?php echo get_template_directory_uri(); ?>/_/img/tech/gnu-banana.jpg" alt="banana technology photo" class="section-photo" />
					</div>
					<h2>Banana Technology</h2>
					<p>The original revolutionary all terrain rocker/camber combination contours. Banana Technology makes snowboards better and easier to ride in every way:  easier to turn, more catchfree jibbing, more pop, better float in powder, better edge hold and carving on hardpack and ice.</p>
					<p>Banana Technology is a very specific set of all terrain rocker and camber combination bottom contours designed around how a snowboard is ridden and activated. The rocker segment of the contour is located strategically between your feet to combine with the largest Magne-traction teeth and bring the central "unpressurable section" of your board to life. Camber segments are located outside your feet adding stability, control, power and pop. When you stand on a Banana Tech design full tip to tail edge contact is activated insuring maximum control, stability and performance on hardpack and ice.</p>
					<p>Banana Tech is an all terrain hardpack focused rocker camber combination contour. Banana Tech is not a limited terrain powder rocker. Gnu has incorporated 3 fundamental Banana Tech groupings and 5 total contours in a simple aggression level/performance progression. 
					</p>
					<h3>Awesome Everywhere</h3>
					<div class="banana-tech-chart">
						<div class="tech-chart-left">
							<div class="tech-scale-top">
								<p>Easiest</p>
								<img src="<?php echo get_template_directory_uri(); ?>/_/img/tech/tech-scale-top.png" alt="GNU technology scale" />
								<p>Perfect<span>Combination</span></p>
							</div>

							<div class="tech-scale-bottom">
							<img src="<?php echo get_template_directory_uri(); ?>/_/img/tech/tech-scale-bottom.png" alt="GNU technology scale" />
								<p>Most<span>Aggresive</span></p>
							</div>
						</div>
						<div class="tech-chart-right">
							<ul class="tech-major clearfix">
								<?php // grab technology if there is any
								$technology = get_field('gnu_banana_technology');
								if( $technology ):
									foreach( $technology as $techItem):
										$title = get_the_title($techItem->ID);
										$content = $techItem->post_content;
										$image = get_field("gnu_technology_icon", $techItem->ID);
								?>

								<li class="clearfix">
									<div class="tech-icon-wrapper">
										<img src="<?php echo $image['url']; ?>" alt="<?php echo $title; ?> Icon" class="icon" />
									</div>
									<div class="tech-chart-description">
										<h3 class="title"><?php echo $title; ?></h3>
										<p class="description small"><?php echo $content; ?></p>
									</div>
								</li>

								<?php endforeach; endif;?>
							</ul>
						</div>
					</div><!-- .banana-tech-chart -->
					<div class="clearfix"></div>
					<h3 class="section-link"><a href="/snowboards/">View banana boards</a></h3>
				</div><!-- .section-content-banana -->
			</section><!-- #banana-tech -->
			<section id="asymmetry">
				<div class="section-content-asymmetry">
					<div class="section-photo-wrapper">
						<img src="<?php echo get_template_directory_uri(); ?>/_/img/tech/gnu-asymmetric.jpg" alt="GNU assymetry boards photo" class="section-photo" />
					</div>
					<h2>Asymmetry</h2>
					<p>Pickle technology makes snowboards easier and more intuitive to ride through the application of unique balancing design elements to each side of the board that   harmonize with your bodies natural asymmetry and the unique toeside and heelside snowboard activation mechanics.</p>
					<p>Turn mechanics on your toe and heelside are completely different.  The angle of attack you can achieve on a toe side turn is much steeper than what is possible on a heelside turn because of ankle, knee and hip dynamics.  Toes are like fingers offering much more precise edge control.  Heels line up directly under your ankle and legs offering a powerful direct connection to the heelside edge.</p>
					<p>"Imperceptible Perfection" - Ride a pickle and after a few runs as your board and body become one snowboarding will become intuitive and you won't feel the asymmetry as much as you will notice you are a better snowboarder and having more fun.</p>
					<p>Gnu has developed 5 pickle tech balancing design elements.</p>
					<h3 class="top">Balance through asymmetry</h3>
					<div class="heading-group">
						<p><span>Core: </span>AsymMETRIC wood lamination softer heelside flex</p>
						<p><span>Sidecuts: </span>Deeper heelside sidecut</p>
						<p><span>Smart magnetraction: </span>power serration on heelSIDE &amp; finess serration on toeSIDE</p>
						<p><span>Contact lengths: </span>Shorter heelside edge contact &amp; longer toeside contact</p>
						<p><span>Shapes: </span>Asymmetric tip &amp; tail shapes</p>
					</div>
					<h3 class="section-link"><a href="/snowboards/">View asym baords</a></h3>
				</div><!-- .section-content-asymmetry -->
			</section><!-- #asymmetry -->
			<section id="bindings-tech">
				<div class="section-content-bindingtech">
					<div class="section-photo-wrapper">
						<img src="<?php echo get_template_directory_uri(); ?>/_/img/tech/gnu-binding.jpg" alt="binding technology photo" class="section-photo" />
					</div>
					<h2>Bindings</h2>
					<p>Congratulations to Kaitlyn Ferrington who took her Gnu bindings to the very pinnacle of athletic achievement.  Lightweight, performance and strength in an incredibly fast binding system.  Makes entry and exit incredibly fast and easy with one hand! No fumbling with ratchet buckles and ladders. Auto Open Lever opens strap automatically when highback is lowered. Close easily with one click.</p>
					<p>Easy in Easy Out!</p>
					<h3 class="section-link"><a href="/bindings/">View bindings</a></h3>
				</div><!-- .section-content-bindingtech -->
			</section><!-- #bindings-tech -->

<?php
	endwhile; endif;
	get_footer();
?>