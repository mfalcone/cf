<?php /* Template Name:Formulario */ 

get_header(); // This fxn gets the header.php file and renders it ?>
<div id="main-formulario" data-form="<?php bloginfo('template_directory');?>">
	<div class="image-container historia-img"></div>
	<section>
		
		<header>
			<h1>Gente común haciendo cosas fuera de lo común</h1>
			<h2>-Eso es ciudad futura-</h2>
		</header>
		<form>
			<fieldset>
				<label for="nombre">Nombre y Apellido</label>
				<input type="text" name="nombre" id="nombre">
				<label for="domicilio">Domicilio</label>
				<input type="text" name="domicilio" id="domicilio">
			</fieldset>	
			<fieldset>	
				<label for="nacimiento">Fecha de nac. (dd/mm/aaaa)</label>
				<input type="text" name="nacimiento" id="nacimiento">
				<label for="celular">Número de celular</label>
				<input type="number" name="celular" id="celular">
				<label for="mail">Correo electrónico</label>
				<input type="mail" name="mail" id="mail">
			</fieldset>	
			<fieldset>	
				<label for="facebook">Usuario de Facebook</label>
				<input type="text" name="facebook" id="facebook">
				<label for="twitter">Usuario de Twitter</label>
				<input type="text" name="twitter" id="twitter">
			</fieldset>
			<fieldset>
				<label for="distrito">Distrito donde vive</label>
				<input type="radio" name="distrito" value="centro" /><label for="centro" class="distrito-label">centro</label>
				<input type="radio" name="distrito" value="norte" /><label for="norte" class="distrito-label">norte</label>
				<input type="radio" name="distrito" value="oeste" /><label for="oeste" class="distrito-label">oeste</label>
				<input type="radio" name="distrito" value="noroeste" /><label for="noroeste" class="distrito-label">noroeste</label>
				<input type="radio" name="distrito" value="sudoeste" /><label for="sudoeste" class="distrito-label">sudoeste</label>
			</fieldset>
			<fieldset>
				<label for="ocupacion">Ocupación | Profesión | Empleo</label>
				<textarea name="ocupacion" id="ocupacion" cols="30" rows="10"></textarea>
				<label for="aporte">Tu aporte a Ciudad Futura</label>
				<textarea name="aporte" id="aporte" cols="30" rows="10" placeholder="conocimientos, ideas, capacidades, saberes, oficios, horas de trabajo, etc."></textarea>
			</fieldset>
			<div id="sumate">Sumate</div>
		</form>

	</section>

</div>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/form.js"></script>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>