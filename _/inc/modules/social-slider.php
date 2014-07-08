<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>

			<section class="social-slider">
				<div class="social-list owl-carousel">
					<div class="social-item instagram">
						<a href="" target="_blank" class="owl-lazy" data-src="<?php //echo $image['url']; ?>">
							<div class="item-icon"></div>
						</a>
					</div><!-- .social-item -->
					<div class="social-item facebook">
						<a href="" target="_blank" class="owl-lazy">
							<div class="item-icon"></div>
							<div class="item-photo">
								<img src="" data-src="<?php //echo $image['url']; ?>" alt="" />
							</div>
							<div class="item-copy">
								Title
								Date
								Copy
							</div>
						</a>
					</div><!-- .social-item -->
					<div class="social-item vimeo">
						<a href="" target="_blank" class="owl-lazy" data-src="<?php //echo $image['url']; ?>">
							<div class="item-icon"></div>
						</a>
					</div><!-- .social-item -->
				</div><!-- .social-list -->
				<!--
				3 grams
				6 fb
				3 vids
				3 events
				-->
			</section><!-- .social-slider -->
