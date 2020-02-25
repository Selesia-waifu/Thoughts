<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MostrarController extends AbstractController
{
    /**
     * @Route("/mostrar", name="mostrar")
     */
    public function index()
    {
        return $this->render('mostrar/index.html.twig', [
            'controller_name' => 'MostrarController',
        ]);
    }
}
