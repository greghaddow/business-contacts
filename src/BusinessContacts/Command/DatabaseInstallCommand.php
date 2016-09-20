<?php

namespace BusinessContacts\Command;
use Knp\Command\Command;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;


class DatabaseInstallCommand extends \Knp\Command\Command
{
	private $app;
	protected function configure() {

		$this
			->setName("bc:install-schema")
			->setDescription("Business Contacts create database");
        }
	protected function execute(ArgvInput $input, ConsoleOutput $output) {
		$this->app = $this->getSilexApplication();
		$db = $this->app['db']->import();


		$output->writeln("Database import complete");
	}
}