<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserCoinsRepository")
 */
class UserCoins
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 
     * @ORM\Column(type="integer")
     */
    private $coin;

     /**
     * 
     * @ORM\Column(type="integer")
     */
    private $user_id;


    public function getCoin()
    {
        return $this->coin;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setCoin($coin)
    {
        $this->coin = $coin;
        return $this;
    }

    public function setUserId($userId)
    {
        $this->user_id = $userId;
        return $this;
    }
}
