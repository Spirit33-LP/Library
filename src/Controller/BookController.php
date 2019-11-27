<?php


namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/books", name="books")
     */
    //méthode qui permet de faire "un SELECT" en BDD de l'ensemble de mes champs dans ma table Book
    public function AffBooks(BookRepository $bookRepository)
    {
        // appelle la méthode qu'on a créée dans le bookRepository ("getByGenre()")
        // Cette méthode est censée nous retourner tous les livres en fonction d'un genre
        // Elle va donc executer une requete SELECT en base de données
        $books = $bookRepository ->findAll();

        //méthode render qui permet d'afficher mon fichier books.html.twig et le résultat de ma requete SQL
        return $this->render('books.html.twig', ['books'=>$books]);

    }

    /**
     * @Route("/book/{id}", name="book")
     */
    public function AffBook(BookRepository $bookRepository, $id)
    {
        $book = $bookRepository ->find($id);

        return $this->render('book.html.twig', ['book'=>$book]);
    }

    /**
     * @Route("/book/insert", name="book_insert")
     */
    public function insertBook(EntityManagerInterface $entityManager)
    {
        // insérer dans la table book un nouveau livre
        $book = new Book();
        $book->setTitle('Livre du 27.11 du matin');
        $book->setAuthor('Cyril Champrou');
        $book->setGenre('espoir');
        $book->setInStock('true');
        $book->setNbPages('10');
        $book->setDate(new \DateTime());

        $entityManager->persist($book);
        $entityManager->flush();
    }

    /**
     * @param BookRepository $bookRepository
     * @param EntityManagerInterface $entityManager
     * @Route("books/delete/{id}", name="books_delete_id")
     */
    public function deleteBook(BookRepository $bookRepository, EntityManagerInterface $entityManager, $id)
    {
        // Je récupère un enregistrement book en BDD grâce au repository de book
        $book = $bookRepository->find($id);

        // j'utilise l'entity manager avec la méthode remove pour enregistrer
        // la suppression du book dans l'unité de travail
        $entityManager->remove($book);

        // je valide la suppression en bdd avec la méthode flush
        $entityManager->flush();

        return $this->redirectToRoute('books');
    }

    /**
     * @Route("books/update/{id}", name="books_update_id")
     * @param BookRepository $bookRepository
     * @param EntityManagerInterface $entityManager
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateBook(BookRepository $bookRepository, EntityManagerInterface $entityManager, $id)
    {
        // (1) récuperer le livre à modif
        // (2) modif le livre
        // (3) le re save

        // (1) j'utilise le repository de l'entité Book pour récupérer un livre en fonction de son "id"
        $book = $bookRepository->find($id);

        // (2) Je donne un new title à mon entité "Book"
        $book->setTitle('Les 11 clés du succès');

        // (3) je re-save mon livre en BDD avec l'entité manager
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('books');
    }

}