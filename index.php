<?php
session_start();

include_once("autoload.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<title>RESERVAS</title>
</head>

<body>

	<div class='container'>
		<h1 class='text-primary'>RESTAURANTE EL GULI</h1>

		<div class="container mt-5">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-10">
							<h4 class='text-success'>RESERVAS</h4>
						</div>
						<div class="col-sm-1">
							<input type="date" name="nueva_fecha" id="nueva_fecha" placeholder="Cambiar fecha">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-10">
							<input type="text" name="filtro" id="filtro" placeholder="Buscar">
						</div>

						<div class="col-sm-2">
							<button class='text-primary' id='nuevareserva' style="width: 130px;" data-toggle="modal" data-target="#exampleModal">Nueva reserva</button>
						</div>
					</div>

				</div>
				<section id='container'></section>

			</div>
		</div>
	</div>

	<div id='minsertar' class="modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Nueva reserva</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id='formreserva'>
						<div class="form-group">
							<label>Nombre</label>
							<input type='text' name='nombre' class="form-control">
						</div>
						<div class="form-group">
							<label>Apellidos</label>
							<input type="text" name="apellidos" id="" class="form-control">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" id="" class="form-control">
						</div>
						<div class="form-group">
							<label>Móvil</label>
							<input type="tel" name="movil" id="" class="form-control">
						</div>
						<div class="form-group">
							<label>Fecha</label>
							<input type="date" name="fecha" id="" class="form-control">
						</div>
						<div class="form-group">
							<label>Hora</label>
							<select class='form-control' id='hora' name='hora'>
								<option value='13:00'>13:00</option>
								<option value='14:00'>14:00</option>
								<option value='15:00'>15:00</option>
								<option value='19:30'>19:30</option>
								<option value='20:30'>20:30</option>
								<option value='21:30'>21:30</option>
							</select>
						</div>
						<div class="form-group">
							<label>Personas</label>
							<input type="number" min="0" name="ncomensales" id="" class="form-control">
						</div>
						<!--POR DEFECTO-->
						<input type="hidden" name="estado" value="preparada">

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" action='insert'>Insert</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>

				</form>
			</div>
		</div>
	</div>

	<div id="updatereservamodal" class="modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-info">Modificar reserva</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id='formupdatereserva' method='post'>
					<div class="modal-body">
						<p>Fecha:</p>
						<div class="form-group">
							<input type="date" id="fecha" name="fecha">
						</div>
						<p>Hora:</p>
						<div class="form-group">
							<select class='form-control' id='hora' name='hora'>
								<option value='13:00'>13:00</option>
								<option value='14:00'>14:00</option>
								<option value='15:00'>15:00</option>
								<option value='19:30'>19:30</option>
								<option value='20:30'>20:30</option>
								<option value='21:30'>21:30</option>
							</select>
						</div>
						<p>Número de comensales:</p>
						<div class="form-group">
							<input type="number" id="ncomensales" min="0" name="ncomensales">
						</div>
						<input id='apellidos' name='apellidos' value="" hidden>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" action='updateres'>Modificar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</form>

			</div>
		</div>
	</div>
	</div>

	<script>
		// Cargar las reservas con la fecha actual
		document.addEventListener("DOMContentLoaded", async () => {
			await loadReservas();
		});


		async function loadReservas() {

			let formData = new FormData();
			formData.append("action", "loadReservas");

			let res = await fetch("Controllers/controller.php", {
				method: "POST",
				body: formData,
			});
			let data = await res.text();

			document.getElementById("container").innerHTML = data;
		}

		// Cargar las reservas con la nueva fecha

		document.getElementById("nueva_fecha").addEventListener("input", async () => {
			await loadReservasPorFecha();
		});

		async function loadReservasPorFecha() {

			let formData = new FormData();
			formData.append("action", "loadReservasPorFecha");
			formData.append("nueva_fecha", document.getElementById("nueva_fecha").value);

			let res = await fetch("Controllers/controller.php", {
				method: "POST",
				body: formData,
			});
			let data = await res.text();

			document.getElementById("container").innerHTML = data;
		}

		// Cargar las reservas filtradas por apellidos

		document.getElementById("filtro").addEventListener("input", async () => {
			await loadReservasPorFiltro();
		});

		async function loadReservasPorFiltro() {

			let formData = new FormData();
			formData.append("action", "loadReservasPorFiltro");
			formData.append("filtro", document.getElementById("filtro").value);
			formData.append("fecha", document.getElementById("nueva_fecha").value);

			let res = await fetch("Controllers/controller.php", {
				method: "POST",
				body: formData,
			});
			let data = await res.text();

			document.getElementById("container").innerHTML = data;
		}

		// BORRAR  +  MODIFICAR    RESERVA POR APELLIDOs

		document.getElementById("container").addEventListener("click", async function(e) {
			if (e.target.closest("button[action=delete]")) {
				await deleteReserva(e.target.closest("button").value);
			}
			let link = e.target.closest("button[action=update]");
			if (link) {
				$('#updatereservamodal').modal('show');

				var modal = $('#updatereservamodal');
				modal.find('#fecha').val(link.getAttribute('fecha'));
				modal.find('#hora').val(link.getAttribute('hora'));
				modal.find('#ncomensales').val(link.getAttribute('ncomensales'));
				modal.find('#apellidos').val(link.getAttribute('apellidos'));
			}
		});

		// AÑADIR NUEVA RESERVA

		document.getElementById("formreserva").addEventListener("submit", async function(e) {
			e.preventDefault(); //Para que no envíe el formulario antes
			let formData = new FormData(e.target);
			formData.append("action", "newReserva"); //Acción al controlador para insertar

			let res = await fetch("Controllers/controller.php", {
				method: "POST",
				body: formData,
			});
			let data = await res.text();

			//Pintamos la respuesta en el contenedor
			document.getElementById("container").innerHTML = data;
			//Cerramos el modal
			$('#minsertar').modal('hide');
		});

		//Mostrar el modal 
		document.getElementById('nuevareserva').addEventListener("click", function() {
			$('#minsertar').modal('show');
		});

		//Función para borrar reserva
		async function deleteReserva(apellidos) {
			//Lo que enviamos con POST, la acción al controlador de borrar una reserva
			let formData = new FormData();
			formData.append("action", "deleteReserva");
			formData.append("apellidos", apellidos);

			//Consulta asíncrona al controlador
			let res = await fetch("Controllers/controller.php", {
				method: "POST",
				body: formData,
			});
			let data = await res.text();

			//Pintamos la respuesta en el contenedor
			document.getElementById("container").innerHTML = data;
		}

		document.getElementById("formupdatereserva").addEventListener("submit", async function(e) {
			e.preventDefault(); //Para que no envíe el formulario antes

			let formData = new FormData(e.target);
			formData.append("action", "updatereserva");

			let res = await fetch("Controllers/controller.php", {
				method: "POST",
				body: formData,
			});
			let data = await res.text();
			$('#updatereservamodal').modal('hide');
			document.getElementById("container").innerHTML = data;
		});
	</script>

</body>

</html>