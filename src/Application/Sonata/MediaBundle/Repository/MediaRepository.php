<?php
namespace Application\Sonata\MediaBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * @author David Velasco <dvelasco@wearemarketing.com>
 */
class MediaRepository extends EntityRepository
{

    public function getAccurateImage($category, $width, $height)
    {

        $qb = $this->createQueryBuilder('m')
            ->where('m.context = :context')
            ->andWhere('m.width >= :width')
            ->andWhere('m.height >= :height')
            ->setParameter('context', $category)
            ->setParameter('width', $width)
            ->setParameter('height', $height);

        $result = $qb->getQuery()->getResult();

        return $result;
    }
}
