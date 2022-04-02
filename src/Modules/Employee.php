<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Modules;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="Employee", indexes={@ORM\Index(name="IFK_EmployeeReportsTo", columns={"ReportsTo"})})
 * @ORM\Entity
 */
class Employee
{
    /**
     * @ORM\Column(name="EmployeeId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public int $id;

    /**
     * @ORM\Column(name="LastName", type="string", length=20, nullable=false)
     */
    public string $lastName;

    /**
     * @ORM\Column(name="FirstName", type="string", length=20, nullable=false)
     */
    public string $firstName;

    /**
     * @ORM\Column(name="Title", type="string", length=30, nullable=true)
     */
    public ?string $title;

    /**
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumn(name="ReportsTo", referencedColumnName="EmployeeId")
     */
    public ?Employee $reportsTo;

    /**
     * @ORM\Column(name="BirthDate", type="datetime", nullable=true)
     */
    public ?DateTime $birthDate;

    /**
     * @ORM\Column(name="HireDate", type="datetime", nullable=true)
     */
    public ?DateTime $hireDate;

    /**
     * @ORM\Column(name="Address", type="string", length=70, nullable=true)
     */
    public ?string $address;

    /**
     * @ORM\Column(name="City", type="string", length=40, nullable=true)
     */
    public ?string $city;

    /**
     * @ORM\Column(name="State", type="string", length=40, nullable=true)
     */
    public ?string $state;

    /**
     * @ORM\Column(name="Country", type="string", length=40, nullable=true)
     */
    public ?string $country;

    /**
     * @ORM\Column(name="PostalCode", type="string", length=10, nullable=true)
     */
    public ?string $postalCode;

    /**
     * @ORM\Column(name="Phone", type="string", length=24, nullable=true)
     */
    public ?string $phone;

    /**
     * @ORM\Column(name="Fax", type="string", length=24, nullable=true)
     */
    public ?string $fax;

    /**
     * @ORM\Column(name="Email", type="string", length=60, nullable=true)
     */
    public ?string $email;
}
