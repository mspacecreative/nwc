<?php 
$loop = new WP_Query( array( 
	'post_type' => 'clients',
	'posts_per_page' => -1,
	)
);
if ( $loop->have_posts() ) : ?>

	<ul class="client-logos">
    <?php while ( $loop->have_posts() ) : $loop->the_post();
    
    	if ( get_field('square_logo') ): ?>
    	<li class="square-logo">
	    	<?php if ( has_post_thumbnail() ) {
	    		echo the_post_thumbnail( array(400,'') );
	    	} ?>
    	</li>
		<?php else : ?>
		<li>
			<?php if ( has_post_thumbnail() ) {
				echo the_post_thumbnail( array(400,'') );
			} ?>
		</li>
    	<?php endif;
    
    endwhile; ?>
	</ul>
	
<?php endif; wp_reset_query(); ?>