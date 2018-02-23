<div id="googleMapHas" style="width:100%;height:470px;"></div>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
	var myCenter=new google.maps.LatLng(<?php echo esc_js($lat);?>,<?php echo esc_js($long);?>);
	var marker;

	function initialize()
	{
	var mapProp = {
	  center:myCenter,
	  zoom:5,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };

	var map=new google.maps.Map(document.getElementById("googleMapHas"),mapProp);

	var marker=new google.maps.Marker({
	  position:myCenter,
	  animation:google.maps.Animation.BOUNCE
	  });

	marker.setMap(map);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
</script> 