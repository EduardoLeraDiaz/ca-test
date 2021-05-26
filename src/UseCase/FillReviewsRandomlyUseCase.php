<?php

namespace App\UseCase;

use App\Entity\Review;
use App\Repository\ReviewRepository;

class FillReviewsRandomlyUseCase
{
    const NUMBER_OF_REVIEWS = 100000;
    const SECONDS_ON_A_YEAR = 60 * 60 * 24 * 365;
    const MAX_OF_YEARS_AGO = 2;

    private ReviewRepository $reviewRepository;

    /**
     * FillReviewsRandomlyUseCase constructor.
     *
     * @param ReviewRepository $reviewRepository
     */
    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function execute(): void
    {
        $now =  time();
        $timeAgo = $now - self::SECONDS_ON_A_YEAR * self::MAX_OF_YEARS_AGO;

        foreach (range(1, self::NUMBER_OF_REVIEWS) as $index) {
            $hotelId = rand(1, FillHotelsRandomlyUseCase::NUMBER_OF_HOTELS);
            $score = rand(0,5);
            $createdData = rand($timeAgo, $now);


            $reviews[] = new Review(
                null,
                $hotelId,
                rand(0,5),
                "Comment for $hotelId with score $score on ".date('Y-m-d e', $createdData),
                $createdData
            );
        }

        $this->reviewRepository->bulk($reviews);
    }

}
