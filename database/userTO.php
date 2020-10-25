<?php
require_once(__DIR__.'/Db.class.php');
require_once(__DIR__.'/configuration.php');

use PDOWrapper\Db;
class userTO {
    private static function getDbInstance() {
        return new Db(DB_HOST, DB_DATABASE, DB_USER, DB_PASS);
    }

    public static function deleteUser($id) {
        $context = userTO::getDbInstance();

        $context->query('DELETE FROM Users WHERE ID = :id', array(":id" => $id));
    }

    public static function getUsers() {
        $context = userTO::getDbInstance();

        return json_encode($context->query('SELECT * FROM Users'));
    }

    public static function createUser($userVec) {
        $bind = array(
            ":username" => $userVec["username"],
            ":password" => $userVec["password"],
            ":name" => $userVec["name"],
            ":phone" => $userVec["phone"]
        );

        $context = userTO::getDbInstance()
        ->query('INSERT INTO Users(username, password, name, phone) VALUES(:username, :password, :name, :phone)', $bind);
    }
}
?>