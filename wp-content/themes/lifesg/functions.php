<?php
ob_clean();
ob_start();
/**
	@ Thiết lập các hằng dữ liệu quan trọng
	@ THEME_URL = get_stylesheet_directory()
	@ CORE = directory /core of theme
	**/
	define( 'THEME_URL', get_stylesheet_directory() );
	define( 'CORE_THEME', THEME_URL . '/core' );
	if ( ! isset( $content_width ) ) $content_width = 750;
	
	/**
	@ Setup functions support theme
	**/
	/**
	 * Menu supports
	 */
	if ( ! function_exists( 'lifesg_theme_setup' ) ) {
		function lifesg_theme_setup() {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'title-tag' );
			add_image_size( 'whatshot-img', 250, 200, true );
			add_image_size( 'like-img', 100, 100, true );
			
			/* Theme Primary Menu */
			register_nav_menu ( 'primary-menu', __('Primary Menu', 'lifesg') );
			register_nav_menu ( 'footer-menu', __('Footer Menu', 'lifesg') );
			register_nav_menu ( 'mobile-menu', __('Mobile Menu', 'lifesg') );
			
			/*
			* Create Sidebar
			*/
			$sidebar = array(
			   'name' => __('Main Sidebar', 'lifesg'),
			   'id' => 'main-sidebar',
			   'description' => 'Main sidebar for Lifesg theme',
			   'class' => 'main-sidebar',
			   'before_title' => '<h3 class="widgettitle">',
			   'after_title' => '</h3>'
			);
			register_sidebar( $sidebar );
			
			$home_left_block = array(
			   'name' => __('Home Left Block', 'lifesg'),
			   'id' => 'home_left',
			   'description' => 'Home block for lifesg theme',
			   'class' => 'home_left',
			   'before_widget' => '<div class="tg-category-posts tg-margin-bottom">',
			   'after_widget'  => '</div>',
			   'before_title' => '<div class="tg-section-heading"><h2>',
			   'after_title' => '</h2></div>'
			);
			register_sidebar( $home_left_block );
			
			$home_right_block = array(
			   'name' => __('Home Right Block', 'lifesg'),
			   'id' => 'home_right',
			   'description' => 'Home block for lifesg theme',
			   'class' => 'home_right',
			   'before_widget' => '<div class="tg-category-posts tg-margin-bottom">',
			   'after_widget'  => '</div>',
			   'before_title' => '<div class="tg-section-heading"><h2>',
			   'after_title' => '</h2></div>'
			);
			register_sidebar( $home_right_block );
			
			
			$footer_1 = array(
			   'name' => __('Footer 1', 'lifesg'),
			   'id' => 'footer_1',
			   'description' => 'Footer for lifesg theme',
			   'class' => 'footer_column',
			   'before_widget' => '<div class="tg-col tg-about-us">',
			   'after_widget'  => '</div>',
			   'before_title' => '<div class="tg-section-heading"><h2>',
			   'after_title' => '</h2></div>'
			);
			register_sidebar( $footer_1 );
			
			$footer_2 = array(
			   'name' => __('Footer 2', 'lifesg'),
			   'id' => 'footer_2',
			   'description' => 'Footer for lifesg theme',
			   'class' => 'footer_column',
			   'before_widget' => '<div class="tg-col tg-about-us">',
			   'after_widget'  => '</div>',
			   'before_title' => '<div class="tg-section-heading"><h2>',
			   'after_title' => '</h2></div>'
			);
			register_sidebar( $footer_2 );
			
			$footer_3 = array(
			   'name' => __('Footer 3', 'lifesg'),
			   'id' => 'footer_3',
			   'description' => 'Footer for lifesg theme',
			   'class' => 'footer_column',
			   'before_widget' => '<div class="tg-col tg-about-us">',
			   'after_widget'  => '</div>',
			   'before_title' => '<div class="tg-section-heading"><h2>',
			   'after_title' => '</h2></div>'
			);
			
			register_sidebar( $footer_3 );
		}
		add_action ( 'init', 'lifesg_theme_setup' );
	}
	
	function dev_register_custom_post_type($post_type_key, $options = []){
		/*
		* Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
		*/
		$label = array(
			'name' => $options['name'], //Tên post type dạng số nhiều
			'singular_name' => $options['name'] //Tên post type dạng số ít
		);

		/*
		 * Biến $args là những tham số quan trọng trong Post Type
		 */
		$args = array(
			'labels' => $label, //Gọi các label trong biến $label ở trên
			'description' => $options['description'], //Mô tả của post type
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'author',
				'thumbnail',
				'comments',
				'trackbacks',
				'revisions',
				'custom-fields'
			), //Các tính năng được hỗ trợ trong post type
			'taxonomies' => array('cosmetic_type'), //Các taxonomy được phép sử dụng để phân loại nội dung
			'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
			'public' => true, //Kích hoạt post type
			'show_ui' => true, //Hiển thị khung quản trị như Post/Page
			'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
			'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
			'menu_icon' => $options['icon'], //Đường dẫn tới icon sẽ hiển thị
			'can_export' => true, //Có thể export nội dung bằng Tools -> Export
			'has_archive' => true, //Cho phép lưu trữ (month, date, year)
			'exclude_from_search' => true, //Loại bỏ khỏi kết quả tìm kiếm
			'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
			'capability_type' => 'post', //
			'rewrite' => array('slug' => $options['slug'])
		);

		register_post_type($post_type_key, $args);
	}
	
	function lifesg_register_post_type(){
		dev_register_custom_post_type('cosmetic',[
			'name'=>'Review Mỹ phẩm',
			'description' => 'Bài viết Review Mỹ phẩm',
			'icon'=>'dashicons-carrot',
			'slug'=>'my-pham'
		]);
	}

	add_action('init', 'lifesg_register_post_type');
	
	add_action('init' , 'register_services_taxonomies' );

	function register_services_taxonomies() {
	  register_taxonomy('cosmetic_type',array('cosmetic'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'show_in_nav_menus' => true,
		 'rewrite' => array('slug' => 'danh-muc', 'with_front' => true),
	  ));
		flush_rewrite_rules();
		$labels = array(
			'name' => _x( 'Tags', 'taxonomy general name' ),
			'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Tags' ),
			'popular_items' => __( 'Popular Tags' ),
			'all_items' => __( 'All Tags' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Tag' ), 
			'update_item' => __( 'Update Tag' ),
			'add_new_item' => __( 'Add New Tag' ),
			'new_item_name' => __( 'New Tag Name' ),
			'separate_items_with_commas' => __( 'Separate tags with commas' ),
			'add_or_remove_items' => __( 'Add or remove tags' ),
			'choose_from_most_used' => __( 'Choose from the most used tags' ),
			'menu_name' => __( 'Cosmetic Tags' ),
		  ); 

		  register_taxonomy('cosmetic_tag','cosmetic',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'cosmetic_tag' ),
		  ));
	}

	/**
	@ Function display menu
	@ lifesg_menu( $slug )
	**/
	if ( ! function_exists( 'lifesg_menu' ) ) {
	  function lifesg_menu( $slug ) {
		$class = ($slug=='footer-menu')?'class="tg-footer-nav pull-right"':'';
		$item = ($slug=='primary-menu')?login_menu():'';
		$menu = array(
		  'container' => false,
		  'theme_location' => $slug,
		  'items_wrap' => '<ul '.$class.'>%3$s'.$item.'</ul>',
		  'walker'         => new LifeSG_Sublevel_Walker
		);
		wp_nav_menu( $menu );
	  }
	}
	
	class LifeSG_Sublevel_Walker extends Walker_Nav_Menu {
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class='tg-megamenu'><li><ul>\n";
		}
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul></li></ul>\n";
		}
	}
	
	function login_menu(){
		$html = '';
		$html .= '<li class="login tg-hasdropdown">';
		if ( is_user_logged_in() ) {
			global $wp;
			$current_url = home_url(add_query_arg(array(),$wp->request));
			$current_user = wp_get_current_user();
			if(!empty($current_user->user_firstname) || !empty($current_user->user_lastname)){
				$hello_user = $current_user->user_firstname.' '.$current_user->user_lastname;
			} else {
				$hello_user = $current_user->user_email;
			}
			$html .= '<a href="'.home_url().'/thanh-vien/tai-khoan/">'.ucfirst($hello_user).' <i class="fa fa-angle-down" aria-hidden="true"></i></a>';
			$html .= '<ul class="tg-dropdownmenu menulogin">
				<li><a href="'.home_url().'/thanh-vien/thong-bao-cua-toi/"><i class="fa fa-bell-o" aria-hidden="true"></i> Thông báo</a></li>
				<li><a href="'.home_url().'/thanh-vien/nhat-ky-hoat-dong/"><i class="fa fa-history fa-lg" aria-hidden="true"></i> Nhật ký</a></li>
				<li><a href="'.home_url().'/thanh-vien/dang-bai-moi/"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i> Đăng bài mới</a></li>
				<li><a href="#"><i class="fa fa-key fa-lg" aria-hidden="true"></i> Mật khẩu</a></li>
				<li><a href="'.urldecode(wp_logout_url($current_url)).'" onclick="return signOut();"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i> Đăng xuất</a></li>
			</ul>';
		} else {
			$html .= '<a href="'.home_url().'/dang-nhap/">Đăng nhập</a>';
		}
		$html .= '</li>';
		return $html;
	}
	
	/*function change_submenu_class($menu) {
	  $menu = preg_replace('/ class="sub-menu"/','/ class="tg-megamenu" /',$menu);  
	  return $menu;  
	}  
	add_filter('wp_nav_menu','change_submenu_class');*/
	
	function add_menu_parent_class( $items ) {
		$parents = array();
		foreach ( $items as $item ) {
			//Check if the item is a parent item
			if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
				$parents[] = $item->menu_item_parent;
			}
		}

		foreach ( $items as $item ) {
			if ( in_array( $item->ID, $parents ) && $item->ID==7) {
				//Add "menu-parent-item" class to parents
				$item->classes[] = 'tg-megadropdown';
			}
		}

		return $items;
	}

	//add_menu_parent_class to menu
	add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
	
	function page_nav() {
  
		if( is_singular() )
		return;
		global $wp_query;
		/** Stop execution if there's only 1 page */
		if( $wp_query->max_num_pages <= 1 ) return; $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1; $max = intval( $wp_query->max_num_pages );
		/** Add current page to the array */
		if ( $paged >= 1 )
			$links[] = $paged;
		/** Add the pages around the current page to the array */
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		echo '
		<div class="tg-pagination">
		<ul>' . "\n";
		/** Previous Post Link */
		if ( get_previous_posts_link() )
		printf( '
		<li class="tg-prevpage">%s</li>', get_previous_posts_link('<span class="fa fa-angle-left"></span>') );
		/** Link to first page, plus ellipses if necessary */
		if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>

		' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
		  echo '
		<li>…</li>

		';
		}

		/** Link to current page, plus 2 pages in either direction if necessary */
		sort( $links );
		foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>

		' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}

		/** Link to last page, plus ellipses if necessary */
		if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
		  echo '
		<li>…</li>

		' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>

		' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		}

		/** Next Post Link */
		if ( get_next_posts_link() )
		printf( '
		<li class="tg-nextpage">%s</li>

		' . "\n", get_next_posts_link('<span class="fa fa-angle-right"></span>') );

		echo '</ul>
		</div>

		' . "\n";
	  
	}
	
	function get_all_post_term($term_id,$post_type, $taxonomy_name = '', $not_in = false,$meta_query = array()) {
		$tax_query = array(
							'taxonomy' => $taxonomy_name,
							'field' => 'term_id',
							'terms' => $term_id
						);
		if($not_in==true){
			$termchildren = (array)get_term_children( $term_id, $taxonomy_name );
			$tax_query_not_in = array(
							'taxonomy' => $taxonomy_name,
							'field' => 'term_id',
							'terms' => array_merge($termchildren),
							'operator' => 'NOT IN',
						);
		} else {
			$tax_query_not_in = '';
		}
		$args_services = array( 
						'order' => 'DESC',
						'offset'=> 0,
						'post_type' => $post_type,
						'post_status' => 'publish',
						'posts_per_page'   => 10,
						'tax_query' => array($tax_query,$tax_query_not_in),
						'meta_query' => $meta_query
					);
		$query = new WP_Query( $args_services );
		//var_dump($query->request);
		return $query->posts;
	}
	
	function sb_fb_login_callback() {
		$fb_user = json_decode(stripslashes($_POST['user']), true );
		
		$wp_users = get_users(array(
            'meta_key'     => 'lifesg_facebook_id',
            'meta_value'   => $fb_user['id'],
            'number'       => 1,
            'count_total'  => false,
            'fields'       => 'id',
        ));
		
        if(empty($wp_users[0])) { //Register User
            $new_user = wp_create_user($fb_user['email'], wp_generate_password(), $fb_user['email']);
			if(is_wp_error($new_user)) {
				die();
			}
			// Setting the meta
			$user_id_role = new WP_User($new_user);
			$user_id_role->set_role('lifesg_member');
			$user_id_role->add_cap('upload_files');
			$user_id_role->add_cap('edit_others_pages');
			$user_id_role->add_cap('edit_published_pages');
			update_user_meta( $new_user, 'lifesg_member', 1 );
			update_user_meta( $new_user, 'first_name', $fb_user['first_name'] );
			update_user_meta( $new_user, 'last_name', $fb_user['last_name'] );
			wp_update_user( array('ID' => $new_user, 'display_name' => $fb_user['first_name'].' '.$fb_user['last_name']) );
			update_user_meta( $new_user, 'lifesg_facebook_id', $fb_user['id'] );
			$avatar = 'https://graph.facebook.com/'.$fb_user['id'].'/picture/';
			update_user_meta( $new_user, 'avatar', $avatar );
			$activity = 'Chúc mừng bạn đã trở thành thành viên chính thức của LifeSG.vn ^^!';
			LogUserActivity($activity,$new_user ,'notification');
        } else {
			$new_user = $wp_users[0];
		}
        // Log the user ?
        wp_set_auth_cookie($new_user);
		echo 'Successfuly';
		die();
	}
	add_action('wp_ajax_sb_fb_login', 'sb_fb_login_callback');
	add_action('wp_ajax_nopriv_sb_fb_login', 'sb_fb_login_callback');
	
	function sb_gg_login_callback() {
		$google_id = $_POST['gg_id'];
		$avatar = $_POST['avatar'];
		$email = $_POST['email'];
		$display_name = $_POST['display_name'];
		$arrName = explode(" ",$display_name);
		$first_name = (is_array($arrName) && sizeof($arrName)>1)?$arrName[0]:$display_name;
		$last_name = (is_array($arrName) && sizeof($arrName)>1)?$arrName[1]:$display_name;
		$wp_users = get_users(array(
            'meta_key'     => 'lifesg_google_id',
            'meta_value'   => $google_id,
            'number'       => 1,
            'count_total'  => false,
            'fields'       => 'id',
        ));
		
        if(empty($wp_users[0])) { //Register User
            $new_user = wp_create_user($email, wp_generate_password(), $email);
			if(is_wp_error($new_user)) {
				die();
			}
			// Setting the meta
			$user_id_role = new WP_User($new_user);
			$user_id_role->set_role('lifesg_member');
			$user_id_role->add_cap('upload_files');
			$user_id_role->add_cap('edit_others_pages');
			$user_id_role->add_cap('edit_published_pages');
			update_user_meta( $new_user, 'lifesg_member', 1 );
			update_user_meta( $new_user, 'first_name', $first_name );
			update_user_meta( $new_user, 'last_name', $last_name );
			wp_update_user( array('ID' => $new_user, 'display_name' => $display_name) );
			update_user_meta( $new_user, 'lifesg_google_id', $google_id );
			update_user_meta( $new_user, 'avatar', $avatar );
			$activity = 'Chúc mừng bạn đã trở thành thành viên chính thức của LifeSG.vn ^^!';
			LogUserActivity($activity,$new_user ,'notification');
        } else {
			$new_user = $wp_users[0];
		}
        // Log the user ?
        wp_set_auth_cookie($new_user);
		echo 'Successfuly';
		die();
	}
	add_action('wp_ajax_sb_gg_login', 'sb_gg_login_callback');
	add_action('wp_ajax_nopriv_sb_gg_login', 'sb_gg_login_callback');
	
	// Action Login
	function login_process_hook() {
		/* If profile was saved, update profile. */
		ob_start();
		$error = array();
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'login-lifesg' ) {
			if ( !wp_verify_nonce($_POST['add-nonce'],'login-lifesg') ) {
				wp_die('Sorry! That was secure, guess you\'re cheatin huh!');
			} else {
				/* Update user information. */
				if ( empty( $_POST['login']['user_login'] ) )
					$error[] = 'Vui lòng điền email!';
				if ( empty( $_POST['login']['user_password'] ) )
					$error[] = 'Vui lòng điền mật khẩu!';
				if ( count($error) == 0 ) {
					$user = wp_signon( $_POST['login'], false );
					if ( is_wp_error( $user ) ) {
						echo $user->get_error_message();
					} else {
						wp_redirect(home_url());
						exit();
					}
				}
			}
		}
	}
	add_action('process_login_form', 'login_process_hook');
	
	// Action Organic Register
	function register_process_hook() {
		/* If profile was saved, update profile. */
		$error = array();
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'register-lifesg' ) {
			if ( !wp_verify_nonce($_POST['add-nonce'],'register-lifesg') ) {
				wp_die('Sorry! That was secure, guess you\'re cheatin huh!');
			} else {
				/* Update user information. */
				if ( empty( $_POST['res']['email'] ) )
					$error[] = 'Vui lòng nhập email!';
				if ( empty( $_POST['res']['password'] ) )
					$error[] = 'Vui lòng nhập mật khẩu!';
				if ( empty( $_POST['res']['re_password'] ) )
					$error[] = 'Vui lòng nhập lại mật khẩu!';
				if(email_exists($_POST['res']['email']))
					$error[] = 'Email đã tồn tại trong hệ thống!';
				if($_POST['res']['password'] != $_POST['res']['re_password'])
					$error[] = 'Mật khẩu nhập lại không đúng.';
				echo '<p class="errors">'.implode(", <br/>",$error).'</p>';
				if ( count($error) == 0 ) {
					$new_user = wp_create_user($_POST['res']['email'], $_POST['res']['password'], $_POST['res']['email']);
					// Setting the meta
					$user_id_role = new WP_User($new_user);
					$user_id_role->set_role('lifesg_member');
					$user_id_role->add_cap('upload_files');
					$user_id_role->add_cap('edit_others_pages');
					$user_id_role->add_cap('edit_published_pages');
					update_user_meta( $new_user, 'lifesg_member', 1 );
					update_user_meta( $new_user, 'first_name', $first_name );
					update_user_meta( $new_user, 'last_name', $last_name );
					wp_update_user( array('ID' => $new_user, 'display_name' => $display_name) );
					update_user_meta( $new_user, 'avatar', 'http://gravatar.com/avatar/412c0b0ec99008245d902e6ed0b264ee' );
					wp_set_auth_cookie($new_user);
					$activity = 'Chúc mừng bạn đã trở thành thành viên chính thức của LifeSG.vn ^^!';
					LogUserActivity($activity,$new_user ,'notification');
					wp_redirect(home_url('thanh-vien/tai-khoan'));
				}
			}
		}
	}
	add_action('process_register_form', 'register_process_hook');
	
	//Hàm này chỉ show attachments của chính user đó
	add_filter( 'ajax_query_attachments_args', 'show_current_user_attachments' );
	function show_current_user_attachments( $query ) {
		$user_id = get_current_user_id();
		if ( $user_id ) {
			$query['author'] = $user_id;
		}
		return $query;
	}
	/**
	@ Insert CSS and Javascript into the theme
	@ Use the wp_enqueue_scripts() hook to display it outside the front-end
	**/
	function lifesg_styles() {
		wp_register_style( 'main-style', get_template_directory_uri() . '/style.css', 'all' );
		wp_enqueue_style( 'main-style' );
		wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', 'all' );
		wp_enqueue_style( 'bootstrap-css' );
		wp_register_style( 'normalize-css', get_template_directory_uri() . '/css/normalize.css', 'all' );
		wp_enqueue_style( 'normalize-css' );
		wp_register_style( 'awesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', 'all' );
		wp_enqueue_style( 'awesome-css' );
		wp_register_style( 'transitions-css', get_template_directory_uri() . '/css/transitions.css', 'all' );
		wp_enqueue_style( 'transitions-css' );
		wp_register_style( 'weather-css', get_template_directory_uri() . '/css/simpleWeather.css', 'all' );
		wp_enqueue_style( 'weather-css' );
		wp_register_style( 'carousel-css', get_template_directory_uri() . '/css/owl.carousel.css', 'all' );
		wp_enqueue_style( 'carousel-css' );
		wp_register_style( 'flexslider-css', get_template_directory_uri() . '/css/flexslider.css', 'all' );
		wp_enqueue_style( 'flexslider-css' );
		wp_register_style( 'owl-css', get_template_directory_uri() . '/css/owl.theme.css', 'all' );
		wp_enqueue_style( 'owl-css' );
		wp_register_style( 'metro-css', get_template_directory_uri() . '/css/MetroJs.css', 'all' );
		wp_enqueue_style( 'metro-css' );
		wp_register_style( 'swiper-css', get_template_directory_uri() . '/css/swiper.css', 'all' );
		wp_enqueue_style( 'swiper-css' );
		wp_register_style( 'main-css', get_template_directory_uri() . '/css/main.css', 'all' );
		wp_enqueue_style( 'main-css' );
		wp_register_style( 'color-css', get_template_directory_uri() . '/css/color.css', 'all' );
		wp_enqueue_style( 'color-css' );
		wp_register_style( 'responsive-css', get_template_directory_uri() . '/css/responsive.css', 'all' );
		wp_enqueue_style( 'responsive-css' );
		wp_register_style( 'tags-css', get_template_directory_uri() . '/css/jquery.tag-editor.css', 'all' );
		wp_enqueue_style( 'tags-css' );
		wp_enqueue_script( 'modernizr-js', get_template_directory_uri() . '/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js');
	}
	add_action( 'wp_enqueue_scripts', 'lifesg_styles' );
	
	/**
	@ Insert CSS and Javascript into the footer theme
	@ Use the wp_footer() hook to display it outside the footer
	**/
	function add_this_script_footer(){
		wp_enqueue_script( 'jquery-library-js', get_template_directory_uri() . '/js/vendor/jquery-library.js');
		wp_enqueue_script( 'tags-js', get_template_directory_uri() . '/js/jquery.tag-editor.js');
		wp_enqueue_script( 'caret-js', get_template_directory_uri() . '/js/jquery.caret.min.js');
		wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/vendor/bootstrap.min.js');
		wp_enqueue_script( 'cycle2-js', get_template_directory_uri() . '/js/jquery.cycle2.min.js');
		wp_enqueue_script( 'cycle2-carousel-js', get_template_directory_uri() . '/js/jquery.cycle2.carousel.min.js');;
		wp_enqueue_script( 'owl-js', get_template_directory_uri() . '/js/owl.carousel.js');
		wp_enqueue_script( 'isotope-js', get_template_directory_uri() . '/js/isotope.pkgd.js');
		wp_enqueue_script( 'masony-js', get_template_directory_uri() . '/js/masonry.pkgd.min.js');
		wp_enqueue_script( 'flexslider-js', get_template_directory_uri() . '/js/flexslider.js');
		wp_enqueue_script( 'parallax-js', get_template_directory_uri() . '/js/parallax.js');
		wp_enqueue_script( 'metro-js', get_template_directory_uri() . '/js/MetroJs.js');
		wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '/js/swiper.js');
		wp_enqueue_script( 'fb-js', get_template_directory_uri() . '/js/jquery.fblogin.min.js');
		wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js');
		echo '<script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>';
	} 
	add_action('wp_footer', 'add_this_script_footer'); 
	
	add_action('wp_head', 'myplugin_ajaxurl');

	function myplugin_ajaxurl() {
	   echo '<script type="text/javascript">
			   var ajaxurl = "' . admin_url('admin-ajax.php') . '";
			   var homeurl = "' . home_url() . '";
			   
			 </script>';
		echo '<script type="text/javascript">
				function signOut() {
					var auth2 = gapi.auth2.getAuthInstance();
						auth2.signOut().then(function () {
						console.log("User signed out.");
					});
				}
			</script>';
	}
	
	add_action('after_setup_theme', 'remove_admin_bar');

	function remove_admin_bar() {
		if (!current_user_can('administrator') && !is_admin()) {
		  show_admin_bar(false);
		}
	}
	
	function get_posts_by_author($author_id, $post_status){                     
		$args = array(
		  'author'        =>  $author_id, 
		  'orderby'       =>  'post_date',
		  'order'         =>  'ASC',
		  'post_type'   => 'cosmetic',
		  'post_status' => $post_status,
		  'fields' => 'ids',
		  'posts_per_page' => -1 // no limit
		);
		$author_posts = get_posts( $args );;
		return $author_posts;
	}
	
	function set_global_variables() {
		global $skinTypes, $skinColors, $skinColors_bg, $eyeColors, $eyeColors_bg, $hairTypes, $scalpTypes, $bodyTypes;
		$skinTypes = array('Dầu', 'Hỗn Hợp', 'Khô', 'Mụn', 'Nhạy Cảm', 'Thường');
		$skinColors = array('Trắng Hồng', 'Sáng', 'Trung Bình', 'Ngăm');
		$skinColors_bg = array('255, 246, 237', '254, 236, 214', '223, 197, 166', '197, 171, 139');
		$eyeColors = array('Đen', 'Nâu');
		$eyeColors_bg = array('black_eye.png', 'brown_eye.png');
		$hairTypes = array('Mỏng', 'Dày', 'Thẳng', 'Xoăn', 'Nhuộm', 'Uốn', 'Duỗi');
		$scalpTypes = array('Thường', 'Dầu', 'Khô', 'Nhạy Cảm', 'Vấn Đề Khác');
		$bodyTypes = array('Thường', 'Khô', 'Nhạy Cảm', 'Vấn Đề Khác');
	}
	add_action( 'init', 'set_global_variables' );
	
	// function get post count views
	function getPostViews($postID){
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return 0;
		}
		return $count;
	}

	// function to count views.
	function setPostViews($postID) {
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
	
	
	function random_posts_func( $atts ) {
		$html = '';
		$args = array(
			'post_type' => 'post',
			'orderby'	=> 'rand',
			'posts_per_page' => 3, 
			);

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) {
			$html .= '<div class="tg-random-post">';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$html .= '<article class="tg-theme-post tg-category-small">
					<figure>
						<a href="'. get_permalink() .'"><img src="'.get_the_post_thumbnail_url().'" alt="image description" style="width:80px;height:80px;"></a>
					</figure>
					<div class="tg-postdata">
						<h3><a href="'. get_permalink() .'">'. get_the_title() .'</a></h3>
						<ul class="tg-postmetadata">
							<li>
								<a href="'. get_permalink() .'">
									<i class="fa fa-clock-o"></i>
									<span>'. get_the_date() .'</span>
								</a>
							</li>
						</ul>
					</div>
				</article>';
			}
			$html .= '</div>';
			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			$html .= 'no posts found';
		}

		return $html; 
	}
	add_shortcode( 'random_posts', 'random_posts_func' );
	add_filter('widget_text', 'do_shortcode');
	
	function get_posts_by_cc($term_id, $taxonomy_name = 'cosmetic_type') {
		$tax_query = array(
							'taxonomy' => $taxonomy_name,
							'field' => 'term_id',
							'terms' => $term_id
						);
		$args = array( 
						'order' => 'DESC',
						'offset'=> 0,
						'post_type' => 'cosmetic',
						'post_status' => 'publish',
						'numberposts'   => 6,
						'tax_query' => array($tax_query)
					);
		$posts = get_posts( $args );
		return $posts;
	}
	
	//Activity User Log
	function LogUserActivity($Activity, $UserID, $Type){
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$TimeRef = date('d-m-Y H:i:s');
		$LogFile = dirname(__FILE__).'/logs/'.$UserID.'-'.$Type.'.txt';
		$Data = $TimeRef.'|'.$Activity;	
		if (($file = fopen($LogFile,"a")) !== false) {
			fwrite($file, pack("CCC",0xef,0xbb,0xbf));
			fwrite($file, $Data."\n");
			fclose($file);
		}
	}

	function ReadUserActivity($LogFile){
		global $log;
		$LogFile = file_get_contents($LogFile);
		$ExplodedLogFile = explode("\n", $LogFile);
		$ArrayNum = count($ExplodedLogFile);
		for ($i = $ArrayNum - 2; $i >= 0 ; $i-- ){
			$log[$i] = explode("|", $ExplodedLogFile[$i]);
		}
	}
	
	function CountNotification($LogFile){
		$LogFile = file_get_contents($LogFile);
		$ExplodedLogFile = explode("\n", $LogFile);
		$ArrayNum = count($ExplodedLogFile) - 1;
		return $ArrayNum;
	}
	
	//Ajax Comment
	add_action('init', 'ajaxcomments_load_js');
	function ajaxcomments_load_js() {
		wp_enqueue_script('ajaxcomments', get_template_directory_uri() . "/js/ajaxcomments.js", array('jquery'));
	}

	function ajaxify_comments_jaya($comment_ID, $comment_status) {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		//If AJAX Request Then
		switch ($comment_status) {
			case '0':
				//wp_notify_moderator($comment_ID);
				$output = '';
				$commentdata = &get_comment($comment_ID, ARRAY_A);
				//print_r($commentdata);
				$permaurl = get_permalink( $post->ID );
				$url = str_replace('http://', '/', $permaurl);
				//Comment Logs
				$activity = 'Bạn vừa bình luận bài viết <strong>'.get_the_title($commentdata['comment_post_ID']).'</strong> - <a href="'.get_permalink($commentdata['comment_post_ID']).'#cmt'.$comment_ID.'">Xem chi tiết</a>';
				if($commentdata['comment_parent'] != 0){
					$output .= '<ul class="children">';
					$activity = 'Bạn vừa trả lời bình luận của <strong>'.$commentdata['comment_author'].'</strong> tại bài viết <strong>'.get_the_title($commentdata['comment_post_ID']).'</strong>  - <a href="'.get_permalink($commentdata['comment_post_ID']).'#cmt'.$comment_ID.'">Xem chi tiết</a>';
				}
				
				LogUserActivity($activity, $commentdata['user_id'], 'activity');
				
				$output .= '<div id="cmt'.$comment_ID.'" class="comment">
				  <!-- Comment Avatar -->
				  <div class="comment-avatar">
					<img src="'.get_user_meta($commentdata['user_id'],'avatar',true).'" />
				  </div>
				  <div class="comment-box">
					<div class="comment-pending">Đang chờ duyệt</div>
					<div class="comment-text">'.$commentdata['comment_content'].'</div>
					<div class="comment-footer">
					  <div class="comment-info">
						<span class="comment-author">
						  '.$commentdata['comment_author'].'
						</span>
						<span class="comment-date">'.get_comment_date( 'd/m/Y H:i:s', $commentdata['comment_ID']).'</span>
					  </div>

					  <div class="comment-actions">
						<a class="comment-reply-link"
			onclick="return replyComment('.$commentdata['comment_ID'].')">Trả lời</a>
					  </div>
					</div>
				  </div>
				</div>';
				if($commentdata['comment_parent'] != 0){
					$output .= '</ul>';
				}
			echo $output;
break;
case '1': //Approved comment
$commentdata = &get_comment($comment_ID, ARRAY_A);
//print_r( $commentdata);
$permaurl = get_permalink( $post->ID );
$url = str_replace('http://', '/', $permaurl);

if($commentdata['comment_parent'] == 0){
$output = '<li class="comment byuser comment-author-admin bypostauthor odd alt thread-odd thread-alt depth-1" id="comment-' . $commentdata['comment_ID'] . '">
<div id="div-comment-' . $commentdata['comment_ID'] . '" class="comment-body">
<div class="comment-author vcard">'.
get_avatar($commentdata['comment_author_email'])
.'<cite class="fn">' . $commentdata['comment_author'] . '</cite> <span class="says">says:</span>
</div>

<div class="comment-meta commentmetadata"><a href="http://localhost/WordPress_Code/?p=1#comment-'. $commentdata['comment_ID'] .'">' .
get_comment_date( 'F j, Y \a\t g:i a', $commentdata['comment_ID']) .'</a>&nbsp;&nbsp;';
if ( is_user_logged_in() ){
$output .= '<a class="comment-edit-link" href="'. home_url() .'/wp-admin/comment.php?action=editcomment&amp;c='. $commentdata['comment_ID'] .'">
(Edit)</a>';
}
$output .= '</div>
<p>' . $commentdata['comment_content'] . '</p>
<div class="reply">
<a class="comment-reply-link" onclick="return replyComment('.$commentdata['comment_ID'].')">Reply</a>
</div>
</div>
</li>' ;

echo $output;

}
else{

$output = '<ul class="children"> <li class="comment byuser comment-author-admin bypostauthor even depth-2" id="comment-' . $commentdata['comment_ID'] . '">
<div id="div-comment-' . $commentdata['comment_ID'] . '" class="comment-body">
<div class="comment-author vcard">'.
get_avatar($commentdata['comment_author_email'])
.'<cite class="fn">' . $commentdata['comment_author'] . '</cite> <span class="says">says:</span> </div>

<div class="comment-meta commentmetadata"><a href="http://localhost/WordPress_Code/?p=1#comment-'. $commentdata['comment_ID'] .'">' .
get_comment_date( 'F j, Y \a\t g:i a', $commentdata['comment_ID']) .'</a>&nbsp;&nbsp;';
if ( is_user_logged_in() ){
$output .= '<a class="comment-edit-link" href="'. home_url() .'/wp-admin/comment.php?action=editcomment&amp;c='. $commentdata['comment_ID'] .'">
(Edit)</a>';
}

$output .= '</div>
<p>' . $commentdata['comment_content'] . '</p>
<div class="reply">
<a class="comment-reply-link" href="'. $url .'&amp;replytocom='. $commentdata['comment_ID'] .'#respond"
onclick="return addComment.moveForm(&quot;div-comment-'. $commentdata['comment_ID'] .'&quot;, &quot;'. $commentdata['comment_ID'] . '&quot;, &quot;respond&quot;, &quot;1&quot;)">Reply</a>
</div>
</div>
</li></ul>' ;

echo $output;
}

$post = &get_post($commentdata['comment_post_ID']);
wp_notify_postauthor($comment_ID, $commentdata['comment_type']);
break;
default:
echo "error";
}
exit;
}
}

