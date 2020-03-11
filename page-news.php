<?php
/*
Template Name: Page News
*/
get_header(); ?>
  <div class="col-lg-8 col-md-8 col-sm-12 col-12">
    <article class="content">
      <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      query_posts(array(
          'post_type' => 'news',
          'paged' => $paged,
          'posts_per_page' => 2
)); ?>
      <?php if ( have_posts() ) :  while ( have_posts() ) : the_post();  ?>
             <section id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
               <h2 class="post-title"><a href="<?php  esc_url( the_permalink()) ;?>" rel="bookmark"><?php the_title( ) ?></a></h2>
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

         <?php endwhile;?>
         <nav aria-label="page navigation" class="pagination justify-content-end"">
               <?php post_pagination(); ?>
         </nav>
              <?php  else:
                  esc_html_e('No posts found.','jobbrs' );
                endif;
          ?>
    </article>
  </div>
<?php get_sidebar();
      get_footer();
 ?>
