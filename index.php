<?php get_header(); ?>
<div class="col-lg-8 col-md-8 col-sm-12 col-12">
  <article class="content">
    <?php if ( have_posts() ) :
        while ( have_posts() ) : the_post();
          get_template_part( 'template-parts/content', get_post_type() );
        endwhile; ?>
        <nav aria-label="page navigation" class="pagination justify-content-end"">
              <?php post_pagination(); ?>
            </nav>
        <?php else :
          get_template_part( 'template-parts/content', 'none' );
        endif;
    ?>
  </article>
</div>
<?php get_sidebar();
      get_footer();
 ?>
