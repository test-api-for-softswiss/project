<?php
/**
 * Author: Anton Orlov
 * Date: 09.10.2017
 * Time: 23:30
 */

namespace App\Http\Controllers;


use App\Services\PresenterHelper;

abstract class AbstractApiController
{
    /**
     * Method creates positive API response with data payload
     *
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response($data)
    {
        $result = [
            'success' => true,
            'results' => $data
        ];

        if ($presenter = PresenterHelper::getPresenter(\Route::currentRouteAction())) {
            $result['results'] = $presenter->getResponse($data);
        }

        return response()->json($result);
    }
}