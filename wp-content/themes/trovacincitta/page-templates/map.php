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
								<?php get_template_part( 'loop-templates/content', 'content-map-item' ); ?>
							<?php endwhile; wp_reset_query(); ?>
						</div>
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .row end -->
	</div><!-- Container end -->
</div><!-- Wrapper end -->

<script type="text/javascript">
(function($) {
	var debug = true;
	var template_path = "<?php print get_stylesheet_directory_uri(); ?>";
	var map;
	

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
			add_marker( 
				map,
				$(this).attr('data-lat'),
				$(this).attr('data-lng'),
				$(this).html(),
				"icon1"
			);		
		});
		center_map( map );
		getUserPosition(map);
		return map;	
	}

	function add_marker( map, latitude, longitude, html, icon_name ) {
		var icons = {
			"icon1": {
				url: template_path+'/img/marker1.png',
				scaledSize: new google.maps.Size(27, 43), // scaled size
				origin: new google.maps.Point(0,0), // origin
				anchor: new google.maps.Point(0, 0) // anchor
			},
			"icon2": {
				url: template_path+'/img/marker2.png',
				scaledSize: new google.maps.Size(27, 43), // scaled size
				origin: new google.maps.Point(0,0), // origin
				anchor: new google.maps.Point(0, 0) // anchor
			}
		};
		var icon = icons[icon_name];
		
		var latlng = new google.maps.LatLng( latitude, longitude );
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			icon: icon
		});
		map.markers.push( marker );

		if( html ){
			var infowindow = new google.maps.InfoWindow({
				content: html
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open( map, marker );
			});
		}
	}

	function getUserPosition(map){
		if(debug) {
			var pos = { // fake position
				lat: 45.559593,
				lng: 10.2009603
			};
			showUserPosition(map, pos);
			return;
		}
		//infoWindow = new google.maps.InfoWindow;
		if (navigator.geolocation) {
			$('body').loading({
				message: 'Ricerca posizione...',
				theme: 'dark',
				stoppable: true
			});
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				//infoWindow.setPosition(pos);
				//infoWindow.setContent('Location found.');
				//infoWindow.open(map);
				showUserPosition(map, pos);
				
			}, function() {
				handleLocationError(true, infoWindow, map.getCenter());
				$('body').loading('stop');
			});
		} else {
			// Browser doesn't support Geolocation
			handleLocationError(false, infoWindow, map.getCenter());
		}
	}

	function showUserPosition(map, pos){
		add_marker( map, pos.lat, pos.lng, "la tua positione", "icon2" )
		center_map( map );
		$('body').loading('stop');
	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		$('body').loading('stop');
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
			'Error: The Geolocation service failed.' :
			'Error: Your browser doesn\'t support geolocation.');
		infoWindow.open(map);
	}

	function center_map( map ) {
		var bounds = new google.maps.LatLngBounds();
		$.each( map.markers, function( i, marker ){
			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
			bounds.extend( latlng );
		});
		if( map.markers.length == 1 ) {
			map.setCenter( bounds.getCenter() );
			map.setZoom( 16 );
		} else{
			map.fitBounds( bounds );
		}
	}

	function setMapSize(){
		$('.acf-map').each(function(){
			$(this).height($(this).parent().height());
		});
	}

	var map = null;
	$(document).ready(function(){
		$('.acf-map').each(function(){
			map = new_map( $(this) );
			setMapSize();
		});
		var resizeId;
		$(window).resize(function() {
			clearTimeout(resizeId);
			resizeId = setTimeout(function(){
				setMapSize();
			}, 500);
		});
	});

})(jQuery);
</script>

<?php get_footer(); ?>
