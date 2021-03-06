<?php if ( ! defined('BASEPATH')) exit('Unauthorized access.');

class Logs_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function get_logs($data){
        //ULTIMATE SELECT QUERY FOR TRANSACTION LOGS//
        $query = "SELECT SQL_CALC_FOUND_ROWS * FROM (SELECT
                        date_borrowed 'date',
                        book_no,
                        'borrowed' as action,
                        username_user,
                        username_admin,
                        transaction_no
                    FROM lend
                UNION
                    SELECT
                        date_returned 'date',
                        book_no,
                        'returned' as action,
                        username_user,
                        username_admin,
                        transaction_no
                    FROM lend
                    WHERE date_returned is not null
                UNION
                    SELECT
                        date_reserved 'data',
                        book_no,
                        'reserved' as action,
                        username,
                        null,
                        null
                    FROM reserve_history
                ORDER BY date DESC) AS T
                ";

        if($data['from'] != 0 || $data['to'] != 0){
            $query .= "WHERE ";
            if($data['from'] != 0 && $data['to'] != 0){
                $query .= "date >= '".$data['from']." 23:59:59"."' AND date <= '".$data['to']." 23:59:59"."'";
            }else if($data['from'] != 0){
                $query .= "date >= '".$data['from']." 23:59:59"."'";
            }else{
                $query .= "date <= '".$data['to']." 23:59:59"."'";
            }
        }
        if(isset($data['start_row']) && isset($data['num_rows'])){
            $max = number_format($data['num_rows'],0,'.','');
            $query .= "LIMIT {$data['start_row']},{$max}";
            $result['rows'] = $this->db->query($query)->result();
            $result['count'] = $this->db->query("SELECT FOUND_ROWS() as count")->result()[0]->count;
            return $result;
        }else{
            return $this->db->query($query)->result();
        }

    }
}
