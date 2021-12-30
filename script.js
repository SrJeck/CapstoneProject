//SIDEBAR OPEN AND CLICK FUNCTION
function openModal(params) {
	document.getElementById("myModal"+params).style.display = "block";
}
function closeModal(params) {
	document.getElementById("myModal"+params).style.display = "none";
	//alert(params)
}
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }
  
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }

//CHATBOT
  $(document).ready(function() {
    $('.chat_icon').click(function() {
      $('.chat_box').toggleClass('active');
    });
  
    $('.my-conv-form-wrapper').convform({selectInputStyle: 'disable'})
  });
//Plagiarism Checker

// Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];
// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';

$("#myPdf").on("change", function(e){
	var file = e.target.files[0]
	if(file.type == "application/pdf"){
		var fileReader = new FileReader();  
		fileReader.onload = function() {
			var pdfData = new Uint8Array(this.result);
			// Using DocumentInitParameters object to load binary data.
			var loadingTask = pdfjsLib.getDocument({data: pdfData});
			loadingTask.promise.then(function(pdf) {
			  console.log('PDF loaded');
			  
			  // Fetch the first page
			  var pageNumber = 1;
			  pdf.getPage(pageNumber).then(function(page) {
				console.log('Page loaded');
				
				var scale = 1.5;
				var viewport = page.getViewport({scale: scale});

				// Prepare canvas using PDF page dimensions
				var canvas = $("#pdfViewer")[0];
				var context = canvas.getContext('2d');
				canvas.height = viewport.height;
				canvas.width = viewport.width;

				// Render PDF page into canvas context
				var renderContext = {
				  canvasContext: context,
				  viewport: viewport
				};
				var renderTask = page.render(renderContext);
				renderTask.promise.then(function () {
				  console.log('Page rendered');
				});
			  });
			}, function (reason) {
			  // PDF loading error
			  console.error(reason);
			});
		};
		fileReader.readAsArrayBuffer(file);
	}
});

// function displayResearch(id) {
//     xhr = new XMLHttpRequest();
//     xhr.open("POST","display.php",true);
//     xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
//     xhr.send("id="+id);
// }

function plagScan() {
	document.getElementById('add_article_form').submit();
	var fullText = document.getElementById('abstract').value;

	xhr = new XMLHttpRequest();

        xhr.onreadystatechange = () =>{
            if(xhr.readyState == 4 && xhr.status == 200){
                document.getElementById('plagscan_output').innerHTML = xhr.responseText;
            }
        }

        xhr.open("POST","plagscan_process.php",true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.send("fullText="+fullText);
}

function proceed() {
	window.location.href = "logOrProf.php";
}

var prevNum = 0;
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