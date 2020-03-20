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
     * @Route("/comentar/{id}",name="comentar")
    */
    public function comentar($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $objPensamientos=$em->getRepository(Pensamientos::class)->MostrarPensamientosID($id);
        if($objPensamientos != null)
        {
            $pensamiento=$em->getRepository(Pensamientos::class)->find($id);
            $comentar = new comentarios();
            $form = $this->createForm(ComentarioType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()) {
                $user=$this->getUser();
                $comentar->setIdPensamiento($pensamiento);
                $comentar->setIdUser($user);
                $comentar->setContenidoComentario($form['contenido_comentario']->getData());
                $em->persist($comentar);
                $em->flush();
                return $this->redirectToRoute('comentar',['id'=>$id]);
            }
            $comentarios=$em->getRepository(Comentarios::class)->verComentarios($id);
        }
        else
        {
            throw new \Exception('Pensamiento no encontrado');
        }
       
        return $this->render('comentario/index.html.twig',[
        'comentar'=>$form->createView(),
        'pensamientos'=>$objPensamientos,
        'comentarios'=>$comentarios
        ]);

    }
    
}
