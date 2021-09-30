<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
/**
 * Elementor image carousel widget.
 *
 * Elementor widget that displays a set of images in a rotating carousel or
 * slider.
 *
 * @since 1.0.0
 */
class OSF_Elementor_Brand_Widget extends Widget_Base {

	public function get_categories() {
		return array('opal-addons');
	}
	/**
	 * Get widget name.
	 *
	 * Retrieve image carousel widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'opal-brand';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image carousel widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Opal Brands', 'opalelementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image carousel widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-slider-push';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'image', 'photo', 'visual', 'carousel', 'slider' , 'brand' ];
	}

	/**
	 * Retrieve the list of scripts the image carousel widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'jquery-slick' ];
	}

	/**
	 * Register image carousel widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_image_carousel',
			[
				'label' => __( 'Brand Carousel', 'opalelementor' ),
			]
		);

		$this->add_control(
			'brands',
			[
				'label' => __( 'Brand Items', 'opalelementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'brand_title',
						'label' => __( 'Brand name', 'opalelementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'Brand Name', 'opalelementor' ),
						'placeholder' => __( 'Brand Name', 'opalelementor' ),
						'label_block' => true,
					],
					[
						'name' => 'brand_image',
						'label' => __( 'Choose Image', 'opalelementor' ),
						'type' => Controls_Manager::MEDIA,
						'dynamic' => [
							'active' => true,
						],
						'default' => [
							'url' => Elementor\Utils::get_placeholder_image_src(),
						],
					],
					[
						'name' => 'link',
						'label' => __( 'Link to', 'opalelementor' ),
						'type' => Controls_Manager::URL,
						'dynamic' => [
							'active' => true,
						],
						'placeholder' => __( 'https://your-link.com', 'opalelementor' ),
					]
				],
				'title_field' => '{{{ brand_title }}}',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'separator' => 'none',
			]
		);

		$slides_to_show = range( 1, 10 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label' => __( 'Slides to Show', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					             '' => __( 'Default', 'opalelementor' ),
				             ] + $slides_to_show,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'slides_to_scroll',
			[
				'label' => __( 'Slides to Scroll', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'description' => __( 'Set how many slides are scrolled per swipe.', 'opalelementor' ),
				'default' => '2',
				'options' => $slides_to_show,
				'condition' => [
					'slides_to_show!' => '1',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'image_stretch',
			[
				'label' => __( 'Image Stretch', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no' => __( 'No', 'opalelementor' ),
					'yes' => __( 'Yes', 'opalelementor' ),
				],
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => __( 'Arrows and Dots', 'opalelementor' ),
					'arrows' => __( 'Arrows', 'opalelementor' ),
					'dots' => __( 'Dots', 'opalelementor' ),
					'none' => __( 'None', 'opalelementor' ),
				],
				'frontend_available' => true,
			]
		);



		$this->add_control(
			'open_lightbox',
			[
				'label' => __( 'Lightbox', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'opalelementor' ),
					'yes' => __( 'Yes', 'opalelementor' ),
					'no' => __( 'No', 'opalelementor' ),
				],
				'condition' => [
					'link_to' => 'file',
				],
			]
		);

		$this->add_control(
			'caption_type',
			[
				'label' => __( 'Caption', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'opalelementor' ),
					'title' => __( 'Title', 'opalelementor' ),
					'caption' => __( 'Caption', 'opalelementor' ),
					'description' => __( 'Description', 'opalelementor' ),
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'opalelementor' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __( 'Additional Options', 'opalelementor' ),
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'Pause on Hover', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'opalelementor' ),
					'no' => __( 'No', 'opalelementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'opalelementor' ),
					'no' => __( 'No', 'opalelementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'opalelementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => __( 'Infinite Loop', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'opalelementor' ),
					'no' => __( 'No', 'opalelementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'effect',
			[
				'label' => __( 'Effect', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'opalelementor' ),
					'fade' => __( 'Fade', 'opalelementor' ),
				],
				'condition' => [
					'slides_to_show' => '1',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => __( 'Animation Speed', 'opalelementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'direction',
			[
				'label' => __( 'Direction', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => [
					'ltr' => __( 'Left', 'opalelementor' ),
					'rtl' => __( 'Right', 'opalelementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' => __( 'Navigation', 'opalelementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label' => __( 'Arrows', 'opalelementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label' => __( 'Position', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'inside' => __( 'Inside', 'opalelementor' ),
					'outside' => __( 'Outside', 'opalelementor' ),
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label' => __( 'Size', 'opalelementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-brands .slick-slider .slick-prev:before, {{WRAPPER}} .elementor-brands .slick-slider .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label' => __( 'Color', 'opalelementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-brands .slick-slider .slick-prev:before, {{WRAPPER}} .elementor-brands .slick-slider .slick-next:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_dots',
			[
				'label' => __( 'Dots', 'opalelementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label' => __( 'Position', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'outside',
				'options' => [
					'outside' => __( 'Outside', 'opalelementor' ),
					'inside' => __( 'Inside', 'opalelementor' ),
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label' => __( 'Size', 'opalelementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-brands .elementor-image-carousel .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label' => __( 'Color', 'opalelementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-brands .elementor-image-carousel .slick-dots li button:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'opalelementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_spacing',
			[
				'label' => __( 'Spacing', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'opalelementor' ),
					'custom' => __( 'Custom', 'opalelementor' ),
				],
				'default' => '',
				'condition' => [
					'slides_to_show!' => '1',
				],
			]
		);

		$this->add_control(
			'image_spacing_custom',
			[
				'label' => __( 'Image Spacing', 'opalelementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
				],
				'show_label' => false,
				'selectors' => [
					'{{WRAPPER}} .slick-list' => 'margin-left: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .slick-slide .slick-slide-inner' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_spacing' => 'custom',
					'slides_to_show!' => '1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .elementor-brands .elementor-image-carousel .slick-slide-image',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'opalelementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-brands .elementor-image-carousel .slick-slide-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_caption',
			[
				'label' => __( 'Caption', 'opalelementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_type!' => '',
				],
			]
		);

		$this->add_control(
			'caption_align',
			[
				'label' => __( 'Alignment', 'opalelementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'opalelementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'opalelementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'opalelementor' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'opalelementor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-carousel-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'caption_text_color',
			[
				'label' => __( 'Text Color', 'opalelementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-carousel-caption' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'selector' => '{{WRAPPER}} .elementor-image-carousel-caption',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render image carousel widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['brands'] ) ) {
			return;
		}

		//  echo '<pre>' . print_r( $settings ,1 ); die;
		$slides = [];


		foreach ( $settings['brands'] as $index => $item ) {

			$attachment = $item['brand_image'];
			$image_url = Group_Control_Image_Size::get_attachment_image_src( $attachment['id'], 'thumbnail', $settings );



			$image_html = '<img class="slick-slide-image" src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( $item['brand_title'] ) . '" />';


			//  $link = $this->get_link_url( $item, $settings );
			$link = $item['link'];
			if ( $link ) {
				$link_key = 'link_' . $index;

				$this->add_render_attribute( $link_key, [
					'href' => $link['url'],
					'data-elementor-open-lightbox' => $settings['open_lightbox'],
					'data-elementor-lightbox-slideshow' => $this->get_id(),
					'data-elementor-lightbox-index' => $index,
				] );

				if ( Plugin::$instance->editor->is_edit_mode() ) {
					$this->add_render_attribute( $link_key, [
						'class' => 'elementor-clickable',
					] );
				}

				if ( ! empty( $link['is_external'] ) ) {
					$this->add_render_attribute( $link_key, 'target', '_blank' );
				}

				if ( ! empty( $link['nofollow'] ) ) {
					$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
				}

				$image_html = '<a ' . $this->get_render_attribute_string( $link_key ) . '>' . $image_html . '</a>';
			}

			$image_caption = $this->get_image_caption( $attachment );

			$slide_html = '<div class="slick-slide"><figure class="slick-slide-inner">' . $image_html;

			if ( ! empty( $image_caption ) ) {
				$slide_html .= '<figcaption class="elementor-image-carousel-caption">' . $image_caption . '</figcaption>';
			}

			$slide_html .= '</figure></div>';

			$slides[] = $slide_html;

		}

		if ( empty( $slides ) ) {
			return;
		}


		$this->add_render_attribute( 'carousel', 'class', 'elementor-image-carousel' );

		if ( 'none' !== $settings['navigation'] ) {
			if ( 'dots' !== $settings['navigation'] ) {
				$this->add_render_attribute( 'carousel', 'class', 'slick-arrows-' . $settings['arrows_position'] );
			}

			if ( 'arrows' !== $settings['navigation'] ) {
				$this->add_render_attribute( 'carousel', 'class', 'slick-dots-' . $settings['dots_position'] );
			}
		}

		if ( 'yes' === $settings['image_stretch'] ) {
			$this->add_render_attribute( 'carousel', 'class', 'slick-image-stretch' );
		}

		$data = [
			"slides_to_show"    =>$settings['slides_to_show'],
			"slides_to_scroll" => $settings['slides_to_scroll'],
			"navigation"       => $settings['navigation'],
			"pause_on_hover"   => $settings['pause_on_hover'],
			"autoplay"         => $settings['autoplay'],
			"autoplay_speed"   => $settings['autoplay_speed'],
			"infinite"         => $settings['infinite'],
			"speed"            => $settings['speed'],
			"direction"        => $settings['direction']
		];

		$data = wp_json_encode($data);
		$this->add_render_attribute( 'wrapper', 'data-settings', $data );

		?>

        <div class="elementor-brands elementor-slick-slider elementor-opal-slick-slider"  <?php echo $this->get_render_attribute_string( 'wrapper' ); ?> dir="<?php echo $settings['direction']; ?>">
            <div <?php echo $this->get_render_attribute_string( 'carousel' ); ?>>
				<?php echo implode( '', $slides ); ?>
            </div>
        </div>

		<?php
	}

	/**
	 * Retrieve image carousel link URL.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array $attachment
	 * @param object $instance
	 *
	 * @return array|string|false An array/string containing the attachment URL, or false if no link.
	 */
	private function get_link_url( $attachment, $instance ) {
		if ( 'none' === $instance['link_to'] ) {
			return false;
		}

		if ( 'custom' === $instance['link_to'] ) {
			if ( empty( $instance['link']['url'] ) ) {
				return false;
			}

			return $instance['link'];
		}

		return [
			'url' => wp_get_attachment_url( $attachment['id'] ),
		];
	}

	/**
	 * Retrieve image carousel caption.
	 *
	 * @since 1.2.0
	 * @access private
	 *
	 * @param array $attachment
	 *
	 * @return string The caption of the image.
	 */
	private function get_image_caption( $attachment ) {
		$caption_type = $this->get_settings_for_display( 'caption_type' );

		if ( empty( $caption_type ) ) {
			return '';
		}

		$attachment_post = get_post( $attachment['id'] );

		if ( 'caption' === $caption_type ) {
			return $attachment_post->post_excerpt;
		}

		if ( 'title' === $caption_type ) {
			return $attachment_post->post_title;
		}

		return $attachment_post->post_content;
	}
}
