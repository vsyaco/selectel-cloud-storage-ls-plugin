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

if (! class_exists ( 'Plugin' )) {
	die ( 'Hacking attemp!' );
}

class PluginSelectelStorage extends Plugin {
	public function Activate() {
		return true;
	}
	
	public function Deactivate() {
		return true;
	}
	
	public function Init() {
	}
	
	protected $aInherits=array(	  
	   'module'  => array(	
		  'ModuleTopic' => 'PluginSelectelstorage_ModuleTopic', 
		  'ModuleImage' => 'PluginSelectelstorage_ModuleImage',
          'PluginLsgallery_ModuleImage'=>'_ModuleGalleryimage'
		),
       'entity'  =>array('PluginLsgallery_ModuleImage_EntityImage'=>'_ModuleGalleryimage_EntityImage'),
	);
}

?>
