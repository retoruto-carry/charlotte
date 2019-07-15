<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Resident;
use App\Http\Resources\ResidentResource;

class ResidentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $residents = Resident::latest()->get();
        return ResidentResource::collection($residents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return ResidentResource
     */
    public function store(Request $request)
    {
        $resident = new Resident;
        $resident->name = $request->name;
        $resident->save();

        return new ResidentResource($resident);
    }

    /**
     * Display the specified resource.
     *
     * @param Resident $resident
     * @return ResidentResource
     */
    public function show(Resident $resident)
    {
        return new ResidentResource($resident);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return ResidentResource
     */
    public function update(Request $request, $id)
    {
        $resident = Resident::find($id);
        $resident->name = $request->name;
        $resident->save();

        return new ResidentResource($resident);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Resident $resident
     * @return array
     * @throws \Exception
     */
    public function destroy(Resident $resident)
    {
        DB::transaction(function () use ($resident) {
            $cards = $resident->cards;
            foreach ($cards as $card) {
                $card->delete();
            }

            $resident->delete();
        });

        return ['result' => 'success'];

    }
}
