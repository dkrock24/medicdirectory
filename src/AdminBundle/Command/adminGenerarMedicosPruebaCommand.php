<?php

namespace AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class adminGenerarMedicosPruebaCommand extends ContainerAwareCommand {

    /* @var $em \Doctrine\ORM\EntityManager */
    private $em = null;

    protected function configure() {
        /* php bin/console admin:generar-medicos-prueba */
        $this
                // the name of the command (the part after "bin/console")
                ->setName('admin:generar-medicos-prueba')

                // the short description shown while running "php bin/console list"
                ->setDescription('Crea medicos de manera aleatoria.')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp("Crea medicos de manera aleatoria con un numero definido por el primer parametro")
                ->addArgument('cantidad', InputArgument::REQUIRED, '¿Cuantos médicos?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->em = $this->getContainer()->get('doctrine')->getManager();
        $iCantidad = $input->getArgument('cantidad');

        $output->writeln([
            '',
            '========================',
            'Creador de medicos',
            '========================',
            '',
            'Medicos a crear: ' . $iCantidad,
        ]);

        

    }

}
