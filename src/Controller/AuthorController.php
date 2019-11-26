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

    //méthode qui permet de faire "un SELECT" en BDD de l'ensemble de mes champs dans ma table Book
    public function AffAuthors(AuthorRepository $authorRepository)
    {

        //J'utilise le repository de author pour pouvoir sélectionner tous les éléments de ma table book
        //Les repository en général servent à faire les requetes SELECT dans les tables
        $authors = $authorRepository ->findAll();

        //méthode render qui permet d'afficher mon fichier HTML.TWIG et le résultat de ma requete SQL
        return $this->render('author.html.twig', ['authors' =>$authors]);
    }

}