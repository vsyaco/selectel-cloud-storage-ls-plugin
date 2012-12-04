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

/**
 * Image entity
 *
 * @method ModuleUser_EntityUser getUser
 * @method boolean getIsFavourite
 * @method ModuleVote_EntityVote getVote
 */
class PluginSelectelstorage_ModuleGalleryimage_EntityImage extends PluginSelectelstorage_ModuleGalleryimage_EntityImage_Inherit_PluginLsgallery_ModuleImage_EntityImage
{

    public function getWebPath($sWidth = null)
    {
        if ($this->getFilename()) {
            if ($sWidth) {
                $aPathInfo = pathinfo($this->getFilename());
                $sFilePath = $aPathInfo['dirname'] . '/' . $aPathInfo['filename'] . '_' . $sWidth . '.' . $aPathInfo['extension'];
                return $sFilePath;
            } else {
                return $this->getFilename();
            }
        } else {
            return null;
        }
    }

}