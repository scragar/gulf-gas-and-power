<?php

namespace App\Controller\Broker;

use App\Entity\Broker;
use App\Entity\MeterPoint;
use App\Repository\BrokerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiBrokerController extends AbstractController
{
    /**
     * @Route("/api-broker/get-commission")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $request = Request::createFromGlobals();
        $jsonArgs = json_decode($request->getContent());

        /** @var BrokerRepository $brokerRepo */
        $brokerRepo = $entityManager->getRepository(Broker::class);
        $commissions = $brokerRepo->getCommissionWithZeros($jsonArgs->partner, $jsonArgs->meterpoint);

        return new Response(json_encode($commissions));
    }
}