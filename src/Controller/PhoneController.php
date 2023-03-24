<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Repository\PhoneRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PhoneController extends AbstractController
{


    #[Route('/api/phones', name: 'app_phones', methods: ['GET'])]
    public function getAllPhones(PhoneRepository $phoneRepository, SerializerInterface $serializer): JsonResponse
    {
        $phoneList = $phoneRepository->findAll();
        $jsonPhoneList = $serializer->serialize($phoneList, 'json');

        return new JsonResponse($jsonPhoneList, Response::HTTP_OK, [], true);

    }


    #[Route('/api/phones/{id}', name: 'app_phone_details', methods: ['GET'])]
    public function getPhone(Phone $phone, SerializerInterface $serializer): JsonResponse
    {
        $jsonPhone = $serializer->serialize($phone, 'json');

        return new JsonResponse($jsonPhone, Response::HTTP_OK, [], true);

    }


}
