<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Customer;
use App\Repository\UserRepository;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    /*
     * READ All Users.
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


    // READ One User.
    #[Route('/api/users/{id}', name: 'app_user_details', methods: ['GET'])]
    public function getUserDetails(User $user, SerializerInterface $serializer): JsonResponse
    {
        $jsonUser = $serializer->serialize($user, 'json', ['groups' => 'getUsers']);

        return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);

    }


    /*
     * READ All Customers.
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
     * READ One Customer.
     * #[Route('/api/customers/{id}', name: 'app_customer_details', methods: ['GET'])]
     * public function getCustomerDetails(Customer $customer, SerializerInterface $serializer): JsonResponse
     * {
     *     $jsonCustomer = $serializer->serialize($customer, 'json', ['groups' => 'getUsers']);
     *
     *     return new JsonResponse($jsonCustomer, Response::HTTP_OK, [], true);
     * }
     */


    // READ All Users of One Customer.
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


    // CREATE a User.
    #[Route('/api/users', name: 'app_user_create', methods: ['POST'])]
    public function createUser(CustomerRepository $customerRepository, Request $request, SerializerInterface $serializer, EntityManagerInterface $emi, UrlGeneratorInterface $urlGenerator, UserPasswordHasherInterface $passwordHasher, ValidatorInterface $validator): JsonResponse
    {
        $user = $serializer->deserialize($request->getContent(), User::class, 'json');
        $errors = $validator->validate($user);
        if ($errors->count() > 0) {
            return new JsonResponse(
                $serializer->serialize($errors, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }

        $content = $request->toArray();

        $idCustomer = $content['idCustomer'] ?? -1;
        $user->setCustomer($customerRepository->find($idCustomer));

        $plaintextPassword = $content['password'];
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        $emi->persist($user);
        $emi->flush();

        $jsonUser = $serializer->serialize($user, 'json', ['groups' => 'getUsers']);
        $location = $urlGenerator->generate('app_user_details', ['id' => $user->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonUser, Response::HTTP_CREATED, ["Location" => $location], true);

    }


    // UPDATE a User entirely.
    #[Route('/api/users/{id}', name: 'app_user_update', methods: ['PUT'])]
    public function updateUser(User $currentUser, CustomerRepository $customerRepository, Request $request, SerializerInterface $serializer, EntityManagerInterface $emi, UserPasswordHasherInterface $passwordHasher, ValidatorInterface $validator): JsonResponse
    {
        $updatedUser = $serializer->deserialize(
            $request->getContent(),
            User::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $currentUser]
        );

        $errors = $validator->validate($updatedUser);
        if ($errors->count() > 0) {
            return new JsonResponse(
                $serializer->serialize($errors, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }

        $content = $request->toArray();

        $idCustomer = $content['idCustomer'] ?? -1;
        $updatedUser->setCustomer($customerRepository->find($idCustomer));

        $plaintextPassword = $content['password'];
        $hashedPassword = $passwordHasher->hashPassword(
            $updatedUser,
            $plaintextPassword
        );
        $updatedUser->setPassword($hashedPassword);

        $emi->persist($updatedUser);
        $emi->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);

    }


    // UPDATE a User partially.
    #[Route('/api/users/{id}', name: 'app_user_update_part', methods: ['PATCH'])]
    public function updatePartUser(User $currentUser, CustomerRepository $customerRepository, Request $request, SerializerInterface $serializer, EntityManagerInterface $emi, UserPasswordHasherInterface $passwordHasher, ValidatorInterface $validator): JsonResponse
    {
        $updatedUser = $serializer->deserialize(
            $request->getContent(),
            User::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $currentUser]
        );

        $errors = $validator->validate($updatedUser);
        if ($errors->count() > 0) {
            return new JsonResponse(
                $serializer->serialize($errors, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }

        $content = $request->toArray();

        $idCustomer = $content['idCustomer'] ?? -1;
        $updatedUser->setCustomer($customerRepository->find($idCustomer));

        if ($content['password'] !== null) {
            $plaintextPassword = $content['password'];
            $hashedPassword = $passwordHasher->hashPassword(
                $updatedUser,
                $plaintextPassword
            );
            $updatedUser->setPassword($hashedPassword);
        }

        $emi->persist($updatedUser);
        $emi->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);

    }


}
