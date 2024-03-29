<?php

declare(strict_types=1);

namespace App\Command;

use App\Event\LogoutEvent;
use App\Repository\UserRepository;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fx:logout',
    description: 'Destroy all the logged in sessions',
)]
class LogoutCommand extends Command
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly UserRepository $userRepository
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $users = $this->userRepository->findAll();

        foreach ($users as $user) {
            $this->eventDispatcher->dispatch(new LogoutEvent($user));
        }

        $io->success('All sessions are destroyed!');

        return Command::SUCCESS;
    }
}
