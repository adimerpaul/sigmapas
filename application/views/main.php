<?php if ($bufer=="si"):?>
<style>
    #floating-panel {
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
    }
</style>
<div id="floating-panel">
    <input onclick="aumentar();" type=button value="+">
    <input onclick="disminuir();" type=button value="-">
</div>
<?php endif;?>

<div style="width: 100%;height: 500px" id="map"></div>
<script>
    function aumentar() {
        cityCircle.setMap(null);
        ra=ra+5;
        cityCircle= new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            center: {lat: <?=$lat?>, lng: <?=$long?>},
            radius:  ra
        });
    }
    function disminuir() {
        cityCircle.setMap(null);
        ra=ra-5;
        cityCircle= new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            center: {lat: <?=$lat?>, lng: <?=$long?>},
            radius:  ra
        });
    }
      var map, infoWindow, cityCircle,ra=80;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: <?=$lat?>, lng: <?=$long?>},
          zoom: <?=$zum?>,
          disableDoubleClickZoom: true,
        });
          infoWindow = new google.maps.InfoWindow;

          // Try HTML5 geolocation.
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                  var pos = {
                      lat: position.coords.latitude,
                      lng: position.coords.longitude
                  };
                  infoWindow.setPosition(pos);
                  infoWindow.setContent('Ubicación encontrada.');
                  infoWindow.open(map);
                  map.setCenter(pos);
              }, function() {
                  handleLocationError(true, infoWindow, map.getCenter());
              });
          } else {
              // Browser doesn't support Geolocation
              handleLocationError(false, infoWindow, map.getCenter());
          }

          <?php
          if ($bufer=="si"){
              echo " cityCircle= new google.maps.Circle({
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: '#FF0000',
                        fillOpacity: 0.35,
                        map: map,
                        center: {lat: $lat, lng: $long},
                        radius:  ra
                      });";
          }
          ?>

          <?php
          $query=$this->db->query("SELECT * FROM COLEGIO WHERE estado='ACTIVO'");
          foreach($query->result() as $row){
              echo " var marker = new google.maps.Marker({
                    position: {lat: $row->lat, lng: $row->long},
                    map: map,
                    title: '$row->nombre'
                });
                attachSecretMessage(marker, '$row->nombre');
                ";
          }
          ?>

        google.maps.event.addListener(map,'click',function(event) {
                console.log(event.latLng.lat()+' '+event.latLng.lng()) ;
            });

        <?php
              $c=0;
        $query=$this->db->query("SELECT * FROM minibus WHERE estado='ACTIVO'");
        foreach($query->result() as $row){
          $c++;
            //echo "SELECT * FROM puntos WHERE idminibus='$row->idminibus'";
          $query2=$this->db->query("SELECT * FROM puntos WHERE idminibus='$row->idminibus'");
          $p="";
          foreach($query2->result() as $row2){
            $p=$p." {lat: $row2->lat, lng: $row2->long},";
          }
            echo "var flightPlanCoordinates = [$p];
                  var flightPath$c = new google.maps.Polyline({
                      path: flightPlanCoordinates,
                      geodesic: true,
                      strokeColor: '$row->color',
                      strokeOpacity: 1.0,
                      strokeWeight: 5,
                      content: '$row->nombre'
                  });
                    flightPath$c.setMap(map);
                    flightPath$c.addListener('click', showArrays);";

         }
        ?>


    infoWindow = new google.maps.InfoWindow;
    function showArrays(event) {
        var vertices = this.getPath();
        infoWindow.setContent(this.content);
        infoWindow.setPosition(event.latLng);
        infoWindow.open(map);
      }



      }
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
          infoWindow.setPosition(pos);
          infoWindow.setContent(browserHasGeolocation ?
              'Error: El servicio de geolocalizacion no esta diponible.' :
              'Error: Your browser doesn\'t support geolocation.');
          infoWindow.open(map);
      }
      function attachSecretMessage(marker, secretMessage) {
          var infowindow = new google.maps.InfoWindow({
              content: secretMessage
          });

          marker.addListener('click', function() {
              infowindow.open(marker.get('map'), marker);
          });
      }
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFPv-DAgFBveRbqjSlqufPSLB1E3avBMI&callback=initMap"
        async defer></script>
