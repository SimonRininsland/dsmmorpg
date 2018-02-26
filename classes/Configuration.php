<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 21.02.2018
 * Time: 17:41
 */
namespace Dsmmorpg;

class Configuration {
    /**
     * Configuration MYSQL
     */
    static private $sql_host = 'localhost';
    static private $sql_user = 'root';
    static private $sql_pass = '';
    static private $sql_db = 'dsmmorpg';
    
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