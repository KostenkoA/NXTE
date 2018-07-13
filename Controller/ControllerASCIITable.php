<?php

require ('./Model/ModelASCIITable.php');

function draw_table($table)
{

    $nl              = "\n";
    $columns_headers = columns_headers($table);
    $columns_lengths = columns_lengths($table, $columns_headers);
    $row_separator   = row_separator($columns_lengths);
    $row_separator_int = row_separator($columns_lengths, LINE_X_CHAR);
    $row_spacer      = row_spacer($columns_lengths);
    $row_headers     = row_headers($columns_headers, $columns_lengths);

    echo $row_separator . $nl;
    echo str_repeat($row_spacer . $nl, SPACING_Y);
    echo $row_headers . $nl;
    echo str_repeat($row_spacer . $nl, SPACING_Y);
    echo $row_separator_int . $nl;
    echo str_repeat($row_spacer . $nl, SPACING_Y);
    foreach ($table as $row_cells) {
        $row_cells = row_cells($row_cells, $columns_headers, $columns_lengths);
        echo $row_cells . $nl;
        echo str_repeat($row_spacer . $nl, SPACING_Y);
    }
    echo $row_separator . $nl;
}




