<?php

namespace Server\Database\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Server\Database\Repositories\PlaylistsRepository")
 * @ORM\Table(name="playlists")
 */
class Playlists
{
    /**
     * @ORM\Id
     * @ORM\Column(name="PlaylistId", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="Name", type="string", length=120)
     */
    protected $name;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Tracks")
     * @ORM\JoinTable(name="playlist_track",
     *      joinColumns={@ORM\JoinColumn(name="PlaylistId", referencedColumnName="PlaylistId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="TrackId", referencedColumnName="TrackId")}
     *      )
     */
    protected $tracks;

    /**
     * Playlists constructor.
     */
    public function __construct()
    {
        $this->tracks =  new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    /**
     * @param \Server\Database\Entities\Tracks $track
     */
    public function addTracks(Tracks $track)
    {
        $this->getTracks()->add($track);
    }
}
