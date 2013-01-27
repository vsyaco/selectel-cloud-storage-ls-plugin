## Selectel Cloud Storage plugin for LiveStreet CMS 

Currently in Beta.

Selectel cloud storage plugin for LiveStreet CMS offers upload avatars, profile pictures and images from posts directly to Selectel Cloud Storage [1] and serve from it.

It's a beta version of plugin. I have some ideas which want to implement in near future.

Plugin based on Amazon S3 plugin by extravert [2] and contains selectel storage php class [3] originally developed by Eugene Smith [4].

[1]: http://selectel.ru/services/cloud-storage/
[2]: http://lsmods.ru
[3]: https://github.com/kexek/selectel-storage-php-class
[4]: https://github.com/easmith

## Requirements
* PHP 5 or later
* LiveStreet CMS version 1.0.1 or later
* cUrl

## Installation and configuration

Download plugin (see ZIP button above list of files and directories on GitHub), extract folder, name it "selectelstorage" and move it to LiveStreet's "plugins" folder. 

Plugin configuration can be found and edited in config/config.php