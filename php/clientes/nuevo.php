<!-- quick email widget -->
<div id="seccion-pais">
	<div class="box-header">
    	<i class="fa fa-building" aria-hidden="true">Gestión de Clientes</i>
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
    
                <form class="form-horizontal" role="form"  id="fclientes">


 					<div class="form-group">
                        <label class="control-label col-sm-2" for="Cliente_Codi">Codigo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Cliente_Codi" name="Cliente_Codi" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Cliente_Nom">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Cliente_Nom" name="Cliente_Nom" placeholder="Ingrese Nombre del cliente"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Cliente_Apell">Apellido:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Cliente_Apell" name="Cliente_Apell" placeholder="Ingrese apellido del cliente"
                            value = "">
                        </div>
                    </div>




                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Docu_Codi">Tipo de Documento: </label>
                        <div class="col-sm-10">
                            <select class="form-control" id="Docu_Codi" name="Docu_Codi">
                         
							</select>	
                        </div>
                    </div>

                    
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Documento">documento:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Documento" name="Documento" placeholder="Ingrese Documento del cliente"
                            value = "">
                        </div>
                    </div>

					                
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Cliente_Email">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Cliente_Email" name="Cliente_Email" placeholder="Ingrese Email del cliente"
                            value = "">
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Cliente_Cel">Celular:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Cliente_Cel" name="Cliente_Cel" placeholder="Ingrese celular del cliente"
                            value = "">
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Cliente_Direc">Direccion:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Cliente_Direc" name="Cliente_Direc" placeholder="Ingrese direccion del cliente"
                            value = "">
                        </div>
                    </div>

                       


					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar Cliente">Grabar Cliente</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar2" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>
</div>