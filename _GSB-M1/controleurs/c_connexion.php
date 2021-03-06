<?php

if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch($action){
        case 'accueil':{
                include("vues/v_sommaire.php"); 
                include("vues/v_accueil.php");
                break;
        }
	case 'demandeConnexion':{            
                            
            if(isset($_COOKIE['log']) && isset($_COOKIE['mdp']))
            {
                $visiteur = $pdo->getInfosVisiteur($_COOKIE['log'],$_COOKIE['mdp']);
                
		if(!is_array( $visiteur) /* && !is_array( $comptable) */){  
			ajouterErreur("Login ou mot de passe incorrect");
                        include("vues/v_erreurs.php");
                        include("vues/v_sommaire.php"); 
                        include("vues/v_connexion.php");
		}
		else{
			$id = $visiteur['id'];
			$nom =  $visiteur['nom'];
			$prenom = $visiteur['prenom'];
                        $ville = $visiteur['ville'];
			$adresse =  $visiteur['adresse'];
			$cp = $visiteur['cp'];
                        $type = $visiteur['typeVisiteur'];
                        connecter($id,$nom,$prenom,$type,$ville,$cp,$adresse);  
                        include("vues/v_sommaire.php"); 
                        include("vues/v_accueil.php");                        
                    }
            }
            else{
                include("vues/v_sommaire.php"); 
		include("vues/v_connexion.php");
            }
		break;
	}
	case 'valideConnexion':{            
		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
		$visiteur = $pdo->getInfosVisiteur($login,sha1($mdp));
                
		if(!is_array( $visiteur) /* && !is_array( $comptable) */){  
			ajouterErreur("Login ou mot de passe incorrect");
                        include("vues/v_erreurs.php");
                        include("vues/v_sommaire.php"); 
                        include("vues/v_connexion.php");
		}
		else{
			$id = $visiteur['id'];
			$nom =  $visiteur['nom'];
			$prenom = $visiteur['prenom'];
                        $ville = $visiteur['ville'];
			$adresse =  $visiteur['adresse'];
			$cp = $visiteur['cp'];
                        $type = $visiteur['typeVisiteur'];
                        if(isset($_REQUEST['Save']) && $_REQUEST['Save']=="true")
                        {
                            save($login,sha1($mdp));            
                        }
                        connecter($id,$nom,$prenom,$type,$ville,$cp,$adresse);  
                        include("vues/v_sommaire.php"); 
                        include("vues/v_accueil.php");                        
                    }
		break;
	}
        case 'deconnexion':{
		include("vues/v_deconnexion.php");
                session_destroy();           
                if (isset($_COOKIE['log']) && isset($_COOKIE['mdp'])) {
                    unset($_COOKIE['log']);
                    unset($_COOKIE['mdp']);
                    setcookie('log', '', time() - 365*24*3600, null, null, false, true); // empty value and old timestamp
                    setcookie('mdp', '', time() - 365*24*3600, null, null, false, true); // empty value and old timestamp
                }
		break;
        }
	default :{
		include("vues/v_connexion.php");		
          break;
	}
}
?>