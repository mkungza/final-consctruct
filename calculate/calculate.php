<?php
	if(!isset($_SESSION)){
		session_start();
	}
?>
<!DOCTYPE html>
<html lang="en" ng-app="calModule">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<script language="JavaScript" type="text/javascript" src="/construct/js/jquery-1.11.2.min.js"></script>
		<title>MOCKUP2</title>
		<meta name="description" content="MOCKUP" />
		<meta name="keywords" content="MOCKUP" />
		<meta name="author" content="MOCKUP" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/component.css" />
		<link rel="stylesheet" type="text/css" href="../css/center.css" />
		<link rel="stylesheet" type="text/css" href="/construct/bootstrap/bootstrap.min.css" />
   		<script type="text/javascript" src="/construct/angular/angular.min.js"></script>
   		<script type="text/javascript" src="/construct/calculate/calculate.js"></script> 
   		<script type="text/javascript" src="/construct/angular/angular-sanitize.js"></script>
    	<style>
	    	.white-space-pre-line {
	 	   		white-space: pre-line;
			}
    	</style>
		<!--[if IE]>
  		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
	
		<div class="container">
			<?php include '../header.php'; ?>
			
			<div class="content">

				<div class="tab" ng-controller="TabController as tab">
					<ul class="nav nav-pills">
		            <li ng-class="{ active:tab.isSet(1) }">
		              <a href="" ng-click="tab.setTab(1)">ก่อผนัง</a>
		            </li>
		            <li ng-class="{ active:tab.isSet(2) }">
		              <a href="" ng-click="tab.setTab(2)">กระเบื้อง</a>
		            </li>
		            <li ng-class="{ active:tab.isSet(3) }">
		              <a href="" ng-click="tab.setTab(3)">ฉาบ</a>
		            </li>
		            <li ng-class="{ active:tab.isSet(4) }">
		              <a href="" ng-click="tab.setTab(4)">เทพื้น</a>
		            </li>
		          </ul>
		      	<div ng-controller="calculate">
					<div ng-show="tab.isSet(1)">
					  	<form class="form-horizontal" role="form" ng-submit="addRow()">
							  	<select ng-model="type" name="type" id="type">
									<option selected value="1">(อิฐมอญ) ครึ่งแผ่นอิฐ</option>
									<option value="2">(อิฐมอญ) เต็มแผ่นอิฐ</option>
									<option value="3">(อิฐ 2 รู) ครึ่งแผ่นอิฐ</option>
									<option value="4">(อิฐ 2 รู) เต็มแผ่นอิฐ</option>
									<option value="5">อิฐดินเผาชนิดทนไฟ</option>
									<option value="6">ซีเมนต์บล็อคขนาด 0.07x0.19x0.39 ม.</option>
									<option value="7">ซีเมนต์บล็อคขนาด 0.09x0.19x0.39 ม.</option>
									<option value="8">ซีเมนต์บล็อคชนิดระบายอากาศขนาด 0.09x0.19x0.39 ม.</option>
								</select>
								
						  		<input type="text" name="width" ng-model="width" placeholder="INPUT WIDTH">
						    	<input type="text" name="height" ng-model="height" placeholder="INPUT HEIGHT">
						   		<input type="submit" name="submit" value="calculate" class="btn btn-primary">
						</form>
						<br/>
					
						<table class="table table-striped" id="table1">
							<tr>
								<th>Type</th>
								<th>Width</th>
								<th>Height</th>
								<th>Square Matre</th>
								<th>Details</th>
								<th></th>
							</tr>
							<tr ng-repeat="row in rows">
								<td>{{row.type}}</td>
								<td>{{row.width}}</td>
								<td>{{row.height}}</td>
								<td>{{row.width*row.height}}</td>
								<td class="white-space-pre-line">{{row.details}}</td>
								<td><input type="button" value="Remove" class="btn btn-primary" ng-click="removeRow(row.name)"/></td>
							</tr>
							
						</table>
					</div>

					<div ng-show="tab.isSet(2)">
						 <form class="form-horizontal" role="form" ng-submit="addRow2()">
							<input type="text" name="width2" ng-model="width2" placeholder="INPUT WIDTH">
						    <input type="text" name="height2" ng-model="height2" placeholder="INPUT HEIGHT">
						    ฉาบสองด้าน <input type="checkbox" name="twoface" ng-model="twoface.value">
						   	<input type="submit" name="submit" value="calculate" class="btn btn-primary">
						</form>
						<br/>
						
						<table class="table table-striped">
							<tr>
								<th>Type</th>
								<th>Width</th>
								<th>Height</th>
								<th>Square meter</th>
								<th>Two face</th>
								<th>Details</th>
								<th></th>
							</tr>
							<tr ng-repeat="row in rows2">
								<td>{{row.type}}</td>
								<td>{{row.width2}}</td>
								<td>{{row.height2}}</td>
								<td>{{row.width2*row.height2}}</td>
								<td>{{row.two}}</td>
								<td class="white-space-pre-line">{{row.details2}}</td>
								<td><input type="button" value="Remove" class="btn btn-primary" ng-click="removeRow2(row.name)"/></td>
							</tr>
						</table>
					</div>

					<div ng-show="tab.isSet(3)">
						<form class="form-horizontal" role="form" ng-submit="addRow3()">
							<input type="text" name="width3" ng-model="width3" placeholder="INPUT WIDTH">
						    <input type="text" name="height3" ng-model="height3" placeholder="INPUT HEIGHT">
						    <select ng-model="size" name="size" id="size">
								<option value="1">4x4</option>
								<option value="2">6x6</option>
								<option value="3">8x8</option>
								<option value="4">8x10</option>
								<option value="5">8x12</option>
								<option value="6">8x16</option>
								<option value="7">12x12</option>
								<option value="8">13x13</option>
								<option value="9">16x16</option>
								<option value="10">18x18</option>
								<option value="11">20x20</option>
								<option value="12">24x24</option>
							</select>
						   	<input type="submit" name="submit" value="calculate" class="btn btn-primary">
						</form>
						<br/>
						<table class="table table-striped">
							<tr>
								<th>Type</th>
								<th>Width</th>
								<th>Height</th>
								<th>Square meter</th>
								<th>Details</th>
								<th></th>
							</tr>
							<tr ng-repeat="row in rows3">
								<td>{{row.type}}</td>
								<td>{{row.width3}}</td>
								<td>{{row.height3}}</td>
								<td>{{row.width3*row.height3}}</td>
								<td class="white-space-pre-line">{{row.details3}}</td>
								<td><input type="button" value="Remove" class="btn btn-primary" ng-click="removeRow3(row.name)"/></td>
							</tr>
						</table>
					</div>

					<div ng-show="tab.isSet(4)">
					 <form class="form-horizontal" role="form" ng-submit="addRow4()">
							<input type="text" name="width4" ng-model="width4" placeholder="INPUT WIDTH">
					    	<input type="text" name="height4" ng-model="height4" placeholder="INPUT HEIGHT">
					    	<input type="text" name="depth4" ng-model="depth4" placeholder="INPUT DEPTH">
					   		<input type="submit" name="submit" value="calculate" class="btn btn-primary">
					</form>
					<br/>
					
					<table class="table table-striped">
						<tr>
							<th>Type</th>
							<th>Width</th>
							<th>Height</th>
							<th>Depth</th>
							<th>Qubic meter</th>
							<th>Details</th>
							<th></th>
						</tr>
						<tr ng-repeat="row in rows4">
							<td>{{row.type}}</td>
							<td>{{row.width4}}</td>
							<td>{{row.height4}}</td>
							<td>{{row.depth4}}</td>
							<td>{{row.width4*row.height4*row.depth4}}</td>
							<td class="white-space-pre-line">{{row.details4}}</td>
							<td><input type="button" value="Remove" class="btn btn-primary" ng-click="removeRow4(row.name)"/></td>
						</tr>
					</table>	
				</div>
			</div>
		</div>
	</body>
</html>
