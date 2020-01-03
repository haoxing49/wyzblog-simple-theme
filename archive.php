<?php get_header(); ?>
<!-- Column 1 /Content -->
<div class="layui-col-md9 layui-col-lg9">
	<div class="sorting" style="display: none" >
		<h2>当前浏览<?php
				// If this is a category archive
				if (is_category()) {
					printf('分类</h2>
			<h3>' . single_cat_title('', false) . '</h3>');
					if (category_description()) echo '<p>' . category_description() . '</p>';
					// If this is a tag archive
				} elseif (is_tag()) {
					printf('标签</h2>
			<h3>' . single_tag_title('', false) . '</h3>');
					if (tag_description()) echo '<p>' . tag_description() . '</p>';
					// If this is a daily archive
				} elseif (is_day()) {
					printf('日期存档</h2>
			<h3>' . get_the_time('Y年n月j日') . '</h3>');
					// If this is a monthly archive
				} elseif (is_month()) {
					printf('月份存档</h2>
				<h3>' . get_the_time('Y年n月') . '</h3>');
					// If this is a yearly archive
				} elseif (is_year()) {
					printf('年份存档</h2>
				<h3>' . get_the_time('Y年') . '</h3>');
					// If this is an author archive
				} elseif (is_author()) {
					echo '作者存档';
					// If this is a paged archive
				} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
					echo '博客存档';
				}
				?>
				<div class="sort_by">
			<h2 style="display: none">排序</h2>
			<ul style="display: none">
				<li><a <?php if (isset($_GET['order']) && ($_GET['order'] == 'rand')) echo 'class="current"'; ?> href="<?php the_permalink(); ?> . '?' . http_build_query(array_merge($_GET, array('order' => 'rand'))); ?>">随机阅读</a></li>
				<li><a <?php if (isset($_GET['order']) && ($_GET['order'] == 'commented')) echo 'class="current"'; ?> href="<?php the_permalink(); ?> . '?' . http_build_query(array_merge($_GET, array('order' => 'commented'))); ?>">评论最多</a></li>
				<li><a <?php if (isset($_GET['order']) && ($_GET['order'] == 'alpha')) echo 'class="current"'; ?> href="<?php the_permalink(); ?> . '?' . http_build_query(array_merge($_GET, array('order' => 'alpha'))); ?>">标题排序</a></li>
			</ul>
		</div>
	</div>


	<?php
	global $wp_query;

	if (isset($_GET['order']) && ($_GET['order'] == 'rand')) {
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'orderby' => 'rand',
			'paged' => $paged,
		);
		$arms = array_merge(
			$args,
			$wp_query->query
		);
		query_posts($arms);
	} else if (isset($_GET['order']) && ($_GET['order'] == 'commented')) {
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'orderby' => 'comment_count',
			'order' => 'DESC',
			'paged' => $paged,
		);
		$arms = array_merge(
			$args,
			$wp_query->query
		);
		query_posts($arms);
	} else if (isset($_GET['order']) && ($_GET['order'] == 'alpha')) {
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'orderby' => 'title',
			'order' => 'ASC',
			'paged' => $paged,
		);
		$arms = array_merge(
			$args,
			$wp_query->query
		);
		query_posts($arms);
	}



	if (have_posts()) : while (have_posts()) : the_post(); ?>
			<!-- Blog Post -->

			<div class="list-post list-card layui-col-xs12">
			<div class="metacat">
					<?php
					$category = get_the_category();
					if ($category[0]) {
						echo '<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->cat_name . '</a>';
					}
					?>
				</div>
				<div class="list-post-thumb"><a href=""><img src="<?php bloginfo('template_url'); ?>/assets/images/thumb.png" alt="" class="img-full"></a></div>

				<!-- Post Title -->
				<h3 class="list-post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				<!-- Post Data -->
				<div class='list-post-content'>
					<!-- Post Content -->
					<div class="post_content">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
							<?php the_excerpt(); ?>
						</a>
					</div>
					<p class="post_data">
						<span><i class='layui-icon layui-icon-note'></i>
							<?php
							the_tags('');
							?>
						</span>
						<!-- <?php the_tags('标签：', ', ', ''); ?>  -->
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
				</div>
			</div>
		<?php endwhile; ?>
	<?php else : ?>
		<h1 class="title"><a href="#" rel="bookmark">未找到</a></h1>
		<p>没有找到任何文章！</p>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>