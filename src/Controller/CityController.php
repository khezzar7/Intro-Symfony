<?php

namespace App\Controller;
use App\Entity\City;
use App\Form\CityType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CityController extends AbstractController
{
    /**
     * @Route("/city", name="city")
     */
    public function index()
    {
      $cities= $this->getDoctrine()->getRepository(City::class)->findBy([],['name'=>'ASC']);
        return $this->render('city/index.html.twig', [
            'cities' => $cities
        ]);
    }

    /**
     * @Route("/city/add", name="city_add")
     */
    public function add(Request $request)
    {
      $city= new City();
      $form=$this->createForm(CityType::class);
      $form->handleRequest($request);
      if($form->isSubmitted()) {
        $city=$form->getData();
        $em= $this->getDoctrine()->getManager();
        $em->persist($city);
        $em->flush();
      
      }

        return $this->render('city/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
