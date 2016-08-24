<?php

function admin_path() {
	$path = base_url().ADMINPATH;
	return $path;
}

function admin_link( $value ) {	
	$link = admin_path().$value;	
	return $link;
}

?>