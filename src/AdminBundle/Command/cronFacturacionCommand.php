<?php

namespace AdminBundle\Command;

//use Symfony\Component\Console\Command\Command;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Pais;
use AppBundle\Entity\Departamento;
use AppBundle\Entity\Municipio;

class cronFacturacionCommand extends ContainerAwareCommand {

    private $em = null;
    private $dCostoUsuario = null;

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

        $this->em = $this->getContainer()->get('doctrine')->getManager();

        // AppBundle\Services\servicioParametros
        $token = new AnonymousToken('dummy', 'dummy', ['ROLE_CRON']);
        $this->getContainer()->get('security.token_storage')->setToken($token);
        $this->dCostoUsuario = $this->getContainer()->get('parametros')->getParametro('costo_por_usuario', 30);

        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->em;

        /* Podriamos hacerlo en un solo query que insertara el count de usuarios
         * asociados en el historial de pagos usando el precio de referencia como
         * parametro para la multiplicacion pero mas adelante podemos necesitar
         * involucrar logica de negocio como descuentos por cupon, promociones, etc.
         * - Vlad
         */

        /* @var $oClientes \AppBundle\Entity\Cliente */
        $oClientes = $em->getRepository(\AppBundle\Entity\Cliente::class)->findBy(array('cliActivo' => 1));

        /* @var $oCliente \AppBundle\Entity\Cliente */
        foreach ($oClientes as $oCliente) {
            // Busquemos y contemos cuantos usuarios activos tienen
            // Tambien nos interesan los clientes activos sin usuarios para alertar
            // Excluyamos a los asistentes (Rol 3)
            $query = $em->createQuery(
                            'SELECT COUNT(cu)
                FROM AppBundle:ClienteUsuario cu
                JOIN cu.cliUsuUsu u
                WHERE cu.cliUsuCli = :cliUsuCli
                AND u.usuActivo=1
                AND cu.cliUsuRol <> 3
                '
                    )->setParameter('cliUsuCli', $oCliente->getCliId());

            // Cantidad de usuarios que seran cobrados
            $iUsuarios = $query->getSingleScalarResult();

            $dCosto = $this->obtenerCosto($oCliente, $iUsuarios);

            // No guardar facturación de clientes sin usuarios
            if ((float)$dCosto === 0.00) {
                continue;
            }

            $oHistorialPago = new \AppBundle\Entity\HistorialPago();
            $oHistorialPago->setHpaCliente($oCliente);
            $oHistorialPago->setHpaCantidadUsuariosCorte($iUsuarios);
            $oHistorialPago->setHpaEstado(0);
            $oHistorialPago->setHpaComentario('CRON');
            $oHistorialPago->setHpaMontoEsperado($dCosto);
            $oHistorialPago->setHpaMontoPagado(0);
            $oHistorialPago->setHpaUsuVerificado(null);
            $oHistorialPago->setHpaFechaCrea(new \DateTime());
            $oHistorialPago->setHpaFechaMod(new \DateTime());
            $oHistorialPago->setHpaFechaPago(null);
            $oHistorialPago->setHpaMetodoPago($oCliente->getCliMetodoPago());
            $oHistorialPago->setHpaPagoDetalle($oCliente->getCliPagoDetalle());
            $em->persist($oHistorialPago);
            $em->flush();
        }
    }

    private function obtenerCosto(\AppBundle\Entity\Cliente $cliente, $iUsuarios) {
        // En funcion aparte porque despues puede tener logica de descuentos

        return $this->dCostoUsuario * $iUsuarios;
    }

}
