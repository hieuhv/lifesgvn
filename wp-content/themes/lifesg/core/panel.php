<?php
//Panel Action
function update_member_info_process_hook() {
	global $current_user;
	/* If profile was saved, update profile. */
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
		if ( !wp_verify_nonce($_POST['add-nonce'],'update-user') ) {
			wp_die('Sorry! That was secure, guess you\'re cheatin huh!');
		} else {
			/* Update user information. */
			if ( !empty( $_POST['firstname'] ) )
				update_user_meta( $current_user->ID, 'first_name', $_POST['firstname'] );
			if ( !empty( $_POST['lastname'] ) )
				update_user_meta($current_user->ID, 'last_name', $_POST['lastname'] );
				//echo $_POST['lastname']; die();
			if ( !empty( $_POST['RelationshipStatus'] ) )
				update_user_meta($current_user->ID, 'RelationshipStatus', $_POST['RelationshipStatus'] );
			if ( !empty( $_POST['PublishedTypeStatus'] ) )
				update_user_meta( $current_user->ID, 'PublishedTypeStatus', $_POST['PublishedTypeStatus']);
			if ( !empty( $_POST['DateOfBirthDay'] ) )
				update_user_meta( $current_user->ID, 'DateOfBirthDay', $_POST['DateOfBirthDay'] );
			if ( !empty( $_POST['DateOfBirthMonth'] ) )
				update_user_meta( $current_user->ID, 'DateOfBirthMonth', $_POST['DateOfBirthMonth'] );
			if ( !empty( $_POST['DateOfBirthYear'] ) )
				update_user_meta( $current_user->ID, 'DateOfBirthYear', $_POST['DateOfBirthYear'] );
			if ( !empty( $_POST['PublishedTypeOld'] ) )
				update_user_meta( $current_user->ID, 'PublishedTypeOld', $_POST['PublishedTypeOld'] );
			if ( !empty( $_POST['Gender'] ) )
				update_user_meta( $current_user->ID, 'Gender', $_POST['Gender'] );
			if ( !empty( $_POST['PublishedTypeGender'] ) )
				update_user_meta( $current_user->ID, 'PublishedTypeGender', $_POST['PublishedTypeGender'] );
			/* Redirect so the page will show updated info.*/
		  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
			if ( count($error) == 0 ) {
				//action hook for plugins and extra fields saving
				do_action('edit_user_profile_update', $current_user->ID);
				wp_redirect(get_permalink());
			}
		}
	}
}
add_action('process_update_member_info_form', 'update_member_info_process_hook');

function update_beauty_info_process_hook() {
	global $current_user;
	/* If profile was saved, update profile. */
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-beauty' ) {
		if ( !wp_verify_nonce($_POST['add-nonce'],'update-beauty') ) {
			wp_die('Sorry! That was secure, guess you\'re cheatin huh!');
		} else {
			/* Update user information. */
			if ( !empty( $_POST['skinTypes'] ) )
				update_user_meta( $current_user->ID, 'skinTypes', json_encode($_POST['skinTypes']) );
			if ( !empty( $_POST['skinColors'] ) )
				update_user_meta($current_user->ID, 'skinColors', $_POST['skinColors'] );
				//echo $_POST['lastname']; die();
			if ( !empty( $_POST['eyeColors'] ) )
				update_user_meta($current_user->ID, 'eyeColors', $_POST['eyeColors'] );
			if ( !empty( $_POST['hairTypes'] ) )
				update_user_meta( $current_user->ID, 'hairTypes', json_encode($_POST['hairTypes']));
			if ( !empty( $_POST['scalpTypes'] ) )
				update_user_meta( $current_user->ID, 'scalpTypes', json_encode($_POST['scalpTypes']) );
			if ( !empty( $_POST['bodyTypes'] ) )
				update_user_meta( $current_user->ID, 'bodyTypes', json_encode($_POST['bodyTypes'] ));
			/* Redirect so the page will show updated info.*/
		  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
			if ( count($error) == 0 ) {
				//action hook for plugins and extra fields saving
				do_action('edit_user_profile_update', $current_user->ID);
				wp_redirect(get_permalink());
			}
		}
	}
}
add_action('process_update_beauty_info_form', 'update_beauty_info_process_hook');

