<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category-index')]
    public function index(CategoryRepository $categoryRepository): Response
    {   
        $categories = $categoryRepository->findAll();
    
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'page_name'       => 'Catégories',
            'categories'      => $categories,
        ]);
    }

}
