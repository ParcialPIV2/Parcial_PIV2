<!-- quick email widget -->
<div id="seccion-empleados">
	<div class="box-header">
    	<i class="fa fa-building" aria-hidden="true">Gestión de empleados</i>
        <!-- tools box -->
        <div class="pull-right box-tools">
        	<button class="btn btn-info btn-sm btncerrar2" data-toggle="tooltip" title="Cerrar"><i class="fa fa-times"></i></button>
        </div><!-- /. tools -->
    </div>
    <div class="box-body">

		<div align ="center">
				<div id="actual"> 
				</div>
		</div>


        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">
    
                <form class="form-horizontal" role="form"  id="fempleados">


 					<div class="form-group">
                        <label class="control-label col-sm-2" for="Emple_Codi">Codigo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Emple_Codi" name="Emple_Codi" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Emple_Nomb">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Emple_Nomb" name="Emple_Nomb" placeholder="Ingrese nombre del empleado"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Emple_Nomb2">Apellido del empleado:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Emple_Nomb2" name="Emple_Nomb2" placeholder="Ingrese apellido del empleado"
                            value = "">
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Cargo_codi">Cargo:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="Cargo_codi" name="Cargo_codi">
                         
							</select>	
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar empleados">Grabar empleados</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar2" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>
</div>