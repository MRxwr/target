<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
	<h6 class="panel-title txt-dark"><?php echo direction("Attendance Details","تفاصيل الحضور") ?></h6>
</div>
	<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
	<form class="" method="POST" action="" enctype="multipart/form-data">
		<div class="row m-0">
			
			<div class="col-md-4">
			<label><?php echo direction("Academy","الأكادمية") ?></label>
			<select id="mySelect3" name="academyId" class="form-control" required >
				<?php
                echo $where = ( empty($empAcademy) ) ? "`id` NOT LIKE '0'": " AND `id` = '{$empAcademy}'";
				if( $academies = selectDB("academies","{$where}") ){
					for( $i =0; $i < sizeof($academies); $i++ ){
                        echo "<option value='{$academy[$i]["id"]}'>".direction("{$academy[$i]["enTitle"]}","{$academy[$i]["arTitle"]}");
					}
				}
				?>
			</select>
			</div>
			
			<div class="col-md-12" style="margin-top:10px">
			<input type="submit" class="btn btn-primary" value="<?php echo direction("Submit","أرسل") ?>">
			<input type="hidden" name="update" value="0">
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
<h6 class="panel-title txt-dark"><?php echo direction("List of Subscriptions","قائمة الإشتراكات") ?></h6>
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
		<th><?php echo direction("Sport","الرياضات") ?></th>
		<th><?php echo direction("English Title","العنوان الإنجليزي") ?></th>
		<th><?php echo direction("Arabic Title","العنوان بالعربي") ?></th>
		<th><?php echo direction("Days","الأيام") ?></th>
		<th><?php echo direction("Price","السعر") ?></th>
		<th><?php echo direction("Price after discount","السعر بعد الخصم") ?></th>
		<th class="text-nowrap"><?php echo direction("Actions","الخيارات") ?></th>
		</tr>
		</thead>
		
		<tbody>
		<?php 
		$orderBy = direction("enTitle","arTitle");
		if( $subscriptions = selectDB("subscriptions","`status` = '0' AND `academyId` LIKE '{$_GET["code"]}' ORDER BY `{$orderBy}` ASC") ){
			for( $i = 0; $i < sizeof($subscriptions); $i++ ){
				$genders = json_decode($subscriptions[$i]["genders"],true);;
				$gender = selectDB("genders","`id` = '{$genders[0]}'");
				if ( $subscriptions[$i]["hidden"] == 1 ){
					$icon = "fa fa-eye";
					$link = "?show={$subscriptions[$i]["id"]}";
					$hide = direction("Show","أظهر");
				}else{
					$icon = "fa fa-eye-slash";
					$link = "?hide={$subscriptions[$i]["id"]}";
					$hide = direction("Hide","إخفاء");
				}
				if( $sportTitle = selectDB("sports","`id` = '{$subscriptions[$i]["sportId"]}'") ){
					$sportTitle = direction($sportTitle[0]["enTitle"],$sportTitle[0]["arTitle"]);
				}else{
					$sportTitle = "";
				}
				?>
				<tr>
				<td><?php echo $counter = $i + 1 ?></td>
				<td><?php echo $sportTitle ?><label style="display:none" id="sport<?php echo $subscriptions[$i]["id"] ?>"><?php echo $subscriptions[$i]["sportId"] ?></label></td>
				<td><?php echo "{$subscriptions[$i]["enTitle"]} - {$gender[0]["enTitle"]} {$gender[0]["enSubTitle"]}" ?></td>
				<td><?php echo "{$subscriptions[$i]["arTitle"]} - {$gender[0]["arTitle"]} {$gender[0]["arSubTitle"]}" ?></td>
				<td id="numberOfDays<?php echo $subscriptions[$i]["id"]?>" ><?php echo $subscriptions[$i]["numberOfDays"] ?></td>
				<td id="price<?php echo $subscriptions[$i]["id"]?>" ><?php echo $subscriptions[$i]["price"] ?></td>
				<td id="priceAfterDiscount<?php echo $subscriptions[$i]["id"]?>" ><?php echo $subscriptions[$i]["priceAfterDiscount"] ?></td>
				<td class="text-nowrap">
					<a id="<?php echo $subscriptions[$i]["id"] ?>" class="edit btn btn-warning" data-toggle="tooltip" data-original-title="<?php echo direction("Edit","تعديل") ?>"> <i class="fa fa-pencil text-inverse m-r-10"></i>
					</a>
					<a href="<?php echo $link . "&v={$_GET["v"]}&code={$_GET["code"]}" ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $hide ?>"> <i class="<?php echo $icon ?> text-inverse m-r-10"></i></a>			
					<a href="<?php echo "?delId={$subscriptions[$i]["id"]}&v={$_GET["v"]}&code={$_GET["code"]}" ?>" class="btn btn-danger" data-toggle="tooltip" data-original-title="<?php echo direction("Delete","حذف") ?>"> <i class="fa fa-times text-inverse m-r-10"></i></a>
					<label id="enTitle<?php echo $subscriptions[$i]["id"] ?>" style="display:none"><?php echo $subscriptions[$i]["enTitle"] ?></label>
					<label id="arTitle<?php echo $subscriptions[$i]["id"] ?>" style="display:none"><?php echo $subscriptions[$i]["arTitle"] ?></label>
					<label id="enDetails<?php echo $subscriptions[$i]["id"] ?>" style="display:none"><?php echo $subscriptions[$i]["enDetails"] ?></label>
					<label id="arDetails<?php echo $subscriptions[$i]["id"] ?>" style="display:none"><?php echo $subscriptions[$i]["arDetails"] ?></label>
					<label id="enSubTitle<?php echo $subscriptions[$i]["id"] ?>" style="display:none"><?php echo $subscriptions[$i]["enSubTitle"] ?></label>
					<label id="arSubTitle<?php echo $subscriptions[$i]["id"] ?>" style="display:none"><?php echo $subscriptions[$i]["arSubTitle"] ?></label>
					<label id="genders<?php echo $subscriptions[$i]["id"] ?>" style="display:none"><?php echo $subscriptions[$i]["genders"] ?></label>
					<label id="branches<?php echo $subscriptions[$i]["id"] ?>" style="display:none"><?php echo $subscriptions[$i]["branches"] ?></label>
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
		$(document).ready(function() {
			$('#mySelect3').select2();
		});
	</script>