<?php

namespace App\Models;

use Database\Factories\ImageFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * \App\Models\Image
 *
 * @property int $image_id
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
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @method static Builder|Image whereCreatedAt($value)
 * @method static Builder|Image whereDisk($value)
 * @method static Builder|Image whereExtension($value)
 * @method static Builder|Image whereImageHash($value)
 * @method static Builder|Image whereImageName($value)
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image whereMimeType($value)
 * @method static Builder|Image whereName($value)
 * @method static Builder|Image wherePath($value)
 * @method static Builder|Image whereSize($value)
 * @method static Builder|Image whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Image extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'image_id';
    protected $table = 'image';

    public static function newFactory(): ImageFactory
    {
        return ImageFactory::new();
    }

    public function pet()
    {
        return $this->belongsToMany(Pet::class, 'pet_images', 'image_id', 'pet_id');
    }
}