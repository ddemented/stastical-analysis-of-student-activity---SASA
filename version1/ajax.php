
<?php
mysql_connect("localhost","root","acb132")or die("cannot connect");
mysql_query("use project");
$i=1;
$a=array();
$result=mysql_fetch_array(mysql_query("select max(transaction_id) from log"));
$max=$result[0];
while($i < 9){
	$b=array();
	$result=mysql_fetch_array(mysql_query("select * from log where transaction_id=$max"));
	$roll_no=$result['stu_roll_no'];
	$gate_id=$result['gate_id'];
	$gate_type=$result['gate_type'];
	if($gate_type=="regional_gate"){
		$gate_name=mysql_fetch_array(mysql_query("select gate_name from regional_gate where gate_id=$gate_id"));
		$gate_name=$gate_name[0];
	}
	else{
		$building_id=mysql_fetch_array(mysql_query("select building_id from building_gate where gate_id=$gate_id"));
		$gate_name=mysql_fetch_array(mysql_query("select building_name from building where building_id=$building_id[0]"));
		$gate_name=$gate_name[0];
	}
	array_push($b,$roll_no);
	array_push($b,$result['time']);
	array_push($b,$gate_name);
	array_push($a,$b);

	//echo "<tr>";
	//echo "<td>".$max."<td>".$roll_no."<td>".$result['time']."<td>".$gate_name."</tr>";
	$i++;
	$max--;
	}
	echo json_encode($a);
?>
