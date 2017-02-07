<div class="container">
	<div id="body">
        <div class="row">
        	<div class="col-md-12 col-lg-12">
        		<div class="table-responsive">
        			<table class="table table-striped">
        				<tr>
        					<th>Id</th>
        					<th>Nombre</th>
        					<th>Apellidos</th>
        					<th>Sexo</th>
        				</tr>
                        <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><a href="<?=base_url()?>clientes/cliente/id/<?=$cliente['id']?>/token/<?=$token?>"><?=$cliente['id']?></a></td>
                            <td><?=$cliente['nombre']?></td>
                            <td><?=$cliente['apellidos']?></td>
                            <td><?=$cliente['sexo']?></td>
                        </tr>
                        <?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>
