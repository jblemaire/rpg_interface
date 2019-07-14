<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Element;
use App\Entity\Tag;
use App\Form\ElementType;
use App\Service\ElementService;
use Symfony\Component\Form\FormTypeInterface;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ElementController extends AbstractController
{
    private $elementService;
    public function __construct(ElementService $p_elementService)
    {
        $this->elementService = $p_elementService;

    }
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
            $edit = false;
        }
        else{
            $edit = true;
        }

        $form = $this->createForm(ElementType::class,$p_Element)
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

        //Liste des tags
        $tagRepo = $this->getDoctrine()->getRepository(Tag::class);
        $tags = $tagRepo->findAll();


        return $this->render('element/fiche.html.twig', [

            'form'=>$form->createView(),
            'tags'=>$tags,
            'edit'=>$edit,
        ]);
    }
    /**
     * @Route("/element/link", name="element_link")
     */
    public function linking(Request $request)
    {
      // $parameters = $request->request->all();
        $idTag = $request->request->get('idTag');
        $idElement = $request->request->get('idElement');

        $this->elementService->link($idTag,$idElement);

        return new JsonResponse($request->request->all());
    }
    /**
     * @Route("/element/get/tags", name="element_get_tags")
     */
    public function getTag(Request $request)
    {
        $idElement = $request->request->get('idElement');
        $result = $this->elementService->getTags($idElement);

        return new JsonResponse($result);
    }
    /**
     * @Route("/element/link/remove", name="element_remove_link")
     */
    public function removeLink(Request $request)
    {
        $idElement = $request->request->get('idElement');
        $idTag = $request->request->get('idTag');
        $result = $this->elementService->removeLink($idTag,$idElement);

        return new JsonResponse(array("status"=>$result,"idTag"=>$idTag));
    }
}
