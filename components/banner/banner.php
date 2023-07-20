<?php

$title = get_sub_field('title');
$text = get_sub_field('text');
$layoutChoice = get_sub_field('layout_choice');
$backgroundChoice = get_sub_field('background_choice');
$backgroundImage = get_sub_field('background_image');
$backgroundVideo = get_sub_field('background_video');

?>

<section class="block banner">
	<div class="inner">
		<div class="inner group">

			<div class="text group">
				<?php if ($title): ?>
					<h1><?php echo $title; ?></h1>
				<?php endif; ?>
				<?php if ($text): ?>
					<?php echo $text; ?>
				<?php endif; ?>
				<?php get_template_part('parts/acf-buttons') ?>
			</div>

			<?php if ($backgroundImage): ?>
				<div class="asset-bg">
					<?php echo wp_get_attachment_image($backgroundImage, 'full'); ?>
				</div>
			<?php endif; ?>

			<?php if ($backgroundVideo): ?> 		
				<video autoplay loop="loop" muted="muted" volume="0">
    			<source src="<?php echo $backgroundVideo ?>" type="video/mp4">
				</video>
			<?php endif; ?>
		</div>
	</div>
</section>
