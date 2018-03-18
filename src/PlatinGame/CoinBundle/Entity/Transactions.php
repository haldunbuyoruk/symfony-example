<?php

/**
*
* @ORM\Table(name="transactions")
* @ORM\Entity()
*/

namespace App\PlatinGame\CoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\PlatinGame\CoinBundle\Repository\TransactionsRepository")
 */
class Transactions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * 
     * @ORM\Column(type="integer",nullable=FALSE)
     */

    private $user_id;

    
    /**
     * 
     * @ORM\Column(type="integer",nullable=TRUE)
     */
    private $coin = 0;

    /**
     * 
     * @ORM\Column(type="string", nullable=FALSE, unique=TRUE)
     */
    private $code;

     /**
     * 
     * @ORM\Column(type="datetime")
     */
    private  $create_date ;

    public function __construct()
    {
        $this->create_date = new \DateTime("now");
    }

     public function __toString()
    {
        return (string) $this->getCode();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getCoin()
    {
        return $this->coin;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getCreateDate()
    {
        return $this->create_date;
    }

    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    public function setCoin($coin)
    {
        $this->coin = $coin;

        return $this;
    }

}
