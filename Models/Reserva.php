<?php

namespace Restaurante;

/*
 * Clase Reserva 
 */

class Reserva
{
    private $nombre;
    private $apellidos;
    private $email;
    private $movil;
    private $fecha;
    private $hora;
    private $estado;
    private $ncomensales;
    static $maxComensales;


    public function __construct($nombre = "", $apellidos = "", $email = "", $movil = "", $fecha = "", $hora = "", $estado = "", $ncomensales = 0)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->movil = $movil;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->estado = $estado;
        $this->estado = $estado;
        $this->ncomensales = $ncomensales;
        self::$maxComensales = 30;
    }

    public function __toString()
    {
        return $this->getApellidos() . ":"
            . $this->getFecha() . ":"
            . $this->getHora() . ":"
            . $this->getEstado() . ":"
            . $this->getNumComensales();
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellidos
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of movil
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set the value of movil
     *
     * @return  self
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of hora
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of ncomensales
     */
    public function getNumComensales()
    {
        return $this->ncomensales;
    }

    /**
     * Set the value of ncomensales
     *
     * @return  self
     */
    public function setNumComensales($ncomensales)
    {
        $this->ncomensales = $ncomensales;

        return $this;
    }
} 