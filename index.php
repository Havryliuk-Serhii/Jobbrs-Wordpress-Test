<?php get_header(); ?>
<div class="col-lg-8 col-md-8 col-sm-12 col-12">
  <article class="content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
      <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php single_post_title(); ?></a></h2>
      <span class="author"><?php the_author(); ?></span>
        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
          <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>" class="btn-post"><?php esc_html_e('Read More','jobbrs' ) ?></a>
    </section>
    <?php endwhile;
          else : ?>
              <p><?php esc_html_e('Sorry, but nothing posted.', 'jobbrs') ?></p>
     <?php endif; ?> 
    <section class="page-pagination">
      <h3 class="title-hidden"><?php esc_html_e('Pagination','jobbrs' ) ?></h3>
        <nav aria-label="page navigation">
          <?php jobbrs_pagination(); ?>
        </nav>
    </section>
  </article>
</div>
<?php get_sidebar();
      get_footer();
 ?>