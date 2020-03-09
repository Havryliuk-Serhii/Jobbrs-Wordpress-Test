		</div>
	</div>
</main>
<footer class="footer bg-primary" role="contentinfo">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<p class="text-white">&copy; <?php echo date("Y") ?> <a class="footer-link" href="<?php echo home_url(); ?>" title="<?php esc_attr( bloginfo('name') ); ?>"><?php bloginfo('name'); ?></a></p>
			</div>	
		</div>		
	</div>
</footer>
<?php
	wp_footer();
?>
</body>
</html>  