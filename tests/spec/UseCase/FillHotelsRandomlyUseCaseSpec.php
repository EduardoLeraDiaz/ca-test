<?php

namespace spec\App\UseCase;

use App\Repository\HotelRepository;
use App\UseCase\FillHotelsRandomlyUseCase;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FillHotelsRandomlyUseCaseSpec extends ObjectBehavior
{
    public function let(HotelRepository $hotelRepository)
    {
        $this->beConstructedWith($hotelRepository);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(FillHotelsRandomlyUseCase::class);
    }

    public function it_fills_the_hotels_randomly(HotelRepository $hotelRepository)
    {
        $hotelRepository->create(Argument::any())->shouldBeCalledTimes(10);
        $this->execute();
    }
}