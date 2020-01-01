<?php
/* Template Name: 说说/心情 */
get_header();
?>
<div class="layui-col-md9 layui-col-lg9 talkAboutMood">
<?php
query_posts("post_type=TalkAboutMood&post_status=publish&posts_per_page=-1");
if (have_posts()) {
    while (have_posts()) {
        the_post(); ?>
        
            <ul class="layui-timeline">
                <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                    <div class="layui-timeline-content layui-text">
                        <h3 class="layui-timeline-title"><?php the_time('Y年n月j日G:i'); ?></h3>
                        <p>
                            <?php the_content(); ?></p>
                    </div>
                </li>
            </ul>
        
<?php }
} ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>