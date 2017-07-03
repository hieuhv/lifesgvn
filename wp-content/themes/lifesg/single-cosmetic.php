<?php get_header();?>
<?php $category = get_the_terms(get_the_ID(),'cosmetic_type');?>
<div class="tg-blog-detail tg-haslayout">
	<div class="tg-breadcrumbs tg-haslayout">
		<div class="container">
			<ol class="tg-breadcrumb" style="text-align: left;">
				<li><a href="#">Trang Chủ</a></li>
				<li class="active"><?php echo $category[0]->name;?></li>
			</ol>
		</div>
	</div>
	<!--************************************
			Main Start
	*************************************-->
	<main id="tg-main" class="tg-main tg-haslayout">
		<div class="container">
			<div class="row">
				<div id="tg-twocolumns-upper" class="tg-haslayout">
					<div class="clearfix clearfix-navbar margin-top-50"></div>
					<!--************************************
							Content Start
					*************************************-->
					<div class="col-sm-3">
					<?php if(!wp_is_mobile()){?>
						<?php popular_posts('Xem nhiều');?>
					<?php } ?>
					</div>
					<div class="col-sm-6" id="post_content">
					<?php while(have_posts()): the_post();?>
						<?php setPostViews(get_the_ID()); ?>
						<?php //LogUserActivity('Bạn đã xem bài viết: '.get_the_title());?>
						<?php $tags = wp_get_post_terms(get_the_ID(),'cosmetic_tag');?>
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
												<span><?php echo wp_count_comments(get_the_ID())->approved;?></span>
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
								<div class="tg-tags pull-left">
									<i class="fa fa-tags"></i>
									<span>tags: </span>
									<?php foreach($tags as $tag) { ?>
									<a class="tg-btn" href="<?php echo get_term_link($tag);?>"><?php echo $tag->name;?></a>
									<?php } ?>
								</div>
								<div class="tg-social-share pull-right">
									<i class="fa fa-share-square-o"></i>
									<span>share: </span>
									<ul>
										<li>
											<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>" class="share_this" target="_blank"><i class="fa fa-facebook-f" data-iconname="on facebook"></i></a>
										</li>
										<li>
											<a href="http://twitter.com/share?url=<?php the_permalink();?>" class="share_this" target="_blank"><i class="fa fa-twitter " data-iconname="on twitter"></i></a>
										</li>
										<li>
											<a href="http://pinterest.com/pinthis?url=<?php the_permalink();?>" target="_blank" class="share_this"><i class="fa fa-pinterest-p" data-iconname="on pinterest"></i></a>
										</li>
										<li>
											<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>" target="_blank" class="share_this"><i class="fa fa-linkedin" data-iconname="on linkedin"></i></a>
										</li>
									</ul>
								</div>
							</div>
							<?php
							like_category($category[0]->term_id);
							comments_template();
							?>
						<?php endwhile;?>
					</div>
					</div>
					<!--************************************
							Content End
					*************************************-->
					<!--************************************
							Sidebar Start
					*************************************-->
					<div class="col-sm-3">
					<?php if(!wp_is_mobile()){?>
					<div id="right_sidebar">
						<div class="blog-author" id="blog-author" style="display: block;">
							<div class="title-author"><span>tác giả</span></div>
						<div class="tg-author-detail tg-theme-post tg-category-small">
							<figure>
								<img src="<?php echo get_user_meta(get_the_author_ID(),'avatar',true);?>" alt="image description">
							</figure>
							<div class="tg-postdata">
							<div class="tg-border-heading">
								<h3><a href="#"><?php the_author_meta('display_name');?></a></h3>
								<p>Hiện có <?php echo count_user_posts(get_the_author_ID(),'cosmetic');?> bài viết</p>
							</div>
								<ul class="tg-socialicons">
									<li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-tumblr"></i></a></li>
								</ul>
							</div>
						</div>
						</div>
						<?php author_posts('Cùng tác giả',get_the_author_ID());?>
					</div>
					<?php } ?>
					</div>
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
	<script>
	sidebar_scroll('moreview_posts');
	sidebar_scroll('right_sidebar');
	</script>
</div>
<?php get_footer();?>