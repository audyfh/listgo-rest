<?php

class Controller {

    function loadView($view = '', $data= []){
        foreach($data as $key => $val)
        $$key = $val;
      include 'view/' . $view;
    }

    
  function loadModel($model = '') {
    require_once('model/Model.php');
    require_once('model/' . $model . '.php');
    return new $model;
  }
}