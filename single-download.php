<?php

get_header();

$download_id = get_the_ID();

$theme_screenshot = get_field('signle_theme_screenshot');
?>

<div class="container product-intro">
    <div class="row">
        <div class="col-md-9">
            <?php if ( $theme_screenshot ) { ?>
            <div class="theme-featured-image">
                    <img src="<?php echo $theme_screenshot['url'] ?>" alt=" <?php the_field('theme_short_name'); ?>">
            </div>
            <?php } ?>
        </div>

        <div class="col-md-3 sidebar-price">
            <div class="edd-btn-group">
                
                <?php $is_free = get_field('is_free_themes');
                
                
                if ( $is_free == '1' ) {
                    echo '<span class="price">Free</span>';
                } else {
                    echo '<span class="price">$49</span>';
                }

                if ( $is_free == '1' ) {
                    $url = get_field('landing_pro_url');
                    ?>
                    <a class="buy_main" href="<?php echo esc_url( $url ) ?>"><?php esc_html_e('Go Pro', 'filathemes'); ?></a>
                    <?php
                }
                else {
                    $purchase_button = '[purchase_link id="'. $download_id .'" text="Add to Cart" price=0]';
                    echo do_shortcode( $purchase_button );
                }
                
                ?>
                
                <a class="buy_main_pro" target="_blank" href="<?php the_field('theme_document_url', $post->ID) ?>">Documentation</a>
                
            </div>
        </div>
    </div>
</div>


<div class="container">
    <?php

        while ( have_posts() ) {
            the_post();

            the_content();
        }

    ?>
</div>

<div class="container btns-group">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <a target="_blank" href="<?php the_field('theme_document_url', $download_id) ?>" ><?php esc_html_e('Documentation', 'filathemes') ?></a>
            <a href="<?php echo esc_url( site_url() ) ?>/preview?theme=<?php echo $post->post_title ?>" ><?php esc_html_e('Live Demo', 'filathemes') ?></a>
            
            <?php 
            if ( $is_free == '1' ) {
                $url = get_field('landing_pro_url');
                ?>
                <a class="buy_main" href="<?php echo esc_url( $url ) ?>"><?php esc_html_e('Go Pro', 'filathemes'); ?></a>
            <?php
            } else { 
                $purchase_button = '[purchase_link id="'. $download_id .'" text="Buy This Theme" price=0]'; 
                echo do_shortcode( $purchase_button ); 
            } ?>
        </div>
    </div>
</div>

<div class="container"> 
    <div class="section-block changelog">
       
            <ul class="tabs">
                <li class="tab-link current" data-tab="latest-version"><?php esc_html_e('Latest Version', 'filathemes') ?></li>
                <li class="tab-link" data-tab="changelog"><?php esc_html_e('Changelog', 'filathemes') ?></li>
            </ul>
            <div id="latest-version" class="tab-content current">
                <?php the_field('latest_version') ?>
            </div>
            <div id="changelog" class="tab-content">
                <?php the_field('changelog') ?>
        
            </div>
    </div>
</div>

<?php get_footer();
