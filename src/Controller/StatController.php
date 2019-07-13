<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


use App\Entity\Stat;
use App\Form\StatType;
use App\Service\StatService;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StatController extends AbstractController
{
    private $statService;
    public function __construct(StatService $p_statService)
    {
        $this->statService = $p_statService;

    }
    /**
     * @Route("/stat/create", defaults={"id"=null}, name="stat_create")
     * @Route("/stat/edit/{id}", name="stat_edit" )
     */
    public function fiche(Request $request , Stat $p_Stat = null,ObjectManager $manager)
    {
        $statRepo = $this->getDoctrine()->getRepository(Stat::class);
        if (!$p_Stat ){
            $p_Stat = new Stat();
            $label = "Ajouter une statistique";
        }else{
            $label = "Modifier";
        }

        $form = $this->createForm(StatType::class,$p_Stat)
            ->add('save',SubmitType::class,[
                'label'=>$label
            ]);

        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $formStat = $form->getData();
            if(!$formStat->getId()){
               //traitement quand on édite
            }

            $manager->persist($formStat);
            $manager->flush();

            return $this->redirectToRoute('stat_edit',['id'=>$formStat->getId()]);
        }



        return $this->render('stat/fiche.html.twig', [

            'form'=>$form->createView(),
        ]);
    }
    /**
     * @Route("/stat/liste", name="stat_liste")
     */
    public function liste()
    {
        $statRepo = $this->getDoctrine()->getRepository(Stat::class);

        $stats = $statRepo->findAll();

        return $this->render('stat/liste.html.twig', [
            'stats' => $stats,
        ]);
    }
}
