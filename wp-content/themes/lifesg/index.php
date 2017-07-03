<?php get_header(); ?>
<div id="tg-fullpost-slider" class="tg-fullpost-slider tg-fullpost owl-carousel owl-theme" style="opacity: 1; display: block;">
	<?php
	global $lifesg_options;
	?>
	<img src="<?php echo $lifesg_options['header-banner']['url'];?>" style="width:430px;height:auto;margin: 0 auto;display: block;" alt="Changmakeup">
</div>
<main id="tg-main" class="tg-main tg-haslayout">
			<div class="container">
				<div class="row">
<div id="tg-twocolumns-upper" class="tg-twocolumns tg-haslayout">
						<!--************************************
								Content Start
						*************************************-->
						<div class="col-sm-8">
							<div id="tg-content-upper" class="tg-content tg-haslayout">
								<!--************************************
										What's Hot Start
								*************************************-->
								<?php whatshot();?>
								<!--************************************
										What's Hot End
								*************************************-->
								<!--************************************
										Ad Banner Start
								*************************************-->
								<div class="tg-haslayout">
									<figure class="tg-add">
										<a href="#">
											<img src="<?php echo get_template_directory_uri(); ?>/images/addimg-01.jpg" alt="image description">
										</a>
									</figure>
								</div>
								<!--************************************
										Ad Banner End
								*************************************-->
								<!--************************************
										Categories Start
								*************************************-->
								<section class="tg-halfpadding tg-paddingbottomzero tg-haslayout tg-categories-posts">
									<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="tg-category-posts tg-margin-bottom">
											<?php if ( is_active_sidebar( 'home_left' ) ) : ?>
												<?php dynamic_sidebar('home_left');?>
											<?php endif; ?>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="tg-category-posts tg-margin-bottom">
											<?php if ( is_active_sidebar( 'home_right' ) ) : ?>
												<?php dynamic_sidebar('home_right');?>
											<?php endif; ?>
										</div>
									</div>
									<?php for($i=1;$i<=6;$i++){?>
										<?php
											if($i==1){
												$title = 'Body';
											} elseif($i==2) {
												$title = 'Skincare';
											} elseif($i==3) {
												$title = 'Makeup';
											} elseif($i==4) {
												$title = 'Nhiếp Ảnh';
											} elseif($i==5) {
												$title = 'Phim Ảnh';
											} elseif($i==6) {
												$title = 'Ẩm thực';
											}
										?>
										
										
										<!--<div class="col-md-6 col-sm-12">
											<div class="tg-category-posts tg-margin-bottom">
												<div class="tg-section-heading">
													<h2><?php echo $title;?></h2>
												</div>
												<article class="tg-theme-post tg-category-full">
													<figure>
														<a href="#">
															<img src="<?php echo get_template_directory_uri(); ?>/images/categories/img-01.jpg" alt="image description">
														</a>
														<figcaption>
															<div class="tg-box">
																<div class="tg-postcontent">
																	<div class="tg-border-heading">
																		<h3><a href="#">Adipisicing elit, sed do eiusmod temor incididunt labore</a></h3>
																	</div>
																	<ul class="tg-postmetadata">
																		<li>
																			<a href="#">
																				<i class="fa fa-clock-o"></i>
																				<span>Sep 12, 2016</span>
																			</a>
																		</li>
																		<li>
																			<a href="#">
																				<i class="fa fa-user"></i>
																				<span>by Simon</span>
																			</a>
																		</li>
																		<li>
																			<a href="#">
																				<i class="fa fa-comments-o"></i>
																				<span>37</span>
																			</a>
																		</li>
																		<li>
																			<a href="#">
																				<i class="fa fa-eye"></i>
																				<span>1308</span>
																			</a>
																		</li>
																	</ul>
																</div>
															</div>
														</figcaption>
													</figure>
												</article>
												<article class="tg-theme-post tg-category-small">
													<figure>
														<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/categories/thumbnail/img-01.jpg" alt="image description"></a>
														<figcaption><a href="#" class="tg-tag tg-tag-hotstory"><i class="fa fa-star"></i></a></figcaption>
													</figure>
													<div class="tg-postdata">
														<div class="tg-border-heading">
															<h3><a href="#">Adipisicing elit sed do eiuod tempor ut labore</a></h3>
														</div>
														<ul class="tg-postmetadata">
															<li>
																<a href="#">
																	<i class="fa fa-clock-o"></i>
																	<span>Sep 12, 2016</span>
																</a>
															</li>
														</ul>
													</div>
												</article>
												<article class="tg-theme-post tg-category-small">
													<figure>
														<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/categories/thumbnail/img-02.jpg" alt="image description"></a>
													</figure>
													<div class="tg-postdata">
														<div class="tg-border-heading">
															<h3><a href="#">Adipisicing elit sed do eiuod tempor ut labore</a></h3>
														</div>
														<ul class="tg-postmetadata">
															<li>
																<a href="#">
																	<i class="fa fa-clock-o"></i>
																	<span>Sep 12, 2016</span>
																</a>
															</li>
														</ul>
													</div>
												</article>
												<article class="tg-theme-post tg-category-small">
													<figure>
														<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/categories/thumbnail/img-03.jpg" alt="image description"></a>
													</figure>
													<div class="tg-postdata">
														<div class="tg-border-heading">
															<h3><a href="#">Adipisicing elit sed do eiuod tempor ut labore</a></h3>
														</div>
														<ul class="tg-postmetadata">
															<li>
																<a href="#">
																	<i class="fa fa-clock-o"></i>
																	<span>Sep 12, 2016</span>
																</a>
															</li>
														</ul>
													</div>
												</article>
											</div>
										</div>
									<?php } ?>
									</div>-->
								</section>
								<!--************************************
										Categories End
								*************************************-->
							</div>
						</div>
						<!--************************************
								Content End
						*************************************-->
						<?php get_sidebar();?>
					</div>
					</div>
					</div>
					</main>
<?php get_footer(); ?>