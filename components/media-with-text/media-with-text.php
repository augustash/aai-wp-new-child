<?php

$title = get_sub_field('title');
$text = get_sub_field('text');
$image = get_sub_field('image');
$imageSize = 'full';
$mediaChoice = get_sub_field('media_choice');
$video = get_sub_field('video');
$layout = get_sub_field('layout');
$containment = get_sub_field('containment');

?>

<section class="block media-with-text <?php echo $layout ?> <?php echo $containment ?>">
	<div class="inner">
		<div class="inner group">

			<div class="text group">
				<?php if ($title): ?>
					<h2><?php echo ($title); ?></h2>
				<?php endif; ?>
				<?php if ($text): ?>
					<?php echo $text; ?>
				<?php endif; ?>
				<?php get_template_part('parts/acf-buttons') ?>
			</div>

			<div class="media group">
				<div class="inner group">
					<?php if ($image) {
							echo wp_get_attachment_image($image, $imageSize);
						}
					?>

					<?php if ($video): ?>
						<button class="modal-trigger" data-modal="modal-<?php echo get_row_index(); ?>">Trigger Modal</button>

						<div id="modal-<?php echo get_row_index(); ?>" class="modal" role="dialog" tabindex="-1" aria-hidden="true">
							<div class="modal-container">
								<div class="modal-inner">
									<?php echo $video; ?>
									<button class="close-modal">Close Modal</button>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>