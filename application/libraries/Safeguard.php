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
    public function query_result_ready_for_display($data){ //compatible with array of objects or array of arrays
        if($data != null && !empty($data)){
            foreach($data as &$row){
                $was_object = false;
                if(is_object($row)){
                    $was_object = true;
                    $row = json_decode(json_encode($row),true);
                }
                foreach($row as &$cell){
                    if(is_array($cell)){
                        $cell = $this->str_array_ready_for_display($cell);
                    }else
                        $cell = htmlspecialchars(stripslashes(trim($cell)));
                }
                if($was_object){
                    $row = json_decode(json_encode($row));
                }
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