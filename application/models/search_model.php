<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function __construct(){
        parent::__construct();
        $this->load->database();
        if(!isset($_SESSION))
            session_start();
        
    }

    function get_inputs(&$input){
        $input['search_term'] = "";
        $input['search_by'] = "book_title";
        $input['order_by'] = "book_no";

        $input['book_type'] = "Book";

        if (isset($_POST['search'])) $input['search_term'] = $_POST['search'];
        if (isset($_POST['search_by'])) $input['search_by'] = $_POST['search_by'];
        if (isset($_POST['order_by'])) $input['order_by'] = $_POST['order_by'];
        if (isset($_POST['book_type'])) $input['book_type'] = $_POST['book_type'];

        $input['available'] = isset($_POST["available"]);
        $input['borrowed'] = isset($_POST["borrowed"]);
        $input['reserved'] = isset($_POST["reserved"]);

        $input['type_book'] = isset($_POST["type_book"]);
        $input['type_journal'] = isset($_POST["type_journal"]);
        $input['type_sp'] = isset($_POST["type_sp"]);
        $input['type_thesis'] = isset($_POST["type_thesis"]);

         foreach ($input as &$inp){
            $inp = mysql_real_escape_string($inp);
        }
    }

    function get_status_check($input){
        //set defaults
        $status_check = "status='available' or status='borrowed' or status='reserved'";

        if (isset($input['search_term']) && isset($input['search_by'])){
            //filter by book status
            if (!$input["available"]) $status_check = str_replace("status='available' or ","",$status_check);
            if (!$input["borrowed"]) $status_check = str_replace("status='borrowed' or ","",$status_check);
            if (!$input["reserved"]){
                $status_check = str_replace(" or status='reserved'","",$status_check);
                $status_check = str_replace("status='reserved'","",$status_check);
            }

        }

        if($status_check!="") $status_check = "(" . $status_check . ") ";
        else if (isset($_SESSION['type']) && $_SESSION['type'] == "admin") $status_check = "(status!='available' and status!='borrowed' and status!='reserved') ";
        else $status_check = "";

        return $status_check;
    }

    function get_type_check($input){
        //set defaults
        $type_check = "book_type='Book' or book_type='Journal' or book_type='SP' or book_type='Thesis'";

        //filter by type
        if (!$input["type_book"]) $type_check = str_replace("book_type='Book' or ","",$type_check);
        if (!$input["type_journal"]) $type_check = str_replace("book_type='Journal' or ","",$type_check);
        if (!$input["type_sp"]) $type_check = str_replace("book_type='SP' or ","",$type_check);
        if (!$input["type_thesis"]){
            $type_check = str_replace(" or book_type='Thesis'","",$type_check);
            $type_check = str_replace("book_type='Thesis'","",$type_check);
        }

        if($type_check!="") $type_check = "(" . $type_check . ") ";
        else $type_check = "(book_type!='Book' and book_type!='Journal' and book_type!='SP' and book_type!='Thesis') ";

        return $type_check;
    }

    function get_str_likes($details){
        $likes = '';
        if (!$details['spell_check']){
            $word_count = 0;
            if (trim($details['search_term']) != ""){
                $tok = explode(" ", $details['search_term']);

                foreach ($tok as $search) {
                    if (trim($search)=='') continue;
                    if($word_count > 0) $likes .= " or ";

                    if($details['search_by']== 'book_title'){
                        $likes .= "book_title like '%" . $search . "%' or description like '%" . $search . "%' or tags like '%" . $search . "%' ";
                    } else if($details['search_by']== 'any'){
                        $likes .= "book_title like '%" . $search . "%' or book_no like '%" . $search . "%' or publisher like '%" . $search . "%' or description like '%" . $search . "%' or author like '%" . $search . "%' or date_published like '%" . $search . "%' or tags like '%" . $search . "%' ";
                    } else {
                        $likes .= $details['search_by'] . " like '%".$search."%' ";
                    }

                    $word_count++;
                }

            }
        }
        if (trim($likes) != '') $likes = '(' . $likes . ')';
        return $likes;
    }

    function get_str_orderby($is_admin, $details){
        $str_orderby = '';
        if (trim($details['search_term']) == ""){
            if ($is_admin)  $str_orderby = $details['order_by'];
            else  $str_orderby = $details['search_by'];
        } else {
            if ($is_admin) $str_orderby = $details['order_by'];
            else $str_orderby = "";
        }
        if ($str_orderby=='search_relevance' || $str_orderby=='any') $str_orderby = '';

        return $str_orderby;
    }

    function query_result($details){
        //limit the length of the search term
        if (strlen($details['search_term']) > 99) $details['search_term'] = substr($details['search_term'], 0,99);

        $q = array(
                'select' => "select * from book b",
                'where' => "",
                'order_by' => ""
        );
        //check if current user is an admin
        $is_admin = isset($_SESSION['type']) && $_SESSION['type'] == "admin";


        // add type and status check condition if any
        if ($details['type_check'] != ''){
            $q['where'] = ' where ' . $details['type_check'];
            if ($details['status_check'] != '') $q['where'] .= ' and ';
        }
        $q['where'] .= $details['status_check'];



        // for non spell checking, add the strings to be compared by like%% in sql
        $likes = $this->get_str_likes($details);
        if (trim($q['where']) != '' && trim($likes) != '') $q['where'] .= ' and ';
        $q['where'] .= $likes;


        //check ordering of results
        $str_orderby = $this->get_str_orderby($is_admin, $details);
        if ($str_orderby != '') $q['order_by'] = ' order by ' . $str_orderby;


        //compile the query strings
        $query_string = $q['select'] . $q['where'] . $q['order_by'];
        // var_dump($query_string);

        return $this->db->query($query_string)->result();
    }



    function min($n1 , $n2){
        if ($n1 > $n2) return $n2;
        else return $n1;
    }

    function max($n1 , $n2){
        if ($n1 > $n2) return $n1;
        else return $n2;
    }

    function get_rey_string_distance($str1, $str2){
        $s1_dist = $this->rey_string_distance($str2, $str1);
        $s2_dist = $this->rey_string_distance($str1, $str2);
        $min = $this->min($s1_dist, $s2_dist);
        // echo '<br>' . $str1 . ' ' . $str2 . ' ' . $min;
        return $min;
    }


    function rey_string_distance($str1, $str2){
        $s1 = strtolower($str1);
        $s2 = strtolower($str2);

        $s1_ptr = 0;
        $s2_ptr = 0;
        $last_replace = 0;

        while ($s1_ptr < strlen($s1)){
            $replaced = false;
            for ($b=$s2_ptr ; $b<strlen($s2) ; $b++){
                if ($s1[$s1_ptr] == $s2[$b]){
                    //remove character from string
                    $s1 = substr($s1, 0, $s1_ptr) . substr($s1, $s1_ptr+1);
                    $s2 = substr($s2, 0, $b) . substr($s2, $b+1);
                    $s2_ptr = $b;
                    $replaced = true;
                    break;
                }
            }
            if (!$replaced) $s1_ptr++;
            // echo '<br>' . $s1 . ' ' . $s2;
        }

        return $this->max(strlen($s1), strlen($s2));
    }


    function get_row_points($row, $search_terms, $search_by, &$term_sugg, &$term_sugg_dist, $spell_check){
        //set criteria
        $book_title_points = 9;
        $book_author_points = 5;
        $book_desc_points = 4;
        $book_tags_points = 3;
        $book_publisher_points = 2;
        $year_published_points = 2;
        $other_points = 1; //book number, if search by 'any'


        $cols_to_search = array();

        //determine columns to search
        if ($search_by == 'book_title' || $search_by == 'any'){
            array_push($cols_to_search, $row->book_title);
            array_push($cols_to_search, $row->description);
            array_push($cols_to_search, $row->tags);
        }
        if ($search_by == 'author' || $search_by == 'any'){
            array_push($cols_to_search, $row->author);
        }
        if ($search_by == 'publisher' || $search_by == 'any'){
            array_push($cols_to_search, $row->publisher);
        }
        if ($search_by == 'abstract' || $search_by == 'any'){
            array_push($cols_to_search, $row->abstract);
        }
        if ($search_by == 'any'){
            array_push($cols_to_search, $row->book_no);
            array_push($cols_to_search, $row->date_published);
        }

        //compare each search term/word to each of the words in the book title, description, tags
        $pts = 0;
        foreach($search_terms as $search_term){
            $search_term = strtolower(trim($search_term));
            if ($search_term=='') continue;

            foreach($row as $col){
                if (!in_array($col, $cols_to_search)) continue;

                if ($col == $row->tags) $col_words = explode(" ", str_replace(',', ' ', $col));
                elseif ($col == $row->date_published) $col_words = explode(" ", str_replace('-', ' ', $col));
                else $col_words = explode(" ", $col);

                foreach($col_words as $item_orig){
                    $item = strtolower(trim($item_orig));
                    if ($item=='') continue;
                    // echo "<br>" . $search_term . " == " . $item;

                    if ($spell_check){
                        //get the word with minimum distance, for suggestion
                        $terms_distance = $this->get_rey_string_distance($search_term, $item);
                        if ($terms_distance < $term_sugg_dist[$search_term]){
                            $term_sugg[$search_term] = $item_orig;
                            $term_sugg_dist[$search_term] = $terms_distance;
                        }
                    }
                    

                    if($search_term==$item){
                        switch($col){
                            case $row->description: $pts+=$book_desc_points; break;
                            case $row->tags:        $pts+=$book_tags_points; break;
                            case $row->book_title:  $pts+=$book_title_points; break;
                            case $row->author:        $pts+=$book_author_points; break;
                            case $row->publisher:  $pts+=$book_publisher_points; break;
                            case $row->date_published:  $pts+=$year_published_points; break;
                            default: $pts+=1;
                        }
                    } else {
                        if ($col == $row->book_title){ //special case for book titles
                            //if search word is a substring of a book data
                            if (strpos($item, $search_term) !== false && strlen($search_term) >= 3){ 
                                $pts += $book_title_points * (strlen($search_term) / strlen($item));
                                $term_sugg[$search_term] = $item;
                                 $term_sugg_dist[$search_term] = 0;
                            }
                        }
                    }
                }
            }
        }

        $points[$row->book_no] = $pts;
        return $points[$row->book_no];
    }



    function get_sorted_table($table, $input, $spell_check, &$terms_to_suggest){
        if ($table == null) return null;
        if (trim($input['search_term'])=='' || $input['search_by'] == 'book_no' || $input['search_by'] == 'date_published') return $table;

        $points = null;
        $input['search_term'] = strtolower($input['search_term']);
        $search_terms = explode(" ", trim($input['search_term']));

        if ($spell_check){
            foreach($search_terms as $search_term){
                $term_sugg[$search_term] = '';
                $term_sugg_dist[$search_term] = strlen($search_term);
            }
        }


        foreach($table as $row){
            $table_copy[$row->book_no] = $row; //clone table
            //compute points for each row (for determining relevance to search terms), also get suggestions
            $points[$row->book_no] = $this->get_row_points($row, $search_terms, $input['search_by'], $term_sugg, $term_sugg_dist, $spell_check);
        }
        arsort($points); //reverse sort $points structure by value


        if ($spell_check){
            //show suggestion if any
            $to_suggest = false;
            $terms_to_suggest = '';
            foreach($search_terms as $search_term){

                if (trim($search_term) == '') continue;
                //compute correctibility of the search term
                $percent_error = $term_sugg_dist[$search_term] / $this->max(strlen($term_sugg[$search_term]), strlen($search_term));

                //if 25% is correctible for words with > 3 letters. For 3-letter words, one letter mistake can be corrected
                if ($term_sugg_dist[$search_term] > 0 && ($percent_error <= 0.25 || strlen($search_term)==3 && $percent_error <= 0.34)) {
                    $terms_to_suggest .= ' <strong>' . htmlspecialchars(stripslashes($term_sugg[$search_term])) . '</strong>';
                    $to_suggest = true;

                } else if ($term_sugg_dist[$search_term] == 0)  {
                    $terms_to_suggest .= ' ' . $search_term; //search term is ok, no corrections
                }
                // echo '<br>' . $term_sugg_dist[$search_term] . ' / ' . $this->max(strlen($term_sugg[$search_term]), strlen($search_term)) . ' = ' . $percent_error;
            } 
            if (!$to_suggest) $terms_to_suggest = "";
        }



        //construct the sorted table
        $sorted_table = null;
        $counter = 0;
        foreach ($points as $key => $value){
            // echo "<br>" . $key . " " . $value;
            if ($value > 0) $sorted_table[$counter++] = $table_copy[$key];            
        }

        return $sorted_table;
    }
}






/* End of file search_model.php */
/* Location: ./application/controllers/search_model.php */