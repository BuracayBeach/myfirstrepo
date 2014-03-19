
<div id="search_table_container" class="column">
    <?php include 'pagination_view.php';?>

    <table id="search_table" border="1">
        <?php

            if(isset($table) && isset($page)){
                echo "<span id='search_results_label'>";
                if (trim($search_term)=='') echo "View all Books";
                else  echo "Search Results for  '<span class='bold'>" . htmlspecialchars(stripslashes(trim($search_term))) . "</span>'";
                echo "</span>";

                echo "<tr >
                    <th width='15%'>Identification</th>
                    <th width='40%'>Material</th>
                    <th width='15%'>Publishment </th>
                ";

                echo "<th width='15%'>Tags</th>";
                echo "<th ";
                if ($search_by != 'any' && $search_by != 'abstract') echo " style='display:none;'";
                echo ">Abstract</th>";
                echo "<th style='display:none;'>Other Details</th>";
                echo "</tr>";


                if ($page > 100) $page = 100;


                $total_count = count($table);

                $row_min = ($page-1) * $rows_per_page;
                $row_max = ($page)*$rows_per_page - 1;
                if ($row_max > $total_count - 1) $row_max = $total_count - 1;

                echo "<div class='search_results_counter'>";
                echo $row_min+1 . "-";
                echo $row_max+1 . " of $total_count";
                echo "<div><br>";

                $reserve = $this->reserve_model->get_first();
                $lend = $this->lend_model->get_lend();

                for($a=$row_min ; $a<=$row_max ; $a++){
                    if (!isset($table[$a])) break;
                    $row = $table[$a];
                    include "table_row_view.php";
                }
            } else  {
                echo "<span>No results for '<strong>" . htmlspecialchars(stripslashes(trim($search_term))) . "</strong>'</span>";
            }
        ?>
    </table>

    <hr/>
    <?php $pagination2 = '2'; ?>
    <?php include 'pagination_view.php';?>
</div>


<script> //lend_receive_manager.js
    //Script author : Edzer Josh V. Padilla
    //Description : AJAX used to call the lend and receieve modules and update the buttons of the page dynamically
    $('.lendButton').on('click', lendClick);
    $('.receivedButton').on('click', receivedClick);

    function lendClick(){
        $this = $(this);
        $bookno = $this.attr('bookno');
        $bookauthor = $this.closest('td').find('[book_data = author]').text()
        $booktitle = $this.closest('td').find('[book_data = book_title]').text()
        if (confirm('Are you sure you want to lend: \n'+$booktitle+'\n'+$bookno+'\n'+$bookauthor+"?")) {
            $.ajax({
                url: 'book/lend/',
                data: {id:$bookno},
                success: function(data) {
                    if (data != '0') {
                        var borrower = $this.attr('reserver');
                        $this.text('Return ('+borrower+')');
                    }
                    else $this.text('Return');

                    $this.off('click').on('click', receivedClick);            }
            });

        } else {
            // Do nothing!
        }

    }

    function receivedClick(){
        var newBorrower = "";
        $this = $(this);
        $bookno = $this.attr('bookno');
        $bookauthor = $this.closest('td').find('[book_data = author]').text()
        $booktitle = $this.closest('td').find('[book_data = book_title]').text()
        if (confirm('Are you sure you want to return: \n'+$booktitle+'\n'+$bookno+'\n'+$bookauthor+"?")) {
            $.ajax({
                url: 'book/received/',
                data: {id:$bookno},
                success: function(data) {

                    /* end edit */
                    var info = new Array();
                    info[0] = $bookno;

                    $.ajax({
                        url : icejjfish + "/index.php/" + "notifs" + "/" + "check_reserve_for_first",
                        data : {arr : info},
                        type : 'POST',
                        dataType : "html",
                        async : true,
                        success : function(data2) {}
                    });

                    /* start edit by Carl Adrian P. Castueras */
                    var json_data = JSON.parse(data);

                    //if there is no person next in line for the book. change the link into a linkless tag
                    if(json_data.status === 'available')
                    {
                        $this.text('(available)');
                        $this.off('click');
                    }

                    //if there is a person next in line for the book, change the link into a lend link
                    else if(json_data.status === 'reserved') {

                        $.ajax({
                            url: 'reserve/get_next/',
                            data: {arr : info},
                            type : 'POST',
                            dataType : "html",
                            async : true,
                            success: function(data) {
                                $this.text('Lend ('+ data +')');
                                $this.off('click').on('click',lendClick);
                                $this.attr('reserver' , data );
                            }
                        });
                    }


                }
            });
        } else {
            // Do nothing!
        }
    }

