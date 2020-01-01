<?php get_header(); ?>
<!-- Column 1 /Content -->
<?php if (have_posts()) : the_post();
	update_post_caches($posts); ?>
	<div class="layui-col-md9 layui-col-lg9">
		<!-- Blog Post -->
		<div class="single-post">
			<!-- Post Title -->
			<h1 class="single-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<!-- Post Title -->
			<p>
				<span><i class='layui-icon layui-icon-note'></i>
					<?php the_tags(''); ?>
				</span>
				<span>
					<i class='layui-icon layui-icon-date'></i> <?php the_time('Y年n月j日') ?>
				</span>
				<span>
					<i class='layui-icon layui-icon-dialogue'></i> <?php comments_popup_link('0', '1', '%', '', '评论已关闭'); ?>
				</span>
				<span>
					<?php edit_post_link('编辑', ' <i class="layui-icon layui-icon-edit"></i> ', ''); ?>
				</span>
			</p>
			<!-- Post Content -->
			<div class='single-post-content'>
				<?php the_content(); ?>
			</div>
		</div>
		<?php comments_template(); ?>
	</div>
<?php else : ?>
	<div class="errorbox">
		没有文章！
	</div>
<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>