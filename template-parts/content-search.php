<?php
/**
 * Template part for displaying results in search pages
**/

?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
				jobbrs_posted_on();
				jobbrs_posted_by();
			?>
		</div>
		<?php endif; ?>
	</div>

	<?php jobbrs_post_thumbnail(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>	
</section>
