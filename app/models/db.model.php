<?php
require_once './config/config.php';

class Model {

    protected $db;

    function __construct() {
        $this->db = new PDO("mysql:host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASS);
        if ($this->db) {
            $this->createDatabaseIfNotExists();
            $this->db->exec("USE " . DB_NAME);
            $this->deploy();
        }
    }

    function createDatabaseIfNotExists() {
        $query = "CREATE DATABASE IF NOT EXISTS " . DB_NAME . " DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
        $this->db->exec($query);
    }

    function deploy() {
        $query = $this->db->query("SHOW TABLES");
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END

                -- phpMyAdmin SQL Dump
                -- version 5.2.1
                -- https://www.phpmyadmin.net/
                --
                -- Servidor: 127.0.0.1
                -- Tiempo de generación: 20-09-2025 a las 00:53:31
                -- Versión del servidor: 10.4.32-MariaDB
                -- Versión de PHP: 8.2.12

                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                START TRANSACTION;
                SET time_zone = "+00:00";


                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8mb4 */;

                --
                -- Base de datos: `db_tienda_panpox`
                --

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `categoria`
                --

                CREATE TABLE `categoria` (
                `id` int(11) NOT NULL,
                `nombre` varchar(250) NOT NULL,
                `descripcion` varchar(250) NOT NULL,
                `responsable` varchar(250) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `categoria`
                --

                INSERT INTO `categoria` (`id`, `nombre`, `descripcion`, `responsable`) VALUES
                (1, 'pollera', '...', 'Valentina Espetxe'),
                (2, 'pantalón', '...', 'Sofia Verea');

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `prenda`
                --

                CREATE TABLE `prenda` (
                `id` int(11) NOT NULL,
                `id_categoria` int(11) NOT NULL,
                `nombre` varchar(250) NOT NULL,
                `material` varchar(250) NOT NULL,
                `precio` double NOT NULL,
                `disponible` tinyint(1) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `prenda`
                --

                INSERT INTO `prenda` (`id`, `id_categoria`, `nombre`, `material`, `precio`, `disponible`) VALUES
                (1, 1, 'pollera punk', 'jean reciclado', 30000, 1),
                (2, 2, 'lettering', 'jean desteñido', 40000, 1);

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `users`
                --
                --
                CREATE TABLE `users` (
                `id_user` int(11) NOT NULL AUTO_INCREMENT,
                `username` varchar(100) NOT NULL,
                `password` varchar(255) NOT NULL,
                PRIMARY KEY (`id_user`)
                );

                INSERT INTO `users` (`username`, `password`) VALUES ('webadmin', '1234');

                -- --------------------------------------------------------
                -- Índices para tablas volcadas
                --

                --
                -- Indices de la tabla `categoria`
                --
                ALTER TABLE `categoria`
                ADD PRIMARY KEY (`id`);

                --
                -- Indices de la tabla `prenda`
                --
                ALTER TABLE `prenda`
                ADD PRIMARY KEY (`id`),
                ADD KEY `id_categoria_pk` (`id_categoria`);

                --
                -- AUTO_INCREMENT de las tablas volcadas
                --

                --
                -- AUTO_INCREMENT de la tabla `categoria`
                --
                ALTER TABLE `categoria`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

                --
                -- AUTO_INCREMENT de la tabla `prenda`
                --
                ALTER TABLE `prenda`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

                --
                -- Restricciones para tablas volcadas
                --

                --
                -- Filtros para la tabla `prenda`
                --
                ALTER TABLE `prenda`
                ADD CONSTRAINT `prenda_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);
                COMMIT;

                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


                END;

            $this->db->query($sql);
        }
    }
}