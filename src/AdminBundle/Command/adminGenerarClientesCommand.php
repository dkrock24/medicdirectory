<?php

namespace AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class adminGenerarClientesCommand extends ContainerAwareCommand {

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

        $aPago = [];
        $aPago['tarjeta'] = '4111-1111-1111-1111';
        $aPago['ccv'] = '123';
        $aPago['exp'] = '12/20';
        $aPago['nombre'] = 'Pepito Perez';
        $sPago = json_encode($aPago);

        $sPago = json_encode($aPago);
        for($i=0; $i <= $iCantidad ; $i++) {
            $sNombre = $aNombres[rand(0, count($aNombres)-1)].' '.$aApellidos[rand(0, count($aApellidos)-1)];
            $sNombreComercial = 'Clinica ' . $aApellidos[rand(0, count($aApellidos)-1)];
            $sNombreFiscal = $aApellidos[rand(0, count($aApellidos)-1)] . ' SA de CV';

            $oCliente = new \AppBundle\Entity\Cliente();

            $oCliente->setCliNombre($sNombre);
            $oCliente->setCliNombreComercial($sNombreComercial);
            $oCliente->setCliNombreFiscal($sNombreFiscal);
            $oCliente->setCliNit(mt_rand(pow(10, 10), pow(10, 10)));
            $oCliente->setCliActivo(TRUE);
            $oCliente->setCliDireccion('Direccion generada');
            $oCliente->setCliFechaCrea(new \DateTime());
            $oCliente->setCliFechaMod(new \DateTime());
            $oCliente->setCliFechaRegistro(new \DateTime());
            $oCliente->setCliTelefono1('79859476');
            $oCliente->setCliTelefono2('70893287');
            $oCliente->setCliMetodoPago($em->getReference(\AppBundle\Entity\MetodoPago::class, 2)); // Tarjeta
            $oCliente->setCliMun($em->getReference(\AppBundle\Entity\Municipio::class, 214)); // San Salvador
            $oCliente->setCliPagoDetalle($sPago);
            $oCliente->setCliIdVendedor(1);
            $em->persist($oCliente);
            $em->flush();
            $output->writeln($sNombre);
        }
        
    }

}
