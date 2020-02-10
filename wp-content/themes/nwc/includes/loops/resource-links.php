<?php 
$args = array(
    'post_type' => 'resources',
    'posts_per_page'=> -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => 'resource_type',
            'field' => 'slug',
            'terms' => 'relevant-links',
        )
    )
);
$loop = get_posts($args);

if ( $loop ) : ?>
<div class="centered-title-with-line-rules">
	<h2><?php _e('Relevant Links'); ?></h2>
</div>
<div class="display-flex row justify-content-normal">
	<?php foreach ( $loop as $post ) : setup_postdata( $post ); ?>
	
	<div class="column column_one_quarter">
		<div class="inner">
			<?php
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			$title = get_the_title($postID);
			$squarelogo = get_field('resource_logo', $post->ID);
			$uscompany = get_field('filters', $post->ID);
			
			if ( $url && $squarelogo ) {
				echo '<div class="relevant-links-image-container square-logo"><img src="' . $url . '"></a></div>';
			} elseif ( $url ) {
				echo '<div class="relevant-links-image-container"><img src="' . $url . '"></a></div>';
			}
			
			if ( $title && $uscompany && in_array('usa', $uscompany) ): ?>
				<div class="relevant-link-content">
					<div class="us-company">USA</div>
					<h3><?php echo $title ?></h3>
					
					<?php if( have_rows('external_link', $post->ID) ): 
					while( have_rows('external_link', $post->ID) ): the_row();
					$link = get_sub_field('link', $post->ID);
					$label = get_sub_field('label', $post->ID);
					
					if ( $link && $label ): ?>
					
					<a href="<?php the_sub_field('link', $post->ID); ?>" class="article-link" target="_blank"><?php the_sub_field('label', $post->ID); ?></a>
					
					<?php elseif ( $link ): ?>
						
					<a href="<?php the_sub_field('link', $post->ID); ?>" class="article-link" target="_blank"><?php _e('Learn More'); ?></a>
					
					<?php
					endif; 
					endwhile;
					endif; ?>
				
				</div>
				
			<?php elseif ( $title ): ?>
				<div class="relevant-link-content">
					<h3><?php echo $title ?></h3>
					
					<?php if( have_rows('external_link', $post->ID) ): 
					while( have_rows('external_link', $post->ID) ): the_row();
					$link = get_sub_field('link', $post->ID);
					$label = get_sub_field('label', $post->ID);
					
					if ( $link && $label ): ?>
					
					<a href="<?php the_sub_field('link', $post->ID); ?>" class="article-link" target="_blank"><?php the_sub_field('label', $post->ID); ?></a>
					
					<?php elseif ( $link ): ?>
						
					<a href="<?php the_sub_field('link', $post->ID); ?>" class="article-link" target="_blank"><?php _e('Learn More'); ?></a>
					
					<?php
					endif; 
					endwhile;
					endif; ?>
				
				</div>
			<?php endif; ?>
		</div>
	</div>
	
	<?php endforeach; ?>
</div>
<?php endif; wp_reset_postdata(); ?>
