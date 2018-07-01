<?php

namespace Server\Database\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
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
     * Playlists constructor.
     */
    public function __construct()
    {
        $this->playlists =  new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAlbums()
    {
        return $this->albums;
    }

    /**
     * @param mixed $albums
     */
    public function setAlbums($albums): void
    {
        $this->albums = $albums;
    }

    /**
     * @return mixed
     */
    public function getMediaTypes()
    {
        return $this->mediaTypes;
    }

    /**
     * @param mixed $mediaTypes
     */
    public function setMediaTypes($mediaTypes): void
    {
        $this->mediaTypes = $mediaTypes;
    }

    /**
     * @return mixed
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param mixed $genres
     */
    public function setGenres($genres): void
    {
        $this->genres = $genres;
    }

    /**
     * @return mixed
     */
    public function getComposer()
    {
        return $this->composer;
    }

    /**
     * @param mixed $composer
     */
    public function setComposer($composer): void
    {
        $this->composer = $composer;
    }

    /**
     * @return mixed
     */
    public function getMilliseconds()
    {
        return $this->milliseconds;
    }

    /**
     * @param mixed $milliseconds
     */
    public function setMilliseconds($milliseconds): void
    {
        $this->milliseconds = $milliseconds;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPlaylists()
    {
        return $this->playlists;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}
