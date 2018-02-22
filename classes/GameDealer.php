<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 22.02.2018
 * Time: 14:43
 */

namespace Dsmmorpg;

include_once('Init.php');

new GameDealer();

class GameDealer{
    private $init;
    private $clean_post;

    /**
     * GameDealer constructor.
     */
    public function __construct(){
        $this->init = new Init();

        if(empty($_POST) === false){
            /** filter input Post*/
            $this->clean_post = filter_input_array(INPUT_POST, $_POST);

            /** send the Clean post to postController */
            $this->postController($this->clean_post);

        } else {
            print('Post is empty');
        }
    }

    /**
     * postController
     * @param $post
     */
    private function postController($post){
        /** if the post function param is not empty */
        if(empty($post['function']) === false){
            $return = call_user_func(array($this, $post['function']), $post['param']);
            if(empty($return) === false && $return !== false){
                print($return);
            } else {
                http_response_code(400);
                print('Post Function was not okay: '
                    .$post['function']. ', param: '.$post['param']);
            }
        } else {
            print('Post Function was empty');
        }

    }

    /**
     * getCharacter
     * @param $session
     * @return mixed
     * @throws /Exception
     */
    public function getCharacter($session){
        $dbUser = $this->init->getMysql()->where(array('session' => $session))->get('user');
        return $dbUser[0]['username'];
    }

    /**
     * getUserName
     * @param $session
     * @return mixed
     * @throws /Exception
     */
    public function getUserName($session){
        $dbUser = $this->init->getMysql()->where(array('session' => $session))->get('user');
        return $dbUser[0]['username'];
    }
}