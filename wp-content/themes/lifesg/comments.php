<?php
$args = array(
	'fields' => '',
	'comment_field' => '<p class="comment-form-comment">' .
		'<textarea id="comment" name="comment" placeholder="Hãy chia sẻ cảm nghĩ của bạn về bài viết này..." cols="45" rows="8" aria-required="true"></textarea>' .
		'</p>',
	'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Thảo luận với tài khoản <a href="%1$s">%2$s</a>. <a href="%3$s" title="Đăng xuất">Đăng xuất?</a>' ), home_url( 'thanh-vien/tai-khoan/' ), $user_identity, wp_logout_url( home_url('dang-nhap') ) ) . '</p>',
    'comment_notes_after' => '',
	'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'Bạn cần <a href="%s">đăng nhập</a> để thảo luận bài viết này.' ), home_url('dang-nhap')) . '</p>',
    'title_reply' => '',
	'label_submit' => 'Đăng thảo luận'
);
comment_form($args);
?>
<div class="comments">
   <?php wp_list_comments('type=comment&callback=format_comment&reverse_top_level=true&reply_text=Trả lời'); ?>
</div>