<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase; 
include 'src/FinalResult.php';
include 'tests/ExpectedResults.php';

final class FinalResultTest extends PHPUnit\Framework\TestCase
{
    public function getExpectedResults(){
        $expected_returns = ExpectedResults::$expected_returns;
         return $expected_returns;
    }
    public function testReturnsTheCorrectHash(): void
    {
        $expected_returns = self::getExpectedResults();
        $file = new FinalResult();
        $res = $file->csvToBankHash('tests/support/data_sample.csv');
        unset($res["document"]); 
        $this->assertSame($res, $expected_returns);
    }
}