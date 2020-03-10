<?php
/**
 * The sidebar containing the main widget area
**/

if ( ! is_active_sidebar( 'sidebar-area' ) ) {
	return;
}
?>
<div class="col-lg-4 col-md-4 col-sm-12 col-12">
	<aside id="secondary" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-area' ); ?>
	</aside>
</div>
