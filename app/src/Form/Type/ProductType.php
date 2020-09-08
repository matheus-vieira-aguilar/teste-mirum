<?php

namespace App\Form\Type;

use App\Repository\CategoryRepository;
use App\Repository\StoreRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{
    private $categoryRepository;
    private $storeRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        StoreRepository $storeRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->storeRepository = $storeRepository;

    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $categories = $this->categoryRepository->findAll();
        $stores = $this->storeRepository->findAll();
        
        $builder
            ->add('name', TextType::class)
            ->add('price', NumberType::class)
            ->add('store', ChoiceType::class, [
                'choices' => $stores,
                'choice_label' => function($store, $key, $index) {                    
                    return strtoupper($store->getName());
                },
            ])
            ->add('category', ChoiceType::class, [
                'choices' => $categories,
                'choice_label' => function($category, $key, $index) {                    
                    return strtoupper($category->getName());
                },
            ])
            ->add('save', SubmitType::class, ['label' => 'Save']);
    }
}
