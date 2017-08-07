<?php
/**
 * Created by PhpStorm.
 * User: Przemo
 * Date: 2017-08-07
 * Time: 11:32
 */

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RedditController extends Controller
{
    /**
     * @Route("/", name="list")
     */
    public function listAction() {

//        WSZYSTKIE REKORDY Z TABELI
//        $posts = $this->getDoctrine()->getRepository('AppBundle:RedditPost')->findAll();
//        DWA PONIŻSZE PRZYKŁADY POSZCZEGÓLNE REKORDY Z TBELI
//        $posts = $this->getDoctrine()->getRepository('AppBundle:RedditPost')->find(1);
//        $posts = $this->getDoctrine()->getRepository('AppBundle:RedditPost')->findOneBy([
//           'id' => [3]
//        ]);
        $posts = $this->getDoctrine()->getRepository('AppBundle:RedditPost')->findBy([
           'id' => [1,2]
        ]);

        dump($posts);

        return $this->render('reddit/index.html.twig', [
            'posts' => $posts
        ]);
    }
}