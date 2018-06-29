<?php

namespace Server\Database\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Server\Database\Repositories\AlbumRepository")
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
     * @ORM\ManyToOne(targetEntity="Artists")
     * @ORM\JoinColumn(name="ArtistId", referencedColumnName="ArtistId")
     */
    protected $artists;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Albums
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Albums
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArtists()
    {
        return $this->artists;
    }

    /**
     * @param mixed $artists
     * @return Albums
     */
    public function setArtists($artists)
    {
        $this->artists = $artists;
        return $this;
    }

}
