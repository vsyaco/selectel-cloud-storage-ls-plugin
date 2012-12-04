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

class PluginSelectelstorage_ModuleTopic extends PluginSelectelstorage_Inherit_ModuleTopic {

	public function UploadTopicPhoto($aFile) {

		$sFile=parent::UploadTopicPhoto($aFile);

		$sFile = $this->Image_UploadToSelectelStorage($this->Image_GetServerPath($sFile));

		return $this->Image_GetWebPath($sFile);
	}
}

?>