<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Modules;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Album", indexes={@ORM\Index(name="IFK_AlbumArtistId", columns={"ArtistId"})})
 * @ORM\Entity
 */
class Album
{
    /**
     * @ORM\Column(name="AlbumId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public int $id;

    /**
     * @ORM\Column(name="Title", type="string", length=160, nullable=false)
     */
    public string $title;

    /**
     * @ORM\ManyToOne(targetEntity="Artist", fetch="EAGER")
     * @ORM\JoinColumn(name="ArtistId", referencedColumnName="ArtistId")
     */
    public Artist $artist;
}