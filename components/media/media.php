<?php

/* Block Name: Hero Block */

$title = get_sub_field('title');
$text = get_sub_field('text');
$layoutChoice = get_sub_field('layout_choice');
$backgroundChoice = get_sub_field('background_choice');
$foregroundImage = get_sub_field('foreground_image');
$backgroundImage = get_sub_field('background_image');
$backgroundVideo = get_sub_field('background_video');
$youtubeID = get_sub_field('youtube_id');
$overlay = get_sub_field('overlay');

?>

<section class="block hero">
	<div class="inner">
		<div class="inner group">

			<div class="text group">
				<?php if ($title): ?>
					<h1><?php echo $title; ?></h1>
				<?php endif; ?>
				<?php if ($text): ?>
					<?php echo $text; ?>
				<?php endif; ?>

				<?php if (have_rows('button')) : ?>
					<div class="links">
						<?php while (have_rows('button')) : the_row(); ?>
							<?php
								$link = get_sub_field('button');
								if ($link):
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
									?>
								<a class="button <?php if (get_sub_field('button_style') == 'primary') : ?>primary<?php endif; ?><?php if (get_sub_field('button_style') == 'secondary') : ?>secondary<?php endif; ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
							<?php endif; ?>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if ($backgroundImage): ?>
				<div class="asset-bg" style="background: url('<?php echo $backgroundImage; ?>'); background-size: cover; background-repeat: no-repeat"></div>
			<?php endif; ?>

			<?php if ($foregroundImage): ?>
				<div class="media group">
					<div class="media-container">
						<?php
						$size = 'rectangle-large';
							if ($foregroundImage) {
								echo wp_get_attachment_image($foregroundImage, $size);
							}
						?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($backgroundVideo): ?> 		
				<?php
					$iframe = $backgroundVideo;
					preg_match('/src="(.+?)"/', $iframe, $matches);
					$src = $matches[1];
					$params = array(
						'controls'		    => 0,
						'hd'			        => 1,
						'autohide'		    => 1,
						'autoplay'		    => 1,
						'fs'			        => 1,
						'mute'			      => 1,
						'loop'			      => 1,
						'modestbranding'  => 1,
						'iv_load_policy'  => 3,
						'playlist'        => $youtubeID,
					);
					$new_src = add_query_arg($params, $src);
					$iframe = str_replace($src, $new_src, $iframe);
					$attributes = 'frameborder="0"';
					$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
					echo '<div class="video-bg">', $iframe, '</div>';
				?>
			<?php endif; ?>

		</div>
	</div>
</section>


