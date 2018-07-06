<?php

namespace Server\Database\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Server\Database\Repositories\CommonRepository")
 * @ORM\Table(name="tracks")
 */
class Tracks
{
    /**
     * @ORM\Id
     * @ORM\Column(name="TrackId", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="Name", type="string", length=200)
     */
    protected $name;

    /**
     * @ORM\Column(name="Composer", type="string", length=220)
     */
    protected $composer;

    /**
     * @ORM\Column(name="Milliseconds", type="integer")
     */
    protected $milliseconds;

    /**
     * @ORM\Column(name="UnitPrice", type="decimal", precision=10, scale=2)
     */
    protected $price;

    /**
     * @ORM\ManyToOne(targetEntity="Albums", fetch="EAGER")
     * @ORM\JoinColumn(name="AlbumId", referencedColumnName="AlbumId")
     */
    protected $album;

    /**
     * @ORM\ManyToOne(targetEntity="Genres", fetch="EAGER")
     * @ORM\JoinColumn(name="GenreId", referencedColumnName="GenreId")
     */
    protected $genre;

    /**
     * @ORM\ManyToOne(targetEntity="MediaTypes", fetch="EAGER")
     * @ORM\JoinColumn(name="MediaTypeId", referencedColumnName="MediaTypeId")
     */
    protected $mediaType;

    /**
     * Playlists constructor.
     */
    public function __construct()
    {
        $this->playlists =  new ArrayCollection();
    }
}
