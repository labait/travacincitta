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
			<div id="bg"></div>
			<div id="info">
				<img src="http://localhost:8888/trovacincitta/wp-content/uploads/2018/05/bresciaphotofestival_logonew-1.png" alt="">
				<h3>15 Maggio - 2 Settembre 2018 </h3>
				<h3> Museo santa giulia - Brescia</h3>
				<h3>15 Maggio - 29 Luglio 2018 </h3>
				<h3> Ma.Co.f. - Brescia</h3>
				<div id="fb-root"></div>
					<script>(function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;
						js = d.createElement(s); js.id = id;
						js.src = 'https://connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v2.12';
						fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));
					</script>
				<div data-href="https://www.scattanelpassato.it" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.scattanelpassato.it%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Condividi l'esperienza</a></div>
				<a href="https://www.scattanelpassato.it/">Scopri gli altri punti</a>
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
						var debug = Boolean(<?php echo get_option( 'trovacincitta_is_debug' ); ?>);
						var show_info = true;
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
									$('#close-button a').css('color', 'white');
									$('#audio-button a').css('opacity', '0');
									$("#bg").show();
									$info.show();
								}, (debug ? 1000 : (<?php echo get_option( 'trovacincitta_seconds_before_info_in_cinemagraph'); ?>*1000)))		
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

