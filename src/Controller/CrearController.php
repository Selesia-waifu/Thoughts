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
     * @Route("/editar/{id}",name="editar")
     */
    public function Editar(Request $request,$id)
    {
        $pensamientos = new Pensamientos();
        $em = $this->getDoctrine()->getManager();
        $criteria= array('id'=>$id);
        $user = $this->getUser();
        $pensamientos=$em->getRepository(Pensamientos::class)->findOneBy($criteria);
        if($pensamientos!=null)
        {
            dump($pensamientos->getIdUser());
            dump($user);
            if($pensamientos->getIdUser()==$user)
            {
                $titulo=$pensamientos->getTitulo();
                $contenido=$pensamientos->getContenido();
                $form = $this->createForm(PensamientoType::class);
                $form->get('titulo')->setData($titulo);
                $form->get('Contenido')->setData($contenido);
                $form->handleRequest($request);
                if ($form->isSubmitted()&&$form->isValid()) {
                   $pensamientos->setTitulo($form['titulo']->getData());
                   $pensamientos->setContenido($form['Contenido']->getData());
                   $em->flush();
                   return $this->redirectToRoute('mostrar');
                }
            }
            else
            {
                throw new \Exception('Este pensamiento no es tuyo');
            }
            
        }
        else
        {
            throw new \Exception('Pensamiento no encontrado');
        }
       
        return $this->render('crear/index.html.twig', [
            'controller_name' => 'Editar Pensamiento',
            'formulario'=>$form->createView()
        ]);
    }

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
            return $this->redirectToRoute('mostrar');
        }
        return $this->render('crear/index.html.twig', [
            'controller_name' => 'Publicar Pensamiento',
            'formulario'=>$form->createView()
        ]);
    }
}
