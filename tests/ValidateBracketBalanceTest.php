<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tris\PhpBrackets\Bracket;

class ValidateBracketBalanceTest extends TestCase
{
    public function test_brackets_is_balance(): void
    {
        $roundBracket = new Bracket('(())(())()');
        $curlyBracket = new Bracket('{{}}{}{}{{}}');
        $squareBracket = new Bracket('[] [[ [] ]] [[]] []');

        $this->assertTrue($roundBracket->isBalance());
        $this->assertEquals(5, $roundBracket->count());
        $this->assertCount(5, $roundBracket->getPairings('round'));
        $this->assertSame(['()', '()', '()', '()', '()'], $roundBracket->getPairings('round'));

        $this->assertTrue($curlyBracket->isBalance());
        $this->assertEquals(6, $curlyBracket->count());
        $this->assertCount(6, $curlyBracket->getPairings('curly'));
        $this->assertSame(['{}', '{}', '{}', '{}', '{}', '{}'], $curlyBracket->getPairings('curly'));

        $this->assertTrue($squareBracket->isBalance());
        $this->assertEquals(7, $squareBracket->count());
        $this->assertCount(7, $squareBracket->getPairings('square'));
        $this->assertSame(['[]', '[]', '[]', '[]', '[]', '[]', '[]'], $squareBracket->getPairings('square'));
    }

    public function test_combination_brackets(): void
    {
        $bracket1 = new Bracket('[()]{}{[()()]()}');
        $bracket2 = new Bracket('[(])');

        $this->assertTrue($bracket1->isBalance());
        $this->assertEquals(8, $bracket1->count());
        $this->assertCount(4, $bracket1->getPairings('round'));
        $this->assertCount(2, $bracket1->getPairings('curly'));
        $this->assertCount(2, $bracket1->getPairings('square'));
        $this->assertSame([
            'round' => ['()', '()', '()', '()'],
            'curly' => ['{}', '{}'],
            'square' => ['[]', '[]']
        ], $bracket1->getPairings());

        $this->assertFalse($bracket2->isBalance());
        $this->assertEquals(0, $bracket2->count());
        $this->assertCount(0, $bracket2->getPairings('round'));
        $this->assertCount(0, $bracket2->getPairings('curly'));
        $this->assertCount(0, $bracket2->getPairings('square'));
        $this->assertSame(['round' => [], 'curly' => [], 'square' => []], $bracket2->getPairings());
    }
}
