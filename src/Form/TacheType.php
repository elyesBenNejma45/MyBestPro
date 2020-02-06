<?php

namespace App\Form;

use App\Entity\Tache;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('statut', ChoiceType::class,[
                "choices" => $this->getChoice()
            ])
            ->add('dateDeCreation')
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
    }

    private function getChoice(){
        $output = [];
        $choise = ["à faire","en cours","terminée"];
        foreach($choise as $k => $v){
            $output[$v] = $v;
        } 
        return $output;
    }
}
