<?php

namespace App\Controller;

use App\Repository\PhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PhoneController extends AbstractController
{
    #[Route('/api/phones', name: 'app_phone')]
    public function getAllPhones(PhoneRepository $phoneRepository): JsonResponse
    {
        $phoneList = $phoneRepository->findAll();

        return new JsonResponse([
            'phones' => $phoneList,
        ]);
    }
}
