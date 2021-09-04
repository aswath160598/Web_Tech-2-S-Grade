angular.module('myApp', ['ngAnimate']);

angular.module('myApp')
.controller('myController', function ($scope, $window) {
   // console.log($scope.inventory);


$scope.inv=[]
  //   $scope.inv = [{ "id" : 12, "category" : "tent","description" : "4-person tent","price" : 319.99, "qty" : 1 }
  // ];
    var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       // Typical action to be performed when the document is ready:
     // console.log(xhttp.responseText);
      $scope.tmp = angular.fromJson(xhttp.responseText);
      //console.log($scope.tmp,typeof($scope.tmp));
     console.log(Object.entries($scope.tmp.map((e)=>({[e[0]]:e[1]}))));
     $scope.inv.push(angular.copy($scope.tmp[0]));

     console.log(typeof($scope.inv[0]));

  //        $scope.inventory = [
  //   { "id" : 12, category : "tent",         "description" : "4-person tent",        "price" : 319.99, "qty" : 1 }
  // ];
    }
};
xhttp.open("GET", "results.json", true);
 xhttp.send();

console.log(typeof($scope.inv[0]));
console.log("dsdf");
$scope.inventory=[]
//angular.copy($scope.inv,$scope.inventory);
console.log($scope.inventory);

    $scope.inventory = [
    { "id" : 12, category : "tent",         "description" : "4-person tent",        "price" : 319.99, "qty" : 1 }
  ];

  //console.log(typeof($scope.inventory[0]),($scope.inv));
  // console.log($scope.inventory);
  $scope.cart = [];
      
  var findItemById = function(items, id) {
    return _.find(items, function(item) {
      return item.id === id;
    });
  };
  
  $scope.getCost = function(item) {
    return item.qty * item.price;
  };

  $scope.addItem = function(itemToAdd) {
    var found = findItemById($scope.cart, itemToAdd.id);
    if (found) {
      found.qty += itemToAdd.qty;
    }
    else {
      $scope.cart.push(angular.copy(itemToAdd));}
  };
  
  $scope.getTotal = function() {
    var total =  _.reduce($scope.cart, function(sum, item) {
      return sum + $scope.getCost(item);
    }, 0);
    console.log('total: ' + total);
    return total;
  };
  
  $scope.clearCart = function() {
    $scope.cart.length = 0;
  };
  
  $scope.removeItem = function(item) {
    var index = $scope.cart.indexOf(item);
    $scope.cart.splice(index, 1);
  };

  $scope.clicked = function(event,$http){
//var mydata = JSON.parse(data);
//console.log(typeof($scope.inventory[0]),typeof(mydata[event.target.id]),$scope.inventory);
//$scope.inventory.push(angular.copy(mydata[event.target.id]));

$http.get('results.json').then(function(response) {
   console.log(response.data);
});
//console.log(mydata[e]);  
  };
    
});
//function clicked(e,$scope){
////      var mydata=JSON.parse(data);
////    console.log(mydata[e]);
//    $scope.inventory.push(mydata[e]);
//  }