<?php
ReadUserActivity(get_template_directory_uri().'/logs/'.$user_id.'-activity.txt');
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div id="new-task">
	<div class="edit-basic-info clearfix ng-scope" ng-controller="accountInfoCtrl">
		<div class="edit-basic-info">
			<h3><?php the_title(); ?></h3>
		</div>
		<?php if(sizeof($log)>0):?>
<table class="tbl-qa">
	  <thead>
		  <tr>
			<th class="table-header" width="18%">Thời gian</th>
			<th class="table-header">Hoạt động</th>
		  </tr>
	  </thead>
	  <tbody>
		<?php foreach($log as $item) {?>
		  <tr class="table-row">
			<td><?php echo $item[0];?></td>
			<td style="text-align: left;"><?php echo $item[1];?></td>
		  </tr>
		<?php } ?>
	</tbody>
</table>
<?php else: ?>
<p class="no-activity">Oppss, bạn chưa có hoạt động nào, mời bạn tương tác mạnh mẽ lên nữa nhé ^^!</p>
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