<?php
/**
 * Template Name: Map
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

						<div class="acf-map">
							<?php
								$query = new WP_Query( 
									array( 
										'post_type' => 'content', 
										'posts_per_page'	=> -1,
									) 
								);         
								while ( $query->have_posts() ) : $query->the_post(); 
							?>   
								<?php get_template_part( 'loop-templates/content', 'content' ); ?>
							<?php endwhile; wp_reset_query(); ?>
						</div>


				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<script type="text/javascript">
(function($) {
	function new_map( $el ) {
		var $markers = $el.find('.marker');
		var args = {
			zoom		: 16,
			center		: new google.maps.LatLng(0, 0),
			mapTypeId	: google.maps.MapTypeId.ROADMAP
		};     	
		var map = new google.maps.Map( $el[0], args);
		map.markers = [];
		$markers.each(function(){
				add_marker( $(this), map );		
		});
		center_map( map );
		userPosition();
		return map;	
	}

	function add_marker( $marker, map ) {
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
		var marker = new google.maps.Marker({
			position: latlng,
			map: map
		});
		map.markers.push( marker );

		if( $marker.html() )
		{
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open( map, marker );
			});
		}
	}

	function userPosition(){
		infoWindow = new google.maps.InfoWindow;
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};

				infoWindow.setPosition(pos);
				infoWindow.setContent('Location found.');
				infoWindow.open(map);
				map.setCenter(pos);
			}, function() {
				handleLocationError(true, infoWindow, map.getCenter());
			});
		} else {
			// Browser doesn't support Geolocation
			handleLocationError(false, infoWindow, map.getCenter());
		}
	}

	function center_map( map ) {
		var bounds = new google.maps.LatLngBounds();
		$.each( map.markers, function( i, marker ){
			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
			bounds.extend( latlng );
		});
		if( map.markers.length == 1 )
		{
			map.setCenter( bounds.getCenter() );
			map.setZoom( 16 );
		}
		else
		{
			map.fitBounds( bounds );
		}
	}

	var map = null;
	$(document).ready(function(){
		$('.acf-map').each(function(){
			map = new_map( $(this) );
		});
	});

	})(jQuery);
	</script>

<?php get_footer(); ?>
