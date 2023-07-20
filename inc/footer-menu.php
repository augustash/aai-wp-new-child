<?php
/**
 * Register Footer Menu
 */

register_nav_menus(
	array(
		'footer' => esc_html__( 'Footer', 'ash' ),
	)
);

/* Footer navigation */
if ( ! function_exists( 'ash_footer' ) ) {
	function ash_footer() {
		wp_nav_menu(
			array(
				'container'      => false,
				'menu'           => __( 'footer', 'ash' ),
				'menu_class'     => 'footer menu',
				'items_wrap'     => '<ul>%3$s</ul>',
				'theme_location' => 'footer',
				'depth'          => 3,
				'fallback_cb'    => false,
			)
		);
	}
}
