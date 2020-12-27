<!-- Column 2 / Sidebar -->
<div class="sidebar layui-col-md3 layui-col-lg3 layui-col-xs12">

	<div class="right-sidebar-children">
		<form class="layui-form" id="search" method="post" action="<?php home_url('/'); ?>" role="search">
			<div class="layui-inline input">
				<input type="text" id="s" name="s" class="layui-input" required="" lay-verify="required" placeholder="输入关键字搜索">
			</div>
			<div class="layui-inline">
				<button class="layui-btn layui-btn-sm layui-btn-primary" onClick="if(document.forms['search'].searchinput.value=='- Search -')document.forms['search'].searchinput.value='';"><i class="layui-icon layui-icon-search"></i></button>
			</div>
		</form>
	</div>

	<?php if (
		!function_exists('dynamic_sidebar')
		|| !dynamic_sidebar('First_sidebar')
	) : ?>

		<div class='right-sidebar-children'>
			<h3 class="right-sidebar-title"><i class="fa fa-th-large" aria-hidden="true"></i> 分类目录</h3>
			<ul class="layui-row">
				<?php wp_list_categories(array(
					'show_count'          => 1,
					'title_li'            => '',
				)); ?>
			</ul>
		</div>

	<?php endif; ?>

	<?php if (!is_home() && 
		(!function_exists('dynamic_sidebar')
			|| !dynamic_sidebar('Second_sidebar'))
	) : ?>
		<div class='right-sidebar-children'>
			<h3 class="right-sidebar-title"><i class="fa fa-newspaper-o"></i> 最新文章</h3>
			<ul class="layui-row layui-col-space5">
				<?php
				$posts = get_posts('numberposts=6&orderby=post_date');
				foreach ($posts as $post) {
					setup_postdata($post);
					echo '<li class="layui-col-md12 layui-col-xs12"><i class="layui-icon layui-icon-tree"></i><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
				}
				$post = $posts[0];
				?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if (
		!function_exists('dynamic_sidebar')
		|| !dynamic_sidebar('Third_sidebar')
	) : ?>
		<div class='right-sidebar-children'>
			<h3 class="right-sidebar-title"><i class="fa fa-tags"></i> 标签云</h3>
			<span class="sidebar_tag"><?php wp_tag_cloud('show_count=1'); ?></span>
		</div>
	<?php endif; ?>

	<?php if (
		!function_exists('dynamic_sidebar')
		|| !dynamic_sidebar('Fourth_sidebar')
	) : ?>
		<div class='right-sidebar-children'>
			<h3 class="right-sidebar-title"><i class="fa fa-dropbox"></i> 文章存档</h3>
			<ul class="layui-row layui-col-space5">
				<?php wp_get_archives(array(
					'year'            => get_query_var('year'),
					'monthnum'        => get_query_var('monthnum'),
					'day'             => get_query_var('day'),
					'show_post_count' => true
				)); ?>
			</ul>
		</div>
	<?php endif; ?>
</div>

</div>
</div>