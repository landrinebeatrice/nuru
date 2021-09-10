<?php
    require_once("entities/user/Utilisateur.php");
    require_once("model/tm_models/MainModel.php");

    class UtilisateurModel extends MainModel{
            /**
         * @param Utilisateur
         * @return bool
         */
        public static function insert(Utilisateur $utilisateur){
            $query = "INSERT INTO utilisateur SET nom=?, postnom=?, prenom=?, contact=?, email=?, username=?, password=?, role=?";
            $sql = self::pdo()->prepare($query);

            if($sql->execute([$utilisateur->getNom(), $utilisateur->getPostnom(), $utilisateur->getPrenom(), $utilisateur->getContact(),
                $utilisateur->getEmail(), $utilisateur->getUsername(), $utilisateur->getPassword(), $utilisateur->getRole()]))
            {
                return true;
            }

            return false;
        }

        /**
         * @param Utilisateur
         * @return bool
         */
        public static  function update(Utilisateur $utilisateur){
            $query = "UPDATE utilisateur SET nom=?, postnom=?, prenom=?, contact=?, email=?, username=?, password=?, role=? WHERE id=?";
            $sql = self::pdo()->prepare($query);

            if($sql->execute([$utilisateur->getNom(), $utilisateur->getPostnom(), $utilisateur->getPrenom(), $utilisateur->getContact(),
                $utilisateur->getEmail(), $utilisateur->getUsername(), $utilisateur->getPassword(), $utilisateur->getRole(), $utilisateur->getId()]))
            {
                return true;
            }

            return false;
        }

        /**
         * @param $bye : la condition de selection
         * @param $value : la valeur de la condition
         * @return false|Utilisateur
         */
        public static function getUtilisateur($bye, $value){
            $sql = self::pdo()->prepare("SELECT * FROM utilisateur WHERE {$bye} = ?");
            $sql->execute([$value]);
            $res = $sql->fetch(PDO::FETCH_OBJ);

            if($res){
                $utilisateur = new Utilisateur($res->id, $res->nom, $res->postnom, $res->prenom, $res->contact, $res->email, $res->username, $res->password, $res->role);
                return $utilisateur;
            }
            return false;
        }

        /**
         * @return array : Utilisateur
         */
        public static function getUtilisateurs(){
            $query="SELECT * FROM utilisateur";
            $sql = self::pdo()->prepare($query);
            $sql->execute();

            $data = array(); //contient un tableau des objets
            if($sql != null)
            {
                while($res = $sql->fetch(PDO::FETCH_OBJ))
                {
                    $data[]= new Utilisateur($res->id, $res->nom, $res->postnom, $res->prenom, $res->contact, $res->email, $res->username, $res->password, $res->role);
                }
            }
            return $data;
        }

    }