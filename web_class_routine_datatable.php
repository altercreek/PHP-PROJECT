<?php
session_start();
// ============
//include("asset/theme/css/myfunc.php");
include("my_class.php");
$obj=new my_class();
// ============
//$branch_id=$_SESSION['LOGIN_BRANCH'];
//echo "hello";
//exit;
?>

<style type="text/css">
i{
	cursor:pointer;
}

</style>

<div class="row-fluid">
			<table id="sample-table-22" class="table table-striped table-bordered table-hover">
		        <thead>
		            <th>Sl</th>
		            <th>Date</th>
		            <th>Trade Code</th>
		            <th>High</th>
		            <th>Low</th>
		            <th>Open</th>
		            <th>Close</th>
		            <th>Volume</th>
		            <th>Action</th>
		        </thead>
		        <tbody>
		        	<?php
		        		$sl=0;
		        		$dataTable = "stock_market_data LIMIT 300";
						foreach($obj->View_All($dataTable) AS $value1){
						extract($value1);
						//$entry_date = date("d/m/Y", strtotime($value1['_entry_date']));
						$sl++;
						echo "<tr>";
						echo "<td>".$sl."</td>";
						echo "<td>".$value1['date']."</td>";
						echo "<td>".$value1['trade_code']."</td>";
						echo "<td>".$value1['high']."</td>";
						echo "<td>".$value1['low']."</td>";
						echo "<td>".$value1['open']."</td>";
						echo "<td>".$value1['close']."</td>";
						echo "<td>".$value1['volume']."</td>";
						echo '<td><i class="icon-edit bigger-175" title="Edit" href="#modal-web-class-routine" data-toggle="modal" style="hover:cursor;"  onclick="edit_stk_info('.$value1['id'].')"></i>
						<i class="icon-trash bigger-175" title="Delete" onclick="delete_stk_info('.$value1['id'].')" ></i></td>';
						echo "</tr>";
						}
			        ?>

		        </tbody>	
		    </table>
</div>

<script type="text/javascript">
	
	var oTable3 = $('#sample-table-22').dataTable( {
	"aoColumns": [
      { "bSortable": true },
      null,null,null,null,null,null,null,
	  { "bSortable": true }
	  ] } );
</script>