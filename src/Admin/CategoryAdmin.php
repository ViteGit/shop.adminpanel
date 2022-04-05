<?php

namespace App\Admin;

use App\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CategoryAdmin extends AbstractAdmin
{
    /**
     * @param string $code
     * @param string $class
     * @param string $baseControllerName
     */
    public function __construct(
        string $code,
        string $class,
        string $baseControllerName
    ) {
        parent::__construct($code, $class, $baseControllerName);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->tab('Общая', [])
            ->add('title', TextType::class)
            ->add('label', TextType::class)
            ->add('root', ChoiceFieldMaskType::class, [
                'label' => 'Корень меню',
                'choices' => [
                    'нет' => false,
                    'да' => true,
                ],
            ])
            ->add('description', TextType::class, ['required' => false])
            ->add('position', TextType::class)
            ->add('children', ModelAutocompleteType::class, [
                'property' => 'title',
                'multiple' => true,
                'btn_add' => true,
                'by_reference' => false
            ])
            ->add('parent', ModelListType::class, [
                'label' => 'Родительские Категории',
            ])
            ->end()
        ->end();

        $formMapper->tab('Seo', [])
            ->add('seo.title', TextType::class, [
                'help' => 'Купить вибратор | Женские секс вибраторы | Заказать онлайн'
            ])
            ->add('seo.h1', TextType::class)
            ->add('seo.keywords', TextType::class)
            ->add('seo.slug', TextType::class)
            ->add('seo.description', TextareaType::class, [
                'required' => false,
            ])
            ->add('seo.html', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'rows' => '40'
                ],
            ])
            ->end()
        ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id')
            ->add('title')
            ->add('seo.title');
    }

    /**
     * @param Category $category
     *
     * @throws \Exception
     */
    public function preUpdate($category)
    {
        $category->setUpdateAt();

        parent::preUpdate($category);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('title')
            ->add('description')
            ->add('position')
            ->add('root', null, ['label' => 'Корень меню'])
            ->add('seo.title')
            ->add('seo.description')
            ->add('seo.html');
    }
}
