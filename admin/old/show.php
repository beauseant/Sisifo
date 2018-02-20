<?php

	header("Content-type:");
	$jpeg = fopen("/var/tmp/data","r");
	$image = fread($jpeg,filesize("/home/postgres/tmp.jpg"));
	echo $image;

?> 
