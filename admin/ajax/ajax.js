// <!-- Add user -->
$(document).on('click', '#btn-add', function (e) {
	var data = $("#user_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "backend/save.php",
		success: function (dataResult) {
			var dataResult = JSON.parse(dataResult);
			if (dataResult.statusCode == 200) {
				$('#addEmployeeModal').modal('hide');
				alert('Data added successfully !');
				location.reload();
			}
			else if (dataResult.statusCode == 201) {
				alert(dataResult);
			}
		}
	});
});
$(document).on('click', '.update', function (e) {
	var id = $(this).attr("data-id");
	var name = $(this).attr("data-name");
	var email = $(this).attr("data-email");
	var phone = $(this).attr("data-phone");
	var city = $(this).attr("data-city");
	$('#id_u').val(id);
	$('#name_u').val(name);
	$('#email_u').val(email);
	$('#phone_u').val(phone);
	$('#city_u').val(city);
});
// < !--Update -->
$(document).on('click', '#update', function (e) {
	var data = $("#update_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "backend/save.php",
		success: function (dataResult) {
			var dataResult = JSON.parse(dataResult);
			if (dataResult.statusCode == 200) {
				$('#editEmployeeModal').modal('hide');
				swal('Data updated successfully !');
				window.setTimeout(function () { location.reload() }, 1500)

			}
			else if (dataResult.statusCode == 201) {
				alert(dataResult);
			}
		}
	});
});
$(document).on("click", ".delete", function () {
	var id = $(this).attr("data-id");
	$('#id_d').val(id);

});
$(document).on("click", "#delete", function () {
	$.ajax({
		url: "backend/save.php",
		type: "POST",
		cache: false,
		data: {
			type: 3,
			id: $("#id_d").val()
		},
		success: function (dataResult) {
			$('#deleteEmployeeModal').modal('hide');
			$("#" + dataResult).remove();

		}
	});
});
$(document).on("click", "#delete_multiple", function () {
	var user = [];
	$(".user_checkbox:checked").each(function () {
		user.push($(this).data('user-id'));
	});
	if (user.length <= 0) {
		alert("Please select records.");
	}
	else {
		WRN_PROFILE_DELETE = "Are you sure you want to delete " + (user.length > 1 ? "these" : "this") + " row?";
		var checked = confirm(WRN_PROFILE_DELETE);
		if (checked == true) {
			var selected_values = user.join(",");
			console.log(selected_values);
			$.ajax({
				type: "POST",
				url: "backend/save.php",
				cache: false,
				data: {
					type: 4,
					id: selected_values
				},
				success: function (response) {
					var ids = response.split(",");
					for (var i = 0; i < ids.length; i++) {
						$("#" + ids[i]).remove();
					}
				}
			});
		}
	}
});
$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip();
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function () {
		if (this.checked) {
			checkbox.each(function () {
				this.checked = true;
			});
		} else {
			checkbox.each(function () {
				this.checked = false;
			});
		}
	});
	checkbox.click(function () {
		if (!this.checked) {
			$("#selectAll").prop("checked", false);
		}
	});
});

function selectAction(params) {
	var e = document.getElementById("select"+params);
	var strUser = e.value;
   if (strUser == "Reject") {
	   document.getElementById("1strow"+params).style.display = "block";
   }else{
	   document.getElementById("1strow"+params).style.display = "none";
   }
}
function submitForm(params) {	
	var a = document.getElementById("select"+params);
	var select = a.value;	
	var b = document.getElementById("reason"+params);
	var reason = b.value;
	var c = document.getElementById("thesis"+params);
	var thesis = c.value;
	var d = document.getElementById("user"+params);
	var user = d.value;
	xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status == 200){
            //alert("success");
			window.location.href = "pending_research.php";
        }
    }
    xhr.open("POST","action_research.php",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("thesis="+thesis+"&user="+user+"&reason="+reason+"&select="+select);
	
}
function setBanner(id) {
	xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status == 200){
            //alert("success");
			window.location.href = "settings.php";
        }
    }
    xhr.open("POST","set_banner.php",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("banner="+id);
}
var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };