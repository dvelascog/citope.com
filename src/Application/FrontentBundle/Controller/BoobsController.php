<?php

namespace Application\FrontentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Application\Sonata\MediaBundle\Entity\Media;

class BoobsController extends Controller
{
    /**
     * @Route("/")
     */
    public function AllBoobsAction()
    {
        $section = 'boobs';
        $images = $this->getDoctrine()->getRepository(Media::class)->findBy(array('context' => $section));

        return $this->render(':boobs:all_boobs.html.twig', array('section' => $section, 'images' => $images));
    }
}
