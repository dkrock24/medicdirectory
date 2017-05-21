<?php

namespace Services;

class Busqueda {
    /* @var $em \Doctrine\ORM\EntityManager */

    private $em;
    private $session;
    private $sphinxsearch;

    public function __construct($em, $session, $sphinxsearch) {
        $this->em = $em;
        $this->session = $session;
        $this->sphinxsearch = $sphinxsearch;
    }

    public function buscarClientes($texto, $activos = null, $offset = 0, $limit = 1) {

        $aRet = [];
        $aRet['total'] = 0;
        $aRet['total_encontrado'] = 0;
        $aRet['resultados'] = [];
        $aRet['ids'] = [];

        if (empty($texto)) {
            return $aRet;
        }

        // Buscamos en el indice definido en el config.yml -> SphinxSearch
        // La configuración del indice esta en el archivo sphinx.conf del sistema
        $indexesToSearch = array('Clientes');
        $options = array(
            'result_offset' => $offset,
            'result_limit' => $limit,
        );
        $sphinxSearch = $this->sphinxsearch;
        $sphinxSearch->setMatchMode(SPH_MATCH_EXTENDED);

        // Si nos pasaron un valor de estado activo entonces lo aplicamos como filtro
        // si viene null omitimos el filtro para buscar todos
        if (null !== $activos) {
            $sphinxSearch->setFilter('cli_activo', array($activos), false);
        }
        $oResultado = $sphinxSearch->search($texto, $indexesToSearch, $options);
        $aRet['total'] = $oResultado['total'];
        $aRet['total_encontrado'] = $oResultado['total_found'];


        // Si tuvimos resultados entonces devolver los IDs ( cliente -> cli_id )
        if ($aRet['total'] > 0) {
            foreach ($oResultado['matches'] as $id => $cliente) {
                $aRet['ids'][] = $id;
            }
        }

        return $aRet;
    }

    public function buscarUsuarios($texto, $activos = null, $offset = 0, $limit = 1) {

        $aRet = [];
        $aRet['total'] = 0;
        $aRet['total_encontrado'] = 0;
        $aRet['resultados'] = [];
        $aRet['ids'] = [];

        if (empty($texto)) {
            return $aRet;
        }

        // Buscamos en el indice definido en el config.yml -> SphinxSearch
        // La configuración del indice esta en el archivo sphinx.conf del sistema
        $indexesToSearch = array('Usuarios');
        $options = array(
            'result_offset' => $offset,
            'result_limit' => $limit,
        );
        $sphinxSearch = $this->sphinxsearch;
        $sphinxSearch->setMatchMode(SPH_MATCH_EXTENDED);

        // Si nos pasaron un valor de estado activo entonces lo aplicamos como filtro
        // si viene null omitimos el filtro para buscar todos
        if (null !== $activos) {
            $sphinxSearch->setFilter('usu_activo', array($activos), false);
        }
        $oResultado = $sphinxSearch->search($texto, $indexesToSearch, $options);
        $aRet['total'] = $oResultado['total'];
        $aRet['total_encontrado'] = $oResultado['total_found'];


        // Si tuvimos resultados entonces devolver los IDs ( cliente -> cli_id )
        if ($aRet['total'] > 0) {
            foreach ($oResultado['matches'] as $id => $usuario) {
                $aRet['ids'][] = $id;
            }
        }

        return $aRet;
    }

}
