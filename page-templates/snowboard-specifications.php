<?php
/*
Template Name: Snowboard Specs
*/
?>
<?php
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
?>

		<header class="specifications-header section-header">
			<div class="header-wrapper">
				<h2 class="title"><?php the_title(); ?></h2>
			</div>
			<div class="vibe vibe-4"></div>
		</header>
		<section class="specifications">
			<div class="specs-key">
				<table>
					<thead>
						<tr>
							<th class="board-size">Size</th>
							<th>Contact</th>
							<th>Side Cut</th>
							<th class="table-head-wide">Nose Width</th>
							<th class="table-head-wide">Waist Width</th>
							<th class="table-head-wide">Tail Width</th>
							<th class="table-head-wide">Stance <span>Min-Max / Set Back</span></th>
							<th>Flex</th>
							<th>Weight</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="spec-tables">
				<?php
					// get the snowboards
					$args = array(
						'post_type' => 'gnu_snowboards',
						'posts_per_page' => -1,
						'orderby' => 'menu_order',
						'order' => 'ASC'
					);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
				?>

				<table>
					<thead>
						<tr>
							<th class="table-heading" colspan="11"><?php the_title(); ?> <span><?php the_field('gnu_snowboard_contour'); ?></span></th>
						</tr>
					</thead>
					<tbody>

				<?php
						if(get_field('gnu_snowboard_specs')):
							while(the_repeater_field('gnu_snowboard_specs')):
								$snowboardLength = get_sub_field('gnu_snowboard_specs_length');
								$snowboardWidth = get_sub_field('gnu_snowboard_specs_width');
								if($snowboardWidth == "Narrow"){
									$snowboardLength = $snowboardLength . "N";
								}else if($snowboardWidth == "Wide"){
									$snowboardLength = $snowboardLength . "W";
								}
				?>
						<tr class="content-table-row">
							<td class="board-length"><?php echo $snowboardLength; ?></td>
							<td><?php the_sub_field('gnu_snowboard_specs_contact_length'); ?></td>
							<td><?php the_sub_field('gnu_snowboard_specs_sidecut'); ?></td>
							<td class="table-head-wide"><?php the_sub_field('gnu_snowboard_specs_nose_width'); ?></td>
							<td class="table-head-wide"><?php the_sub_field('gnu_snowboard_specs_waist_width'); ?></td>
							<td class="table-head-wide"><?php the_sub_field('gnu_snowboard_specs_tail_width'); ?></td>
							<td class="table-head-wide"><?php the_sub_field('gnu_snowboard_specs_stance_range'); ?></td>
							<td><?php the_sub_field('gnu_snowboard_specs_flex_rating'); ?></td>
							<td><?php the_sub_field('gnu_snowboard_specs_weight_range'); ?> +</td>
						</tr>
				<?php
							endwhile;
						endif;
				?>
					</tbody>
				</table>
			
				<?php
					endwhile;
					wp_reset_query();
				?>
			</div><!-- .spec-tables -->
		</div><!-- .specifications -->

<?php
	endwhile; endif;
	get_footer();
?>