<div id="seccion-pais">
    <div class="box-header">
    	<i class="fa fa-building" aria-hidden="true">Gestion de pais</i>
        
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
                        <label class="control-label col-sm-2" for="Cliente_Codi">Codigo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Cliente_Codi" name="Cliente_Codi" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Cliente_Nomb">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Cliente_Nomb" name="Cliente_Nomb" placeholder="Ingrese Nombre del empleado"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Cliente_Apell">Apellido:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Cliente_Apell" name="Cliente_Apell" placeholder="Ingrese apellido del empleado"
                            value = "">
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Docu_Codi">codigo documento: </label>
                        <div class="col-sm-10">
                            <select class="form-control" id="Docu_Codi" name="Docu_Codi">
                         
							</select>	
                        </div>
                    </div>
					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" data-toggle="tooltip" title="Actualizar empleado" class="btn btn-primary">Actualizar</button>
                            <button type="button" id="cancelar" data-toggle="tooltip" title="Cancelar Edición" class="btn btn-success btncerrar2"> Cancelar </button>
                        </div>

                    </div>                    

					<input type="hidden" id="editar" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>
    <input type="hidden" id="pagina" value="editar" name="editar"/>
</div>