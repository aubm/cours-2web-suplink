<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Url;
use AppBundle\Form\Type\UrlType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UrlsController extends Controller
{
    public function indexAction()
    {
        $urls_manager = $this->container->get('urls_manager');
        $urls = $urls_manager->getAllUrlsByCriteria();

        return $this->render('AppBundle:urls:index.html.twig', [
            'urls' => $urls
        ]);
    }

    public function showAction($url_id)
    {
        $urls_manager = $this->container->get('urls_manager');
        $url = $urls_manager->getOneUrlByCriteria([
            'id' => intval($url_id)
        ]);

        if ($url === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('AppBundle:urls:show.html.twig', [
            'url' => $url
        ]);
    }

    public function handleAction($shortened_url)
    {
        $urls_manager = $this->container->get('urls_manager');
        $url = $urls_manager->getOneUrlByCriteria([
            'shortened_url' => $shortened_url
        ]);

        if ($url === null || !$url->getActive()) {
            throw new NotFoundHttpException();
        }

        // Increment hits counter
        $url->setHits($url->getHits() + 1);
        $urls_manager->saveUrl($url);

        return new RedirectResponse($url->getOriginalUrl());
    }

    public function editAction($url_id, Request $request)
    {
        $url_id = intval($url_id);
        $urls_manager = $this->container->get('urls_manager');

        if ($url_id === 0) {
            $url = new Url();
            $urls_manager->generateUniqueShortenedTagForUrl($url);
        } else {
            $url = $urls_manager->getOneUrlByCriteria([
                'id' => $url_id
            ]);
            if ($url === null) {
                throw new NotFoundHttpException();
            }
        }

        $url_form = $this->createForm(new UrlType(), $url);

        if ($request->getMethod() === 'POST') {
            $url_form->handleRequest($request);

            if ($url_form->isValid()) {
                $urls_manager->saveUrl($url);
                return $this->redirect($this->generateUrl('app_urls_index'));
            }
        }

        return $this->render('AppBundle:urls:edit.html.twig', [
            'url_form' => $url_form->createView()
        ]);
    }

    public function removeAction(Request $request)
    {
        $url_id = intval($request->get('url_id'));
        if ($url_id === 0) {
            throw new BadRequestHttpException();
        }

        $urls_manager = $this->container->get('urls_manager');
        $urls_manager->findAndRemoveOneUrlById($url_id);

        $this->addFlash('info', 'L\'url a été corectement supprimée');

        return $this->redirect($this->generateUrl('app_urls_index'));
    }
}