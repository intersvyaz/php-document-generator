<?php

namespace Intersvyaz\DocumentGenerator;

/**
 * Html document generator.
 */
class HtmlDocument extends AbstractDocument
{
	// default file extension.
	const FILE_EXTENSION = 'html';

	/**
	 * @inheritdoc
	 */
	public function render($name, $captureOutput = false)
	{
		$doc = $this->renderInternal($this->layout, $this->templates);

		if (!$captureOutput) {
			$name = $name . static::FILE_EXTENSION;
			header('Content-disposition: inline; filename="' . $name . '"');
			header('Cache-Control: public, must-revalidate, max-age=0');
			header('Pragma: public');
			header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
			echo $doc;
			return null;
		} else {
			return $doc;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function save($fileName)
	{
		$doc = $this->renderInternal($this->layout, $this->templates);
		file_put_contents($fileName, $doc);
	}
}