<?php
/*-------------------------------------------------------
*
*	Plugin: Selectel Cloud Storage
*	Author: Dmitry Lakhno (kexek)
*	Website: http://kexek.me
*	E-mail: mail@kexek.me
*
*--------------------------------------------------------
*/

$config = array ();

$config ['user'] = ''; //cloud user
$config ['password'] = ''; //cloud password
$config ['bucket'] = ''; //bucket (storage) name. Must be already created
$config ['domain'] = ''; //for example '<someid>.selcdn.ru/<bucket>' or 'custom-domain-binded-to-selectel-storage.ru'

return $config;

?>
