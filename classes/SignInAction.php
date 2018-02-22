<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 21.02.2018
 * Time: 20:03
 */


/**
 * Includes
 */
include_once('mysql.php');
include_once('configuration.php');

/**
 * if the file is called with post
 */
if(empty($_POST) === false){
    new SignInAction($_POST);
}

class SignInAction {
    /** @var Configuration  */
    private $configuration;

    /** @var mixed  */
    private $clean_post;

    /** @var mixed  */
    private $mysql;

    /**
     * SignInAction constructor.
     */
    public function __construct($post){
        /** Configuration */
        $this->configuration = new Configuration();

        /** SQL Client */
        $this->mysql = new MySQL($this->configuration->getSqlHost(), $this->configuration->getSqlUser(),
            $this->configuration->getSqlPass(), $this->configuration->getSqlDb());

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
            $this->isValidUser($this->clean_post['username']);
        } else {
            print('Post Corrupt');
        }
    }

    /**
     * isValidUser Function
     *
     */
    private function isValidUser($username){
        if(empty($username) === false){
            try{
                $user = $this->mysql->where(array('username' => $username))->get('user');
                if($user[0]['username'] === $username){
                    print(1);
                } else {
                    print('Username is not correct!');
                }
            }catch(Exception $e){
                print ('Caught exception: '. $e->getMessage());
            }
        } else {
            print('Username is empty');
        }
    }

    /**
     * isValidUser Function
     *
     */
    private function register($post){
        if(empty($post) === false
            && empty($post['email']) === false
            && empty($post['username']) === false
            && empty($post['passwd']) === false){
            try{
                $this->mysql->insert('user',
                    array(
                        'username' => $post['username'],
                        'password' => $post['passwd'],
                        'email' => $post['email']
                    )
                );
                print('1');
            }catch(Exception $e) {
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