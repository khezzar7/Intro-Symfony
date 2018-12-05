<?php

namespace App\Controller;

use App\Entity\Color;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ColorController extends AbstractController
{

  public function color($color,$width,$height,$number)
  {
  return $this->render('color/color.html.twig', array(
    'color'  =>  $color,
    'width'  =>  $width,
    'height' =>  $height,
    'number' => $number
  ));
  }
  public function add(Request $request)
  {
    //var_dump($_POST);
    //var_dump($request);
    //echo $request->getMethod();
    //pour accéder aux param des requetes GET d'url http://localhost:8000/color/add?test=hicham
    //echo $request->query->get('test');//renvoi hicham
    $success=false;//sert à déterminer si l'enregistrement de la couleur a bien eu lieu
    $method = $request->getMethod();
    if($method === 'POST')
    {
      $nameEn = $request->request->get('nameEn');
      $nameFr = $request->request->get('nameFr');
      $hexa = $request->request->get('hexa');

      //insertion en base de donnée (database)
      //l'obj manager permet d'ecrire en base de donnée
      $em = $this->getDoctrine()->getManager();
      //Création d'un objet color a partir des données postées
      $color = new Color();
      $color->setNameEn($nameEn);
      $color->setNameFr($nameFr);
      $color->setHexa($hexa);


      //insere dans la database
      $em->persist($color);

       $em->flush();
      if($color->getId()!= NULL)
      {
        $success= true;
      }else {
        $success = false;
      }
      //var_dump($color);
    }

    return $this->render('color/add.html.twig', array(
      'success' =>  $success,
      'method'  =>  $method
    ));
  }

  public function list()
  {
    //Récuperation des couleurs en Db(database)->lecture

    $repo = $this
    ->getDoctrine()
    ->getRepository(Color::class);//ou App\Entity\Color

    $colors=$repo->findAll();

      return $this->render('color/list.html.twig',array(
      'colors'=>$colors
    ));
  }

  public function edit($id, Request $request)
  {
    $success = false;
    $method = $request->getMethod();
    //recupération de la couleur en Database
    $em = $this->getDoctrine()->getManager();
    //appel au repository à partir du manager
    //(connexion entre les deux)
    //avantage: dans le cas d'un UPDATE toute modification apportée à l'objet
    //récupéré par le repository générera
    //un requête de misa à jour en DB
    // lorsque flush()est appelée depuis le manager
    $color= $em->getRepository(Color::class)
    ->find($id);

    if($method === 'POST'){
      $nameEn = $request->request->get('nameEn');
      $nameFr = $request->request->get('nameFr');
      $hexa = $request->request->get('hexa');
      //Modification de valeurs recuperer
      $color->setNameEn($nameEn);
      $color->setNameFr($nameFr);
      $color->setHexa($hexa);

      $em->flush();
      //$success = true;
      //redirection vers page d'accueil
      return $this->redirectToRoute('index');
    }

    //var_dump($color);

    return $this->render('color/edit.html.twig',array(
      'method'=>$method,
      'color' => $color,
      'success' => $success
    ));

  }
  public function delete($id)
  {
    $em = $this->getDoctrine()->getManager();
    $color= $em->getRepository(Color::class)->find($id);
    $em->remove($color);
    $em->flush();
    return $this->redirectToRoute('index');

  }
  
}
