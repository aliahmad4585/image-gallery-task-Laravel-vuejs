<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Support\Carbon;

class PhotoService
{

    public function output()
    {
        if (isset($_GET['weekday']) && $_GET['weekday'] == 1) {
            $data = $this->weekday();
        } else {
            $data = $this->weekend();
        }

        $output = $data['data'];
        $output += ['totalPages' => $data['totalPages']];

        return $output;
    }

    private function getResults($weekday, $entriesPerPage)
    {
        $offset = 0;
        if (isset($_GET['page']) && $_GET['page'] > 1) {
            $offset = $_GET['page'] * $entriesPerPage - $entriesPerPage;
        }

        $userId = 0;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        }
        if ($weekday) {
            $results = DB::table('photos')
                ->select(
                    'photos.id',
                    'photos.title',
                    'photos.url',
                    DB::raw('(SELECT COUNT(*) FROM photos_likes  WHERE photo_id = photos.id) AS favs'),
                    DB::raw('(SELECT user_id FROM photos_likes  WHERE photo_id = photos.id and user_id= ' . $userId . ' limit 1) AS user_id')
                )
                ->join('photos_likes', 'photos_likes.photo_id', '=', 'photos.id', 'left')
                ->groupBy('photos.id')
                ->orderByRaw('favs DESC')
                ->offset($offset)
                ->limit($entriesPerPage)
                ->get();
            $found = Photo::count();
        } else {
            $results = DB::table('users')
                ->select(DB::raw('SQL_CALC_FOUND_ROWS users.name, users.email, 
            (SELECT COUNT(*) FROM photos_likes WHERE user_id = users.id) AS favs'))
                ->join('photos_likes', 'photos_likes.user_id', '=', 'users.id', 'left')
                ->whereBetween('photos_likes.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy('users.id')
                ->orderByRaw('favs DESC')
                ->offset($offset)
                ->limit($entriesPerPage)
                ->get();
            $found = User::count();
        }

        $return['results'] = $results;
        $return['totalCount'] = $found;

        return $return;
    }

    public function weekday()
    {
        $entriesPerPage = 12;
        // Select "photos" table
        $return = $this->getResults(true, $entriesPerPage);
        // Collect and output a limited (based on $entriesPerPage) array:
        $data = array();
        $i = 1;
        foreach ($return['results'] as $photo) {
            if ($i <= $entriesPerPage) {
                $data[$i]['id'] = $photo->id;
                $data[$i]['title'] = $photo->title;
                $data[$i]['url'] = $photo->url;
                $data[$i]['favs'] = $photo->favs;
                $data[$i]['user_id'] = $photo->user_id;

                $i++;
            } else {
                break;
            }
        }
        $output['data'] = $data;
        $output['totalPages'] = round($return['totalCount'] / $entriesPerPage);

        return $output;
    }

    public function weekend()
    {
        $entriesPerPage = 4;
        // Select "users" table
        $return = $this->getResults(false, $entriesPerPage);
        // Collect and output a limited (based on $entriesPerPage) array:
        $data = array();
        $i = 1;
        foreach ($return['results'] as $user) {
            if ($i <= $entriesPerPage) {
                $data[$i]['name'] = $user->name;
                $data[$i]['email'] = $user->email;
                $data[$i]['favs'] = $user->favs;

                $i++;
            } else {
                break;
            }
        }
        $output['data'] = $data;
        $output['totalPages'] = round($return['totalCount'] / $entriesPerPage);

        return $output;
    }
}
