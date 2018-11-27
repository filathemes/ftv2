<?php
namespace FilaThemes;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class FT_Elementors {
	/**
	 * Plugin constructor.
	 */
	public function __construct() {
		$this->add_actions();
	}
	private function add_actions() {
		add_action( 'elementor/init', array( $this, 'add_elementor_category' ) );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
	}
	public function add_elementor_category()
	{
		\Elementor\Plugin::instance()->elements_manager->add_category( 'ft-elements', array(
			'title' => __( 'FT Elements', 'filathemes' ),
		), 1 );
	}
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}
	private function includes()
	{
		// Theme Elements
		require_once __DIR__ . '/elementors/features.php';
        require_once __DIR__ . '/elementors/table-compare.php';
        require_once __DIR__ . '/elementors/theme-item.php';
	}
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \FilaThemes\Widgets\FT_Element_Features() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \FilaThemes\Widgets\FT_Element_Table_Compare() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \FilaThemes\Widgets\FT_Element_Theme_Item() );
	}
}


new FT_Elementors();