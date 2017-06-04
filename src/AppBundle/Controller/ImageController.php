<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ImageController extends Controller
{
    public function indexAction($ancho, $alto, $hash)
    {
        /* @var $ih \Gregwar\ImageBundle\ImageHandler */
        $ih = $this->get('image.handling');

        $path = $this->get('kernel')->getRootDir() . "/../web/img/{$hash}.jpg";

        $response = new Response();
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_INLINE, "{$hash}.jpg");
        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Type', 'image/jpeg');
        $response->setContent(file_get_contents($this->get('kernel')->getRootDir().'/../../'.$ih->open($path)->cropResize($ancho,$alto)->jpeg()));

        return $response;
    }
}
