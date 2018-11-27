<?php
namespace FilaThemes\Widgets;
use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
use  Elementor\Utils ;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class FT_Element_Table_Compare extends Widget_Base {
	public function get_name() {
		return 'ft-table-compare';
	}
	public function get_title() {
		return __( 'Table Compare', 'filathemes' );
	}
	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'fa fa-table';
	}
	public function get_categories() {
		return [ 'ft-elements' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Table Compare', 'filathemes' ),
			]
		);

		$this->add_control(
			'table_main_title',
			[
				'label' => __( 'Main Title', 'filathemes' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => ''
			]
		);
		$this->add_control(
			'free_title',
			[
				'label' => __( 'Free Title', 'filathemes' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => ''
			]
		);

		$this->add_control(
			'pro_title',
			[
				'label' => __( 'Pro Title', 'filathemes' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => ''
			]
		);

		$this->add_control(
			'compare_item',
			[
				'label' => __( 'Item', 'filathemes' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [],
				'fields' => [
					[
						'name' => 'key_title',
						'label' => __( 'Title', 'filathemes' ),
						'type' => Controls_Manager::TEXT,
						'default' => '',
						'show_label' => false,
						'label_block' => true,
					],
					[
						'name' => 'is_free',
						'label' => __( 'Is Free?', 'filathemes' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => '',
						'label_on' => __( 'Yes', 'filathemes' ),
						'label_off' => __( 'No', 'filathemes' ),
						'return_value' => 'yes',
					],
				],
				'title_field' => '{{{ key_title }}}',
			]
		);



		$this->end_controls_section();
	}
	protected function render( $instance = [] ) {
		$title = $this->get_settings('table_main_title');
		$free_title = $this->get_settings('free_title');
		$pro_title = $this->get_settings('pro_title');
		$items = $this->get_settings('compare_item');

		global $post;
		$post_id = $post->ID;
		$free_download_link = get_field('free_download_link', $post_id);
		$is_free = get_field('is_free_themes', $post_id);
		
		$output = '';

		if ( $items ) {
			$output .= '<div id="compare-table" class="section-block"><div class="wrap"><div class="featured-table-wrapper"> ';
			$output .= '<h2>'. $title .'</h2>';
			$output .= '<table class="table">';
			$output .= '<thead><tr><th></th><th class="db-bk-color-one">'.$free_title.'</th><th>'.$pro_title.'</th></tr></thead>';
			$output .= '<tbody>';
			foreach ( $items as $item ) {
				$is_free = ($item['is_free'] == 'yes') ? '<i class="icon-green"></i>' : '<i class="icon-red"></i>';
				$output .= '<tr>';
				$output .= '<td class="db-width-perticular">'.$item['key_title'].'</td>';
				$output .= '<td>'.$is_free.'</td>';
				$output .= '<td><i class="icon-green"></i></td>';
				$output .= '</tr>';
			}
			$output .= '</tbody>';
		
			$output .= '</table>';
			$output .= '</div></div></div>';
		}

		echo $output;
	}


	protected function _content_template() {}
}