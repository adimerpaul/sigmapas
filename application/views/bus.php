<h3>Controlar Minibus</h3>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success m-2" data-toggle="modal" data-target="#exampleModal">
    <i class='fa fa-bus'></i> Nuevo minibus
</button>
<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>id</th>
        <th>Nombre</th>
        <th>Color</th>
        <th>Estado</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $query=$this->db->query("SELECT * FROM minibus");
    foreach($query->result() as $row){
        echo "<tr>
                        <td>$row->idminibus</td>
                        <td>$row->nombre $row->orientacion</td>
                        <td> <div style='background:$row->color;width: 20px;height: 10px;'> </div> </td>
                        <td>$row->estado</td>
                        <td> 
                            <a href='".base_url()."Bus/delete/$row->idminibus' class='eli btn-sm btn-danger'><i class='fa fa-trash'></i> Eliminar</a>
                            
                        </td>
                    </tr>";
    }
    ?>

    </tbody>
</table>

<style>
    .modal-lg {
        min-width: 98%;
    }


</style>
<!-- Modal -->
<div class="modal full-screen" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Minibus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method='POST' action='<?=base_url()?>Bus/insert'>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <div class="row">
                                <label for="nombre" class="col-sm-1 col-form-label">Nombre</label>
                                <div class="col-sm-3">
                                    <input type="text" name='nombre' class="form-control" id="nombre" placeholder="Nombre" required>
                                </div>
                                <label for="orientacion" class="col-sm-1 col-form-label">Orientacion</label>
                                <div class="col-sm-3">
                                    <input type="text" name='orientacion' class="form-control" id="orientacion" placeholder="Orientacion" >
                                </div>
                                <label for="color" class="col-sm-1 col-form-label">Color</label>
                                <div class="col-sm-3">
                                    <input type="color" name='color' class="form-control" id="color" placeholder="Color" >
                                </div>
                            </div>
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
                        <div class="col-sm-4">
                            <label class="col-sm-12 col-form-label">Punto</label>
                            <div id="contenedor">

                            </div>
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
        cantida=0;
        $('#example').DataTable();
        google.maps.event.addListener(map,'click',function(event) {
            //$('#lat').val(event.latLng.lat());
            //$('#long').val(event.latLng.lng());
            //var puntos =document.getElementsByClassName('puntos');
            cantida=cantida+1
            $('#contenedor').append("<small class='puntos'><input style='font-size: 10px' name='lat"+cantida+"' value='"+event.latLng.lat()+"'><input style='font-size: 10px' name='long"+cantida+"' value='"+event.latLng.lng()+"'> <i class='fa fa-trash'></i></small><br>");

            // for (var i=0;i<puntos.length;i++){
            //     puntos[i].addEventListener('click',function (e) {
            //         if(!confirm('Seguro de eliminar?')){
            //             $(this).remove();
            //         }
            //         e.preventDefault();
            //     })
            // }
            $('.puntos').click(function (e) {

                    $(this).remove();

            });

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