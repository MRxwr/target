<!-- Bordered Table -->
<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
	<div class="pull-left"><h6 class="panel-title txt-dark"><?php echo direction("List of Users","قائمة الأعضاء") ?></h6></div>
	<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="table-wrap mt-40">
<div class="table-responsive">
	<table class="table display responsive product-overview mb-30" id="myTable">
		<thead>
		<tr>
		<th><?php echo direction("Name","الإسم الأول") ?></th>
		<th><?php echo direction("Mobile","الهاتف") ?></th>
		<th class="text-nowrap"><?php echo direction("Actions","الخيارات") ?></th>
		</tr>
		</thead>
		
		<tbody>
		<?php 
		if( $users = selectDB("orders","`id` != '0' GROUP BY `phone`, `fName`") ){
			for( $i = 0; $i < sizeof($users); $i++ ){
				?>
				<tr>
				<td id="firstName<?php echo $users[$i]["id"]?>" ><?php echo "{$users[$i]["fName"]} {$users[$i]["mName"]} {$users[$i]["lName"]}" ?></td>
				<td id="mobile<?php echo $users[$i]["id"]?>" ><?php echo $users[$i]["phone"] ?></td>
				<td class="text-nowrap">
				<a href="?v=UserInfo&id=<?php echo $users[$i]["id"] ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $hide ?>"> <?php echo direction("More","المزيد") ?>
				</a>			
				</td>
				</tr>
				<?php
			}
		}
		?>
		</tbody>
		
	</table>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
	$(document).on("click",".edit", function(){
		var id = $(this).attr("id");
		var email = $("#email"+id).html();
		var fName = $("#firstName"+id).html();
		var lName = $("#lastName"+id).html();
		var mobile = $("#mobile"+id).html();
		var gender = $("#gender"+id).html();
		var wallet = $("#wallet"+id).html();
		$("input[name=password]").prop("required",false);
		$("input[name=email]").val(email);
		$("input[name=phone]").val(mobile);
		$("select[name=gender]").val(gender);
		$("input[name=update]").val(id);
		$("input[name=firstName]").val(fName);
		$("input[name=firstName]").focus();
		$("input[name=lastName]").val(lName);
		$("input[name=wallet]").val(wallet);
	})
</script>

