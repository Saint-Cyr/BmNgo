<?php

namespace TransactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="TransactionBundle\Repository\ProductRepository")
 * @UniqueEntity("barcode", message="this barcode has been already used")
 * @UniqueEntity("name", message="this name has been already used")
 * @ORM\HasLifecycleCallbacks
 */
class Product
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
     * Unmapped property to handle file uploads
     */
    private $file;
    
    /**
     * @var string
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;
    
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, unique=false, nullable=true)
     */
    private $image;
    
    private $flyProfit;
    
    private $flyAmount;
    
    /**
     * @ORM\OneToMany(targetEntity="Stock", mappedBy="product")
     */
    private $stocks;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="projectCode", type="string", length=255, unique=false)
     */
    private $projectCode;

    /**
     * @var string
     *
     * @ORM\Column(name="officeCode", type="string", length=255, unique=true, nullable=true)
     */
    private $officeCode;
    
    /**
     * @var string
     *
     * @ORM\Column(name="linCode", type="string", length=255, unique=false, nullable=true)
     */
    private $linCode;
    
    /**
     * @var string
     *
     * @ORM\Column(name="locked", type="boolean", nullable=true)
     */
    private $locked;
    
    /**
     * @var string
     *
     * @ORM\Column(name="imagePos", type="boolean", nullable=true)
     */
    private $imagePos;
    
    /**
     * @var string
     *
     * @ORM\Column(name="barcode", type="string", length=255, nullable=true, unique=true)
     */
    private $barcode;
    
    /**
     * @var float
     *
     * @ORM\Column(name="unitPrice", type="float", nullable=true)
     */
    private $unitPrice;
    
    /**
     * @ORM\ManyToMany(targetEntity="TransactionBundle\Entity\Category", mappedBy="products")
     * @ORM\JoinColumn(nullable=true)
     */
    private $categories;
    
    /**
     * @var float
     *
     * @ORM\Column(name="WholeSalePrice", type="float", nullable=true)
     */
    private $wholeSalePrice;
    
    public function __toString() {
        if(!$this->name){
            return 'new Product';
        }
        
        return $this->name;
    }
    
    public function getProfit()
    {
        return $this->getUnitPrice() - $this->getWholeSalePrice();
    }
    
    /**
    * Sets file.
    *
    * @param UploadedFile $file
    */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
    * Get file.
    *
    * @return UploadedFile
    */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
    * @ORM\PostPersist()
    * @ORM\PostUpdate()
    */
    public function lifecycleFileUpload()
    {
        $this->upload();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function refreshUpdated()
    {
        $this->setUpdated(new \DateTime());
    }
    
    /**
     * @ORM\PreRemove()
     */
    public function removeUPdate()
    {
        //Check whether the file exists first
        if (file_exists(getcwd().'/upload/product/'.$this->getImage())){
            //Remove it
            @unlink(getcwd().'/upload/product/'.$this->getImage());
            
        }
        
        return;
    }
    
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }
        // move takes the target directory and target filename as params
        $this->getFile()->move(getcwd().'/upload/product', $this->getId().'.'.$this->getFile()->guessExtension());
        // clean up the file property as you won't need it anymore
        $this->setFile(null);
    }
    
    /**
     * Set image
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     * @param string $image
     *
     * @return PrDependentCandidate
     */
    public function setImage($image)
    {
        if($this->getFile() !== null){
            $this->image = $this->getFile()->guessExtension();
        }
        
        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        if((substr($this->image, -4) == 'jpeg')||(substr($this->image, -3) == 'jpg')||(substr($this->image, -3) == 'png')){
            return $this->getId().'.'.$this->image;
        }else{
            return null;
        }
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return PrParty
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function totalStock()
    {
        $total = 0;
        
        foreach ($this->getStocks() as $stock){
            $total = $total + $stock->getValue();
        }
        
        return $total;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set unitPrice
     *
     * @param float $unitPrice
     *
     * @return Product
     */
    public function setUnitPrice($unitPrice = null)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * Get unitPrice
     *
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * Set barcode
     *
     * @param string $barcode
     *
     * @return Product
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;

        return $this;
    }

    /**
     * Get barcode
     *
     * @return string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * Set wholeSalePrice
     *
     * @param float $wholeSalePrice
     *
     * @return Product
     */
    public function setWholeSalePrice($wholeSalePrice = null)
    {
        $this->wholeSalePrice = $wholeSalePrice;

        return $this;
    }

    /**
     * Get wholeSalePrice
     *
     * @return float
     */
    public function getWholeSalePrice()
    {
        return $this->wholeSalePrice;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stocks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add stock
     *
     * @param \TransactionBundle\Entity\Stock $stock
     *
     * @return Product
     */
    public function addStock(\TransactionBundle\Entity\Stock $stock)
    {
        $this->stocks[] = $stock;

        return $this;
    }

    /**
     * Remove stock
     *
     * @param \TransactionBundle\Entity\Stock $stock
     */
    public function removeStock(\TransactionBundle\Entity\Stock $stock)
    {
        $this->stocks->removeElement($stock);
    }

    /**
     * Get stocks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * Set locked
     *
     * @param boolean $locked
     *
     * @return Product
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return boolean
     */
    public function isLocked()
    {
        return $this->locked;
    }

    /**
     * Get locked
     *
     * @return boolean
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set imagePos
     *
     * @param boolean $imagePos
     *
     * @return Product
     */
    public function setImagePos($imagePos)
    {
        $this->imagePos = $imagePos;

        return $this;
    }

    /**
     * Get imagePos
     *
     * @return boolean
     */
    public function getImagePos()
    {
        return $this->imagePos;
    }

    /**
     * Set flyProfit
     *
     * @param string $flyProfit
     *
     * @return Product
     */
    public function setFlyProfit($flyProfit)
    {
        $this->flyProfit = $flyProfit;

        return $this;
    }

    /**
     * Get flyProfit
     *
     * @return string
     */
    public function getFlyProfit()
    {
        return $this->flyProfit;
    }

    /**
     * Set flyAmount
     *
     * @param string $flyAmount
     *
     * @return Product
     */
    public function setFlyAmount($flyAmount)
    {
        $this->flyAmount = $flyAmount;

        return $this;
    }

    /**
     * Get flyAmount
     *
     * @return string
     */
    public function getFlyAmount()
    {
        return $this->flyAmount;
    }

    /**
     * Add category
     *
     * @param \TransactionBundle\Entity\Category $category
     *
     * @return Product
     */
    public function addCategory(\TransactionBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \TransactionBundle\Entity\Category $category
     */
    public function removeCategory(\TransactionBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set projectCode
     *
     * @param string $projectCode
     *
     * @return Product
     */
    public function setProjectCode($projectCode)
    {
        $this->projectCode = $projectCode;

        return $this;
    }

    /**
     * Get projectCode
     *
     * @return string
     */
    public function getProjectCode()
    {
        return $this->projectCode;
    }

    /**
     * Set officeCode
     *
     * @param string $officeCode
     *
     * @return Product
     */
    public function setOfficeCode($officeCode)
    {
        $this->officeCode = $officeCode;

        return $this;
    }

    /**
     * Get officeCode
     *
     * @return string
     */
    public function getOfficeCode()
    {
        return $this->officeCode;
    }

    /**
     * Set linCode
     *
     * @param string $linCode
     *
     * @return Product
     */
    public function setLinCode($linCode)
    {
        $this->linCode = $linCode;

        return $this;
    }

    /**
     * Get linCode
     *
     * @return string
     */
    public function getLinCode()
    {
        return $this->linCode;
    }
}
