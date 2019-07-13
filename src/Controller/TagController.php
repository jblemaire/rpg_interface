<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Tag;
use App\Form\TagType;
use App\Service\TagService;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TagController extends AbstractController
{
    private $tagService;
    public function __construct(tagService $p_tagService)
    {
        $this->tagService = $p_tagService;

    }
    /**
     * @Route("/tag/create", defaults={"id"=null}, name="tag_create")
     * @Route("/tag/edit/{id}", name="tag_edit" )
     */
    public function fiche(Request $request , tag $p_tag = null,ObjectManager $manager)
    {
        $tagRepo = $this->getDoctrine()->getRepository(tag::class);
        if (!$p_tag ){
            $p_tag = new tag();
            $label = "Ajouter un tag";
        }else{
            $label = "Modifier";
        }

        $form = $this->createForm(tagType::class,$p_tag)
            ->add('save',SubmitType::class,[
                'label'=>$label
            ]);

        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $formtag = $form->getData();
            if(!$formtag->getId()){
                //traitement spécifique quand on edit
            }

            $manager->persist($formtag);
            $manager->flush();

            return $this->redirectToRoute('tag_edit',['id'=>$formtag->getId()]);
        }



        return $this->render('tag/fiche.html.twig', [

            'form'=>$form->createView(),
        ]);
    }
    /**
     * @Route("/tag/liste", name="tag_liste")
     */
    public function liste()
    {
        $tagRepo = $this->getDoctrine()->getRepository(tag::class);

        $tags = $tagRepo->findAll();

        return $this->render('tag/liste.html.twig', [
            'tags' => $tags,
        ]);
    }
}
