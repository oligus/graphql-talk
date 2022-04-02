<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api;

use Doctrine\ORM\EntityManager;

class AppContext
{
    private EntityManager $em;

    public function getEm(): EntityManager
    {
        return $this->em;
    }

    public function setEm(EntityManager $em): void
    {
        $this->em = $em;
    }
}
