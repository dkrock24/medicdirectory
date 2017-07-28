<?php

namespace AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class adminEnlazarMedicosConClienteCommand extends ContainerAwareCommand {

    protected function configure() {
        /* php bin/console admin:generar-pacientes-prueba */
        $this
                // the name of the command (the part after "bin/console")
                ->setName('admin:enlazar-usuarios-con-cliente')

                // the short description shown while running "php bin/console list"
                ->setDescription('Enlaza N usuarios con un cliente.')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp("Enlaza N usuarios con un cliente")
                ->addArgument('cliente', InputArgument::REQUIRED, '¿ID de cliente?')
                ->addArgument('rol', InputArgument::REQUIRED, '¿ID de rol?')
                ->addArgument('cantidad', InputArgument::REQUIRED, '¿Cuantos?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getContainer()->get('doctrine')->getManager();

        $output->writeln([
            '',
            '========================',
            'Enlazador de usuarios a cliente',
            '========================',
            '',
            'Usuarios a enlazar: ' . $input->getArgument('cantidad'),
        ]);

        // Enlazar N usuarios a un cliente
        // RAW query
        $sQuery = 'INSERT INTO cliente_usuario (`cli_usu_usu_id`, `cli_usu_cli_id`, `cli_usu_rol_id`, `cli_usu_fecha_crea`, `cli_usu_fecha_mod`, `cli_usu_activo`) SELECT u.usu_id, ?, ?, NOW(), NOW(), 1 FROM usuario u ORDER BY RAND() LIMIT '.$input->getArgument('cantidad');

        $stmt = $em->getConnection()->prepare($sQuery);
        $stmt->bindValue(1, $input->getArgument('cliente'));
        $stmt->bindValue(2, $input->getArgument('rol'));

        $stmt->execute();
    }

}
