<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 22.02.2018
 * Time: 10:53
 */

namespace Dsmmorpg;

/**
 * Includes
 */
include_once('Mysql.php');
include_once('Configuration.php');

class Init{
    protected $configuration;
    protected $mysql;

    /**
     * Init constructor.
     */
    public function __construct(){
        /** Configuration */
        $this->configuration = new Configuration();

        /** SQL Client */
        $this->mysql = new MySQL($this->configuration->getSqlHost(), $this->configuration->getSqlUser(),
            $this->configuration->getSqlPass(), $this->configuration->getSqlDb());
    }

    /**
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @return MySQL
     */
    public function getMysql()
    {
        return $this->mysql;
    }
}