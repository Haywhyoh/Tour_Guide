<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
class BaseModel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateCreated;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateUpdated;

    public function getId(): int
    {
        return $this->id;
    }

    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    public function getDateUpdated(): \DateTime
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(\DateTime $dateUpdated): void
    {
        $this->dateUpdated = $dateUpdated;
    }
}
?>