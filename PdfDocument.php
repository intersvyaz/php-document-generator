<?php

namespace Intersvyaz\DocumentGenerator;

/**
 * Pdf document generator.
 */
class PdfDocument extends AbstractDocument
{
	// default file extension.
	const FILE_EXTENSION = 'pdf';

	// mPDF constants.
	const DEFAULT_LANGUAGE = 'en';
	const DEFAULT_PAGE_FORMAT = 'A4';
	const DEFAULT_FONT = 'times';
	const DEFAULT_FONT_SIZE = 0;
	const DEFAULT_MARGIN = 0;
	const DEFAULT_ORIENTATION = 'P';
	const OUTPUT_TO_BROWSER = 'I';
	const OUTPUT_TO_DOWNLOAD = 'D';
	const OUTPUT_TO_FILE = 'F';
	const OUTPUT_TO_STRING = 'S';

	/**
	 * @var \mPDF
	 */
	public $mpdf;

	/**
	 * @inheritdoc
	 */
	public function __construct($layout = '', $options = [])
	{
		parent::__construct($layout, $options);

		$this->mpdf = $this->createMpdfInstance($options);
	}

	/**
	 * @inheritdoc
	 */
	public function render($name, $captureOutput = false)
	{
		$html = $this->renderInternal($this->layout, $this->templates);
		$this->mpdf->WriteHTML($html);

		return $this->mpdf->Output(
			$name . '.' . static::FILE_EXTENSION,
			$captureOutput ? static::OUTPUT_TO_STRING : static::OUTPUT_TO_BROWSER
		);
	}

	/**
	 * @inheritdoc
	 */
	public function save($fileName)
	{
		$html = $this->renderInternal($this->layout, $this->templates);
		$this->mpdf->WriteHTML($html);
		$this->mpdf->Output($fileName, static::OUTPUT_TO_FILE);
	}

	/**
	 * @inheritdoc
	 */
	public function reset()
	{
		parent::reset();
		$this->mpdf = $this->createMpdfInstance($this->options);
	}

	/**
	 * @param array $options Options for mPDF.
	 * @return \mPDF
	 */
	protected function createMpdfInstance($options)
	{
		$tempDir = sys_get_temp_dir() . '/mpdf';
		is_dir($tempDir) or mkdir($tempDir);
		defined('_MPDF_TEMP_PATH') or define('_MPDF_TEMP_PATH', $tempDir);

		$mpdf = new \mPDF(
			isset($options['lang']) ? $options['lang'] : static::DEFAULT_LANGUAGE,
			isset($options['format']) ? $options['format'] : static::DEFAULT_PAGE_FORMAT,
			isset($options['fontSize']) ? $options['fontSize'] : static::DEFAULT_FONT_SIZE,
			isset($options['font']) ? $options['font'] : static::DEFAULT_FONT,
			isset($options['marginLeft']) ? $options['marginLeft'] : static::DEFAULT_MARGIN,
			isset($options['marginRight']) ? $options['marginRight'] : static::DEFAULT_MARGIN,
			isset($options['marginTop']) ? $options['marginTop'] : static::DEFAULT_MARGIN,
			isset($options['marginBottom']) ? $options['marginBottom'] : static::DEFAULT_MARGIN,
			isset($options['marginHeader']) ? $options['marginHeader'] : static::DEFAULT_MARGIN,
			isset($options['marginFooter']) ? $options['marginFooter'] : static::DEFAULT_MARGIN,
			isset($options['orientation']) ? $options['orientation'] : static::DEFAULT_ORIENTATION
		);
		$mpdf->SetDisplayMode('fullpage', 'two');
		$mpdf->SetProtection(['copy', 'print', 'print-highres'], null, uniqid(), 128);

		return $mpdf;
	}
}