<?php 
// Si $_GET de id est set et que ma clef index exist on envoie sur la bonne page sinon on envoie sur l'accueil
if (isset($_GET['id']) && array_key_exists($_GET['id'], $arr_content)){

	require './view/' . $arr_content[$_GET['id']] . '.php';

}else{

	require './view/' . $arr_content[1] . '.php';
}
?>