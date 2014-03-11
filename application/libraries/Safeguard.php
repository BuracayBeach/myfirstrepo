<?php if ( ! defined('BASEPATH')) exit('Unauthorized access.');

class Safeguard {
    public function array_ready_for_query($data){
        foreach($data as &$e){
            if(is_array($e)){
                $e = $this->array_ready_for_query($e);
            }else{
                $e  = mysql_real_escape_string(trim($e));
            }
        }
        return $data;
    }
    public function query_result_ready_for_display($data){
        foreach($data as &$row){
            foreach($row as &$cell){
                if(is_array($cell)){
                    $cell = $this->str_array_ready_for_display($cell);
                }else
                $cell = htmlspecialchars(stripslashes(trim($cell)));
            }
        }
        return $data;
    }
    public function str_array_ready_for_display($data){
        foreach($data as &$row){
            if(is_array($row)){
                $row = $this->str_array_ready_for_display($row);
            }else
                 $row = htmlspecialchars(stripslashes(trim($row)));
        }
        return $data;
    }

    public function str_array_ready_for_html($data){
        foreach($data as &$row){
            if(is_array($row)){
                $row = $this->str_array_ready_for_display($row);
            }else
            $row = stripslashes(trim($row));
        }
        return $data;
    }
}

/* End of file Someclass.php */