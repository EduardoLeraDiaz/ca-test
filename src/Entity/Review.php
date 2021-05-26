<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReviewRepository::class)
 */
class Review
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private int $hotel_id;

    /**
     * @ORM\Column(type="smallint")
     */
    private int $score;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $comment;

    /**
     * @ORM\Column(type="integer")
     */
    private int $created_date;

    /**
     * Review constructor.
     *
     * @param int|null $id
     * @param int      $hotel_id
     * @param int      $score
     * @param string   $comment
     * @param int      $created_date
     */
    public function __construct(?int $id, int $hotel_id, int $score, string $comment, int $created_date)
    {
        $this->id           = $id;
        $this->hotel_id     = $hotel_id;
        $this->score        = $score;
        $this->comment      = $comment;
        $this->created_date = $created_date;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getHotelId(): int
    {
        return $this->hotel_id;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @return int
     */
    public function getCreatedDate(): int
    {
        return $this->created_date;
    }
}
