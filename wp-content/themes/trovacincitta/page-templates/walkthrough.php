<?php
/**
 * Template Name: Walkthrough
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>


<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

<div class="wrapper page-walkthrough" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">
					<div id="walkthrough" class="slick">
						<?php
							$query = new WP_Query(
								array(
									'post_type' => 'help_item',
									'posts_per_page'	=> -1,
									'meta_key' => 'ord',
									'orderby'	=> 'meta_value',
									'order'	=> 'ASC'
								)
							);
							while ( $query->have_posts() ) : $query->the_post();
						?>
							<?php get_template_part( 'loop-templates/content', 'help_item' ); ?>
						<?php endwhile; wp_reset_query(); ?>
					</div>
				</main><!-- #main -->
				
				<div class="btn_inizia">
					<a href="<?php print home_url(); ?>"> Inizia </a>
				</div>

				
				<a href="<?php print home_url(); ?>" class="button-start" style="
					display: block;
					width: 160px;
					text-align: center;
					margin-left: 50%;
					left: -80px;
					color: #000000;
					position: relative;
				">Salta <i class="fas fa-angle-right"></i></i></a>


			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
