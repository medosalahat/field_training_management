<?php
class user_lib_ad
{
    private $CI;

    private $use;

    private $data=array();

    private $session;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->session = new class_sessions_admin();

        $this->use->use_lib('system/post_get/class_post');

        $this->use->use_lib('system/array/class_array');

        $this->use->use_lib('system/date_time/date_time');

        $this->use->use_model('data_base');
    }

    public function set($index = null , $type= null){

        if($type == 'post'){

            $post = new class_post($index);

            if($post->validation()){

                 $this->data[$index]=$post->get_value();

                return true;
            }else{

                return false;
            }
        }else if($type == 'get'){

            $get = new class_get($index);

            if($get->validation()){

                $this->data[$index]=$get->get_value();

                return true;
            }else{

                return false;
            }
        }

        return false;
    }

    public function get($index){

        return $this->data[$index];

    }

    public function find_users_login()
    {

        $db = new data_base(
            tpl_user_site::user_site(),
            array(
                tpl_user_site::id()
            ),array(
                tpl_user_site::username()=>$this->data[tpl_user_site::user_site().'_'.tpl_user_site::username()],
                tpl_user_site::password()=>$this->hash_password($this->data[tpl_user_site::user_site().'_'.tpl_user_site::password()]),
                tpl_user_site::status()=>1
            )
        );

        $results = $db->get_where();

        $results = array_shift($results);

        if(!empty($results[tpl_user_site::id()])){

            $this->session->new_login_admin();

            $this->session->set_id_user($results[tpl_user_site::id()]);

            return  json_encode(array('valid'=>true));
        }else{

            return json_encode(
              array(
                  'valid'=>false,
                  'title'=>'Oops !!',
                  'massage'=>'The password you\'ve entered is incorrect',
              )
            );
        }

    }


    public static function hash_password($password){


        return md5(md5(md5('2015').md5('28').md5('10')).$password);

    }
}