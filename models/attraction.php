<?php
/**
* An attraction will have an ID
* An attraction will have a author
* An attraction will have pictures
* An attraction will have community guide
* An attraction will have a reviews
* An attraction will have a community about
* An attraction will have videos
* Location
* The whole idea is that people can post pictures and videos of attractive places
* they've been to
* 
* 
*/

use Doctrine\ORM\Mapping as ORM;
require_once "bootstrap.php";
require_once "includes/functions.php";

/**
 * @ORM\Entity
 * @ORM\Table('attractions')
 */
class Attraction {
    /**
     * @ORM\Id
     * @ORM\Column(type="string", unique=true, nullable=false)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="username", referencedColumnName="username")
     */
    private $author;

    /**
     * @ORM\Column(type="json")
     */
    private $mediaFiles;

    /**
     * @ORM\Column(type="string")
     */
    private $city;

     /**
     * @ORM\Column(type="string")
     */
    private $state;

     /**
     * @ORM\Column(type="string")
     */
    private $country;


}
?>


