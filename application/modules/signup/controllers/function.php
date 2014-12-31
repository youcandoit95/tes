<?php
function cekstring($field) {
if (preg_match("/^[a-z0-9_ ,]+$/i", $field) )
	{
		return true;
	}
	else
	{
		return false;
	}
}

function cekemail($email){
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
  	return false;
  }
	else
  {
  	return true;
  }
}

function validurl($url)
{
if(!preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url))
	{
	return FALSE;
	}
	else
	{
	return TRUE;
	}
}
function blockxss($field){
	strip_tags(stripslashes($field));
}
function getmicrotime()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
?>