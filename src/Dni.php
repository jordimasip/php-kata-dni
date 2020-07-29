<?php
declare(strict_types=1);

namespace KataDni;

use DomainException;
use InvalidArgumentException;

class Dni
{
    private const VALID_DNI_PATTERN = '/^[XYZ\d]\d{7,7}[^UIOÑ\d]$/';
    private const CONTROL_LETTER_MAP = 'TRWAGMYFPDXBNJZSQVHLCKE';
    private const NIE_INITIAL_LETTERS = ['X', 'Y', 'Z'];
    private const NIE_INITIAL_REPLACEMENTS = ['0', '1', '2'];
    private const DIVISOR = 23;

    private string $dni;

    public function __construct(string $dni)
    {
        $this->checkIsValidDni($dni);

        $mod = $this->calculateModulus($dni);

        $letter = substr($dni, -1);

        if ($letter !== self::CONTROL_LETTER_MAP[$mod]) {
            throw new InvalidArgumentException('Invalid dni');
        }

        $this->dni = $dni;
    }

    public function __toString()
    {
        return $this->dni;
    }

    private function checkIsValidDni(string $value): void
    {
        if (!preg_match(self::VALID_DNI_PATTERN, $value)) {
            throw new DomainException('Bad format');
        }
    }

    private function calculateModulus(string $dni): int
    {
        $numeric = substr($dni, 0, -1);
        $number = (int)str_replace(self::NIE_INITIAL_LETTERS, self::NIE_INITIAL_REPLACEMENTS, $numeric);

        return $number % self::DIVISOR;
    }

}