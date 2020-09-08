<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\Type\ProductType;
use App\Repository\ProductRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductController extends AbstractController
{
    
    const TEMPLATEBASE = 'product/';

    private ProductRepository $productRepository; 

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @Route("/product/", name="products_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $products = $this->productRepository->findAll();
        
        return $this->render(self::TEMPLATEBASE . 'base.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @Route("/product/create", name="product_create", methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {        
        $form = $this->createForm(ProductType::class, (new Product()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            
            $this->productRepository->save($product);
            
            return $this->redirectToRoute('products_index');
        }
           
        return $this->render(self::TEMPLATEBASE . 'form.html.twig', [
            'form' => $form->createView()
        ]);              
    }
    
    /**
     * @Route("product/update/{id}", name="product_update", methods={"GET", "POST"})
     */
    public function update(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $updatedproduct = $form->getData();
            $this->productRepository->save($updatedproduct);
            
            return $this->redirectToRoute('products_index');
        }
                    
        return $this->render(self::TEMPLATEBASE . 'form.html.twig', [
            'form' => $form->createView()
        ]);          
    }

    /**
     * @Route("product/delete/{id}", name="product_delete")
     */
    public function delete(Product $product): Response
    {
        $this->productRepository->delete($product);

        return $this->redirectToRoute('products_index');
    }
}
