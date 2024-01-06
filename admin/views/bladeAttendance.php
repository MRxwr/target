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
			<label><?php echo direction("Date","التاريخ") ?></label>
			<input type="date" name="date" class="form-control" required >
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Academy","الأكادمية") ?></label>
			<select id="mySelect1" name="academyId" class="form-control" required >
				<?php
                $where = ( empty($empAcademy) ) ? "`id` != '0'": " AND `id` = '{$empAcademy}'";
                $orderBy = direction("enTitle","arTitle");
                echo "<option value='0' selected >".direction("Please select academy","يرجى تحديد الأكادمية")."</option>";
				if( $academies = selectDB("academies","{$where} AND `status` = '0' ORDER BY `{$orderBy}` ASC") ){
					for( $i =0; $i < sizeof($academies); $i++ ){
                        echo "<option value='{$academies[$i]["id"]}'>".direction("{$academies[$i]["enTitle"]}","{$academies[$i]["arTitle"]}");
					}
				}
				?>
			</select>
			</div>

            <div class="col-md-4">
			<label><?php echo direction("Sport","الرياضة") ?></label>
			<select id="mySelect2" name="sportId" class="form-control" required >
				
			</select>
			</div>

            <div class="col-md-4">
			<label><?php echo direction("Branches","الفروع") ?></label>
			<select id="mySelect3" name="bracnhId" class="form-control" required >
				
			</select>
			</div>

            <div class="col-md-4">
			<label><?php echo direction("Days","الأيام") ?></label>
			<select id="mySelect4" name="dayId" class="form-control" required >
				
			</select>
			</div>

            <div class="col-md-4">
			<label><?php echo direction("Session","الجلسة") ?></label>
			<select id="mySelect5" name="sessionId" class="form-control" required >
				
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

<div id="hidden" style="display: none;">
        <div id="hiddenSport">
            <?php 
                $where = ( empty($empAcademy) ) ? "`id` != '0'": " AND `id` = '{$empAcademy}'";
                $orderBy = direction("enTitle","arTitle");
				if( $branches = selectDB("branches","{$where} AND `status` = '0' GROUP BY `sportId` ORDER BY `{$orderBy}` ASC") ){
					for( $i =0; $i < sizeof($branches); $i++ ){
                        $sport = selectDB("sports","`id` = '{$branches[$i]["sportId"]}'");
                        echo "<option value='{$sport[0]["id"]}' id='academy{$branches[$i]["academyId"]}'>".direction("{$sport[0]["enTitle"]}","{$sport[0]["arTitle"]}");
					}
				}
            ?>
        </div>
        <div id="hiddenBranch">
            <?php 
                $where = ( empty($empAcademy) ) ? "`id` != '0'": " AND `id` = '{$empAcademy}'";
                $orderBy = direction("enTitle","arTitle");
				if( $branches = selectDB("branches","{$where} AND `status` = '0' ORDER BY `{$orderBy}` ASC") ){
					for( $i =0; $i < sizeof($branches); $i++ ){
                        echo "<option value='{$branches[$i]["id"]}' id='sport{$branches[$i]["sportId"]}'>".direction("{$branches[$i]["enTitle"]}","{$branches[$i]["arTitle"]}");
					}
				}
            ?>
        </div>
        <div id="hiddenDay">

        </div>
        <div id="hiddenSession">

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
			/*$('#mySelect1').select2();
            $('#mySelect2').select2();
            $('#mySelect3').select2();
            $('#mySelect4').select2();
            $('#mySelect5').select2();*/
		});

        $(document).on("change","#mySelect1",function(){
            $("#mySelect2").html();
            var academyId = $(this).val();
            var sports = $("#hiddenSport").find("option[id='academy"+academyId+"']");
            $("#mySelect2").html(sports);
            $("#hiddenSport").html(sports);
        })
        $(document).on("change","#mySelect2",function(){
            $("#mySelect3").html()
            var sportId = $(this).val();
            var branches = $("#hiddenBranch").find("option[id='sport"+sportId+"']");
            $("#mySelect3").html(branches);
            $("#hiddenBranch").html(branches);
        })
	</script>