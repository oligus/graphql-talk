<?php

namespace Server\Database\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Server\Database\Repositories\PlaylistTrackRepository")
 * @ORM\Table(name="playlist_track")
 */
class PlaylistTrack
{
    /**
     * @ORM\Id
     * @ORM\Column(name="PlaylistId", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $playlist;

    /**
     * @ORM\ManyToMany(targetEntity="Tracks")
     * @ORM\JoinTable(name="tracks",
     *      joinColumns={@ORM\JoinColumn(name="TrackId", referencedColumnName="tracks")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tracks", referencedColumnName="moo")}
     *      )
     */
    protected $tracks;

    public function __construct()
    {
        $this->tracks =  new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTracks()
    {
        return $this->tracks;
    }
}