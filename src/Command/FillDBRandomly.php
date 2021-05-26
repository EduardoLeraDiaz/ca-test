<?php

namespace App\Command;

use App\UseCase\FillHotelsRandomlyUseCase;
use App\UseCase\FillReviewsRandomlyUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FillDBRandomly extends Command
{
    protected static $defaultName = 'app:fill-database-randomly';
    protected FillHotelsRandomlyUseCase $fillHotelTableUseCase;
    protected FillReviewsRandomlyUseCase $fillReviewsRandomlyUseCase;

    /**
     * FillDBRandomly constructor.
     *
     * @param FillHotelsRandomlyUseCase $fillHotelTableUseCase
     */
    public function __construct(
        FillHotelsRandomlyUseCase $fillHotelTableUseCase,
        FillReviewsRandomlyUseCase $fillReviewsRandomlyUseCase
    ) {
        $this->fillHotelTableUseCase = $fillHotelTableUseCase;
        $this->fillReviewsRandomlyUseCase = $fillReviewsRandomlyUseCase;
        parent::__construct();
    }


    protected function configure(): void
    {
        $this->setDescription('Fill Hotel and reviews with random values. It should be launched from a db without data')
             ->setHelp(
                 'This command will fill the DB as required in the README.md file of the test (CA-README.md in that project.'
             );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting to fill the Hotel table');
        $this->fillHotelTableUseCase->execute();

        $output->writeln('Starting to fill the Review table');
        $this->fillReviewsRandomlyUseCase->execute();

        return Command::SUCCESS;
    }
}
