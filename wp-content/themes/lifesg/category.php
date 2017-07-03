<?php
	get_header();
?>
<div class="tg-blog-list tg-haslayout">
	<div class="tg-breadcrumbs tg-haslayout">
		<div class="container">
			<h2><?php echo single_cat_title("",false);?></h2>
			<ol class="tg-breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active"><?php echo single_cat_title("",false);?></li>
			</ol>
		</div>
	</div>
	<main id="tg-main" class="tg-main tg-haslayout">
		<div class="container">
			<div class="row">
				<div id="tg-twocolumns-upper" class="tg-twocolumns tg-haslayout">
					<div class="col-sm-8">
						<div id="tg-content" class="tg-content tg-haslayout">
							<div class="tg-haslayout tg-latest-technology">
							<?php
								if(have_posts()){
									while(have_posts()) : the_post();
										$post_id = get_the_ID();
										$thumb = get_the_post_thumbnail($post_id,array( 360, 220)) ;
							?>
								<article class="tg-theme-post tg-category-full">
									<div class="row">
										<div class="col-md-6 col-sm-12">
											<figure>
												<a href="<?php the_permalink();?>">
													<?php echo $thumb;?>
												</a>
												<figcaption>
													<a href="#" class="tg-tag tg-tag-hotstory"><i class="fa fa-star"></i></a>
												</figcaption>
											</figure>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="tg-box" style="height:auto!important;">
												<div class="tg-postcontent">
													<div class="tg-border-heading">
														<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
													</div>
													<ul class="tg-postmetadata">
														<li>
															<a href="#">
																<i class="fa fa-clock-o"></i>
																<span><?php the_date(); ?></span>
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-user"></i>
																<span>by <?php the_author();?></span>
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-comments-o"></i>
																<span><?php echo wp_count_comments(get_the_ID())->approved;?></span>
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-eye"></i>
																<span><?php echo getPostViews(get_the_ID());?></span>
															</a>
														</li>
													</ul>
													<div class="tg-description">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elita sed do eiusmod tempor incididunt ut labore et dolores magna aliqua ut enim ad minim.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</article>
								<?php endwhile;?>
								<?php } ?>
							</div>
							<?php page_nav(); ?>
						</div>
					</div>
					<?php get_sidebar(); ?>
				</div>
			</div>
			
		</div>
		</main>
</div>
<?php get_footer(); ?>