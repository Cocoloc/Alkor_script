<?php
$array_of_product = array("00010","00011","00012","00013","21787","21788","21789","53951","44061","66707","06157","84785");//"44061" erreur

foreach ($array_of_product as &$value) {//for each article
$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.alkor-groupe.com/WS_Product_API/v1/Product?token=75D54932-6147-4453-91B6-35BD039A7D54&productCode=$value&allNotEmpty=1",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
CURLOPT_HTTPHEADER => array(
'X-Alkor-API-Key:7a957dc7-78a1-42d2-9363-8b4b6240fac5'
),
));
$response = curl_exec($curl);
curl_close($curl);
$obj = json_decode($response); 
echo $response;
if (empty($reponse)){
	continue;
}


$productCode= $obj->ProductCode;
$productShortCode=$obj->ProductShortName;
$min=0;
$max=100;
$price=rand($min,$max);//prix random
//object with pointer ->(Id,Name,Order,Value)
$attribute_1005=$obj->FamilyGroupAttributes[0]->GroupAttributes[0]->Attributes[0];//Les familles, sous famille, et index
$attribute_1006=$obj->FamilyGroupAttributes[0]->GroupAttributes[0]->Attributes[1];
$attribute_1007=$obj->FamilyGroupAttributes[0]->GroupAttributes[0]->Attributes[2];//---------------------

$attribute_794=$obj->FamilyGroupAttributes[1]->GroupAttributes[0]->Attributes[1];//Désignation courte
$attribute_798=$obj->FamilyGroupAttributes[1]->GroupAttributes[0]->Attributes[2];//Désignation complète

$all_attribute_180=$obj->FamilyGroupAttributes[1]->GroupAttributes[2];//chaque attribut du groupe d’attribut Caractéristiques Générales----
$i=0;
for ($i = 0; $i <= count($all_attribute_180->Attributes)-1; $i++) {
	$arrayName[] = $all_attribute_180->Attributes[$i]->Name;
	$arrayValue[] = $all_attribute_180->Attributes[$i]->Value;
}

//send to database all datas
// $user = votre_login;

// $bdd = Nom_de_la_base_de_donnees;

// $passwd  = Mot_de_passe;

// // Connexion au serveur
// mysql_connect($host, $user,$passwd) or die("erreur de connexion au serveur");

// mysql_select_db($bdd) or die("erreur de connexion a la base de donnees");

// // Creation et envoi de la requete
// $query = "INSERT INTO table (nom_colonne_1, nom_colonne_2, ...
//  VALUES ('valeur 1', 'valeur 2', ...)";

// $result = mysql_query($query);

}

// Deconnexion de la base de donnees
mysql_close();
//---------
unset($arrayName);
unset($arrayValue);
unset($productCode);
unset($productShortCode);
unset($price);
unset($attribute_1005);
unset($attribute_1006);
unset($attribute_1007);

unset($attribute_794);
unset($attribute_798);

unset($all_attribute_180);
sleep(1);
echo $value;
//////////////////---------------------------------------------
}


?>


