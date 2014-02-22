<?php
/**
 * Created by PhpStorm.
 * User: Yuriy Tarnavskiy
 * Date: 18.02.14
 * Time: 23:14
 */

namespace Geekhub\DreamBundle\Service;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;

class DreamImageHandler
{
    protected $file;
    protected $liipimage;

    public function __construct(CacheManager $cacheManager)
    {
        $this->liipimage = $cacheManager;
    }
    public function init(UploadedFile $file)
    {
        $this->file = $file;
    }

    public function load()
    {
        $uploader = new SymfonyFileUploader($this->file, $this->liipimage);
        $uploader->setUploadPathForPictures('upload/tmp/image/');
        $uploader->setUploadPathForFiles('upload/tmp/files/');
        $uploader->setAllowedSizeForPictures(1*1024*1024);
        $uploader->setAllowedSizeForFile(3*1024*1024);
        $uploader->setAllowedPictureTypes(array('jpg', 'jpeg', 'png', 'gif'));
        $uploader->setAllowedFilesTypes(array('doc', 'docx', 'pdf', 'xls', 'xlsx'));

        $result = $uploader->load();

        return $result;
    }
}