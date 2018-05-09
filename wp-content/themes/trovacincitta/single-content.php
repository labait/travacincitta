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
		<?php 
			$cinemagraph = get_field('cinemagraph'); 
			$audio = get_field('audio'); 
		?>
		<?php if( $cinemagraph ): ?>
			<div id="close-button">
				<a href="<?php print home_url(); ?>">
					<i class="fa fa-times" aria-hidden="true"></i>
				</a>
			</div>
			<div id="audio-button">
				<a href="#">
					<i class="fa fa-volume-up" aria-hidden="true"></i>
				</a>
			</div>
			<div id="info">

			</div>
			<div id="cinemagraph">
				<img src="<?php echo $cinemagraph['url']; ?>" alt="<?php echo $cinemagraph['alt']; ?>" />
			</div>
			<?php
				//dbg($audio)
			?>
			<script type="text/javascript">
				(function($){
					$(document).ready(function(){
						var debug = true;
						var show_info = false;
						var show_cinemagraph = true;
						
						var audio = new Audio("<?php echo $audio['url']; ?>");
						$("#audio-button a").on("click", function(e){
							e.preventDefault();
							var $link = $(this);
							var $icon = $(this).find("i");
							if($link.hasClass("play")){
								audio.pause();
								$link.removeClass("play")
								$icon.removeClass("fa-volume-up")
								$icon.addClass("fa-volume-off")
							} else {
								audio.play();
								$link.addClass("play")
								$icon.removeClass("fa-volume-off")
								$icon.addClass("fa-volume-up")			
							}
						})

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
							if(show_cinemagraph) $cinemagraph.show();
							$('body').loading('stop');
							$img.css({
								"height": "100vh",
								"max-width": "2000px"
							})
							// centering img
							var scroll_left = ($img.width()-$cinemagraph.width())/2
							$cinemagraph.scrollLeft(scroll_left);
							
							// info
							if(show_info) {
								setTimeout(function(){
									$info.show();
								}, (debug ? 1000 : 8000))			
							}


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

