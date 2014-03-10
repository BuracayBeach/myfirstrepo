    	$('#dropdown_container').ready(function(){
    		 var checkList1 = document.getElementById('book_type_div');
    		 if (checkList1){
    		 	var anc = checkList1.getElementsByClassName('anchor')[0];
    		 	if (anc){
    		 		anc.onclick = function (evt) {
			            if (checkList1.classList.contains('visible')) checkList1.classList.remove('visible');
			            else checkList1.classList.add('visible');
		      		}
    		 	}
    		}
	        var checkList2 = document.getElementById('status');
	        if (checkList2){
		        var anc2 = checkList2.getElementsByClassName('anchor')[0];
		        if (anc2){
		        	anc2.onclick = function (evt) {
			            if (checkList2.classList.contains('visible')) checkList2.classList.remove('visible');
			            else checkList2.classList.add('visible');
		      		}
		        }
	        	
	        }
	        var checkList_other = document.getElementById('book_type_other_div');
	        if (checkList_other){
	        	var ancOther = checkList_other.getElementsByClassName('anchor')[0]
	        	if (ancOther){
	        		ancOther.onclick = function (evt) {
			            if (checkList_other.classList.contains('visible')) checkList_other.classList.remove('visible');
			            else checkList_other.classList.add('visible');
		      		}
	        	}
	        	
	        }
    	});