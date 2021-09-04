function clicked1(e)
{
//alert("you clicked");
console.log(e);
//alert("hello");
//var mydata = JSON.parse(data);
console.log(data[e]);
//console.log(mydata[e]);

// var obj = {
 //   table: []
// };
// obj.table.push(mydata[e]);

// var fs = require('fs');
// // fs.writeFile('myjsonfile.json', json, 'utf8', callback);
// fs.writeFile('opt/lampp/htdocs/WT2/TEC/output.txt', JSON.stringify(mydata[e]) , null,4),(err) => {
     
//     // In case of a error throw err.
//     if (err)
//     console.log("error");
// };

      $.ajax({
           type: "POST",
           url:'ajax.php',
      dataType:'json', // add json datatyp e to get json
      data: {name:data[e]},
           success:function(data) {
             console.log(data);
           }

      });



// //myAjax();
}

// function myAjax() {
//       $.ajax({
//            type: "POST",
//            url:'ajax.php',
//       dataType:'json', // add json datatyp e to get json
//       data: {name: data[e]},
//            success:function(data) {
//              console.log(data);
//            }

//       });
//  }


// function clicked1()
// {
// var xhttp = new XMLHttpRequest();
// xhttp.onreadystatechange = function() {
//     if (this.readyState == 4 && this.status == 200) {
//        // Typical action to be performed when the document is ready:
//       console.log(xhttp.responseText);
//     }
// };
// xhttp.open("GET", "results.json", true);
// xhttp.send();
// }