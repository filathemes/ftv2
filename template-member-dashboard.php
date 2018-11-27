<?php
/**
 * Template Name: Member - Dashboard
 *
 * @package FilaThemes
 */

if ( ! is_user_logged_in() ) {
	wp_redirect( wp_login_url() );
    exit();
}



get_header(); ?>

    <?php ft_member_nav() ; ?>

     <div class="member-content-area">
        <div class="container">
            <?php the_content(); ?>
        </div>
    </div>

<?php

get_footer(); ?>
