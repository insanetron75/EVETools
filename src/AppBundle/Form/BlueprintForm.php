<?php
namespace AppBundle\Form;

use AppBundle\Form\Type\DataListType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlueprintForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('blueprint_name', DataListType::class, [
            'label' => 'Blueprint Name',
            'data'  => $options['data']
        ])
                ->add(
                    'material_efficiency',
                    ChoiceType::class,
                    [
                        'label'       => 'ME',
                        'placeholder' => 'Select Level',
                        'choices'     =>
                            [
                                '0'  => 0,
                                '1'  => 1,
                                '2'  => 2,
                                '3'  => 3,
                                '4'  => 4,
                                '5'  => 5,
                                '6'  => 6,
                                '7'  => 7,
                                '8'  => 8,
                                '9'  => 9,
                                '10' => 10
                            ]
                    ])
                ->add(
                    'time_efficiency',
                    ChoiceType::class,
                    [
                        'label'       => 'TE',
                        'placeholder' => 'Select Level',
                        'choices'     =>
                            [
                                '0'  => 0,
                                '2'  => 2,
                                '4'  => 4,
                                '6'  => 6,
                                '8'  => 8,
                                '10' => 10,
                                '12' => 12,
                                '14' => 14,
                                '16' => 16,
                                '18' => 18,
                                '20' => 20
                            ]
                    ])
                ->add(
                    'runs',
                    NumberType::class,
                    [
                        'label' => 'Runs',
                    ]);

        /* This is to be added when facility bonuses work
        $builder->add(
            'security_status',
            ChoiceType::class,
            [
                'label'   => 'System Security Status',
                'choices' => [
                    'High Sec' => 'high_sec',
                    'Low Sec'  => 'low_sec',
                    'Null/wh'  => 'null'
                ]
            ])
                ->add(
                    'industrial_complex',
                    CheckboxType::class,
                    [
                        'label'    => 'Industrial Complex',
                        'required' => false
                    ]
                )
                ->add(
                    't1_rig',
                    CheckboxType::class,
                    [
                        'label'    => 'T1 Rig',
                        'required' => false
                    ]
                )
                ->add(
                    't2_rig',
                    CheckboxType::class,
                    [
                        'label'    => 'T2 Rig',
                        'required' => false
                    ]
                )
                ->add(
                    'time_efficiency_bonus',
                    NumberType::class,
                    [
                        'label'    => 'TE Bonus',
                        'required' => false
                    ]
                );*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data' => []
        ]);
    }
}