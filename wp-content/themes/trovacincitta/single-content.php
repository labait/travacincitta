<?php
/**
 * Template Name: Full Width Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="full-width-page-wrapper">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php $cinemagraph = get_field('cinemagraph'); ?>
		<?php if( $cinemagraph ): ?>
			<div id="cinemagraph">
				<img src="<?php echo $cinemagraph['url']; ?>" alt="<?php echo $cinemagraph['alt']; ?>" />
			</div>
			<?php
				//dbg($cinemagraph)
			?>
			<script type="text/javascript">
				(function($){
					$cinemagraph = $("#cinemagraph")
					// $img_original_width = <?php print $cinemagraph['width']; ?>;
					// $img_original_height = <?php print $cinemagraph['height']; ?>;
					$img = $cinemagraph.find(">img")
					
					// $ratio = $img_original_height / $cinemagraph.height();
					// $img_width = parseInt($img_original_width * $ratio)
					// $img_height = parseInt($cinemagraph.height())

					// $img.width($img_width+"px")
					// $img.height($img_height+"px")
					$img.css({
						"height": "100vh",
						"max-width": "2000px"
					})
					var scroll_left = ($img.width()-$cinemagraph.width())/2
					$cinemagraph.scrollLeft(scroll_left);
				})(jQuery);
			</script>
		<?php endif; ?>
	<?php endwhile; // end of the loop. ?>
</div><!-- Wrapper end -->

<?php get_footer(); ?>

