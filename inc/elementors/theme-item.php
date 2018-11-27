<?php
namespace FilaThemes\Widgets;
use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
use  Elementor\Utils ;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class FT_Element_Theme_Item extends Widget_Base {
	public function get_name() {
		return 'ft-theme-item';
	}
	public function get_title() {
		return __( 'Theme Item', 'filathemes' );
	}
	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'fa fa-wordpress';
	}
	public function get_categories() {
		return [ 'ft-elements' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Theme Screenshot', 'filathemes' ),
			]
		);

		$this->add_control(
			'column',
			[
				'label' => __( 'Number or Column', 'filathemes' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
					'1'  => 1,
                    '2'  => 2,
                    '3'  => 3,
                    '4'  => 4
				],
			]
		);

		

		$this->end_controls_section();
	}
	protected function render( $instance = [] ) {
        $title = $this->get_settings('column');

        $args = array(  
            'post_type'     => 'download', 
            'meta_key'		=> 'is_free_themes',
            'meta_value'	=> 1,
            'posts_per_page' => -1
        );
        $themes = new \WP_Query( $args );

        if ( $themes->have_posts() ) {
            echo ' <div class="row">';

            while( $themes->have_posts() ) {
                $themes->the_post();
                $theme_id = $themes->ID;
                $theme_screenshot = get_field( 'theme_screenshot', $theme_id);
                $theme_pro_link = get_field( 'landing_pro_url', $theme_id);
                
                ?>
               
                    <div class="col-xs-12 col-ms-4 col-sm-4">
                        <div class="product-item">
                            <div class="product-img">
                                <a href="<?php the_permalink() ?>">
                                    <img src="<?php echo $theme_screenshot['url'] ?>" alt=" <?php the_field( 'theme_short_name', $theme_id); ?>">
                                </a>
                            </div>
                            <div class="product-content">
                                <div class="product-meta-info">
                                   <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                                </div>
                                <div class="product-price-info">
                                    <div class="premium-regular-price"><a href="<?php the_permalink() ?>"><?php esc_html_e('Free', 'filathemes') ?></a></div>
                                    <div class="premium-regular-price pro"><a href="<?php echo  esc_url( $theme_pro_link ) ?>"><?php esc_html_e('Buy Pro', 'filathemes') ?></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
               
                <?php
            }

            echo ' </div>';
        }

		
	}


	protected function _content_template() {}
}