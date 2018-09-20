<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Topo;
use App\TopoCrag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @resource Guidebook
 *
 * Routes to retrieve information on oblyk guidebook
 */
class ApiTopoController extends Controller
{
    private $topoDbAttributes = [
        'id',
        'ean',
        'label',
        'author',
        'editor',
        'editionYear',
        'price',
        'price',
        'page',
        'weight',
    ];

    /**
     * @param $idOrEan
     * @return Topo
     */
    private function getTopo($idOrEan) : Topo
    {
        $topo = Topo::where('ean', $idOrEan)
            ->orWhere('id',$idOrEan)
            ->select($this->topoDbAttributes)
            ->withCount('crags')
            ->first();

        // Additional information
        $topo->url = $topo->url();
        $topo->cover = ($topo->hasCover()) ? env('APP_URL') . $topo->cover() : null;

        // Crags information
        $CragController = new ApiCragController();
        $crags = $CragController->getCrags(
            TopoCrag::where('topo_id', $topo->id)->select('crag_id')->get()->toArray()
        );

        $topo['crags'] = $crags;

        return $topo;
    }

    /**
     * GET : Guidebook by Oblyk Id or Ean
     *
     * Get guidebook information : ean, author, price, crags, etc.
     *
     * **Parameters**
     * - `idOrEan` : Oblyk id or ean *(example : 2 [oblyk id] or  9782915025910 [ean])*
     *
     * @param $idOrEan
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTopoResponse($idOrEan) : JsonResponse
    {
        return response()->json(['data' => $this->getTopo($idOrEan)]);
    }

}
