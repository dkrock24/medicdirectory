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
		$municpios_ahuchapan = array(
								"Ahuachapán","Apaneca","Atiquizaya","Concepción de Ataco",
								"El Refugio","Guaymango","Jujutla","San Francisco Menéndez",
								"San Lorenzo","San Pedro Puxtla","Tacuba","Turín"
							);
		
		$municpios_santa_ana = array(
							"Candelaria de la Frontera",
							"Chalchuapa",
							"Coatepeque",
							"El Congo",
							"El Porvenir",
							"Masahuat",
							"Metapán",
							"San Antonio Pajonal",
							"San Sebastián Salitrillo",
							"Santa Ana",
							"Santa Rosa Guachipilín",
							"Santiago de la Frontera",
							"Texistepeque"
						);
		$municpios_sonsonate = array(
							"Acajutla",
							"Armenia",
							"Caluco",
							"Cuisnahuat",
							"Izalco",
							"Juayúa",
							"Nahuizalco",
							"Nahulingo",
							"Salcoatitán",
							"San Antonio del Monte",
							"San Julián",
							"Santa Catarina Masahuat",
							"Santa Isabel Ishuatán",
							"Santo Domingo Guzmán",
							"Sonsonate",
							"Sonzacate"
						);
		
		$municpios_usulutan = array(
							"Alegría",
							"Berlín",
							"California",
							"Concepción Batres",
							"El Triunfo",
							"Ereguayquín",
							"Estanzuelas",
							"Jiquilisco",
							"Jucuapa",
							"Jucuarán",
							"Mercedes Umaña",
							"Nueva Granada",
							"Ozatlán",
							"Puerto El Triunfo",
							"San Agustín",
							"San Buenaventura",
							"San Dionisio",
							"San Francisco Javier",
							"Santa Elena",
							"Santa María",
							"Santiago de María",
							"Tecapán",
							"Usulután"
						);
		$municpios_san_miguel = array(
							"Carolina",
							"Chapeltique",
							"Chinameca",
							"Chirilagua",
							"Ciudad Barrios",
							"Comacarán",
							"El Tránsito",
							"Lolotique",
							"Moncagua",
							"Nueva Guadalupe",
							"Nuevo Edén de San Juan",
							"Quelepa",
							"San Antonio del Mosco",
							"San Gerardo",
							"San Jorge",
							"San Luis de la Reina",
							"San Miguel",
							"San Rafael Oriente",
							"Sesori",
							"Uluazapa"
						);
		$municpios_morazan = array(
							"Arambala",
							"Cacaopera",
							"Chilanga",
							"Corinto",
							"Delicias de Concepción",
							"El Divisadero",
							"El Rosario",
							"Gualococti",
							"Guatajiagua",
							"Joateca",
							"Jocoaitique",
							"Jocoro",
							"Lolotiquillo",
							"Meanguera",
							"Osicala",
							"Perquín",
							"San Carlos",
							"San Fernando",
							"San Francisco Gotera",
							"San Isidro",
							"San Simón",
							"Sensembra",
							"Sociedad",
							"Torola",
							"Yamabal",
							"Yoloaiquín"
						);
		$municpios_la_union = array(
							"Anamorós",
							"Bolívar",
							"Concepción de Oriente",
							"Conchagua",
							"El Carmen",
							"El Sauce",
							"Intipucá",
							"La Unión",
							"Lislique",
							"Meanguera del Golfo",
							"Nueva Esparta",
							"Pasaquina",
							"Polorós",
							"San Alejo",
							"San José",
							"Santa Rosa de Lima",
							"Yayantique",
							"Yucuaiquín"
						);
		$municpios_la_libertad = array(
							"Antiguo Cuscatlán",
							"Chiltiupán",
							"Ciudad Arce",
							"Colón",
							"Comasagua",
							"Huizúcar",
							"Jayaque",
							"Jicalapa",
							"La Libertad",
							"Santa Tecla",
							"Nuevo Cuscatlán",
							"San Juan Opico",
							"Quezaltepeque",
							"Sacacoyo",
							"San José Villanueva",
							"San Matías",
							"San Pablo Tacachico",
							"Talnique",
							"Tamanique",
							"Teotepeque",
							"Tepecoyo",
							"Zaragoza"
						);
		$municpios_chalatenango = array(
							"Agua Caliente",
							"Arcatao",
							"Azacualpa",
							"Chalatenango",
							"Comalapa",
							"Citalá",
							"Concepción Quezaltepeque",
							"Dulce Nombre de María",
							"El Carrizal",
							"El Paraíso",
							"La Laguna",
							"La Palma",
							"La Reina",
							"Las Vueltas",
							"Nueva Concepción",
							"Nueva Trinidad",
							"Nombre de Jesús",
							"Ojos de Agua",
							"Potonico",
							"San Antonio de la Cruz",
							"San Antonio Los Ranchos",
							"San Fernando",
							"San Francisco Lempa",
							"San Francisco Morazán",
							"San Ignacio",
							"San Isidro Labrador",
							"San José Cancasque",
							"San José Las Flores",
							"San Luis del Carmen",
							"San Miguel de Mercedes",
							"San Rafael",
							"Santa Rita",
							"Tejutla"
						);
		$municpios_cuscatlan = array(
							"Candelaria",
							"Cojutepeque",
							"El Carmen",
							"El Rosario",
							"Monte San Juan",
							"Oratorio de Concepción",
							"San Bartolomé Perulapía",
							"San Cristóbal",
							"San José Guayabal",
							"San Pedro Perulapán",
							"San Rafael Cedros",
							"San Ramón",
							"Santa Cruz Analquito",
							"Santa Cruz Michapa",
							"Suchitoto",
							"Tenancingo"
						);
		$municpios_san_salvador = array(
							"Aguilares",
							"Apopa",
							"Ayutuxtepeque",
							"Cuscatancingo",
							"Ciudad Delgado",
							"El Paisnal",
							"Guazapa",
							"Ilopango",
							"Mejicanos",
							"Nejapa",
							"Panchimalco",
							"Rosario de Mora",
							"San Marcos",
							"San Martín",
							"San Salvador",
							"Santiago Texacuangos",
							"Santo Tomás",
							"Soyapango",
							"Tonacatepeque"
						);
		$municpios_la_paz = array(
							"Cuyultitán",
							"El Rosario",
							"Jerusalén",
							"Mercedes La Ceiba",
							"Olocuilta",
							"Paraíso de Osorio",
							"San Antonio Masahuat",
							"San Emigdio",
							"San Francisco Chinameca",
							"San Juan Nonualco",
							"San Juan Talpa",
							"San Juan Tepezontes",
							"San Luis Talpa",
							"San Luis La Herradura",
							"San Miguel Tepezontes",
							"San Pedro Masahuat",
							"San Pedro Nonualco",
							"San Rafael Obrajuelo",
							"Santa María Ostuma",
							"Santiago Nonualco",
							"Tapalhuaca",
							"Zacatecoluca"
						);
		$municpios_cabanas = array(
							"Cinquera",
							"Dolores",
							"Guacotecti",
							"Ilobasco",
							"Jutiapa",
							"San Isidro",
							"Sensuntepeque",
							"Tejutepeque",
							"Victoria"
						);
		$municpios_san_vicente = array(
							"Apastepeque",
							"Guadalupe",
							"San Cayetano Istepeque",
							"San Esteban Catarina",
							"San Ildefonso",
							"San Lorenzo",
							"San Sebastián",
							"San Vicente",
							"Santa Clara",
							"Santo Domingo",
							"Tecoluca",
							"Tepetitán",
							"Verapaz"
						);
		
 
		//Departamentos 
		$states = array(
				"Ahuachapán"=>$municpios_ahuchapan,
				"Santa Ana"=>$municpios_santa_ana,
				"Sonsonate"=>$municpios_sonsonate,
				"Usulután"=>$municpios_usulutan, 
				"San Miguel"=>$municpios_san_miguel, 
				"Morazán"=>$municpios_morazan,
				"La Unión"=>$municpios_la_union,
				"La Libertad"=>$municpios_la_libertad,
				"Chalatenango"=>$municpios_chalatenango,
				"Cuscatlán"=>$municpios_cuscatlan,
				"San Salvador"=>$municpios_san_salvador,
				"La Paz"=>$municpios_la_paz,
				"Cabañas"=>$municpios_cabanas, 
				"San Vicente"=>$municpios_san_vicente
			);
		
		$oCountry = new Pais();
		$oCountry->setPaiPais( "El Salvador" );
		$oCountry->setPaiCodigo( "503" ); 
		$oCountry->setPaiAbreviatura( "SV" ); 
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
			$output->writeln('Creando localidades... ');
			$output->writeln('---------------------------------------------------------');
			foreach ($states as $state => $municipios)
			{
				
				//Create the state
				$oState = new Departamento();
				$oState->setDepPai( $oCountry );
				$oState->setDepDepartamento( $state );
				$oState->setDepFechaCrea( new \Datetime() );
				$oState->setDepActivo(1);
				
				$em->persist($oState);			
				$flush = $em->flush();
				
				if ($flush == null)
				{
					$proStates++;
					
					$oState->getDepId();
					//$output->writeln('Departamento id: '.$oState->getDepId());
					
					$prosMuni = 0;
					foreach ($municipios as $mun )
					{
						//Create the municipality
						$oMunicipality = new Municipio();
						$oMunicipality->setMunDep( $oState );
						$oMunicipality->setMunNombre( $mun );
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
					
					$output->writeln('Departamento: '.$state. " | Municipios: ".$prosMuni);
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
