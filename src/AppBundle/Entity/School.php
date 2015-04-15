<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\ORM\Mapping as ORM;
use GoIntegro\Hateoas\JsonApi\ResourceEntityInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(
 *      name="school",
 *      indexes={
 *          @ORM\Index(name="name", columns={"name"})
 *      }
 * )
 */
class School implements ResourceEntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", nullable=false)
     * @var string
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="school")
     * @var Collection|Selectable|User[]
     */
    private $users;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Collection|Selectable|User[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param Collection|Selectable|User[] $users
     * @return $this
     */
    public function setUsers($users)
    {
        $this->users = $users;
        return $this;
    }
}
