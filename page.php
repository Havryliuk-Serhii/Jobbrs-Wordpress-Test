<?php
/**
 * The template for displaying all pages
**/
get_header();
?>
<div class="col-lg-8 col-md-8 col-sm-12 col-12">
  	<article class="content">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
 	</article>
</div>
	
<?php
get_sidebar();
get_footer();
