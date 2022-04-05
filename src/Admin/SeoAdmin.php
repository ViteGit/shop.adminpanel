<?php

namespace App\Admin;

use App\Entity\Seo;
use App\Service\GuzzleService;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class SeoAdmin extends AbstractAdmin
{
    private $client;

    /**
     * @param string $code
     * @param string $class
     * @param string $baseControllerName
     * @param GuzzleService $guzzleService
     */
    public function __construct(
        string $code,
        string $class,
        string $baseControllerName,
        GuzzleService $guzzleService
    ) {
        $this->client = $guzzleService;

        parent::__construct($code, $class, $baseControllerName);
    }


    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        try {
            $options = json_decode($this->client->getContent('http://erotikashop.ru/cron/v1/test'),true)['data'];
        } catch (\Exception $e) {
            $options = [];
        }

        $formMapper
            ->add('title', TextType::class, [])
            ->add('keywords', TextType::class)
            ->add('h1', TextType::class)
            ->add('description', TextareaType::class, ['required' => false])
            ->add('html', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'rows' => '40'
                ]
            ])
            ->add('route', ChoiceFieldMaskType::class, [
                'choices' => [
                    $options
                ],
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        try {
            $options = json_decode($this->client->getContent('http://erotikashop.ru/cron/v1/test'),true)['data'];
        } catch (\Exception $e) {
            $options = [];
        }

        $datagridMapper->add('id')
            ->add('route',
                null,
                [],
                ChoiceFieldMaskType::class, [
                    'choices' => [
                        $options
                    ]
                ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('title')
            ->add('keywords')
            ->add('description')
            ->add('route');
    }

    /**
     * @param Seo $seo
     *
     * @throws \Exception
     */
    public function preUpdate($seo)
    {
        $seo->setUpdateAt();

        parent::preUpdate($seo);
    }
}
