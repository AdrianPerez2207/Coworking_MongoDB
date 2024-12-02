<?php

    namespace Coworking\modelos;

    class Usuario{

        private $id;
        private $nombre;
        private $apellidos;
        private $email;
        private $password;
        private $telefono;
        private $fecha_creacion;

        /**
         * @param $id
         * @param $nombre
         * @param $apellidos
         * @param $email
         * @param $password
         * @param $fechaRegistro
         */
        public function __construct($id="", $nombre="", $apellidos="", $email="", $password="", $telefono="", $fecha_creacion="")
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->email = $email;
            $this->password = $password;
            $this->telefono = $telefono;
            $this->fecha_creacion = $fecha_creacion;
        }


        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getNombre()
        {
            return $this->nombre;
        }

        /**
         * @param mixed $nombre
         */
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }

        /**
         * @return mixed
         */
        public function getApellidos()
        {
            return $this->apellidos;
        }

        /**
         * @param mixed $apellidos
         */
        public function setApellidos($apellidos)
        {
            $this->apellidos = $apellidos;
        }

        /**
         * @return mixed
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @param mixed $email
         */
        public function setEmail($email)
        {
            $this->email = $email;
        }

        /**
         * @return mixed
         */
        public function getPassword()
        {
            return $this->password;
        }

        /**
         * @param mixed $password
         */
        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function getTelefono(): mixed
        {
            return $this->telefono;
        }

        public function setTelefono(mixed $telefono): void
        {
            $this->telefono = $telefono;
        }

        public function getFechaCreacion(): mixed
        {
            return $this->fecha_creacion;
        }

        public function setFechaCreacion(mixed $fecha_creacion): void
        {
            $this->fecha_creacion = $fecha_creacion;
        }





    }
