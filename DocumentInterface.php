<?php

namespace Intersvyaz\DocumentGenerator;

interface DocumentInterface
{
	/**
	 * Constructor.
	 * @param string $layout Layout file path.
	 * @param array $options Options.
	 */
	function __construct($layout = '', $options = []);

	/**
	 * @param string $template Path to template file.
	 * @param mixed $data Data passed to template.
	 * @return self
	 */
	function addTemplate($template, $data = null);

	/**
	 * Add text or html fragment.
	 * @param string $text Text to add.
	 * @return self
	 */
	function addText($text);

	/**
	 * @param string $name Document name.
	 * @param bool $captureOutput Capture output and return it.
	 * @return null|string Captured output.
	 */
	function render($name, $captureOutput = false);

	/**
	 * Save document to file.
	 * @param string $filePath
	 */
	function save($filePath);

	/**
	 * Reset internal state.
	 */
	function reset();
}