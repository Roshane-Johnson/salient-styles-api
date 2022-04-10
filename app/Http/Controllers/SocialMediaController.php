<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use App\Http\Requests\StoreSocialMediaRequest;

class SocialMediaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSocialMediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSocialMediaRequest $request)
    {
        $social = SocialMedia::updateOrCreate(["user_id" => $request->user()->id], [
            "user_id" => $request->user()->id,
            "twitter" => $request->twitter,
            "instagram" => $request->instagram,
            "tiktok" => $request->tiktok,
            "snapchat" => $request->snapchat,
            "youtube" => $request->youtube,
            "facebook" => $request->facebook,
            "whatsapp" => $request->whatsapp,
            "reddit" => $request->reddit,
        ]);

        if ($social) {
            return success($social);
        }

        return error([], "Unable to save social links");
    }
}
