<?php

namespace Services;
use Models\Photo;

class UploadHelper
{
    public function uploadPhoto($photo)
    {
        $errors = [];
        $name = $photo['name'];
        $size = $photo['size']; 
        $error = $photo['error'];
        $tmpLocation = $photo['tmp_name'];
        $nameParts = explode('.', $name);
        $allowedExtensions = ['jpg', 'png'];
        if(!in_array($nameParts[1], $allowedExtensions))
        {
            $errors[] = 'Not allowed extension.';
        }  else if($error !== 0) {
            $errors[] = $this->getErrorDescription($error);
        }

        if(count($errors) === 0) {
            $newFileName = 'photo_'.uniqid().'.'.$nameParts[1];
            $destination = '/var/www/shared-gallery/app/Public/Uploads/'.$newFileName;
            move_uploaded_file($tmpLocation, $destination);
            return $newFileName;
        } else {
            $_SESSION['errors'] = $errors;
            header('Location: /management/upload');
        }
    }

    public function getErrorDescription($error)
    {
        $phpFileUploadErrors = array(
            0 => 'There is no error, the file uploaded with success',
            1 => 'The uploaded file exceeds the upload_max_filesize 
                    directive in php.ini [2MB]',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive 
                    that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.',
        );

        return $phpFileUploadErrors[$error];
    }

    public function reArrayFiles($formFiles)
    {
        $files = [];
        for($i=0;$i<count($formFiles['name']);$i++) {
            foreach(array_keys($formFiles) as $key) {
                $files[$i][$key] = $formFiles[$key][$i];
            }
        }
        return $files;
    }
}