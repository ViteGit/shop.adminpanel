<?php

namespace App\Controller;

use App\Entity\PickPointZone;
use App\Helpers\StylesheetHelper;
use App\Repository\PickPointZoneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AjaxController extends AbstractController
{
    private $pickPointZoneRepository;
    private $em;

    public function __construct(PickPointZoneRepository $pickPointZoneRepository, EntityManagerInterface $entityManager)
    {
        $this->pickPointZoneRepository = $pickPointZoneRepository;
        $this->em = $entityManager;
    }

    /**
     * @Route("/importZone", methods={"POST"})
     *
     * @param Request $request
     */
    public function importZone(Request $request)
    {
        $file = $request->files->get('file');

        foreach (StylesheetHelper::toAssosiativeArray($file->getPathname(), $file->getClientOriginalExtension()) as $row) {
            $city = $row['gorod-poluchatel'] ?? null;
            $region = $row['region'] ?? null;
            $zone = (int)$row['zona'] ?? null;
            $coeff = (float)$row['koeff-1-4'] ?? null;
            $deliveryTerms = $row['standart'] ?? null;

            if (empty($city) || empty($region) || empty($zone) || empty($deliveryTerms)) {
                continue;
            }

            if (empty($this->pickPointZoneRepository->findOneBy(['city' => $city]))) {
                $this->em->persist(new PickPointZone($city, $region, $deliveryTerms, $zone, $coeff));
            };

            $this->em->flush();
        }

        return new Response('ok');
    }
}
