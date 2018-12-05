<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use App\Entity\Country;
use App\Form\CountryType;

class CountryController extends AbstractController
{
    /**
     * @Route("/country", name="country")
     */
    public function index()
    {
      $countries = $this->getDoctrine()
      ->getRepository(Country::class)
      //->findAll();
      ->findBy([],['name'=> 'ASC']);
      //findBy permet de parametrer la recherche
      //le premier argument (tableau assoc) permet de Filtrer(where)
      //le deuxieme arhument permet le tri(oreder by)
        return $this->render('country/index.html.twig', [
            'countries'=>$countries
        ]);
    }

    /**
     * @Route("/country/add", name="country_add")
     */
    public function add(Request $request)
    {
      $file = '';
      $country = new Country();
      $form= $this->createForm(CountryType::class);
      $form->handleRequest($request);
      if($form->isSubmitted()) {
        $country=$form->getData();
        //traitement du fichier uploadé
        $file= $form->get('flag')->getData();
        $fileName = $file->getClientOriginalName();

        try{
          $file->move(
            $this->getParameter('flags_folder'),
            $fileName);
        }catch(FileException $e){
          echo 'error';
        }

        $country->setFlag($fileName);

        $em= $this->getDoctrine()->getManager();

        $em->persist($country);
        $em->flush();
        return $this->redirectToRoute('country');
      }

        return $this->render('country/add.html.twig', [
          'form'=>$form->createView(),
          'country'=>$country,
          'file'=>$file
        ]);
    }

    /**
     * @Route("/country/{id}/delete", name="country_delete")
     */
    public function delete($id)
    {
      $em = $this->getDoctrine()->getManager();
      $country = $this->getDoctrine()
      ->getRepository(Country::class)
      ->find($id);
      $em->remove($country);
      $em->flush();
      return $this->redirectToRoute('country');
    }


    /**
     * @Route("/country/{id}/edit", name="country_edit")
     */
    public function edit($id, Request $request)
    {
      //Elaboration de la connexion
      $em = $this->getDoctrine()->getManager();
      //recuperation des données du pays a modifier
      $country=$em->getRepository(Country::class)->find($id);
      $form= $this->createForm(CountryType::class,$country);
      $form->handleRequest($request);
      if($form->isSubmitted()){
        //modifie l'objet avec les données postées
        $country = $form->getData();
        $em->flush();
        return $this->redirectToRoute('country');
      }

      return $this->render('country/edit.html.twig',array(
        'form'=>$form->createView()

      ));

    }

    /**
     * @Route("/country/test", name="country_test")
     */
    public function test()
    {
      $countries = $this->getDoctrine()->getRepository(Country::class)//->findByPopNumber(5000)
      //->findAllCustom();
      //->findBySearch('gal')
      ->findAllRaw()
      ;
      //renvoie un tableaux associatif de form//['name'=>'France']
    return $this->render('country/test.html.twig',[
      'countries'=>$countries
    ]);
    }
}
