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
                    $this.text('Return');
                    $this.off('click').on('click', receivedClick);            }
            });      

        } else {
        // Do nothing!
        }

    }

     function receivedClick(){
        $this = $(this);
        $bookno = $this.attr('bookno');
        $bookauthor = $this.closest('td').find('[book_data = author]').text()
        $booktitle = $this.closest('td').find('[book_data = book_title]').text()
         if (confirm('Are you sure you want to return: \n'+$booktitle+'\n'+$bookno+'\n'+$bookauthor+"?")) {
             $.ajax({
                url: 'book/received/',
                data: {id:$bookno},
                success: function(data) { 
                    $this.text('(available)');
                    $this.off('click');
               // $this.addClass('lendButton'); 
                }
            });        
        } else {
        // Do nothing!
        }
     } 