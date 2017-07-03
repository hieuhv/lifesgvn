<?php
ReadUserActivity(get_template_directory_uri().'/logs/'.$user_id.'-notification.txt');
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div id="new-task">
	<div class="edit-basic-info clearfix ng-scope" ng-controller="accountInfoCtrl">
		<div class="edit-basic-info">
			<h3><?php the_title(); ?></h3>
		</div>
		<?php if(sizeof($log)>0):?>
		<div class="noti-list">
		<?php foreach($log as $item) {?>
		<div class="noti-time"><?php echo $item[0];?></div><div class="noti-content"><?php echo $item[1];?></div>
		<?php } ?>
		</div>
<?php else: ?>
<p class="no-activity">Chưa có thông báo nào mới nhất ^^!</p>
<?php endif;?>
</div><!-- .entry-content -->
	</div><!-- .hentry .post -->
    <?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
<?php else: ?>
    <p class="no-data">
        <?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
    </p><!-- .no-data -->
<?php endif; ?>