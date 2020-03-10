<?php
/*
Template Name: Page News
*/
get_header(); ?>
  <div class="col-lg-8 col-md-8 col-sm-12 col-12">
    <article class="content">
      <?php $news = new WP_Query(array('post_type' => 'news', 'order' => 'ASC')) ?>
      <?php if ( $news->have_posts() ) : ?>
      	   <?php while ( $news->have_posts() ) : $news->the_post(); ?>
             <section id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
               <h2 class="post-title"><a href="<?php  esc_url( the_permalink()) ;?>" rel="bookmark"><?php the_title( ) ?></a></h2>
               <div class="post-head">

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
      <?php endwhile;  wp_reset_postdata();?>
      <section class="section-pagination">
          <h3 class="title-hidden"><?php esc_html_e('Pagination','jobbrschildtheme' ) ?></h3>
          <nav aria-label="page navigation">
                <?php jobbrschildtheme_pagination(); ?>
              </nav>
        </section>
      <?php else: ?>
        <?php esc_html_e('No posts found.','jobbrschildtheme' ) ?>
      <?php endif; ?>
    </article>
  </div>
<?php get_sidebar();
      get_footer();
 ?>
