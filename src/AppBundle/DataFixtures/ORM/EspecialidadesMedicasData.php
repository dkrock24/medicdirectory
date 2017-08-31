<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Rol;
use AppBundle\Entity\Especialidad;

class EspecialidadesMedicasData implements FixtureInterface {

    public function load(ObjectManager $manager) {
        /* php app/console doctrine:fixtures:load */

        /* Tipos de especialidades */
        /* Agregar siempre al final para preservar el codigos */
        $aEspecialidadesMedicas = ["Alergología",
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
            "Psicología",
            "Pediatra Gastroenterólogo",
        ];

        foreach ($aEspecialidadesMedicas as $iIndice => $sEspecialidad) {
            $oEspecialidad = new Especialidad();
            $oEspecialidad->setEspActivo(TRUE);
            $oEspecialidad->setEspCodigo($iIndice);
            $oEspecialidad->setEspDescripcion('');
            $oEspecialidad->setEspEspecialidad($sEspecialidad);
            $oEspecialidad->setEspFechaCrea(new \DateTime());
            $oEspecialidad->setEspFechaMod(new \DateTime());
            $manager->persist($oEspecialidad);
            $manager->flush();
        }
    }

}
