<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/mil.css" media="screen" />

<h1>Aportes de la gente</h1>
<div class="tool-wrap">
	<button id="mostrar_mails">Mostrar mails</button>
</div>
<div class="table-wrap">
<?php 
$result = $wpdb->get_results( "SELECT * FROM aportes "); /*mulitple row results can be pulled from the database with get_results function and outputs an object which is stored in $result */
//echo "<pre>"; print_r($result); echo "</pre>";

foreach($result as $row)
 {
?>
	<table id="<?php echo $row->id; ?>">
		<tr>
			<td class="label">Nombre:</td>
			<td><?php echo utf8_decode($row->nombre); ?></td>
		</tr>
		<tr>
			<td class="label">Domicilio:</td>
			<td><?php echo utf8_decode($row->domicilio); ?></td>
		</tr>
		<tr>
			<td class="label">DNI:</td>
			<td><?php echo utf8_decode($row->dni); ?></td>
		</tr>
		<tr>
			<td class="label">E-mail:</td>
			<td><?php echo utf8_decode($row->email); ?></td>
		</tr>
		<tr>
			<td class="label">Facebook:</td>
			<td><?php echo utf8_decode($row->facebook); ?></td>
		</tr>
		<tr>
			<td class="label">Teléfono:</td>
			<td><?php echo utf8_decode($row->telefono); ?></td>
		</tr>
		<tr>
			<td class="label">Cuil:</td>
			<td><?php echo utf8_decode($row->cuil); ?></td>
		</tr>
		<tr>
			<td class="label">Localidad:</td>
			<td><?php echo $row->localidad; ?></td>
		</tr>
		<tr>
			<td class="label">Código:</td>
			<td><?php echo utf8_decode($row->codigo); ?></td>
		</tr>
		<tr>
			<td class="label">Aporte:</td>
			<td><?php echo $row->aporte; ?></td>
		</tr>
	</table>
	<hr />
<?php
 }
?>
</div>
