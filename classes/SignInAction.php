<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 21.02.2018
 * Time: 20:03
 */

namespace Dsmmorpg;

include_once('Init.php');

/**
 * if the file is called with post
 */
if(empty($_POST) === false){
    $signIn = new SignInAction();
    $signIn->signInController($_POST);
}

class SignInAction {

    /** @var mixed  */
    private $clean_post;

    /** @var mixed  */
    private $init;

    public function __construct(){
        $this->init = new Init();
    }

    /**
     * SignInAction Controller.
     */
    public function signInController($post){
        /**
         * filter input Post
         */
        $this->clean_post = filter_input_array(INPUT_POST, $post);

        /** signUp */
        if (empty($this->clean_post['signup']) === false){
            if (filter_var($this->clean_post['email'], FILTER_VALIDATE_EMAIL)) {
                $this->register($this->clean_post);
            } else {
                print('not valid Email');
            }

        } else if(empty($this->clean_post['signin']) === false){
            /** signIn */
            $this->isValidUser($this->clean_post['username'], $this->clean_post['password']);
        } else {
            print('Post Corrupt');
        }
    }

    /**
     * isValidUser Function
     * @throws /Exception
     */
    private function isValidUser($username, $passwd){
        if(empty($username) === false){
            try{
                /**
                 * get User Data
                 * @var $dbUser
                 */
                $dbUser = $this->init->getMysql()->where(array('username' => $username))->get('user');

                /** check if password and User is correct */
                if($dbUser[0]['username'] === $username){
                    if(crypt($passwd, $dbUser[0]['password']) == $dbUser[0]['password']) {
                        /** password is correct */

                        setcookie('session', $dbUser[0]['session'], time() + 36000, "/");
                        print(1);
                    } else {
                        print('Password is incorrect!');
                    }
                } else {
                    print('Username is not correct!');
                }
            }catch(\Exception $e){
                print ('Caught exception: '. $e->getMessage());
            }
        } else {
            print('Username is empty');
        }
    }

    /**
     * register
     * @param $post
     * @throws /Exception
     */
    private function register($post){
        if(empty($post) === false
            && empty($post['email']) === false
            && empty($post['username']) === false
            && empty($post['passwd']) === false){
            try{
                /** write crypted pw with username and email in DB */
                $uniqid = uniqid();
                $this->init->getMysql()->insert('user',
                    array(
                        'username' => $post['username'],
                        'password' => crypt($post['passwd'], $post['passwd']),
                        'email' => $post['email'],
                        'session' => $uniqid
                    )
                );

                setcookie('session', $uniqid, time() + 36000, "/");
                print('1');
            }catch(\Exception $e) {
                if (strpos($e, 'Duplicate entry') !== false) {
                    if (strpos($e, 'username') !== false) print ('Username already in use');
                    if (strpos($e, 'email') !== false) print ('Email already in use');
                } else {
                    print ('Caught exception: ' . $e->getMessage());
                }
            }
        } else {
            print('Please fill out all Fields.');
        }
    }
}