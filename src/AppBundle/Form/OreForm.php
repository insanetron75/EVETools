<?php
namespace AppBundle\Form;

use AppBundle\Entity\Region;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class OreForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'region_id',
            EntityType::class,
            [
                'class' => Region::class,
                'label' => 'Choose Region',
                'placeholder' => 'Select Region...'
            ]
            );
    }
}