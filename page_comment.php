<?php
/*
 Template Name: page_comment
 *
*/
?>
<?php get_header(); ?>
<!-- Column 1 /Content -->
<?php if (have_posts()) : the_post();
    update_post_caches($posts); ?>
    <h2>留言板</h2>
	<div class="layui-col-md9 layui-col-lg9">
		<?php comments_template(); ?>
	</div>
<?php else : ?>
	<div class="errorbox">
		暂无留言！
	</div>
<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>