<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/libs/init.php');
if($data_user['type'] == '2'){
	for ($d=date('d')-1; $d >= 0; $d--) { 
		$month = date('d-m-Y', (strtotime(date('d-m-Y')." -".$d." days")));
		$revenu = $db->fetch_assoc("SELECT SUM(amount) as total FROM `history_recharge` WHERE `status` IN ('2', '4') AND DATE_FORMAT(FROM_UNIXTIME(history_recharge.created_at), '%d-%m-%Y') = '{$month}'", 0);
		if($revenu['0']['total'] > 1){
			$today_amount[] = $revenu['0']['total'];
		}else{
			$today_amount[] = 0;
		}
		$p[] = 'Ngày '.date('d', (strtotime(date('Y-m-d')." -".$d." days"))).'';
		$month_chart['amount'] = $today_amount;
	}
}elseif($data_user['type'] == '3'){
	for ($d=date('d')-1; $d >= 0; $d--) { 
		$month = date('d-m-Y', (strtotime(date('d-m-Y')." -".$d." days")));
		$revenu = $db->fetch_assoc("SELECT SUM(amount) as total FROM `history_recharge` WHERE `status` IN ('2', '4') AND `site` = '{$data_user['site']}' AND DATE_FORMAT(FROM_UNIXTIME(history_recharge.created_at), '%d-%m-%Y') = '{$month}'", 0);
		if($revenu['0']['total'] > 1){
			$today_amount[] = $revenu['0']['total'];
		}else{
			$today_amount[] = 0;
		}
		$p[] = 'Ngày '.date('d', (strtotime(date('Y-m-d')." -".$d." days"))).'';
		$month_chart['amount'] = $today_amount;
	}
}elseif($data_user['type'] == '4'){
	for ($d=date('d')-1; $d >= 0; $d--) { 
		$month = date('d-m-Y', (strtotime(date('d-m-Y')." -".$d." days")));
		$revenu = $db->fetch_assoc("SELECT SUM(cash) as total FROM `history_buy` WHERE `id` != '0' AND `username_post` = '{$data_user['username']}' AND DATE_FORMAT(FROM_UNIXTIME(history_buy.created_at), '%d-%m-%Y') = '{$month}'", 0);
		if($revenu['0']['total'] > 1){
			$today_amount[] = $revenu['0']['total'];
		}else{
			$today_amount[] = 0;
		}
		$p[] = 'Ngày '.date('d', (strtotime(date('Y-m-d')." -".$d." days"))).'';
		$month_chart['amount'] = $today_amount;
	}
}
?>
function formatNumber(num) {
	return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')+'đ';
}
var optionsProfileVisit = {
	annotations: {
		position: 'back'
	},
	dataLabels: {
		enabled:false
	},
	chart: {
		type: 'bar',
		height: 300
	},
	fill: {
		opacity:1
	},
	plotOptions: {
	},
	series: [{
		name: 'Doanh thu',
		data: <?=json_encode($today_amount)?>
	}],
	colors: '#435ebe',
	xaxis: {
		categories: <?=json_encode($p)?>,
	},
	yaxis: {
		labels: {
			"formatter": function (val) {
				return formatNumber(val.toFixed())
			}
		}
	},
}



var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);

chartProfileVisit.render();