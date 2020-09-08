<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Store;
use App\Form\Type\StoreType;
use App\Repository\StoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    const TEMPLATEBASE = 'store/';
    
    private StoreRepository $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    /**
     * @Route("/store/", name="store_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $stores = $this->storeRepository->findAll();
        
        return $this->render(self::TEMPLATEBASE . 'base.html.twig', [
            'stores' => $stores
        ]);
    }

    /**
     * @Route("store/create", name="store_create", methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(StoreType::class, (new Store()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $store = $form->getData();
            $this->storeRepository->save($store);
            
            return $this->redirectToRoute('store_index');
        }
                    
        return $this->render(self::TEMPLATEBASE . 'form.html.twig', [
            'form' => $form->createView()
        ]);                
    }

    /**
     * @Route("store/update/{id}", name="store_update", methods={"GET", "POST"})
     */
    public function update(Request $request, Store $store): Response
    {
        $form = $this->createForm(StoreType::class, $store);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $updatedStore = $form->getData();
            $this->storeRepository->save($updatedStore);
            
            return $this->redirectToRoute('store_index');
        }
                    
        return $this->render(self::TEMPLATEBASE . 'form.html.twig', [
            'form' => $form->createView()
        ]);          
    }

    /**
     * @Route("store/delete/{id}", name="store_delete")
     */
    public function delete(Store $store): Response
    {
        $this->storeRepository->delete($store);

        return $this->redirectToRoute('store_index');
    }
}
