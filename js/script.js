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
  if (document.getElementsByClassName("box")[0].style.display == "none") {

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
  }else if (document.getElementsByClassName("box")[0].style.display == "block") {
    document.getElementsByClassName("box")[0].style.display = "none";
    document.getElementsByClassName("number")[0].innerHTML = "0";
  }

}
function questionType(params) {
  if (params == 1) {
    var items = document.getElementsByClassName("answer"+params);
		for (var i=0; i < items.length; i++) {
			items[i].style.display = "block";
		}
    var items = document.getElementsByClassName("questions");
		for (var i=0; i < items.length; i++) {
			items[i].style.display = "none";
		}
  }else if (params == 2) {
    
    var items = document.getElementsByClassName("answer"+params);
		for (var i=0; i < items.length; i++) {
			items[i].style.display = "block";
		}
    // var items = document.getElementsByClassName("answer"+params);
		// for (var i=0; i < items.length; i++) {
		// 	items[i].style.display = "block";
		// }
    var items = document.getElementsByClassName("questions");
		for (var i=0; i < items.length; i++) {
			items[i].style.display = "none";
		}
    
  
  }else if (params == 3) {
    
    var items = document.getElementsByClassName("answer"+params);
		for (var i=0; i < items.length; i++) {
			items[i].style.display = "block";
		}
    var items = document.getElementsByClassName("questions");
		for (var i=0; i < items.length; i++) {
			items[i].style.display = "none";
		}
  }
}
function reset() {
  var items = document.getElementsByClassName("questions");
  for (var i=0; i < items.length; i++) {
    items[i].style.display = "block";
  }
  var items = document.getElementsByClassName("answer1");
  for (var i=0; i < items.length; i++) {
    items[i].style.display = "none";
  }
  var items = document.getElementsByClassName("answer2");
  for (var i=0; i < items.length; i++) {
    items[i].style.display = "none";
  }
  var items = document.getElementsByClassName("answer3");
  for (var i=0; i < items.length; i++) {
    items[i].style.display = "none";
  }
  var items = document.getElementsByClassName("analyticsAnswer2");
  for (var i=0; i < items.length; i++) {
    items[i].style.display = "none";
  }
  var items = document.getElementsByClassName("developmentQuestions");
  for (var i=0; i < items.length; i++) {
    items[i].style.display = "none";
  }
  
  document.getElementById("topic").options[0].selected = true;
}

function analytics(topic) {
  xhr = new XMLHttpRequest();

  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementsByClassName("analyticsResult")[0].innerHTML = xhr.responseText+"Or you may check the thesis repository to find more studies that you might use.";
      document.getElementsByClassName("analyticsResult")[0].style.display = "block";
    }
  }
  xhr.open("POST", "chatbot_analytics1.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("topic=" + topic);
}

function developmentType(order) {
  var order_type = "";
  if (order == 1) {
    order_type = " ASC";
  }else{
    order_type = " DESC";
  }
  
  xhr = new XMLHttpRequest();

  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementsByClassName("development"+order)[0].innerHTML = xhr.responseText;
    }
  }
  xhr.open("POST", "chatbot_analytics2.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("order=" + order_type);
  if (order == 1) {
    document.getElementsByClassName("development1")[0].style.display = "block";
    var items = document.getElementsByClassName("development");
    for (var i=0; i < items.length; i++) {
      items[i].style.display = "block";
    }
    document.getElementsByClassName("development2")[0].style.display = "none";
  }else{
    document.getElementsByClassName("development1")[0].style.display = "none";
    var items = document.getElementsByClassName("development");
    for (var i=0; i < items.length; i++) {
      items[i].style.display = "block";
    }
    document.getElementsByClassName("development2")[0].style.display = "block";
  }
}

function analyticsQuestionType(params) {
  if (params == 1) {
    var items = document.getElementsByClassName("analyticsAnswer1");
    for (var i=0; i < items.length; i++) {
      items[i].style.display = "block";
    }
    var items = document.getElementsByClassName("analyticsResult");
    for (var i=0; i < items.length; i++) {
      items[i].style.display = "none";
    }
  }else{
    var items = document.getElementsByClassName("analyticsAnswer2");
    for (var i=0; i < items.length; i++) {
      items[i].style.display = "block";
    }
    var items = document.getElementsByClassName("analyticsResult");
    for (var i=0; i < items.length; i++) {
      items[i].style.display = "none";
    }
  }
}

function developmentAnswerType(answer) {
  if (answer == "yes") {
    var items = document.getElementsByClassName("developmentQuestions");
    for (var i=0; i < items.length; i++) {
      items[i].style.display = "block";
    }
    var items1 = document.getElementsByClassName("development1");
    for (var i=0; i < items1.length; i++) {
      items1[i].style.display = "none";
    }
    var items2 = document.getElementsByClassName("development2");
    for (var i=0; i < items2.length; i++) {
      items2[i].style.display = "none";
    }
    var items3 = document.getElementsByClassName("development");
    for (var i=0; i < items3.length; i++) {
      items3[i].style.display = "none";
    }
    var items3 = document.getElementsByClassName("answer3");
    for (var i=0; i < items3.length; i++) {
      items3[i].style.display = "none";
    }
  }else{
    var items1 = document.getElementsByClassName("development1");
    for (var i=0; i < items1.length; i++) {
      items1[i].style.display = "none";
    }
    var items2 = document.getElementsByClassName("development2");
    for (var i=0; i < items2.length; i++) {
      items2[i].style.display = "none";
    }
    var items3 = document.getElementsByClassName("development");
    for (var i=0; i < items3.length; i++) {
      items3[i].style.display = "none";
    }
    reset();
  }
}

