<?php
namespace App\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\MaxDepth;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

/**
 * @ORM\Entity(repositoryClass="UserRepository")
 * @HasLifecycleCallbacks
 * @ORM\Table(name="keley_user")
 * 
 * @ExclusionPolicy("all")
 */
class User {
	
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue;
	 * @ORM\Column(type="integer")
	 * @Expose
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", unique=true)
	 * @Expose
	 */
	private $email;
	
	/**
	 * @ORM\Column(type="string")
	 * @Expose
	 */
	private $firstName;
	
	/**
	 * @ORM\Column(type="string")
	 * @Expose
	 */
	private $lastName;
	
	/**
	 * @ORM\Column(type="boolean")
	 * @Expose
	 */
	private $isActive;
	
	/**
	 * @ORM\Column(type="datetime")
	 * @Type("DateTime<'d-m-Y'>")
	 * @Expose
	 */
	private $creationDate;
	
	/**
	 * @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
	 * @ORM\JoinTable(name="keley_user_group")
	 * @Type("ArrayCollection<App\Bundle\MainBundle\Entity\Group>")
	 * @MaxDepth(1)
	 * 
	 */
	private $groups;
	
	
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }

    
    public function setId($id) {
    	$this->id = $id;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return User
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Add groups
     *
     * @param \App\Bundle\MainBundle\Entity\Group $groups
     * @return User
     */
    public function addGroup(\App\Bundle\MainBundle\Entity\Group $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \App\Bundle\MainBundle\Entity\Group $groups
     */
    public function removeGroup(\App\Bundle\MainBundle\Entity\Group $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function prePersist() {
    	$this->creationDate = new \DateTime('now');
    }
}
