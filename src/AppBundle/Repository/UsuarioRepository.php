<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of UsuarioRepository
 *
 * @author slacker
 */
class UsuarioRepository extends EntityRepository {


    public function getUsuariosMedicos(){
        
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getEntityManager();
        $query = "select
                    cu.cli_usu_id,
                    cu.cli_usu_usu_id,
                    u.usu_titulo,
                    u.usu_nombre,
                    c.cli_nombre
            from cliente_usuario cu
            inner join usuario u on cu.cli_usu_usu_id = u.usu_id and u.usu_activo = 1
            inner join usuarios_rol ur on u.usu_id = ur.urol_usu_id 
            inner join rol r on ur.urol_rol_id = r.rol_id and r.rol_activo = 1
            left join cliente c on c.cli_id = cu.cli_usu_cli_id and c.cli_activo = 1
            where cu.cli_usu_activo = 1
            and r.rol_rol = 'MEDICO'";
        
        $statement = $em->getConnection()->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll();
        
        return $result;
        
    }
    
    public function getHospitales()
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getEntityManager();
        $query = "select a.*, b.esp_especialidad from (
                select
                    cu.cli_usu_cli_id,
                    cu.cli_usu_id,
                    cu.cli_usu_usu_id,
                    u.usu_nombre,
                    c.cli_nombre,
                    ui.usi_info_perfil
            from cliente_usuario cu
            inner join usuario u on cu.cli_usu_usu_id = u.usu_id and u.usu_activo = 1
            inner join usuarios_rol ur on u.usu_id = ur.urol_usu_id 
            inner join rol r on ur.urol_rol_id = r.rol_id and r.rol_activo = 1
            left join cliente c on c.cli_id = cu.cli_usu_cli_id and c.cli_activo = 1
            left join usuario_informacion ui on u.usu_informacion = ui.usi_id
            where cu.cli_usu_activo = 1
            and r.rol_rol = 'HOSPITAL'
            ) a 
            left join (
                    select ce2.cliId, group_concat(e.esp_especialidad separator ', ') as esp_especialidad 
                from cliente_especialidad ce2
                left join especialidad e on ce2.espId = e.esp_id
                group by ce2.cliId
            ) b on a.cli_usu_cli_id = b.cliId";
        
        $statement = $em->getConnection()->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll();
        
        return $result;
    }
    
    public function getMedicoById( $med_id ){
        
                /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getEntityManager();
        $query = "select 
                    cu.cli_usu_usu_id,
                    u.usu_nombre,
                    u.usu_titulo,
                    c.cli_nombre,
                    ui.usi_dias_trabajo,
                    ui.usi_info_perfil,
                    if(locate('http://',ui.usi_fb) = 0, concat('http://', ui.usi_fb), ui.usi_fb) as usi_fb,
                    if(locate('http://',ui.usi_twitter) = 0, concat('http://', ui.usi_twitter), ui.usi_twitter) as usi_twitter,
                    concat('mailto:',ui.usi_correo) as usi_correo,
                    ui.usi_educacion,
                    e.esp_especialidad
                from 
                cliente_usuario cu
                left join usuario u on u.usu_id = cu.cli_usu_usu_id and u.usu_activo = 1
                left join cliente c on cu.cli_usu_cli_id = c.cli_id and c.cli_activo = 1
                left join usuario_informacion ui on ui.usi_id = u.usu_informacion
                left join usuarios_especialidad ue on u.usu_id = ue.uesp_usu_id
                left join especialidad e on ue.uesp_esp_id = e.esp_id
                where cu.cli_usu_usu_id = :med_id and cu.cli_usu_activo = 1";
        
        $statement = $em->getConnection()->prepare($query);
        $statement->bindValue('med_id', $med_id);
        
        $statement->execute();
        
        $result = $statement->fetchAll();
        
        return $result[0];
        
    }
    
}
