<?php

namespace App\Repository;

use App\Entity\DateScore;
use Doctrine\ORM\EntityManagerInterface;

class ReportRepository
{
    const REPORT_SQL = <<<EOT
SELECT  count(*) as count, FROM_UNIXTIME(r.created_date, :group) as date_group, avg(r.score) as score 
FROM review as r
WHERE r.hotel_id = :hotel_id 
	and r.created_date > :from
    and r.created_date < :to
group by date_group
order by date_group asc;
EOT;
    const DAILY_GROUP = '%Y%m%d';
    const WEEKLY_GROUP = '%Y%m%u';
    const MONTHLY_GROUP = '%Y%m';


    private EntityManagerInterface $em;

    /**
     * ReportRepository constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param int $hotelId
     * @param int $from
     * @param int $to
     *
     * @return array
     */
    public function getDailyReport(int $hotelId, int  $from, int $to): array
    {
        return $this->getReport(self::DAILY_GROUP, $hotelId, $from, $to);
    }

    /**
     * @param $hotelId
     * @param $from
     * @param $to
     *
     * @return DateScore[]
     */
    public function getWeeklyReport($hotelId, $from, $to): array
    {
        return $this->getReport(self::WEEKLY_GROUP, $hotelId, $from, $to);
    }

    /**
     * @param $hotelId
     * @param $from
     * @param $to
     *
     * @return DateScore[]
     */
    public function getMonthlyReport($hotelId, $from, $to): array
    {
        return $this->getReport(self::MONTHLY_GROUP, $hotelId, $from, $to);
    }

    /**
     * @param string $group
     * @param int    $hotelId
     * @param int    $from
     * @param int    $to
     *
     * @return DateScore[]
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    private function getReport(string $group, int $hotelId, int  $from, int $to): array
    {
        $result = $this->em->getConnection()
                           ->prepare(self::REPORT_SQL)
                           ->executeQuery(
                               [
                                   ':group'     => $group,
                                   ':hotel_id' => $hotelId,
                                   ':from'     => $from,
                                   ':to'       => $to,
                               ]
                           )->fetchAllAssociative();

        return $this->hydrateResult($result);
    }

    /**
     * @param array $result
     *
     * @return DateScore[]
     */
    private function hydrateResult(array $result): array
    {
        $arrayObject = [];

        foreach($result as $item) {
            $arrayObject[] = new DateScore($item['count'], $item['date_group'], $item['score']);
        }

        return $arrayObject;
    }
}
