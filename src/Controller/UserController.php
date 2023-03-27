<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Customer;
use App\Repository\UserRepository;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /*
     * READ - GET All Users.
     *
     * #[Route('/api/users', name: 'app_users', methods: ['GET'])]
     * public function getAllUsers(UserRepository $userRepository, SerializerInterface $serializer): JsonResponse
     * {
     *     $usersList = $userRepository->findAll();
     *     $jsonUsersList = $serializer->serialize($usersList, 'json', ['groups' => 'getUsers']);
     *
     *     return new JsonResponse($jsonUsersList, Response::HTTP_OK, [], true);
     * }
     */


    // READ - GET One User.
    #[Route('/api/users/{id}', name: 'app_user_details', methods: ['GET'])]
    public function getUserDetails(User $user, SerializerInterface $serializer): JsonResponse
    {
        $jsonUser = $serializer->serialize($user, 'json', ['groups' => 'getUsers']);

        return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);

    }


    /*
     * READ - GET All Customers.
     * #[Route('/api/customers', name: 'app_customers', methods: ['GET'])]
     * public function getAllCustomers(CustomerRepository $customerRepository, SerializerInterface $serializer): JsonResponse
     * {
     *     $customersList = $customerRepository->findAll();
     *     $jsonCustomersList = $serializer->serialize($customersList, 'json', ['groups' => 'getUsers']);
     *
     *     return new JsonResponse($jsonCustomersList, Response::HTTP_OK, [], true);
     * }
     */


    /*
     * READ - GET One Customer.
     * #[Route('/api/customers/{id}', name: 'app_customer_details', methods: ['GET'])]
     * public function getCustomerDetails(Customer $customer, SerializerInterface $serializer): JsonResponse
     * {
     *     $jsonCustomer = $serializer->serialize($customer, 'json', ['groups' => 'getUsers']);
     *
     *     return new JsonResponse($jsonCustomer, Response::HTTP_OK, [], true);
     * }
     */


    // READ - GET All Users of One Customer.
    #[Route('/api/customers/{id}/users', name: 'app_customer_users', methods: ['GET'])]
    public function getCustomerUsersList(Customer $customer, SerializerInterface $serializer): JsonResponse
    {
        $customerUsersList = $customer->getUsers();
        $jsonCustUsersList = $serializer->serialize($customerUsersList, 'json', ['groups' => 'getUsers']);

        return new JsonResponse($jsonCustUsersList, Response::HTTP_OK, [], true);

    }


    // DELETE a User.
    #[Route('/api/users/{id}', name: 'app_user_delete', methods: ['DELETE'])]
    public function deleteUser(User $user, EntityManagerInterface $emi): JsonResponse
    {
        $emi->remove($user);
        $emi->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);

    }


}
