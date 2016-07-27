<?php /* Template Name:Aportes */ 

get_header(); // This fxn gets the header.php file and renders it ?>


			<?php if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post(); 
				// If we have a post to show, start a loop that will display it
				?>
	
				<div class="container">
						<div class="col-md-12 main-texto">
								<h1>
									<?php the_title(); ?>
								</h1>
								<?php the_content(); ?>
						</div>
				</div>
				
				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
		
			<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
				
				<article class="post error">
					<h1 class="404">No hay nada</h1>
				</article>

			<?php endif; // OK, I think that takes care of both scenarios (having a post or not having a post to show) ?>
<div class="container" id="contact_form" data-form="<?php bloginfo('template_directory');?>">
	<h2>Formulario para hacer tu aporte</h2>
	<p>Completá los datos para que podamos contactarte y solicitar los datos bancarios para la adhesión al débito. Algún intregrante de Ciudad Futura (acreditado con una credencial) buscará esos datos pasando por tu casa o trabajo. </p>
	<!--<iframe src="https://docs.google.com/forms/d/1jcJPcixj0StcZOZEAVDlsDlzXNTHZSXatURwUe23zn8/viewform?embedded=true" width="100%" height="1920" frameborder="0" marginheight="0" marginwidth="0">Cargando...</iframe>-->
	<label for="nombre">Nombre y Apellido</label>
	<input type="text" id="nombre" name="nombre">
	<label for="dni">DNI</label>
	<input type="text" id="dni" name="dni">
	<label for="cuil">CUIL</label>
	<input type="text" id="cuil" name="cuil">
	<label for="mail">Mail</label>
	<input type="text" id="mail" name="mail">
	<label for="telefono">Teléfono</label>
	<input type="text" id="telefono" name="telefono">
	<label for="facebook">Facebook</label>
	<input type="text" id="facebook" name="facebook">
	<label for="direccion">Dirección</label>
	<input type="text" id="direccion" name="direccion">
	<label for="localidad">Localidad</label>
	<input type="text" id="localidad" name="localidad">
	<label for="codigo">Código Postal</label>
	<input type="text" id="codigo" name="codigo">
	<label for="elegi">Elegí tu aporte</label>
	<ul class="dinero">
	<!--glyphicon glyphicon-unchecked  glyphicon glyphicon-check-->
		<li> <span class="glyphicon glyphicon-unchecked" data-check="100"></span> $100 </li>
		<li> <span class="glyphicon glyphicon-unchecked" data-check="200"></span> $200 </li>
		<li> <span class="glyphicon glyphicon-unchecked" data-check="500"></span> $500 </li>
		<li id="otro"> <span class="glyphicon glyphicon-unchecked" data-check="otro"></span> otro <input type="text" id="otro_input"></li>
	</ul>
	<div class="enviar" id="enviar">Enviar</div>
	<!--<p class="descarga">DESCARGÁ EL PDF <a href="#">ACÁ</a>, IMPRIMILO Y COMPLETALO CON TUS DATOS BANCARIOS</p>-->
</div>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>