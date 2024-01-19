<?php

namespace App\Models;

use Database\Factories\FileFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * \App\Models\File
 *
 * @property int $file_id
 * @property string $name
 * @property string $file_name
 * @property string $mime_type
 * @property string $path
 * @property string $file_hash
 * @property string $disk
 * @property string $extension
 * @property string $size
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|File newModelQuery()
 * @method static Builder|File newQuery()
 * @method static Builder|File query()
 * @method static Builder|File whereCreatedAt($value)
 * @method static Builder|File whereDisk($value)
 * @method static Builder|File whereExtension($value)
 * @method static Builder|File whereFileHash($value)
 * @method static Builder|File whereFileName($value)
 * @method static Builder|File whereId($value)
 * @method static Builder|File whereMimeType($value)
 * @method static Builder|File whereName($value)
 * @method static Builder|File wherePath($value)
 * @method static Builder|File whereSize($value)
 * @method static Builder|File whereUpdatedAt($value)
 * @mixin Eloquent
 */
class File extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'file_id';
    protected $table = 'files';

    public static function newFactory(): FileFactory
    {
        return FileFactory::new();
    }

    public function pets()
    {
        return $this->belongsToMany(Pet::class, 'pet_photos', 'file_id', 'pet_id');
    }
}