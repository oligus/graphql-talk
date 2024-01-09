<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Custom\Scalars;

use DateTime;
use Exception;
use GraphQL\Error\Error;
use GraphQL\Error\InvariantViolation;
use GraphQL\Language\AST\Node;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\Utils;

class DateType extends ScalarType
{
    use ScalarConfigTrait;

    const DATE_FORMAT = 'Y-m-d';

    public string $name = 'Date';
    public ?string $description = 'The `Date` scalar type represents date in format "YYYY-mm-dd"';

    public function serialize($value): string
    {
        if (!$value instanceof DateTime) {
            throw new InvariantViolation('Date is not an instance of DateTime' . Utils::printSafe($value));
        }

        return $value->format(self::DATE_FORMAT);
    }

    /**
     * @throws Exception
     */
    public function parseValue($value): DateTime
    {
        if (!$this->isValidDateString($value)) {
            throw new Error('Query error: Value is not a valid Date string (YYYY-mm-dd): ' . Utils::printSafe($value));
        }

        return new DateTime($value);
    }

    /**
     * @throws Error
     * @throws Exception
     */
    public function parseLiteral(Node $valueNode, ?array $variables = null): DateTime
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        if (!$this->isValidDateString($valueNode->value)) {
            throw new Error(
                'Query error: Value is not a valid Date string (YYYY-mm-dd): ' . $valueNode->kind,
                [$valueNode]
            );
        }

        return new DateTime($valueNode->value);
    }

    private static function isValidDateString(string $date): bool
    {
        $result = explode('-', $date);

        if (count($result) !== 3) {
            return false;
        }

        $year = (int)$result[0];
        $month = (int)$result[1];
        $day = (int)$result[2];

        return checkdate($month, $day, $year);
    }
}
