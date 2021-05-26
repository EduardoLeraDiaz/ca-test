<?php

namespace App\Entity;

class DateScore implements \JsonSerializable
{
    private int $reviewCount;
    private string $date;
    private float $score;

    /**
     * DateScore constructor.
     *
     * @param string $date
     * @param float    $score
     */
    public function __construct(int $reviewCount, string $date, float $score)
    {
        $this->date  = $date;
        $this->score = $score;
        $this->reviewCount = $reviewCount;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @return int
     */
    public function getReviewCount(): int
    {
        return $this->reviewCount;
    }

    public function jsonSerialize()
    {
        return [
            'review-count'  => $this->reviewCount,
            'date-group'    => $this->date,
            'average-score' => $this->score
        ];
    }
}