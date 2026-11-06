<?php

/* The template for displaying the footer */
$custom_logo_id = get_theme_mod( 'custom_logo' );
// No logo set yet (a new site): fall back to the site name.
$image = $custom_logo_id ? wp_get_attachment_image_src( $custom_logo_id , 'full' ) : false;
$text = get_field('text', 'option');

?>

<footer class="region footer">
  <div class="inner">

    <div class="top group">
			<div class="first group">
				<a class="logo" href="<?php echo get_option("siteurl"); ?>">
					<?php if ( $image ) : ?>
						<img src="<?php echo $image[0]; ?>" alt="">
					<?php else : ?>
						<?php bloginfo( 'name' ); ?>
					<?php endif; ?>
				</a>
				<?php if ($text): ?>
					<?php echo $text; ?>
				<?php endif; ?>
			</div>
			<nav class="menu footer" role="menubar">
				<?php ash_footer(); ?>
			</nav>
		</div>

		<div class="bottom group">
			<span>&copy; <?php echo date("Y"); echo " "; echo bloginfo('name'); ?></span>
			<?php
				if( have_rows('social_media', 'option') ):
					echo '<ul class="social">';
					while ( have_rows('social_media', 'option') ) : the_row();
						$socialchannel = get_sub_field('social_channel', 'option');
						$socialurl = get_sub_field('social_url', 'option');
						echo '<li>';
						echo '<a rel="nofollow noopener noreferrer" href="' . $socialurl . '" target="_blank">';
						echo '<i class="fab fa-' . $socialchannel . '" aria-hidden="true"></i>';
						echo '<span class="sr-only hidden">' . ucfirst($socialchannel) . '</span>';
						echo '</a></li>';
					endwhile;
					echo '</ul>';
				endif;
			?>
		</div>
  </div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
