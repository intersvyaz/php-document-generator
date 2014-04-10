<?php

namespace Intersvyaz\DocumentGenerator;

abstract class AbstractDocument implements DocumentInterface
{
	/**
	 * @var string
	 */
	public $layout;

	/**
	 * @var array Options.
	 */
	public $options;

	/**
	 * Document templates to be rendered.
	 * @var array
	 */
	protected $templates = [];

	/**
	 * @inheritdoc
	 */
	public function __construct($layout = '', $options = '')
	{
		// default layout
		if (empty($layout))
			$this->layout = __DIR__ . '/layouts/default.php';

		$this->options = $options;
	}

	/**
	 * @inheritdoc
	 */
	public function addTemplate($template, $data = null)
	{
		$this->templates[] = ['template' => $template, 'data' => $data];

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function addText($text)
	{
		$this->templates[] = $text;

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function reset()
	{
		$this->templates = [];
	}

	/**
	 * @param string $__template__ Template file path.
	 * @param mixed $__data__ Template data.
	 * @return string
	 */
	protected function renderTemplate($__template__, $__data__ = null)
	{
		if (is_array($__data__))
			extract($__data__, EXTR_PREFIX_SAME, 'data');
		else
			$data = $__data__;

		ob_start();
		require($__template__);

		return ob_get_clean();
	}

	/**
	 * @param string $layout
	 * @param array $templates
	 * @return string
	 */
	protected function renderInternal($layout, $templates)
	{
		$html = '';
		foreach ($templates as $template) {
			if (is_array($template))
				$html .= $this->renderTemplate($template['template'], $template['data']);
			else
				$html .= $template;
		}

		$html = $this->renderTemplate($layout, ['content' => $html]);

		return $this->inlineCss($html);
	}

	/**
	 * @param string $html
	 * @return string
	 */
	protected function inlineCss($html)
	{
		// inline css
		return preg_replace_callback(
			'/<\s*link\s+rel\s*=\s*["\']stylesheet["\']\s+href\s*=\s*["\'](.+?)["\']\s*>/im',
			function ($m) {
				return '<style type="text/css">' . file_get_contents($m[1]) . '</style>';
			},
			$html
		);
	}
}