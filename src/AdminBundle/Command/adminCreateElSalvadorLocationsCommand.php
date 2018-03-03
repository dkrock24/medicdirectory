<?php

namespace AdminBundle\Command;

//use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use AppBundle\Entity\Pais;
use AppBundle\Entity\Departamento;
use AppBundle\Entity\Municipio;

class adminCreateElSalvadorLocationsCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                // the name of the command (the part after "bin/console")
                ->setName('admin:generar-ubicaciones-elsalvador')

                // the short description shown while running "php bin/console list"
                ->setDescription('Crea el mapeo de localidades de el salvador')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp("Crea los deparatamentos y municipios de el salvador")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) 
	{
        
		$em = $this->getContainer()->get('doctrine')->getManager();
		//$em = $this->getDoctrine()->getManager();
		
		//======================================================================
		//Municipios
		//======================================================================
		
		
		$oCountry = new Pais();
		$oCountry->setPaiPais( "United State Of America" );
		$oCountry->setPaiCodigo( "503" ); 
		$oCountry->setPaiAbreviatura( "USA" ); 
		$oCountry->setPaiFechaCrea( new \Datetime() );
		$oCountry->setPaiActivo(1);
		$em->persist($oCountry);			
		$flush = $em->flush();
		if ($flush == null)
		{
			$output->writeln([
				'',
				'=========================================================',
				'Pais El Salvador creado con exito',
				'=========================================================',
				'',
				//'Medicos a crear: ' . $num,
				//'ID:'.$oCountry->getPaiId(),
			]);
			
			$proStates = 0;
			$totalMuni = 0;
			$output->writeln('Creando States... ');
			$output->writeln('---------------------------------------------------------');

			$RAW_QUERY  = "SELECT * FROM states";

                        $statement  = $em->getConnection()->prepare($RAW_QUERY);
                        $statement->execute();    
                        $states    = $statement->fetchAll();

			foreach ($states as $state)
			{
				//$output->writeln($state['state_code']);
				//Create the state
				$oState = new Departamento();
				$oState->setDepPai( $oCountry );
				$oState->setDepDepartamento( $state['state'] );
				$oState->setDepCodigo( $state['state_code'] );
				$oState->setDepFechaCrea( new \Datetime() );
				$oState->setDepActivo(1);
				
				$em->persist($oState);	

						

				$flush = $em->flush();
				
				if ($flush == null)
				{
					$proStates++;
					
					$oState->getDepId();

					$RAW_QUERY  = "SELECT * FROM cities where state_code='".$state['state_code']."'";
                        $statement  = $em->getConnection()->prepare($RAW_QUERY);
                        $statement->execute();    
                        $cities    = $statement->fetchAll();
					//$output->writeln('Departamento id: '.$oState->getDepId());
                    $output->writeln($state['state_code']);
					
					$prosMuni = 0;
					
					foreach ($cities as $cit )
					{
						//Create the municipality
						$oMunicipality = new Municipio();
						$oMunicipality->setMunDep( $oState );
						$oMunicipality->setMunNombre( $cit['city'] );
						$oMunicipality->setMunFechaCrea( new \Datetime() );
						$oMunicipality->setMunActivo(1);
						
						$em->persist($oMunicipality);			
						$flush = $em->flush();
						if ($flush == null)
						{
							$prosMuni++;
						}
					}

					$totalMuni = $totalMuni + $prosMuni;
					
					//$output->writeln('Departamento: '.$state. " | Municipios: ".$prosMuni);
					
				}
			}
			$output->writeln('---------------------------------------------------------');
			$output->writeln('Fin');
			$output->writeln([
				'',
				'=========================================================',
				'Total '.$proStates." departamentos con ".$totalMuni. ' municipios',
				'=========================================================',
				'',
				//'Medicos a crear: ' . $num,
				//'ID:'.$oCountry->getPaiId(),
			]);
		}
		else
		{
			$output->writeln('Error al crear el pais');
		}

    }

}
