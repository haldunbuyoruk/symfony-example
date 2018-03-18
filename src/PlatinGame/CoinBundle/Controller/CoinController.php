<?php

namespace App\PlatinGame\CoinBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use \Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use App\PlatinGame\CoinBundle\Entity\Transactions;
use App\Entity\User;
use App\Entity\UserCoins;
/**
 * Class CoinController
 * @package App\PlatinGame\CoinBundle\Controller
 * @Route("/")
 */

class CoinController extends BaseController
{
	/**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/buy")
     */
	public function buyCoin(LoggerInterface $logger)
	{
		$user = $this->get('security.token_storage')->getToken()->getUser();

		if(!is_object($user)){
			return new JsonResponse(['error' => 'Not authorized.'],401);
		}
		
		$code = hash('ripemd160', uniqid());
		$coin = rand(1, 15);
		$entityManager = $this->getDoctrine()->getManager();
	    $userCoins = $entityManager->getRepository(UserCoins::class)
	    						   ->findOneBy([
	    						   		'user_id' => $user->getId()
	    						   	]);

	    $transactions = new Transactions();
	    $transactions->setCoin($coin);
	    $transactions->setCode($code);
	    $transactions->setUserId($user->getId());
	    $entityManager->persist($transactions);
	    $entityManager->flush();
	    
	    if (!$userCoins) {
	      	$userCoinsEntity = new UserCoins();
	      	$userCoinsEntity->setCoin($coin);
	      	$userCoinsEntity->setUserId($user->getId());
	      	$entityManager->persist($userCoinsEntity);
	      	$entityManager->flush();
	      	$amount = $coin;
	    }else{

	    	$userCoins->setCoin($coin + $userCoins->getCoin());
	    	$entityManager->flush();
	    	$amount = $userCoins->getCoin();
	    }

		$logger->info(sprintf('%s buy %s coin. Code: %s',$user->getUsername(),$amount,$code),['code' => $code,'username' => $user->getUsername(), 'coin' => $amount]);
		   
		return new JsonResponse(['hash' => $code,'coin' => $amount],200);
	}

	/**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/check")
     */
	public function checkCoin(LoggerInterface $logger, Request $request)
	{
		$user = $this->get('security.token_storage')->getToken()->getUser();

		if(!is_object($user)){
			return new JsonResponse(['error' => 'Not authorized.'],401);
		}

		$entityManager = $this->getDoctrine()->getManager();
	    $transaction = $entityManager->getRepository(Transactions::class)
	    							 ->findOneBy([
	    							 				'user_id' 	=> $user->getId(),
	    							 				'code' 		=> $request->request->get('code')
	    							 			]);

	   	if(!is_object($transaction)){
	   		return new JsonResponse(['error' => 'Wrong Verify Code'],400);
	   	}
	   	$logger->info(sprintf('%s check coin. Code: %s',$user->getUsername(),$request->request->get('code')),['code' => $request->request->get('code'),'username' => $user->getUsername(), 'coin' => $transaction->getCoin()]);
	    return new JsonResponse(['coin' => $transaction->getCoin()],200);
	}
}
