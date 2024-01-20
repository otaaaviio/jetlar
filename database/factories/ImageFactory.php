<?php

namespace Database\Factories;

use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    protected $model = Image::class;
    private readonly ImageService $imageService;

    public function __construct()
    {
        parent::__construct();
        $this->imageService = app(ImageService::class);
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $width = $this->faker->numberBetween(100, 500);
        $height = $this->faker->numberBetween(100, 500);
        $image = imagecreate($width, $height);
        $backgroundColor = imagecolorallocate(
            $image,
            $this->faker->numberBetween(0, 255),
            $this->faker->numberBetween(0, 255),
            $this->faker->numberBetween(0, 255)
        );
        $foregroundColor = imagecolorallocate(
            $image,
            $this->faker->numberBetween(0, 255),
            $this->faker->numberBetween(0, 255),
            $this->faker->numberBetween(0, 255)
        );

        imagefill($image, 0, 0, $backgroundColor);

        $word = $this->faker->word();
        $maxTextWidth = 0.8 * $width;
        $averageCharWidthAtSize10 = 8;
        $fontSize = 10 * ($maxTextWidth / (strlen($word) * $averageCharWidthAtSize10));
        $x = $width / 2 - strlen($word) * $fontSize * $averageCharWidthAtSize10 / 2 / 10;
        $y = $height / 2 + $fontSize / 4;

        $filePrefix = app()->runningUnitTests() ? 'temp-' : '';
        imagettftext($image, $fontSize, 0, $x, $y, $foregroundColor, storage_path('RobotoMono.ttf'), $word);
        imagepng($image, $file = storage_path('app/files/' . $filePrefix . $this->faker->uuid() . '.png'));
        imagedestroy($image);


        return [
            'name' => $this->faker->word(),
            'file_name' => basename($file),
            'mime_type' => mime_content_type($file),
            'path' => 'files/' . basename($file),
            'file_hash' => $this->imageService->hashFile(new \Illuminate\Http\UploadedFile($file, basename($file))),
            'disk' => config('filesystems.default'),
            'extension' => pathinfo($file, PATHINFO_EXTENSION),
            'size' => filesize($file),
        ];
    }
}
