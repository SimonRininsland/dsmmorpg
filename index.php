<?php
/**
 * DSMMORPF - DamSmallMassivelyMultiplayerOnlineRole-PlayingGame
 */

/**
 * Includes
 */
include_once('classes/mysql.php');
include_once('classes/configuration.php');

/**
 * Create new Instance
 */
$index = new Index();

/**
 * Class Index
 */
class Index{

    private $configuration;
    private $mysql;

    /**
     * html template pathes
     */
    private $html_top = 'html/boiler-top.html';
    private $html_bottom = 'html/boiler-botton.html';
    private $html_login_register = 'html/login-register.html';

    /**
     * Index constructor.
     */
    public function __construct() {

        /** Configuration */
        $this->configuration = new Configuration();

        /** SQL Client */
        $this->mysql = new MySQL($this->configuration->getSqlHost(), $this->configuration->getSqlUser(),
            $this->configuration->getSqlPass(), $this->configuration->getSqlDb());

        /** print HTML */
        $this->printHtml();

    }

    /**
     * printHtml Function
     */
    private function printHtml(){
        if (file_exists($this->html_top) === true
        && file_exists($this->html_login_register) === true
        && file_exists($this->html_bottom) === true){
            readfile($this->html_top);
            readfile($this->html_login_register);
            readfile($this->html_bottom);
        }
    }

    /**
     * @return MySQL
     */
    public function getMysql(){
        return $this->mysql;
    }
}