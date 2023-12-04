<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
	<h6 class="panel-title txt-dark"><?php echo direction("Subscription Details","تفاصيل الإشتراك") ?></h6>
</div>
	<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
	<form class="" method="POST" action="" enctype="multipart/form-data">
		<div class="row m-0">
			
			<div class="col-md-12">
			<label><?php echo direction("Sports","الرياضات") ?></label>
			<select id="mySelect3" name="sportId" class="form-control"required>
				<?php
				if( $academySport = selectDB("academies","`id` = '{$_GET["code"]}'") ){
					$academySport = json_decode($academySport[0]["sport"],true);
					for( $i =0; $i < sizeof($academySport); $i++ ){
						$sport = selectDB("sports","`id` = '{$academySport[$i]}'");
						echo "<option value='{$sport[0]["id"]}'>".direction("{$sport[0]["enTitle"]}","{$sport[0]["arTitle"]}")."</option>";
					}
				}
				?>
			</select>
			</div>

			<div class="col-md-6">
			<label><?php echo direction("English Title","العنوان بالإنجليزي") ?></label>
			<input type="text" name="enTitle" class="form-control" required>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Arabic Title","العنوان بالعربي") ?></label>
			<input type="text" name="arTitle" class="form-control" required>
			</div>

			<div class="col-md-6">
			<label><?php echo direction("English Sub-Title","العنوان الفرعي بالإنجليزي") ?></label>
			<input type="text" name="enSubTitle" class="form-control" required>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Arabic Sub-Title","العنوان الفرعي بالعربي") ?></label>
			<input type="text" name="arSubTitle" class="form-control" required>
			</div>

			<div class="col-md-6">
			<label><?php echo direction("English Details","التفاصيل بالإنجليزي") ?></label>
			<textarea name="enDetails" class="form-control" style="width:100%;height:250px" required></textarea>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Arabic Details","التفاصيل بالعربي") ?></label>
			<textarea name="arDetails" class="form-control" style="width:100%;height:250px"  required></textarea>
			</div>

            <div class="col-md-4">
			<label><?php echo direction("Number of Days","عدد الأيام") ?></label>
			<input type="number" name="numberOfDays" class="form-control" value="0" required>
			</div>

            <div class="col-md-4">
			<label><?php echo direction("Price","السعر") ?></label>
			<input type="number" step="any" name="price" class="form-control" value="0" required>
			</div>

            <div class="col-md-4">
			<label><?php echo direction("Price after discount","السعر بعد الخصم") ?></label>
			<input type="number" step="any" name="priceAfterDiscount" class="form-control" value="0" required>
			</div>
			
			<div class="col-md-12" style="margin-top:10px">
			<input type="submit" class="btn btn-primary" value="<?php echo direction("Submit","أرسل") ?>">
			<input type="hidden" name="update" value="0">
			<input type="hidden" name="academyId" value="<?php echo $_GET["code"] ?>">
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
				<td id="enTitle<?php echo $subscriptions[$i]["id"]?>" ><?php echo $subscriptions[$i]["enTitle"] ?></td>
				<td id="arTitle<?php echo $subscriptions[$i]["id"]?>" ><?php echo $subscriptions[$i]["arTitle"] ?></td>
				<td id="numberOfDays<?php echo $subscriptions[$i]["id"]?>" ><?php echo $subscriptions[$i]["numberOfDays"] ?></td>
				<td id="price<?php echo $subscriptions[$i]["id"]?>" ><?php echo $subscriptions[$i]["price"] ?></td>
				<td id="priceAfterDiscount<?php echo $subscriptions[$i]["id"]?>" ><?php echo $subscriptions[$i]["priceAfterDiscount"] ?></td>
				<td class="text-nowrap">
					<a id="<?php echo $subscriptions[$i]["id"] ?>" class="edit btn btn-warning" data-toggle="tooltip" data-original-title="<?php echo direction("Edit","تعديل") ?>"> <i class="fa fa-pencil text-inverse m-r-10"></i>
					</a>
					<a href="<?php echo $link . "&v={$_GET["v"]}&code={$_GET["code"]}" ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $hide ?>"> <i class="<?php echo $icon ?> text-inverse m-r-10"></i></a>			
					<a href="<?php echo "?delId={$subscriptions[$i]["id"]}&v={$_GET["v"]}&code={$_GET["code"]}" ?>" class="btn btn-danger" data-toggle="tooltip" data-original-title="<?php echo direction("Delete","حذف") ?>"> <i class="fa fa-times text-inverse m-r-10"></i></a>
					<label id="enDetails<?php echo $subscriptions[$i]["id"] ?>" style="display:none"><?php echo $subscriptions[$i]["enDetails"] ?></label>
					<label id="arDetails<?php echo $subscriptions[$i]["id"] ?>" style="display:none"><?php echo $subscriptions[$i]["arDetails"] ?></label>
					<label id="enSubTitle<?php echo $subscriptions[$i]["id"] ?>" style="display:none"><?php echo $subscriptions[$i]["enSubTitle"] ?></label>
					<label id="arSubTitle<?php echo $subscriptions[$i]["id"] ?>" style="display:none"><?php echo $subscriptions[$i]["arSubTitle"] ?></label>
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
		$(document).on("click",".edit", function(){
			var id = $(this).attr("id");
			var enTitle = $("#enTitle"+id).html();
			var arTitle = $("#arTitle"+id).html();
			var arSubTitle = $("#arSubTitle"+id).html();
			var enSubTitle = $("#enSubTitle"+id).html();
			var enDetails = $("#enDetails"+id).html();
			var arDetails = $("#arDetails"+id).html();
			var sport = $("#sport"+id).html();
			var numberOfDays = $("#numberOfDays"+id).html();
			var price = $("#price"+id).html();
			var priceAfterDiscount = $("#priceAfterDiscount"+id).html();
            $("input[name=update]").val(id);
			$("input[name=enTitle]").val(enTitle).focus();
			$("input[name=arTitle]").val(arTitle);
			$("input[name=arSubTitle]").val(arSubTitle);
			$("input[name=enSubTitle]").val(enSubTitle);
			$("textarea[name=enDetails]").val(enDetails);
			$("textarea[name=arDetails]").val(arDetails);
			var $select = $('#mySelect3');
			$select.val(null).trigger('change');
			var $option = $select.find('option[value="' + sport + '"]');
			$option.prop('selected', true);
			$select.trigger('change');
			$("input[name=numberOfDays]").val(numberOfDays);
			$("input[name=price]").val(price);
			$("input[name=priceAfterDiscount]").val(priceAfterDiscount);
		})
	</script>