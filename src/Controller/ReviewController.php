<?php

namespace App\Controller;


use App\Exception\HotelNotFoundException;
use App\Exception\InvalidParameterException;
use App\HTTP\JsonErrorResponse;
use App\Request\DataForChartRequest;
use App\UseCase\GetDataForChartUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReviewController
{
    private GetDataForChartUseCase $getDataForChartUseCase;

    /**
     * ReviewController constructor.
     *
     * @param GetDataForChartUseCase $getDataForChartUseCase
     */
    public function __construct(GetDataForChartUseCase $getDataForChartUseCase)
    {
        $this->getDataForChartUseCase = $getDataForChartUseCase;
    }


    public function get(int $hotelId, int $from, int $to): JsonResponse
    {
        try {
            $request = new DataForChartRequest($hotelId, $from, $to);
            return new JsonResponse(['result' => 'ok', 'data' => $this->getDataForChartUseCase->execute($request)]);
        } catch (HotelNotFoundException $exception) {
            return new JsonErrorResponse($exception->getMessage(), 404);
        } catch (InvalidParameterException $exception) {
            return new JsonErrorResponse($exception->getMessage(), 400);
        } catch (\Exception $exception) {
            throw $exception;
            return new JsonErrorResponse('Internal server error', 500);
        }
    }
}