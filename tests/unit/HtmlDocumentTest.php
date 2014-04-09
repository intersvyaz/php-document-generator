<?php

namespace Intersvyaz\DocumentGenerator\Tests\Unit;

use Intersvyaz\DocumentGenerator\HtmlDocument;

class HtmlDocumentTest extends \PHPUnit_Framework_TestCase
{
	public function testExamples()
	{
		$outputFile = __DIR__ . '/example_ru.html';

		$doc = new HtmlDocument();
		$doc->addTemplate(__DIR__ . '/../../examples/example_ru.php')
			->addText('<div class="page-break"></div>')
			->addTemplate(__DIR__ . '/../../examples/example_addin_ru.php')
			->save($outputFile);
		unlink($outputFile);
	}
}