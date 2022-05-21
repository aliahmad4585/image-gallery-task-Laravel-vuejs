<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class FavController extends Controller
{

    /**
     * Add new favourate if the user has fav the image
     * Remove the favourate if the user has already liked
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function favourite(Request $request)
    {

        $userId =  $request->userId;
        $imageId =  $request->imageId;
        $user = User::find($userId);

        if (auth()->user()) {
            if ($this->checkIfUserAlreadyLiked($user, $imageId)) {
                $detach =  $this->unfavourate($user, $imageId);
                return response()->json(['detach' => $detach, 'attach' => null, 'isLoggedIn' => true]);
            }

            $attach =  $user->photo()->attach($userId, ['photo_id' => $imageId, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            return response()->json(['detach' => null, 'attach' => $attach, 'isLoggedIn' => true]);
        }

        return response()->json(['detach' => null, 'attach' => null, 'isLoggedIn' => false]);
    }


    /**
     * check user has liked the image.
     *
     * @param  object  $user
     * @param  integer  $imageId
     * 
     * @return $totalLikes
     */
    private function checkIfUserAlreadyLiked($user, $imageId)
    {
        $totalLikes = $user->photo()
            ->wherePivot('photo_id', '=', $imageId)
            ->count();

        return $totalLikes;
    }

    /**
     * remove the image like
     *
     * @param  object  $user
     * @param  integer  $imageId
     * 
     * @return $detach
     */
    private function unfavourate($user, $imageId)
    {
        $detach = $user->photo()
            ->wherePivot('photo_id', '=', $imageId)
            ->detach();

        return $detach;
    }
}
