<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DeetRepository;
use App\Entity\Deet;
use App\Form\DeetType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Hashtag;
use App\Repository\HashtagRepository;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(Request $request, DeetRepository $deetRepository, HashtagRepository $hashtagRepository)
    {
        $deets = $deetRepository->findAll();

        $deet = new Deet();
        $form = $this->createForm(DeetType::class, $deet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Le contenu de base
            $content = $deet->getContent();

            // Liste des hashtags
            $hashtags = [];

            // Fonction récursive qui trouve les hashtags
            $findHashtag = function ( $string ) use (&$hashtags, &$findHashtag) {

                // Texte après le premier #
                $sousEnsembleApresHashtag = substr($string, strpos($string, "#"));

                // Texte entre le premier # et le premier " " => le hashtag

                $charDeFin = strpos($sousEnsembleApresHashtag, " ") - 1;

                $charDeFin = $charDeFin == -1 ? strlen($sousEnsembleApresHashtag) : $charDeFin;
                $hashtagTrouve = substr($sousEnsembleApresHashtag, 1, $charDeFin);

                $hashtags[] = $hashtagTrouve;

                $newString = substr($sousEnsembleApresHashtag, strpos($sousEnsembleApresHashtag, " ") +1);

                if ( strpos($newString, "#") !== false ) {
                    $findHashtag($newString);
                }
            };

            $findHashtag($content);

            foreach($hashtags as $key => $value) {
                if ($value === '') {
                    unset($hashtags[$key]);
                }
            }

            $em = $this->getDoctrine()->getManager();

            foreach($hashtags as $h) {

                $hashtag = $hashtagRepository->findBy(['title' => $h])[0];

                if (!$hashtag) {
                    $hashtag = new Hashtag();
                    $hashtag->setTitle($h);

                    $em->persist($hashtag);
                    $em->flush();
                }


                $deet->addHashtag($hashtag);
                $em->persist($deet);
                $em->flush();
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($deet);
            $entityManager->flush();
        }

        return $this->render('page/index.html.twig', [
            'deets' => $deets,
            'form' => $form->createView()
        ]);
    }
}