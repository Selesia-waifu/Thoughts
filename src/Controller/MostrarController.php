<?php

namespace App\Controller;

use App\Entity\Pensamientos;
use App\Form\PensamientoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MostrarController extends AbstractController
{
    /**
     * @Route("/mostrar", name="mostrar")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pensamientos= new Pensamientos();
        $objPensamientos=$em->getRepository(Pensamientos::class)->MostrarPensamientos();

        return $this->render('mostrar/index.html.twig', [
            'controller_name' => 'MostrarController',
            'pensamientos'=>$objPensamientos
        ]);
    }
    
   
}
