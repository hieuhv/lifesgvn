<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
	'author'         =>  $user_id,
	'orderby'        =>  'post_date',
	'order'          =>  'DESC',
	'posts_per_page' => 10,
	'paged'          => $paged,
	'post_type'      => 'cosmetic',
	'post_status'    => array( 'publish', 'pending' )
);
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div id="new-task">
	<div class="edit-basic-info clearfix ng-scope" ng-controller="accountInfoCtrl">
		<div class="edit-basic-info">
			<h3><?php the_title(); ?></h3>
		</div>
<?php
$author_posts = new WP_Query( $args );
if($author_posts->have_posts()) : 
?>
<div style="margin-top:20px;" class="tab-content">
<table class="tbl-qa">
	  <thead>
		  <tr>
			<th class="table-header" width="7%" style="text-align:center;">STT</th>
			<th class="table-header">Tiêu đề</th>
			<th class="table-header">Chuyên mục</th>
			<th class="table-header" width="15%">Ngày đăng</th>
			<th class="table-header" width="13%">Trạng thái</th>
			<th class="table-header" style="text-align:center;" width="10%">Công cụ</th>
		  </tr>
	  </thead>
	  <tbody>
	<?php
	$k = 0;
	while($author_posts->have_posts()) : 
		$k++;
		$author_posts->the_post();
		$categories = get_the_terms( get_the_ID(), 'cosmetic_type' );
		$post_status = (get_post_status()=='publish')?'Đã duyệt':'Đang chờ duyệt';
		$post_link = (get_post_status()=='publish')?get_the_permalink():home_url().'/?p='.get_the_ID().'&preview=true';
		if(get_post_status()=='publish'){
			$edit_link = '<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>';
		} else {
			$edit_link = '<a href="'.home_url().'/tai-khoan/chinh-sua-bai-viet/?id='.get_the_ID().'" title="Chỉnh sửa bài viết" alt="Chỉnh sửa bài viết"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>';
		}
		$arr_catname = array();
		foreach( $categories as $category ) {
			$arr_catname[] = $category->name;
			$list_cat = implode(', ',$arr_catname);
		}
		?>
		  <tr class="table-row">
			<td style="text-align:center;"><?php echo $k; ?></td>
			<td><a href="<?php echo $post_link;?>" target="_blank"><?php the_title(); ?></a></td>
			<td><?php echo $list_cat; ?></td>
			<td><?php echo get_the_date(); ?></td>
			<td><?php echo $post_status; ?></td>
			<td style="text-align:center;"><?php echo $edit_link;?></td>
		  </tr>
	<?php
	endwhile;
	?>
	</tbody>
</table>
<!-- pagination -->
<?php next_posts_link('&laquo; Trang trước') ?>
<?php previous_posts_link('Trang kế tiếp;') ?>
<?php
else:
echo '<p class="no-activity">Bạn chưa có bài viết nào, đăng bài viết mới <strong><a href="'.home_url('thanh-vien/dang-bai-moi').'">tại đây</a></strong> nhé ^^!</p>';
endif;
?>
</div><!-- .entry-content -->
	</div><!-- .hentry .post -->
</div>
    <?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
<?php else: ?>
    <p class="no-data">
        <?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
    </p><!-- .no-data -->
<?php endif; ?>