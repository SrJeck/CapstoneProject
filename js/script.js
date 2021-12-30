//SIDEBAR OPEN AND CLICK FUNCTION

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}


$(document).ready(function () {
  $('.chat_icon').click(function () {
    $('.chat_box').toggleClass('active');
  });

  $('.my-conv-form-wrapper').convform({ selectInputStyle: 'disable' })
});



function sort_choice_function() {

  var sort_choice = document.getElementById("sort_choice").value;

  alert(sort_choice);
}

function topic_choice_function() {

  var topic_choice = document.getElementById("topic_choice").value;

  alert(topic_choice);
}

function apply_filter() {

  var sort_choice = document.getElementById("sort_choice").value;
  var topic_choice = document.getElementById("topic_choice").value;
  var from_choice = document.getElementById("from_choice").value;
  var to_choice = document.getElementById("to_choice").value;

  alert(sort_choice);
  alert(topic_choice);
  alert(from_choice);
  alert(to_choice);

  //date code
  //     SELECT * FROM Products
  // WHERE Price BETWEEN 10 AND 20;
}
function validateForm() {
  let x = document.forms["myForm"]["abstract"].value;
  if (x == "") {
    alert("Name must be filled out");
    return false;
  }
}
function register() {

  var empt = document.myForm.title.value;
  if (empt === "") {
    alert("Please input a Value");
    return false;
  }

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