</script>

<script> //readmore.min.js
    /*!
     * Readmore.js jQuery plugin
     * Author: @jed_foster
     * Project home: jedfoster.github.io/Readmore.js
     * Licensed under the MIT license
     */

    ;(function($) {

        var readmore = 'readmore',
            defaults = {
                speed: 100,
                maxHeight: 200,
                heightMargin: 16,
                moreLink: '<a href="#">more...</a>',
                lessLink: '<a href="#"><< less</a>',
                embedCSS: true,
                sectionCSS: 'display: block; width: 100%;',
                startOpen: false,
                expandedClass: 'readmore-js-expanded',
                collapsedClass: 'readmore-js-collapsed',

                // callbacks
                beforeToggle: function(){},
                afterToggle: function(){}
            },
            cssEmbedded = false;

        function Readmore( element, options ) {
            this.element = element;

            this.options = $.extend( {}, defaults, options);

            $(this.element).data('max-height', this.options.maxHeight);
            $(this.element).data('height-margin', this.options.heightMargin);

            delete(this.options.maxHeight);

            if(this.options.embedCSS && ! cssEmbedded) {
                var styles = '.readmore-js-toggle, .readmore-js-section { ' + this.options.sectionCSS + ' } .readmore-js-section { overflow: hidden; }';

                (function(d,u) {
                    var css=d.createElement('style');
                    css.type = 'text/css';
                    if(css.styleSheet) {
                        css.styleSheet.cssText = u;
                    }
                    else {
                        css.appendChild(d.createTextNode(u));
                    }
                    d.getElementsByTagName('head')[0].appendChild(css);
                }(document, styles));

                cssEmbedded = true;
            }

            this._defaults = defaults;
            this._name = readmore;

            this.init();
        }

        Readmore.prototype = {

            init: function() {
                var $this = this;

                $(this.element).each(function() {
                    var current = $(this),
                        maxHeight = (current.css('max-height').replace(/[^-\d\.]/g, '') > current.data('max-height')) ? current.css('max-height').replace(/[^-\d\.]/g, '') : current.data('max-height'),
                        heightMargin = current.data('height-margin');

                    if(current.css('max-height') != 'none') {
                        current.css('max-height', 'none');
                    }

                    $this.setBoxHeight(current);

                    if(current.outerHeight(true) <= maxHeight + heightMargin) {
                        // The block is shorter than the limit, so there's no need to truncate it.
                        return true;
                    }
                    else {
                        current.addClass('readmore-js-section ' + $this.options.collapsedClass).data('collapsedHeight', maxHeight);

                        var useLink = $this.options.startOpen ? $this.options.lessLink : $this.options.moreLink;
                        current.after($(useLink).on('click', function(event) { $this.toggleSlider(this, current, event) }).addClass('readmore-js-toggle'));

                        if(!$this.options.startOpen) {
                            current.css({height: maxHeight});
                        }
                    }
                });

                // $(window).on('resize', function(event) {
                //   $this.resizeBoxes();
                // });
            },

            toggleSlider: function(trigger, element, event)
            {
                event.preventDefault();

                var $this = this,
                    newHeight = newLink = sectionClass = '',
                    expanded = false,
                    collapsedHeight = $(element).data('collapsedHeight');

                if ($(element).height() <= collapsedHeight) {
                    newHeight = $(element).data('expandedHeight') + 'px';
                    newLink = 'lessLink';
                    expanded = true;
                    sectionClass = $this.options.expandedClass;
                }

                else {
                    newHeight = collapsedHeight;
                    newLink = 'moreLink';
                    sectionClass = $this.options.collapsedClass;
                }

                // Fire beforeToggle callback
                $this.options.beforeToggle(trigger, element, expanded);

                $(element).animate({'height': newHeight}, {duration: $this.options.speed, complete: function() {
                    // Fire afterToggle callback
                    $this.options.afterToggle(trigger, element, expanded);

                    $(trigger).replaceWith($($this.options[newLink]).on('click', function(event) { $this.toggleSlider(this, element, event) }).addClass('readmore-js-toggle'));

                    $(this).removeClass($this.options.collapsedClass + ' ' + $this.options.expandedClass).addClass(sectionClass);
                }
                });
            },

            setBoxHeight: function(element) {
                var el = element.clone().css({'height': 'auto', 'width': element.width(), 'overflow': 'hidden'}).insertAfter(element),
                    height = el.outerHeight(true);

                el.remove();

                element.data('expandedHeight', height);
            },

            resizeBoxes: function() {
                var $this = this;

                $('.readmore-js-section').each(function() {
                    var current = $(this);

                    $this.setBoxHeight(current);

                    if(current.height() > current.data('expandedHeight') || (current.hasClass($this.options.expandedClass) && current.height() < current.data('expandedHeight')) ) {
                        current.css('height', current.data('expandedHeight'));
                    }
                });
            },

            destroy: function() {
                var $this = this;

                $(this.element).each(function() {
                    var current = $(this);

                    current.removeClass('readmore-js-section ' + $this.options.collapsedClass + ' ' + $this.options.expandedClass).css({'max-height': '', 'height': 'auto'}).next('.readmore-js-toggle').remove();

                    current.removeData();
                });
            }
        };

        $.fn[readmore] = function( options ) {
            var args = arguments;
            if (options === undefined || typeof options === 'object') {
                return this.each(function () {
                    if ($.data(this, 'plugin_' + readmore)) {
                        var instance = $.data(this, 'plugin_' + readmore);
                        instance['destroy'].apply(instance);
                    }

                    $.data(this, 'plugin_' + readmore, new Readmore( this, options ));
                });
            } else if (typeof options === 'string' && options[0] !== '_' && options !== 'init') {
                return this.each(function () {
                    var instance = $.data(this, 'plugin_' + readmore);
                    if (instance instanceof Readmore && typeof instance[options] === 'function') {
                        instance[options].apply( instance, Array.prototype.slice.call( args, 1 ) );
                    }
                });
            }
        }
    })(jQuery);

