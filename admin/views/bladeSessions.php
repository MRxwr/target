<?php
if( $academy = selectDB2("`academyId`","branches","`id` = '{$_GET["code"]}'")){
	$academyId = $academy[0]["academyId"];
}else{
	$academyId = 0;
}
?>
<div class="col-sm-12" style="padding: 10px;">
	<a class="btn btn-default" href="?v=Branches&code=<?php echo $academyId ?>" ><?php echo direction("Back to list of branches","العوده لقائمة الأفرع") ?></a>
</div>

<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
	<h6 class="panel-title txt-dark"><?php echo direction("Session Details","تفاصيل المحاضرة") ?></h6>
</div>
	<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
	<form class="" method="POST" action="" enctype="multipart/form-data">
		<div class="row m-0">
			<div class="col-md-4">
			<label><?php echo direction("English Title","العنوان بالإنجليزي") ?></label>
			<input type="text" name="enTitle" class="form-control" required>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Arabic Title","العنوان بالعربي") ?></label>
			<input type="text" name="arTitle" class="form-control" required>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Quantity","الكمية") ?></label>
			<input type="number" step="1" min="0" name="quantity" class="form-control" required>
			</div>
			
			<div class="col-md-12" style="margin-top:10px">
			<input type="submit" class="btn btn-primary" value="<?php echo direction("Submit","أرسل") ?>">
			<input type="hidden" name="update" value="0">
            <input type="hidden" name="branchId" value="<?php echo $_GET["code"] ?>">
			<input type="hidden" name="academyId" value="<?php echo $academyId ?>">
			</div>
		</div>
	</form>
</div>
</div>
</div>
</div>
				
				<!-- Bordered Table -->
<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
<h6 class="panel-title txt-dark"><?php echo direction("List of Sessions","قائمة المحاضرات") ?></h6>
</div>
<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="table-wrap mt-40">
<div class="table-responsive">
	<table class="table display responsive product-overview mb-30" id="myTable">
		<thead>
		<tr>
		<th>#</th>
		<th><?php echo direction("English Title","العنوان بالإنجليزي") ?></th>
		<th><?php echo direction("Arabic Title","العنوان بالعربي") ?></th>
		<th><?php echo direction("Quantity","الكمية") ?></th>
		<th class="text-nowrap"><?php echo direction("Actions","الخيارات") ?></th>
		</tr>
		</thead>
		
		<tbody>
		<?php 
		$orderBy = direction("enTitle","arTitle");
		if( $sessions = selectDB("sessions","`status` = '0' AND `branchId` LIKE '{$_GET["code"]}' ORDER BY `{$orderBy}` ASC") ){
			for( $i = 0; $i < sizeof($sessions); $i++ ){
				if ( $sessions[$i]["hidden"] == 1 ){
					$icon = "fa fa-eye";
					$link = "?show={$sessions[$i]["id"]}";
					$hide = direction("Show","أظهر");
				}else{
					$icon = "fa fa-eye-slash";
					$link = "?hide={$sessions[$i]["id"]}";
					$hide = direction("Hide","إخفاء");
				}
				?>
				<tr>
				<td><?php echo $counter = $i + 1 ?></td>
				<td id="enTitle<?php echo $sessions[$i]["id"]?>" ><?php echo $sessions[$i]["enTitle"] ?></td>
				<td id="arTitle<?php echo $sessions[$i]["id"]?>" ><?php echo $sessions[$i]["arTitle"] ?></td>
				<td id="quantity<?php echo $sessions[$i]["id"]?>" ><?php echo $sessions[$i]["quantity"] ?></td>
				<td class="text-nowrap">
					<a id="<?php echo $sessions[$i]["id"] ?>" class="edit btn btn-warning" data-toggle="tooltip" data-original-title="<?php echo direction("Edit","تعديل") ?>"> <i class="fa fa-pencil text-inverse m-r-10"></i>
					</a>
					<a href="<?php echo $link . "&v={$_GET["v"]}&code={$_GET["code"]}" ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $hide ?>"> <i class="<?php echo $icon ?> text-inverse m-r-10"></i></a>			
					<a href="<?php echo "?delId={$sessions[$i]["id"]}&v={$_GET["v"]}&code={$_GET["code"]}" ?>" class="btn btn-danger" data-toggle="tooltip" data-original-title="<?php echo direction("Delete","حذف") ?>"> <i class="fa fa-times text-inverse m-r-10"></i></a>			
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
	<!-- JavaScript -->
	
	<script>
		$(document).on("click",".edit", function(){
			var id = $(this).attr("id");
			var enTitle = $("#enTitle"+id).html();
			var arTitle = $("#arTitle"+id).html();
			var quantity = $("#quantity"+id).html();
            $("input[name=update]").val(id);
			$("input[name=enTitle]").val(enTitle).focus();
			$("input[name=arTitle]").val(arTitle);
			$("input[name=quantity]").val(quantity);
		})
	</script>