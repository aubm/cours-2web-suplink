<?php

namespace AppBundle\Managers;

use AppBundle\Entity\Url;

interface UrlsManagerInterface
{
    /** @return Url[] */
    public function getAllUrlsByCriteria(array $criteria = []);

    /** @return Url */
    public function getOneUrlByCriteria(array $criteria);

    /** @return null */
    public function saveUrl(Url $url);

    /** @return null */
    public function generateUniqueShortenedTagForUrl(Url $url);

    /** @return null */
    public function findAndRemoveOneUrlById($url_id);
}