</script>



<script> //pagination ajax

    $('#search_table').on('click', 'tr', activate_row);

    $('#pagination').on('click', '.page_nav', go_to_page);
    $('#pagination2').on('click', '.page_nav', go_to_page);
    $('.prev_nav').on('click', prev_page);
    $('.next_nav').on('click', next_page);

    function activate_row(){
        $("#search_table").find("tr").attr("active", "false");
        $(this).attr('active', true);
    }

    function go_to_page(){
        page = $(this).attr('pageno');
        to_ajax(page);
    }

    function next_page(){
        page = parseInt($('#pagination').attr('page'));
        maxpage = parseInt($('#pagination').attr('maxpage'));
        if (page >= maxpage) return;
        to_ajax(page+1);
    }

    function prev_page(){
        page = parseInt($('#pagination').attr('page'));
        if (page == 1) return;
        to_ajax(page-1);
    }

    function to_ajax(numPage){
        to_search = $('#pagination').attr('searchterm');
        search_by = $('#pagination').attr('searchby');
        $('#search_text').val(to_search);
        results_per_page = $('#pagination').attr('rowsperpage');
        ajax_results(search_by, numPage, results_per_page);
    }


    var p_lastRequest;
    function ajax_results(search_by, page, results_per_page){
        if (p_lastRequest) if (p_lastRequest.readyState != 4) p_lastRequest.abort();
        else $("#loading").fadeIn(500);

        my_input = $('#search_form').serialize();
        my_input += "&page=" + page;
        my_input += "&rows_per_page=" + results_per_page;
        my_input += "&search_by=" + search_by;
        // console.log(my_input);
        // alert("ajaxing ajax results")

        p_lastRequest = $.ajax({
            type: "post",
            data: my_input,
            url: icejjfish + "index.php/book/search",
            success: function(data, jqxhr, status){
                $("#result_container").html(data);
                hideLoadingGIF()
            },
            fail: hideLoadingGIF()

        });

    }

    function hideLoadingGIF(){
        $("#loading").fadeOut(500, function(){
            $('.logo_main').fadeOut();
        });
    }
</script>

<script> //readmores.js
    function setReadMores(row){ //row can be a single row or whole document

        row.find('.article_abstract').readmore({
            speed: 75,
            maxHeight: 50
        });

        row.find('.article_title').readmore({
            speed: 75,
            maxHeight: 40
        });

        row.find('.article_author').readmore({
            speed: 75,
            maxHeight: 20
        });

        row.find('.article_description').readmore({
            speed: 75,
            maxHeight: 40
        });

        row.find('.article_publisher').readmore({
            speed: 75,
            maxHeight: 50
        });
        row.find('.article_tag').readmore({
            speed: 75,
            maxHeight: 40
        });
    }

    setReadMores($(document));

</script>


<script> //autosearch.js
    $('#search_table_container').ready(function(){
        $('#suggestion_text').on('click', research);
        $('.tag_link').on('click', research);
    });
</script>