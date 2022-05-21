<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Photo;
use Illuminate\Support\Carbon;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photoCount = Photo::count();
        // Table "photos" is empty, get JSON file and fill table with it:
        if (!$photoCount) {
            $source = 'http://jsonplaceholder.typicode.com/photos';
            $sourceData = file_get_contents($source);
            $response = json_decode($sourceData);

            $save = null;
            $i = 1;
            foreach ($response as $photo) {
                $save[$i]['title'] = $photo->title;
                $save[$i]['url'] = $photo->thumbnailUrl;
                $save[$i]['thumbnail_url'] = $photo->url;
                $save[$i]['album_id'] = $photo->albumId;
                $save[$i]['created_at'] = Carbon::now();
                $save[$i]['updated_at'] = Carbon::now();
                $i++;
            }
            // Fill table "photos":
            Photo::insert($save);
        }
    }
}
