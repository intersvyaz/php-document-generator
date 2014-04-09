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
		if (!$captureOutput) {
			$name = $name . static::FILE_EXTENSION;
			header('Content-disposition: inline; filename="' . $name . '"');
			header('Cache-Control: public, must-revalidate, max-age=0');
			header('Pragma: public');
			header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		}

		return $this->renderInternal($this->templates, $captureOutput);
	}

	/**
	 * @inheritdoc
	 */
	public function save($fileName)
	{
		$doc = $this->renderInternal($this->templates, true);
		file_put_contents($fileName, $doc);
	}

	/**
	 * @param $templates
	 * @param $captureOutput
	 * @return string
	 */
	protected function renderInternal($templates, $captureOutput)
	{
		// render html
		$html = '';
		foreach ($templates as $template) {
			if (is_array($template))
				$html .= $this->renderTemplate($template['template'], $template['data'], true);
			else
				$html .= $template;
		}

		return $this->renderTemplate($this->layout, ['content' => $html], $captureOutput);
	}
}