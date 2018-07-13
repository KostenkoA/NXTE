<?php

const LINE_T_B    = '=';
const LINE_X      = '-';
const LINE_Y      = '|';
const SPACING_X   = 1;
const SPACING_Y   = 0;


$table = array(
    array(
        'House' => 'Baratheon',
        'Sigil' => 'A crowned stag',
        'Motto' => 'Ours is the Fury, sdsaaddsadas, sdadasdasd',
    ),
    array(
        'Leader' => 'Eddard Stark',
        'House' => 'Stark',
        'Motto' => 'Winter is Coming',
        'Sigil' => 'A grey direwolf'
    ),
    array(
        'House' => 'Lannister',
        'Leader' => 'Tywin Lannister',
        'Sigil' => 'A golden lion'

    ),
    array(
        'Q' => 'Z',
        'am@gmail.com' => 525
    )
);

/**
 * select unique keys and sort the array
 * @param $table
 * @return array
 */
function columnsHeaders($table)
{
    foreach ($table as $array) {
        foreach ($array as $key => $value){
            $headers[] = $key;
        }
    }
    $uniqueHeaders = \array_unique($headers);
    \asort($uniqueHeaders);
    return $uniqueHeaders;
}

/**
 * determine columns lengths
 * @param $table
 * @param $columnsHeaders
 * @return array
 */
function columnsLengths($table, $columnsHeaders)
{
    $lengths = [];
    foreach ($columnsHeaders as $header) {
        $headerLength = \strlen($header);
        $max           = $headerLength;
        foreach ($table as $row) {
            if (isset($row[$header])) {
                $length = \strlen($row[$header]);
                if ($length > $max) {
                    $max = $length;
                }
            }
        }
        if (($max % 2) != ($headerLength % 2)) {
            $max += 1;
        }

        $lengths[$header] = $max;
    }

    return $lengths;
}

/**
 * create row separator
 * @param $columnsLengths
 * @param string $line
 * @return string
 */
function rowSeparator($columnsLengths, $line = LINE_T_B)
{
    $row = '';
    foreach ($columnsLengths as $columnLength) {
        $row .= \str_repeat($line,
            (SPACING_X * 3) + $columnLength
        );
    }
    $row .= $line;

    return $row;
}

/**
 * create row spacer
 * @param $columnsLengths
 * @return string
 */
function rowSpacer($columnsLengths)
{
    $row = '';
    foreach ($columnsLengths as $columnLength) {
        $row .= LINE_Y . \str_repeat(' ',
                (SPACING_X * 2) + $columnLength
            );
    }
    $row .= LINE_Y;

    return $row;
}

/**
 * create row headers
 * @param $columnsHeaders
 * @param $columnsLengths
 * @return string
 */
function rowHeaders($columnsHeaders, $columnsLengths)
{
    $row = '';
    foreach ($columnsHeaders as $header) {
        $row .= LINE_Y . \str_pad($header,
                (SPACING_X * 2) + $columnsLengths[$header],
                ' ',
                STR_PAD_LEFT
            );
    }
    $row .= LINE_Y;

    return $row;
}

/**
 * create row cells
 * @param $rowCells
 * @param $columnsHeaders
 * @param $columnsLengths
 * @return string
 */
function rowCells($rowCells, $columnsHeaders, $columnsLengths)
{
    $row = '';
    foreach ($columnsHeaders as $header) {
        if (isset($rowCells[$header])) {
            $row .= LINE_Y . \str_repeat(' ',
                    SPACING_X
                ) . \str_pad($rowCells[$header],
                    SPACING_X + $columnsLengths[$header],
                    ' ',
                    STR_PAD_LEFT
                );
        }

        else {
            $row .= LINE_Y . \str_repeat(' ',
                    SPACING_X
                ) . str_pad('',
                    SPACING_X + $columnsLengths[$header],
                    ' ',
                    STR_PAD_LEFT
                );
        }

    }
    $row .= LINE_Y;

    return $row;
}
