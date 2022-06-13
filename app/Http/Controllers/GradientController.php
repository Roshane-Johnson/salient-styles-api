<?php

namespace App\Http\Controllers;

use App\Models\Gradient;
use App\Http\Requests\StoreGradientRequest;
use App\Http\Requests\UpdateGradientRequest;

class GradientController extends Controller
{
    // TODO: Add favorites to gradient migration

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gradients = Gradient::all();

        if (count($gradients)) {
            return success($gradients);
        }

        return error([], "No gradients were found", 404);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gradient $gradient)
    {
        $_gradient = Gradient::find($gradient->getKey());

        if ($_gradient) {
            $_gradient->user = $_gradient->user->makeHidden(["created_at", "updated_at", "email", "email_verified_at", "first_name", "last_name", "id", "deleted_at"]);
            return success($_gradient);
        }

        error([], "gradient not found");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGradientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGradientRequest $request)
    {
        if (strtolower($request->user()->role) === "admin") {
            $gradient = Gradient::create([
                "user_id" => $request->user()->id,
                "name" => $request->name,
                "colors" => $request->colors,
                "direction" => $request->direction,
            ]);

            if ($gradient) {
                return success($gradient);
            } else {
                return error([], "Unable to save gradient");
            }
        } else {
            return error([], "Only admins can create a gradient right now");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradientRequest $request, $id)
    {
        $gradient = Gradient::find($id);

        if ($gradient) {
            $gradient->user_id = $request->user()->id;
            $gradient->name = $request->name;
            $gradient->colors = $request->colors;
            $gradient->direction = $request->direction;
            $gradientSaved = $gradient->save();

            if ($gradientSaved) {
                $newGradient = Gradient::find($id);
                return success($newGradient);
            }
        } else {
            return error([], "gradient not found", 404);
        }

        return error([], "Unable to update gradient");
    }

    /**
     * Disable the specified resource from viewing outside storage.
     *
     * @param  \App\Models\Gradient  $gradient
     * @return \Illuminate\Http\Response
     */
    public function delete(Gradient $gradient)
    {
        $_gradient = Gradient::find($gradient->getKey());
        $gradientDeleted = $_gradient->delete();

        if ($gradientDeleted) {
            success([], "gradient deleted");
        }

        error([], "unable to delete gradient");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gradient  $gradient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gradient $gradient)
    {
        $_gradient = Gradient::find($gradient->getKey());
        $gradientDeleted = $_gradient->destroy();

        if ($gradientDeleted) {
            success([], "gradient deleted");
        }

        error([], "unable to delete gradient");
    }
}
