<?php

namespace App\Request;

use App\Exception\InvalidParameterException;

class DataForChartRequest
{
    private int $hotelId;
    private int $from;
    private int $to;

    /**
     * DataForChartRequest constructor.
     *
     * @param int $hotelId
     * @param int $from
     * @param int $to
     *
     * @throws InvalidParameterException
     */
    public function __construct(int $hotelId, int $from, int $to)
    {
        if ($from > $to) {
            throw new InvalidParameterException('The from data must be before the to data');
        }
        $this->hotelId = $hotelId;
        $this->from    = $from;
        $this->to      = $to;
    }

    /**
     * @return int
     */
    public function getHotelId(): int
    {
        return $this->hotelId;
    }

    /**
     * @return int
     */
    public function getFrom(): int
    {
        return $this->from;
    }

    /**
     * @return int
     */
    public function getTo(): int
    {
        return $this->to;
    }

    public function getRequestedAmountOfDays(): int
    {
        return round(($this->to - $this->from) / (60 * 60 * 24));
    }
}
