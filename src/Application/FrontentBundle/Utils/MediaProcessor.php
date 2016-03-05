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
        $candidateImages = $this->em->getRepository(Media::class)->getAccurateImage($category,$width,$height);



        /** @var Media $selectedImage */
        $selectedImage = $candidateImages[array_rand($candidateImages, 1)];
$baseUrl = $this->request->getSchemeAndHttpHost();
//        die;
//dump($selectedImage);
//        die;
        $imageUrl1 = $this->request->getUriForPath('/uploads/media/'.$selectedImage->getContext().'/0001/01/'.$selectedImage->getProviderReference());

$imageUrl =    str_replace($baseUrl, '', $imageUrl1 );

//        die($this->request->getCurrentRequest()->getRelativeUriForPath('/uploads/media/'.$selectedImage->getContext().'/0001/01/'.$selectedImage->getProviderReference(), false));
                $imagemanagerResponse = $this->liipImagineController
            ->filterAction(
                $this->request,         // http request
                $imageUrl,      // original image you want to apply a filter to
                'q75'              // filter defined in config.yml
            );




        return $selectedImage;
    }


    public function ServeImages($all = false, $category = null)
    {

        if(!$all && $category)
        {
            return $images = $this->em->getRepository(Media::class)->findBy(
                array('context' => $category)
            );

        }
        else
        {
            return $images = $this->em->getRepository(Media::class)->findAll();
        }
    }

}
