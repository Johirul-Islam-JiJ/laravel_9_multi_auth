<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait UploadAble
{
    public function uploadOne(UploadedFile $file, int $width, int $height, string $folder = 'images/',bool $originalExtension = false)
    {
        $generateName = date('Ymdhms') . Str::random(6);
        if ($originalExtension) {
            $generateNameWithExt = '/' . $generateName . "." . $file->getClientOriginalExtension();
        } else {
            $generateNameWithExt = '/' . $generateName . "." . 'webp';
        }
        if (!File::exists(public_path($folder))) {
            File::makeDirectory(public_path($folder), 0777, true);
        }
        Image::make($file)->resize($width, $height)->save(public_path($folder . $generateNameWithExt)); //resizing image
        return $generateNameWithExt;
    }

    public function uploadWithWatermark(UploadedFile $file, int $width, int $height, string $position, int $x, int $y, string $folder = 'images/')
    {
        $generateName = date('Ymdhms') . Str::random(6);
        $generateNameWithExt = '/' . $generateName . "." . 'webp';
//        $generateNameWithExt = '/' . $generateName . "." . $file->getClientOriginalExtension();
//        if (!File::exists(public_path($folder))) {
//            File::makeDirectory(public_path($folder), 0777, true);
//        }
        $water = Storage::disk(config('app.files_disk'))->get('/images/watermark.png');
        $img = Image::make($file)->resize($width, $height)->insert($water, $position, $x, $y)->stream(); //resizing image+

        Storage::disk(config('app.files_disk'))->put($folder.$generateNameWithExt, $img);

//        Storage::put('public/watermarked/' . $fileName . $extension, $watermarkedImage->encode());
        return $generateNameWithExt;
    }

    /**
     * @param null $path
     * @param string $disk
     */
    public function deleteOne($directory, $filename)
    {
//        Storage::disk(config('app.files_disk'))->delete($directory . $filename);
        File::delete(public_path($directory . $filename));
    }

}
