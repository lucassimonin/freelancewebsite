<?php
/**
 * This file is part of the MrtEcommerce package.
 *
 * @copyright Copyright (C) Mapi Research Trust
 */

namespace App\Bundle\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\Translator;
use eZ\Publish\API\Repository\Repository;

/**
 * MyProfileType Class.
 *
 * @author kapetanosm
 */
class ContactType extends AbstractType
{
    /** @var \Symfony\Component\DependencyInjection\Container */
    protected $container;

    /**
     * Constructor
     * @param Container  $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Build form.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translator = $this->container->get('translator');
        $builder
            ->add('name', 'text', array('required' => true))
            ->add('email', 'email', array('required' => true))
            ->add('subject', 'choice', array(
                'choices' => array(
                    null => $translator->trans('app.contact.option.choose'),
                    0    => $translator->trans('app.contact.option.website'),
                    1    => $translator->trans('app.contact.option.propose'),
                    2    => $translator->trans('app.contact.option.other')
                ),
                'required' => true
            ))
            ->add('message', 'textarea', array('required' => true));
    }

    /**
     * Return registration form name.
     *
     * @return string
     */
    public function getName()
    {
        return 'contact_type';
    }

    /**
     * ConfigureOptions, gets data registration class.
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'App\Bundle\SiteBundle\Entity\Contact'
            )
        );
    }
}