<!-- 主题设置 -->
<?php
defined('ABSPATH')  or exit; //如果是直接跳转到该页面则退出
$theme_options_configs = array();
require(get_template_directory() . '/inc/theme-options-configs.php');


function theme_function()
{
?>
    <fieldset class="layui-elem-field layui-field-title">
        <legend>wyzblog-simple-theme主题设置</legend>
    </fieldset>

    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li class="layui-this">网站设置</li>
            <li>用户管理</li>
            <li>权限分配</li>
            <li>商品管理</li>
            <li>订单管理</li>
        </ul>

        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                1. 高度默认自适应，也可以随意固宽。
                <br>2. Tab进行了响应式处理，所以无需担心数量多少。

                <p>
                    <label>
                        <input name="wyzblog_copy_right" size="40" />
                    </label>
                </p>
                <p class="submit">
                    <input type="submit" name="option_save" value="<?php _e('保存设置'); ?>" />
                </p>
            </div>
            <div class="layui-tab-item">内容2</div>
            <div class="layui-tab-item">内容3</div>
            <div class="layui-tab-item">内容4</div>
            <div class="layui-tab-item">内容5</div>
        </div>
    </div>

<?php
}

function wyzblog_simple_theme_option_menu()
{
    add_theme_page('主题设置', '主题设置', 'administrator', 'wyzblog_theme_setting', 'theme_function');
}
add_action('admin_menu', 'wyzblog_simple_theme_option_menu');
?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/theme-option.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/layui/css/layui.css" type="text/css" />
<script src="<?php bloginfo('template_url'); ?>/assets/layui/layui.js"></script>
<script>
    layui.use('element', function() {
        var $ = layui.jquery,
            element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
    });
</script>