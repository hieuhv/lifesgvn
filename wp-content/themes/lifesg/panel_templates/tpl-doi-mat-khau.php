<?php
/* Get user info. */
	global $current_user, $wp_roles;
	//get_currentuserinfo(); //deprecated since 3.1

	/* Load the registration file. */
	//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
	$error = array();    
	/* If profile was saved, update profile. */
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
		/* Update user password. */
		if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
			if ( $_POST['pass1'] == $_POST['pass2'] ) {
				wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
				$error[] = __('Cập nhật mật khẩu thành công.', 'profile');
			} else {
				$error[] = __('Mật khẩu nhập lại không đúng. Vui lòng thử lại.', 'profile');
			}
		} else {
			$error[] = __('Mật khẩu không được bỏ trống.', 'profile');
		}
		/* Redirect so the page will show updated info.*/
	  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
		if ( count($error) == 0 ) {
			//action hook for plugins and extra fields saving
			do_action('edit_user_profile_update', $current_user->ID);
			wp_redirect( get_permalink() );
			exit;
		}
	}
?>
<?php if ( count($error) > 0 ) echo '<p class="error" style="color:red;font-weight:bold;">* ' . implode("<br />", $error) . '</p>'; ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>">
		<div class="entry-content entry">
			<h2><?php the_title(); ?></h2>
				<form method="post" id="adduser" action="<?php the_permalink(); ?>">
					<p class="form-password">
                        <label for="pass1"><?php _e('Mật khẩu *', 'profile'); ?> </label>
                        <input class="text-input" name="pass1" type="password" id="pass1" />
                    </p><!-- .form-password -->
                    <p class="form-password">
                        <label for="pass2"><?php _e('Nhập lại mật khẩu *', 'profile'); ?></label>
                        <input class="text-input" name="pass2" type="password" id="pass2" />
                    </p><!-- .form-password -->
					<p class="form-submit">
						<?php echo $referer; ?>
						<input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Cập nhật', 'profile'); ?>" />
						<?php wp_nonce_field( 'update-user' ) ?>
						<input name="action" type="hidden" id="action" value="update-user" />
					</p><!-- .form-submit -->
				</form><!-- #adduser -->
		</div><!-- .entry-content -->
	</div><!-- .hentry .post -->
    <?php endwhile; ?>
<?php else: ?>
    <p class="no-data">
        <?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
    </p><!-- .no-data -->
<?php endif; ?>