<?php

declare(strict_types=1);

namespace InITWorld\Tests\CodeSmells\PrimitiveObsession;

use InvalidArgumentException;
use InITWorld\CodeSmells\PrimitiveObsession\LogicControlBefore;
use PHPUnit\Framework\TestCase;

class LogicControlBeforeTest extends TestCase
{
    public function setUp(): void
    {
        $this->service = new LogicControlBefore();
    }

    public function getValidTax(): array
    {
        return [
            ['1370311804'],
            ['6650484135'],
            ['8654034708'],
            ['8728865996'],
            ['7088643699'],
            ['2115071478'],
            ['4944727501'],
            ['4104802666'],
            ['6035347957'],
            ['3465561700']
        ];
    }

    /**
     * @dataProvider getValidTax
     */
    public function testValidTax(string $value): void
    {
        $this->assertTrue($this->service->isValid($value, 'TaxIdentificationNumber'));
    }

    public function getInvalidTax(): array
    {
        return [
            ['0000000000'],
            ['null'],
            ['TEXT'],
            ['8728865992'],
            ['7088643690'],
            ['21150714778'],
            ['4944727508'],
            ['4104802663'],
            ['6035347952'],
            ['4091486964']
        ];
    }

    /**
     * @dataProvider getInvalidTax
     */
    public function testInvalidTax(string $value): void
    {
        $this->assertFalse($this->service->isValid($value, 'TaxIdentificationNumber'));
    }

    public function getValidRegon(): array
    {
        return [
            ['821032094'],
            ['492840084'],
            ['515608823'],
            ['009999471'],
            ['267588437'],
            ['10467202996958'],
            ['72055798122319'],
            ['01907308534408'],
            ['75371229852405'],
            ['38956224525990']
        ];
    }

    /**
     * @dataProvider getValidRegon
     */
    public function testValidRegon(string $value): void
    {
        $this->assertTrue($this->service->isValid($value, 'REGON'));
    }

    public function getInvalidRegon(): array
    {
        return [
            ['TEST'],
            ['null'],
            ['82103209'],
            ['821032093'],
            ['492840085'],
            ['515608827'],
            ['009999478'],
            ['267588438'],
            ['1046720299695'],
            ['10467202996959'],
            ['72055798122310'],
            ['01907308534400'],
            ['75371229852403'],
            ['38956224525991']
        ];
    }

    /**
     * @dataProvider getInvalidRegon
     */
    public function testInvalidRegon(string $value): void
    {
        $this->assertFalse($this->service->isValid($value, 'REGON'));
    }

    public function testUnexpectedType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->service->isValid("123", 'test');
    }
}
