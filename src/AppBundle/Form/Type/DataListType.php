<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DataListType extends AbstractType
{
    public function getParent()
    {
        return FormType::class;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data' => array(
                'Standard Shipping' => 'standard',
                'Expedited Shipping' => 'expedited',
                'Priority Shipping' => 'priority',
            )
        ));
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['data'] = $options['data'];
    }

    public function getName()
    {
        return 'datalist';
    }
}