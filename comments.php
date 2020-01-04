<?php
//自定义评论列表
if (post_password_required())
    return;
?>
<div id="comments" class="comments">
    <meta content="UserComments:<?php echo number_format_i18n(get_comments_number()); ?>" itemprop="interactionCount">

    <ol class="commentlist comment-list">
        <h3 class="comments-title">共&nbsp;<b><span class="commentCount"><?php echo number_format_i18n(get_comments_number()); ?></span></b> 条评论</h3>
        <?php
        wp_list_comments(array('callback' => 'wyzblog_comment_new'));
        ?>
    </ol>
    <nav class="navigation comment-navigation u-textAlignCenter" data-fuck="<?php the_ID(); ?>">
        <?php paginate_comments_links(array('prev_next' => true)); ?>
    </nav>
    <div id='respond' class='comment-respond'>
        <?php if (comments_open()) : ?>
            <h3>发表评论
                <?php comment_form_title('', '回复 %s'); ?>               
                <?php echo get_cancel_comment_reply_link_wyzblog('取消回复'); ?>
            </h3>
            <?php if (get_option('comment_registration') && !$user_ID) : ?>
                <p>你必须 <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">登陆</a> 后才能发表评论.</p>
            <?php else : ?>
                <!-- 提交回复表单 -->
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="comment-form" id="commentform">
                    <?php if ($user_ID) : ?>
                        <p class="warning-text" style="margin-bottom:10px">以
                            <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>身份登录&nbsp;|&nbsp;
                            <a class="link-logout" href="<?php echo wp_logout_url(get_permalink()); ?>">注销 &raquo;</a>
                        </p>
                        <div class="layui-form-item">
                            <textarea class='layui-textarea' rows="3" id="comment" onkeydown="if(event.ctrlKey&&event.keyCode==13){
                            document.getElementById('submit').click();return false};" placeholder="" class='layui-input' tabindex="1" name="comment">
                            </textarea>
                        </div>
                    <?php else : ?>

                        <div class="layui-form-item layui-row layui-col-space5">
                            <div class="layui-form-item">
                                <textarea class='layui-textarea' rows="3" id="comment" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};" tabindex="1" name="comment"></textarea>
                            </div>
                            <div class="layui-col-md4">
                                <label id="author_name" for="author">
                                    <input id="author" type="text" class='layui-input' tabindex="2" value="<?php echo $comment_author; ?>" name="author" placeholder="昵称[必填]" required>
                                </label>
                            </div>
                            <div class="layui-col-md4">
                                <label id="author_email" for="email">
                                    <input id="email" type="text" class='layui-input' tabindex="3" value="<?php echo $comment_author_email; ?>" name="email" placeholder="Email地址[必填]" required>
                                </label>
                            </div>
                            <div class="layui-col-md4">
                                <label id="author_website" for="url">
                                    <input id="url" type="text" class='layui-input' tabindex="4" placeholder="网站URL[选填]" value="<?php echo $comment_author_url; ?>" name="url">
                                </label>
                            </div>
                        </div>


                    <?php endif; ?>
                    <div class="btn-group commentBtn" role="group">
                        <input name="submit" type="submit" id="submit" class="layui-btn layui-btn-normal" tabindex="5" value="发表评论" /></div>
                    <?php comment_id_fields(); ?>
                </form>

            <?php endif; ?>

        <?php endif; ?>
    </div>
</div>