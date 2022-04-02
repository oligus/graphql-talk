<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Modules;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playlisttrack
 *
 * @ORM\Table(name="PlaylistTrack", indexes={@ORM\Index(name="IFK_PlaylistTrackTrackId", columns={"TrackId"})})
 * @ORM\Entity
 */
class Playlisttrack
{
    /**
     * @var int
     *
     * @ORM\Column(name="PlaylistId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    public $playlistid;

    /**
     * @var int
     *
     * @ORM\Column(name="TrackId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    public $trackid;


}
