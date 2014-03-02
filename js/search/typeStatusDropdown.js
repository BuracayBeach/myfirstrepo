    	$('#book_type_div, #status').ready(function(){
    		 var checkList1 = document.getElementById('book_type_div');
    		 if (checkList1){
    		 	 checkList1.getElementsByClassName('anchor')[0].onclick = function (evt) {
		            if (checkList1.classList.contains('visible')) checkList1.classList.remove('visible');
		            else checkList1.classList.add('visible');
	      		}
    		 }
	        var checkList2 = document.getElementById('status');
	        if (checkList2){
	        	checkList1.getElementsByClassName('anchor')[0].onclick = function (evt) {
		            if (checkList1.classList.contains('visible')) checkList1.classList.remove('visible');
		            else checkList1.classList.add('visible');
	      		}
	        }
    	});