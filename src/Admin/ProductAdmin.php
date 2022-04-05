<?php

namespace App\Admin;

use App\Entity\Product;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ProductAdmin extends AbstractAdmin
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
    )
    {
        parent::__construct($code, $class, $baseControllerName);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->tab('Главная', []);

        $formMapper
            ->add('price', TextType::class)
            ->add('prodId', TextType::class)
            ->add('vendorCode', TextType::class)
            ->add('vendor', TextType::class)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('enStock', TextType::class)
            ->add('description', TextType::class)
            ->add('wholesaler', TextType::class)
            ->add('rating', TextType::class)
            ->add('discount', TextType::class)
            ->end();
        $formMapper->end();

        $formMapper->tab('Характеристики товара', []);

        $formMapper
            ->add('productCharacteristicsData.brutto', TextType::class)
            ->add('productCharacteristicsData.batteries', TextType::class)
            ->add('productCharacteristicsData.pack', TextType::class)
            ->add('productCharacteristicsData.material', TextType::class)
            ->add('productCharacteristicsData.lenght', TextType::class)
            ->add('productCharacteristicsData.diameter', TextType::class)
            ->add('productCharacteristicsData.collectionName', TextType::class)
            ->end();
        $formMapper->end();


        $formMapper->tab('Категории', []);
        $formMapper->add('categories', ModelAutocompleteType::class, [
            'property' => 'title',
            'multiple' => true,
            'btn_add' => true,
            'by_reference' => false
        ])
            ->end();
        $formMapper->end();


        $formMapper->tab('Фото товара', [])
            ->add('images', CollectionType::class, [])
            ->end()
            ->end();

        $formMapper->tab('Seo', [])
            ->add('seo.title', TextType::class)
            ->add('seo.h1', TextType::class)
            ->add('seo.keywords', TextType::class)
            ->add('seo.slug', TextType::class)
            ->add('seo.description', TextareaType::class)
            ->add('seo.html', TextareaType::class)
            ->end()
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id')
        ->add('name')
        ->add('productCharacteristicsData.brutto')
        ->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('price')
            ->add('prodId')
            ->add('vendorCode')
            ->add('vendor')
            ->add('name')
            ->add('description')
            ->add('enStock', null, ['editable' => true])
            ->add('wholesaler')
            ->add('discount')
            ->add('productCharacteristicsData.brutto', null, ['label' => 'brutto'])
            ->add('rating');
    }

    /**
     * @param Product $product
     *
     * @throws \Exception
     */
    public function preUpdate($product)
    {
        $product->setUpdateAt();

        parent::preUpdate($product);
    }
}
