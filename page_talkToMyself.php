<?php
/* Template Name: 说说/心情 */
get_header();
?>
<meta charset="UTF-8">
<section class="timeline">
	<div class="container">

		<?php
		query_posts("post_type=TalkAboutMood&post_status=publish&posts_per_page=-1");
		if (have_posts()) {
			while (have_posts()) {
				the_post(); ?>
				<div class="timeline-item">
					<div class="timeline-img"></div>
					<div class="timeline-content">

						<div class="date"><?php the_time('Y年n月j日G:i'); ?></div>
						<?php the_content(); ?>
					</div>
				</div>
		<?php }
		} ?>

	</div>
</section>
</div>
</div>
<?php get_footer(); ?>