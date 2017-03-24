<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pool;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Pool controller.
 *
 * @Route("pool")
 */
class PoolController extends Controller
{
    /**
     * Lists all pool entities.
     *
     * @Route("/", name="pool_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pools = $em->getRepository('AppBundle:Pool')->findAll();

        return $this->render('pool/index.html.twig', [
            'pools' => $pools,
        ]);
    }

    /**
     * Creates a new pool entity.
     *
     * @Route("/new", name="pool_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pool = new Pool();
        $form = $this->createForm('AppBundle\Form\PoolType', $pool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pool);
            $em->flush($pool);
            return $this->redirectToRoute('pool_show', array('id' => $pool->getId()));
        }

        return $this->render('pool/new.html.twig', array(
            'pool' => $pool,
            'form' => $form->createView()
        ));
    }

    /**
     * Finds and displays a pool entity.
     *
     * @Route("/{id}", name="pool_show")
     * @Method("GET")
     */
    public function showAction(Pool $pool)
    {
        $deleteForm = $this->createDeleteForm($pool);

        return $this->render('pool/show.html.twig', array(
            'pool' => $pool,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pool entity.
     *
     * @Route("/{id}/edit", name="pool_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pool $pool)
    {
        $deleteForm = $this->createDeleteForm($pool);
        $editForm = $this->createForm('AppBundle\Form\PoolType', $pool);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pool_edit', array('id' => $pool->getId()));
        }

        return $this->render('pool/edit.html.twig', array(
            'pool' => $pool,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pool entity.
     *
     * @Route("/{id}", name="pool_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pool $pool)
    {
        $form = $this->createDeleteForm($pool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pool);
            $em->flush();
        }

        return $this->redirectToRoute('pool_index');
    }

    /**
     * Creates a form to delete a pool entity.
     *
     * @param Pool $pool The pool entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pool $pool)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pool_delete', array('id' => $pool->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
