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
                inner join rol r on cu.cli_usu_rol_id = r.rol_id and r.rol_activo = 1
                inner join usuario u on cu.cli_usu_usu_id = u.usu_id
                left join cliente c on c.cli_id = cu.cli_usu_cli_id
                where cu.cli_usu_activo = 1
                and r.rol_rol = 'MEDICO'";
        
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
                    ui.usi_fb,
                    ui.usi_twitter,
                    ui.usi_correo
                from 
                cliente_usuario cu
                left join usuario u on u.usu_id = cu.cli_usu_usu_id and u.usu_activo = 1
                left join cliente c on cu.cli_usu_cli_id = c.cli_id and c.cli_activo = 1
                left join usuario_informacion ui on ui.usi_id = u.usu_informacion
                where cu.cli_usu_usu_id = :med_id and cu.cli_usu_activo = 1";
        
        $statement = $em->getConnection()->prepare($query);
        $statement->bindValue('med_id', $med_id);
        
        $statement->execute();
        
        $result = $statement->fetchAll();
        
        return $result[0];
        
    }
    
}
