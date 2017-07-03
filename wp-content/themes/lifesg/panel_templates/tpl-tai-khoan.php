<div id="new-task">
	<div class="edit-basic-info clearfix ng-scope" ng-controller="accountInfoCtrl">
		<div class="edit-basic-info">
			<ul class="clearfix nav nav-tabs" id="myTab">
				<li class="active">
					<a href="#profile1" data-target="#profile1" data-toggle="tab" class="title-edit" aria-expanded="true">
						<i class="ico-info ico-info-personal"></i>Thông tin cá nhân
					</a>
				</li>
				<li class="">
					<a href="#beautyProfile" data-target="#beautyProfile" data-toggle="tab" class="title-edit" aria-expanded="false">
						<i class="ico-info ico-info-beauty"></i>Thông tin làm đẹp
					</a>
				</li>
			</ul>
		</div>
		<div style="margin-top:20px;" class="tab-content">
			<div id="profile1" class="tab-pane active">
				<div class="edit-profile-basic-info">
					<?php do_action('process_update_member_info_form'); ?>
					<?php
					$RelationshipStatus = get_the_author_meta( 'RelationshipStatus', $current_user->ID );
					$DateOfBirthDay = get_the_author_meta( 'DateOfBirthDay', $current_user->ID );
					$dateOfBirthMonth = get_the_author_meta( 'DateOfBirthMonth', $current_user->ID );
					$dateOfBirthYear = get_the_author_meta( 'DateOfBirthYear', $current_user->ID );
					$Gender = get_the_author_meta( 'Gender', $current_user->ID );
					$PublishedTypeGender = get_the_author_meta( 'PublishedTypeGender', $current_user->ID );
					$PublishedTypeOld = get_the_author_meta( 'PublishedTypeOld', $current_user->ID );
					$PublishedTypeStatus = get_the_author_meta( 'PublishedTypeStatus', $current_user->ID );
					?>
					<form id="UpdateProfileBasicInfoForm" method="post" class="ng-pristine ng-valid">
						<div class="widget-info-edit clearfix">
							<label>Tên:</label>
							<input class="w250" id="firstname" name="firstname" tabindex="1" type="text" value="<?php echo $current_user->user_firstname;?>">
						</div>
						<div class="widget-info-edit clearfix">
							<label>Họ:</label>
							<input class="w250" id="lastname" name="lastname" tabindex="2" type="text" value="<?php echo $current_user->user_lastname;?>">
						</div>
						<div class="widget-info-edit clearfix">
							<label>Tình trạng hôn nhân:</label>
							<?php $selected1 = ($RelationshipStatus==1)?'selected':''; ?>
							<?php $selected2 = ($RelationshipStatus==2)?'selected':''; ?>
							<?php $selected3 = ($RelationshipStatus==3)?'selected':''; ?>
							<select class="w100 select-w100 mar-right250" data-val="true" data-val-number="The field RelationshipStatus must be a number." id="RelationshipStatus" name="RelationshipStatus" tabindex="3">
								<option value="1" <?php echo $selected1;?>>Độc thân</option>
								<option value="2" <?php echo $selected2;?>>Đã kết hôn</option>
								<option value="3" <?php echo $selected3;?>>Phức tạp</option>
							</select>
							<?php $selected1 = ($PublishedTypeStatus==1)?'selected':'';?>
							<?php $selected2 = ($PublishedTypeStatus==2)?'selected':'';?>
							<select class="w125 select-w125 mar-right25 pull-right" name="PublishedTypeStatus">
								<option value="1" <?php echo $selected1;?>>Không hiển thị</option>
								<option value="2" <?php echo $selected2;?>>Hiển thị</option>
							</select>
						</div>
						<div class="widget-info-edit clearfix">
							<label>Ngày sinh:</label>
							<select class="w78 select-w78 mar-right10" data-bind="value: dateOfBirthDay" name="DateOfBirthDay">
								<option value="0">Ngày</option>
								<?php
									for($day=1; $day<=31; $day++){
										$selected = ($DateOfBirthDay==$day)?'selected':'';
								?>
									<option value="<?php echo $day;?>" <?php echo $selected; ?>><?php echo $day; ?></option>
								<?php } ?>
							</select>
							<select class="w78 select-w78 mar-right10" data-bind="value: dateOfBirthMonth" name="DateOfBirthMonth">
								<option value="0">Tháng</option>
								<?php
									for($month=1; $month<=12; $month++){
										$selected = ($dateOfBirthMonth==$month)?'selected':'';
								?>
									<option value="<?php echo $month;?>" <?php echo $selected; ?>>Tháng <?php echo $month;?></option>
								<?php }?>
							</select>
							<select class="w78 select-w78" data-bind="value: dateOfBirthYear" name="DateOfBirthYear">
								<option value="0">Năm</option>
								<?php
									for($year=1967; $year<=date('Y'); $year++){
										$selected = ($dateOfBirthYear==$year)?'selected':'';
								?>
									<option value="<?php echo $year;?>" <?php echo $selected; ?>><?php echo $year;?></option>
								<?php }?>
							</select>
		
							<?php $selected1 = ($PublishedTypeOld==1)?'selected':'';?>
							<?php $selected2 = ($PublishedTypeOld==2)?'selected':'';?>
							<select class="w125 select-w125 mar-right25 pull-right" name="PublishedTypeOld">
								<option value="1" <?php echo $selected1;?>>Không hiển thị</option>
								<option value="2" <?php echo $selected2;?>>Hiển thị</option>
							</select>
						</div>
						<div class="widget-info-edit clearfix">
							<label>Giới tính:</label>
							<?php $checked1 = ($Gender=='M')?'checked':'';?>
							<?php $checked2 = ($Gender=='F')?'checked':'';?>
							<input <?php echo $checked1;?> id="Gender" name="Gender" style="margin-left:-5px;" type="radio" value="M"><label style="width:70px;">Nam</label>
							<input <?php echo $checked2;?> id="Gender" name="Gender" type="radio" value="F"><label style="width:70px;">Nữ</label>
							<?php $selected1 = ($PublishedTypeGender=='1')?'selected':'';?>
							<?php $selected2 = ($PublishedTypeGender=='2')?'selected':'';?>
							<select class="w125 select-w125 mar-right25 pull-right" name="PublishedTypeGender">
								<option value="1" <?php echo $selected1;?>>Không hiển thị</option>
								<option value="2" <?php echo $selected2;?>>Hiển thị</option>
							</select>
						</div>
					<label class="alert-success" id="id-UpdateProfileBasicInfoForm-success" style="display:none">Cập nhật thành công</label>
					<input type="submit" id="save-change-edit-basic-profile" class="btn btn-info" value="Lưu thay đổi">
					<?php wp_nonce_field( 'update-user', 'add-nonce' ) ?><!-- a little security to process on submission -->
					<input name="action" type="hidden" id="action" value="update-user" />
					</form>
