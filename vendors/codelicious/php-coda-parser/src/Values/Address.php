<?php

namespace Codelicious\Coda\Values;

use function Codelicious\Coda\Helpers\trimSpace;

class Address
{
	/** @var string */
	private $value;
	
	public function __construct(string $value)
	{
		$this->value = $value;
	}
	
	public function getValue(): string
	{
		return $this->value;
	}
}