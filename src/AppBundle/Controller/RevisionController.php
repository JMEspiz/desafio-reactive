<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Pool;
use AppBundle\Entity\Revision;
use AppBundle\Utils\ArrayFilter;

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
			$pattern_question = '/^_q-[0-9]+/';
    	$pattern_answer = '/^_r-[0-9]+/';
    	$data = $this->get('request')->request->all();
    	$keys_raw = array_keys($data);

    	$questions_keys = ArrayFilter::getFilterData($pattern_question, $keys_raw);
    	$answers_keys = ArrayFilter::getFilterData($pattern_answer, $keys_raw);

			$em = $this->getDoctrine()->getManager();
			for($i = 0; $i < count($questions_keys); $i++){
				$revision = new Revision();
				$revision->setQuestion($request->request->get($questions_keys[$i]));
				$revision->setAnswer($request->request->get($answers_keys[$i]));
				$em->persist($revision);
    		$em->flush();
			}

    	return $this->redirectToRoute('pool_index');

    }

    /**
     * Finds and displays a question entity.
     *
     * @Route("/result/{pool}", name="revision_show")
     * @Method("GET")
     */
    public function showAction(Pool $pool)
    {
			$questions = $pool->getQuestions();

			$em = $this->getDoctrine()->getManager();
			$answers = $em->getRepository('AppBundle:Revision')->findAll();

			return $this->render('revision/show.html.twig', [
				'pool' => $pool,
				'questions' => $questions,
				'answers' => $answers
			]);
    }
}
