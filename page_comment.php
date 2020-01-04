<?php
/*
 Template Name: page_comment
 *
*/
?>
<?php get_header(); ?>
<!-- Column 1 /Content -->
<div class="layui-col-md9 layui-col-lg9 layui-col-sm12 layui-col-xs12">
	<?php if (have_posts()) : the_post();
		update_post_caches($posts); ?>
		<?php comments_template(); ?>
	<?php else : ?>
		<div class="errorbox">
			暂无留言！
		</div>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>