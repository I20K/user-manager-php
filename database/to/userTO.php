<?php
include('/database/db.php');
include_once('/database/configuration.php');

class userTO {
    private static function getDbInstance() {
        return new db('sqlsrv:server=' + DB_HOST + ';Database='+ DB_DATABASE, DB_USER, DB_PASS);
    }

    public static function deleteUser($id) {
        $context = userTO::getDbInstance();

        $context->delete('Users', 'ID = :id', array(":id" => $id));
    }

    public static function createUser($userVec) {
        $bind = array(
            ":username" => $userVec["username"],
            ":password" => $userVec["password"],
            ":name" => $userVec["name"],
            ":phone" => $userVec["phone"]
        );

        $context = userTO::getDbInstance()
        ->run('INSERT INTO Users(username, password, name, phone) VALUES(:username, :password, :name, :phone)', $bind);
    }
}
?>