<?php

namespace AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class adminGenerarClientesPruebaCommand extends ContainerAwareCommand {

    protected function configure() {
        /* php bin/console admin:generar-clientes-prueba */
        $this
                // the name of the command (the part after "bin/console")
                ->setName('admin:generar-clientes-prueba')

                // the short description shown while running "php bin/console list"
                ->setDescription('Crea clientes de manera aleatoria.')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp("Crea clientes de manera aleatoria con un numero definido por el primer parametro")
                ->addArgument('cantidad', InputArgument::REQUIRED, '¿Cuantos clientes?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getContainer()->get('doctrine')->getManager();

        $iCantidad = $input->getArgument('cantidad');
        $sCsvNombres = $this->getContainer()->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data/nombres.csv';
        $aNombres = $aApellidos = [];

        $output->writeln([
            '',
            '========================',
            'Creador de clientes',
            '========================',
            '',
            'Clientes a crear: ' . $iCantidad,
            'Generado a partir de: ' . $sCsvNombres,
        ]);

        if (($hCsvNombres = fopen($sCsvNombres, "r")) !== FALSE) {
            while (($asColumnas = fgetcsv($hCsvNombres, 1000, ",")) !== FALSE) {
                //print_r($asColumnas);
                $aNombres[] = $asColumnas[2];
                $aApellidos[] = $asColumnas[3];
            }
            fclose($hCsvNombres);
        }

        // Generar usuarios

        for($i=0; $i <= $iCantidad ; $i++) {
            $sNombre = $aNombres[rand(0, count($aNombres))].' '.$aApellidos[rand(0, count($aApellidos))];
            $oCliente = new \AppBundle\Entity\Cliente();
            $oCliente->setCliActivo(TRUE);
            $em->persist($oCliente);
            $em->flush();
            $output->writeln($sUsuario);
        }
        
    }

}
