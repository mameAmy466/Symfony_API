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
use App\Entity\Operation;
use App\Form\OperationType;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/api")
 */
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
            'echo' => 201,
            'sms' => 'Les propriétés du partenaire ont été bien ajouté'
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

     /**
      * @Route("/depot", name="depot", methods={"POST"})
      */
     public function depot(Request $request, EntityManagerInterface $entityManager){
         $values = json_decode($request->getContent());
         if(isset($values->monaant)){
        $operation = new Operation();
        $operation->setMonaant($values->monaant);
        $operation->setDate(new \DateTime());

        $requet=$this->getDoctrine()->getRepository(Partenaire::class);
        $partenaire=$requet->find($values->idPartenaire);
        $operation->setIdPartenaire($partenaire);

        $requet=$this->getDoctrine()->getRepository(Compte::class);
        $compte=$requet->find($values->idCompt);
        $operation->setIdCompt($compte);

        $partenaire->setMontan($partenaire->getMontan()+$values->monaant);

        $entityManager->persist($compte);
        $entityManager->persist($partenaire);

        $entityManager->persist($operation);
        $entityManager->flush();
             $data = [
                'status' => 201,
                'message' => 'Le dépot a été bien effectué'
            ];
            return new JsonResponse($data, 201);

         }

        }
    }

