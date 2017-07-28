<?php

namespace AdminBundle\Command;

use AppBundle\Entity\UsuarioEspecialidad;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class adminGenerarMedicosCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        /* php bin/console admin:generar-medicos-prueba */
        $this
            // the name of the command (the part after "bin/console")
            ->setName('admin:generar-medicos-prueba')
            // the short description shown while running "php bin/console list"
            ->setDescription('Crea medicos de manera aleatoria.')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp("Crea medicos de manera aleatoria con un numero definido por el primer parametro")
            ->addArgument('cantidad', InputArgument::REQUIRED, '¿Cuantos médicos?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getContainer()->get('doctrine')->getManager();

        $iCantidad = $input->getArgument('cantidad');
        $sCsvNombres = $this->getContainer()->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data/nombres.csv';
        $aNombres = $aApellidos = [];

        $output->writeln([
            '',
            '========================',
            'Creador de medicos',
            '========================',
            '',
            'Medicos a crear: ' . $iCantidad,
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

        for ($i = 0; $i <= $iCantidad; $i++) {
            $nombre = $aNombres[rand(0, count($aNombres) - 1)];
            $apellido = $aApellidos[rand(0, count($aApellidos) - 1)];
            $sUsuario = strtolower($nombre . '.' . $apellido);

            $oUsuario = new \AppBundle\Entity\Usuario();
            $oUsuario->setUsuClave(sha1('123'));
            $oUsuario->setUsuNombre($nombre . ' ' . $apellido);
            $oUsuario->setUsuGenero('m');
            $oUsuario->setUsuUsuario($sUsuario);
            $em->persist($oUsuario);


            $em->flush();
            $output->writeln($sUsuario);
        }

        // Enlazar al menos una especialidad a cada usuario
        // RAW query
        $sQuery = '
INSERT INTO usuario_especialidad (id_usuario, id_especialidad, descripcion) (
SELECT uid, espid, "Especialidad autogenerada"
FROM (
SELECT u.usu_id AS uid, (
SELECT e.esp_id
FROM especialidad e
ORDER BY RAND()
LIMIT 1) AS espid
FROM usuario u) AS tempue
LEFT JOIN usuario_especialidad ue ON tempue.espid = ue.id_especialidad
WHERE ue.id_usu_esp IS NULL)
';
        $stmt = $em->getConnection()->prepare($sQuery);
        $stmt->execute();
    }

}
