<h3>Controlar colegios</h3>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success m-2" data-toggle="modal" data-target="#exampleModal">
  <i class='fa fa-school'></i> Nevo colegio
</button>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>lat y long</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query=$this->db->query("SELECT * FROM colegio");
            foreach($query->result() as $row){
                echo "<tr>
                        <td>$row->idcolegio</td>
                        <td>$row->nombre</td>
                        <td>$row->lat,$row->long</td>
                        <td>$row->estado</td>
                        <td> 
                            <a href='".base_url()."Colegios/delete/$row->idcolegio' class='eli btn-sm btn-danger'><i class='fa fa-trash'></i> Eliminar</a>
                            <form action='".base_url()."Main/index' method='post'>
                                  <input type='text' hidden name='lat' value='$row->lat'>
                                  <input type='text' hidden name='long' value='$row->long'>
                            <button type='submit' class='btn-sm btn-info'><i class='fa fa-eye'></i> Ver</button>
                            </form>
                            
                        </td>
                    </tr>";
            }
            ?>
            
        </tbody>
    </table>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo colegio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method='POST' action='<?=base_url()?>Colegios/insert'>
        <div class="form-group row">
            <label for="nombre" class="col-sm-1 col-form-label">Nombre</label>
            <div class="col-sm-3">
            <input type="text" name='nombre' class="form-control" id="nombre" placeholder="Nombre" required>
            </div>
            <label for="lat" class="col-sm-1 col-form-label">lat</label>
            <div class="col-sm-3">
            <input type="text" name='lat' class="form-control" id="lat" placeholder="lat">
            </div>
            <label for="long" class="col-sm-1 col-form-label">long</label>
            <div class="col-sm-3">
            <input type="text" name='long' class="form-control" id="long" placeholder="long">
            </div>
            <div class="col-sm-12">
                <div style="width: 100%;height: 400px" id="map"></div>
                <script>
                    var map;
                    function initMap() {
                        map = new google.maps.Map(document.getElementById('map'), {
                            center: {lat: -17.9647, lng: -67.106},
                            zoom: 14,
                            disableDoubleClickZoom: true,
                        });


                    }

                </script>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save changes</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<script>
window.onload=function(){
    $('#example').DataTable();
    google.maps.event.addListener(map,'click',function(event) {
        $('#lat').val(event.latLng.lat());
        $('#long').val(event.latLng.lng());
    });
    var eli =document.getElementsByClassName('eli');
    for (var i=0;i<eli.length;i++){
        eli[i].addEventListener('click',function (e) {
            if(!confirm('Seguro de eliminar?')){
                e.preventDefault();
            }
        })
    }
};
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgjOr5cGSqjKTsh5lQO5yqboLz9YYbbIE&callback=initMap"
        async defer></script>