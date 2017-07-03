<footer id="tg-footer" class="tg-footer tg-haslayout">
	<div class="container">
		<div class="row">
			<div class="tg-four-column tg-haslayout">
				<div class="col-sm-4">
					<?php if ( is_active_sidebar( 'footer_1' ) ) : ?>	
						<?php dynamic_sidebar( 'footer_1' ); ?>
					<?php endif; ?>
				</div>
				<div class="col-sm-4">
					<?php if ( is_active_sidebar( 'footer_2' ) ) : ?>	
						<?php dynamic_sidebar( 'footer_2' ); ?>
					<?php endif; ?>
				</div>
				<div class="col-sm-4">
					<div class="tg-col">
					<?php if ( is_active_sidebar( 'footer_3' ) ) : ?>	
						<?php dynamic_sidebar( 'footer_3' ); ?>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--<div class="tg-brands">
		<div class="container">
			<div class="row">
				<div id="tg-footerbrand-slider" class="tg-footerbrand-slider tg-haslayout owl-carousel owl-theme" style="opacity: 1; display: block;">
					<div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 2340px; left: 0px; display: block;"><div class="owl-item" style="width: 195px;"><div class="tg-theme-post item">
						<figure>
							<img src="https://www.boshop.vn/content/images/thumbs/0003194_loreal_420.jpeg" width="100" height="100">
						</figure>
					</div></div><div class="owl-item" style="width: 195px;"><div class="tg-theme-post item">
						<figure>
							<img src="https://www.boshop.vn/content/images/thumbs/0003195_la-roche-posay_420.jpeg" width="100" height="100">
						</figure>
					</div></div><div class="owl-item" style="width: 195px;"><div class="tg-theme-post item">
						<figure>
							<img src="https://www.boshop.vn/content/images/thumbs/0003071_chanel_420.jpeg" width="100" height="100">
						</figure>
					</div></div><div class="owl-item" style="width: 195px;"><div class="tg-theme-post item">
						<figure>
							<img src="https://www.boshop.vn/content/images/thumbs/0003159_gucci_420.jpeg" width="100" height="100">
						</figure>
					</div></div><div class="owl-item" style="width: 195px;"><div class="tg-theme-post item">
						<figure>
							<img src="<?php echo get_template_directory_uri(); ?>/images/brands/img-01.png" alt="image description">
						</figure>
					</div></div><div class="owl-item" style="width: 195px;"><div class="tg-theme-post item">
						<figure>
							<img src="<?php echo get_template_directory_uri(); ?>/images/brands/img-02.png" alt="image description">
						</figure>
					</div></div></div></div>
					
					
					
					
					
				</div>
			</div>
		</div>
	</div>-->
	<div class="tg-copyrights">
		<div class="container">
			<?php lifesg_menu('footer-menu');?>
			<?php copyright_footer(); ?>
		</div>
	</div>
</footer>
<a href="#" class="back-to-top" id="btnTop" title="Back To Top"><i class="fa fa-chevron-up fa-lg" aria-hidden="true"></i></a>
</div>
<!--************************************
		Wrapper End
*************************************-->
<?php wp_footer(); ?>
<?php if(!wp_is_mobile()){?>
	<script>
	$("#page-posts .posts").masonry({
		itemSelector:".post-container",
		columnWidth:".post-container",
		horizontalOrder: true
	})
	</script>
	<?php } ?>
</body>
</html>