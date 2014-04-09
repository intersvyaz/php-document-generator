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
	 * @param bool $__return__ Return rendered template.
	 * @return string|null
	 */
	public function renderTemplate($__template__, $__data__ = null, $__return__ = false)
	{
		if (is_array($__data__))
			extract($__data__, EXTR_PREFIX_SAME, 'data');
		else
			$data = $__data__;
		if ($__return__) {
			ob_start();
			require($__template__);
			return ob_get_clean();
		} else
			require($__template__);
	}
}