<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<?php if(!isset($_SESSION)) 
    { 
        session_start(); 
    } ?>
<h1>Derivar/Atender Expedientes Registrados</h1>
<form class="form-inline" action="?controller=expediente&action=buscar" method="post">
	<div class="form-group row">
	  <div class="col-xs-4">
	    <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Ingrese el Número de Expediente">
	  </div>
	</div>
	<div class="form-group row">
	 <div class="col-xs-4">
	    <button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-search"> </span> Buscar</button>
	  </div>
		</div>
	</form>
	<?php if (isset($_SESSION['mensaje'])) { //mensaje, cuando realiza alguna acción crud ?>
			<div class="alert alert-success">
				<strong><?php echo $_SESSION['mensaje']; ?></strong>
			</div>
		<?php } 
			unset($_SESSION['mensaje']);	
		?>

<div class="container">
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Número</th>
					<th>Trámite</th>					
					<th>Estado</th>
					<th>Acción</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($lista_expedientes as $expediente)  {?>			
				<tr>
					<td><?php echo $expediente->getnumero(); ?></td>
					<?php foreach ($tramites as $tramite): ?>
						<?php if (strcmp($tramite->getId(),$expediente->getTramites_id())==0): ?>
							<td><?php echo $tramite->getNombre();?></td>
						<?php endif ?>
					<?php endforeach ?>
					
					<?php if (strcmp($expediente->getEstado(),"E")==0) {?>
						<td>Enviado</td>
					<?php }?>
					<?php if (strcmp($expediente->getEstado(),"D")==0) {?>
						<td>Derivado</td>
					<?php }?>
					<?php if (strcmp($expediente->getEstado(),"A")==0) {?>
						<td>Atendido</td>
					<?php }?>
				<td> <a href="?controller=expediente&action=derivarShow&idExpediente=<?php echo $expediente->getId() ?>">Tramitar</a></td>
				<td><a href="?controller=expediente&action=atenderShow&idExpediente=<?php echo $expediente->getId() ?>">Atender</a> </td>	
				<?php } ?>
			</tbody>
		</table>
		<ul class ="pagination">		
			<?php for ($i=1;$i<=$botones;$i++){ ?>
				<li><a href="?controller=expediente&action=tramitar&boton=<?php echo $i ?>"><?php echo $i; ?></a></li>
			<?php }?>			
		</ul>
	</div>
</div>