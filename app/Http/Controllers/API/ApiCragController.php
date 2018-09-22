<?php

namespace App\Http\Controllers\API;

use App\Crag;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Crag\GetCragAroundPlaceRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\API\Crag\GetCragByIdRequest;

/**
 * @resource Crag
 *
 * Routes to retrieve information on oblyk crags
 *
 */
class ApiCragController extends Controller
{
    private $cragDbAttributes = [
        'id',
        'label',
        'code_country',
        'city',
        'region',
        'lat',
        'lng',
        'type_voie',
        'type_grande_voie',
        'type_bloc',
        'type_deep_water',
        'type_via_ferrata',
    ];

    private $gapGragDbAttributes = [
        'spreadable_id',
        'min_grade_text',
        'max_grade_text',
    ];

    /**
     * @param $id
     * @return Crag
     */
    function getCrag($id) : Crag
    {
        $crag = Crag::where('id', $id)
            ->select($this->cragDbAttributes)
            ->withCount('routes')
            ->with(['gapGrade' => function ($query) {$query->select($this->gapGragDbAttributes);}])
            ->first();

        // Additional information
        $this->additionalInformation($crag);

        return $crag;
    }

    /**
     *
     * GET : Crag by Id
     *
     * Get crag by oblyk Id with his information
     *
     * @param GetCragByIdRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    function getCragResponse(GetCragByIdRequest $request, $id) : JsonResponse
    {
        return response()->json(['data' => $this->getCrag($id)]);
    }

    /**
     * @param $cragsIdArray
     * @return array
     */
    function getCrags($cragsIdArray) : array
    {
        $crags = Crag::whereIn('id', $cragsIdArray)
            ->select($this->cragDbAttributes)
            ->withCount('routes')
            ->with(['gapGrade' => function ($query) {$query->select($this->gapGragDbAttributes);}])
            ->get();

        foreach ($crags as &$crag) {
            $this->additionalInformation($crag);
        }

        return $crags->toArray();
    }


    /**
     * @param $lat
     * @param $lgn
     * @param $radius in kilometres
     * @return array
     */
    function getCragsAroundPlace($lat, $lgn, $radius) : array
    {
        $crags = [];
        $cragsId = Crag::getCragsAroundPoint($lat, $lgn, $radius);
        foreach ($cragsId as $crag) {
            $crags[] = $crag->id;
        }

        return $this->getCrags($crags);
    }

    /**
     *
     * GET : Crags around place
     *
     * Get all crags around a point with a given radius (in kilometers)
     *
     * @param GetCragAroundPlaceRequest $request
     * @param $lat
     * @param $lgn
     * @param $radius in kilometres
     * @return JsonResponse
     */
    public function getCragsAroundPlaceResponse(GetCragAroundPlaceRequest $request, $lat, $lgn, $radius) : JsonResponse
    {
        $crags = $this->getCragsAroundPlace($lat, $lgn, $radius);

        $data['lng'] = $lgn;
        $data['lat'] = $lat;
        $data['radius'] = $radius;
        $data['crags_count'] = count($crags);
        $data['crags'] = $crags;

        return response()->json(['data' => $data]);
    }

    /**
     * @param Crag $crag
     */
    private function additionalInformation(Crag &$crag)
    {
        $crag->url = $crag->url();
        $crag->cover = $crag->hasCover() ? $crag->bandeau : null;
    }
}