</div><!--edit-basic-info-->
			</div>
			<div class="tab-pane" id="beautyProfile">
				<div class="edit-basic-info edit-profile-basic-info" id="update-beauty-info">
				<?php
	do_action('process_update_beauty_info_form');
	$cr_skinTypes = json_decode(get_the_author_meta( 'skinTypes', $current_user->ID ));
	$cr_skinColors = get_the_author_meta( 'skinColors', $current_user->ID );
	$cr_eyeColors = get_the_author_meta( 'eyeColors', $current_user->ID );
	$cr_hairTypes = json_decode(get_the_author_meta( 'hairTypes', $current_user->ID ));
	$cr_scalpTypes = json_decode(get_the_author_meta( 'scalpTypes', $current_user->ID ));
	$cr_bodyTypes = json_decode(get_the_author_meta( 'bodyTypes', $current_user->ID ));
	?>
	<form method="post">
<div class="widget-info-beauty-edit fix-width clearfix">
	<p class="mar-bot5 bold capitalize pink" style="font-weight:bold;margin-bottom: 10px;">Loại da:</p>
	<!-- ngRepeat: model in skinTypes -->
	<div class="clearfix" style="margin-bottom: 20px;">
	<?php
		foreach($skinTypes as $key => $skinType){
			$checked = in_array($key+1,$cr_skinTypes)?'checked':'';
	?>
	<div style="float:left;" class="ng-scope">
		<input type="checkbox" <?php echo $checked; ?> class="ng-scope ng-pristine ng-untouched ng-valid" value="<?php echo $key+1 ;?>" name="skinTypes[]">
		<label><?php echo $skinType;?></label>
	</div>
	<?php } ?>
	</div>
</div>
<div class="clearfix mar-bot10">
	<p class="mar-bot5 bold capitalize pink" style="font-weight:bold;margin-bottom: 10px;">Màu da:</p>
	<div class="clearfix" style="margin-bottom: 20px;">
		<!-- ngRepeat: model in skinColors -->
		<?php
			foreach($skinColors as $key => $skinColor) {
				$bg = $skinColors_bg[$key];
				$checked = ($key+1 == $cr_skinColors)?'checked':'';
		?>
		<div class="pull-left ng-scope" ng-repeat="model in skinColors">
			<input type="radio" <?php echo $checked;?> class="ng-pristine ng-untouched ng-valid" name="skinColors" value="<?php echo $key+1;?>">
			<label>
				<span title="<?php echo $skinColor;?>" style="background-color: rgb(<?php echo $bg;?>); width: 40px; height: 20px; margin-top: 2px; margin-right: 5px; display: inline-block;"></span>
			</label>
		</div>
		<?php } ?>
		<!-- end ngRepeat: model in skinColors -->
	</div>
