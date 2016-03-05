<?php

namespace Application\FrontentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Application\Sonata\MediaBundle\Entity\Media;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function homeAction()
    {
        $images = $this->getMediaProcessor()->ServeImages(true);

        return $this->render(':default:home.html.twig', array('images' => $images));
    }

    /**
     * @param $category
     * @Route("/{category}")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryAction($category)
    {
        $images = $this->getMediaProcessor()->ServeImages(false, $category);

        return $this->render(':default:home.html.twig', array('images' => $images));
    }

    /**
     * @param $category
     * @Route("/{category}/{width}/{height}")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($category, $width, $height)
    {
        $image = $this->getMediaProcessor()->ProcessImage($category,$width,$height);

        return $this->render(':default:show.html.twig', array('image' => $image, 'width' => $width, 'height' => $height));

    }

    private function getMediaProcessor()
    {
        return $this->container->get('fodaveg_citope.media_processor');
    }
}
