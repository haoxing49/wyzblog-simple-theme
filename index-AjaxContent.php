<!-- Column 1 /Content -->

	<div class="list-post list-card layui-col-xs12">
		<div class="metacat">
			 <?php
			$category = get_the_category();
			if ($category[0]) {
				echo '<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->cat_name . '</a>';
			}
			?> 
		</div>
		<div class="list-post-thumb">
			<a href="">
				<?php if (is_has_image()) { ?>
					<img src="<?php echo catch_that_image(); ?>" alt="" class="img-full">
				<?php } else { ?>
					<img src="<?php bloginfo('template_url'); ?>/images/thumb/img<?php echo rand(1, 5) ?>.jpg" alt="" class="img-full">
				<?php } ?>
			</a>
		</div>

		<!-- Post Title -->
		<h2 class="list-post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<!-- Post Data -->
		<div class='list-post-content'>
			<!-- Post Content -->
			<div class="post_content">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_excerpt(); ?>
				</a>
			</div>
			<p class="post_data">
				<span class='post-tags'><i class='layui-icon layui-icon-note'></i>
					<?php the_tags(''); ?>
				</span>

				<span class='post-date'>
					<i class='layui-icon layui-icon-date'></i> <?php the_time('Y年n月j日') ?>
				</span>
				<span>
					<i class="fa fa-eye" aria-hidden="true"></i> <?php echo getPostViews(get_the_ID());  ?>
				</span>
				<span class='post-comment-count'>
					<i class='layui-icon layui-icon-dialogue'></i> <?php comments_popup_link('0', '1', '%', '', '评论已关闭'); ?>
				</span>
				<span class='post-edit-link'>
					<?php edit_post_link('编辑', ' <i class="layui-icon layui-icon-edit"></i> ', ''); ?>
				</span>
			</p>
		</div>
	</div>
