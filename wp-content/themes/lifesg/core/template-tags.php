<?php
/**
@ Function display logo
@ lifesg_logo()
**/
if ( ! function_exists( 'lifesg_logo' ) ) {
	function lifesg_logo() {
		global $lifesg_options;
		if($lifesg_options['logo-on']==1 && isset($lifesg_options['logo-image'])){
	?>
		<strong class="tg-logo">
			<?php printf('
					<a href="%1$s" title="%2$s"><img src="%3$s" alt="%4$s"></a>',
					get_bloginfo( 'url' ),
					get_bloginfo( 'sitename' ),
					$lifesg_options['logo-image']['url'],
					get_bloginfo( 'description' )
				); ?>
		</strong>
	<?php } else {
			printf('<h2>%1$s</h2>',get_bloginfo( 'sitename' ));
		}
	}
}

//Copyright Footer
if ( ! function_exists( 'copyright_footer' ) ) {
	function copyright_footer() {
		global $lifesg_options;
		if(!empty($lifesg_options['copyright-footer'])){
			printf('<p class="pull-left">%1$s</p>',$lifesg_options['copyright-footer']);
		} else {
			printf('<p class="pull-left">© %1$s | %2$s</p>',date('Y'),get_bloginfo( 'sitename' ));
		}
	}
}

//Bài viết xem nhiều
if ( ! function_exists( 'popular_posts' ) ) {
	function popular_posts($title){
		$html = '';
		$the_query = new WP_Query(
			array( 
				'post_type' => 'cosmetic',
				'meta_key' => 'post_views_count',
				'orderby' => 'meta_value_num',
				'showposts'=> 5,
				'order' => 'DESC'
			));
		if ( $the_query->have_posts() ) {
			$html .= '<div id="moreview_posts">';
			$html .= '<div class="tab-blog-more-view">';
				$html .= '<div class="blog-more-view" data-tab="">';
					$html .= '<h3>'.$title.'</h3>';
					$html .= '<ul>';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$html .= '<li><a href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></li>';
			}
					$html .= '</ul>';
				$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
		}
		echo $html;
	}
}

//Bài viết cùng tác giả
if ( ! function_exists( 'author_posts' ) ) {
	function author_posts($title,$user_id){
		$html = '';
		$the_query = new WP_Query(
			array( 
				'post_type' => 'cosmetic',
				'author'    =>  $user_id,
				'orderby'   =>  'post_date',
				'order'    	=>  'DESC',
				'showposts'=> 5,
			));
		if ( $the_query->have_posts() ) {
			$html .= '<div class="tab-blog-more-view" id="author_posts">';
				$html .= '<div class="blog-more-view" data-tab="">';
					$html .= '<h3>'.$title.'</h3>';
					$html .= '<ul>';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$html .= '<li><i class="fa fa-paper-plane-o" aria-hidden="true"></i> <a href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></li>';
			}
					$html .= '</ul>';
				$html .= '</div>';
			$html .= '</div>';
		}
		echo $html;
	}
}

//Bài viết cùng chuyên mục
if ( ! function_exists( 'like_category' ) ) {
	function like_category($term_id, $title){
		$html = '';
		$position = 0;
		$posts = get_posts_by_cc($term_id);
		$html .= '<div id="tg-blogdetail-slider" class="tg-blogdetail-slider tg-haslayout">';
		foreach($posts as $post) {
			$position++;
			if($position % 2 != 0) {
				$html .= '<div class="item">';
				$html .= '<div class="row">';
			}
			$html .= '<div class="col-md-6 col-sm-12">
						<article class="tg-theme-post tg-category-small">
							<figure>
								<img alt="image dexcription" style="width:100px;height:100px;" src="'.get_the_post_thumbnail_url($post->ID, 'like-img').'">
							</figure>
							<div class="tg-postdata">
								<div class="tg-border-heading">
									<h3><a href="'.get_permalink($post->ID).'">'.wp_trim_words($post->post_title, 6).'</a></h3>
								</div>
							</div>
						</article>
					</div>';
			if($position % 2 == 0 || $position==count($posts)) {
				$html .= '</div>';
				$html .= '</div>';
			}
		}
		$html .= '</div>';
		echo $html;
	}
}
//Bài viết nổi bật
if ( ! function_exists( 'whatshot' ) ) {
	function whatshot(){
		$args = array( 
						'order' => 'DESC',
						'offset'=> 0,
						'post_type' => 'cosmetic',
						'post_status' => 'publish',
						'posts_per_page'   => 6,
						'meta_key'		=> 'sticky',
						'meta_value'	=> true
					);
		$whatshot = get_posts( $args );
		$cosmetic_cats = get_terms('cosmetic_type');
		?>
		<section class="tg-haslayout tg-whatshot">
			<div class="tg-section-heading">
				<h2>Nổi bật</h2>
				<ul id="tg-filterbale-nav" class="tg-filterbale-nav option-set">
					<li><a href="javascript()%3b.html" data-filter="*" class="tg-tag active">Tất cả</a></li>
					<?php
						foreach ( $cosmetic_cats as $cosmetic_cat ) {
						   echo '<li><a href="javascript()%3b.html" data-filter=".'.$cosmetic_cat->slug.'" class="tg-tag">'.$cosmetic_cat->name.'</a></li>';
						}
					?>
				</ul>
			</div>
			<div id="tg-filtermasonry" class="tg-filtermasonry" style="position: relative; height: 409.312px;">
			<?php foreach($whatshot as $hot):?>
				<?php
					$cate_select = array();
					$categories = get_the_terms( $hot->ID, 'cosmetic_type' );
					if(!empty( $categories )) {
						foreach($categories as $cat){
							$cate_select[] = $cat->slug;
						}
					}
				?>
				<article class="tg-theme-post tg-griditem <?php echo implode(" ",$cate_select);?>">
					<figure>
						<a href="#">
							<img src="<?php echo get_the_post_thumbnail_url($hot->ID, 'whatshot-img');?>" alt="image description">
						</a>
						<figcaption>
							<div class="tg-box">
								<a class="tg-tag tg-tag-hotstory" href="#"><i class="fa fa-star"></i></a>
								<div class="tg-postcontent">
								<?php
								if ( ! empty( $categories ) ) {
									echo '<div class="tg-theme-tags">
											<a class="tg-tag tg-tag-category tg-color-pink" href="#">'.$categories[0]->name.'</a>
										</div>';
								}
								?>
									<div class="tg-border-heading">
										<h3><a href="<?php echo get_the_permalink($hot->ID);?>"><?php echo $hot->post_title;?></a></h3>
									</div>
								</div>
							</div>
						</figcaption>
					</figure>
				</article>
			<?php endforeach;?>
			</div>
		</section>
		<?php
	}
}
?>