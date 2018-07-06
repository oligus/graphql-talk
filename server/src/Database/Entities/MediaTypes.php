<?php

namespace Server\Database\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Server\Database\Repositories\CommonRepository")
 * @ORM\Table(name="media_types")
 */
class MediaTypes
{
    /**
     * @ORM\Id
     * @ORM\Column(name="MediaTypeId", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="Name", type="string", length=120)
     */
    protected $name;
}