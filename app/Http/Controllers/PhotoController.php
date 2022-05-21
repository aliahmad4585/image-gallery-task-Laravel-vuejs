<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PhotoService;

class PhotoController extends Controller
{

    public PhotoService $photoService;

    /** 
     * inject the photo service in constructor
     */

    public function __construct(PhotoService $photoService)
    {
        $this->photoService =  $photoService;
    }

    /**
     * get the photos
     * 
     * @param Illuminate\Http\Request $request
     */

    public function getPhotos(Request $request)
    {
        $output =  json_encode($this->photoService->output(), true);
        return view('json')->with(['output' => $output]);
    }
}
