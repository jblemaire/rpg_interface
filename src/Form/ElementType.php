<?php

namespace App\Form;

use App\Entity\Element;
use App\Entity\Stat;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ElementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('isTemplate')
            ->add('effect')
            ->add('use_cost')
            ->add('use_number')
            ->add('weight')
            ->add('stack_size')
            ->add('nb_upgrade_max')
            ->add('nb_upgrade')
            ->add('slot')
            ->add('rarity')
            ->add('type')
            ->add('family')
           /* ->add('stat',EntityType::class,[
                'class' => Stat::class,
                'choice_label' => 'name',
                'multiple' => true,
              ])*/
          //  ->add('save',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Element::class,
        ]);
    }
}
