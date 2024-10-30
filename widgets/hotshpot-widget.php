<?php



// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class WttHotspotBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'wtt-hotspot-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Hotspot Block', 'wtt-hotspots');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-image-hotspot';
    }

    /** Category */
    public function get_categories() {
        return ['wtt-hotspots'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'items', [
            'label' => esc_html__('Items', 'wtt-hotspots'),
                ]
        );

        $this->add_control(
            'image',
            array(
                'label'     => esc_html__( 'Image', 'wtt-hotspots' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            array(
                'name'      => 'image_resolution',
                'default'   => 'full',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'enable',
            [
                'label'        => esc_html__( 'Enable', 'wtt-hotspots' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'wtt-hotspots' ),
                'label_off'    => esc_html__( 'No', 'wtt-hotspots' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater->add_control(
            'title', [
                'label' => __( 'Title', 'wtt-hotspots' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'hotspot_type',
            [
                'label' => __( 'Hotspot Type', 'wtt-hotspots' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon'  => __( 'Icon', 'wtt-hotspots' ),
                    'image' => __( 'Image', 'wtt-hotspots' ),
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'hotspot_icon',
            [
                'label' => __( 'Hotspot Icon', 'wtt-hotspots' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'icon_target',
                    'library' => 'solid',
                ],
                'condition' => [ 'hotspot_type' => 'icon' ]
            ]  
        );

        $repeater->add_control(
            'hotspot_image',
            [
                'label' => __( 'Hotspot Image', 'wtt-hotspots' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [ 'hotspot_type' => 'image' ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            array(
                'name'      => 'hotspot_img_resolution',
                'default'   => 'thumb',
                'condition' => [ 'hotspot_type' => 'image' ]
            )
        );

        $repeater->add_control(
            'text_align',
            [
                'label' => __( 'Alignment', 'wtt-hotspots' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'left'      => esc_html__( 'Left', 'wtt-hotspots' ),
                    'center'    => esc_html__( 'Center', 'wtt-hotspots' ),
                    'right'     => esc_html__( 'Right', 'wtt-hotspots' ),
                ],
                'default' => 'left'
            ]
        );

        $repeater->add_control(
            'x_position',
            [
                'label' => esc_html__( 'X Postion', 'wtt-hotspots' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-icon{{CURRENT_ITEM}},
                     {{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-image{{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_control(
            'y_position',
            [
                'label' => esc_html__( 'Y Postion', 'wtt-hotspots' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-icon{{CURRENT_ITEM}},
                     {{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-image{{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_control(
            'each_content_width',
            [
                'label' => esc_html__( 'Each Content Width', 'wtt-hotspots' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 300,
                    'unit' => 's',
                ],
                'range' => [
                    's' => [
                        'min' => 0,
                        'max' => 1000,
                        'step'=> 1
                    ],
                ]
            ]
        );

        $repeater->add_control(
            'content_type',
            [
                'label' => __( 'Content Type', 'wtt-hotspots' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'text_title_desc',
                'options' => [
                    'text_title_desc'  => __( 'Title & Description', 'wtt-hotspots' ),
                    'wisiwyg' => __( 'WISIWYG', 'wtt-hotspots' ),
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'hotspot_title', [
                'label' => __( 'Hotspot Title', 'wtt-hotspots' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Title', 'wtt-hotspots' ),
                'condition' => [ 'content_type' => 'text_title_desc' ]
            ]
        );

        $repeater->add_control(
            'hotspot_description',
            [
                'label' => __( 'Description', 'wtt-hotspots' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'wtt-hotspots' ),
                'placeholder' => __( 'Type your description here', 'wtt-hotspots' ),
                'condition' => [ 'content_type' => 'text_title_desc' ]
            ]
        );

        $repeater->add_control(
            'wisiwyg_content',
            [
                'label' => __( 'WISIWYG', 'wtt-hotspots' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'placeholder' => __( 'Add your content here', 'wtt-hotspots' ),
                'condition' => [ 'content_type' => 'wisiwyg' ]
            ]
        );

        $this->add_control(
            'hotspot_items',
            [
                'label' => __( 'Items', 'wtt-hotspots' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __( 'Item #1', 'wtt-hotspots' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'general_settings', [
            'label' => esc_html__('General Settings', 'wtt-hotspots'),
                ]
        );

        $this->add_control(
            'content_open_type',
            [
                'label' => __( 'Content Open Type', 'wtt-hotspots' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'wttd-open-onhover',
                'options' => [
                    'wttd-open-onclick'  => __( 'On Click', 'wtt-hotspots' ),
                    'wttd-open-onhover' => __( 'On Hover', 'wtt-hotspots' ),
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'enable_pulse_animation',
            [
                'label' => esc_html__( 'Pulse Animation', 'wtt-hotspots' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'wtt-hotspots' ),
                'label_off' => esc_html__( 'No', 'wtt-hotspots' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
                'pulse_color', [
            'label' => esc_html__('Pulse Color', 'wtt-hotspots'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-icon a .pulse,
                 {{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-image a .pulse' => 'border: 5px solid {{VALUE}}',
            ],
            'condition' => [ 'enable_pulse_animation' => 'yes' ]
                ]
        );

        $this->add_control(
            'pulse_duration',
            [
                'label' => esc_html__( 'Pulse Duration(in ms)', 'wtt-hotspots' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 600,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-icon a .pulse,
                     {{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-image a .pulse' => 'animation: pulsate {{SIZE}}ms infinite;',
                ],
                'condition' => [ 'enable_pulse_animation' => 'yes' ]
            ]
        );

        $this->add_control(
            'pulse_size',
            [
                'label' => esc_html__( 'Pulse Size', 'wtt-hotspots' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 80,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-icon a .pulse,
                     {{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-image a .pulse' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [ 'enable_pulse_animation' => 'yes' ]
            ]
        );

        $this->add_control(
            'tooltip_position',
            [
                'label' => __( 'Tooltip Position', 'wtt-hotspots' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'bottom-middle',
                'options' => [
                    'left-middle' => __( 'Left Middle', 'wtt-hotspots' ),
                    'right-middle' => __( 'Right Middle', 'wtt-hotspots' ),
                    'top-left' => __( 'Top Left', 'wtt-hotspots' ),
                    'top-middle' => __( 'Top Middle', 'wtt-hotspots' ),
                    'top-right' => __( 'Top Right', 'wtt-hotspots' ),
                    'bottom-left' => __( 'Bottom Left', 'wtt-hotspots' ),
                    'bottom-middle' => __( 'Bottom Middle', 'wtt-hotspots' ),
                    'bottom-right' => __( 'Bottom Right', 'wtt-hotspots' ),
                    'center' =>  __( 'Center', 'wtt-hotspots' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'icon_style', [
            'label' => esc_html__('Icon', 'wtt-hotspots'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'icon_bg_color', [
            'label' => esc_html__('Background Color', 'wtt-hotspots'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-icon a,
                {{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-image a' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'icon_color', [
            'label' => esc_html__('Color', 'wtt-hotspots'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-icon a i' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_responsive_control(
                'icon_size', [
            'label' => __('Icon Size', 'wtt-hotspots'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 8,
                    'max' => 18,
                    'step' => 1,
                ]
            ],
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'desktop_default' => [
                'unit' => 'px',
                'size' => 12,
            ],
            'tablet_default' => [
                'unit' => 'px',
                'size' => 12,
            ],
            'mobile_default' => [
                'unit' => 'px',
                'size' => 12,
            ],
            'selectors' => [
                '(desktop){{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-icon a i' => 'font-size: {{SIZE}}{{UNIT}};',
                '(tablet){{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-icon a i' => 'font-size: {{SIZE}}{{UNIT}};',
                '(mobile){{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-icon a i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'icon_box_size', [
            'label' => __('Container Size', 'wtt-hotspots'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 8,
                    'max' => 18,
                    'step' => 1,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-icon a' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};'
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'image_icon_style', [
            'label' => esc_html__('Image', 'wtt-hotspots'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'image_icon_bg_color', [
            'label' => esc_html__('Background Color', 'wtt-hotspots'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => 'transparent',
            'selectors' => [
                '{{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-image a' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_icon_border',
                'label' => __( 'Border', 'wtt-hotspots' ),
                'selector' => '{{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-image a img',
            ]
        );

        $this->add_responsive_control(
                'image_icon_size', [
            'label' => __('Image Icon Size', 'wtt-hotspots'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 80,
                    'step' => 1,
                ]
            ],
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'desktop_default' => [
                'unit' => 'px',
                'size' => 25,
            ],
            'tablet_default' => [
                'unit' => 'px',
                'size' => 25,
            ],
            'mobile_default' => [
                'unit' => 'px',
                'size' => 25,
            ],
            'selectors' => [
                '(desktop){{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-image a' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}}',
                '(tablet){{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-image a' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}}',
                '(mobile){{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-image a' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}}',
            ],
                ]
        );

        $this->add_control(
                'image_box_size', [
            'label' => __('Container Size', 'wtt-hotspots'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 8,
                    'max' => 18,
                    'step' => 1,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .wttd-hotspot-section .wttd-hotspot-image a' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};'
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'tooltip_style', [
            'label' => esc_html__('Tooltip', 'wtt-hotspots'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'tooltip_bg_color', [
            'label' => esc_html__('Background Color', 'wtt-hotspots'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#f1f0e4',
            'selectors' => [
                '{{WRAPPER}} .wttd-each-spot-content' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tooltip_border',
                'label' => __( 'Border', 'wtt-hotspots' ),
                'selector' => '{{WRAPPER}} .wttd-each-spot-content',
            ]
        );

        $this->add_control(
                'tooltip_margin', [
            'label' => esc_html__('Margin', 'wtt-hotspots'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .wttd-each-spot-content' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->add_control(
                'tooltip_padding', [
            'label' => esc_html__('Padding', 'wtt-hotspots'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .wttd-each-spot-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'title_style', [
            'label' => esc_html__('Title', 'wtt-hotspots'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Color', 'wtt-hotspots'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .wttd-each-spot-content h2' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .wttd-each-spot-content h2',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'wtt-hotspots'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .wttd-each-spot-content h2' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'description_style', [
            'label' => esc_html__('Description', 'wtt-hotspots'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'description_color', [
            'label' => esc_html__('Color', 'wtt-hotspots'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#909090',
            'selectors' => [
                '{{WRAPPER}} .wttd-each-spot-content p.wttd-spot-description' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .wttd-each-spot-content p.wttd-spot-description',
                ]
        );

        $this->add_control(
                'description_margin', [
            'label' => esc_html__('Margin', 'wtt-hotspots'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .wttd-each-spot-content p.wttd-spot-description' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        // pr($settings);die();
        ?>
        <div class="wttd-hotspot-main-wrapper">
            <div class="wttd-hotspot-inner-wrap">
                <?php if( isset($settings['hotspot_items']) && !empty($settings['hotspot_items']) ) { ?>
                    <div class="wttd-hotspot-section <?php echo esc_attr($settings['content_open_type']); ?>">

                        <?php  
                        if(!$settings['image']['id']) {
                            $image_url = \Elementor\Utils::get_placeholder_image_src();
                            echo "<img src='". esc_url($image_url) ."' width='800'>";
                        } else {
                            echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'image_resolution', 'image');
                        }
                        ?>

                        <?php foreach ( $settings['hotspot_items'] as $key => $item ) { ?>

                            <?php if($item['enable'] != 'yes') { continue; } ?>

                            <?php 
                            if( $item['hotspot_type'] == 'icon' ) { 
                                ?>
                                <div class="wttd-hotspot-item wttd-hotspot-icon elementor-repeater-item-<?php echo esc_attr( $item['_id'] );?> drag_element" id=<?php echo 'hotspot_id_'.$key; ?>>
                                    <a id='hover-txt' href="javascript:void(0);">
                                        <?php 
                                        $this->pulsate_animation(); 
                                        \Elementor\Icons_Manager::render_icon($item['hotspot_icon'], ['aria-hidden' => 'true']); 
                                        $this->get_content( $key ); ?>
                                    </a>
                                </div>
                            <?php 
                            } else if( $item['hotspot_type'] == 'image' ) { 
                                if( !$item['hotspot_image']['id'] ) {
                                    $hotspot_image_url = \Elementor\Utils::get_placeholder_image_src();
                                    echo "<div class='wttd-hotspot-item wttd-hotspot-image elementor-repeater-item-" .esc_attr( $item['_id'] ). "'>";
                                    echo '<a href="javascript:void(0);">';
                                    $this->pulsate_animation();
                                    echo "<img src='" .esc_url($hotspot_image_url). "'>";
                                    $this->get_content( $key );
                                    echo "</a>";
                                    echo "</div>";
                                } else {
                                    $hotspot_image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($item['hotspot_image']['id'], 'hotspot_img_resolution', $item);
                                    echo "<div class='wttd-hotspot-item wttd-hotspot-image elementor-repeater-item-" .esc_attr( $item['_id'] ). "'>";
                                    echo '<a href="javascript:void(0);">';
                                    $this->pulsate_animation();
                                    echo "<img src='" .esc_url($hotspot_image_url). "'>";
                                    $this->get_content( $key );
                                    echo "</a>";
                                    echo "</div>";
                                } 
                            } 
                            ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

    protected function pulsate_animation() {
        $settings = $this->get_settings_for_display();
        if($settings['enable_pulse_animation'] == 'yes') {
            echo '<div class="pulse"></div>';
        }
    }

    protected function get_content( $key ) {
        $settings = $this->get_settings_for_display();
        $item = $settings['hotspot_items'][$key];
        $align = $settings['hotspot_items'][$key]['text_align'];
        ?>
        <div class="wttd-each-spot-content <?php echo 'wttd-align-'.$align; ?> <?php echo $settings['tooltip_position']; ?>" style="width: <?php echo $item['each_content_width']['size'].'px'; ?>">

            <?php if( $item['content_type'] == 'text_title_desc' ) { ?>

                <?php if( !empty( $item['hotspot_title']) ) { ?>
                    <h2><?php echo esc_html( $item['hotspot_title'] ); ?></h2>
                <?php } ?>

                <?php if( !empty($item['hotspot_subtitle']) ) { ?>
                    <p class="wttd-spot-subtitle"><?php echo esc_html($item['hotspot_subtitle']); ?></p>
                <?php } ?>

                <?php if( !empty( $item['hotspot_description'] ) ) { ?>
                    <p class="wttd-spot-description"><?php echo esc_html($item['hotspot_description']); ?></p>
                <?php } ?>

            <?php } else if( $item['content_type'] == 'wisiwyg' ) { 
                echo do_shortcode($item['wisiwyg_content']);
            } ?>
        </div>
        <?php
    }


}
