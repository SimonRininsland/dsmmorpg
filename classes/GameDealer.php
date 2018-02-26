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
        if(empty($post['function']) === false && empty($post['param']) === false){
            /**
             * do a handy call user func
             * @var  $returnData
             */
            $returnData = call_user_func(array($this, $post['function']), $post['param']);

            if(empty($returnData) === false && $returnData !== false){
                print($returnData);
            } else {
                http_response_code(400);
                print('Post Function was not okay: '.$post['function']. ', param: '.
                    $post['param'].' return: '.$returnData);
            }
        } else {
            http_response_code(400);
            print('Post Function or param was empty '
                .$post['function']. ', param: '.$post['param']);
        }
    }

    /**
     * getCharacters
     * @param $session
     * @return mixed
     * @throws /Exception
     */
    public function getCharacters($session){
        try {
            /** @var  $dbUser */
            $dbUser = $this->init->getMysql()->where(array('session' => $session))->get('user');
        } catch(\Exception $e){
            return('Can\'t get DB User: '.$e);
        }

        if (empty($dbUser) === false){
            try {
            /** @var  $character */
                $characters = $this->init->getMysql()->where(array('uid' => $dbUser[0]['id']))->get('characters');

            } catch(\Exception $e){
                return('Can\'t get DB Character: '.$e);
            }
        } else {
            return('DB User was not found');
        }

        if (empty($characters) === false){
            return $characters;
        } else {
            return(1);
        }
    }

    /**
     * getUserName
     * @param $session
     * @return mixed
     * @throws /Exception
     */
    public function getUserName($session){
        /** @var  $dbUser */
        try {
            $dbUser = $this->init->getMysql()->where(array('session' => $session))->get('user');
        } catch(\Exception $e){
            return('Can\'t get DB User: '.$e);
        }
        return $dbUser[0]['username'];
    }

    /**
     * getUserId
     * @param $session
     * @return mixed
     * @throws /Exception
     */
    public function getUserId($session){
        /** @var  $dbUser */
        try {
            $dbUser = $this->init->getMysql()->where(array('session' => $session))->get('user');
        } catch(\Exception $e){
            return('Can\'t get DB User: '.$e);
        }
        return $dbUser[0]['id'];
    }

    /**
     * storeCharacter
     * @param $params
     * @return int|string
     */
    public function storeCharacter($params){
        /** get all Informations */
        $paramArray = explode(',',$params);
        $sortOf = $paramArray[1];
        $nickname = $paramArray[2];
        $uid = $this->getUserId($paramArray[0]);

        /** @var  $dbUser */
        try {
            $this->init->getMysql()->insert('characters',
                array(
                    'uid' => $uid,
                    'name' => $nickname,
                    'type' => $sortOf
                )
            );
        } catch(\Exception $e){
            return('Can\'t store Character: '.$e);
        }
        return 1;
    }
}