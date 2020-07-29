<?php
declare(strict_types=1);

namespace Tests\KataDni;

use KataDni\Dni;
use PHPUnit\Framework\TestCase;
use DomainException;
use InvalidArgumentException;

class Test extends TestCase
{
    public function testShouldFailWhenDniShorterThanCorrect()
    {
        $this->expectException(DomainException::class);
        $dni = new Dni('12345');
    }

    public function testShouldFailWhenDniLargerThanCorrect()
    {
        $this->expectException(DomainException::class);
        $dni = new Dni('12345678900000');
    }

    public function testShouldFailWhenEndsWithANumber(): void
    {
        $this->expectException(DomainException::class);
        $dni = new Dni('771511230');
    }

    public function testShouldFailWhenEndsWithAnInvalidLetter(): void
    {
        $this->expectException(DomainException::class);
        $dni = new Dni('77151123U');
    }

    public function testShouldFailWhenLettersInTheMiddle(): void
    {
        $this->expectException(DomainException::class);
        $dni = new Dni('771EG123R');
    }

    public function testShouldFailWhenDniStartsWithALetterOtherThanXYZ(): void
    {
        $this->expectException(DomainException::class);
        $dni = new Dni('E7147123R');
    }

    public function testShouldFailWhenInvalidDni(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $dni = new Dni('00000000S');
    }

    public function testShouldConstructValidDniEndingWithT(): void
    {
        $dni = new Dni('00000000T');
        $this->assertEquals('00000000T', (string) $dni);
    }

    public function testShouldConstructValidDniEndingWithR(): void
    {
        $dni = new Dni('00000001R');
        $this->assertEquals('00000001R', (string) $dni);
    }

    public function testShouldConstructValidDNIEndingWithW() : void
    {
        $dni = new Dni('00000002W');
        $this->assertEquals('00000002W', (string) $dni);
    }

    public function testShouldConstructValidNIEStartingWithX() : void
    {
        $dni = new Dni('Y0000000Z');
        $this->assertEquals('Y0000000Z', (string) $dni);
    }

    public function testShouldConstructValidNIE() : void
    {
        $dni = new Dni('80347773X');
        $this->assertEquals('80347773X', (string) $dni);
    }
}
