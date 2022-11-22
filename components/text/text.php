<?php

$title = get_sub_field('title');
$text = get_sub_field('text');
$alignment = get_sub_field('alignment');

?>


<section class="block text <?php echo $alignment; ?>">
	<div class="inner">
		<div class="text group">
			<?php if ($title): ?>
				<h3><?php echo $title; ?></h3>
			<?php endif; ?>
			<?php if ($text): ?>
				<?php echo $text; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
