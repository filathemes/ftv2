<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FilaThemes
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'filathemes' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			

			<nav id="site-navigation" class="main-navigation">
                <a href="#0" aria-controls="primary-menu" aria-expanded="false" id="nav-toggle" class=""><?php _e('Menu', 'filathemes') ?> <span></span></a>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			</nav><!-- #site-navigation -->

			<div class="header-right">
				<ul>
                    <li>
                        <a title="Go to checkout" href="<?php echo edd_get_checkout_uri(); ?>">
                            Cart <span class="edd-cart-quantity"><?php echo edd_get_cart_quantity(); ?></span>
                        </a>
                    </li>
                    <?php if( is_user_logged_in() ) {  ?>
                        <li><a href="/dashboard"><?php esc_html_e( 'My Profile', 'filathemes' ); ?> <i class="fa fa-user-o"></i></a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo wp_login_url( site_url('/dashboard') ); ?>"><?php esc_html_e( 'Login', 'filathemes' ); ?> <i class="fa fa-user-o"></i></a></li>
                    <?php } ?>
                    
				</ul>
			</div>

            <?php 
            global $post;

			if ( !is_front_page() ) { 
                echo '<div class="page-header">';

                    if ( is_singular('docs') ) {
                        echo '<h1 class="entry-title">Documentation</h1>';
                    } 

                    if( is_singular('download') ) {
                        echo '<p>' . get_field( 'theme_short_description', $post->ID ) . '</p>';
                        ?>
                        <div class="banner_meta">
                            <a href="<?php echo esc_url( site_url() ) ?>/preview?theme=<?php echo $post->post_title ?>" ><?php esc_html_e('Live Demo', 'filathemes') ?></a>
                            <a href="<?php the_field('free_download_link', $post->ID) ?>" ><?php esc_html_e('Free Download', 'filathemes') ?></a>
                        </div>
                        <?php
                    }

                    $current_user = wp_get_current_user();
                    if ( is_page_template( array( 'template-member-dashboard.php' ) ) ) {
                        ?>
                        <h1><?php echo sprintf( __('Howdy, %s', 'filathemes'), $current_user->user_firstname ) ?></h1>
                        <p><?php _e('Welcome to your FilaThemes Dashboard.', 'filathemes') ?></p>

                        <?php
                    }

                    else { 
                        the_title( '<h1 class="entry-title">', '</h1>' ); 
                    }

				echo '</div>';
			} 
			?>

		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
