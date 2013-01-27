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

class PluginSelectelstorage_ModuleImage extends PluginSelectelstorage_Inherit_ModuleImage {

    /*
     * Сохранение в Selectel Storage
     */
    public function UploadToSelectelstorage($sFilePath,$sFileSource=NULL) {

        if (extension_loaded('curl')) {

            $sS = new SelectelStorage(Config::Get('plugin.selectelstorage.user'), Config::Get('plugin.selectelstorage.password'));

            try {

                $bucket = $sS->getContainer(Config::Get('plugin.selectelstorage.bucket'));

                //$sName = strtolower(array_pop(explode(trim(Config::Get('path.uploads.root')).'/', $sFilePath)));
                // changed this because of PHP strict standarts “only variables should be passed by reference”
                $exploded_filepath = explode(trim(Config::Get('path.uploads.root')).'/', $sFilePath);
                $sName = strtolower(array_pop($exploded_filepath));

                $sFilePath = (isset($sFileSource) ? $sFileSource : $sFilePath);

                if ($bucket->putFile($sFilePath, $sName)) {
                    @unlink($sFilePath);
                    return 'http://' . Config::Get('plugin.selectelstorage.domain') . '/'. $sName;
                }
                else {
                    error_log('Something wrong while uploading file to selectel storage');
                    return false;
                }
            }
            catch(Exception $e) {
                error_log("Something wrong while uploading file to selectel storage. Error: ".$e->getMessage());
                return false;
            }
        }

        return false;
    }

    /*
     * Изменяем логику сохранения файла
     */
    public function SaveFile($sFileSource,$sDirDest,$sFileDest,$iMode=null,$bRemoveSource=false) {

        $sFileDestFullPath=rtrim(Config::Get('path.root.server'),"/").'/'.trim($sDirDest,"/").'/'.$sFileDest;
        $sFileDestFullPath=trim($sDirDest,"/").'/'.$sFileDest;

        $this->CreateDirectory($sDirDest);

        //$bResult=copy($sFileSource,$sFileDestFullPath);
        $bResult = true;

        //$fileContent = file_get_contents($sFileSource);
        //$bResult=file_put_contents($sFileDestFullPath, $fileContent);

        if ($bResult and !is_null($iMode)) {
            chmod($sFileDestFullPath,$iMode);
        }
        if(!strpos($sDirDest,'/tmp/avatars/') && !strpos($sDirDest,'/tmp/fotos/')) {
            $sFileDestFullPath = $this->UploadToSelectelStorage($sFileDestFullPath,$sFileSource);
        }

        if ($bRemoveSource) {
            @unlink($sFileSource);
        }
        /**
         * Если копирование прошло успешно, возвращаем новый серверный путь до файла
         */
        if ($bResult) {
            return $sFileDestFullPath;
        }
        return false;
    }

}

?>