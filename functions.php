<?php

add_action( 'wp_enqueue_scripts', 'wilder_add_google_fonts' );
add_action( 'wp_enqueue_scripts', 'wilder_enqueue_styles' );

function wilder_enqueue_styles() {
  $parent_style = 'storefront-style';

  wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
}

function wilder_add_google_fonts() {
  wp_enqueue_style( 'wilder-google-fonts', 'https://fonts.googleapis.com/css?family=Cormorant|Playfair+Display:900i|Raleway:400,700&display=swap', false ); 
}

if ( ! function_exists( 'storefront_credit' ) ) {
	/**
	 * Display the theme credit
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_credit() {
		$links_output = '';

		if ( apply_filters( 'storefront_credit_link', true ) ) {
			$links_output .= '<a href="https://lupecamacho.com" target="_blank">' . esc_html__( '&#9758; Site by Lupe Camacho &#9756;', 'storefront' ) . '</a>';
		}

		if ( apply_filters( 'storefront_privacy_policy_link', true ) && function_exists( 'the_privacy_policy_link' ) ) {
			$separator = '<span role="separator" aria-hidden="true"></span>';
			$links_output = get_the_privacy_policy_link( '', ( ! empty( $links_output ) ? $separator : '' ) ) . $links_output;
		}
		
		$links_output = apply_filters( 'storefront_credit_links_output', $links_output );
		?>
		<div class="site-info">
			<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>

			<?php if ( ! empty( $links_output ) ) { ?>
				<br />
				<?php echo wp_kses_post( $links_output ); ?>
			<?php } ?>
		</div><!-- .site-info -->
		<?php
	}
}