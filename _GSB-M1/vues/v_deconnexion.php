<div id="contenu">
<ul>
<?php
       
        $nom =  $_SESSION['nom'];
        $prenom = $_SESSION['prenom'];
        echo "<b style='font-size:15px;font-family: 'Open Sans',minion pro, sans-serif;'>Deconnexion en cours de ".$nom." ".$prenom."</b>";
        session_destroy();           
        if (isset($_COOKIE['log']) && isset($_COOKIE['mdp'])) {
            unset($_COOKIE['log']);
            unset($_COOKIE['mdp']);
            setcookie('log', '', time() - 365*24*3600, null, null, false, true); // empty value and old timestamp
            setcookie('mdp', '', time() - 365*24*3600, null, null, false, true); // empty value and old timestamp
        }
?>
</ul>
</div>

<script type="text/javascript">
function timedRefresh(timeoutPeriod) {
	console.log(timeoutPeriod);
    setTimeout("window.location=\"./\";",timeoutPeriod);
    }timedRefresh(500);
</script>