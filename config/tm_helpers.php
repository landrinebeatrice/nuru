<?php
         /**
         * charger une ressources
         */
        function loadRessource($ressource, $data = []){
            extract($data);
            $ressourcesPath = "ressources/";

            if (($last_slash = strrpos($ressource, '/')) !== FALSE){
                $ressourcesPath .= strtolower(substr($ressource, 0, ++$last_slash));
                $ressource = substr($ressource, $last_slash);
            }

            //reccuperation des ressources

            //on verifie si le model existe
            if(is_dir($ressourcesPath)){
                $tm_ressources = scandir($ressourcesPath);
                if(in_array($ressource, $tm_ressources, TRUE)){
                    require_once($ressourcesPath.strtolower($ressource));
    
                }else{
                    //$model non existant
                    echo("{$ressource} ne pas definit comme ressource {$ressourcesPath}"); die();
                }
            }else{
                echo("vous avez renseigner un mauvais chemin {$ressourcesPath}{$ressource}; rassurez vous que le chemin que vous avez passer en parametre existe dans RESSOURCES"); die();
            }
            
            
        }