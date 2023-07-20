<?php

$title = get_sub_field('title');
$text = get_sub_field('text');

?>


<section class="block columns">
	<div class="inner">

		<div class="text group">
			<?php if ($title): ?>
				<h3><?php echo $title; ?></h3>
			<?php endif; ?>
			<?php if ($text): ?>
				<?php echo $text; ?>
			<?php endif; ?>
		</div>

		<?php if (have_rows('columns')): ?>
			<div class="columns group">
				<?php while (have_rows('columns')) : the_row(); 
					$columnTitle = get_sub_field('title');
					$columnText = get_sub_field('text');
					$image = get_sub_field('image');
					$imageSize = 'thumbnail';
				?>
					
					<div class="column">
						<?php if ($image) {
								echo wp_get_attachment_image($image, $imageSize);
							}
						?>
						<?php if ($columnTitle): ?>
							<h5><?php echo $columnTitle; ?></h5>
						<?php endif; ?>
						<?php if ($columnText): ?>
							<?php echo $columnText; ?>
						<?php endif; ?>
					</div>

				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
