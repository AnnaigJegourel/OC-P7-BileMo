<?php

namespace App\Controller;

use App\Repository\PhoneRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PhoneController extends AbstractController
{
    #[Route('/api/phones', name: 'app_phone')]
    public function getAllPhones(PhoneRepository $phoneRepository, SerializerInterface $serializer): JsonResponse
    {
        $phoneList = $phoneRepository->findAll();
        $jsonPhoneList = $serializer->serialize($phoneList, 'json');

        return new JsonResponse([
            $jsonPhoneList,
            Response::HTTP_OK,
            [],
            true
        ]);
    }
}
