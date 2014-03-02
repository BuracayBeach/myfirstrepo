

        $("#results_per_page").on('keypress', function(event){
          res_valid = num_valid($('#results_per_page'))


          if (event.which == 13 && res_valid){
            $('#submit_search').submit();
          }
        });

        function num_valid(object){
          o_val = parseInt(object.val());
          o_min = parseInt(object.attr('min'));
          o_max = parseInt(object.attr('max'));

          return $.isNumeric(o_val) && o_val >= o_min && o_val <= o_max;
        }

        $('#results_per_page_form').submit(function(event){
          event.preventDefault();
        });
