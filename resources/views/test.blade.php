<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Display a map on a webpage</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css">
    <style>
        #map {
            position: relative;
            width: 100%;
            height: 450px;
        }
    </style>
</head>
<body>
    <h1>askdjh</h1>
    <div id="map"></div>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYXJpcG9uIiwiYSI6ImNrbjV3cmZ5NTA4aDUyd25zenk3MmlwYzgifQ.YbJ_Ir794eD8VlrVvpX64g';

        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',            
            center: [112.63033862807194, -7.982580467907199],
            zoom: 13
        });

        map.addControl(
            new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                mapboxgl: mapboxgl
            })
            );

        map.addControl(new mapboxgl.NavigationControl());

        map.addControl(
            new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true
                },
                trackUserLocation: true
            })
            );

        map.on('load', function() {
            map.resize();
        });
    </script>

</body>
</html>