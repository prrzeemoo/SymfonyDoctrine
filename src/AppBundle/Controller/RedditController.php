<?php
/**
 * Created by PhpStorm.
 * User: Przemo
 * Date: 2017-08-07
 * Time: 11:32
 */

namespace AppBundle\Controller;

use AppBundle\Entity\RedditPost;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RedditController extends Controller
{
    /**
     * @Route("/", name="list")
     */
    public function listAction()
    {
//        WSZYSTKIE REKORDY Z TABELI
        $posts = $this->getDoctrine()->getRepository('AppBundle:RedditPost')->findAll();
//        DWA PONIŻSZE PRZYKŁADY POSZCZEGÓLNE REKORDY Z TBELI
//        $posts = $this->getDoctrine()->getRepository('AppBundle:RedditPost')->find(1);
//        $posts = $this->getDoctrine()->getRepository('AppBundle:RedditPost')->findOneBy([
//           'id' => [3]
//        ]);
//        $posts = $this->getDoctrine()->getRepository('AppBundle:RedditPost')->findBy([
//           'id' => [1,2]
//        ]);

//        dump($posts);

        return $this->render('reddit/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/create/{text}", name="create")
     */
    public function createAction($text)
    {
        $en = $this->getDoctrine()->getManager();

        $post = new RedditPost();
        $post->setTitle('hello ' . $text);

//        PERSIST WYMAGANY TYLKO W PRZYPAKU TWORZENIA NOWEGO OBIEKTU
        $en->persist($post);
        $en->flush();

        return $this->redirectToRoute('list');
    }

    /**
     * @Route("/update/{id}/{text}", name="update")
     */
    public function updateAction($id, $text)
    {
        $en = $this->getDoctrine()->getManager();

        $post = $en->getRepository('AppBundle:RedditPost')->find($id);

        if (!$post)
        {
            throw $this->createNotFoundException('thats not a record');
        }

        /**
         * @var $post RedditPost
         */
        $post->setTitle('updated title ' . $text);

        $en->flush();

        return $this->redirectToRoute('list');
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAction($id)
    {
        $en = $this->getDoctrine()->getManager();

        $post = $en->getRepository('AppBundle:RedditPost')->find($id);

        if (!$post)
        {
            return $this->redirectToRoute('list');
        }

        $en->remove($post);
        $en->flush();

        return $this->redirectToRoute('list');
    }
}