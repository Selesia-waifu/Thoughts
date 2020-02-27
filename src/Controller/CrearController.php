<?php

namespace App\Controller;
use App\Entity\Pensamientos;
use App\Form\PensamientoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CrearController extends AbstractController
{
    /**
     * @Route("/crear", name="crear")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pensamientos= new Pensamientos();
        $form = $this->createForm(PensamientoType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $user=$this->getUser();
            $pensamientos->setIdUser($user);
            $pensamientos->setTitulo($form['titulo']->getData());
            $pensamientos->setContenido($form['Contenido']->getData());
            $em->persist($pensamientos);
            $em->flush();
        }
        return $this->render('crear/index.html.twig', [
            'controller_name' => 'CrearController',
            'formulario'=>$form->createView()
        ]);
    }
}
