<?php

namespace Server\Database\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Server\Database\Repositories\CommonRepository")
 * @ORM\Table(name="albums")
 */
class Albums
{
    /**
     * @ORM\Id
     * @ORM\Column(name="AlbumId", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="Title", type="string", length=160)
     */
    protected $title;

    /**
     * @ORM\ManyToOne(targetEntity="Artists", inversedBy="albums")
     * @ORM\JoinColumn(name="ArtistId", referencedColumnName="ArtistId")
     */
    protected $artists;
}
