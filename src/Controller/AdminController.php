<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/dashboard', name: 'admin_dashboard')]
    public function dashboard(BookRepository $bookRepository): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }

    #[Route('/book/new', name: 'admin_book_new')]
    public function newBook(Request $request, EntityManagerInterface $entityManager): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($book);
            $entityManager->flush();

            $this->addFlash('success', 'Book created successfully!');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/book_form.html.twig', [
            'form' => $form->createView(),
            'title' => 'New Book'
        ]);
    }

    #[Route('/book/{id}/edit', name: 'admin_book_edit')]
    public function editBook(Request $request, Book $book, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Book updated successfully!');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/book_form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Edit Book'
        ]);
    }

    #[Route('/book/{id}/delete', name: 'admin_book_delete')]
    public function deleteBook(Book $book, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($book);
        $entityManager->flush();

        $this->addFlash('success', 'Book deleted successfully!');
        return $this->redirectToRoute('admin_dashboard');
    }
}
