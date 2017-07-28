<?php

namespace AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class adminGenerarPacientesCommand extends ContainerAwareCommand {

    protected function configure() {
        /* php bin/console admin:generar-pacientes-prueba */
        $this
                // the name of the command (the part after "bin/console")
                ->setName('admin:generar-pacientes-prueba')

                // the short description shown while running "php bin/console list"
                ->setDescription('Crea pacientes de manera aleatoria.')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp("Crea pacientes de manera aleatoria con un numero definido por el primer parametro")
                ->addArgument('cantidad', InputArgument::REQUIRED, '¿Cuantos pacientes?')
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
            'Creador de pacientes',
            '========================',
            '',
            'Pacientes a crear: ' . $iCantidad,
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

        // Generar pacientes
        $aGeneros = array("m", "f");
        for($i=0; $i <= $iCantidad ; $i++) {
            $sApellido = $aApellidos[rand(0, count($aApellidos))];
            $sNombre = $aNombres[rand(0, count($aNombres))];
            $sPaciente = strtolower($sNombre.'.'.$sApellido);
            
            $oPaciente = new \AppBundle\Entity\Paciente();
            $oPaciente->setPacActivo(TRUE);
            $oPaciente->setPacNombre($sNombre);
            $oPaciente->setPacApellido($sApellido);
            $oPaciente->setPacGenero($aGeneros[array_rand($aGeneros)]);
            $oPaciente->setPacFechaNacimiento(new \DateTime('1988-02-08'));
            $oPaciente->setPacFechaCrea(new \DateTime());
            $oPaciente->setPacFechaMod(new \DateTime());
            $oPaciente->setPacDui(substr(uniqid('',TRUE),0,9));
            $oPaciente->setPacDireccion('Pje. Blah blah');
            $em->persist($oPaciente);
            $em->flush();
            $output->writeln($sPaciente);
        }
        
    }

}
