$(document).ready(function () {
	$('.chat_icon').click(function () {
		$('.chat_box').toggleClass('active');
	});

	$('.my-conv-form-wrapper').convform({ selectInputStyle: 'disable' })
});
$(document).ready(function () {
	make_menuitem_active();
})
$(document).ready(function () {
	$('li').click(function () {
		$('li').css('color', 'black');
		$(this).css('color', 'blue');
	});
});
function make_menuitem_active() {
	$("#div1").show();
	$("#div2").hide();
	$("#div3").hide();
	$("#div4").hide();
	$("#item1").on("click", function () {
		$(this).addClass("active");
		$("#div1").show();
		$("#div1").siblings("div").hide();
	})
	$("#item2").on("click", function () {
		$(this).addClass("active");
		$("#div2").show();
		$("#div2").siblings("div").hide();
	})
	$("#item3").on("click", function () {
		$(this).addClass("active");
		$("#div3").show();
		$("#div3").siblings("div").hide();
	})
	$("#item4").on("click", function () {
		$(this).addClass("active");
		$("#div4").show();
		$("#div4").siblings("div").hide();
	})
}
// File Button
Array.prototype.forEach.call(
	document.querySelectorAll(".file-upload__button"),
	function (button) {
		const hiddenInput = button.parentElement.querySelector(
			".file-upload__input"
		);
		const label = button.parentElement.querySelector(".file-upload__label");
		const defaultLabelText = "No file(s) selected";

		// Set default text for label
		label.textContent = defaultLabelText;
		label.title = defaultLabelText;

		button.addEventListener("click", function () {
			hiddenInput.click();
		});

		hiddenInput.addEventListener("change", function () {
			const filenameList = Array.prototype.map.call(hiddenInput.files, function (
				file
			) {
				return file.name;
			});

			label.textContent = filenameList.join(", ") || defaultLabelText;
			label.title = label.textContent;
		});
	}
);

function myChangeFunction(input1) {
	var input2 = document.getElementById('myInput2');
	input2.value = input1.value;
}

function seeNotif() {
	if (document.getElementsByClassName("box")[0].style.display == "none" && document.getElementsByClassName("number")[0].innerHTML != 0) {
  
	  seen = "seen";
	  xhr = new XMLHttpRequest();
  
	  xhr.onreadystatechange = () => {
		if (xhr.readyState == 4 && xhr.status == 200) {
		  document.getElementsByClassName("box")[0].innerHTML = xhr.responseText;
		  document.getElementsByClassName("box")[0].style.display = "block";
		}
	  }
	  xhr.open("POST", "seen_status.php", true);
	  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  xhr.send("seen=" + seen);
	} else if (document.getElementsByClassName("box")[0].style.display == "none" && document.getElementsByClassName("number")[0].innerHTML == 0) {
	  document.getElementsByClassName("box")[0].style.display = "block";
	  document.getElementsByClassName("box")[0].innerHTML = "";
	} else if (document.getElementsByClassName("box")[0].style.display == "block") {
	  document.getElementsByClassName("box")[0].style.display = "none";
	  document.getElementsByClassName("number")[0].innerHTML = "0";
	  document.getElementsByClassName("box")[0].innerHTML = "";
	}
  
  }