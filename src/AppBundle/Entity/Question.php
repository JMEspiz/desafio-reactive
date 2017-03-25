<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionRepository")
 */
class Question
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
     * @var string
     *
     * @ORM\Column(name="name", type="text")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Pool", inversedBy="questions")
     * @ORM\JoinColumn(name="pool_id",  referencedColumnName="id")
     */
    private $pool;

    /**
     * @ORM\OneToMany(targetEntity="Revision", mappedBy="question")
     */
    private $revisions;

    public function __construct()
    {
      $this->revisions = new ArrayCollection();
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
     * @return Question
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

    public function getPool()
    {
        return $this->pool;
    }

    public function setPool($pool)
    {
        $this->pool = $pool;
        return $this;
    }
}
