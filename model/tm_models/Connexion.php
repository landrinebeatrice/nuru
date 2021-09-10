<?php
class Connexion
{
    private static $resource;

    // Usage du Design Pattern Singleton
    public static  function getConnexion(){
        /**if(session_status() == PHP_SESSION_NONE){
            //session_start();
        }*/


        if (self::$resource==null){
            // En developpement
            self::$resource = new PDO (DSN,
                DB_USER,
                DB_PWD,
                array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            // En production
            //self::$resource = new PDO (DSN, DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_SILENT));

            return self::$resource;
        } else{
            return self::$resource;
        }
    }

    /**
     * connexion ozeki alert oncoming
     */
    public static function getPdoForOZeki(){
        if (self::$resource==null){
            // En developpement
            self::$resource = new PDO ("mysql:host=localhost;dbname=congo_uliwacongo",
                "root",
                "",
                array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));


            return self::$resource;
        } else{
            return self::$resource;
        }
    }

}