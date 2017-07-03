<div id="new-task">
	<div class="edit-basic-info clearfix ng-scope" ng-controller="accountInfoCtrl">
		<div class="edit-basic-info">
			<ul class="clearfix nav nav-tabs" id="myTab">
				<li class="active">
					<a href="#newpost" data-target="#newpost" data-toggle="tab" class="title-edit" aria-expanded="true">
						<i class="ico-info ico-info-personal"></i>Đăng bài mới
					</a>
				</li>
			</ul>
		</div>
		<div style="margin-top:20px;" class="tab-content">
			<div id="newpost" class="tab-pane active">
				<div class="edit-profile-basic-info">
				<?php do_action('process_add_new_post_form');?>
				<form id="UpdateProfileBasicInfoForm" method="post" class="ng-pristine ng-valid">
					<div class="widget-info-edit clearfix">
						<a class="pull-left thumb avatar m-r"><img id="image-url" src="<?php echo $_POST['post_thumb'];?>" style="margin-right:10px;" />
						<input type="hidden" name="post_thumb" id="post_thumb" value="<?php echo $_POST['post_thumb'];?>"/></a>
						<div class="clear">
							<label>Hình đại diện</label>
							<div class="fileUpload btn btn-info">
								<a href="#" id="fimg-button">Chọn hình mới</a>
							</div>
							<span class="help-block m-b-none small">Định dạng PNG, JPG, GIF và không quá 1mb.</span>
						</div>                
					</div>
					<div class="widget-info-edit clearfix">
						<label>Tiêu đề</label>
						<input class="w450" id="post_title" name="post_title" tabindex="1" type="text" value="">
					</div>
					<div class="widget-info-edit clearfix">
						<label>Mô tả ngắn</label>
						<textarea name="post_excerpt" id="post_excerpt" rows="4"></textarea>
					</div>
					<div class="widget-info-edit clearfix">
						<label>Từ khóa</label>
						<textarea name="tag_cloud" id="tag_cloud" rows="1"></textarea>
					</div>
					<div class="widget-info-edit clearfix">
						<label>Nội dung</label>
						<?php wp_editor('', 'post_content'); ?>
					</div>
					<?php
						$categories = get_terms( array(
							'taxonomy' => 'cosmetic_type',
							'hide_empty' => false,
						) );
					?>
					<div class="widget-info-edit clearfix">
						<label>Danh mục</label>
						<select name="post_category" id="post_category" class="form-control">
							<option value="">Chọn danh mục</option>
							<?php foreach($categories as $category):?>
							<option value="<?php echo $category->term_id;?>"><?php echo $category->name;?></option>
							<?php endforeach;?>
						</select>
					</div>
					<?php
						$classify = get_field_object('field_59113e8358ba8'); 
						$skin_type = get_field_object('field_59114023bc923');
						$purpose = get_field_object('field_5911408650080');
						//var_dump(get_field('classify',122));
					?>
					<div class="widget-info-edit clearfix">
						<label>Phân loại</label>
						<div class="clearfix" style="margin-bottom: 20px;">
							<?php foreach( $classify['choices'] as $k => $v ){ ?>
							<p class="check_field">
								<input type="checkbox" name="<?php echo $classify['name'];?>[]" value="<?php echo $k;?>" />
								<label><?php echo $v;?></label>
							</p>
							<?php } ?>
						</div>
					</div>
					<div class="widget-info-edit clearfix">
						<label>Loại da</label>
						<div class="clearfix" style="margin-bottom: 20px;">
							<?php foreach( $skin_type['choices'] as $k => $v ){ ?>
							<p class="check_field">
								<input type="checkbox" name="<?php echo $skin_type['name'];?>[]" value="<?php echo $k;?>" />
								<label><?php echo $v;?></label>
							</p>
							<?php } ?>
						</div>
					</div>
					<div class="widget-info-edit clearfix">
						<label>Mục đích</label>
						<div class="clearfix" style="margin-bottom: 20px;">
							<?php foreach( $purpose['choices'] as $k => $v ){ ?>
							<p class="check_field">
								<input type="checkbox" name="<?php echo $purpose['name'];?>[]" value="<?php echo $k;?>" />
								<label><?php echo $v;?></label>
							</p>
							<?php } ?>
						</div>
					</div>
					<input type="submit" id="save-change-edit-basic-profile" class="btn btn-info" value="Đăng bài">
					<?php wp_nonce_field( 'new-post', 'add-nonce' ) ?><!-- a little security to process on submission -->
					<input name="action" type="hidden" id="action" value="new-post" />
				</form>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>