<?php
namespace Application\FrontentBundle\Utils;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\EntityManager;
use Liip\ImagineBundle\Controller\ImagineController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author David Velasco <dvelasco@wearemarketing.com>
 */
class MediaProcessor
{

    public function __construct(EntityManager $entityManager, $imagineController, $request)
    {
        $this->em = $entityManager;
        /** @var ImagineController liipImagineController */
        $this->liipImagineController = $imagineController;
        $this->request = $request->getCurrentRequest();
    }

    /**
     * @param $image
     * @param $width
     * @param $height
     */
    public function ProcessImage($image, $width, $height)
    {
        $category = 'boobs';
        $candidateImages = $this->em->getRepository(Media::class)->getAccurateImage($category, $width, $height);

        /** @var Media $selectedImage */
        $selectedImage = $candidateImages[array_rand($candidateImages, 1)];

        return $selectedImage;
    }


    public function ServeImages($all = false, $category = null)
    {
        if (!$all && $category) {
            return $images = $this->em->getRepository(Media::class)->findBy(
                array('context' => $category)
            );
        } else {
            return $images = $this->em->getRepository(Media::class)->findAll();
        }
    }
}
