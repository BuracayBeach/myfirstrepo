<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Safeguard {
    private function array_ready_for_query($data){
        foreach($data as &$e){
            $e = mysql_real_escape_string($e);
        }
        return $data;
    }
    private function query_result_ready_for_display($data){
        foreach($data as &$row){
            foreach($row as &$cell){
                $cell = htmlspecialchars(stripslashes($cell));
            }
        }
        return $data;
    }
    private function str_array_ready_for_display($data){
        foreach($data as &$row){
            $row = htmlspecialchars(stripslashes($row));
        }
        return $data;
    }
}

/* End of file Someclass.php */