function add_new_post_process_hook() {
	global $current_user;
	$error = array();
	/* If profile was saved, update profile. */
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'new-post' ) {
		if ( !wp_verify_nonce($_POST['add-nonce'],'new-post') ) {
			wp_die('Sorry! That was secure, guess you\'re cheatin huh!');
		} else {
			if ( empty( $_POST['post_title'] ) )
				$error[] = '* Nhập tiêu đề bài viết';
			if ( empty( $_POST['post_content'] ) )
				$error[] = '* Nhập nội dung bài viết';
			
			if ( count($error) == 0 ) {
				$new_post = array(
				  'post_title'    => wp_strip_all_tags( $_POST['post_title'] ),
				  'post_excerpt'    => $_POST['post_excerpt'],
				  'post_content'  => $_POST['post_content'],
				  'post_status'   => 'pending',
				  'post_author'   => $current_user->ID,
				  'post_type'     => 'cosmetic'
				);
				$post_id = wp_insert_post( $new_post );
				
				//Set Post Category
				$cat_ids = array_map( 'intval', array($_POST['post_category']) );
				$cat_ids = array_unique( array($_POST['post_category']) );
				wp_set_post_terms( $post_id, $cat_ids, 'cosmetic_type', true );
				
				//Set Post Tags
				wp_set_object_terms( $post_id, $_POST['tag_cloud'], 'cosmetic_tag', true );
				
				//Set Post Meta
				update_field( 'classify', $_POST['classify'] , $post_id );
				update_field( 'skin_type', $_POST['skin_type'] , $post_id );
				update_field( 'purpose', $_POST['purpose'] , $post_id );
				
				//Set Post Thumbnail
				$filename = $_POST['post_thumb'];
				
				// Check the type of file. We'll use this as the 'post_mime_type'.
				$filetype = wp_check_filetype( basename( $filename ), null );

				// Get the path to the upload directory.
				$wp_upload_dir = wp_upload_dir();

				// Prepare an array of post data for the attachment.
				$attachment = array(
					'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
					'post_mime_type' => $filetype['type'],
					'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
					'post_content'   => '',
					'post_status'    => 'inherit'
				);
				
				$attach_id = get_attachment_id( $filename );
				
				// if attachment exists, reuse and update data
				if ( $attach_id == 0 ) {
					// Insert the attachment.
					$attach_id = wp_insert_attachment( $attachment, $filename, $post_id );

					// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
					require_once( ABSPATH . 'wp-admin/includes/image.php' );

					// Generate the metadata for the attachment, and update the database record.
					$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
					wp_update_attachment_metadata( $attach_id, $attach_data );
				}
				
				set_post_thumbnail( $post_id, $attach_id );
				
				$activity = 'Bạn vừa đăng bài viết <strong>'.wp_strip_all_tags( $_POST['post_title'] ).'</strong> - Bài viết của bạn đang được chờ xét duyệt!';
				LogUserActivity($activity, $current_user->ID,'activity');
				wp_redirect( home_url().'/tai-khoan/danh-sach-bai-viet/',301 );
				
			}
		}
	}
}
add_action('process_add_new_post_form', 'add_new_post_process_hook');

function update_post_process_hook() {
	global $current_user;
	global $wpdb;
	$error = array();
	/* If profile was saved, update profile. */
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-post' ) {
		if ( !wp_verify_nonce($_POST['add-nonce'],'update-post') ) {
			wp_die('Sorry! That was secure, guess you\'re cheatin huh!');
		} else {
			$post_id = $_POST['post_id'];
			if ( empty( $_POST['post_title'] ) )
				$error[] = '* Nhập tiêu đề bài viết';
			if ( empty( $_POST['post_content'] ) )
				$error[] = '* Nhập nội dung bài viết';
			
			if ( count($error) == 0 ) {
				$wpdb->update( 
					'wp_posts', 
					array( 
						'post_title'    => wp_strip_all_tags( $_POST['post_title'] ),
						'post_excerpt'    => $_POST['post_excerpt'],
						'post_content'  => stripslashes($_POST['post_content']),
					), 
					array( 'ID' => $post_id )
				);
				//Set Post Category
				$cat_ids = array_map( 'intval', array($_POST['post_category']) );
				$cat_ids = array_unique( array($_POST['post_category']) );
				wp_set_post_terms( $post_id, $cat_ids, 'cosmetic_type', true );
				
				//Set Post Tags
				wp_set_object_terms( $post_id, $_POST['tag_cloud'], 'cosmetic_tag', true );
				
				//Set Post Meta
				update_field( 'classify', $_POST['classify'] , $post_id );
				update_field( 'skin_type', $_POST['skin_type'] , $post_id );
				update_field( 'purpose', $_POST['purpose'] , $post_id );
				
				//Set Post Thumbnail
				$filename = $_POST['post_thumb'];
				
				// Check the type of file. We'll use this as the 'post_mime_type'.
				$filetype = wp_check_filetype( basename( $filename ), null );

				// Get the path to the upload directory.
				$wp_upload_dir = wp_upload_dir();

				// Prepare an array of post data for the attachment.
				$attachment = array(
					'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
					'post_mime_type' => $filetype['type'],
					'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
					'post_content'   => '',
					'post_status'    => 'inherit'
				);
				
				$attach_id = get_attachment_id( $filename );
				
				// if attachment exists, reuse and update data
				if ( $attach_id == 0 ) {
					// Insert the attachment.
					$attach_id = wp_insert_attachment( $attachment, $filename, $post_id );

					// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
					require_once( ABSPATH . 'wp-admin/includes/image.php' );

					// Generate the metadata for the attachment, and update the database record.
					$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
					wp_update_attachment_metadata( $attach_id, $attach_data );
				}
				
				set_post_thumbnail( $post_id, $attach_id );
				wp_redirect( home_url().'/tai-khoan/danh-sach-bai-viet/',301 );
			}
		}
	}
}
add_action('process_update_post_form', 'update_post_process_hook');

function get_attachment_id( $url ) {
	$attachment_id = 0;
	$dir = wp_upload_dir();
	if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
		$file = basename( $url );
		$query_args = array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'fields'      => 'ids',
			'meta_query'  => array(
				array(
					'value'   => $file,
					'compare' => 'LIKE',
					'key'     => '_wp_attachment_metadata',
				),
			)
		);
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) {
			foreach ( $query->posts as $post_id ) {
				$meta = wp_get_attachment_metadata( $post_id );
				$original_file       = basename( $meta['file'] );
				$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
				if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
					$attachment_id = $post_id;
					break;
				}
			}
		}
	}
	return $attachment_id;
}
?>