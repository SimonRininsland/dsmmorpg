<?php
/**
 * DSMMORPF - DamSmallMassivelyMultiplayerOnlineRole-PlayingGame
 */

$index = new Index();
/**
 * Class Index
 */
class Index{
    /**
     * @var string
     */
    private $html_index_path = 'html/index.html';

    /**
     * Index constructor.
     */
    public function __construct() {
        $this->printHtml();
    }

    /**
     * printHtml Function
     */
    public function printHtml(){
        if (file_exists($this->html_index_path) === true){
            readfile($this->html_index_path);
        }
    }
}