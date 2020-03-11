<?php
/**
 * Template part for displaying posts
**/
?>
<section id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<?php
		if ( is_singular() ) :
			the_title( '<h1 class="post-title">', '</h1>' );
		else :
			the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
	?>
	<div class="post-head">
		<span class="byline">
			<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/avatar.png" alt="">
		</span>
		<span class="author"><?php the_author(); ?></span>
	</div>
    <div class="post-content">
      	<?php the_excerpt(); ?>

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php endif; ?>
    </div>
</section>
