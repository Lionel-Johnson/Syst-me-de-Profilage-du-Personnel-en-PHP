<link rel="stylesheet" type="text/css" href="css/style1.css">
<center>
    <div class="backk" style="float: left; margin-left: 120px;">
        <button><a href="individual_report.php">Retour</a></button>
    </div>
    <div class="filterss" style="float: right; margin-right: 120px;" onload="refresh();">
        <button onclick="printContent('print')" id = "hit" style="float: right;">Imprimer le Rapport</button>
        <input id="btnExport" type="button" value="Export to Excel" style="float: right; margin-top: 30px; margin-right: -86px;">
        
    </div>
    <div ng-app="myApp" ng-controller="myCtrl">
        <div class="prepared-form" style="border: 1px solid; width: 30%; margin-right: 480px;">
            <i>Note: Veuillez remplire ce formulaire.</i>
            <br><br>
            <table>
            <tr>
			<td>Preparé par  :</td>
                <td><input ng-model="firstname" placeholder="Name" class="form-control"></td>
            </tr>
            <tr>
                <td>Position :</td>
                <td><input ng-model="position" placeholder="Position" class="form-control"></td>
            </tr>
            <tr>
                <td>Certifié Correct :</td>
                <td><input ng-model="certifié" placeholder="Name" class="form-control"></td>
            </tr>
            <tr>
                <td>Position :</td>
                <td><input ng-model="position1" placeholder="Position" class="form-control"></td>
            </tr>
           </table>
        </div>
    <br><br>
    <div id="print" style="border: 1px solid; width: auto; height: auto;">
        <div class="report-title" style = "margin:10px;"><br/>
            <div class="print-logo">
                <img src="images/CHMSC_logo.png" width="120px" height="120px" style="margin-left: -330px; position: absolute;">
            </div>
            <center>République Gabonaise</center>
            <center><strong>Lionel-Brice ECOLE 241</strong></center>
            <center>Port-Gentil, Afrique Centrale</center>
            <center>Tel. No. (+241) 74129812</center>
            <br />
            <center><strong>PROJET DE SOUTENANCE</strong></center>
            <center><strong>dès <?php echo date('F Y'); ?></strong></center>
        </div>
			<br />
			<br />
			<br />
			<br />
				<table id = "example" class = "stripe order-table" cellspacing = "0" style="margin: 10px;">
                   <thead>
                        <tr>
                            <td>Nom des retraitéss</td>
                            <td>Poste/Rang</td>
                            <td>Age</td>
                            <td>Date de Naissance</td>
                            <td>Date du 1er RDV</td>
                            <td>Année de Services</td>
                            <td>Statut</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                       include('connect.php');
                                    $display = $con->prepare("SELECT * FROM tbl_personnel LEFT JOIN tbl_academic_rank ON tbl_personnel.rank_id = tbl_academic_rank.rank_id LEFT JOIN tbl_gass_rank ON tbl_personnel.gass_id = tbl_gass_rank.gass_id");
                                    $display->execute();
                                    $fetch = $display->fetchAll();
                                    
                                    foreach($fetch as $key => $row){
                                    
                                        $bday = $row["per_date_of_birth"];
                                        $appointment = $row["per_date_of_original_appointment"];
                                        $date = new DateTime($bday);
                                        $date1 = new DateTime($appointment);
                                        $now = new DateTime();

                                        $difference = $date->diff($now)->format('%y');
                                        $service = $date1->diff($now)->format('%y');
                                        ?>

                                        <?php

                                        if ($difference >= 65) {
                                        ?>
                                    <tr>
                                        <td><?php echo $row['per_firstname'];?></td>
                                        <td><?php echo $row['gass_name']." ".$row['rank_name'];?></td>
                                        <td><?php echo $difference; ?></td>
                                        <td><?php echo $row['per_date_of_birth']; ?></td>
                                        <td><?php echo $row['per_date_of_original_appointment']; ?></td>
                                        <td><?php echo $service; ?></td>
                                        <td>Force Retirement</td>
                                    </tr>                               
                                <?php } elseif ($difference >= 60) { ?>
                                    <tr>
                                        <td><?php echo $row['per_firstname'];?></td>
                                        <td><?php echo $row['gass_name']." ".$row['rank_name'];?></td>
                                        <td><?php echo $difference; ?></td>
                                        <td><?php echo $row['per_date_of_birth']; ?></td>
                                        <td><?php echo $row['per_date_of_original_appointment']; ?></td>
                                        <td><?php echo $service; ?></td>
                                        <td>Optional Retirement</td>
                                    </tr> 
                    <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
			<br><br><br>
			<div class="noted">
				<label>Preparé par:</label>
				<br>
				<br>
				<label style="text-transform: uppercase;"><strong>{{firstname}}</strong></label>
				<br>
				<label style="text-transform: capitalize;">{{position}}</label>
				<br><br><br>
				<label>Certifié Correct:</label>
				<br>
				<br>
				<label style="text-transform: uppercase;"><strong>{{certifié}}</strong></label>
				<br>
				<label style="text-transform: capitalize;">{{position1}}</label>
				<br><br><br>
			</div>
		</div>
	</div>
	</center>

<script src="plugins/js/jquery-1.js"></script>

<script type="text/javascript">
$("#btnExport").click(function (e) {
    //getting values of current time for generating the file name
    var dt = new Date();
    var day = dt.getDate();
    var month = dt.getMonth() + 1;
    var year = dt.getFullYear();
    var hour = dt.getHours();
    var mins = dt.getMinutes();
    var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
    //creating a temporary HTML link element (they support setting file names)
    var a = document.createElement('a');
    //getting data from our div that contains the HTML table
    var data_type = 'data:application/vnd.ms-excel;charset=utf-8';
    
    var table_html = $('#print')[0].outerHTML;
//    table_html = table_html.replace(/ /g, '%20');
    table_html = table_html.replace(/<tfoot[\s\S.]*tfoot>/gmi, '');
    
    var css_html = '<style>td {border: 0.5pt solid #c0c0c0} .tRight { text-align:right} .tLeft { text-align:left} </style>';
//    css_html = css_html.replace(/ /g, '%20');
    
    a.href = data_type + ',' + encodeURIComponent('<html><head>' + css_html + '</' + 'head><body>' + table_html + '</body></html>');
    
    //setting the file name
    a.download = 'Summary of Retirees_' + postfix + '.xls';
    //triggering the function
    a.click();
    //just in case, prevent default behaviour
    e.preventDefault();
});
</script>
<script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>
<script type="text/javascript">
	(function(document) {
	'use strict';

	var LightTableFilter = (function(Arr) {

		var _input;

		function _onInputEvent(e) {
			_input = e.target;
			var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
			Arr.forEach.call(tables, function(table) {
				Arr.forEach.call(table.tBodies, function(tbody) {
					Arr.forEach.call(tbody.rows, _filter);
				});
			});
		}

		function _filter(row) {
			var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
			row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
		}

		return {
			init: function() {
				var inputs = document.getElementsByClassName('light-table-filter');
				Arr.forEach.call(inputs, function(input) {
					input.oninput = _onInputEvent;
				});
			}
		};
	})(Array.prototype);

	document.addEventListener('readystatechange', function() {
		if (document.readyState === 'complete') {
			LightTableFilter.init();
		}
	});

})(document);
</script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope) {
    $scope.name = " ";
});
app.filter('capitalize', function() {
    return function(input) {
      return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
    }
});
</script>