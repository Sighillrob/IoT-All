<?php 

function clean($string)
{
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function generate_token() 
{ 
	return clean(Hash::make(rand() . time() . rand())); 
}

function generate_expiry() 
{
 return time() + 3600000; 
}



?>