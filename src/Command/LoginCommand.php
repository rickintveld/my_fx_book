<?php

declare(strict_types=1);

namespace App\Command;

use App\Dto\Account\LoginCredentials;
use App\Event\LoginEvent;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(
    name: 'fx:login',
    description: 'Login to My FX Book',
)]
class LoginCommand extends Command
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly ValidatorInterface $validator
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('email', InputArgument::REQUIRED, 'Email address')
             ->addArgument('password', InputArgument::REQUIRED, 'Password');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $loginCredentials = LoginCredentials::new($input->getArgument('email'), $input->getArgument('password'));

        $errors = $this->validator->validate($loginCredentials);

        if (count($errors) > 0) {
            $io->error((string) $errors);

            return Command::FAILURE;
        }

        $this->eventDispatcher->dispatch(new LoginEvent($loginCredentials));
        
        $io->success('User session token is created');

        return Command::SUCCESS;
    }
}
