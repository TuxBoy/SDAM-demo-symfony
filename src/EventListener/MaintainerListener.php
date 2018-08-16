<?php
namespace App\EventListener;

use Doctrine\DBAL\DBALException;
use PhpDocReader\AnnotationException;
use SDAM\Config;
use SDAM\EntityAdapter\EntityAdapter;
use SDAM\Maintainer;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class MaintainerListener
 *
 * @package App\EventListener
 */
class MaintainerListener
{

	/**
	 * @var KernelInterface
	 */
	private $kernel;

	/**
	 * MaintainerListener constructor.
	 * @param KernelInterface $kernel
	 */
	public function __construct(KernelInterface $kernel)
	{
		$this->kernel = $kernel;
	}

	/**
	 * @param FilterControllerEvent $event
	 * @throws AnnotationException
	 * @throws DBALException
	 * @throws \ReflectionException
	 * @throws \Throwable
	 */
	public function onKernelController(FilterControllerEvent $event)
	{
		Config::current()->configure([
			Config::ENV_FILE    => dirname($this->kernel->getRootDir()),
			Config::ENTITY_PATH => 'App\Entity'
		]);
		$maintainer = new Maintainer([], new EntityAdapter(dirname(__DIR__) . '/Entity'));
		$maintainer->run();
	}

}