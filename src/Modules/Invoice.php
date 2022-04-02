<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Modules;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="Invoice", indexes={
 *     @ORM\Index(name="IFK_InvoiceCustomerId", columns={"CustomerId"})
 * })
 * @ORM\Entity
 */
class Invoice
{
    /**
     * @ORM\Column(name="InvoiceId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public int $id;

    /**
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumn(name="CustomerId", referencedColumnName="CustomerId")
     */
    public Customer $customer;

    /**
     * @ORM\Column(name="InvoiceDate", type="datetime", nullable=false)
     */
    public DateTime $invoiceDate;

    /**
     * @ORM\Column(name="BillingAddress", type="string", length=70, nullable=true)
     */
    public ?string $billingAddress;

    /**
     * @ORM\Column(name="BillingCity", type="string", length=40, nullable=true)
     */
    public ?string $billingCity;

    /**
     * @ORM\Column(name="BillingState", type="string", length=40, nullable=true)
     */
    public ?string $billingState;

    /**
     * @ORM\Column(name="BillingCountry", type="string", length=40, nullable=true)
     */
    public ?string $billingCountry;

    /**
     * @ORM\Column(name="BillingPostalCode", type="string", length=10, nullable=true)
     */
    public ?string $billingPostalCode;

    /**
     * @ORM\Column(name="Total", type="decimal", precision=10, scale=2, nullable=false)
     */
    public string $total;

    /**
     * @ORM\OneToMany(targetEntity="InvoiceLine", mappedBy="invoice")
     */
    protected Collection $invoiceLines;
}
