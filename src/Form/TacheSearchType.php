<?php

namespace App\Form;

use App\Entity\Tache;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TacheSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('statut', ChoiceType::class,[
            "choices" => $this->getChoice()])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
            'method' => 'get',
            'csrf_protection' => false
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
    public function getBlockPrefix(){
        return "";  
    }

}
