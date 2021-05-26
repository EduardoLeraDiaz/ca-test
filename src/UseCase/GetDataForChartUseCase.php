<?php

namespace App\UseCase;

use App\Entity\DateScore;
use App\Exception\HotelNotFoundException;
use App\Repository\HotelRepository;
use App\Repository\ReportRepository;
use App\Request\DataForChartRequest;

class GetDataForChartUseCase
{
    const WEEKLY_GROUP_DAYS_START = 30;
    const MONTHLY_GROUP_DAYS_START = 90;

    private HotelRepository $hotelRepository;
    private ReportRepository $reportRepository;

    /**
     * GetDataForChartUseCase constructor.
     *
     * @param HotelRepository  $hotelRepository
     * @param ReportRepository $reportRepository
     */
    public function __construct(
        HotelRepository $hotelRepository,
        ReportRepository $reportRepository
    ) {
        $this->hotelRepository  = $hotelRepository;
        $this->reportRepository = $reportRepository;
    }


    /**
     * @param DataForChartRequest $request
     *
     * @return DateScore[]
     * @throws HotelNotFoundException
     */
    public function execute(DataForChartRequest $request): array
    {
        if (is_null($this->hotelRepository->find($request->getHotelId()))) {
            throw new HotelNotFoundException();
        }

        if ($request->getRequestedAmountOfDays() < self::WEEKLY_GROUP_DAYS_START) {
            return $this->reportRepository->getDailyReport($request->getHotelId(), $request->getFrom(), $request->getTo());
        }

        if ($request->getRequestedAmountOfDays() < self::MONTHLY_GROUP_DAYS_START) {
            return $this->reportRepository->getWeeklyReport($request->getHotelId(), $request->getFrom(), $request->getTo());
        }

        return $this->reportRepository->getMonthlyReport($request->getHotelId(), $request->getFrom(), $request->getTo());
    }
}