add_action('comment_post', 'ajaxify_comments_jaya', 25, 2);

function format_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$class = $cmt_pending = '';
	if(0 == $comment->comment_approved) {
		if($current_user->ID != $comment->user_id){
			$class = 'cmt_hidden';
			$cmt_pending = '<div class="comment-pending">Đang chờ duyệt</div>';
		}
	}
    ?>
	<div id="cmt<?php echo $comment->comment_ID;?>" class="comment <?php echo $class;?>">
      <!-- Comment Avatar -->
      <div class="comment-avatar">
        <img src="<?php echo get_user_meta($comment->user_id,'avatar',true); ?>"/>
      </div>

      <!-- Comment Box -->
      <div class="comment-box">
		<?php echo $cmt_pending;?>
        <div class="comment-text"><?php comment_text(); ?></div>
        <div class="comment-footer">
          <div class="comment-info">
            <span class="comment-author">
              <?php printf(__('%s'), get_comment_author_link()) ?>
            </span>
            <span class="comment-date"><?php comment_date(); ?> <?php comment_time(); ?></span>
          </div>

          <div class="comment-actions">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
          </div>
        </div>
      </div>
    </div>
	<?php	
}

//Thông báo khi comment được approve
add_action('transition_comment_status', 'my_approve_comment_callback', 10, 3);
function my_approve_comment_callback($new_status, $old_status, $comment) {
    if($old_status != $new_status) {
        if($new_status == 'approved') {
			$activity = 'Thảo luận của bạn tại bài viết <strong>'.get_the_title($comment->comment_post_ID).'</strong> đã được duyệt - <a href="'.get_permalink($comment->comment_post_ID).'#cmt'.$comment->comment_ID.'">Xem chi tiết</a>';
			LogUserActivity($activity, $comment->user_id, 'notification');
        }
    }
}

//Thông báo khi bài viết được publish
function on_publish_pending_post( $post ) {
	$activity = 'Xin chúc mừng, bài viết <strong>'.$post->post_title.'</strong> của bạn đã được phê duyệt - <a href="'.get_permalink($post->ID).'">Xem chi tiết</a>';
    LogUserActivity($activity, $post->post_author, 'notification');
}
add_action(  'pending_to_publish',  'on_publish_pending_post', 10, 1 );

require get_template_directory() . '/core/init.php';

?>