<?php
    require_once('config/config.php');
    require_once("model/tm_models/Connexion.php");
    require_once('config/tm_helpers.php');
    require_once('controller/AutoloadController.php');

    AutoloadController::register();
?>

<?php
    $controller = "HomeController";
    $action = 'index';
    $viewPath = "";
    $arg = ""; //represente l'argument

    if(isset($_GET['m']) && !empty($_GET['m'])){
        $getUrl = explode('-', $_GET['m']);
        if(($getUrl[0] == "nuru")  && isset($getUrl[1])){
            /**
             * [0]: controller
             * [1]: action
             */
            $getPages = explode(".",$getUrl[1]);
            $controllers = scandir('controller/');

            if(in_array(ucfirst($getPages[0])."Controller.php", $controllers) && isset($getPages[1])){
                if(!empty($getPages[1])){
                    if(is_callable(array(ucfirst($getPages[0])."Controller", strtolower($getPages[1])))){
                        //processing code
                        $controller = ucfirst($getPages[0])."Controller";
                        $action = strtolower($getPages[1]);
                        if(isset($getPages[2]) && !empty($getPages[2])){
                            $arg = $getPages[2];
                        }
                    }
                }
            }
        }
    }

    require_once('ressources/inc/header.php');

    $controller = new $controller();
    $controller->$action($arg);
?>
 
<?php require_once('ressources/inc/footer.php'); ?>