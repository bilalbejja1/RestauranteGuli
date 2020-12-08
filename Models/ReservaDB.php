<?php

namespace Restaurante;

use Restaurante\ConexionDB;
use \PDO;
use \PDOException;

class ReservaDB
{
    //Ver reservas por fecha
    public static function getReservas($fecha)
    {
        // Cambiar el estado a finalzada si ha pasado la hora de la reserva
        self::cambiarEstadoReserva();

        $consulta = "SELECT * FROM reservas WHERE fecha=:fecha";

        $conexion = ConexionDB::conectar("2daw");

        try {
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(":fecha", $fecha);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Restaurante\Reserva");
        } catch (PDOException $e) {
            echo $e->getMessage();
            file_put_contents("bd.log", $e->getMessage(), FILE_APPEND | LOCK_EX);
        }

        ConexionDB::desconectar();

        return $resultado;
    }

    // Cambia el estado a finalizada si se pasa la fecha y hora de una reserva
    public static function cambiarEstadoReserva()
    {   
        $fecha = date("Y-m-d");
        $hora = date("H:i");
        //select * from reservas where fecha <= '2020-12-10' and hora <= '22:00'
        $consulta = "UPDATE reservas SET estado='finalizada' WHERE fecha<=:fecha AND hora<=:hora;";
        $conexion = ConexionDB::conectar("2daw");

        try {
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(":fecha", $fecha);
            $stmt->bindParam(":hora", $hora);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            file_put_contents("bd.log", $e->getMessage(), FILE_APPEND | LOCK_EX);
        }

        ConexionDB::desconectar();
    }

    //Ver reservas filtradas en el dia seleccinoado
    public static function getReservasFiltroYFecha($filtro, $fecha)
    {

        $consulta = "SELECT * FROM reservas  WHERE apellidos LIKE CONCAT('%', :filtro, '%') AND fecha=:fecha";

        $conexion = ConexionDB::conectar("2daw");

        try {
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(":filtro", $filtro);
            $stmt->bindParam(":fecha", $fecha);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Restaurante\Reserva");
        } catch (PDOException $e) {
            echo $e->getMessage();
            file_put_contents("bd.log", $e->getMessage(), FILE_APPEND | LOCK_EX);
        }

        ConexionDB::desconectar();
        return $resultado;
    }

    //Insertar reserva
    public static function newReserva($post)
    {
        //Quitamos action de $post si se manda con Ajax una acción
        array_pop($post);

        if (
            $post['ncomensales'] <= 10
            &&
            $post['ncomensales'] + self::sumNumComensales($post['fecha'], $post['hora']) <= 30
        ) {
            $consulta = "INSERT INTO reservas (";
            foreach ($post as $key => $value) {
                $consulta .= $key . ", ";
            }
            $consulta = substr($consulta, 0, -2); //Quitamos última coma y el espacio
            $consulta .= ") VALUES (";
            foreach ($post as $key => $value) {
                $consulta .= ":" . $key . ", ";
            }
            $consulta = substr($consulta, 0, -2); //Quitamos última coma y el espacio
            $consulta .= ");";

            $conexion = ConexionDB::conectar("2daw");

            try {
                $stmt = $conexion->prepare($consulta);

                foreach ($post as $key => $value) {
                    $param = ":" . $key;
                    $stmt->bindValue($param, filtrado($value)); //Ojo aquí que es bindValue
                }

                $stmt->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                file_put_contents("bd.log", $e->getMessage(), FILE_APPEND | LOCK_EX);
            }
            ConexionDB::desconectar();
        }

        if (
            // NO SE PUEDE RESERVAR MÁS DE 10 A LA VEZ
            $post['ncomensales'] > 10
        ) {
            echo '<div class="alert alert-primary" style="text-align: center;" role="alert">
            Una persona no puede reservar para más de 10 a la vez!!
          </div>';
        }

        if (
            // HAY QUE COMPROBAR QUE NO HAYA MÁS DE 30 PERSONAS ESE DÍA A ESA HORA
            $post['ncomensales'] + self::sumNumComensales($post['fecha'], $post['hora']) > 30
        ) {
            echo '<div class="alert alert-primary" style="text-align: center;" role="alert">
            Lo siento ese día a esa hora nos quedan ' . (30 - self::sumNumComensales($post['fecha'], $post['hora'])) . ' plazas!!
          </div>';
        }
    }

    // Devuelve el numero de personas en un dia y hora concretos
    public static function sumNumComensales($fecha, $hora)
    {
        $consulta = "SELECT sum(ncomensales) as totalPersonas FROM reservas where fecha=:fecha and hora=:hora and estado='preparada';";
        $conexion = ConexionDB::conectar("2daw");

        try {
            $stmt = $conexion->prepare($consulta);
            $stmt->bindValue(":fecha", $fecha);
            $stmt->bindValue(":hora", $hora);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            file_put_contents("bd.log", $e->getMessage(), FILE_APPEND | LOCK_EX);
        }

        ConexionDB::desconectar();
        return $resultado["totalPersonas"];
    }

    //Borrar reserva
    public static function deleteReserva($apellidos)
    {
        $consulta = "UPDATE reservas SET estado='cancelada' WHERE apellidos=:apellidos;";
        $conexion = ConexionDB::conectar("2daw");

        try {
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(":apellidos", $apellidos);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            file_put_contents("bd.log", $e->getMessage(), FILE_APPEND | LOCK_EX);
        }

        ConexionDB::desconectar();
    }

    //Update reserva
    public static function updateReserva($fecha, $hora, $ncomensales, $apellidos)
    {
        $consulta = "UPDATE reservas SET fecha=:fecha, hora=:hora,  ncomensales=:ncomensales WHERE apellidos=:apellidos;";
        $conexion = ConexionDB::conectar("2daw");

        try {
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(":fecha", $fecha);
            $stmt->bindParam(":hora", $hora);
            $stmt->bindParam(":ncomensales", $ncomensales);
            $stmt->bindParam(":apellidos", $apellidos);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            file_put_contents("bd.log", $e->getMessage(), FILE_APPEND | LOCK_EX);
        }

        ConexionDB::desconectar();
    }
}
