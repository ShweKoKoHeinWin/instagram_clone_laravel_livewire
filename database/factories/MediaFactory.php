<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $url = $this->getUrl('post');
        $mime = $this->getMime($url);
        return [
            'url' => $url,
            'mime'=> $mime,
            'mediable_id' => Post::factory(),
            'mediable_type' => function(array $attributes) {
                return Post::find($attributes['mediable_id'])->get_morph_class();
            },
        ];
    }

    public function getUrl(string $type = 'post'): string
    {
        switch ($type) {
            case 'post':
                $urls = [
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4',
                    "http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4",
                    "http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4"
                ];

                return $this->faker->randomElement( $urls);
                break;

            case 'reel':
                $urls = [
                    'https://placehold.co/600x600'
                ];

                return $this->faker->randomElement( $urls);
                break;

            default:
                dd($type);
                # code...
                break;
        }
    }

    public function getMime(string $url): string
    {
        if(str()->contains($url, 'gtv-videos-bucket')) {
            return 'video';
        } else if(str()->contains($url, 'https://placehold.co')) {
            return 'image';
        }
    }

    public function reel() {
        $url = $this->getUrl('reel');
        $mime = $this->getMime($url);

        return $this->state(function($attributes) use ($url, $mime) {
            return [
                'url' => $url,
                'mime' => $mime,
            ];

        });
    }

    public function post() {
        $url = $this->getUrl('post');
        $mime = $this->getMime($url);

        return $this->state(function($attributes) use ($url, $mime) {
            return [
                'url' => $url,
                'mime' => $mime,
            ];

        });
    }
}
