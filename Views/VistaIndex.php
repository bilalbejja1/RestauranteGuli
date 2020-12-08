<?php

namespace Restaurante;

class VistaIndex
{

  public static function render($reservas)
  {

?>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Apellidos</th>
          <th scope="col">Email</th>
          <th scope="col">Móvil</th>
          <th scope="col">Fecha</th>
          <th scope="col">Hora</th>
          <th scope="col">Estado</th>
          <th scope="col">Personas</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>

        <?php
        //Pintamos los libros
        foreach ($reservas as $reserva) {
          echo "<tr>";
          echo "  <td>" . $reserva->getNombre() . "</td>";
          echo "  <td>" . $reserva->getApellidos() . "</td>";
          echo "  <td>" . $reserva->getEmail() . "</td>";
          echo "  <td>" . $reserva->getMovil() . "</td>";
          echo "  <td>" . $reserva->getFecha() . "</td>";
          echo "  <td>" . $reserva->getHora() . "</td>";
          echo "  <td>" . $reserva->getEstado() . "</td>";
          echo "  <td>" . $reserva->getNumComensales() . "</td>";
          echo "  <td>
                    <button class='text-primary books' action='delete' value='" . $reserva->getApellidos() . "'><i class='fas fa-trash-alt'></i></button>";
          echo "    <button class='text-warning ml-2' action='update' 
                                apellidos='" . $reserva->getApellidos() . "' 
                                fecha='" . $reserva->getFecha() . "'  
                                hora='" . $reserva->getHora() . "' 
                                ncomensales='" . $reserva->getNumComensales() . "'>
                                <i class='fas fa-pencil-alt'></i>
                    </button>";
          echo "  </td>";
          echo "</tr>";
        }

        ?>


      </tbody>
    </table>


<?php


  }
}

?>