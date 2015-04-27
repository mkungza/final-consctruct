var app = angular.module('calModule',['ngSanitize']);

app.controller("TabController", function() {
	    this.tab = 1;

	    this.isSet = function(checkTab) {
	      return this.tab === checkTab;
	    };

	    this.setTab = function(setTab) {
	      this.tab = setTab;
	    };
  	});

app.controller('calculate', function($scope) {

	$scope.rows = [];
	$scope.rows2 = [];
	$scope.rows3 = [];
	$scope.rows4 = [];
	$scope.twoface = {
		value : false
	};
 	$scope.addRow = function () {
 		$scope.square = $scope.width * $scope.height;

 		if($scope.type == 1) {
 				$scope.types = 'ผนังก่อสามัญ (อิฐมอญ) ครึ่งแผ่นอิฐ		';
 				$scope.details = 'อิฐสามัญ (อิฐมอญ)  ขนาด 3.5 x 7 x 16 ซม.		 '+$scope.square*138+' 	ก้อน\nปูนซีเมนต์ผสม(Silica Cement)		 '+$scope.square*16.01+' 	กก.\nน้ำยาผสมปูนก่อ		 '+$scope.square*10.29+' 	กก.\nทรายหยาบ		 '+$scope.square*0.05+' 	ลบ.ม.\nน้ำผสมคอนกรีต		 '+$scope.square*10+' 	ลิตร';
 		}
 		else if($scope.type == 2) {
 				$scope.types = 'ผนังก่อสามัญ (อิฐมอญ) เต็มแผ่นอิฐ	';
 				$scope.details = 'อิฐสามัญ (อิฐมอญ  ขนาด 3.5 x 7 x 16 ซม.	 '+$scope.square*276+' 	ก้อน\nปูนซีเมนต์ผสม(Silica Cement)	 '+$scope.square*34.00+' 	กก.\nน้ำยาผสมปูนก่อ		 '+$scope.square*20.59+' 	กก.\nทรายหยาบ		 '+$scope.square*0.12+' 	ลบ.ม.\nน้ำผสมคอนกรีต		 '+$scope.square*20+' 	ลิตร';
 		}
 		else if($scope.type == 3) {
 				$scope.types = 'ผนังก่อดินเผาชนิดไม่รับน้ำหนัก (อิฐ 2 รู) ครึ่งแผ่นอิฐ';
 				$scope.details = 'อิฐดินเผาชนิด 2 รูขนาด 3 x 7 x 16 ซม.	 '+$scope.square*140+' 	ก้อน\nปูนซีเมนต์ผสม(Silica Cement)		 '+$scope.square*16.00+' 	กก.\nน้ำยาผสมปูนก่อ		 '+$scope.square*10.29+' 	กก.\nทรายหยาบ		 '+$scope.square*0.05+' 	ลบ.ม.\nน้ำผสมคอนกรีต		 '+$scope.square*10+' 	ลิตร	';
 		}
 		else if($scope.type == 4) {
 				$scope.types = 'ผนังก่อดินเผาชนิดไม่รับน้ำหนัก (อิฐ 2 รู) เต็มแผ่นอิฐ';
 				$scope.details = 'อิฐดินเผาชนิด 2 รูขนาด 3 x 7 x 16 ซม.		 '+$scope.square*279+' 	ก้อน\nปูนซีเมนต์ผสม(Silica Cement)		 '+$scope.square*34.00+' 	กก.\nน้ำยาผสมปูนก่อ		 '+$scope.square*20.59+' 	กก.\nทรายหยาบ		 '+$scope.square*0.12+' 	ลบ.ม.\nน้ำผสมคอนกรีต		 '+$scope.square*20+' 	ลิตร';
 		}
 		else if($scope.type == 5) {
 				$scope.types = 'ผนังก่ออิฐดินเผาชนิดทนไฟ	';
 				$scope.details = 'อิฐดินเผาชนิดทนไฟขนาด 11.5 x 23 x 7.6 ซม.		 '+$scope.square*60+' 	ก้อน\nปูนซีเมนต์ผสม(Silica Cement)		 '+$scope.square*5.50+' 	กก.\nน้ำยาผสมปูนก่อ		 '+$scope.square*3.00+' 	กก.\nทรายหยาบ		 '+$scope.square*0.03+' 	ลบ.ม.\nน้ำผสมคอนกรีต		 '+$scope.square*10+' 	ลิตร';
 		}
 		else if($scope.type == 6) {
 				$scope.types = 'ผนังก่อซีเมนต์บล็อคขนาด 0.07x0.19x0.39 ม.';
 				$scope.details = 'ซีเมนต์บล็อค (12.5 แผ่น +4%)		 '+$scope.square*13+' 	ก้อน\nปูนซีเมนต์ผสม(Silica Cement)		 '+$scope.square*6.75+' 	กก.\nปูนซีเมนต์ผสม(Silica Cement)		 '+$scope.square*6.75+' 	กก.\nน้ำยาผสมปูนก่อ		 '+$scope.square*3.87+' 	กก.\nทรายหยาบ		 '+$scope.square*0.03+' 	ลบ.ม.\nน้ำผสมคอนกรีต		 '+$scope.square*5+' 	ลิตร';
 		}
 		else if($scope.type == 7) {
 				$scope.types = 'ผนังก่อซีเมนต์บล็อคขนาด 0.09x0.19x0.39 ม.';
 				$scope.details = 'ซีเมนต์บล็อค (12.5 แผ่น +4%)		 '+$scope.square*13+' 	ก้อน\nปูนซีเมนต์ผสม(Silica Cement)		 '+$scope.square*9.47+' 	กก.\nน้ำยาผสมปูนก่อ		 '+$scope.square*5.43+' 	กก.\nทรายหยาบ		 '+$scope.square*0.04+' 	ลบ.ม.\nน้ำผสมคอนกรีต		 '+$scope.square*5+' 	ลิตร';
 		}
 		else if($scope.type == 8) {
 				$scope.types = 'ผนังก่อซีเมนต์บล็อคชนิดระบายอากาศขนาด 0.09x0.19x0.39 ม.';
 				$scope.details = 'ซีเมนต์บล็อคชนิดระบายอากาศ (12.5 แผ่น +4%)		 '+$scope.square*13+' 	ก้อน\nปูนซีเมนต์ผสม(Silica Cement)		 '+$scope.square*9.47+' 	กก.\nน้ำยาผสมปูนก่อ		 '+$scope.square*5.43+' 	กก.\nทรายหยาบ		 '+$scope.square*0.04+' 	ลบ.ม.\nน้ำผสมคอนกรีต		 '+$scope.square*5+' 	ลิตร';
 		}
        $scope.rows.push({ 'type':$scope.types, 'width':$scope.width, 'height': $scope.height, 'details': $scope.details });
        $scope.width='';
		$scope.height='';	 
		$scope.details = '';        
    };

    $scope.removeRow = function(name){				
		var index = -1;		
		var comArr = eval( $scope.rows );
		for( var i = 0; i < comArr.length; i++ ) {
			if( comArr[i].name === name ) {
				index = i;
				break;
			}
		}
		if( index === -1 ) {
			alert( "Something gone wrong" );
		}
		$scope.rows.splice( index, 1 );		
	};

	$scope.addRow2 = function () {
		$scope.square2 = $scope.width2 * $scope.height2;
		if($scope.twoface.value) {
			$scope.two = 'YES';
			$scope.square2 = $scope.square2 * 2;
		}
		else {
			$scope.two = 'NO';
		}
		$scope.details2 = 'ปูนซีเมนต์ผสม = '+$scope.square2*20+' กก.\nปูนขาว = '+$scope.square2*7.7+' กก.\nทรายละเอียด = '+$scope.square2*0.03+' ลบ.ม.\nน้ำ = '+$scope.square2*3+' ลิตร';
		$scope.rows2.push({ 'type':$scope.type2, 'width2':$scope.width2, 'height2': $scope.height2,'two': $scope.two, 'details2': $scope.details2 });
        $scope.width2='';
		$scope.height2='';	    
	}
    $scope.removeRow2 = function(name){				
		var index = -1;		
		var comArr = eval( $scope.rows2 );
		for( var i = 0; i < comArr.length; i++ ) {
			if( comArr[i].name === name ) {
				index = i;
				break;
			}
		}
		if( index === -1 ) {
			alert( "Something gone wrong" );
		}
		$scope.rows2.splice( index, 1 );		
	};

		$scope.addRow3 = function () {
		$scope.square3 = $scope.width3 * $scope.height3;
		if($scope.size == 1) {
 				$scope.types3 = 'กระเบื้อง 4x4		';
 				$scope.num = $scope.square3 * 100;
 		}
 		else if($scope.size == 2) {
 				$scope.types3 = 'กระเบื้อง 6x6		';
 				$scope.num = $scope.square3 * 44;
 
 		}
 		else if($scope.size == 3) {
 				$scope.types3 = 'กระเบื้อง 8x8		';
 				$scope.num = $scope.square3 * 25;
 
 		}
 		else if($scope.size == 4) {
 				$scope.types3 = 'กระเบื้อง 8x10		';
 				$scope.num = $scope.square3 * 20;
 
 		}
 		else if($scope.size == 5) {
 				$scope.types3 = 'กระเบื้อง 8x12		';
 				$scope.num = $scope.square3 * 16;
 
 		}
 		else if($scope.size == 6) {
 				$scope.types2 = 'กระเบื้อง 8x16		';
 				$scope.num = $scope.square2 * 12;
 
 		}
 		else if($scope.size == 7) {
 				$scope.types3 = 'กระเบื้อง 12x12		';
 				$scope.num = $scope.square3 * 11;
 
 		}
 		else if($scope.size == 8) {
 				$scope.types3 = 'กระเบื้อง 13x13		';
 				$scope.num = $scope.square3 * 9;
 
 		}
 		else if($scope.size == 9) {
 				$scope.types3 = 'กระเบื้อง 16x16		';
 				$scope.num = $scope.square3 * 6;
 
 		}
 		else if($scope.size == 10) {
 				$scope.types3 = 'กระเบื้อง 18x18		';
 				$scope.num = $scope.square3 * 5;
 
 		}
 		else if($scope.size == 11) {
 				$scope.types3 = 'กระเบื้อง 20x20		';
 				$scope.num = $scope.square3 * 4;
 
 		}
 		else if($scope.size == 12) {
 				$scope.types3 = 'กระเบื้อง 24x24		';
 				$scope.num = $scope.square3 * 2.78;
 
 		}
 		$scope.details3 = 'ใช้กระเบื้อง '+$scope.num+' แผ่น';
		$scope.rows3.push({ 'type':$scope.types3, 'width3':$scope.width3, 'height3': $scope.height3, 'details3': $scope.details3 });
        $scope.width3='';
		$scope.height3='';	    
	}
    $scope.removeRow3 = function(name){				
		var index = -1;		
		var comArr = eval( $scope.rows3 );
		for( var i = 0; i < comArr.length; i++ ) {
			if( comArr[i].name === name ) {
				index = i;
				break;
			}
		}
		if( index === -1 ) {
			alert( "Something gone wrong" );
		}
		$scope.rows3.splice( index, 1 );		
	};

	$scope.addRow4 = function () {
		$scope.square4 = $scope.width4 * $scope.height4 * $scope.depth4;
		$scope.details4 = 'ปูนซีเมนต์ = '+$scope.square4*305+' กก./ลบ.ม.\nทราย = '+$scope.square4*635+' กก./ ลบ.ม.\nหิน = '+$scope.square4*1275+' กก./ลบ.ม.\nน้ำ = '+$scope.square4*185+' กก./ ลบ.ม.\n';
		$scope.rows4.push({ 'type':'เทพื้น', 'width4':$scope.width4, 'height4': $scope.height4, 'depth4': $scope.depth4, 'details4': $scope.details4 });
        $scope.width4='';
		$scope.height4='';	 
		$scope.depth4 = '';   
	}
    $scope.removeRow4 = function(name){				
		var index = -1;		
		var comArr = eval( $scope.rows4 );
		for( var i = 0; i < comArr.length; i++ ) {
			if( comArr[i].name === name ) {
				index = i;
				break;
			}
		}
		if( index === -1 ) {
			alert( "Something gone wrong" );
		}
		$scope.rows4.splice( index, 1 );		
	};
  

});

function printYouWant(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     alert(printContents);
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}