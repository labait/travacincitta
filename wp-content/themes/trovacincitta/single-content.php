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
			<div id="close-button">
				<a href="<?php print home_url(); ?>">
					<i class="fa fa-times" aria-hidden="true"></i>
				</a>
			</div>
			<div id="info">

			</div>
			<div id="cinemagraph">
				<img src="<?php echo $cinemagraph['url']; ?>" alt="<?php echo $cinemagraph['alt']; ?>" />
			</div>
			<?php
				//dbg($cinemagraph)
			?>
			<script type="text/javascript">
				(function($){
					$(document).ready(function(){
						var debug = true;

						$('body').loading({
							message: 'caricamento in corso...',
							theme: 'dark',
							stoppable: true
						});
						
						$info = $("#info")
						$cinemagraph = $("#cinemagraph")
						$cinemagraph.hide();
						$img_original_width = <?php print $cinemagraph['width']; ?>;
						$img_original_height = <?php print $cinemagraph['height']; ?>;
						$img = $cinemagraph.find(">img")
						
						$img.one("load", function() {
							// do stuff
							$cinemagraph.show();
							$('body').loading('stop');
							$img.css({
								"height": "100vh",
								"max-width": "2000px"
							})
							// centering img
							var scroll_left = ($img.width()-$cinemagraph.width())/2
							$cinemagraph.scrollLeft(scroll_left);
							//
							setTimeout(function(){
								$info.show();
							}, (debug ? 1000 : 8000))

						}).each(function() {
							if(this.complete) $(this).load();
						});
					})

				})(jQuery);
			</script>
		<?php endif; ?>
	<?php endwhile; // end of the loop. ?>
</div><!-- Wrapper end -->

<?php get_footer(); ?>

