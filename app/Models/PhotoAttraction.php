<?php

namespace App\Models;

use App\Models\Traits\UploadFiles;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhotoAttraction extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory, SoftDeletes, Uuid, UploadFiles;
    protected $fillable = ['name', 'url', 'attraction_id'];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'id' => 'string',
        'url' => 'string',
        'name' => 'string',
    ];

    public static $fileFields = [
        'url'
    ];

    public $incrementing = false;

    protected function uploadDir(): string
    {
        return 'images';
    }

    public static function create(array $attributes = [])
    {
        $files = self::extractFiles($attributes);

        try {
            \DB::beginTransaction();
            /** @var PhotoAttraction $photo */
            $photo = static::query()->create($attributes);
            $photo->uploadFiles($files);
            \DB::commit();
            return $photo;
        } catch (\Exception $exception) {
            if (isset($photo)) {
                $photo->deleteFiles($files);
            }
            \DB::rollBack();
            throw $exception;
        }
    }

    public function update(array $attributes = [], array $options = [])
    {
        $files = self::extractFiles($attributes);

        try {
            \DB::beginTransaction();
            $saved = parent::update($attributes, $options);
            if ($saved) {
                $this->uploadFiles($files);
            }
            \DB::commit();
            if ($saved && count($files)) {
                $this->deleteOldFiles();
            }
            return $saved;
        } catch (\Exception $exception) {
            if (isset($saved)) {
                $this->deleteFiles($files);
            }
            \DB::rollBack();
            throw $exception;
        }
    }

    public function getUrlLinkAttribute()
    {
        return $this->url ? $this->getFileUrl($this->url) : null;
    }
}
