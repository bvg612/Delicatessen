<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


class OSF_Elementor_WPML {
	/**
	 * OSF_Elementor_WPML constructor.
	 */
	public function __construct() {
		add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {
		$widgets['opal-timeline'] = [
			'conditions'        => [ 'widgetType' => 'opal-timeline' ],
			'integration-class' => 'OSF_Elementor_Timeline_WPML_Widget',
		];

		$widgets['opal-button'] = [
			'conditions' => [ 'widgetType' => 'opal-button' ],
			'fields'     => [
				[
					'field'       => 'text',
					'type'        => __( 'Button: Text', 'opalelementor' ),
					'editor_type' => 'LINE',
				],
			],
		];

		return $widgets;
	}
}
