<?php

use WPML_Elementor_Module_With_Items;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // No access of directly access

class OSF_Elementor_Timeline_WPML_Widget extends WPML_Elementor_Module_With_Items {

	/**
	 * Get widget field name.
	 *
	 * @return string
	 */
	public function get_items_field() {
		return 'timelines';
	}

	/**
	 * Get the fields inside the repeater.
	 *
	 * @return array
	 */
	public function get_fields() {
		return [
			'date',
			'heading',
			'description',
		];
	}

	/**
	 * @param string $field
	 *
	 * Get the field title string
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'date':
				return __( 'Timeline: Date', 'opalelementor' );

			case 'heading':
				return __( 'Timeline: Heading', 'opalelementor' );

			case 'description':
				return __( 'Timeline: Description', 'opalelementor' );

			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 *
	 * Get perspective field types.
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'date':
				return 'LINE';

			case 'heading':
				return 'LINE';

			case 'description':
				return 'VISUAL';

			default:
				return '';
		}
	}
}
