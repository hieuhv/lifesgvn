<?php get_header(); ?>
<?php
	$term = get_queried_object();
	$term_id = $term->term_id;
	$classify = get_field_object('field_59113e8358ba8'); 
	$skin_type = get_field_object('field_59114023bc923');
	$purpose = get_field_object('field_5911408650080');
	$GLOBALS['my_query_filters'] = array( 
		'pl'	=> 'classify', 
		'ld'	=> 'skin_type',
		'md'	=> 'purpose',
	);
	foreach( $GLOBALS['my_query_filters'] as $key => $name ) {
		
		// continue if not found in url
		if( empty($_GET[ $key ]) ) {
			
			continue;
			
		} else {
			$value = explode(',', $_GET[ $key ]);
			foreach($value as $item){
				$meta_query[] = array(
					'key'		=> $name,
					'value'		=> $item,
					'compare'	=> 'LIKE',
				);
			}
		}
	}
	$cosmetics = get_all_post_term($term->term_id,'cosmetic',$term->taxonomy,false,$meta_query);
?>
<div class="tg-blog-list tg-haslayout">
	<div class="tg-breadcrumbs tg-haslayout">
		<div class="container">
			<h2><?php echo $term->name;?></h2>
			<ol class="tg-breadcrumb">
				<li><a href="#">Trang Chủ</a></li>
				<li class="active"><?php echo $term->name;?></li>
			</ol>
		</div>
	</div>
	<main id="tg-main" class="tg-main tg-haslayout">
				<div class="container">
					<div class="row">
						<div id="tg-twocolumns-upper" class="tg-haslayout">
			<div class="col-sm-3">
				<div class="clearfix clearfix-navbar margin-top-50"></div>
				<h3>Tìm sản phẩm</h3>
				<div class='sidebar-1'> 
				<?php if(!wp_is_mobile()){?>
					<div class='sidebar-menu open'>Phân loại<div class='expand turn'></div></div>
					<div class='sub-menu filter-menu' style="display:block;">
				<?php } else {?>
					<div class='sidebar-menu'>Phân loại<div class='expand'></div></div>
					<div class='sub-menu filter-menu'>
				<?php } ?>
					  <ul>
					  <?php
						foreach( $classify['choices'] as $k => $v ){
							$checked = (in_array($k,explode(',', $_GET['pl'])))?'checked':'';
					  ?>
						<li>
							<input type="checkbox" <?php echo $checked;?> name="<?php echo $classify['name'];?>[]" value="<?php echo $k;?>" class="filters" />
							<label><?php echo $v;?></label>
						</li>
					  <?php } ?>
					  </ul>
					</div>
					<div class='sidebar-menu'>Loại da<div class='expand'></div></div>
					<div class='sub-menu filter-menu'>
					  <ul>
					  <?php
						foreach( $skin_type['choices'] as $k => $v ){
							$checked = (in_array($k,explode(',', $_GET['ld'])))?'checked':'';
					  ?>
						<li>
							<input type="checkbox" <?php echo $checked;?> name="<?php echo $skin_type['name'];?>[]" value="<?php echo $k;?>" class="filters" />
							<label><?php echo $v;?></label>
						</li>
					  <?php } ?>
					  </ul>
					</div>
					<div class='sidebar-menu'>Mục đích<div class='expand'></div></div>
					<div class='sub-menu filter-menu'>
					  <ul>
					  <?php
						foreach( $purpose['choices'] as $k => $v ){
							$checked = (in_array($k,explode(',', $_GET['md'])))?'checked':'';
					  ?>
						<li>
							<input type="checkbox" <?php echo $checked;?> name="<?php echo $purpose['name'];?>[]" value="<?php echo $k;?>" class="filters" />
							<label><?php echo $v;?></label>
						</li>
					  <?php } ?>
					  </ul>
					</div>
				</div>
			</div>
			<div class="col-sm-9">
			<div class="clearfix clearfix-navbar margin-top-50"></div>
				<section class="section-posts margin-top-30 wow fadeIn" id="page-posts" data-wow-duration="2s">
                        <div class="posts">
				<?php
				if(sizeof($cosmetics)>0) {
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
					} else {
						echo '<h3>Không tìm thấy sản phẩm phù hợp!</h3>';
					}	
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