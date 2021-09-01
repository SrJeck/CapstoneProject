//SIDEBAR OPEN AND CLICK FUNCTION

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }
  
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }


  $(document).ready(function() {
    $('.chat_icon').click(function() {
      $('.chat_box').toggleClass('active');
    });
  
    $('.my-conv-form-wrapper').convform({selectInputStyle: 'disable'})
  });
  