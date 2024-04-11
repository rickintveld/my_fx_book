<?php

declare(strict_types=1);

namespace App\Command;

use App\Dto\Account\LoginCredentials;
use App\Event\LoginEvent;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        $email = $helper->ask($input, $output, new Question('Please enter your email: '));
        $password = $helper->ask($input, $output, new Question('Please enter your password: '));

        $loginCredentials = LoginCredentials::new($email, $password);

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
