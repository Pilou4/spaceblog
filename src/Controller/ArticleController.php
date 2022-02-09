<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/article', name: 'article_')]
class ArticleController extends AbstractController
{
    #[Route('/list', name: 'list', methods: ['GET'])]
    public function list(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/list.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    #[Route('/view/{id}-{slug}', name: 'view', methods: ['GET'])]
    public function view(Article $article): Response
    {
        return $this->render('article/view.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/add', name: 'add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', "L'article est bien enregistré");
            return $this->redirectToRoute('admin_dashboard');
        }

        
        return $this->render('article/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/upadte/{id}', name: 'update', requirements: ['id' => '\d+'])]
    public function upadte(Request $request, Article $article, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', "L'article a bien été modifier");
            return $this->redirectToRoute('admin_dashboard');
        }
        return $this->render('article/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', requirements: ['id' => '\d+'])]
    public function delete(Article $article, EntityManagerInterface $em)
    {
        $em->remove($article);
        $em->flush();

        $this->addFlash("success", "L'article a bien été supprimée");

        return $this->redirectToRoute('admin_dashboard');
    }
}
