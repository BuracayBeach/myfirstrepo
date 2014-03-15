/* 
	Script Author : Carl Adrian P. Castueras 
	Description : A script that displays all the admins created by the main admin and allows deletion via buttons
*/


var filepath = icejjfish;

function display_admins()
{

	$.ajax({
			url : filepath+"admin_account/get_admins/", 
			type : 'POST',
			dataType : "html",
			async : true,
			success: function(data) {
				//parse the data into json since it is still of html format
				var admin_json = JSON.parse(data);
				var admin_array = [];
				var admin_count;

				//add a length only if there are admins fetched
				if(admin_json != null){
					admin_count = admin_json.length;
				} else{
					//set the count to 0 instead of null
					admin_count = 0;
				}

				//display the table only if there are admins to display
				if(admin_count > 0){
					//create the headers as a string
					var headers = "<tr>";
					headers += "<th>Username</th>";
					headers += "<th>First Name</th>";
					headers += "<th>Middle Name</th>";
					headers += "<th>Last Name</th>";
					headers += "<th>Action</th>";
					headers += "</tr>";
					//add the headers to the array of strings to be inserted into the table
					admin_array.push(headers);

					for(var i=0;i<admin_count;i+=1)
					{
						//create a row in string form
						var row = "<tr class='admin_row'>";
						row += "<td class='admin_col'>"+admin_json[i].username+"</td>";
						row += "<td class='admin_col'>"+admin_json[i].name_first+"</td>";
						row += "<td class='admin_col'>"+admin_json[i].name_middle+"</td>";
						row += "<td class='admin_col'>"+admin_json[i].name_last+"</td>";
						row += "<td class='admin_col'><input type='button' class='admin_delete' value='Delete This Admin' username='"+admin_json[i].username+"' /></td>";
						//add the row to the array of strings to be inserted into the table
						admin_array.push(row);
					}

					//insert the strings as html to dynamically add content to the table
					$('#admin_table').html(admin_array);
					$('#admin_table').css({'margin' : '0 auto', 'margin-top' : '50px'});
				} else{
					$('#admin_list').before("<p>No other admins</p>")
				}
			}
	});
}

function bind_delete()
{
	$('#admin_list').on("click",'.admin_delete',function(){
		var username = $(this).attr('username');

		var prompt = "Are you sure you want to delete this admin?\nUsername: " + username;
		if(confirm(prompt))
		{
			//save $(this) into another variable to make it accessible in the success function
			$this = $(this);
			$.ajax({
				url : filepath+"admin_account/delete_admin/"+username+"/", 
				type : 'POST',
				dataType : "html",
				async : true,
				success: function(data) {
					alert("Admin successfully deleted");
					//ASSUMPTION : the admin was deleted from the database so dynamically remove it from the table
					$this.closest('tr').remove();
				}
			});
		}
	})
}

function main()
{
	display_admins();
	bind_delete();
}

$(document).ready(main);