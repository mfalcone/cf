<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/mil.css" media="screen" />

<h1>Directorio de Militantes</h1>
<div class="tool-wrap">
	<button id="mostrar_mails">Mostrar mails</button>
</div>
<div class="table-wrap">
<?php 
$result = $wpdb->get_results( "SELECT * FROM militantes "); /*mulitple row results can be pulled from the database with get_results function and outputs an object which is stored in $result */
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
			<td class="label">Fecha de Nacimiento:</td>
			<td><?php echo utf8_decode($row->fecha_nacimiento); ?></td>
		</tr>
		<tr>
			<td class="label">Domicilio Real:</td>
			<td><?php echo utf8_decode($row->domicilio_real); ?></td>
		</tr>
		<tr>
			<td class="label">Domicilio legal:</td>
			<td><?php echo utf8_decode($row->domicilio_legal); ?></td>
		</tr>
		<tr>
			<td class="label">Distrito:</td>
			<td><?php echo utf8_decode($row->distrito); ?></td>
		</tr>
		<tr>
			<td class="label">Teléfono:</td>
			<td><?php echo utf8_decode($row->telefono); ?></td>
		</tr>
		<tr>
			<td class="label">E-mail:</td>
			<td><?php echo $row->email; ?></td>
		</tr>
		<tr>
			<td class="label">Usuario de facebook:</td>
			<td><?php echo utf8_decode($row->facebook); ?></td>
		</tr>
		<tr>
			<td class="label">Usuario de twitter:</td>
			<td><?php echo $row->twitter; ?></td>
		</tr>
		<tr>
			<td class="label">whatsapp:</td>
			<td><?php echo $row->whatsapp; ?></td>
		</tr>
		<tr>
			<td class="label">Afiliacion:</td>
			<td><?php echo utf8_decode($row->afiliacion); ?></td>
		</tr>
		<tr>
			<td class="label">Ocupacion:</td>
			<td><?php echo utf8_decode($row->ocupacion); ?></td>
		</tr>
		<tr>
			<td class="label">Aporte:</td>
			<td><?php echo utf8_decode($row->aporte); ?></td>
		</tr>
		<tr>
			<td class="label">Espacio:</td>
			<td><?php echo utf8_decode($row->espacio); ?></td>
		</tr>
		<tr>
			<td class="label">Horario: </td>
			<td><?php echo utf8_decode($row->horario); ?></td>
		</tr>
		<tr>
			<td class="label">Espacio Concreto:</td>
			<td><?php echo utf8_decode($row->espacio_concreto); ?></td>
		</tr>
		<tr>
			<td class="label">Fiscalizó:</td>
			<td><?php echo utf8_decode($row->fiscalizo); ?></td>
		</tr>
		<tr>
			<td class="label">Rol:</td>
			<td><?php echo utf8_decode($row->rol); ?></td>
		</tr>
	</table>

<?php
 }
?>
</div>
<div class="modal">
	<button id="cerrar_modal">cerrar</button>
	<textarea name="" id="" cols="30" rows="10">
	<?php foreach($result as $mail){
		if($mail->email != ""){
			 echo $mail->email."; ";
			};
		}?>
	</textarea>
</div>
<script type="text/javascript">
	$ = jQuery;
	$(document).ready(function(){
		$("#mostrar_mails").click(function(){
			$(".modal").show();
		})

		$("#cerrar_modal").click(function(){
			$(".modal").hide();
		})
	})
</script>
