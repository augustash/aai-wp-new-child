<?php

/* Block Name: Text */

$align = get_sub_field('align');
$title = get_sub_field('title');
$text = get_sub_field('text');

?>


<section class="block text <?php echo $align; ?>">
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
