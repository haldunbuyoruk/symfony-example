<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\UserCoins;
use FOS\UserBundle\Util\TokenGeneratorInterface;

class DefaultController extends Controller
{

	public $coin = 0;

    /**
     * @Route("/default", name="default")
     */
    public function index(TokenGeneratorInterface $tokenGenerator)
    {
        $token = "";
    	$user = $this->get('security.token_storage')->getToken()->getUser();
		if(is_object($user)){
			$entityManager = $this->getDoctrine()->getManager();
			$userCoins = $entityManager->getRepository(UserCoins::class)->findOneBy(['user_id' => $user->getId()]);
			if(is_object($userCoins))
				$this->coin = $userCoins->getCoin();
            $token = $user->getConfirmationToken();
            if(!$token){
                $user->setConfirmationToken($tokenGenerator->generateToken());
                $user->setPasswordRequestedAt(new \DateTime());
                $token = $user->getConfirmationToken();
                $this->getDoctrine()->getManager()->persist($user);
                $this->getDoctrine()->getManager()->flush();
            }
		}
    
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'coin' => $this->coin,
            'token' => $token
        ]);
    }
}