</div>

<div class="widget-info-beauty-edit clearfix">
	<p class="mar-bot5 bold capitalize pink" style="font-weight:bold;margin-bottom: 10px;">Màu mắt:</p>
	<div class="clearfix" style="margin-bottom: 20px;">
		<!-- ngRepeat: model in eyeColors -->
		<?php
			foreach($eyeColors as $key => $eyeColor) {
				$bg = $eyeColors_bg[$key];
				$checked = ($key+1 == $cr_eyeColors)?'checked':'';
		?>
		<div class="pull-left ng-scope" >
			<input name="eyeColors" type="radio" <?php echo $checked;?> class="ng-pristine ng-untouched ng-valid" value="<?php echo $key+1;?>">
			<label><img src="<?php echo get_template_directory_uri();?>/images/<?php echo $bg;?>"></label>
		</div>
		<?php } ?>
		<!-- end ngRepeat: model in eyeColors -->
	</div>
</div>

<div class="widget-info-beauty-edit clearfix">
	<p class="mar-bot5 bold capitalize pink" style="font-weight: bold;margin-bottom: 10px;">Loại tóc:</p>
	<div class="clearfix" style="margin-bottom: 20px;">
		<!-- ngRepeat: model in hairTypes -->
		<?php
			foreach($hairTypes as $key => $hairType) {
				$checked = in_array($key+1,$cr_hairTypes)?'checked':'';
		?>
		<div class="pull-left ng-scope">
			<input type="checkbox" <?php echo $checked;?> class="ng-scope ng-pristine ng-untouched ng-valid" name="hairTypes[]" value="<?php echo $key+1;?>">
			<label style="min-width: inherit; margin-right: 10px; padding-left: 23px; " class="ng-binding"><?php echo $hairType;?></label>
		</div><!-- end ngRepeat: model in hairTypes -->
		<?php } ?>
	</div>
</div>

<div class="widget-info-beauty-edit clearfix">
	<p class="mar-bot5 bold capitalize pink" style="font-weight:bold;margin-bottom: 10px;">Loại Da Đầu:</p>
	<div class="clearfix" style="margin-bottom: 20px;">
		<!-- ngRepeat: model in headSkinTypes -->
		<?php
			foreach($scalpTypes as $key=>$scalpType){
				$checked = in_array($key+1,$cr_scalpTypes)?'checked':'';
		?>
		<div class="pull-left ng-scope" ng-repeat="model in headSkinTypes">
			<input type="checkbox" <?php echo $checked;?> class="ng-scope ng-pristine ng-untouched ng-valid" name="scalpTypes[]" value="<?php echo $key+1?>">
			<label class="ng-binding"><?php echo $scalpType;?></label>
		</div>
		<?php } 
		?>
		<!-- end ngRepeat: model in headSkinTypes -->
	</div>
</div>

<div class="widget-info-beauty-edit clearfix">
	<p class="mar-bot5 bold capitalize pink" style="font-weight:bold;margin-bottom: 10px;">Loại Da toàn thân:</p>
	<div class="clearfix" style="margin-bottom: 20px;">
		<!-- ngRepeat: model in bodySkinTypes -->
		<?php
			foreach($bodyTypes as $key=>$bodyType) {
				$checked = in_array($key+1,$cr_bodyTypes)?'checked':'';
		?>
		<div class="pull-left ng-scope">
			<input type="checkbox" <?php echo $checked;?> class="ng-scope ng-pristine ng-untouched ng-valid" name="bodyTypes[]" value="<?php echo $key+1?>">
			<label class="ng-binding"><?php echo $bodyType;?></label>
		</div>
		<?php } ?>
		<!-- end ngRepeat: model in bodySkinTypes -->
	</div>
</div>
<label class="alert-success" id="id-UpdateProfileBeautyInfoForm-success" style="display:none">Cập nhật thành công</label>
<input type="submit" id="save-change-edit-basic-profile" class="btn btn-info" value="Lưu thay đổi">
<?php wp_nonce_field( 'update-beauty', 'add-nonce' ) ?><!-- a little security to process on submission -->
<input name="action" type="hidden" id="action" value="update-beauty" />
</form>
</div>

<!--edit-basic-info-->


			</div>
		</div>
	</div>
	</div>