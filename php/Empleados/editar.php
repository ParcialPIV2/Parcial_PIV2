   <div id="seccion-empleados">
    <div class="box-header">
    	<i class="fa fa-building" aria-hidden="true">Gestion de empleados</i>
        
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
                            value = "" readonly="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Emple_Nomb">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Emple_Nomb" name="Emple_Nomb" placeholder="Ingrese Nombre empleados"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Emple_Apell">Apellido del empleado:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Emple_Apell" name="Emple_Apell" placeholder="Ingrese apellido del empleados"
                            value = "">
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Cargo_Codi">Cargo:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="Cargo_Codi" name="Cargo_Codi">
							
							</select>
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" data-toggle="tooltip" title="Actualizar empleados" class="btn btn-primary">Actualizar</button>
                            <button type="button" id="cancelar" data-toggle="tooltip" title="Cancelar Edición" class="btn btn-success btncerrar2"> Cancelar </button>
                        </div>

                    </div>                    

					<input type="hidden" id="editar" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>
    <input type="hidden" id="pagina" value="editar" name="editar"/>
</div>