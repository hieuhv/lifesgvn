<?php get_header(); ?>
<?php
	$term = get_queried_object();
	$term_id = $term->term_id;
	$cosmetics = get_all_post_term($term->term_id,'cosmetic',$term->taxonomy);
?>
<div class="tg-blog-list tg-haslayout">
	<div class="tg-breadcrumbs tg-haslayout">
		<div class="container">
			<h2>Tag: <?php echo $term->name;?></h2>
			<ol class="tg-breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Tag: <?php echo $term->name;?></li>
			</ol>
		</div>
	</div>
	<main id="tg-main" class="tg-main tg-haslayout">
		<div class="container">
			<div class="row">
				<div id="tg-twocolumns-upper" class="tg-haslayout">
			<div class="col-sm-9">
			<div class="clearfix clearfix-navbar margin-top-50"></div>
				<section class="section-posts margin-top-30 wow fadeIn" id="page-posts" data-wow-duration="2s">
                        <div class="posts">
				<?php
				foreach($cosmetics as $cos): setup_postdata( $cos );
						?>
						<div class="post-container">
							<div class="post">
								<div class="post-thumbnail">
									<a rel="0" href="<?php echo get_post_permalink($cos->ID)?>" title="<?php echo $cos->post_title?>">
										<img src="<?php echo get_the_post_thumbnail_url($cos->ID, 'medium')  ?>" alt="">
									</a>
								</div>
								<div class="post-detail">
									<h4 class="post-title">
										<a rel="0" href="<?php echo get_post_permalink($cos->ID) ?>" title="<?php echo $cos->post_title?>"><?php echo $cos->post_title?></a>
									</h4>
									<div class="post-description">
										<p>
											<?php echo $cos->post_excerpt; ?>
										</p>
									</div>
								</div>
							</div>
						</div>
				<?php
					endforeach;
				?>
					</div>
			</section>
			<div class="clearfix clearfix-navbar margin-top-50"></div>
		</div>
	</div>
	</div>
	</div>
	<input type="hidden" id="cr_term" value="<?php echo get_term_link($term)?>" />
	</main>
	<?php //page_nav(); ?>
</div>
<?php get_footer();?>