<?php

namespace App\Controller;

use App\Entity\Likes;
use App\Entity\Pensamientos;
use App\Entity\User;
use App\Form\PensamientoType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MostrarController extends AbstractController
{

    /**
     * @Route("/eliminar",options={"exponse"=true},name="eliminar")
     */
    public function Eliminar(Request $request)
    {
        $pensamientos = new Pensamientos();
        if ($request->isXmlHttpRequest()) 
        {   $em = $this->getDoctrine()->getManager();
            $id=$request->request->get('id');
            $criteria= array('id'=>$id);
            $pensamientos=$em->getRepository(Pensamientos::class)->findOneBy($criteria);
            $em->remove($pensamientos);
            $em->flush();
            return new JsonResponse(['likes'=>$pensamientos]);
        }
        else
        {
            throw new \Exception('NO ME HAKIEES');
        }
    }
    /**
     * @Route("/mispublicaciones" , name="publicaciones")
     */
    public function Mispublicaciones()
    {
        $em =$this->getDoctrine()->getManager();
        $user = $this->getUser();
        $objPensamientos = $em->getRepository(Pensamientos::class)->MostrarMisPensamientos($user);
        $comprobarlikes=$em->getRepository(Likes::class)->Comprobarlike($user);
        $arry = array();
        for ($i=0; $i <count($comprobarlikes) ; $i++) 
        { 
        array_push($arry,$comprobarlikes[$i]['lies']);  
       
        }
        $separado=implode(",",$arry);
        return $this->render('mostrar/index.html.twig', [
            'controller_name' => 'Mis Pensamientos',
            'pensamientos'=>$objPensamientos,
            'comprobarlikes'=>$separado
        ]);

    }

    /**
     * @Route("/mostrar", name="mostrar")
     */
    public function index()
    {
        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $objPensamientos=$em->getRepository(Pensamientos::class)->MostrarPensamientos();
        $comprobarlikes=$em->getRepository(Likes::class)->Comprobarlike($user);
         $arry = array();
         for ($i=0; $i <count($comprobarlikes) ; $i++) 
         { 
         array_push($arry,$comprobarlikes[$i]['lies']);  
        
         }
         $separado=implode(",",$arry);
         
         
        return $this->render('mostrar/index.html.twig', [
            'controller_name' => 'Home',
            'pensamientos'=>$objPensamientos,
            'comprobarlikes'=>$separado
        ]);
    }
    
    /**
     * @Route("/quitarlike", options={"exponse"=true},name="quitarlike")
     */
    public function Quitarlike(Request $request)
    {
    
     $pensamientos = new Likes();
     if($request->isXmlHttpRequest())
     {
       $em=$this->getDoctrine()->getManager();
       $users=$this->getUser()->getId();
       $id=$request->request->get('id');
       $criteria= array('id_publicacion'=>$id,'id_user'=>$users);
       $pensamientos=$em->getRepository(Likes::class)->findOneBy($criteria);
       $em->remove($pensamientos);
       $em->flush();
       $post = $em->getRepository(Pensamientos::class)->find($id);
       $contadorlikes=$em->getRepository(Likes::class)->Getlikes($id);
       $post->setContadorlikes($contadorlikes);
       $em->flush();
       return new JsonResponse(['likes'=>$pensamientos]);
     }
    else
    {
            throw new \Exception('NO ME HAKIEES');
    }
       
     
    }


    /**
     * @Route("/likes", options={"exponse"=true} ,name="likes")
     */
    public function Likes(Request $request)
    {
        $likes = new Likes();
        if ($request->isXmlHttpRequest()) {
            $em=$this->getDoctrine()->getManager();
            $user =$this->getUser();
            $id=$request->request->get('id');
            $post = $em->getRepository(Pensamientos::class)->find($id);
            $likes->setIdPublicacion($post);
            $likes->setIdUser($user);
            $em->persist($likes);
            $em->flush();
            $contadorlikes=$em->getRepository(Likes::class)->Getlikes($id);
            $post->setContadorlikes($contadorlikes);
            $em->flush();
            return new JsonResponse(['likes'=>$user]);
        }
        else
        {
            throw new \Exception('NO ME HAKIEES');
        }
    }
    
   
}
