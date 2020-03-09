<?php
/**
 * Template part for displaying posts
**/
?>
<section id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
      <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php single_post_title(); ?></a></h2>
      <span class="author"><?php the_author(); ?></span>
        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
          <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>" class="btn-post"><?php esc_html_e('Read More','jobbrs' ) ?></a>
    </section>
   
              <p><?php esc_html_e('Sorry, but nothing posted.', 'jobbrs') ?></p>
     



	

	