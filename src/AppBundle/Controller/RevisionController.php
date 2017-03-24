<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Pool;

/**
 * Question controller.
 *
 * @Route("/revision")
 */
class RevisionController extends Controller
{
	 /**
     * Lists all question entities.
     *
     * @Route("/list/{pool}", name="revision_index")
     * @Method("GET")
     */
    public function indexAction(Pool $pool)
    {
        $questions = $pool->getQuestions();
        return $this->render('revision/index.html.twig', array(
            'pool' => $pool,
            'questions' => $questions,
        ));
    }

    /**
     * Creates a new question entity.
     *
     * @Route("/new", name="revision_new")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
    	$data = $this->get('request')->request->all();
    	$keys_raw = array_keys($data);
    	$pool = $request->request->get('_pool');

    	$a = [];
    	$b = [];

    	$patron_preguntas = '/^_q-[0-9]+/';
    	$patron_respuestas = '/^_r-[0-9]+/';

    	foreach ($keys_raw as $key) {
    		$output = preg_match($patron_preguntas, $key, $coincidencia);

            if($output){
    		  array_push($a, $coincidencia);
            }
    	}

        foreach ($keys_raw as $value) {
            $output = preg_match($patron_respuestas, $value, $coincidencia);

            if($output){
              array_push($b, $coincidencia);
            }
        }
    	
    	

    	return null;
       
    }

    /**
     * Finds and displays a question entity.
     *
     * @Route("/{id}", name="revision_show")
     * @Method("GET")
     */
    public function showAction(Revesion $question)
    {
        
    }


    /**
     * Creates a form to delete a question entity.
     *
     * @param Question $question The question entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Question $question)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('question_delete', array('id' => $question->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
