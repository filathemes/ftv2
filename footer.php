<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FilaThemes
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
				<?php
				echo esc_html__('@ FilaThemes.com. All Rights Reserved.', 'filathemes');
				?>
		</div><!-- .site-info -->
    </footer><!-- #colophon -->
    
    <a href="#top" id="to-top" title="Back to top"><i class="fa fa-angle-double-up"></i></a>
    
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
