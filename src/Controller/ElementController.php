<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Element;
use App\Form\ElementType;
use Symfony\Component\Form\FormTypeInterface;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ElementController extends AbstractController
{
    /**
     * @Route("/element/liste", name="element_liste")
     */
    public function liste()
    {
        $elementRepo = $this->getDoctrine()->getRepository(Element::class);

        $elements = $elementRepo->findAll();

        return $this->render('element/liste.html.twig', [
            'elements' => $elements,
        ]);
    }
    /**
     * @Route("/element/create", defaults={"id"=null}, name="element_create")
     * @Route("/element/edit/{id}", name="element_edit" )
     */
    public function fiche(Request $request ,Element $p_Element = null,ObjectManager $manager)
    {
        $elementRepo = $this->getDoctrine()->getRepository(Element::class);
        if (!$p_Element ){
            $p_Element = new Element();
        }

        $form = $this->createForm(ElementType::class)
            ->add('save',SubmitType::class,[
                'label'=>"Ajouter un element"
            ]);


        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $formElement = $form->getData();
            if(!$formElement->getId()){
                //traitement quand on édite
            }

            $manager->persist($formElement);
            $manager->flush();

            return $this->redirectToRoute('element_edit',['id'=>$formElement->getId()]);
        }



        return $this->render('element/fiche.html.twig', [

            'form'=>$form->createView(),
        ]);
    }
}
