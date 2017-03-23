<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Revision
 *
 * @ORM\Table(name="revision")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RevisionRepository")
 */
class Revision
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
     * @var int
     *
     * @ORM\Column(name="pool_id", type="integer")
     */
    private $poolId;

    /**
     * @var int
     *
     * @ORM\Column(name="question_id", type="integer")
     */
    private $questionId;

    /**
     * @var int
     *
     * @ORM\Column(name="answer", type="integer")
     */
    private $answer;


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
     * Set poolId
     *
     * @param integer $poolId
     * @return Revision
     */
    public function setPoolId($poolId)
    {
        $this->poolId = $poolId;

        return $this;
    }

    /**
     * Get poolId
     *
     * @return integer 
     */
    public function getPoolId()
    {
        return $this->poolId;
    }

    /**
     * Set questionId
     *
     * @param integer $questionId
     * @return Revision
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;

        return $this;
    }

    /**
     * Get questionId
     *
     * @return integer 
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * Set answer
     *
     * @param integer $answer
     * @return Revision
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return integer 
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
