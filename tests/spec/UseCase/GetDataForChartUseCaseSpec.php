<?php

namespace spec\App\UseCase;

use App\Entity\Hotel;
use App\Repository\HotelRepository;
use App\Repository\ReportRepository;
use App\Request\DataForChartRequest;
use App\UseCase\GetDataForChartUseCase;
use PhpSpec\ObjectBehavior;

class GetDataForChartUseCaseSpec extends ObjectBehavior
{
    public function let(
        HotelRepository $hotelRepository,
        ReportRepository $reportRepository
    ) {
        $this->beConstructedWith($hotelRepository, $reportRepository);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GetDataForChartUseCase::class);
    }

    public function it_make_a_report_grouped_dayly(
        HotelRepository $hotelRepository,
        ReportRepository $reportRepository,
        DataForChartRequest $request,
        Hotel $hotel
    ) {
        $hotelRepository->find(1)->willReturn($hotel);
        $request->getHotelId()->willReturn(1);
        $request->getFrom()->willReturn(100000);
        $request->getTo()->willReturn(200000);
        $request->getRequestedAmountOfDays()->willReturn(GetDataForChartUseCase::WEEKLY_GROUP_DAYS_START-1);
        $reportRepository->getDailyReport(1, 100000, 200000)->willReturn([])->shouldBeCalledOnce();
        $this->execute($request);
    }

    public function it_make_a_report_grouped_weekly(
        HotelRepository $hotelRepository,
        ReportRepository $reportRepository,
        DataForChartRequest $request,
        Hotel $hotel
    ) {
        $hotelRepository->find(1)->willReturn($hotel);
        $request->getHotelId()->willReturn(1);
        $request->getFrom()->willReturn(100000);
        $request->getTo()->willReturn(200000);
        $request->getRequestedAmountOfDays()->willReturn(GetDataForChartUseCase::WEEKLY_GROUP_DAYS_START);
        $reportRepository->getWeeklyReport(1, 100000, 200000)->willReturn([])->shouldBeCalledOnce();
        $this->execute($request);
    }

    public function it_make_a_report_grouped_monthly(
        HotelRepository $hotelRepository,
        ReportRepository $reportRepository,
        DataForChartRequest $request,
        Hotel $hotel
    ) {
        $hotelRepository->find(1)->willReturn($hotel);
        $request->getHotelId()->willReturn(1);
        $request->getFrom()->willReturn(100000);
        $request->getTo()->willReturn(200000);
        $request->getRequestedAmountOfDays()->willReturn(GetDataForChartUseCase::MONTHLY_GROUP_DAYS_START);
        $reportRepository->getMonthlyReport(1, 100000, 200000)->willReturn([])->shouldBeCalledOnce();
        $this->execute($request);
    }
}
