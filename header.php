<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php if (is_home()) {
				bloginfo('name');
				echo " - ";
				bloginfo('description');
			} elseif (is_category()) {
				single_cat_title();
				echo " - ";
				bloginfo('name');
			} elseif (is_single() || is_page()) {
				single_post_title();
			} elseif (is_search()) {
				echo "搜索结果";
				echo " - ";
				bloginfo('name');
			} elseif (is_404()) {
				echo '页面未找到!';
			} else {
				wp_title('', true);
			} ?></title>
	<!-- Stylesheets -->
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<script src="<?php bloginfo('template_url'); ?>/assets/js/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/layui/css/layui.css" type="text/css" />
	<script src="<?php bloginfo('template_url'); ?>/assets/layui/layui.js"></script>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo $feed; ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_enqueue_script('comment-reply');
	wp_head(); ?>
</head>
<?php flush(); ?>
<body>
	<div class='layui-header header'>
		<div class='layui-main'>
			<!-- Text Logo -->
			<a class='logo' href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a>
			<!-- Navigation Menu -->
			<?php if(wp_is_mobile()){?>
				<div class='nav-mobile-icon'>
					<div class='nav-mobile-open' id='nav-mobile-open' lay-filter='nav-mobile-open'><i class="fa fa-bars" aria-hidden="true"></i></div>
					<div class='nav-mobile-close' id='nav-mobile-close'><i class="fa fa-times" aria-hidden="true"></i></div>
				</div>
			<?php }?>
			<?php if (has_nav_menu('HeaderMenu')) : ?>
				<?php
				wp_nav_menu(array(
					'menu_id'         => 'div_navigation',
					'container' => 'div',
					'theme_location' => '', //导航别名
					'menu_class' => 'layui-nav', //引用layui-nav样式
					'walker' => new nav_new_walker(), //引用刚才的重构
				));
				?>
			<?php endif; ?>
		</div>
	</div>
	<span class="layui-nav-bar" style="width: 0px; left: 330px; opacity: 0; top: 59px;"></span>
	<div class='layui-container'>
		<div class='layui-row layui-col-space15  main'>
			<!-- Caption Line -->
			<!-- 面包屑 -->
			<div class="map">
				<?php if (!is_home()) : echo "当前位置：";
				endif; ?>
				<span class="layui-breadcrumb" style="visibility: visible;"><?php echo breadcrumbs() ?></span>
			</div>