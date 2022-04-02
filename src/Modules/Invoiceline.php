<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Modules;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoiceline
 *
 * @ORM\Table(name="InvoiceLine", indexes={
 *     @ORM\Index(name="IFK_InvoiceLineTrackId", columns={"TrackId"}),
 *     @ORM\Index(name="IFK_InvoiceLineInvoiceId", columns={"InvoiceId"})
 * })
 * @ORM\Entity
 */
class InvoiceLine
{
    /**
     * @ORM\Column(name="InvoiceLineId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public int $id;

    /**
     * @ORM\ManyToOne(targetEntity="Invoice")
     * @ORM\JoinColumn(name="InvoiceId", referencedColumnName="InvoiceId")
     */
    public Invoice $invoice;

    /**
     * @ORM\ManyToOne(targetEntity="Track")
     * @ORM\JoinColumn(name="TrackId", referencedColumnName="TrackId")
     */
    public Track $track;

    /**
     * @ORM\Column(name="UnitPrice", type="decimal", precision=10, scale=2, nullable=false)
     */
    public string $unitPrice;

    /**
     * @ORM\Column(name="Quantity", type="integer", nullable=false)
     */
    public int $quantity;
}
