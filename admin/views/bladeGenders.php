<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
	<h6 class="panel-title txt-dark"><?php echo direction("Gender Details","تفاصيل الجنس") ?></h6>
</div>
	<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
	<form class="" method="POST" action="" enctype="multipart/form-data">
		<div class="row m-0">
			
			<div class="col-md-6">
			<label><?php echo direction("English Title","العنوان بالإنجليزي") ?></label>
			<input type="text" name="enTitle" class="form-control" required>
			</div>

			<div class="col-md-6">
			<label><?php echo direction("English Sub-Title","العنوان بالإنجليزي الفرعي") ?></label>
			<input type="text" name="enSubTitle" class="form-control" required>
			</div>

            <div class="col-md-6">
			<label><?php echo direction("Arabic Title","العنوان بالعربي") ?></label>
			<input type="text" name="arTitle" class="form-control" required>
			</div>

			<div class="col-md-6">
			<label><?php echo direction("Arabic Sub-Title","العنوان بالعربي الفرعي") ?></label>
			<input type="text" name="arSubTitle" class="form-control" required>
			</div>

			<div class="col-md-6" style="margin-top:10px">
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
<form method="post" action="">
<input name="updateRank" type="hidden" value="1">
<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
<h6 class="panel-title txt-dark"><?php echo direction("List of Genders", "قائمة الأجناس") ?></h6>
</div>
<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
<button class="btn btn-primary">
<?php echo direction("Submit rank","أرسل الترتيب") ?>
</button>  
<div class="table-wrap mt-40">
<div class="table-responsive">
	<table class="table display responsive product-overview mb-30" id="myTable">
		<thead>
		<tr>
		<th>#</th>
		<th><?php echo direction("English Title","العنوان بالإنجليزي") ?></th>
		<th><?php echo direction("English Sub-Title","العنوان بالإنجليزي الفرعي") ?></th>
		<th><?php echo direction("Arabic Title","العنوان بالعربي") ?></th>
		<th><?php echo direction("Arabic Sub-Title","العنوان بالعربي الفرعي") ?></th>
		<th class="text-nowrap"><?php echo direction("Actions","الخيارات") ?></th>
		</tr>
		</thead>
		
		<tbody>
		<?php 
		if( $genders = selectDB("genders","`status` = '0' AND `academyId` = '{$_GET["code"]}' ORDER BY `order` ASC") ){
			for( $i = 0; $i < sizeof($genders); $i++ ){
			$counter = $i + 1;
			if ( $genders[$i]["hidden"] == 1 ){
				$icon = "fa fa-eye";
				$link = "?show={$genders[$i]["id"]}";
				$hide = direction("Show","أظهر");
			}else{
				$icon = "fa fa-eye-slash";
				$link = "?hide={$genders[$i]["id"]}";
				$hide = direction("Hide","إخفاء");
			}
		?>
		<tr>
		<td>
		<input name="order[]" class="form-control" type="number" value="<?php echo $genders[$i]["order"] ?>">
		<input name="id[]" class="form-control" type="hidden" value="<?php echo $genders[$i]["id"] ?>">
		</td>
		<td id="enTitle<?php echo $genders[$i]["id"]?>" ><?php echo $genders[$i]["enTitle"] ?></td>
		<td id="arTitle<?php echo $genders[$i]["id"]?>" ><?php echo $genders[$i]["arTitle"] ?></td>
		<td id="enSubTitle<?php echo $genders[$i]["id"]?>" ><?php echo $genders[$i]["enSubTitle"] ?></td>
		<td id="arSubTitle<?php echo $genders[$i]["id"]?>" ><?php echo $genders[$i]["arSubTitle"] ?></td>
		<td class="text-nowrap">
		
		<a id="<?php echo $genders[$i]["id"] ?>" class="edit btn btn-warning" data-toggle="tooltip" data-original-title="<?php echo direction("Edit","تعديل")  ?>"> <i class="fa fa-pencil text-inverse m-r-10"></i>
		</a>
		<a href="<?php echo $link . "&v={$_GET["v"]}&code={$_GET["code"]}" ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $hide ?>"> <i class="<?php echo $icon ?> text-inverse m-r-10"></i>
		</a>
		<a href="?delId=<?php echo $genders[$i]["id"] . "&v={$_GET["v"]}&code={$_GET["code"]}" ?>" data-toggle="tooltip" data-original-title="<?php echo direction("Delete","حذف")  ?>" class="btn btn-danger"><i class="fa fa-close text-inverse"></i>
		</a>
		<div style="display:none"><label id="hidden<?php echo $genders[$i]["id"]?>"><?php echo $genders[$i]["hidden"] ?></label></div>
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
</form>
	
	<script>
		$(document).on("click",".edit", function(){
			var id = $(this).attr("id");
			var arTitle = $("#arTitle"+id).html();
			var arSubTitle = $("#arSubTitle"+id).html();
			var enTitle = $("#enTitle"+id).html();
			var enSubTitle = $("#enSubTitle"+id).html();
			var hidden = $("#hidden"+id).html();
			$("input[name=arTitle]").val(arTitle).focus();
			$("input[name=arSubTitle]").val(arSubTitle).focus();
			$("input[name=update]").val(id);
			$("input[name=enTitle]").val(enTitle);
			$("input[name=enSubTitle]").val(enSubTitle);
		})
	</script>