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
