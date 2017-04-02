<?php

namespace AdminBundle\Command;

//use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use AppBundle\Entity\Especialidad;

class adminCreateSpecialtyCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                // the name of the command (the part after "bin/console")
                ->setName('admin:generar-especialidades')

                // the short description shown while running "php bin/console list"
                ->setDescription('Crea los  tipos de especialidades')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp("Crea los diferentes tipos de especialidades de los medicos")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) 
	{
        
		$em = $this->getContainer()->get('doctrine')->getManager();
		//$em = $this->getDoctrine()->getManager();
		
		//======================================================================
		//Municipios
		//======================================================================
		$specialty = array(
								"Alergología",
								"Anestesiología y reanimación",
								"Cardiología",
								"Dermatología",
								"Endocrinología",
								"Gastroenterología",
								"Geriatría",
								"Ginecología",
								"Hematología y hemoterapia",
								"Hidrología médica",
								"Infectología",
								"Medicina aeroespacial",
								"Medicina del deporte",
								"Medicina del trabajo",
								"Medicina de urgencias",
								"Medicina familiar y comunitaria",
								"Medicina física y rehabilitación",
								"Medicina intensiva",
								"Medicina interna",
								"Medicina legal y forense",
								"Medicina paliativa",
								"Medicina preventiva y salud pública",
								"Nefrología",
								"Neonatología",
								"Neumología",
								"Neurología",
								"Nutriología",
								"Obstetricia",
								"Oftalmología",
								"Oncología médica",
								"Oncología radioterápica",
								"Pediatría",
								"Psiquiatría",
								"Rehabilitación",
								"Reumatología",
								"Toxicología",
								"Urología",
								"Cirugía cardiovascular",
								"Cirugía general y del aparato digestivo",
								"Cirugía oral y maxilofacial",
								"Cirugía ortopédica y traumatología",
								"Cirugía pediátrica",
								"Cirugía plástica, estética y reparadora",
								"Cirugía torácica",
								"Neurocirugía",
								"Proctología",
								"Angiología y cirugía vascular",
								"Dermatología médico-quirúrgica y venereología",
								"Estomatología",
								"Ginecología y obstetricia o tocología",
								"Oftalmología",
								"Otorrinolaringología",
								"Urología",
								"Traumatología y Ortopedia",
								"Análisis clínicos",
								"Anatomía patológica",
								"Bacteriología",
								"Bioquímica clínica",
								"Farmacología clínica",
								"Genética médica",
								"Inmunología",
								"Medicina nuclear",
								"Microbiología y parasitología",
								"Neurofisiología clínica",
								"Radiodiagnóstico o radiología",
								"Enfermería",
								"Dietista nutricionista",
								"Logopedia",
								"Fisioterapia",
								"Podología",
								"Odontología",
								"Optometría",
								"Psicología"
							);

		
			$output->writeln([
				'',
				'=========================================================',
				'Lista de especialidades médicas',
				'=========================================================',
				'',
				//'Medicos a crear: ' . $num,
				//'ID:'.$oCountry->getPaiId(),
			]);
			
			$pros = 0;
			$output->writeln('Creando lista... ');
			$output->writeln('---------------------------------------------------------');
			foreach ( $specialty as $value )
			{
				//Create the state
				$oSpecialty = new Especialidad();
				$oSpecialty->setEspEspecialidad( $value );
				$oSpecialty->setEspFechaCrea( new \Datetime() );
				$oSpecialty->setEspActivo(1);
				
				$em->persist($oSpecialty);			
				$flush = $em->flush();
				
				if ($flush == null)
				{
					$pros++;
				}
			}
			$output->writeln('---------------------------------------------------------');
			$output->writeln('Fin');
			$output->writeln([
				'',
				'=========================================================',
				'Total '.count($specialty)." - Ingresados ".$pros,
				'=========================================================',
				'',
				//'Medicos a crear: ' . $num,
				//'ID:'.$oCountry->getPaiId(),
			]);


    }

}
