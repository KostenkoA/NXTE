<?php

const SPACING_X   = 1;
const SPACING_Y   = 0;
const JOINT_CHAR  = '=';
const LINE_X_CHAR  = '-';
const LINE_Y_CHAR = '|';

$table = array(
    array(
        'House' => 'Baratheon',
        'Sigil' => 'A crowned stag',
        'Motto' => 'Ours is the Fury',
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
function columns_headers($table)
{
    foreach ($table as $array) {
        foreach ($array as $key => $value){
            $headers[] = $key;
        }
    }
    $uniqueHeaders = array_unique($headers);
    asort($uniqueHeaders);
    return $uniqueHeaders;
}

/**
 * determine columns lengths
 * @param $table
 * @param $columns_headers
 * @return array
 */
function columns_lengths($table, $columns_headers)
{
    $lengths = [];
    foreach ($columns_headers as $header) {
        $header_length = strlen($header);
        $max           = $header_length;
        foreach ($table as $row) {
            if (isset($row[$header])) {
                $length = strlen($row[$header]);
                if ($length > $max) {
                    $max = $length;
                }
            }
        }
        if (($max % 2) != ($header_length % 2)) {
            $max += 1;
        }

        $lengths[$header] = $max;
    }

    return $lengths;
}

/**
 * create row separator
 * @param $columns_lengths
 * @param string $line
 * @return string
 */
function row_separator($columns_lengths, $line = JOINT_CHAR)
{
    $row = '';
    foreach ($columns_lengths as $column_length) {
        $row .= str_repeat($line,
            (SPACING_X * 3) + $column_length
        );
    }
    $row .= $line;

    return $row;
}

/**
 * create row spacer
 * @param $columns_lengths
 * @return string
 */
function row_spacer($columns_lengths)
{
    $row = '';
    foreach ($columns_lengths as $column_length) {
        $row .= LINE_Y_CHAR . str_repeat(' ',
                (SPACING_X * 2) + $column_length
            );
    }
    $row .= LINE_Y_CHAR;

    return $row;
}

/**
 * create row headers
 * @param $columns_headers
 * @param $columns_lengths
 * @return string
 */
function row_headers($columns_headers, $columns_lengths)
{
    $row = '';
    foreach ($columns_headers as $header) {
        $row .= LINE_Y_CHAR . str_pad($header,
                (SPACING_X * 2) + $columns_lengths[$header],
                ' ',
                STR_PAD_LEFT
            );
    }
    $row .= LINE_Y_CHAR;

    return $row;
}

/**
 * create row cells
 * @param $row_cells
 * @param $columns_headers
 * @param $columns_lengths
 * @return string
 */
function row_cells($row_cells, $columns_headers, $columns_lengths)
{
    $row = '';
    foreach ($columns_headers as $header) {
        if (isset($row_cells[$header])) {
            $row .= LINE_Y_CHAR . str_repeat(' ',
                    SPACING_X
                ) . str_pad($row_cells[$header],
                    SPACING_X + $columns_lengths[$header],
                    ' ',
                    STR_PAD_LEFT
                );
        }

        else {
            $row .= LINE_Y_CHAR . str_repeat(' ',
                    SPACING_X
                ) . str_pad('',
                    SPACING_X + $columns_lengths[$header],
                    ' ',
                    STR_PAD_LEFT
                );
        }

    }
    $row .= LINE_Y_CHAR;

    return $row;
}
