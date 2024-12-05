<?php

    namespace Coworking\modelos;

    class Reserva{
        private $id;
        private $nombre_usuario;
        private $nombre_sala;
        private $fecha_reserva;
        private $hora_inicio;
        private $hora_fin;
        private $estado;

        /**
         * @param $id
         * @param $nombre_usuario
         * @param $nombre_sala
         * @param $fecha_reserva
         * @param $hora_inicio
         * @param $hora_fin
         */
        public function __construct($id="", $nombre_usuario="", $nombre_sala="", $fecha_reserva="", $hora_inicio="", $hora_fin="")
        {
            $this->id = $id;
            $this->nombre_usuario = $nombre_usuario;
            $this->nombre_sala = $nombre_sala;
            $this->fecha_reserva = $fecha_reserva;
            $this->hora_inicio = $hora_inicio;
            $this->hora_fin = $hora_fin;
            $this->estado = "confirmada";
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
        public function setId($id): void
        {
            $this->id = $id;
        }

        /**
         * @return mixed|string
         */
        public function getNombreUsuario()
        {
            return $this->nombre_usuario;
        }

        /**
         * @param mixed|string $nombre_usuario
         */
        public function setNombreUsuario($nombre_usuario): void
        {
            $this->nombre_usuario = $nombre_usuario;
        }

        /**
         * @return mixed|string
         */
        public function getNombreSala()
        {
            return $this->nombre_sala;
        }

        /**
         * @param mixed|string $nombre_sala
         */
        public function setNombreSala($nombre_sala): void
        {
            $this->nombre_sala = $nombre_sala;
        }

        /**
         * @return mixed|string
         */
        public function getFechaReserva()
        {
            return $this->fecha_reserva;
        }

        /**
         * @param mixed|string $fecha_reserva
         */
        public function setFechaReserva($fecha_reserva): void
        {
            $this->fecha_reserva = $fecha_reserva;
        }

        /**
         * @return mixed|string
         */
        public function getHoraInicio()
        {
            return $this->hora_inicio;
        }

        /**
         * @param mixed|string $hora_inicio
         */
        public function setHoraInicio($hora_inicio): void
        {
            $this->hora_inicio = $hora_inicio;
        }

        /**
         * @return mixed|string
         */
        public function getHoraFin()
        {
            return $this->hora_fin;
        }

        /**
         * @param mixed|string $hora_fin
         */
        public function setHoraFin($hora_fin): void
        {
            $this->hora_fin = $hora_fin;
        }

        public function getEstado(): string
        {
            return $this->estado;
        }

        public function setEstado(string $estado): void
        {
            $this->estado = $estado;
        }






    }
