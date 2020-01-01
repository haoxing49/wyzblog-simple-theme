<?php get_header(); ?>

<!-- Column 1 /Content -->

<div class="layui-col-md9 layui-col-lg9">
	<!-- Blog Post -->
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="list-post list-card">
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
				</div>
			</div>

		<?php endwhile; ?>
		<div class="posts-nav">
			<?php get_page_link_wyzblog(); ?>
		</div>
	<?php else : ?>
		<h2 class="list-post-title"><a href="#" rel="bookmark">未找到</a></h2>
		<p>没有找到任何文章！</p>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>