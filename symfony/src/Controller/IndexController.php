<?php

namespace App\Controller;

use App\Entity\Broker;
use Doctrine\ORM\PersistentCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Repository\BrokerRepository;

class IndexController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        /** @var BrokerRepository $brokerRepo */
        $brokerRepo = $entityManager->getRepository(Broker::class);

        $broker = $brokerRepo->findRandom();

        // Returns a random meter point if we have one(makes the default behaviour a bit nicer for testing)
        $randomMeterpoint = $broker->getMeterPointPartners()->count() ?
            $broker->getRandomMeterPointPartner()->getMeterPoint()->getMeterpoint()
            : null;

        return $this->render('index.html.twig', [
            'default_json' => json_encode([
                "partner" => $broker->getName(),
                "meterpoint" => $randomMeterpoint,
            ], JSON_PRETTY_PRINT),
        ]);
    }
}