function analyticsAnswerType(answer) {
  if (answer == "yes") {
    document.getElementById("topic").options[0].selected = true;
    var items = document.getElementsByClassName("answer2");
    for (var i=0; i < items.length; i++) {
      items[i].style.display = "block";
    }
    var items1 = document.getElementsByClassName("analyticsAnswer1");
    for (var i=0; i < items1.length; i++) {
      items1[i].style.display = "none";
    }
  }else{
    var items1 = document.getElementsByClassName("analyticsAnswer1");
    for (var i=0; i < items1.length; i++) {
      items1[i].style.display = "none";
    }
    reset();
  }
}

function selectedTopic() {
  var topic = document.getElementById("topic").value;
  if (topic != "") {
    xhr = new XMLHttpRequest();

  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementsByClassName("analyticsResult")[0].innerHTML = xhr.responseText+"<br><br>Or you may check the thesis repository to find more studies that you might use.";
      //document.getElementsByClassName("analyticsResult")[0].style.display = "block";
    var items = document.getElementsByClassName("analyticsResult");
		for (var i=0; i < items.length; i++) {
			items[i].style.display = "block";
		}
    var items = document.getElementsByClassName("answer2");
		for (var i=0; i < items.length; i++) {
			items[i].style.display = "none";
		}
    }
  }
  xhr.open("POST", "chatbot_analytics1.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("topic="+topic);
  }
  
}


function pageDisplay(num,total_count) {
  prevNum = num;
    for (let index = 1; index < (total_count+1); index++) {
    if (index == num) {
      var items = document.getElementsByClassName("page"+index);
      for (var i=0; i < items.length; i++) {
        items[i].style.display = "block";
      }
    }else{
      var items = document.getElementsByClassName("page"+index);
      for (var i=0; i < items.length; i++) {
        items[i].style.display = "none";
      }
    }
    }    
  
      if (num == 1 ) {
      for (let index = 1; index < (total_count+1); index++) {
      if (num == index || (num+1) == index || (num+2) == index || (num+3) == index) {
        var items = document.getElementsByClassName("btn"+index);
        for (var i=0; i < items.length; i++) {
          items[i].style.display = "block";
        }
      }else{
        var items = document.getElementsByClassName("btn"+index);
        for (var i=0; i < items.length; i++) {
          items[i].style.display = "none";
        }
      }
      var items = document.getElementsByClassName("btn"+total_count);
      for (var i=0; i < items.length; i++) {
        items[i].style.display = "block";
      }
      }
      }  else if (num > 1 && num < total_count) {
  
      for (let index = 1; index < (total_count+1); index++) {
      var items = document.getElementsByClassName("btn"+1);
      for (var i=0; i < items.length; i++) {
        items[i].style.display = "block";
      }
      if ((num-1) == 1) {
        if (num == index || (num+1) == index || (num+2) == index) {
          var items = document.getElementsByClassName("btn"+index);
          for (var i=0; i < items.length; i++) {
            items[i].style.display = "block";
          }
        }else{
          var items = document.getElementsByClassName("btn"+index);
          for (var i=0; i < items.length; i++) {
            items[i].style.display = "none";
          }
        }
      } else if ((num+1) == total_count) {
        if ((num-2) == index || (num-1) == index || num == index) {
          var items = document.getElementsByClassName("btn"+index);
          for (var i=0; i < items.length; i++) {
            items[i].style.display = "block";
          }
        }else{
          var items = document.getElementsByClassName("btn"+index);
          for (var i=0; i < items.length; i++) {
            items[i].style.display = "none";
          }
        }
      }else{
        if ((num-1) == index || num == index || (num+1) == index) {
          var items = document.getElementsByClassName("btn"+index);
          for (var i=0; i < items.length; i++) {
            items[i].style.display = "block";
          }
        }else{
          var items = document.getElementsByClassName("btn"+index);
          for (var i=0; i < items.length; i++) {
            items[i].style.display = "none";
          }
        }
      }
      
      var items = document.getElementsByClassName("btn"+total_count);
      for (var i=0; i < items.length; i++) {
        items[i].style.display = "block";
      }
      }
      
    }  else if (num == total_count) {
      for (let index = 1; index < (total_count+1); index++) {
      var items = document.getElementsByClassName("btn"+1);
      for (var i=0; i < items.length; i++) {
        items[i].style.display = "block";
      }
      if ((num-3) == index || (num-2) == index || (num-1) == index ||  num == index) {
        var items = document.getElementsByClassName("btn"+index);
        for (var i=0; i < items.length; i++) {
          items[i].style.display = "block";
        }
      }else{
        var items = document.getElementsByClassName("btn"+index);
        for (var i=0; i < items.length; i++) {
          items[i].style.display = "none";
        }
      }
      }
    }
  
  }
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };