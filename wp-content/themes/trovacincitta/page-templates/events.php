<?php
/**
 * Template Name: Events
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<div class="wrapper" id="full-width-page-wrapper">
	<div class="<?php echo esc_attr( $container ); ?>" id="content">
		<div class="row">
			<div class="col-md-12 content-area" id="primary">
				<main class="site-main" id="main" role="main">
					<h1>Le Mostre</h1>
					<div class="row cells">
						<?php
							$location=FALSE;
							$query = new WP_Query(
								array(
									'post_type' => 'event',
									'posts_per_page'	=> -1,
									'order'	=> 'ASC'
								)
							);
							while ( $query->have_posts() ) : $query->the_post();
						?>
							<?php 
								if(get_field("location") != $location){
									$location = get_field("location")
							?>
								<div class="col-12 location">
									<?php the_field("location"); ?>
								</div>
							<?php
								}
							?>
							<?php get_template_part( 'loop-templates/content', 'event' ); ?>
						<?php endwhile; wp_reset_query(); ?>
					</div>
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .row end -->
	</div><!-- Container end -->
</div><!-- Wrapper end -->
<?php get_footer(); ?>
