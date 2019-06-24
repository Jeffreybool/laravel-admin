<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Transformers\ImageTransformer;
use App\Http\Controllers\Api\Controller;
use App\Http\Controllers\Api\Traits\ImageUploadHandler;

class UploadsController extends Controller
{
    use ImageUploadHandler;

    /**
     * @param Request $request
     * @param Image   $image
     * @return \Dingo\Api\Http\Response
     */
    public function upload(Request $request,Image $image){
        $this->validateRequest($request, 'upload');
        $user = $this->user();
        $result = $this->save($request->image, str_plural($request->type), $user->id, false);
        $image->path = $result['path'];
        $image->type = $request->type;
        $image->user_id = $user->id;
        $image->save();

        return $this->response->item($image, new ImageTransformer())->setStatusCode(201);
    }
}
