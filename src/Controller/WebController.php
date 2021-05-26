<?php

namespace App\Controller;

use App\Repository\HotelRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class WebController
{
    private Environment $templating;
    private HotelRepository $hotelRepository;

    /**
     * WebController constructor.
     *
     * @param Environment $templating
     */
    public function __construct(Environment $templating, HotelRepository $hotelRepository)
    {
        $this->templating = $templating;
        $this->hotelRepository = $hotelRepository;
    }


    public function index(): Response
    {
        return new Response(
            $this->templating->render(
                'Web.html.twig',
                [
                    'appData' =>[
                        'hotels' => $this->hotelRepository->findAll(),    
                    ],
                ]
            )
        );
    }
}
