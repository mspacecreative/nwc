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
            'terms' => 'publication',
        )
    )
);
$loop = get_posts($args);

if ( $loop ) : ?>
<div class="centered-title-with-line-rules">
	<h2><?php _e('Publications'); ?></h2>
</div>
<div class="display-flex row">
	<?php foreach ( $loop as $post ) : setup_postdata( $post ); ?>
	
	<div class="column column_one_half">
		<?php
		$thumb_id = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'resource-img' );
		$url = $thumb_id['0'];
		$video = get_field('video', $post->ID);
		$articlelink = get_field('article_link', $post->ID);
		$audio = get_field('audio', $post->ID);
		$showtitle = get_field('show_title', $post->ID);
		$showcontent = get_field('show_content', $post->ID);
		$resourcelogo = get_field('resource_logo', $post->ID);
		
		if ( $url && $audio && $resourcelogo && $articlelink ) {
			echo '<div class="resource-image-container resource-logo audio-overlay"><a class="play-audio" href="javascript:void(0);"><img src="' . $url . '"></a></div>
			      <div class="audio-tag-container"><audio class="audio-player" controls controls src="' . $audio . '"></audio></div>';
		} elseif ( $url && $resourcelogo && $articlelink ) {
			echo '<div class="resource-image-container resource-logo article-overlay"><a class="open-article" href="' . $articlelink . '" target="_blank"><img src="' . $url . '"></a></div>';
		} elseif ( $url && $audio && $articlelink ) {
			echo '<div class="resource-image-container audio-overlay"><a class="play-audio" href="javascript:void(0);"><img src="' . $url . '"></a></div>
			      <div class="audio-tag-container"><audio class="audio-player" controls controls src="' . $audio . '"></audio></div>';
		} elseif ( $url && $audio ) {
			echo '<div class="resource-image-container audio-overlay"><a class="play-audio" href="javascript:void(0);"><img src="' . $url . '"></a></div>
			      <div class="audio-tag-container"><audio class="audio-player" controls controls src="' . $audio . '"></audio></div>';
		} elseif ( $url && $resourcelogo ) {
			echo '<div class="resource-image-container resource-logo"><a class="play-audio" href="javascript:void(0);"><img src="' . $url . '"></a></div>
			      <div class="audio-tag-container"><audio class="audio-player" controls controls src="' . $audio . '"></audio></div>';
		} elseif ( $url && $audio ) {
			echo '<div class="resource-image-container"><a class="play-audio" href="javascript:void(0);"><img src="' . $url . '"></a></div>
			      <div class="audio-tag-container"><audio class="audio-player" controls controls src="' . $audio . '"></audio></div>';
		} elseif ( $url && $articlelink ) {
			echo '<a href="' . $articlelink . '" target="_blank"><img src="' . $url . '"></a>';
		} elseif ( $url ) {
			echo '<img src="' . $url . '">';
		}
		
		if ( $showtitle && $showcontent ) {
			echo '<h3>' . get_the_title($postID) . '</h3>
			      <p>' . get_the_content($postID) . '</p>';
		} elseif ( $showtitle ) {
			echo '<h3>' . get_the_title($postID) . '</h3>';
		} elseif ( $showcontent ) {
			echo '<p>' . get_the_content($postID) . '</p>';
		}
		
		if( have_rows('external_link', $post->ID) ): 
		while( have_rows('external_link', $post->ID) ): the_row();
		$link = get_sub_field('link', $post->ID);
		$label = get_sub_field('label', $post->ID);
		
		if ( $link && $label ): ?>
		
		<a href="<?php the_sub_field('link', $post->ID); ?>" class="article-link" target="_blank"><?php the_sub_field('label', $post->ID); ?></a>
		
		<?php
		endif; 
		endwhile;
		endif; ?>
	</div>
	
	<?php endforeach; ?>
</div>
<?php endif; wp_reset_postdata(); ?>
