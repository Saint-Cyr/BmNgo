<?php

namespace TransactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sale
 *
 * @ORM\Table(name="sale")
 * @ORM\Entity(repositoryClass="TransactionBundle\Repository\SaleRepository")
 */
class Sale
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var Integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;
    
    /**
     * @var float
     *
     * @ORM\Column(name="profit", type="float", nullable=true)
     */
    private $profit;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function __toString() {
        return $this->getProduct()->getName();
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="TransactionBundle\Entity\STransaction", inversedBy="sales", cascade={"persist"})
     */
    private $stransaction;
    
    /**
     * @ORM\ManyToOne(targetEntity="TransactionBundle\Entity\Product", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Sale
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set stransaction
     *
     * @param \TransactionBundle\Entity\STransaction $stransaction
     *
     * @return Sale
     */
    public function setStransaction(\TransactionBundle\Entity\STransaction $stransaction = null)
    {
        $this->stransaction = $stransaction;

        return $this;
    }

    /**
     * Get stransaction
     *
     * @return \TransactionBundle\Entity\STransaction
     */
    public function getStransaction()
    {
        return $this->stransaction;
    }

    /**
     * Set profit
     *
     * @param float $profit
     *
     * @return Sale
     */
    public function setProfit()
    {
        //calculate the profit based on the unit & whole sale price of the product
        $profit = $this->getProduct()->getUnitPrice() - $this->getProduct()->getWholeSalePrice();
        $this->profit = $profit;
        
        return $this;
    }

    /**
     * Get profit
     *
     * @return float
     */
    public function getProfit()
    {
        return $this->profit;
    }

    /**
     * Set product
     *
     * @param \TransactionBundle\Entity\Product $product
     *
     * @return Sale
     */
    public function setProduct(\TransactionBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \TransactionBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Sale
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
