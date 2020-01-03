<?php

/** widgets */
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'First_sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
	register_sidebar(array(
		'name' => 'Second_sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
	register_sidebar(array(
		'name' => 'Third_sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
	register_sidebar(array(
		'name' => 'Fourth_sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
}

function curPageURL()
{
	$pageURL = 'http://';

	$this_page = $_SERVER["REQUEST_URI"];
	if (strpos($this_page, "?") !== false)
		$this_page = reset(explode("?", $this_page));

	$pageURL .= $_SERVER["SERVER_NAME"]  . $this_page;

	return $pageURL;
}
?>


<?php
/**
 * 自定义菜单
 */
register_nav_menus(
	array(
		'HeaderMenu'  => __('HeaderMenu')
	)
);

#-----------------------------------------------------------------#
# 修改wp_nav_menu的li标签
#-----------------------------------------------------------------#
class new_walker extends Walker_Nav_Menu
{
	//修改一级ul标签样式
	function start_lvl(&$output, $depth = 0, $args = array())
	{
		if ($depth == 0) {
			$output .= '<ul class="layui-nav-child">';
		} else {
			$output .= '<ul class="layui-nav-child">';
		}
	}
	function end_lvl(&$output, $depth = 0, $args = array())
	{
		if ($depth == 0) {
			$output .= "</ul>";
		} else {
			$output .= '</ul>';
		}
	}
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ($depth) ? str_repeat($t, $depth) : '';

		$classes   = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$args = apply_filters('nav_menu_item_args', $args, $item, $depth);

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
		if ($depth == 0) {
			$class_names .= ' layui-nav-item'; //增加Layui样式
		}
		if (in_array('current-menu-item', $classes)) {
			$class_names .= ' layui-this'; //增加当前样式
		}
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts           = array();
		$atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
		$atts['target'] = !empty($item->target) ? $item->target : '';
		if ('_blank' === $item->target && empty($item->xfn)) {
			$atts['rel'] = 'noopener noreferrer';
		} else {
			$atts['rel'] = $item->xfn;
		}
		$atts['href']         = !empty($item->url) ? $item->url : '';
		$atts['aria-current'] = $item->current ? 'page' : '';

		$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

		$attributes = '';
		foreach ($atts as $attr => $value) {
			if (!empty($value)) {
				$value       = ('href' === $attr) ? esc_url($value) : esc_attr($value);
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters('the_title', $item->title, $item->ID);

		$title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}

/**
 * 面包屑
 */

function breadcrumbs()
{
	if (is_home()) return false;
	if (is_category()) {
		$category = '<cite>' . single_cat_title('', false) . '</cite>';
		if (category_description()) $category = '<p>' . category_description() . '</p>';
		// If this is a tag archive
	} elseif (is_page()) {
		$category = the_title('<span>', '</span>', false);
		// If this is a daily archive
	} elseif (is_tag()) {
		$category = '标签<a>' . single_tag_title('', false) . '</a>';
		if (tag_description()) $category = '<p>' . tag_description() . '</p>';
		// If this is a daily archive
	} elseif (is_day()) {
		$category = '日期存档<a>' . get_the_time('Y年n月j日') . '</a>';
		// If this is a monthly archive
	} elseif (is_month()) {
		$category = '<cite>' . get_the_time('Y年n月') . '</cite>';
		// If this is a yearly archive
	} elseif (is_year()) {
		$category = '年份存档<a>' . get_the_time('Y年') . '</a>';
		// If this is an author archive
	} elseif (is_author()) {
		$category = '作者存档';
		// If this is a paged archive
	} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
		$category = '博客存档';
	} elseif (is_single()) {
		$categorys = get_the_category();
		$category = $categorys[0];
		$category = get_category_parents($category->term_id, true, ' <span lay-separator="">/</span>') . get_the_title() . '<cite>正文</cite>';
	}
	return '<a href="' . get_bloginfo('url') . '">' . get_bloginfo('name') . '</a> <span lay-separator="">/</span> ' . $category;
}
?>
<?php
/*自定义评论显示模板*/
function wyzblog_comment_new($comment, $args)
{
	$GLOBALS['comment'] = $comment;
	$isChildOrParent = "";
	if ($comment->comment_parent == 0) {
		$isChildOrParent = ' comment-parent';
	} else {
		$isChildOrParent = ' comment-child';
	}
	switch ($comment->comment_type):
		case 'pingback':
		case 'trackback':
?>
			<li class="post pingback">
				<p><?php _e('Pingback:', 'wyzblog'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'wyzblog'), '<span class="edit-link">', '</span>'); ?></p>
			<?php
			break;
		default:
			?>
			<li <?php comment_class($isChildOrParent); ?> id="li-comment-<?php comment_ID(); ?>">

				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<footer class="comment-meta">
						<div class="comment-author vcard">
							<?php
							$avatar_size = 50;
							if ('0' != $comment->comment_parent) {
								$avatar_size = 39;
							}

							echo get_avatar($comment, $avatar_size);

							/* translators: 1: comment author, 2: date and time */
							printf(
								__('%1$s %2$s', 'wyzblog'),
								sprintf('<span class="fn">%s</span>', get_comment_author_link()),
								sprintf(
									'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
									esc_url(get_comment_link($comment->comment_ID)),
									get_comment_time('c'),
									/* translators: 1: date, 2: time */
									sprintf(__('%1$s at %2$s', 'wyzblog'), get_comment_date(), get_comment_time())
								)
							);
							?>

							<?php edit_comment_link(__('Edit', 'wyzblog'), '<span class="edit-link">', '</span>'); ?>
						</div><!-- .comment-author .vcard -->

						<?php if ($comment->comment_approved == '0') : ?>
							<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'wyzblog'); ?></em>
							<br />
						<?php endif; ?>

					</footer>
					<div><b><?php echo getPermalinkFromCoid($comment->comment_parent); ?></b></div>
					<div class="comment-content"><?php comment_text(); ?></div>
					<div class="reply">
						<?php
						comment_reply_link(
							array(
								'reply_text' => __('<span class="layui-btn layui-btn-normal layui-btn-xs">回复</span>', 'wyzblog'),
								'depth'        => isset($args['args']['depth']) ? $args['args']['depth'] : (int) 3,
								'max_depth'    => isset($args['args']['max_depth']) ? $args['args']['max_depth'] : (int) 5
							),
							get_comment_ID()
						);
						?>
					</div><!-- .reply -->
			</li>

<?php
			break;
	endswitch;
}
?>


<?php
// 留言加@
function getPermalinkFromCoid($coid)
{
	global $wpdb;
	$row = $wpdb->get_row($wpdb->prepare("SELECT comment_author from wyzblog_comments where comment_ID=%s", $coid), ARRAY_A, 0);
	if (empty($row['comment_author'])) echo '';
	else echo '<a href="#comment-' . $coid . '">@' . $row['comment_author'] . '</a>';
}
?>

<?php

function get_cancel_comment_reply_link_wyzblog($text = '')
{
	if (empty($text)) {
		$text = __('Click here to cancel reply.');
	}

	$style = isset($_GET['replytocom']) ? '' : ' style="display:none;"';
	$link  = esc_html(remove_query_arg(array('replytocom', 'unapproved', 'moderation-hash'))) . '#respond';

	$formatted_link = '<a rel="nofollow" id="cancel-comment-reply-link" class="layui-btn layui-btn-danger layui-btn-xs" href="' . $link . '"' . $style . '>' . $text . '</a>';

	return apply_filters('cancel_comment_reply_link', $formatted_link, $link, $text);
}
//首页文章分页
function get_page_link_wyzblog()
{
	global $wp_query;
	$big = 999999999;
	$pagination_links = paginate_links(array(
		'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
		'format' => '?paged=%#%',
		'show_all' => false,
		'current' => max(1, get_query_var('paged')),
		'end_size' => 3,
		'mid_size' => 3,
		'prev_text' => __('&nbsp;上一页&nbsp;'),
		'next_text' => __('&nbsp;下一页&nbsp;'),
		'total' => $wp_query->max_num_pages
	));
	echo $pagination_links;
}

//新建说说功能 
add_action('init', 'my_custom_init');
function my_custom_init()
{
	$labels = array(
		'name' => '说说',
		'singular_name' => '说说',
		'all_items' => '所有说说',
		'add_new' => '发表说说',
		'add_new_item' => '撰写新说说',
		'edit_item' => '编辑说说',
		'new_item' => '新说说',
		'view_item' => '查看说说',
		'search_items' => '搜索说说',
		'not_found' => '暂无说说',
		'not_found_in_trash' => '没有已遗弃的说说',
		'parent_item_colon' => '',
		'menu_name' => '说说'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'author')
	);
	register_post_type('TalkAboutMood', $args);
}
?>