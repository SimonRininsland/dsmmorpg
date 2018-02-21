<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 21.02.2018
 * Time: 17:41
 */
    class Configuration {

        /**
         * Configuration MYSQL
         */
        static private $sql_host = 'localhost';
        static private $sql_user = 'web375_1';
        static private $sql_pass = 'qsS2BQWB';
        static private $sql_db = 'web375_1';

        /**
         * @return mixed
         */
        public static function getSqlHost()
        {
            return self::$sql_host;
        }

        /**
         * @return string
         */
        public static function getSqlUser()
        {
            return self::$sql_user;
        }

        /**
         * @return string
         */
        public static function getSqlPass()
        {
            return self::$sql_pass;
        }

        /**
         * @return string
         */
        public static function getSqlDb()
        {
            return self::$sql_db;
        }
    }