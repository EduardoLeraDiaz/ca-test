<?php

namespace App\UseCase;

use App\Entity\Hotel;
use App\Repository\HotelRepository;

class FillHotelsRandomlyUseCase
{
    const NUMBER_OF_HOTELS = 10;

    private HotelRepository $hotelRepository;

    /**
     * FillHotelTableUseCase constructor.
     *
     * @param HotelRepository $hotelRepository
     */
    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function execute(): void
    {
        foreach (range(1, self::NUMBER_OF_HOTELS) as $index) {
            $this->hotelRepository->create(
                new Hotel(
                    null,
                    'Hotel '.$index
                )
            );
        }
    }

}