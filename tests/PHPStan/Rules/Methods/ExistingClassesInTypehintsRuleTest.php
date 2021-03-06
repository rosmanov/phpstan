<?php declare(strict_types = 1);

namespace PHPStan\Rules\Methods;

use PHPStan\Rules\ClassCaseSensitivityCheck;
use PHPStan\Rules\FunctionDefinitionCheck;

class ExistingClassesInTypehintsRuleTest extends \PHPStan\Rules\AbstractRuleTest
{

	protected function getRule(): \PHPStan\Rules\Rule
	{
		$broker = $this->createBroker();
		return new ExistingClassesInTypehintsRule(new FunctionDefinitionCheck($broker, new ClassCaseSensitivityCheck($broker)));
	}

	public function testExistingClassInTypehint()
	{
		$this->analyse([__DIR__ . '/data/typehints.php'], [
			[
				'Return typehint of method TestMethodTypehints\FooMethodTypehints::foo() has invalid type TestMethodTypehints\NonexistentClass.',
				8,
			],
			[
				'Parameter $bar of method TestMethodTypehints\FooMethodTypehints::bar() has invalid typehint type TestMethodTypehints\BarMethodTypehints.',
				13,
			],
			[
				'Parameter $bars of method TestMethodTypehints\FooMethodTypehints::lorem() has invalid typehint type TestMethodTypehints\BarMethodTypehints.',
				28,
			],
			[
				'Return typehint of method TestMethodTypehints\FooMethodTypehints::lorem() has invalid type TestMethodTypehints\BazMethodTypehints.',
				28,
			],
			[
				'Parameter $bars of method TestMethodTypehints\FooMethodTypehints::ipsum() has invalid typehint type TestMethodTypehints\BarMethodTypehints.',
				38,
			],
			[
				'Return typehint of method TestMethodTypehints\FooMethodTypehints::ipsum() has invalid type TestMethodTypehints\BazMethodTypehints.',
				38,
			],
			[
				'Parameter $bars of method TestMethodTypehints\FooMethodTypehints::dolor() has invalid typehint type TestMethodTypehints\BarMethodTypehints.',
				48,
			],
			[
				'Return typehint of method TestMethodTypehints\FooMethodTypehints::dolor() has invalid type TestMethodTypehints\BazMethodTypehints.',
				48,
			],
			[
				'Parameter $parent of method TestMethodTypehints\FooMethodTypehints::parentWithoutParent() has invalid typehint type parent.',
				53,
			],
			[
				'Return typehint of method TestMethodTypehints\FooMethodTypehints::parentWithoutParent() has invalid type parent.',
				53,
			],
			[
				'Parameter $parent of method TestMethodTypehints\FooMethodTypehints::phpDocParentWithoutParent() has invalid typehint type parent.',
				62,
			],
			[
				'Return typehint of method TestMethodTypehints\FooMethodTypehints::phpDocParentWithoutParent() has invalid type parent.',
				62,
			],
			[
				'Class TestMethodTypehints\FooMethodTypehints referenced with incorrect case: TestMethodTypehints\fOOMethodTypehints.',
				67,
			],
			[
				'Class TestMethodTypehints\FooMethodTypehints referenced with incorrect case: TestMethodTypehints\fOOMethodTypehintS.',
				67,
			],
			[
				'Class stdClass referenced with incorrect case: STDClass.',
				76,
			],
			[
				'Class TestMethodTypehints\FooMethodTypehints referenced with incorrect case: TestMethodTypehints\fOOMethodTypehints.',
				76,
			],
			[
				'Class stdClass referenced with incorrect case: stdclass.',
				76,
			],
			[
				'Class TestMethodTypehints\FooMethodTypehints referenced with incorrect case: TestMethodTypehints\fOOMethodTypehintS.',
				76,
			],
		]);
	}

}
