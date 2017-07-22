<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
function search_in_array($valeur,$champs_necessaire) {
    foreach($champs_necessaire as $cn){ 
        if(strpos($cn,$valeur)!==FALSE)  {return true;exit; }
    }
    return false;
}
function isset_not_null($string) {
    $string=(isset($string) && trim($string)<>"")? $string:"";
    return $string;
}
function return_trad($the_tab){
    global $lang;
    if($lang=='en' && isset($the_tab) && isset($the_tab[1]))
        return $the_tab[1];
    else
        return $the_tab[0];
}

function returnValue($value)
{
global $donnee;
    global $r;
    global $liste;
    global $$value;
    if(isset($GLOBALS['value'])){
        return $GLOBALS['value'];exit();
    }if(isset($$value)){
        return $$value;exit();
    }
    if(isset($r[$value])){
        return $r[$value];exit();
    }
    if(isset($liste[$value])){
        return $liste[$value];exit();
    } 
	if(isset($GLOBALS['donnee'][0][$value])){
        return $GLOBALS['donnee'][0][$value];exit();
    }
    return "";
    exit();
}
function input_type_hidden($id_label)//
{
return "<input type='hidden' value='". returnValue($id_label)."' id='".$id_label."' name='".$id_label."' />";
}
function input_type_text($the_tab)//0$label="",1$id="",2$redstar='',3$onchange="",4title="",5type de champs,6modifiable?)
{
    $type_input="text";
    if($the_tab[5]=="email")$type_input="email";
    if($the_tab[5]=="file")$type_input="file";
    if($the_tab[5]=="password"){$type_input="password"; $the_tab[1]="";}
    $redstar=""; $required="";
    if($the_tab[2]=='yes'){$redstar="*";$required="required='required'";  }
    $text= "<div class='form-group'>
    <label class='col-sm-2 control-label'>".$the_tab[0].$redstar."</label>
    <div class='input-group'>
    <input  type='".$type_input."' id='".$the_tab[1]."' name=\"".$the_tab[1]."\"  
    value=\"".vers_formulaire(returnValue($the_tab[1]))."\"
    ".$the_tab[3]." class='form-control' placeholder=\"".$the_tab[4].$redstar."\"   title=\"".$the_tab[4]."\" 
    ".$required." />
    <span class='input-group-addon' id='basic-addon2'
    data-toggle='popover' data-placement='left'     data-content=\"".$the_tab[4]."\">
    <i class='fa fa-question'></i></span>
    <div class='help-block with-errors'></div>
    </div>
    </div>";
    return $text;
}   
// function input_type_select(0$label="",1$id="",2$value="",3$redstar='',4$size="",5$onchange="",6$tableau="",7$title="")
function input_type_select($the_tab)
{
    $redstar=""; $required="";
    if($the_tab[2]=='yes'){$redstar="*";$required="required='required'"; }
    $valeur_select=returnValue($the_tab[1]);
    $text ="<div class='form-group'>
    <label class='col-sm-2 control-label'>".$the_tab[0].$redstar."</label>
    <div class='col-sm-10'> <span>
    <select id=\"".$the_tab[1]."\" name=\"".$the_tab[1]."\" ".$the_tab[5]." ".$required.">";
    foreach($the_tab[7] as $valeur){
        $text.= "<option value='".$valeur[0]."' ";
        if ($valeur_select == $valeur[0]) $text.= "selected" ;
        $text.= ">";
        $text.=  vers_formulaire($valeur[1])."</option>";
    }
    $text.=" </select>
    </span>   </div>  </div>";
    return $text;
}
function input_type_textarea($the_tab)//0$label="",1$id="",2$redstar='',3$onchange="",4title="")
{
    $redstar=""; $required="";
    if($the_tab[2]=='yes'){$redstar="*";$required="required='required'";  }   
    $text= "<div class='form-group'>
    <label class='col-sm-2 control-label'>".$the_tab[0].$redstar."</label>
    <textarea class='form-control' rows='3' id='".$the_tab[1]."' name=\"".$the_tab[1]."\"  ".$the_tab[3]." title=\"".$the_tab[4]."\" ".$required." placeholder=\"".$the_tab[4]."\">".returnValue($the_tab[1])."</textarea>
    </div>";
    return $text;
}
function input_type_checkbox($the_tab)
{
    $redstar=""; $required="";
    if($the_tab[2]=='yes'){$redstar="*";$required="required='required'"; }
    $valeur_select=returnValue($the_tab[1]);
    $text ="<div class='form-group'>
    <label class='col-sm-2 control-label'>".$the_tab[0].$redstar."</label>
    <div class='col-sm-10'> 
    <span> ";
    foreach($the_tab[7] as $key=>$valeur){
        $text.= "       <input type='checkbox' name=\"".$the_tab[1]."[]\" id=\"".$the_tab[1]."[]\"value='".$valeur[0]."' ";
        foreach ($valeur_select as $key2)  {
             if($key2[$the_tab[9]]==$valeur[0]) {
                $text.= " Checked='checked' " ; 
            }
        }
        $text.= "   / >";
        $text.=  vers_formulaire($valeur[0])."";
    }
    $text.="  </select>
    </span>   
    </div>  
    </div>";
    return $text;
}               
function array_in_array($needle, $haystack) {
    //Make sure $needle is an array for foreach
    if(!is_array($needle)) $needle = array($needle);
    //For each value in $needle, return TRUE if in $haystack
    foreach($needle as $pin)
        if(in_array($pin, $haystack)) return TRUE;
    //Return FALSE if none of the values from $needle are found in $haystack
    return FALSE;
}
function recherche_old($table,$text){
    global $pdo_intranet;  
    $query_select="";
    try {
        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$table."'";
        $result = $pdo_intranet->prepare($query);
        $result->execute();
        while ($row = $result->fetch()) {
            $field[]= $row['COLUMN_NAME'];
        }
        $db_connection = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    foreach($field as $champ){  
        $condition[]=$champ." like '%".$text."%'";
    }
    $query_select.=implode(" OR ",$condition);
    return $query_select;
}
function recherche($table,$champs,$text){
    global $pdo_intranet;  
    $query_select="";
    $condition=array();
    $field=array();
    try {
        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$table."'";
        $result = $pdo_intranet->prepare($query);
        $result->execute();
        while ($row = $result->fetch()) {
            $field[]= $row['COLUMN_NAME'];
        }
        $db_connection = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $query_select="";
    if($champs<>"*" && $champs<>"")
    {
        foreach($champs as $champ){  
           if(in_array($champ,$field))
            {$condition[]=$champ." like '%".$text."%'"; }
        }
    }  
    else 
    {
     foreach($field as $f){  
               $condition[]=$f." like '%".$text."%'";
         }
    } 
        $query_select.=implode(" OR ",$condition);             
    return $query_select;
}
function vers_formulaire($valeur) {
   // En code les caratÀres HTML sp»ciaux
    if($_SERVER['SERVER_NAME'] == "www.daily-ride.fr")
        return (mb_detect_encoding($valeur, 'UTF8', true)?$valeur:utf8_encode($valeur)); //, (mb_detect_encoding($valeur, 'UTF8', true)?'UTF8':'ISO-8859-1'));
    else
        return (mb_detect_encoding($valeur, 'UTF8', true)?$valeur:utf8_encode($valeur));
    //return htmlentities($valeur, ENT_QUOTES);
}
function vers_page($valeur) {
    // En code les caratÀres HTML sp»ciaux
    if($_SERVER['SERVER_NAME'] == "www.daily-ride.fr")
        return nl2br(htmlentities((mb_detect_encoding($valeur, 'UTF8', true)?$valeur:utf8_encode($valeur)), ENT_QUOTES)); //, (mb_detect_encoding($valeur, 'UTF8', true)?'UTF8':'ISO-8859-1')));
    else
        return nl2br(htmlentities((mb_detect_encoding($valeur, 'UTF8', true)?$valeur:utf8_encode($valeur)), ENT_QUOTES)); //, (mb_detect_encoding($valeur, 'UTF8', true)?'UTF8':'ISO-8859-1')));
    //		return nl2br(htmlentities($valeur, ENT_QUOTES ));
}
function supprimer_encodage($valeur) {
    return (get_magic_quotes_gpc())?stripslashes($valeur):$valeur;
}
function valeur_saisie($valeur) {
    return supprimer_encodage(trim($valeur));
}
// TODO 2 -o Christophe : tester la fonction et la mettre en prod
/**
* Converti une chaine de caractères pour l'importer dans la base de données
*
* @param mixed $valeur : valeur à convertir
*/
/*function vers_base($valeur) {
global $dbconnect;
$codage = mysql_client_encoding($dbconnect);
return mysql_real_escape_string(mb_detect_encoding($valeur, 'UTF8', true)?(($codage == 'utf8')?$valeur:utf8_decode($valeur)):(($codage == 'latin1')?$valeur:utf8_encode($valeur)), $dbconnect);
}*/
/**
* Converti une chaine de caractères pour l'importer dans la base de données
* Ancienne version : ne tient pas conmpte de l'encodage
*
* @param mixed $valeur valeur à convertir
*/
function vers_base($valeur) {
    //return (get_magic_quotes_gpc())?$valeur:str_replace("'","''",$valeur);
    // Modif CB 05-08-2008
    // Prise en compte de tous les caractères à échappés (pas seulement le ' (dans le cas où la chaîne inclue \' par exemple)
    return (get_magic_quotes_gpc())?utf8_test_encode($valeur):addslashes(utf8_test_encode($valeur));
}
function utf8_test_encode($valeur) {
    return(mb_detect_encoding($valeur, 'UTF8', true)?$valeur:utf8_encode($valeur));
}
function utf8_test_decode($valeur) {
    return(mb_detect_encoding($valeur, 'UTF8', true)?utf8_decode($valeur):$valeur);
}
/**
* Supprimer les accents de la chaîne passée en paramètre
*
* @param mixed $texte texte à nettoyer
*/
function sans_accent($texte) {
    $accent   = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÌÍÎÏìíîïÙÚÛÜùúûüÿÑñÇç";
    $noAccent = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeIIIIiiiiUUUUuuuuyNnCc";
    return strtr($texte, $accent, $noAccent);
}
function vers_rss($valeur) {
    $valeur = str_replace("&","&amp;",$valeur);
    $valeur = str_replace("<","&lt;",$valeur);
    $valeur = str_replace(">","&gt;",$valeur);
    $valeur = str_replace("\n","&lt;br&gt;",$valeur);
    return (mb_detect_encoding($valeur, 'UTF8', true)?$valeur:utf8_encode($valeur));
}
function decode_html($html) {
    // Retrait des retours à la ligne
    $html = str_replace("\n", " ", $html);
    $html = str_replace("\r", " ", $html);
    // Retrait des espaces en plus
    while (strpos($html, "  ")) {
        $html = str_replace("  ", " ", $html);
    }
    // Remplacement des marques de fin de paragraphes par des retour à la ligne
    $html = str_replace("<br>", "\n", $html);
    $html = str_replace("</h1>", "\n", $html);
    $html = str_replace("</h2>", "\n", $html);
    $html = str_replace("</h3>", "\n", $html);
    $html = str_replace("</h4>", "\n", $html);
    $html = str_replace("</h5>", "\n", $html);
    $html = str_replace("</h6>", "\n", $html);
    $html = str_replace("</p>", "\n", $html);
    $html = str_replace("</div>", "\n", $html);
    $html = str_replace("</td>", "\n", $html);
    //Traitement des liens
    while ($pos = strpos($html, "<a")) {
        $texte1 = substr($html, 0, $pos);
        $pos1 = strpos($html, "href", $pos)+6;
        $pos2 =  strpos($html, "\"", $pos1)?strpos($html, "\"", $pos1):strpos($html, "'", $pos1);
        if(!$pos2) $pos2 = $pos1 + 2;
        $texte2 = substr($html,  $pos1, $pos2-$pos1);
        $texte3 = substr($html, strpos($html, ">", $pos2)+1) ;
        $html = $texte1."\n".$texte2."\n".$texte3;
    }
    // retrait des balises
    while(is_numeric($pos = strpos($html, "<")) ) {
        $texte = substr($html, 0, $pos).substr($html, strpos($html, ">")+1) ;
        $html = $texte;
    }
    // Retrait des espaces en plus
    while (strpos($html, "  ")) {
        $html = str_replace("  ", " ", $html);
    }
    // Rencodage des caractères spéciaux
    $html = html_entity_decode($html, ENT_QUOTES, "ISO-8859-1");
    return $html;
}
function creer_session($table, $user) {
    // Connection la base
    $dbconnect = mysql_connect (MYSQL_HOTE, MYSQL_USER,MYSQL_PASS);
    // Création de la session
    $session = md5(uniqid("ipag"));
    $maintenant = time();
    $expiration = time()+1800;
    // Ecriture du cookie
    setcookie("session", $session, $expiration, "/", ".ipag.fr");
    // Ecriture dans la base
    $requete = "insert into $table ";
    $requete .=" values('$session', '$user', $maintenant, $expiration) ";
    //echo $requete;
    $resultat=mysql_db_query (MYSQL_BASE, $requete, $dbconnect);
    verifie_requete("Creation session", $requete);
}
function lecture_session($table) {
    global $Email;
    //Lecture du cookie de session
    $Session = $_COOKIE["session"];
    // Vérication de la session
    // Connection la base
    $dbconnect = mysql_connect (MYSQL_HOTE, MYSQL_USER,MYSQL_PASS);
    // Ecriture dans la base
    $requete = "select * from $table ";
    $requete .=" where ID_Session = '$Session' ";
    //echo $requete;
    $resultat=mysql_db_query (MYSQL_BASE, $requete, $dbconnect);
    verifie_requete("Lecture Cookies session", $requete);
    if (mysql_num_rows($resultat) == 1) {
        $r = mysql_fetch_assoc($resultat);
        $Email = $r["email"];
        $Fin = $r["fin"];
        $Time = time();
        if ($Fin < time()) {
            // session expiré
            header("location:stage_session.php");
            echo "session expiree";
            exit;
        } else {
            // C'est ok
            $expiration = $Time + 3600;
            // mise à jour du cookies
            setcookie("session", $Session, $expiration, "/");
            // Mise à jour de la base dans la base
            $requete = "update $table ";
            $requete .=" set fin = $expiration ";
            $requete .=" where ID_Session = '$Session' ";
            //echo $requete;
            $resultat=mysql_db_query (MYSQL_BASE, $requete, $dbconnect);
            verifie_requete("Mise a jour session", $requete);
        }
    } else {
        header("location:stage_session.php");
        echo "pas de session<br>";
        echo "session expiree";
        exit;
    }
}
function preprint_r($tableau) {
    echo "<pre>\n";
    print_r($tableau);
    echo "</pre>\n";
}
function dateMysql($due_date)
{
    $tabDate = explode('/' , $due_date);
    $date_sql  = $tabDate[2].'-'.$tabDate[1].'-'.$tabDate[0];
    return $date_sql;
}
function http_post($server, $port, $url, $vars, $methode, $user, $mdp) {
    // example:
    //  http_post(
    //	"www.fat.com",
    //	80,
    //	"POST",
    //	"/weightloss.pl",
    //	array("name" => "obese bob", "age" => "20")
    //	"j.dupont@ipag.fr",
    //	"abc"
    //	);
    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    $accept_language = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
    $ListeChamps = "";
    if(is_array($vars)) {
        foreach($vars as $champs => $valeur)
            $ListeChamps.= urlencode($champs) . "=" . urlencode($valeur) . "&";
        $ListeChamps = substr($ListeChamps,0,-1);
    } else {
        $ListeChamps = $vars;
    }
    $content_length = strlen($ListeChamps);
    $headers  = "$methode $url HTTP/1.1\r\n";
    $headers .= "Accept: */*\r\n";
    $headers .= "Accept-Language: $accept_language\r\n";
    $headers .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $headers .= "User-Agent: $user_agent\r\n";
    $headers .= "Host: $server\r\n";
    $headers .= "Cache-Control: no-cache\r\n";
    $headers .= "Authorization: Basic ".base64_encode("$user:$mdp")."\r\n";
    $headers .= "Content-Length: $content_length\r\n";
    $headers .= "Connection: Close\r\n\r\n";
    $fp = fsockopen($server, $port, $errno, $errstr);
    if (!$fp)
        return false;
    fputs($fp, $headers);
    fputs($fp, $ListeChamps);
    $ret = "";
    while (!feof($fp))
        $ret.= fgets($fp,128);
    fclose($fp);
    return $ret;
}
function cleanCaracteresSpeciaux($chaine)
{
    setlocale(LC_ALL, 'fr_FR');
    $chaine = preg_replace('#[^0-9a-z]+#i', '-', $chaine);
    while(strpos($chaine, '--') !== false)
    {
        $chaine = str_replace('--', '-', $chaine);
    }
    $chaine = trim($chaine, '-');
    return $chaine;
}
function dateDiff($date1, $date2){
    $diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
    $retour = array();
    $tmp = $diff;
    $retour['second'] = $tmp % 60;
    $tmp = floor( ($tmp - $retour['second']) /60 );
    $retour['minute'] = $tmp % 60;
    $tmp = floor( ($tmp - $retour['minute'])/60 );
    $retour['hour'] = $tmp % 24;
    $tmp = floor( ($tmp - $retour['hour'])  /24 );
    $retour['day'] = $tmp;
    return $retour;
}
function string2url($chaine) {
    $chaine = trim($chaine);
    $chaine = strtr($chaine,
        "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
        "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
    $chaine = strtr($chaine,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz");
    $chaine = preg_replace('#([^.a-z0-9]+)#i', '-', $chaine);
    $chaine = preg_replace('#-{2,}#','-',$chaine);
    $chaine = preg_replace('#-$#','',$chaine);
    $chaine = preg_replace('#^-#','',$chaine);
    return $chaine;
}
function random_str($nbr=5) {
    $str = "";
    $chaine = "123456789";
    $nb_chars = strlen($chaine);
    for($i=0; $i<$nbr; $i++)
    {
        $str .= $chaine[ rand(0, ($nb_chars-1)) ];
    }
    return $str;
}
/**
* Envoi un email formaté 
* 
* @param mixed $destinataire	destinataire
* @param mixed $sujet			Objet du message
* @param mixed $message_html	Corp du message en HTML, la version texte brut sera généré automatiquement
* @param mixed $expediteur      Adresse de l'expéditeur
* @param mixed $cc				Destinataire en copie visible, "" si personne à mettre
* @param mixed $bcc             Destinataire en copie invisible, "" si personne à mettre
*/
function mailEnvoi($destinataire = "drozo.joan@gmail.com", $sujet = "", $message_html = "", $expediteur = "\"daily Ride\"<dailyride@dailyride.fr>", $cc = "", $bcc = ""){
    // Si le message est vide, il n'y a pas d'envoi
    if(empty($message_html)) {
        return false; 
    }
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $destinataire)) // On filtre les serveurs qui rencontrent des bogues.
    {
        $passage_ligne = "\r\n";
    }
    else
    {
        $passage_ligne = "\n";
    }
    //=====Déclaration des messages au format texte et au format HTML.
    $message_txt = decode_html($message_html);
    //==========
    //=====Création de la boundary
    $boundary = "-----=".md5(rand());
    //=====Création du header de l'e-mail.
    $header = "From: $expediteur".$passage_ligne;
    $header.= empty($cc)?"": "CC: $cc".$passage_ligne;
    $header.= empty($bcc)?"": "BCC: $bcc".$passage_ligne;
    $header.= "Reply-to: $expediteur".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    //==========
    //=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format HTML
    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    //==========
    //echo $message; exit;
    //=====Envoi de l'e-mail.
    return mail($destinataire,$sujet,$message,$header);
}
?>