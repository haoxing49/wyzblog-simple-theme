<?php get_header(); ?>

<!-- Column 1 /Content -->

<div class="layui-col-md9 layui-col-lg9" id='ajaxpost'>
	<!-- Blog Post -->
</div>

<script>
	<?php global $wp_query; ?>
	layui.use('flow', function() {
		var $ = layui.jquery; //不用额外加载jQuery，flow模块本身是有依赖jQuery的，直接用即可。
		var flow = layui.flow;
		flow.load({
			elem: '#ajaxpost', //指定列表容器
			isAuto: 'false',
			end: '<span>—— 你看光我的底线啦 ——</span>',
			isLazyimg: 'true',
			done: function(page, next) { //到达临界点（默认滚动触发），触发下一页 
				//console.log(page);
				$.ajax({
					type: 'POST',
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					dataType: "html", // add data type
					data: {
						action: 'get_ajax_posts',
						page_now: page //当前页
					},
					success: function(strOut) {
						//console.log(strOut);	
						next(strOut, page < <?php echo $wp_query->max_num_pages; ?>);
					}
				});
			}
		});
	});
</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>