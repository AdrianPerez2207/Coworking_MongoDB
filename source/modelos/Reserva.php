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

        public function getId(): mixed
        {
            return $this->id;
        }

        public function setId(mixed $id): void
        {
            $this->id = $id;
        }

        public function getNombreUsuario(): mixed
        {
            return $this->nombre_usuario;
        }

        public function setNombreUsuario(mixed $nombre_usuario): void
        {
            $this->nombre_usuario = $nombre_usuario;
        }

        public function getNombreSala(): mixed
        {
            return $this->nombre_sala;
        }

        public function setNombreSala(mixed $nombre_sala): void
        {
            $this->nombre_sala = $nombre_sala;
        }

        public function getFechaReserva(): mixed
        {
            return $this->fecha_reserva;
        }

        public function setFechaReserva(mixed $fecha_reserva): void
        {
            $this->fecha_reserva = $fecha_reserva;
        }

        public function getHoraInicio(): mixed
        {
            return $this->hora_inicio;
        }

        public function setHoraInicio(mixed $hora_inicio): void
        {
            $this->hora_inicio = $hora_inicio;
        }

        public function getHoraFin(): mixed
        {
            return $this->hora_fin;
        }

        public function setHoraFin(mixed $hora_fin): void
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
