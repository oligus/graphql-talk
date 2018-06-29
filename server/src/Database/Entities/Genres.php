<?php

namespace Server\Database\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Server\Database\Repositories\GenresRepository")
 * @ORM\Table(name="genres")
 */
class Genres
{
    /**
     * @ORM\Id
     * @ORM\Column(name="GenreId", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="Name", type="string", length=120)
     */
    protected $name;
}
