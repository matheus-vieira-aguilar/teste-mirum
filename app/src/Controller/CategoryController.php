<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\Type\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    const TEMPLATEBASE = 'category/';
    
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/category/", name="category_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $categories = $this->categoryRepository->findAll();
        
        return $this->render(self::TEMPLATEBASE . 'base.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("category/create", name="category_create", methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(CategoryType::class, (new Category()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $category = $form->getData();
            $this->categoryRepository->save($category);
            
            return $this->redirectToRoute('category_index');
        }
                    
        return $this->render(self::TEMPLATEBASE . 'form.html.twig', [
            'form' => $form->createView()
        ]);                
    }

    /**
     * @Route("category/update/{id}", name="category_update", methods={"GET", "POST"})
     */
    public function update(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $updatedCategory = $form->getData();
            $this->categoryRepository->save($updatedCategory);
            
            return $this->redirectToRoute('category_index');
        }
                    
        return $this->render(self::TEMPLATEBASE . 'form.html.twig', [
            'form' => $form->createView()
        ]);          
    }

    /**
     * @Route("category/delete/{id}", name="category_delete")
     */
    public function delete(Category $category): Response
    {
        $this->categoryRepository->delete($category);

        return $this->redirectToRoute('category_index');
    }
}
