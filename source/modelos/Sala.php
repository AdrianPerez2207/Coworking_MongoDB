<?php

    namespace Coworking\modelos;

    class Sala{
        private $id;
        private $nombre;
        private $capacidad;
        private $ubicacion;

        /**
         * @param $id
         * @param $nombre
         * @param $capacidad
         * @param $ubicacion
         */
        public function __construct($id="", $nombre="", $capacidad="", $ubicacion="")
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->capacidad = $capacidad;
            $this->ubicacion = $ubicacion;
        }

        /**
         * @return mixed|string
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed|string $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed|string
         */
        public function getNombre()
        {
            return $this->nombre;
        }

        /**
         * @param mixed|string $nombre
         */
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }

        /**
         * @return mixed|string
         */
        public function getCapacidad()
        {
            return $this->capacidad;
        }

        /**
         * @param mixed|string $capacidad
         */
        public function setCapacidad($capacidad)
        {
            $this->capacidad = $capacidad;
        }

        /**
         * @return mixed|string
         */
        public function getUbicacion()
        {
            return $this->ubicacion;
        }

        /**
         * @param mixed|string $ubicacion
         */
        public function setUbicacion($ubicacion)
        {
            $this->ubicacion = $ubicacion;
        }




    }
