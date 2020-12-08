<?php
include_once("..\autoload.php");

use Restaurante\ReservaDB;
use Restaurante\VistaIndex;

//Función para filtrar los valores recibidos de un formulario
function filtrado($datos)
{
    $datos = trim($datos);                                  // Elimina espacios antes y después de los datos
    $datos = stripslashes($datos);                          // Elimina backslashes \
    $datos = filter_var($datos, FILTER_SANITIZE_STRING);     // Elimina todas las etiquetas    
    return $datos;
}

//Acción de cargar los libros en la página principal
if (isset($_POST['action'])) {
    // RESERVAS DE HOY
    if ($_POST['action'] == "loadReservas") {
        $current_date = date("Y-m-d");
        $reservas = ReservaDB::getReservas($current_date);
        VistaIndex::render($reservas);
    }

    // RESERVAS DE DETERMINADA FECHA
    if ($_POST['action'] == "loadReservasPorFecha") {
        $fecha = filtrado($_POST['nueva_fecha']);
        if ($fecha != "") {
            if (count(ReservaDB::getReservas($fecha)) >= 1) {
                $reservas = ReservaDB::getReservas($fecha);
                VistaIndex::render($reservas);
            } else {
                echo '<div class="alert alert-primary" style="text-align: center;" role="alert">
                En la fecha seleccionada no hay reservas!!
              </div>';
            }
        } else {
            $fecha = date("Y-m-d");
            $reservas = ReservaDB::getReservas($fecha);
            VistaIndex::render($reservas);
        }
    }

    // CARGAR RESERVAS FILTRADAS POR APELLIDOS 

    if ($_POST['action'] == "loadReservasPorFiltro") {
        $filtro = filtrado($_POST['filtro']);
        $fecha = filtrado($_POST['fecha']);

        if ($fecha != "") {
            if (count(ReservaDB::getReservasFiltroYFecha($filtro, $fecha)) >= 1) {
                $reservas = ReservaDB::getReservasFiltroYFecha($filtro, $fecha);
                VistaIndex::render($reservas);
            } else {
                echo '<div class="alert alert-primary" style="text-align: center;" role="alert">
                No hay reservas con el filtro introducido!!
              </div>';
            }
        } else {
            $fecha = date("Y-m-d");
            $reservas = ReservaDB::getReservasFiltroYFecha($filtro, $fecha);
            VistaIndex::render($reservas);
        }
    }

    // BORRAR POR APELLIDOS

    if ($_POST['action'] == "deleteReserva") {
        ReservaDB::deleteReserva($_POST['apellidos']);
        $current_date = date("Y-m-d");
        $reservas = ReservaDB::getReservas($current_date);
        VistaIndex::render($reservas);
    }

    // AÑADIR NUEVA RESERVA

    if ($_POST['action'] == "newReserva") {
        ReservaDB::newReserva($_POST);
        $current_date = date("Y-m-d");
        $reservas = ReservaDB::getReservas($current_date);
        VistaIndex::render($reservas);
    }

    //Acción de modificar reserva

    if ($_POST['action'] == 'updatereserva') {

        ReservaDB::updateReserva(
            filtrado($_POST['fecha']),
            filtrado($_POST['hora']),
            filtrado($_POST['ncomensales']),
            filtrado($_POST['apellidos'])
        );
        $current_date = date("Y-m-d");
        $reservas = ReservaDB::getReservas($current_date);
        VistaIndex::render($reservas);
    }
}
