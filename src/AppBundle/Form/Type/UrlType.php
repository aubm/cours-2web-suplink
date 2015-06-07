<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UrlType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('original_url', null, [
            'label' => 'Original URL'
        ]);

        $builder->add('active', null, [
            'label' => 'Is active',
            'required' => false
        ]);

        $builder->add('submit', 'submit', [
            'label' => 'Submit'
        ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'app_url';
    }
}