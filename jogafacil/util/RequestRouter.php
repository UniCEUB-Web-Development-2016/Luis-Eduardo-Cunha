<?php

include_once "control/ControlManager.php";
include_once "model/Request.php";
include_once "control/UserController.php";
include_once "control/UsuarioController";

class ResourceController{

    private $ResourceMap = [
        "carpool" 	=> "CarpoolController",
        "user"		=> "UserController",
        "uber"		=> "UberController"
    ];
    public function createResource($request,$cnn){
        return (new $this->ResourceMap[$request->getResource()]())->register($request,$cnn);
    }
    public function searchResource($request,$cnn){
        return (new $this->ResourceMap[$request->getResource()]())->search($request,$cnn);
    }
}