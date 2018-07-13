<?php

require ('./Model/ModelASCIITable.php');

function drawTable($table)
{

    $nl                 = "\n";
    $columnsHeaders     = columnsHeaders($table);
    $columnsLengths     = columnsLengths($table, $columnsHeaders);
    $rowSeparator       = rowSeparator($columnsLengths);
    $rowSeparator_int   = rowSeparator($columnsLengths, LINE_X);
    $rowSpacer          = rowSpacer($columnsLengths);
    $rowHeaders         = rowHeaders($columnsHeaders, $columnsLengths);

    echo $rowSeparator . $nl;
    echo \str_repeat($rowSpacer . $nl, SPACING_Y);
    echo $rowHeaders . $nl;
    echo \str_repeat($rowSpacer . $nl, SPACING_Y);
    echo $rowSeparator_int . $nl;
    echo \str_repeat($rowSpacer . $nl, SPACING_Y);
    foreach ($table as $rowCells) {
        $rowCells = rowCells($rowCells, $columnsHeaders, $columnsLengths);
        echo $rowCells . $nl;
        echo \str_repeat($rowSpacer . $nl, SPACING_Y);
    }
    echo $rowSeparator . $nl;
}




