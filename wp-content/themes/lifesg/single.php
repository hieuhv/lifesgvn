<?php get_header();?>
<div class="tg-blog-detail tg-haslayout">
	<!--************************************
			Main Start
	*************************************-->
	<main id="tg-main" class="tg-main tg-haslayout">
		<div class="container">
			<div class="row">
				<div id="tg-twocolumns-upper" class="tg-haslayout">
					<!--************************************
							Content Start
					*************************************-->
					<div class="col-sm-8">
					<?php while(have_posts()): the_post();?>
						<?php setPostViews(get_the_ID()); ?>
						<?php $category = get_the_category();?>
						<?php $tags = get_the_tags();?>
						<div id="tg-content-upper" class="tg-contents tg-haslayout">
								<div class="tg-postcontent-holder">
									<div class="tg-theme-tags">
										<a class="tg-tag tg-tag-hotstory" href="#"><i class="fa fa-star"></i></a>
										<a class="tg-tag tg-tag-category tg-color-pink" href="#"><?php echo $category[0]->name;?></a>
									</div>
									<div>
										<h2><a href="#"><?php the_title(); ?></a></h2>
									</div>
									<ul class="tg-postmetadata">
										<li class="postmeta">
											<a href="#">
												<i class="fa fa-clock-o"></i>
												<span><?php echo get_the_date();?></span>
											</a>
										</li>
										<li class="postmeta">
											<a href="#">
												<i class="fa fa-user"></i>
												<span>by <?php the_author();?></span>
											</a>
										</li>
										<li class="postmeta">
											<a href="#">
												<i class="fa fa-comments-o"></i>
												<span>37</span>
											</a>
										</li>
										<li class="postmeta">
											<a href="#">
												<i class="fa fa-eye"></i>
												<span><?php echo getPostViews(get_the_ID());?></span>
											</a>
										</li>
									</ul>
							</div>
						
							<div class="tg-description">
							<?php the_content();?>
							</div>
							<div class="tg-tags-social tg-haslayout">
							<?php if($tags != false) {?>
								<div class="tg-tags pull-left">
									<i class="fa fa-tags"></i>
									<span>tags: </span>
									<?php foreach($tags as $tag) { ?>
									<a class="tg-btn" href="#"><?php echo $tag->name;?></a>
									<?php } ?>
								</div>
							<?php } ?>
								<div class="tg-social-share pull-right">
									<i class="fa fa-share-square-o"></i>
									<span>share: </span>
									<ul>
										<li>
											<a href="#"><i class="fa fa-facebook-f" data-iconname="on facebook"></i></a>
										</li>
										<li>
											<a href="#"><i class="fa fa-twitter " data-iconname="on twitter"></i></a>
										</li>
										<li>
											<a href="#"><i class="fa fa-pinterest-p" data-iconname="on pinterest"></i></a>
										</li>
										<li>
											<a href="#"><i class="fa fa-linkedin" data-iconname="on linkedin"></i></a>
										</li>
									</ul>
								</div>
							</div>
							<?php
							comments_template();
							?>
						</div>
						<?php endwhile;?>
					</div>
					<!--************************************
							Content End
					*************************************-->
					<!--************************************
							Sidebar Start
					*************************************-->
						<?php get_sidebar(); ?>
					<!--************************************
							Sidebar End
					*************************************-->
				</div>
			</div>
		</div>
	</main>
	<!--************************************
			Main End
	*************************************-->
</div>
<?php get_footer();?>