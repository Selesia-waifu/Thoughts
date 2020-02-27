<?php

namespace App\Controller;
use App\Entity\Pensamientos;
use App\Entity\Comentarios;
use App\Form\ComentarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ComentarioController extends AbstractController
{
     /** 
     * @Route("/comentarios/{id}",name="comentarios")
    */
    public function comentarios($id)
    {
        

        $em = $this->getDoctrine()->getManager();
        $objPensamientos=$em->getRepository(Pensamientos::class)->MostrarPensamientosID($id);
        return $this->render('comentario/index.html.twig', [
            'controller_name' => 'ComentarioController',
            'pensamientos'=>$objPensamientos,
            
        ]);
    }
     /** 
     * @Route("/comentar/{id}",name="comentar")
    */
    public function comentar($id,Request $request)
    {
        
        $em=$this->getDoctrine()->getManager();
        $objPensamientos=$em->getRepository(Pensamientos::class)->MostrarPensamientosID($id);
        $comentar = new comentarios();
        $form = $this->createForm(ComentarioType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $user=$this->getUser();
            $comentar->setIdUser($user);
            $comentar->setIdPensamiento($id);
            $comentar->setContenidoComentario($form['contenido_comentario']->getData());
            $em->persist($comentar);
            $em->flush();
        }
        return $this->render('comentario/index.html.twig',[
        'comentar'=>$form->createView(),
        'pensamientos'=>$objPensamientos
        ]);

    }
}
