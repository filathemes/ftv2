<?php
namespace FilaThemes\Widgets;
use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
use  Elementor\Utils ;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class FT_Element_Features extends Widget_Base {
	public function get_name() {
		return 'ft-features';
	}
	public function get_title() {
		return __( 'Features', 'filathemes' );
	}
	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'fa fa-cube';
	}
	public function get_categories() {
		return [ 'ft-elements' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Features', 'filathemes' ),
			]
		);

		$this->add_control(
			'feature_main_title',
			[
				'label' => __( 'Main Title', 'filathemes' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => ''
			]
		);

		$this->add_control(
			'feature_item',
			[
				'label' => __( 'Feature Item', 'filathemes' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [],
				'fields' => [
					[
						'name' => 'feature_image',
						'label' => __( 'Image', 'filathemes' ),
						'type' => Controls_Manager::MEDIA,
						'default' => '',
						'label_block' => true,
                    ],
                    [
						'name' => 'enable_lightbox',
						'label' => __( 'Enable Lightbox', 'filathemes' ),
						'type' => Controls_Manager::SWITCHER,
						'label_on' => __( 'Show', 'filathemes' ),
                        'label_off' => __( 'Hide', 'filathemes' ),
                        'return_value' => 'yes',
                        'default' => '',
						'label_block' => true,
                    ],

                    [
                        'name' => 'image_lightbox',
                        'label' => __( 'Image URL', 'filathemes' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => '',
                    ],

					[
						'name' => 'feature_title',
						'label' => __( 'Title', 'filathemes' ),
						'type' => Controls_Manager::TEXT,
						'default' => '',
						'show_label' => false,
						'label_block' => true,
					],
					[
						'name' => 'feature_description',
						'label' => __( 'Content', 'filathemes' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => '',
						'show_label' => false,
						'label_block' => true,
					],
				],
				'title_field' => '{{{ feature_title }}}',
			]
		);



		$this->end_controls_section();
	}
	protected function render( $instance = [] ) {
		$title = $this->get_settings('feature_main_title');
		$features = $this->get_settings('feature_item');
		$output = '';

		if ( $features ) {
			$output .= '<div class="theme-features section-block"><div class="wrap"> ';
			$output .= '<h2>'. $title .'</h2>';
			foreach ( $features as $feature ) {
                $image = $feature['feature_image'];
                $imgurl = wp_get_attachment_image_src(  $image['id'], 'full' );
                
                $image_lightbox = $feature['image_lightbox'];
                $img_lightbox_url = wp_get_attachment_image_src(  $image_lightbox['id'], 'full' );

				$output .= '<div class="item-list item-features"><div class="th-feature-row"> ';
                $output .= '<p><strong><span>';
            
                if( 'yes' === $feature['enable_lightbox'] && $img_lightbox_url ) {
                    $output .= '<a title="Click to view large image" class="theme-lightbox" href="'. $img_lightbox_url[0] .'">';
                } 

                $output .= '<img class="alignleft" src="'.$imgurl[0].'" width="300" height="200" /> ' ;

                if( 'yes' === $feature['enable_lightbox'] && $img_lightbox_url ) {
                    $output .= '<span>Click to view large image</span>';
                    $output .= '</a>';
                }

                $output .= $feature['feature_title'] . '</span></strong></p>';
				$output .= '<p>'. $feature['feature_description'] .'</p>';
				$output .= '</div></div>';
			}
			$output .= '</div></div>';
		}

		echo $output;
	}
	protected function _content_template() {}
}