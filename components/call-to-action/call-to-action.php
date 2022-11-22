<?php

$title = get_sub_field('title');
$text = get_sub_field('text');

?>

<section class="block call-to-action">
	<div class="inner">
		<div class="inner group">
			<?php if ($title): ?>
				<h3><?php echo $title; ?></h3>
			<?php endif; ?>

			<?php if ($text): ?>
				<?php echo $text; ?>
			<?php endif; ?>
			
			<?php if (have_rows('button')) : ?>
				<div class="links">
					<?php while (have_rows('button')) : the_row(); ?>
						<?php
							$link = get_sub_field('button');
							$button_style = get_sub_field('button_style');
							if ($link):
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
							<a class="button <?php echo $button_style ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
								<?php echo esc_html($link_title); ?>
							</a>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
