<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function get_logs($data){
        //ULTIMATE SELECT QUERY FOR TRANSACTION LOGS//
        $max = number_format($data['num_rows'],0,'.','');
        $query = "SELECT SQL_CALC_FOUND_ROWS
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
                ORDER BY date DESC
                LIMIT {$data['start_row']},{$max}";

        $result['rows'] = $this->db->query($query)->result();
        $result['count'] = $this->db->query("SELECT FOUND_ROWS() as count")->result()[0]->count;
        return $result;
    }
}
