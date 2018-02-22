<?php
/**
 * DSMMORPF - DamSmallMassivelyMultiplayerOnlineRole-PlayingGame
 */

namespace Dsmmorpg;

/**
 * Create new Instance
 */
new Index();

/**
 * Class Index
 */
class Index{

    /**
     * html template pathes
     */
    private $html_templates = [
        'html_top' => 'html/boiler-top.html',
        'html_login_bottom' => 'html/login-botton.html',
        'html_login_register' => 'html/login-register.html',
        'html_game_bottom' => 'html/game-botton.html',
        'html_game_stage' => 'html/game-stage.html'
    ];

    /**
     * Index constructor.
     */
    public function __construct() {
        /** check if the file is not called with $_POST */
        if(empty($_POST) === true){
            $this->printController();
        }
    }

    /**
     * printController
     */
    protected function printController(){
        /** @todo: validate sessionID */
        if(isset($_COOKIE['PHPSESSID']) === false){
            /** print printLoginForm */
            $this->printHtml('html_login_register', 'html_login_bottom');
        } else {
            /** print Game */
            $this->printHtml('html_game_stage', 'html_game_bottom');
        }
    }

    /**
     * printHTML
     * @param $content
     * @param string $top
     * @param string $bottom
     */
    private function printHTML($content, $bottom, $top = 'html_top'){
        if (file_exists($this->html_templates[$top]) === true
        && file_exists($this->html_templates[$bottom]) === true
        && file_exists($this->html_templates[$content]) === true){
            readfile($this->html_templates[$top]);
            readfile($this->html_templates[$content]);
            readfile($this->html_templates[$bottom]);
        }
    }

}