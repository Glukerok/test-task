<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdController extends Controller
{
    public function create(Request $request)
    {
        $response = [];

        //validate
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:200',
            'desc' => 'max:1000',
            'price' => 'required|integer',
            'photos' => 'required|array',
            'photos.*.url' => 'required',
            'photos.*.is_preview' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
            return response()->json($response, 400);
        }

        $ad = Ad::create([
            'title' => $request->title,
            'price' => $request->price,
            'desc' => $request->desc,
        ]);
        foreach ($request->photos as $photo) {
            Photo::create([
                'url' => $photo['url'],
                'is_preview' => $photo['is_preview'],
                'ad_id' => $ad->id,
            ]);
        }
        $response['id'] = $ad->id;
        $response['status'] = true;

        return response()->json($response, 201);
    }

    public function read(Request $request, $id)
    {
        $response = [];
        //validate
        $validator = Validator::make($request->all(), [
            'fields' => 'array',
            'fields.desc' => 'boolean',
            'fields.photos' => 'boolean',
        ]);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
            return response()->json($response, 400);
        }

        //before---------
        $query = Ad::with('photoPreview');
        //photos
        if (isset($request['fields']) && array_key_exists('photos' ,$request['fields']) && $request['fields']['photos'] == 1)
            $query = $query->with('photos');


        //after-----------
        $ad = $query->find($id);
        //desc
        if (!(isset($request['fields']) && array_key_exists('desc' ,$request['fields']) && $request['fields']['desc'] == 1))
            unset($ad['desc']);

        $response['ad'] = $ad;
        $response['status'] = true;
        return response()->json($response, 201);
    }

    public function list(Request $request) {
        $response = [];
        $with = [];
        $query = Ad::query();
        $hidden = 0;

        //sort
        if ($request['sort'] == 'priceDESC')
            $query = $query->orderBy('price', 'DESC');
        if ($request['sort'] == 'priceASC')
            $query = $query->orderBy('price', 'ASC');
        if ($request['sort'] == 'dateDESC')
            $query = $query->orderBy('date', 'DESC');
        if ($request['sort'] == 'dateASC')
            $query = $query->orderBy('date', 'ASC');

        $query = $query->with('photoPreview')->paginate(10);

        $response = $query;
        return response()->json($response, 201);
    }
}
