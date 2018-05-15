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
	var template_path = "<?php print get_stylesheet_directory_uri(); ?>";
	var redirect_url_if_not_in_distance_treshold =  "<?php print get_post_permalink(123); ?>";

	(function ($) {
  var debug = true;
  var distance_treshold = 0.2 //km
  var map;

  function new_map($el) {
    var $markers = $el.find('.marker');
    var args = {
      zoom: 16,
      center: new google.maps.LatLng(0, 0),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map($el[0], args);
    map.markers = [];
    $markers.each(function () {
      add_marker(
        map,
        $(this).data('lat'),
        $(this).data('lng'),
        $(this).data('title'),
        $(this).html(),
        "icon1"
      );
    });
    center_map(map);
    getUserPosition(map);
    return map;
  }

  function add_marker(map, latitude, longitude, title, html, icon_name) {
    var icons = {
      "icon1": {
        url: template_path + '/img/marker1.png',
        scaledSize: new google.maps.Size(27, 43), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(0, 0) // anchor
      },
      "icon2": {
        url: template_path + '/img/marker2.png',
        scaledSize: new google.maps.Size(27, 43), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(0, 0) // anchor
      }
    };
    var icon = icons[icon_name];

    var latlng = new google.maps.LatLng(latitude, longitude);
    var marker = new google.maps.Marker({
      position: latlng,
      map: map,
      icon: icon,
      title: title,
      html: html
    });
    map.markers.push(marker);

    if (html) {
      var infowindow = new google.maps.InfoWindow({
        content: html
      });
      google.maps.event.addListener(marker, 'click', function () {
        infowindow.open(map, marker);
      });
    }
  }

  function getUserPosition(map) {
    if (debug) {
      var pos = { // laba
        lat: 45.559593,
        lng: 10.2009603
      };
      pos = { // posto fighetto da aperitivi aka piazza arnaldo
      	lat: 45.5363198,
      	lng: 10.2285164
      }
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
      navigator.geolocation.getCurrentPosition(function (position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        //infoWindow.setPosition(pos);
        //infoWindow.setContent('Location found.');
        //infoWindow.open(map);
        showUserPosition(map, pos);
      }, function () {
        handleLocationError(true, map.getCenter());
        $('body').loading('stop');
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, map.getCenter());
    }
  }

  function showUserPosition(map, pos) {
    checkUserProximity(map, pos);
    add_marker(map, pos.lat, pos.lng, "user position", "la tua posizione", "icon2")
    center_map(map);
    $('body').loading('stop');
  }

  function checkUserProximity(map, userPos) {
    var distance_min = 100;
    $(map.markers).each(function (index, marker) {
      var distance = getDistanceFromLatLonInKm(userPos.lat, userPos.lng, marker.position.lat(), marker.position.lng())
      //console.log("user is "+distance+"km away from "+marker.title+" lat: "+marker.position.lat()+", "+marker.position.lng())
      if (distance < distance_min) distance_min = distance;
    })
    console.log("distance_min: " + distance_min)
    if (distance_min > distance_treshold) {
      console.log("distance_min: " + distance_min + " > " + distance_treshold + ", redirecting...")
      setTimeout(function(){
        window.location = redirect_url_if_not_in_distance_treshold;  
      }, (debug ? 5000 : 1));
    }
  }

  function handleLocationError(browserHasGeolocation, pos) {
    $('body').loading('stop');
    console.log('Error: The Geolocation service failed.', 'Error: Your browser doesn\'t support geolocation.')
  }

  function center_map(map) {
    var bounds = new google.maps.LatLngBounds();
    $.each(map.markers, function (i, marker) {
      var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
      bounds.extend(latlng);
    });
    if (map.markers.length == 1) {
      map.setCenter(bounds.getCenter());
      map.setZoom(16);
    } else {
      map.fitBounds(bounds);
    }
  }

  function setMapSize() {
    $('.acf-map').each(function () {
      $(this).height($(this).parent().height());
    });
  }

  function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
    var R = 6371; // Radius of the earth in km
    var dLat = deg2rad(lat2 - lat1);  // deg2rad below
    var dLon = deg2rad(lon2 - lon1);
    var a =
      Math.sin(dLat / 2) * Math.sin(dLat / 2) +
      Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
      Math.sin(dLon / 2) * Math.sin(dLon / 2)
      ;
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c; // Distance in km
    return d;
  }

  function deg2rad(deg) {
    return deg * (Math.PI / 180)
  }

  var map = null;
  $(document).ready(function () {
    $('.acf-map').each(function () {
      map = new_map($(this));
      setMapSize();
    });
    var resizeId;
    $(window).resize(function () {
      clearTimeout(resizeId);
      resizeId = setTimeout(function () {
        setMapSize();
      }, 500);
    });
  });

})(jQuery);

</script>

<?php get_footer(); ?>
