<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GoIntegro\Hateoas\JsonApi\ResourceEntityInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(
 *      name="user",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="unique_user", columns={"username"})
 *      }
 * )
 */
class User implements UserInterface, ResourceEntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="password", type="string", nullable=false)
     * @var string
     */
    private $password;

    /**
     * @ORM\Column(name="roles", type="array", nullable=false)
     * @var array
     */
    private $roles = ['ROLE_USER'];

    /**
     * @ORM\Column(name="salt", type="string", nullable=true)
     * @var string|null
     */
    private $salt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\School", inversedBy="users")
     * @ORM\JoinColumn(name="school", referencedColumnName="id", nullable=false)
     * @var School
     */
    private $school;

    /**
     * @ORM\Column(name="username", type="string", nullable=false)
     * @var string
     */
    private $username;

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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string|null $salt
     * @return $this
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    /**
     * @return School
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @param School $school
     * @return $this
     */
    public function setSchool(School $school)
    {
        $this->school = $school;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function eraseCredentials()
    {
        return null;
    }
}
