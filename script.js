//SIDEBAR OPEN AND CLICK FUNCTION

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



function chart() {
	xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status == 200){

			arr = xhr.responseText;
			const new_arr = arr.split(',');
			// const arr = [1,2,3,4,5,6,7,8,9];
    
			 const new_Arr = [];
			 while(new_arr.length) new_Arr.push(new_arr.splice(0,2));

			 drawChart(new_Arr);

        }
    }
    xhr.open("POST","chart_analytics.php",true);
    xhr.send();
}


// Draw the chart and set the chart values
function drawChart() {

	  test_arr1 = [
  ['Task','Hours per Day'],
  ['Work',8],
  ['Friends',2],
  ['Eat',2],
  ['TV',2],
  ['Gym',2],
  ['Sleep',8]];
  var data = google.visualization.arrayToDataTable(test_arr1);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'My Average Day', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}