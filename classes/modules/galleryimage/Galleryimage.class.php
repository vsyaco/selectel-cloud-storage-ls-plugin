<?php
/*-------------------------------------------------------
*
*   Plugin: Selectel Cloud Storage
*   Author: Dmitry Lakhno (kexek)
*   Website: http://kexek.me
*   E-mail: mail@kexek.me
*
*--------------------------------------------------------
*/

class PluginSelectelstorage_ModuleGalleryimage extends PluginSelectelstorage_Inherit_PluginLsgallery_ModuleImage {

	public function UploadImage($aFile)
    {
        if (!is_array($aFile) || !isset($aFile['tmp_name'])) {
            return false;
        }

        $sFileName = func_generator(10);
        $sPath = Config::Get('path.uploads.images') . '/lsgallery/' . date('Y/m/d') . '/';

        if (!is_dir(Config::Get('path.root.server') . $sPath)) {
            mkdir(Config::Get('path.root.server') . $sPath, 0755, true);
        }

        $sFileTmp = Config::Get('path.root.server') . $sPath . $sFileName;
        if (!move_uploaded_file($aFile['tmp_name'], $sFileTmp)) {
            return false;
        }


        $aParams = $this->Image_BuildParams('lsgallery');

        $oImage = new LiveImage($sFileTmp);
        /**
         * Если объект изображения не создан,
         * возвращаем ошибку
         */
        if ($sError = $oImage->get_last_error()) {
            // Вывод сообщения об ошибки, произошедшей при создании объекта изображения
            $this->Message_AddError($sError, $this->Lang_Get('error'));
            @unlink($sFileTmp);
            return false;
        }

        /**
         * Превышает максимальные размеры из конфига
         */
        if (($oImage->get_image_params('width') > Config::Get('view.img_max_width')) or ($oImage->get_image_params('height') > Config::Get('view.img_max_height'))) {
            $this->Message_AddError($this->Lang_Get('topic_photoset_error_size'), $this->Lang_Get('error'));
            @unlink($sFileTmp);
            return false;
        }

        // Добавляем к загруженному файлу расширение
        $sFile = $sFileTmp . '.' . $oImage->get_image_params('format');
        rename($sFileTmp, $sFile);

        $aSizes = Config::Get('plugin.lsgallery.size');
        foreach ($aSizes as $aSize) {
            // Для каждого указанного в конфиге размера генерируем картинку
            $sNewFileName = $sFileName . '_' . $aSize['w'];
            $oImage = new LiveImage($sFile);
            if ($aSize['crop']) {
                $this->Image_CropProportion($oImage, $aSize['w'], $aSize['h'], true);
                $sNewFileName .= 'crop';
            }
            $this->Image_Resize($sFile, $sPath, $sNewFileName, Config::Get('view.img_max_width'), Config::Get('view.img_max_height'), $aSize['w'], $aSize['h'], true, $aParams, $oImage);
        }

		/*
		 * Upload to Selectel Cloud Storage
		 */
		$sFile = $this->Image_UploadToSelectelStorage($sFile);

        $sWebPath = $this->Image_GetWebPath($sFile);
		
        return str_ireplace(Config::Get('path.root.web'), '', $sWebPath);
    }

}

?>