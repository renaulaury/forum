<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register () {
        // session_start();
        $user = new UserManager();

        if(isset($_POST["submit"])) {
            //on filtre
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
            //on les vérifie
            if($pseudo && $email && $password1 && $password2) {
                //méthode dans usermanager qui verifie si user existe ou non
    
                if($user) { //verif si user existe
                    //add in bdd
                    if($password1 == $password2 && strlen($password1) >= 4) {
                        $user->add([
                            "pseudo" => $pseudo,
                            "email" => $email,
                            "password" => password_hash($password1, PASSWORD_DEFAULT)
                        ]);
                    } else {
                        // $user->getFlash();
                    }               
                }
    
    
            }
        }

        return [
            "view" => VIEW_DIR."security/register.php",
            "meta_description" => "Enregistrement",
        ];
    }
}



    // public function login () {
        // session_start();

        //on filtre
        // $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // if($email && $password) {
        //     findAll($id); //mep requete

        //     if($user) { //verif si user existe
        //         $hash = $user["password"]; //je vérifie le hash du mdp avec le mdp
            
        //     if(password_verify($password, $hash)) { //si ok j affiche la session du user
        //         setUser();
        // }else {
        //     getFlash();
        // }

//    }

//          return [
//             "view" => VIEW_DIR."security/login.php",
//             "meta_description" => "Enregistrement",
//         ];
//     }
// }

//     public function logout () {}
// }


