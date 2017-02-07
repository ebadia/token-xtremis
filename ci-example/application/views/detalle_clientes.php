

<div class="container">
    <div class="row">
        <div><a href="<?=base_url()?>clientes/lista/token/<?=$token?>">Listado</a></div>
        <ul class="list-group">
            <li class="list-group-item"><?=$cliente->nombre?></li>
            <li class="list-group-item"><?=$cliente->apellidos?></li>
            <li class="list-group-item"><?=$cliente->sexo?></li>
            <li class="list-group-item"><?=$cliente->alta?></li>
        </ul>
    </div>
</div>
