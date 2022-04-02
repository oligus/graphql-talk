<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Modules;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * Playlist
 *
 * @ORM\Table(name="Playlist")
 * @ORM\Entity
 */
class Playlist
{
    /**
     * @ORM\Column(name="PlaylistId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public int $id;

    /**
     * @ORM\Column(name="Name", type="string", length=120, nullable=true)
     */
    public ?string $name;

    /**
     * @ORM\ManyToMany(targetEntity="Track")
     * @ORM\JoinTable(name="PlaylistTrack",
     *      joinColumns={@ORM\JoinColumn(name="PlaylistId", referencedColumnName="PlaylistId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="TrackId", referencedColumnName="TrackId")}
     *      )
     */
    public Collection $tracks;
}
