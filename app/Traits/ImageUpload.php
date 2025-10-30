<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

trait ImageUpload
{
    public function imageUpload($file, $path)
    {
        $name = uniqid(). ".webp";

        $gd = new Driver();
        $manager = new ImageManager($gd);

        $image = $manager->read($file)->toWebp(90);

        Storage::disk('public')->put("$path/$name", (string)$image);

        return $name;
    }
}
