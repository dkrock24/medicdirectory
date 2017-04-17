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
        $query = $em->createQuery(
                "SELECT cli_usu "
                . "FROM \AppBundle\Entity\ClienteUsuario cli_usu, "
                . "\AppBundle\Entity\Rol r, "
                . "\AppBundle\Entity\Usuario u "
                . "WHERE cli_usu.cliUsuActivo = 1 "
                . "AND r.rolRol = 'MEDICO'"
        );
        
        $result = $query->getResult();
        
        return $result;
        
    }
    
    public function getMedicoById( $med_id ){
        
                /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('cu')
            ->from('\AppBundle\Entity\ClienteUsuario', 'cu')
            ->innerJoin( '\AppBundle\Entity\Usuario u', 'WITH u.usuId = cu.cliUsuUsu' )
            ->innerJoin( '\AppBundle\Entity\Cliente c', 'WITH cu.cliUsuCli = c.cliId' )
            ->where('cu.cliUsuId = :med_id')
            ->andWhere( 'u.usuActivo = 1' )
            ->andWhere( 'cu.cliUsuActivo = 1' )
            ->andWhere( 'c.cliActivo = 1' )
            ;
        
//        $query = $em->createQuery(
//                "SELECT u, cu, c "
//                . "FROM \AppBundle\Entity\Usuario u, "
//                . "INNER JOIN \AppBundle\Entity\ClienteUsuario cu WITH cu.cliUsuUsuId = u.usuId "
//                . "INNER JOIN \AppBundle\Entity\Cliente c WITH cu.cliUsuCliId = c.cliId"
//                . "WHERE u.usuId = :med_id "
//                . "AND u.usuActivo = 1 AND cu.cliUsuActivo = 1 AND c.cliActivo = 1"
//        );
        $qb->setParameter( 'med_id', $med_id );
        
        $result = $qb->getQuery()->getSingleResult();
        
        return $result;
        
    }
    
}
