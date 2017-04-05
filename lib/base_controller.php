<?php

  class BaseController{

    public static function get_user_logged_in(){
      if(isset($_SESSION['userid'])){
        $user_id = $_SESSION['userid'];
        $user = Player::find($user_id);
        return $user;
      }
      return null;
    }

    public static function check_logged_in(){
      
    }
  }
