<?php


namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route ("/books", name="books")
     */

    //méthode qui permet de faire "un SELECT" en BDD de l'ensemble de mes champs dans ma table Book
    public function AffBooks(BookRepository $bookRepository)
    {

        //J'utilise le repository de book pour pouvoir sélectionner tous les éléments de ma table book
        //Les repository en général servent à faire les requetes SELECT dans les tables
        $books = $bookRepository ->findAll();

        //méthode render qui permet d'afficher mon fichier HTML.TWIG et le résultat de ma requete SQL
        return $this->render('books.html.twig', ['books'=>$books]);

    }

}