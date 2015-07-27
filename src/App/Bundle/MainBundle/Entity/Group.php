<?php
namespace App\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="GroupRepository")
 * @ORM\Table(name="keley_group")
 * @ExclusionPolicy("all")
 */
class Group {
	
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
	private $name;
	
	/**
	 * @ORM\ManyToMany(targetEntity="User", mappedBy="groups")
	 * @Type("ArrayCollection<App\Bundle\MainBundle\Entity\User>")
	 * @MaxDepth(1)
	 * 
	 */
	private $users;
	
	function _construct($name) {
		$this->name = $name;
		$this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Group
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
     * Add users
     *
     * @param \App\Bundle\MainBundle\Entity\Group $users
     * @return Group
     */
    public function addUser(\App\Bundle\MainBundle\Entity\Group $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \App\Bundle\MainBundle\Entity\Group $users
     */
    public function removeUser(\App\Bundle\MainBundle\Entity\Group $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
