<?php namespace App\Services;


class Reports {

    public function spread($sqlquery,$name,$head)
    {

        header( "Content-type: application/octet-stream");
        header( "Content-Disposition: attachment; filename=\"Reporte".$name . '_'.time( ) . ".csv\"");
        $data = "Reporte\n";
        $data = $data.$head."\n";
        foreach( $sqlquery as $row) {
            foreach( $row as $field) {
                $data .= $field.";";
            }
            $data .= "\n";
        }
        echo $data;
        die( );

    }
} 