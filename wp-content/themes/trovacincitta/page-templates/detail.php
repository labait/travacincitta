<?php
/**
 * Template Name: Detail
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper page-walkthrough" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

				</main><!-- #main -->
				<div class="bg"></div>
				<div class="overlay">

					<img src="http://scattanelpassato.it/wp-content/uploads/2018/05/bresciaphotofestival_logonew.png" alt="">
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
				<div id="detail">
					<?php
						$query = new WP_Query(
							array(
								'post_type' => 'content',
								'posts_per_page'	=> 1
							)
						);
						while ( $query->have_posts() ) : $query->the_post();
					?>
						<?php get_template_part( 'loop-templates/content', 'content' ); ?>
					<?php endwhile; wp_reset_query(); ?>
				</div>


			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->


</div><!-- Wrapper end -->

<?php get_footer(); ?>
