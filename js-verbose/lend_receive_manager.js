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