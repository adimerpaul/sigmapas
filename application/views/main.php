<div style='height: 500px;with=100%' id="map"></div>
<script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -17.9647, lng: -67.106},
          zoom: 14,
          disableDoubleClickZoom: true, 
        });

        google.maps.event.addListener(map,'click',function(event) {                
                console.log(event.latLng.lat()+' '+event.latLng.lng()) ;
            });
        
        <?php
        $query=$this->db->query("SELECT * FROM minibus WHERE estado='ACTIVO'");
        foreach($query->result() as $row){
          //echo "SELECT * FROM puntos WHERE idminibus='$row->idminibus'";
          $query2=$this->db->query("SELECT * FROM puntos WHERE idminibus='$row->idminibus'");
          $p="";
          foreach($query2->result() as $row2){
            $p=$p." {lat: $row2->lat, lng: $row2->long},";
          }
            echo "var flightPlanCoordinates = [$p];
                  var flightPath = new google.maps.Polyline({
                      path: flightPlanCoordinates,
                      geodesic: true,
                      strokeColor: '$row->color',
                      strokeOpacity: 1.0,
                      strokeWeight: 5,
                      content: '$row->nombre'
                  });";
        
         }
        ?>
        

    flightPath.setMap(map);
    flightPath.addListener('click', showArrays);
    infoWindow = new google.maps.InfoWindow;
    function showArrays(event) {
    var vertices = this.getPath();
    infoWindow.setContent(this.content);
    infoWindow.setPosition(event.latLng);
    infoWindow.open(map);
  }

        <?php
        $query=$this->db->query("SELECT * FROM COLEGIO WHERE estado='ACTIVO'");
        foreach($query->result() as $row){
            echo " var marker = new google.maps.Marker({
                    position: {lat: $row->lat, lng: $row->long},
                    map: map,
                    title: '$row->nombre'
                });";
        }
        ?>
       
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgjOr5cGSqjKTsh5lQO5yqboLz9YYbbIE&callback=initMap"
    async defer></script>