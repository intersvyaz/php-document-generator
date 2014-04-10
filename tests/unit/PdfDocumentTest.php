<?php

namespace Intersvyaz\DocumentGenerator\Tests\Unit;

use Intersvyaz\DocumentGenerator\PdfDocument;

class PdfDocumentTest extends \PHPUnit_Framework_TestCase
{
	public function testExamples()
	{
		$outputFile = __DIR__ . '/example_ru.pdf';

		$doc = new PdfDocument();
		$doc->addTemplate(__DIR__ . '/../../examples/example_ru.php')
			->addText('<div class="page-break"></div>')
			->addTemplate(__DIR__ . '/../../examples/example_addin_ru.php')
			->save($outputFile);
		unlink($outputFile);
	}
}