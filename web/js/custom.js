/* Custom JS */

/* globals google */
var map = null;
var geocoder = null;

function initialize() {
	map = new google.maps.Map(document.getElementById("map_canvas"), {
	    center: new google.maps.LatLng(37.4419, -122.1419),
	    zoom: 16,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	geocoder = new google.maps.Geocoder();
}

function showAddress(address) {
	if (geocoder) {
		geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              map.setCenter(results[0].geometry.location);
              var marker = new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location
              });
            } else {
              alert('Geocode was not successful for the following reason: ' + status);
            }
        });
	}
}

$(document).ready(function(){
    // Video
    var heightAvailable = ((window.innerHeight >= 900) ? window.innerHeight : 900) + 'px';
    $('#videoPortada').css('height', heightAvailable);
    $('#videoPortada').videoBG({
    	mp4:'video/ThroughTheReeds.mp4',
    	ogv:'video/ThroughTheReeds.ogv',
    	webm:'video/ThroughTheReeds.webm',
    	poster:'video/ThroughTheReeds.jpg',
    	scale:true,
    	loop:true,
    	height:heightAvailable,
    	zIndex:0
    });
    
    // Map
    initialize();
    showAddress('Paseo de las delicias 30, 28045, Madrid');

    // Orientation change event
    window.addEventListener("orientationchange", function() {
        location.reload();
    });
    
    // Resize event
    $(window).resize(function() {
        if (!jQuery.browser.mobile)
        {
            setTimeout(function() {
                if($(document.activeElement).attr('type') !== 'text') {
                    location.reload();
                }
            }, 1000);
        }
    });
});