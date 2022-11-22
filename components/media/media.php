<?php

$title = get_sub_field('title');
$text = get_sub_field('text');
$containment = get_sub_field('containment');
$mediaChoice = get_sub_field('media_choice');
$image = get_sub_field('image');
$imageSize = 'full';
$video = get_sub_field('video');

?>

<section class="block media <?php echo $containment ?>">
	<div class="inner">
		<div class="inner group">

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

