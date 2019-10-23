<?php 
$loop = new WP_Query( array( 
	'post_type' => 'testimonials',
	'posts_per_page' => -1,
	)
);
if ( $loop->have_posts() ) : ?>

	<div class="testimonials-slider">
    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<div>
			<h4><?php the_title(); ?></h4>
			<?php
				$company = get_field('company');
				$position =  get_field('title__position');
				if ( $company && $position ) {
					echo '<p class="title-position">' . the_field('company') . _e(', ') . the_field('title__position') . '</p>';
				} elseif ( $position ) {
					echo '<p class="title-position">' . the_field('title__position') . '</p>';
				} elseif ( $company ) {
					echo '<p class="title-position">' . the_field('company') . '</p>';
				} ?>
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
	</div>
<?php endif; wp_reset_query(); ?>