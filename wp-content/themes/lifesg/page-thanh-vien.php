<?php
ini_set('display_errors',0);
error_reporting(0);
/* Template Name: Panel Page */
$user_id = $current_user->ID;
$member = get_user_meta( $user_id, 'lifesg_member', true );
$fb_id = get_user_meta( $user_id, 'lifesg_facebook_id', true );
if(is_user_logged_in() && $member==1 || in_array( 'lifesg_member', (array) $current_user->roles )){
	get_header();
	global $post;
    $post_slug = $post->post_name;
	//Hello User
	if(!empty($current_user->user_firstname) || !empty($current_user->user_lastname)){
		$hello_user = $current_user->user_firstname.' '.$current_user->user_lastname;
	} else {
		$hello_user = $current_user->user_email;
	}
	$user_post_count = count_user_posts( $user_id , 'cosmetic' );
	$countNoti = CountNotification(get_template_directory_uri().'/logs/'.$user_id.'-notification.txt');
} else {
	wp_redirect( home_url());
	exit();
}
?>
<?php get_header(); ?>
<div id="user_panel">
<div id="left-content">
		<div id="user-panel">
			<div class="avatar">
				<img src="<?php echo get_user_meta($user_id,'avatar',true);?>"/>
			</div>
			<div class="welcome">
				<span>Chào bạn,</span>
				<br/>
				<span class="username"><?php echo ucfirst($hello_user);?></span>
			</div>
			<div class="logout">
				<a href=""><img src="" alt="Logout"/></a>
			</div>
		</div>
		<div id="lists-names">
			<a href="#" class="button">Trang cá nhân</a>
			<div id="lists-container">
				<a href="<?php home_url()?>/thanh-vien/thong-bao-cua-toi/">
					<div class="list">
						<div class="name"><i class="fa fa-bell-o" aria-hidden="true"></i> Thông báo</div>
						<?php if($countNoti>0) { ?>
						<div class="remaining"><?php echo $countNoti;?></div>
						<?php } ?>
					</div>
				</a>
				<a href="<?php home_url()?>/thanh-vien/tai-khoan/">
					<div class="list">
						<div class="name"><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin cá nhân</div>
					</div>
				</a>
				<a href="<?php echo home_url()?>/thanh-vien/dang-bai-moi/">
					<div class="list">
						<div class="name"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Đăng bài mới</div>
					</div>
				</a>
				<a href="<?php echo home_url()?>/thanh-vien/danh-sach-bai-viet/">
					<div class="list">
						<div class="name"><i class="fa fa-file-text-o" aria-hidden="true"></i> Danh sách bài viết</div>
					</div>
				</a>
				<a href="<?php echo home_url()?>/thanh-vien/nhat-ky-hoat-dong/">
					<div class="list">
						<div class="name"><i class="fa fa-list-ul" aria-hidden="true"></i> Nhật ký hoạt động</div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div id="main-content">
		<div id="img-cover-content">
            <img id="img-cover" src="<?php echo get_template_directory_uri().'/images/'.get_option('lifesg_user_cover');?>" class="ui-draggable ui-draggable-disabled">
			<p id="change_cover" data-toggle="modal" data-target="#changeCover"><i class="fa fa-camera fa-lg" aria-hidden="true"></i></p>
		</div>
		<!--<header>
			<div class="list-actions">
				<a href="#" class="button">Edit List</a>
				<a href="#" class="button red">Delete List</a>
			</div>
		</header>-->
		<?php include( get_template_directory() . '/panel_templates/tpl-'.$post_slug.'.php'); ?>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="changeCover" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thay hình cover</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-light lter">
		<div class="fileUpload btn btn-info">
			<a href="#" id="imageCover" style="color:#fff;">Chọn hình cover mới</a>
		</div>
		<span class="file-input-name"></span>
		<input type="hidden" id="coverURL" value="" />
		<span class="help-block m-t small">Kích thước 1280 x 720 pixels. Định dạng PNG, JPG, GIF và không quá 1mb.</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="saveCover">Lưu lại</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
      </div>
    </div>
  </div>
</div>
<?php get_footer();?>