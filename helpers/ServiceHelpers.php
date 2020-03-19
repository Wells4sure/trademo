<?php
namespace Helpers;
class ServiceHelpers {

    public function checkInputs($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}