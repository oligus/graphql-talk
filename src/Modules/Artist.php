<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Modules;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Artist")
 */
class Artist
{
    /**
     * @ORM\Column(name="ArtistId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public int $id;

    /**
     * @ORM\Column(name="Name", type="string", length=120, nullable=true)
     */
    public ?string $name;
}
