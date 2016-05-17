<?php
include "control/ControlManager.php";

class RequestRouter
{
    public function route()
    {
        return json_encode((new ControlManager) -> getResource());
    }
}