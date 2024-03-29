<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Card;
use App\UnknownIdmTouchHistory;
use App\Http\Resources\CardResource;
use App\Http\Resources\UnknownIdmTouchHistoryResource;
use Illuminate\Http\Response;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $cards = Card::latest()->get();
        return CardResource::collection($cards);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $residentId
     * @return CardResource
     */
    public function store(Request $request, int $residentId)
    {
        $card = new Card;
        $card->resident_id = $residentId;
        $card->name = $request->name;
        $card->idm = UnknownIdmTouchHistory::orderBy('id', 'desc')->first()->idm;
        $card->save();

        return new CardResource($card);
    }

    /**
     * Display the specified resource.
     *
     * @param Card $card
     * @return Card
     */
    public function show(int $residentId, Card $card)
    {
        return new CardResource($card);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Card $card
     * @return array
     * @throws \Exception
     */
    public function destroy(int $residentId, Card $card)
    {
        $card->delete();
        return ['result' => 'success'];
    }


    /**
     * 直近でタッチされた未登録のカード情報を取得する
     *
     * @return string
     */
    public function lastUnknownTouchIdm()
    {
        $unknownIdmTouchHistory = UnknownIdmTouchHistory::orderBy('id', 'desc')->first();
        return new UnknownIdmTouchHistoryResource($unknownIdmTouchHistory);
    }

}
