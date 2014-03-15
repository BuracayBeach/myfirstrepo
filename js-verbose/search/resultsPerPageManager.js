

        $("#results_per_page").on('keypress', function(event){
          res_valid = num_valid($('#results_per_page'))


          if (event.which == 13 && res_valid){
            $('#submit_search').submit();
          }
        });

        function num_valid(object){
          o_val = parseFloat(object.val());
          o_min = parseFloat(object.attr('min'));
          o_max = parseFloat(object.attr('max'));

          return $.isNumeric(o_val) && o_val >= o_min && o_val <= o_max && o_val % 1 == 0;
        }

        $('#results_per_page_form').submit(function(event){
          event.preventDefault();
          return false;
        });
