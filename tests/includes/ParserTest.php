<?php
namespace Redaxscript\Tests;

use Redaxscript\Language;
use Redaxscript\Parser;
use Redaxscript\Registry;

/**
 * ParserTest
 *
 * @since 2.1.0
 *
 * @package Redaxscript
 * @category Tests
 * @author Henry Ruhs
 */

class ParserTest extends TestCase
{
	/**
	 * instance of the registry class
	 *
	 * @var object
	 */

	protected $_registry;

	/**
	 * instance of the language class
	 *
	 * @var object
	 */

	protected $_language;
	/**
	 * setUp
	 *
	 * @since 2.1.0
	 */

	protected function setUp()
	{
		$this->_registry = Registry::getInstance();
		$this->_language = Language::getInstance();
	}

	/**
	 * providerParser
	 *
	 * @since 2.1.0
	 *
	 * @return array
	 */

	public function providerParser()
	{
		return $this->getProvider('tests/provider/parser.json');
	}

	/**
	 * testParser
	 *
	 * @since 2.1.0
	 *
	 * @param array $registry
	 * @param string $input
	 * @param string $route
	 * @param string $expect
	 *
	 * @dataProvider providerParser
	 */

	public function testParser($registry = array(), $input = null, $route = null, $expect = null)
	{
		/* setup */

		$this->_registry->init($registry);
		$parser = new Parser($this->_registry, $this->_language);
		$parser->init($input, $route, array(
			'className' => array(
				'break' => 'link-read-more',
				'code' => 'box-code'
			)
		));

		/* actual */

		$actual = $parser->getOutput();

		/* compare */

		$this->assertEquals($expect, $actual);
	}
}
