<?php
/* Get user info. */
	global $current_user, $wp_roles;
	//get_currentuserinfo(); //deprecated since 3.1
	/* Load the registration file. */
	//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
	$error = array();    
	/* If profile was saved, update profile. */
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
		/* Update user information. */
		if ( !empty( $_POST['url'] ) )
			wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] ) ) );
		if ( !empty( $_POST['email'] ) ){
			if (!is_email(esc_attr( $_POST['email'] )))
				$error['email'] = __('Không đúng định dạng email, vui lòng thử lại.', 'profile');
			elseif(email_exists(esc_attr( $_POST['email'] ) && $_POST['email']!=$current_user->user_email))
				$error['email'] = __('Email này đã có người sử dụng.', 'profile');
			else{
				wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
			}
		}

		if ( !empty( $_POST['enterprise_name'] ) )
			update_user_meta($current_user->ID, 'enterprise_name', esc_attr( $_POST['enterprise_name'] ) );
		if ( !empty( $_POST['enterprise_deputy'] ) )
			update_user_meta($current_user->ID, 'enterprise_deputy', esc_attr( $_POST['enterprise_deputy'] ) );
		if ( !empty( $_POST['enterprise_phone'] ) )
			update_user_meta($current_user->ID, 'enterprise_phone', esc_attr( $_POST['enterprise_phone'] ) );
		if ( !empty( $_POST['enterprise_add'] ) )
			update_user_meta( $current_user->ID, 'enterprise_add', esc_attr( $_POST['enterprise_add'] ) );
		if ( !empty( $_POST['enterprise_tt'] ) )
			update_user_meta( $current_user->ID, 'enterprise_tt', esc_attr( $_POST['enterprise_tt'] ) );
		/* Redirect so the page will show updated info.*/
	  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
		if ( count($error) == 0 ) {
			//action hook for plugins and extra fields saving
			do_action('edit_user_profile_update', $current_user->ID);
			if(!isset($current_user->updated) || $current_user->updated!=1){
				update_user_meta( $current_user->ID, 'updated', 1 );
				wp_redirect( home_url().'/dn/hoan-tat-cap-nhat-thong-tin.html' );
			} else {
				wp_redirect( get_permalink() );
			}
			//wp_redirect( home_url() );
			exit;
		}
	}
?>
<?php if ( count($error) > 0 ) echo '<p class="error" style="color:red;font-weight:bold;">* ' . implode("<br />", $error) . '</p>'; ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
if(isset($_GET['action']) && $_GET['action']=="xac-thuc-tai-khoan"){
	if(isset($current_user->updated) && $current_user->updated==1){
		wp_redirect( get_permalink() );
	} else {
		wp_cache_clear_cache();
		if($current_user->ID!=$_SESSION['au_id']){
			echo "<p>Tài khoản này không thuộc quyền sở hữu của bạn. Vui lòng thử lại</p>";
		}
	}
	$title = "Xác thực Tài khoản Doanh Nghiệp";
} else {
	$title = get_the_title();
}
?>
	<div id="post-<?php the_ID(); ?>">
		<div class="entry-content entry">
			<h2><?php echo $title; ?></h2>
				<form method="post" id="adduser" action="" novalidate="novalidate">
					<p class="form-username">
						<label for="enterprise_name"><?php _e('Tên doanh nghiệp/Cửa hàng', 'profile'); ?></label>
						<input class="text-input" name="enterprise_name" type="text" id="enterprise_name" value="<?php the_author_meta( 'enterprise_name', $current_user->ID ); ?>" />
					</p><!-- .form-username -->
					<p class="form-username">
						<label for="enterprise_deputy"><?php _e('Người đại diện', 'profile'); ?></label>
						<input class="text-input" name="enterprise_deputy" type="text" id="enterprise_deputy" value="<?php the_author_meta( 'enterprise_deputy', $current_user->ID ); ?>" />
					</p><!-- .form-username -->
					<p class="form-email">
						<label for="email"><?php _e('E-mail', 'profile'); ?></label>
						<input class="text-input" name="email" type="text" id="email" disabled value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
					</p><!-- .form-email -->
					<p class="form-email">
						<label for="enterprise_phone"><?php _e('Số điện thoại', 'profile'); ?></label>
						<input class="text-input" name="enterprise_phone" type="text" id="enterprise_phone" value="<?php the_author_meta( 'enterprise_phone', $current_user->ID ); ?>" />
					</p><!-- .form-email -->
					<p class="form-email">
						<label for="enterprise_add"><?php _e('Địa chỉ', 'profile'); ?></label>
						<input class="text-input" name="enterprise_add" type="text" id="enterprise_add" value="<?php the_author_meta( 'enterprise_add', $current_user->ID ); ?>" />
					</p><!-- .form-email -->
					<?php
					global $wpdb;
					$results = $wpdb->get_results( 'SELECT * FROM wp_location');
					?>
					<p class="form-enterprise_add">
						<label for="enterprise_add"><?php echo 'Tỉnh/Thành phố (*)'; ?></label>
						<select name="enterprise_tt" id="enterprise_tt">
						<?php
						foreach($results as $vl):
						$selected = ($_POST['enterprise_tt']==$vl->id_location)?"selected":"";
						?>
						<option value="<?php echo $vl->id_location;?>" <?php echo $selected;?>><?php echo $vl->location_name; ?></option>
						<?php endforeach;?>
						</select>
					</p>
					<?php 
						//action hook for plugin and extra fields
						do_action('edit_user_profile',$current_user); 
					?>
					<p class="form-submit">
						<?php echo $referer; ?>
						<input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Cập nhật', 'profile'); ?>" />
						<?php wp_nonce_field( 'update-user' ) ?>
						<input name="action" type="hidden" id="action" value="update-user" />
					</p><!-- .form-submit -->
				</form><!-- #adduser -->
		</div><!-- .entry-content -->
	</div><!-- .hentry .post -->
	<style>
	label.error{
		font-size: 13px;
		color: red;
		margin-top: -18px;
		font-style:italic;
	}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="<?php echo get_template_directory_uri();?>/js/jquery.validate.min.js"></script>
	<script>
	(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#adduser").validate({
                rules: {
                    enterprise_name: "required",
                    enterprise_deputy: "required",
                    enterprise_phone: "required",
                    enterprise_add: "required"
                },
                messages: {
                    enterprise_name: "(*) Vui lòng nhập Tên doanh nghiệp/Cửa hàng",
                    enterprise_deputy: "(*) Vui lòng nhập Tên người đại diện",
                    enterprise_phone: "(*) Vui lòng nhập Số điện thoại",
                    enterprise_add: "(*) Vui lòng nhập địa chỉ"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
	</script>
    <?php endwhile; ?>
<?php else: ?>
    <p class="no-data">
        <?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
    </p><!-- .no-data -->
<?php endif; ?>