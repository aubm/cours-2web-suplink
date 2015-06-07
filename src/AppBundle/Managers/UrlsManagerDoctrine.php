<?php

namespace AppBundle\Managers;

use AppBundle\Entity\Url;
use Doctrine\ORM\EntityManagerInterface;

class UrlsManagerDoctrine implements UrlsManagerInterface
{
    private $entity_manager;

    public function __construct(EntityManagerInterface $entity_manager)
    {
        $this->entity_manager = $entity_manager;
    }

    public function getAllUrlsByCriteria(array $criteria = [])
    {
        $urls_repository = $this->entity_manager->getRepository('AppBundle:Url');
        return $urls_repository->findBy($criteria);
    }

    public function getOneUrlByCriteria(array $criteria)
    {
        $urls_repository = $this->entity_manager->getRepository('AppBundle:Url');
        return $urls_repository->findOneBy($criteria);
    }

    public function saveUrl(Url $url)
    {
        $this->entity_manager->persist($url);
        $this->entity_manager->flush();
    }

    public function findAndRemoveOneUrlById($url_id)
    {
        $url = $this->getOneUrlByCriteria([
            'id' => $url_id
        ]);

        if ($url !== null) {
            $this->entity_manager->remove($url);
            $this->entity_manager->flush();
        }
    }

    public function generateUniqueShortenedTagForUrl(Url $url)
    {
        do {
            $url->setShortenedUrl($this->generateRandomString());
            $entry = $this->getOneUrlByCriteria([
                'shortened_url' => $url->getShortenedUrl()
            ]);
        } while($entry);
    }

    private function generateRandomString()
    {
        return uniqid();
    }
}