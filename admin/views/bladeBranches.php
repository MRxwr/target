<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
	<h6 class="panel-title txt-dark"><?php echo direction("Branch Details","تفاصيل الأفرع") ?></h6>
</div>
	<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
	<form class="" method="POST" action="" enctype="multipart/form-data">
		<div class="row m-0">

			<div class="col-md-12">
			<label><?php echo direction("Sports","الرياضات") ?></label>
			<select id="mySelect3" name="sportId" class="form-control" required>
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

			<div class="col-md-4">
			<label><?php echo direction("English Title","العنوان بالإنجليزي") ?></label>
			<input type="text" name="enTitle" class="form-control" required>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Arabic Title","العنوان بالعربي") ?></label>
			<input type="text" name="arTitle" class="form-control" required>
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
<h6 class="panel-title txt-dark"><?php echo direction("List of Branches","قائمة الأفرع") ?></h6>
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
		<th><?php echo direction("Sport","الرياضة") ?></th>
		<th><?php echo direction("English Title","العنوان بالإنجليزي") ?></th>
		<th><?php echo direction("Arabic Title","العنوان بالعربي") ?></th>
		<th class="text-nowrap"><?php echo direction("Actions","الخيارات") ?></th>
		</tr>
		</thead>
		
		<tbody>
		<?php 
		$orderBy = direction("enTitle","arTitle");
		if( $branches = selectDB("branches","`status` = '0' AND `academyId` LIKE '{$_GET["code"]}' ORDER BY `{$orderBy}` ASC") ){
			for( $i = 0; $i < sizeof($branches); $i++ ){
				$sport = selectDB("sports","`id` = '{$branches[$i]["sportId"]}'");
				if ( $branches[$i]["hidden"] == 1 ){
					$icon = "fa fa-eye";
					$link = "?show={$branches[$i]["id"]}";
					$hide = direction("Show","أظهر");
				}else{
					$icon = "fa fa-eye-slash";
					$link = "?hide={$branches[$i]["id"]}";
					$hide = direction("Hide","إخفاء");
				}
				?>
				<tr>
				<td><?php echo $counter = $i + 1 ?></td>
				<td><?php echo direction($sport[0]["enTitle"],$sport[0]["arTitle"]) ?></td>
				<td id="enTitle<?php echo $branches[$i]["id"]?>" ><?php echo $branches[$i]["enTitle"] ?></td>
				<td id="arTitle<?php echo $branches[$i]["id"]?>" ><?php echo $branches[$i]["arTitle"] ?></td>
				<td class="text-nowrap">
					<a id="<?php echo $branches[$i]["id"] ?>" class="edit btn btn-warning" data-toggle="tooltip" data-original-title="<?php echo direction("Edit","تعديل") ?>"> <i class="fa fa-pencil text-inverse m-r-10"></i>
					</a>
					<a href="<?php echo $link . "&v={$_GET["v"]}&code={$_GET["code"]}" ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $hide ?>"> <i class="<?php echo $icon ?> text-inverse m-r-10"></i></a>			
					<a href="<?php echo "?delId={$branches[$i]["id"]}&v={$_GET["v"]}&code={$_GET["code"]}" ?>" class="btn btn-danger" data-toggle="tooltip" data-original-title="<?php echo direction("Delete","حذف") ?>"> <i class="fa fa-times text-inverse m-r-10"></i></a>			
					<label id="sportId<?php echo $branches[$i]["id"] ?>" style="display:none"><?php echo $branches[$i]["sportId"] ?></label>
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
            $("input[name=update]").val(id);
			$("input[name=enTitle]").val(enTitle).focus();
			$("input[name=arTitle]").val(arTitle);
		})
	</script>