<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class DemoController extends AbstractController{

    private $title='Joueurs';

//un fonction dans une class est une méthode

    public function players()
    {//jamais oublier le this
      $res = new Response('<h1>'.$this->title.'</h1>');
      return $res;
    }

    public function test()
    {
        //echo'blabla';
        $colors = ['green','white','red'];
        $colorsDict = [
          ['fr'=>'vert', 'en'=>'green', 'active'=>false],
          ['fr'=>'blanc', 'en'=>'white','active'=>false],
          ['fr'=>'rouge', 'en'=>'red','active'=>true]
        ];
       return $this->render('demo/test.html.twig',array(
         'title'=>'Template test',
         'colors' => $colors,
         'colorsDict'=>$colorsDict
       ));

    }
  

}
