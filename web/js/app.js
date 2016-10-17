// Code goes here

var app = angular.module('myApp', []);

app.controller('POSController', function ($scope, $http)
{
    $scope.fileName = 'blank.jpg';
    $scope.focusImage = '';
    
    var data = {
    "090913PB5300Q6JB86KT": {count: 1, detail: "Hard disk sata lap-top", id: 1, price: 169.50, fileName: '14.jpg'},
    "734484105929": {count: 1, detail: "Marker", id: 2, price: 389.90, fileName: '15.jpg' },
    "G8BC0005Z320": {count: 1, detail: "Mouse USB 2.0", id: 3, price: 39.99, fileName: '17.jpg' },
    "WMAM9LC66056": {count: 1, detail: "Hard disk desk-top", id: 4, price: 79.98, fileName: '16.jpg' },
    "5010182974612": {count: 1, detail: "Raid", id: 5, price: 279.99, fileName: '17.jpg' },
    "6033000170484": {count: 1, detail: "Soldier Powder", id: 6, price: 4.50, fileName: '17.jpg' },
    "6001087357067": {count: 1, detail: "Vaseline", id: 7, price: 179.99, fileName: '14.jpg' },
    "9780072397246": {count: 1, detail: "Internet Business Model", id: 8, price: 890.99, fileName: '15.jpg' },
    "XW3C24X06E800023607": {count: 1, detail: "Fan Coolling", id: 9, price: 139.99, fileName: '16.jpg' },
    "JP890513": {count: 1, detail: "Microphone", id: 10, price: 20.99, fileName: '17.jpg' },
    "WD800JD-60LSA5": {count: 1, detail: "lap-top hp Model 23DSF", id: 11, price: 1067.99, fileName: '17.jpg' },
    "381648-002": {count: 1, detail: "Ambrella", id: 12, price: 50.99, fileName: '14.jpg' },
    "2A833033HUCPCA": {count: 1, detail: "Italian Choose 23MSD", id: 13, price: 369.50, fileName: '15.jpg' },
    "PB5300": {count: 1, detail: "Apple Watch", id: 14, price: 990.99, fileName: '14.jpg' },
    "9780312380618": {count: 1, detail: "Neptune avenue", id: 15, price: 89.99, fileName: '15.jpg' },
    "BI881600472": {count: 1, detail: "Desk-top graphic card D33006", id: 16, price: 49.99, fileName: '16.jpg' },
    "9C16238807": {count: 1, detail: "Desk-top graphic card D33008", id: 17, price: 129.99, fileName: '17.jpg' },
    "051131995222": {count: 1, detail: "Nexcare 3M", id: 18, price: 7.50, fileName: '18.jpg'},
    "4800888184030": {count: 1, detail: "Rexona Men", id: 19, price: 4.20, fileName: '19.jpg'},
    "9780198610458": {count: 1, detail: "Oxford French Mini Dic", id: 20, price: 10.79, fileName: '20.jpg'},
  };
        
    $scope.itemsCnt = 1;
    $scope.order = [];
    $scope.isDisabled = true;

    function isEmpty(obj) {
        return Object.keys(obj).length === 0;
    }
    
  //$scope.barcode = 6588969543172554;
  $scope.$watch("barcode", function(newValue, oldValue) {
    if (newValue)
      addSale(newValue);
  });
  
  function addSale(barcode) {
    var item = data[barcode];
    
    var foodItem = {
        orderedItemCnt: 1,
        totalPrice: item.price,
        detail: item.detail,
        itemId: item.id,
        id: $scope.itemsCnt,
        item: item,
    };
    
    //By S@int-Cyr
    $scope.fileName = item.fileName;
    $scope.barcode = '';
    console.log(foodItem);
    
    
    // Find if the item is already in Cart
        var cartItems = $.grep($scope.order, function(e){ return e.itemId == item.id; });

         if(cartItems.length > 0  && !isEmpty($scope.order)){
            cartItems[0].orderedItemCnt = ++ cartItems[0].orderedItemCnt; 
            cartItems[0].totalPrice = item.price * cartItems[0].orderedItemCnt;
         }
         else{
            $scope.order.push(foodItem);
            $scope.itemsCnt = $scope.order.length; 
         }
  }
    
    $scope.getSum = function() {
      var i = 0,
        sum = 0;

      for(; i < $scope.order.length; i++) {
        sum += parseInt($scope.order[i].totalPrice, 10);
      }
      return sum;
    };

    $scope.addItem = function(item, index) {
          item.orderedItemCnt = ++ item.orderedItemCnt; 
          item.totalPrice = item.item.price * item.orderedItemCnt;
    };


    $scope.subtractItem = function(item, $index)
    {
      if (item.orderedItemCnt > 1) {
          item.orderedItemCnt = -- item.orderedItemCnt; 
          item.totalPrice = item.item.price * item.orderedItemCnt;
      }
      else{
          $scope.isDisabled = true;
          // isDisabled = false;    
         // $("#SubstractItemBtn").prop("disabled", true);
      }
    }

    $scope.deleteItem = function(index) {
      $scope.order.splice(index, 1);
    };
    
    $scope.checkout = function(index) {
      //S@int-Cyr edition start here
      //Data to be sent to the server (order[])
      var data = {
          'order': $scope.order,
      };
      //Data containing the response from the server
      var outPut = $http.post('http://localhost/VTALLY/web/app_dev.php/api/fronts', data);
      //When successfull response comes from the server
      outPut.success(function(data, status, headers, config){
          alert( "successfull message: " + JSON.stringify({data: data}));
          //alert("Order total: $" + $scope.getSum() + "\n\nPayment received. Thanks. cache: " + $scope.cacheAmount + "change: " + $scope.getChange());
          $scope.order = [];
          
      });
      
      outPut.error(function(data, status, header, config){
          alert('an error occur: cannot perform the transaction');
      });
      //S@int-Cyr edition end here
      
      //alert("Order total: $" + $scope.getSum() + "\n\nPayment received. Thanks. cache: " + $scope.cacheAmount + "change: " + $scope.getChange());
      //$scope.order = [];
    };
    
    $scope.clearOrder = function() {
      $scope.order = [];
      
    };
    
    $scope.getChange = function(){
        if($scope.getSum()){
            var change = 0;
            change = $scope.cacheAmount - $scope.getSum();
            return change;
        }
    }
    
    $scope.focused = function(){
        $scope.focusImage = 'fa-spin';
    }
    
    $scope.blurred = function(){
        $scope.focusImage = 'no-access.png';
    }
});

