<?php

namespace Server\Database\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Server\Database\Repositories\CommonRepository")
 * @ORM\Table(name="authors")
 */
class Author
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=100)
     */
    protected $name;

    /**
     * @param string $name
     * @return Author
     */
    public static function create(string $name): Author
    {
        $author = new self();
        $author->setName($name);
        return $author;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

}