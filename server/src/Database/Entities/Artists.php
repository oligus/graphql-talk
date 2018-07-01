<?php

namespace Server\Database\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artists")
 */
class Artists
{
    /**
     * @ORM\Id
     * @ORM\Column(name="ArtistId", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="Name", type="string", length=120)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Albums", mappedBy="artists")
     */
    protected $albums;
}
