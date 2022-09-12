<?php

declare(strict_types=1);

namespace InITWorld\CodeSmells\PrimitiveObsession;

class LogicControlBefore
{
    public function isValid(string $value, string $type): bool
    {
        switch ($type) {
            case 'TaxIdentificationNumber':
                $reg = '/^[0-9]{10}$/';
                if (!preg_match($reg, $value) || $value === '0000000000') {
                    return false;
                }
                $digits = array_map('intval', str_split($value));
                $checkSum = (
                    6 * $digits[0]
                    + 5 * $digits[1]
                    + 7 * $digits[2]
                    + 2 * $digits[3]
                    + 3 * $digits[4]
                    + 4 * $digits[5]
                    + 5 * $digits[6]
                    + 6 * $digits[7]
                    + 7 * $digits[8]
                    ) % 11;

                return $digits[9] === $checkSum;
            case 'REGON':
                $reg = '/^[0-9]{9}$/';
                if (preg_match($reg, $value)) {
                    $digits = array_map('intval', str_split($value));
                    $checksum = (
                            8 * $digits[0]
                            + 9 * $digits[1]
                            + 2 * $digits[2]
                            + 3 * $digits[3]
                            + 4 * $digits[4]
                            + 5 * $digits[5]
                            + 6 * $digits[6]
                            + 7 * $digits[7]
                        ) % 11;
                    if ($checksum == 10) {
                        $checksum = 0;
                    }

                    return $digits[8] === $checksum;
                }
                $reg = '/^[0-9]{14}$/';
                if (preg_match($reg, $value)) {
                    $digits = array_map('intval', str_split($value));
                    $checksum = (
                            2 * $digits[0]
                            + 4 * $digits[1]
                            + 8 * $digits[2]
                            + 5 * $digits[3]
                            + 0 * $digits[4]
                            + 9 * $digits[5]
                            + 7 * $digits[6]
                            + 3 * $digits[7]
                            + 6 * $digits[8]
                            + 1 * $digits[9]
                            + 2 * $digits[10]
                            + 4 * $digits[11]
                            + 8 * $digits[12]
                        ) % 11;
                    if ($checksum == 10) {
                        $checksum = 0;
                    }

                    return $digits[13] === $checksum;
                }

                return false;
            default:
                throw new \InvalidArgumentException("Invalid type");
        }
    }
}
