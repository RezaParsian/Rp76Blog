<?php

/**
 * @param string $titleRegex
 * @param string $html
 * @param $matches
 * @return mixed
 */
function checkRegex(string $titleRegex, string $html)
{
    preg_match_all($titleRegex, $html, $matches, PREG_SET_ORDER, 0);
    return $matches;
}

function titleScore($html): int
{
    $titleRegex = '/<title>(.*?)<\/title>/ms';
    $matches = checkRegex($titleRegex, $html);

    $mache = end($matches);
    $mache = end($mache);

    return strlen($mache) <= 60 ? 10 : 7;
}

function descriptionScore($html): int
{
    $descriptionRegex = '/<meta.*?name="description".*?content="(.*?)".*?>/ms';
    $matches = checkRegex($descriptionRegex, $html);

    $mache = end($matches);
    $mache = end($mache);

    return strlen($mache) <= 160 ? 10 : 7;
}

function viewPortScore($html): int
{
    $viewPortRegex = '/<meta name="viewport" content=".*?">/ms';
    $matches = checkRegex($viewPortRegex, $html);

    return count($matches) > 0 ? 10 : 0;
}

function robotsScore($html): int
{
    $robotsRegex = '/<meta name="robots" content=".*?">/ms';
    $matches = checkRegex($robotsRegex, $html);

    return count($matches) > 0 ? 10 : 0;
}

function charSetScore($html): int
{
    $charSetRegex = '/<meta.*?charset=".*?".*?>/ms';
    $matches = checkRegex($charSetRegex, $html);

    return count($matches) > 0 ? 10 : 0;
}

function headerScore($html): int
{
    $headerRegex = '/<header.*?>.*?<.*?\/header>/ms';
    $matches = checkRegex($headerRegex, $html);

    return count($matches) * 10;
}

function sectionScore($html): int
{
    $sectionRegex = '/<section.*?>.*?<.*?\/section>/ms';
    $matches = checkRegex($sectionRegex, $html);

    return count($matches) * 10;
}

function footerScore($html): int
{
    $footerRegex = '/<footer.*?>.*?<.*?\/footer>/ms';
    $matches = checkRegex($footerRegex, $html);

    return count($matches) * 10;
}

function h1Score($html): int
{
    $h1HeaderRegex = '/<h1.*?>.*?<.*?\/h1>/ms';
    $matches = checkRegex($h1HeaderRegex, $html);

    return count($matches) == 1 ? 10 : 7;
}

function h2Score($html)
{
    $h2HeaderRegex = '/<h2.*?>.*?<.*?\/h2>/ms';
    $matches = checkRegex($h2HeaderRegex, $html);

    return count($matches) > 0 ? 5 : 0;
}

function h3Score($html)
{
    $h3HeaderRegex = '/<h3.*?>.*?<.*?\/h3>/ms';
    $matches = checkRegex($h3HeaderRegex, $html);

    return count($matches) > 0 ? 5 : 0;
}

function seoScore(string $html): int
{
    $score = 0;

    $score += titleScore($html);
    $score += descriptionScore($html);
    $score += viewPortScore($html);
    $score += robotsScore($html);
    $score += charSetScore($html);
    $score += headerScore($html);
    $score += sectionScore($html);
    $score += footerScore($html);
    $score += h1Score($html);
    $score += h2Score($html);
    $score += h3Score($html);

    return $score;
}