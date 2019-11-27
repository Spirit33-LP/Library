<?php


namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route ("/authors", name="authors")
     */

    //méthode qui permet de faire "un SELECT" en BDD de l'ensemble de mes champs dans ma table Author
    public function AffAuthors(AuthorRepository $authorRepository)
    {

        //J'utilise le repository de author pour pouvoir sélectionner tous les éléments de ma table Author
        //Les repository en général servent à faire les requetes SELECT dans les tables
        $authors = $authorRepository ->findAll();

        //méthode render qui permet d'afficher mon fichier authors.html.twig et le résultat de ma requete SQL
        return $this->render('authors.html.twig', ['authors' =>$authors]);

    }

    /**
     * @Route ("/author/{id}", name="author")
     */

    public function AffAuthor(AuthorRepository $authorRepository, $id)
    {
        $author = $authorRepository ->find($id);

        return $this->render('author.html.twig', ['author' => $author]);
    }

}