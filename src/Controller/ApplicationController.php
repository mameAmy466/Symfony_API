<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Compte;
use App\Entity\Partenaire;
class ApplicationController extends AbstractController
{
    /**
     * @Route("/application", name="application")
     */
    public function index()
    {
        return $this->render('application/index.html.twig', [
            'controller_name' => 'ApplicationController',
        ]);
    }
         /**
     * @Route("/part", name="part", methods={"POST"})
     */
    public function part(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer)
    
    {
        $par = $serializer->deserialize($request->getContent(), Partenaire::class, 'json');
        $entityManager->persist($par);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'Les propriétés du partenaire ont été bien ajouté'
        ];
        return new JsonResponse($data, 201);
    }
    /**
     * @Route("/add", name="add", methods={"POST"})
     */

    public function add(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager){
        $compte = $serializer->deserialize($request->getContent(), Compte::class, 'json');
        $entityManager->persist($compte);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'Les propriétés du compte ont été bien ajouté'
        ];
        return new JsonResponse($data, 201);
     }
}
