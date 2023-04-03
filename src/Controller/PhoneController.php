<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Repository\PhoneRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

class PhoneController extends AbstractController
{


    /**
     * Retourne la liste paginée des téléphones
     * 
     * @OA\Response(
     *     response=200,
     *     description="Get all phones",
     *     @OA\JsonContent(
     *         type="array",
     *         @OA\Items(ref=@Model(type=Phone::class))
     *     )
     * )
     * 
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Page que vous souhaitez récupérer",
     *     @OA\Schema(type="int")
     * )
     * 
     * @OA\Parameter(
     *     name="limit",
     *     in="query",
     *     description="Nombre d'éléments par page que vous souhaitez récupérer",
     *     @OA\Schema(type="int")
     * )
     * 
     * @OA\Tag(name="Phones")
     *
     * @param PhoneRepository $phoneRepository
     * @param SerializerInterface $serializer
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/api/phones', name: 'app_phones', methods: ['GET'])]
    public function getAllPhones(PhoneRepository $phoneRepository, SerializerInterface $serializer, Request $request): JsonResponse
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 3);

        // @phpstan-ignore-next-line
        $phoneList = $phoneRepository->findAllWithPagination($page, $limit);
        $jsonPhoneList = $serializer->serialize($phoneList, 'json');

        return new JsonResponse($jsonPhoneList, Response::HTTP_OK, [], true);

    }


    /**
     * Retourne les détails sur le téléphone dont vous saisissez l'identifiant
     * 
     * @OA\Response(
     *     response=200,
     *     description="Get the details of 1 phone",
     *     @OA\JsonContent(
     *         type="array",
     *         @OA\Items(ref=@Model(type=Phone::class))
     *     )
     * )
     * 
     * @OA\Tag(name="Phones")
     */
    #[Route('/api/phones/{id}', name: 'app_phone_details', methods: ['GET'])]
    public function getPhone(Phone $phone, SerializerInterface $serializer): JsonResponse
    {
        $jsonPhone = $serializer->serialize($phone, 'json');

        return new JsonResponse($jsonPhone, Response::HTTP_OK, [], true);

    }


}
