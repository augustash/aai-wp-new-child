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
			<?php get_template_part('parts/acf-buttons') ?>	
		</div>
	</div>
</section>
