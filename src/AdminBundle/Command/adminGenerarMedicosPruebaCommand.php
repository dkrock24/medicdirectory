<?php

namespace AdminBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class adminGenerarMedicosPruebaCommand extends Command {

    protected function configure() {
        $this
                // the name of the command (the part after "bin/console")
                ->setName('admin:generar-medicos-prueba')

                // the short description shown while running "php bin/console list"
                ->setDescription('Crea medicos de manera aleatoria.')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp("Crea medicos de manera aleatoria con un numero definido por el primer parametro")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $num = 0;

        $output->writeln([
            '',
            '========================',
            'Creador de medicos',
            '========================',
            '',
            'Medicos a crear: ' . $num,
        ]);
    }

}
