<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Modules;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Track", indexes={
 *     @ORM\Index(name="IFK_TrackMediaTypeId", columns={"MediaTypeId"}),
 *     @ORM\Index(name="IFK_TrackGenreId", columns={"GenreId"}),
 *     @ORM\Index(name="IFK_TrackAlbumId", columns={"AlbumId"})
 * })
 * @ORM\Entity
 */
class Track
{
    /**
     * @ORM\Column(name="TrackId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public int $id;

    /**
     * @ORM\Column(name="Name", type="string", length=200, nullable=false)
     */
    public string $name;

    /**
     * @ORM\OneToOne(targetEntity="Album")
     * @ORM\JoinColumn(name="AlbumId", referencedColumnName="AlbumId")
     */
    public Album $album;

    /**
     * @ORM\OneToOne(targetEntity="MediaType")
     * @ORM\JoinColumn(name="MediaTypeId", referencedColumnName="MediaTypeId")
     */
    public MediaType $mediaType;

    /**
     * @ORM\OneToOne(targetEntity="Genre")
     * @ORM\JoinColumn(name="GenreId", referencedColumnName="GenreId")
     */
    public Genre $genre;

    /**
     * @ORM\Column(name="Composer", type="string", length=220, nullable=true)
     */
    public ?string $composer;

    /**
     * @ORM\Column(name="Milliseconds", type="integer", nullable=false)
     */
    public int $milliseconds;

    /**
     * @ORM\Column(name="Bytes", type="integer", nullable=true)
     */
    public ?int $bytes;

    /**
     * @ORM\Column(name="UnitPrice", type="decimal", precision=10, scale=2, nullable=false)
     */
    public string $unitPrice;
}
