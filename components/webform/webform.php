<?php

$title = get_sub_field('form_title');
$form = get_sub_field('form');
$text = get_sub_field('text');

?>


<section class="block webform">
  <div class="inner">
    <div class="inner group">

      <?php if ($form): ?>
        <?php if ($title): ?>
          <h3>
            <?php echo $title; ?>
        </h3>
        <?php endif; ?>
        <div id="gravity-form" class="form group <?php if ($text): ?>sidebar<?php endif; ?>">
          <?php echo gravity_form( $form, $display_title = false, $display_description = false, $display_inactive = false, $field_values = null, $ajax = false, $tabindex, $echo = true ); ?>
        </div>
      <?php endif; ?>

      <?php if ($text): ?>
        <div class="text group">
          <?php echo $text; ?>
        </div>
      <?php endif; ?>
      
    </div>
  </div>
</section>