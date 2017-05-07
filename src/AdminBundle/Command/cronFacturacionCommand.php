<?php

namespace AdminBundle\Command;

//use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Pais;
use AppBundle\Entity\Departamento;
use AppBundle\Entity\Municipio;

class cronFacturacionCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                // the name of the command (the part after "bin/console")
                ->setName('admin:cron-facturacion')

                // the short description shown while running "php bin/console list"
                ->setDescription('realiza el corte mensual')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp("realiza el corte mensual")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getContainer()->get('doctrine')->getManager();
        
        $em->getRepository();
    }

}
