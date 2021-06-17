<?php


namespace App\Models\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Intervention\Image\ImageManagerStatic as Image;

trait UploadFiles
{
    public $oldFiles = [];

    protected abstract function uploadDir(): string;

    public function relativeFilePath($value)
    {
        return "{$this->uploadDir()}/{$value}";
    }

    public static function bootUploadFiles()
    {
        static::updating(function(Model $model){
            $fieldsUpdated = array_keys($model->getDirty());
            $filesUpdated = array_intersect($fieldsUpdated, self::$fileFields);
            $filesFilters = Arr::where($filesUpdated, function ($fileField) use ($model){
                return $model->getOriginal($fileField); // valor antigo
            });

            $model->oldFiles = array_map(function ($fileField) use ($model){
                return $model->getOriginal($fileField);
            }, $filesFilters);
        });
    }

    /**
     * @param UploadFiles[] $files
     */
    public function uploadFiles(array $files)
    {
        foreach ($files as $file) {
            $this->uploadFile($file);
        }
    }

    public function uploadFile($file)
    {
        $image = Image::make($file['file']);
        \Storage::disk()->put(($this->relativeFilePath($file['name'])), $image->stream());
    }

    public function deleteOldFiles()
    {
        $this->deleteFiles($this->oldFiles);
    }

    public function deleteFiles(array $files)
    {
        foreach ($files as $file) {
            $this->deleteFile($file);
        }
    }

    /**
     * @param string|UploadedFile $file
     */
    public function deleteFile($file)
    {
        $filename = false;
        if ($file instanceof UploadedFile) {
            $filename = $file->hashName();
        } elseif (is_array($file)) {
            $filename = $file['name'];
        }
        $filename && \Storage::delete("{$this->uploadDir()}/{$filename}");
    }

    public static function extractFiles(array &$attributes = [])
    {
        $files = [];
        foreach (self::$fileFields as $fileField) {
            if (isset($attributes[$fileField]) && \Str::startsWith($attributes[$fileField], 'data:image')) {

                $name = uniqid() . '.' . explode('/', mime_content_type($attributes[$fileField]))[1];

                $files[] = [
                    'name' => $name,
                    'file' => $attributes[$fileField]
                ];
                $attributes[$fileField] = $name;
            }
        }
        return $files;
    }

    protected function getFileUrl($filename): ?string
    {
        return \Storage::url($this->relativeFilePath($filename));
    }
}
