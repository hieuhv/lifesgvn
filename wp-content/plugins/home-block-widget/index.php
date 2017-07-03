<?php
/*
Plugin Name: Category Post Widget
Plugin URI: http://sgcomedia.com
Description: Category Post Widget for website
Author: Hieu Ho
Version: 1.0
Author URI: http://hieuho.us
*/

/**
 * Tạo class Category_Post_Widget
 */
class Category_Post_Widget extends WP_Widget {
	
	/**
	 * Thiết lập widget: đặt tên, base ID
	 */
	function __construct()
	  {
		$widget_ops = array('classname' => 'article_widget_class', 'description' => 'Home Block for LifeSG' );
		parent::__construct('article_widget_id', 'Home Block LifeSG', $widget_ops);
	  }
	/**
	 * Tạo form option cho widget
	 */
	function form( $instance ) {
		
		//Biến tạo các giá trị mặc định trong form
		$default = array(
			'title' => '',
			'post_number' => 4,
			'id_category' => '',
		);
		
		//Gộp các giá trị trong mảng $default vào biến $instance để nó trở thành các giá trị mặc định
		$instance = wp_parse_args( (array) $instance, $default);
		
		//Tạo biến riêng cho giá trị mặc định trong mảng $default
		$title = esc_attr( $instance['title'] );
		$post_number = esc_attr( $instance['post_number'] );
		$id_category = esc_attr( $instance['id_category'] );
		$arrCate = array();
		$categories = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC',
			'hide_empty' => 0
		) );
		$cosmetic_cats = get_terms('cosmetic_type');
		foreach($cosmetic_cats as $c_cat){
			$type = $c_cat->term_id.'_cosmetic';
			$arrCate[$type] = $c_cat->name;
		}
		foreach($categories as $cat) {
			$arrCate[$cat->term_id] = $cat->name;
		}
		//Hiển thị form trong option của widget
		echo "<p>Nhập tiêu đề <input type='text' class='widefat' name='".$this->get_field_name('title')."' value='".$title."' /></p>";
		echo '<p>Số lượng bài viết hiển thị <input type="number" class="widefat" name="'.$this->get_field_name('post_number').'" value="'.$post_number.'" placeholder="'.$post_number.'" max="30" /></p>';
		echo 'Chọn danh mục <select class="widefat" name="'.$this->get_field_name('id_category').'">';
		foreach( $arrCate as $key=>$value ) {
			$selected = ($id_category==$key)?"selected":"";
			echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
		}
		echo '</select>';
		
	}
	
	/**
	 * save widget form
	 */
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['post_number'] = strip_tags($new_instance['post_number']);
		$instance['id_category'] = strip_tags($new_instance['id_category']);
		return $instance;
	}
	
	/**
	 * Show widget
	 */
	
	function widget( $args, $instance ) {
		
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$post_number = $instance['post_number'];
		$category = $instance['id_category'];
		if(strpos($category,'cosmetic') !== false) {
			$arrEx = explode("_",$category);
			$arrCate = array('tax_query' => array(array(
							'taxonomy' => 'cosmetic_type',
							'field' => 'term_id',
							'terms' => (int)$arrEx[0]
						)), 'post_type' => 'cosmetic');
		} else {
			$arrCate = array('category__in' => $category);
		}

		echo $before_widget;
		//In tiêu đề widget
		echo $before_title.$title.$after_title;
		
		$args_temp = array( 
				
				'showposts'=> $post_number,
				'order' => 'DESC'
		); 
		$args = array_merge($args_temp,$arrCate);
		// Nội dung trong widget
		$the_query = new WP_Query($args);
		$upload_dir = wp_upload_dir();
		// The Loop
		$position = 0;
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$position++;
				$the_query->the_post();
				if ( has_post_thumbnail() ) {
					$img_url = get_the_post_thumbnail_url();
				} else {
					$img_url = $upload_dir['baseurl'].'/no_image.png';
				}
				if($position==1) {
				?>
				<article class="tg-theme-post tg-category-full">
					<figure>
						<a href="#">
							<img src="<?php echo $img_url;?>" alt="image description">
						</a>
						<figcaption>
							<div class="tg-box">
								<div class="tg-postcontent">
									<div class="tg-border-heading">
										<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
									</div>
									<ul class="tg-postmetadata">
										<li>
											<a href="#">
												<i class="fa fa-clock-o"></i>
												<span><?php echo get_the_date();?></span>
											</a>
										</li>
										<li>
											<a href="#">
												<i class="fa fa-user"></i>
												<span>by <?php the_author();?></span>
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
				<?php } else { ?>
				<article class="tg-theme-post tg-category-small">
					<figure>
						<a href="#"><img src="<?php echo $img_url;?>" alt="image description" style="width:100px;height:100px;"></a>
						<figcaption><a href="#" class="tg-tag tg-tag-hotstory"><i class="fa fa-star"></i></a></figcaption>
					</figure>
					<div class="tg-postdata">
						<div class="tg-border-heading">
							<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
						</div>
						<ul class="tg-postmetadata">
							<li>
								<a href="#">
									<i class="fa fa-clock-o"></i>
									<span><?php echo get_the_date(); ?></span>
								</a>
							</li>
						</ul>
					</div>
				</article>
					<?php
				}
			}
		} else {
			// no posts found
		}
		/* Restore original Post Data */
		wp_reset_postdata();

		
		// Kết thúc nội dung trong widget
		
		echo $after_widget;
	}
	
}

/*
 * Khởi tạo widget item
 */
add_action( 'widgets_init', 'create_category_post_widget' );
function create_category_post_widget() {
	register_widget('Category_Post_Widget');
}