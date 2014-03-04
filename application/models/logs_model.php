<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function get_logs($from,$to){
        $query = "SELECT
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
                ORDER BY date DESC"; //OH YEAH SO AWESOME

        $result = $this->db->query($query)->result();

        return $result;
    }
}
