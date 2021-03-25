<?php
/**
 * Checks if the user is connected
 * 
 * @return bool True if connected, false instead
 */
function isConnected(){
	if(isset($_SESSION['id'])){
		// Is connected
		return true;
	} else {
		// Is not connected
		return false;
	}
}

function isAdmin(){
	if(isConnected()){
		// Is connected
		if($_SESSION['role']==1){
			// Is admin : ok
			return true;
		} else {
			// Is not admin
			return false;
		}
	} else {
		// Is not connected
		return false;
	}
}

function isUser(){
	if(isConnected()){
		// Is connected
		if($_SESSION['role']==3){
			// Is admin : ok
			return true;
		} else {
			// Is not admin
			return false;
		}
	} else {
		// Is not connected
		return false;
	}
}

function resize($originalImage, $name){

	list($width, $height) = getimagesize($originalImage);
	$imageResized = imagecreatetruecolor(1024, 768);
	$imageTmp     = imagecreatefromjpeg ($originalImage);
	imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, 1024, 768, $width, $height);
	imagejpeg($imageResized, "images/$name",100);
	imageDestroy($imageResized);
	}