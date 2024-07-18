<?php

namespace App\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use function PHPUnit\Framework\exactly;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('firstWords', [$this, 'firstWords'])
        ];
    }
    public function firstWords(string $text, int $number): string
    {
        return implode(" ", array_slice(explode (" ", $text), 0, $number));
    }
}