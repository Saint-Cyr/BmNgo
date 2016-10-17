<!DOCTYPE html>
<html ng-app="myApp">

<head>
  <title>Point of Sale Interface</title>
  <!--<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>-->
  <script data-require="jquery@*" data-semver="2.0.3" src="vendor/jquery-3.1.0.min.js"></script>

  <!--<script data-require="angular.js@1.2.13" data-semver="1.2.13" src="http://code.angularjs.org/1.2.13/angular.js"></script>-->
  <script data-require="angular.js@1.2.13" data-semver="1.2.13" src="vendor/angular-1.2.13/angular.js"></script>
  <!--<script data-require="angular.js@1.2.13" data-semver="1.2.13" src="http://code.angularjs.org/1.2.13/angular-animate.js"></script>-->
  <script data-require="angular.js@1.2.13" data-semver="1.2.13" src="vendor/angular-1.2.13/angular-animate.js"></script>

<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">-->
<link rel="stylesheet" href="vendor/bootstrap.min.css">
<!-- Latest compiled and minified JavaScript -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>-->
<script src="vendor/bootstrap.min.js"></script>

  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css"/>
  <script src="app.js"></script>
</head>

<body data-ng-controller="POSController">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
          
        <div class="jumbotron">
            <h1 style="font-size: 120px; color: red;">{{getSum() | currency:' ':true:'1.2-2'}}</h1>
        </div>
        <div class="jumboron">
        <div class="row">
            <form name="itemForm">
                  <input type="password" name="barcode"  style="opacity: 0;" id="barcodeId"
                         ng-model="barcode" ng-model-options="{ debounce: 500 }" autofocus="true" ng-focus="focused()" ng-blur="blurred()"/>
            <br/>
            </form>

            <div class="col-sm-6" onclick="document.getElementById('barcodeId').focus(); document.getElementById('barcodeId').value = ''; return false;">
                  <span ng-model="focusImage">
                      <i class="fa fa-cog {{ focusImage }} fa-5x fa-fw" aria-hidden="true"></i>
                  </span>
                <a href="" ><img src="barecode.jpg" width="125" for="barcodeId"/></a>
            </div>
            <div class="col-sm-6">
                <img src="{{ fileName }}" width="200"/>
                
            </div>
        </div>
        </div>
      </div>
      <br>
      <div class="col-md-6">
        
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Order Summary</h3>
              
            </div>
            <div class="panel-body" style="max-height:320px; overflow:auto;">
              <div class="text-warning" ng-hide="order.length">
                Noting ordered yet !
              </div>
              <ul class="list-group">
                <li class="list-group-item" ng-repeat="item in order">
                    <span style="font-size: 23px;">{{item.detail}}</span>
                  
                  <div class="btn-group pull-right" role="group" aria-label="...">
                      <button type="button" class="btn btn-xs " ng-disabled="" ng-click="subtractItem(item, $index)">
                        <span type="button" class="fa fa-minus"></span>
                      </button>
                      <button type="button" class="btn  btn-xs" ng-click="addItem(item, $index)">
                        <span class="fa fa-plus"></span>
                      </button>
                      
                       <button type="button" class="btn btn-danger btn-xs"  ng-click="deleteItem($index)">
                        <span class="fa fa-trash"></span>
                      </button>                     
                  </div>
                  <div class="label label-success pull-right">{{item.totalPrice | currency:'Gh₵ ':true:'1.2-2'}}</div>
                  <div class="label label-default pull-right">{{item.orderedItemCnt}}</div>
                </li>
              </ul>

            </div>
            <div class="panel-footer" ng-show="order.length">
              <div class="label label-danger ">Total: {{getSum() | currency:'Gh₵ ':true:'1.2-2'}}</div>
            </div>
            <div class="panel-footer" ng-show="order.length">
              <div class="text-muted">
                Do not let go of customer without taking payment !
              </div>
            </div>
            <div class="pull-right">
                <br>
                <div class="input-group col-md-6">
                    <span class="input-group-addon">
                        <i class="fa fa-dolla" aria-hidden="true"></i>
                    </span>
                    <input class="form-control" type="text" placeholder="Cache amount (Gh₵)" ng-model="cacheAmount" ng-disabled="!order.length">
                    
                </div>
                
                <div class="inline-group col-md-6">
                    <span class="btn btn-default" style="color: green;" ng-disabled="!order.length" ng-click="getChange()">{{getChange() | currency:'':true:'1.2-2'}}</span>
                    <span class="btn btn-default" ng-click="clearOrder()" ng-disabled="!order.length">Clear</span>
                    <span class="btn btn-danger" ng-click="checkout()" ng-disabled="!order.length">Checkout</span>
                </div>
              
            </div>

          </div>
        
      </div>
    </div>
      <!--<i class="fa fa-wifi fa-2x fa-fw" aria-hidden="true"></i>-->
      <!--<img src="yellow3.gif" width="20"/>
      <img src="off.gif" width="20"/>-->
      <img src="LG_Blink.gif" width="20"/>
      
      <!--<img src="green.gif" width="20"/>-->
    </div>

    

</body>

</html>

