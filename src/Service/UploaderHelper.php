<?php
namespace App\Service;

use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    private $uploadsPath;

    public function __construct(string $uploadsPath)
    {
        $this->uploadsPath = $uploadsPath;
    }

    const PERSONA_IMAGE = 'persona_image';

    public function uploadArticleImage(UploadedFile $uploadedFile): string
    {
        // $destination      = $this->uploadsPath . '/persona_image';
        $destination      = $this->uploadsPath . '/' . self::PERSONA_IMAGE;
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename      = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessExtension();
        $uploadedFile->move(
            $destination,
            $newFilename
        );
        return $newFilename;
    }

    public function getImagePath()
    {
        return 'uploads/' . UploaderHelper::PERSONA_IMAGE . '/' . $this->getImageFilename();
    }

}
