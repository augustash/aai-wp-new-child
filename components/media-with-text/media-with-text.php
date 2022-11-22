<?php

$title = get_sub_field('title');
$text = get_sub_field('text');
$image = get_sub_field('image');
$imageSize = 'thumbnail';
$mediaChoice = get_sub_field('media_choice');
$video = get_sub_field('video');
$layout = get_sub_field('layout');
?>

<section class="block media-with-text <?php echo $layout ?>">
	<div class="inner">
		<div class="inner group">
			
			<div class="text group">
				<?php if ($title): ?>
					<h2><?php echo ($title); ?></h2>
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
									if ($link) :
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

			<div class="media group">
				<div class="inner group">
					<?php if ($image) {
							echo wp_get_attachment_image($image, $imageSize);
						}
					?>

					<?php if ($mediaChoice == 'video') : ?>

						<button class="modal-trigger play-button" data-modal="modal-<?php echo get_row_index(); ?>">
							<span></span>
						</button>

						<?php if ($video): ?>
							<div id="modal-<?php echo get_row_index(); ?>" class="modal" role="dialog" tabindex="-1" aria-hidden="true">
								<div class="modal-container">
									<div class="modal-inner">
										<?php echo $video; ?>
										<button class="close-modal">Close Modal</button>
									</div>
								</div>
							</div>
						<?php endif; ?>

					<?php endif; ?>
				</div>
			</div>

		</div>
	</div>
</section>