<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 * @Route("/blog")
 */
class BlogController
{

	/**
	 * @Route("/")
	 */
	public function index(): Response
	{
		return new Response("Un test");
	}

}