<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
	<h6 class="panel-title txt-dark"><?php echo direction("Academy Details","تفاصيل الأكادمية") ?></h6>
</div>
	<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
	<form class="" method="POST" action="" enctype="multipart/form-data">
		<div class="row m-0">
			<div class="col-md-6">
			<label><?php echo direction("Sports","الرياضات") ?></label>
			<select id="mySelect3" name="sport[]" class="select2 select2-multiple select2-hidden-accessible" data-placeholder="Choose" multiple required>
				<?php
				if( $sportsList = selectDB("sports","`status` = '0' AND `hidden` = '0' ORDER BY `enTitle` ASC") ){
					for( $i =0; $i < sizeof($sportsList); $i++ ){
						echo "<option value='{$sportsList[$i]["id"]}'>{$sportsList[$i]["enTitle"]}</option>";
					}
				}
				?>
			</select>
			</div>

			<div class="col-md-6">
			<label><?php echo direction("Gender","الجنس") ?></label>
			<select id="mySelect" name="gender[]" class="select2 select2-multiple select2-hidden-accessible" data-placeholder="Choose" multiple required>
				<?php
				if( $genders = selectDB("genders","`id` != '0' ORDER BY `id` ASC") ){
					for( $i =0; $i < sizeof($genders); $i++ ){
						echo "<option value='{$genders[$i]["id"]}'>".direction("{$genders[$i]["enTitle"]} - {$genders[$i]["enSubTitle"]}","{$genders[$i]["arTitle"]} - {$genders[$i]["arSubTitle"]}") ."</option>";
					}
				}
				?>
			</select>
			</div>

			<div class="col-md-6">
			<label><?php echo direction("English Title","الإسم الإنجليزي") ?></label>
			<input type="text" name="enTitle" class="form-control" required>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Arabic Title","الإسم العربي") ?></label>
			<input type="text" name="arTitle" class="form-control" required>
			</div>

			<div class="col-md-6">
			<label><?php echo direction("English Details","التفاصيل الإنجليزي") ?></label>
			<textarea name="enDetails" class="form-control" style="width:100%;height:250px" required></textarea>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Arabic Details","التفاصيل العربي") ?></label>
			<textarea name="arDetails" class="form-control" style="width:100%;height:250px" required></textarea>
			</div>

			<div class="col-md-3">
			<label><?php echo direction("TikTok","التيك توك") ?></label>
			<input type="text" name="tiktok" class="form-control" required>
			</div>
			
			<div class="col-md-3">
			<label><?php echo direction("Instagram","الإنستجرام") ?></label>
			<input type="text" name="instagram" class="form-control" required>
			</div>

			<div class="col-md-3">
			<label><?php echo direction("Snapchat","سناب شات") ?></label>
			<input type="text" name="snapchat" class="form-control" required>
			</div>
			
			<div class="col-md-3">
			<label><?php echo direction("Youtube","يوتيوب") ?></label>
			<input type="text" name="youtube" class="form-control" required>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Alert English","التنبيه بالإنجليزي") ?></label>
			<input type="text" name="enAlert" class="form-control" required>
			</div>

			<div class="col-md-6">
			<label><?php echo direction("Alert Arabic","التنبيه بالعربي") ?></label>
			<input type="text" name="arAlert" class="form-control" required>
			</div>

			<div class="col-md-12">
			<label><?php echo direction("IBAN","الأيبان") ?></label>
			<input type="text" name="iban" class="form-control" required>
			</div>

			<div class="col-md-12">
			<label><?php echo direction("Logo","الشعار") ?></label>
			<input type="file" name="imageurl" class="form-control" >
			</div>

			<div id="images" style="margin-top: 10px; display:none">
				<div class="col-md-12">
				<img id="logoImg" src="" style="width:250px;height:250px">
				</div>
			</div>
			
			<div class="col-md-6" style="margin-top:10px">
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
<h6 class="panel-title txt-dark"><?php echo direction("List of Academies","قائمة الأكاديمات") ?></h6>
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
		<th><?php echo direction("Title","العنوان") ?></th>
		<th class="text-nowrap"><?php echo direction("Actions","الخيارات") ?></th>
		</tr>
		</thead>
		
		<tbody>
		<?php 
		if( $academies = selectDB("academies","`status` = '0'") ){
			for( $i = 0; $i < sizeof($academies); $i++ ){
				$academyTitle = direction($academies[$i]["enTitle"],$academies[$i]["arTitle"]);
				if ( $academies[$i]["hidden"] == 1 ){
					$icon = "fa fa-eye";
					$link = "?show={$academies[$i]["id"]}";
					$hide = direction("Show","أظهر");
				}else{
					$icon = "fa fa-eye-slash";
					$link = "?hide={$academies[$i]["id"]}";
					$hide = direction("Hide","إخفاء");
				}
				?>
				<tr>
				<td><?php echo $counter = 1 + $i ?></td>
				<td><?php echo $academyTitle ?></td>
				<td class="text-nowrap">
					<a href="?v=Sessions&code=<?php echo $academies[$i]["id"] ?>" class="btn btn-primary"><?php echo direction("Sessions","المحاضرات") ?></a>
					<a href="?v=Subscriptions&code=<?php echo $academies[$i]["id"] ?>" class="btn btn-success"><?php echo direction("Subscriptions","الإشتراكات") ?></a>
					<a id="<?php echo $academies[$i]["id"] ?>" class="edit btn btn-warning" data-toggle="tooltip" data-original-title="<?php echo direction("Edit","تعديل")  ?>"> <i class="fa fa-pencil text-inverse m-r-10"></i>
					</a>
					<a href="<?php echo $link . "&v={$_GET["v"]}" ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $hide ?>"> <i class="<?php echo $icon ?> text-inverse m-r-10"></i></a>
					<a href="?delId=<?php echo $academies[$i]["id"] . "&v={$_GET["v"]}" ?>" data-toggle="tooltip" data-original-title="<?php echo direction("Delete","حذف")  ?>" class="btn btn-danger"><i class="fa fa-close text-inverse"></i>
					</a>
					<div style="display:none"><label id="logo<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["imageurl"] ?></label></div>
					<div style="display:none"><label id="sport<?php echo $academies[$i]["id"]?>"><?php print_r($academies[$i]["sport"]) ?></label></div>
					<div style="display:none"><label id="gender<?php echo $academies[$i]["id"]?>"><?php print_r($academies[$i]["gender"]) ?></label></div>
					<div style="display:none"><label id="enTitle<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["enTitle"] ?></label></div>
					<div style="display:none"><label id="arTitle<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["arTitle"] ?></label></div>
					<div style="display:none"><label id="tiktok<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["tiktok"] ?></label></div>
					<div style="display:none"><label id="instagram<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["instagram"] ?></label></div>
					<div style="display:none"><label id="snapchat<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["snapchat"] ?></label></div>
					<div style="display:none"><label id="youtube<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["youtube"] ?></label></div>
					<div style="display:none"><label id="enDetails<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["enDetails"] ?></label></div>
					<div style="display:none"><label id="arDetails<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["arDetails"] ?></label></div>
					<div style="display:none"><label id="enAlert<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["enAlert"] ?></label></div>
					<div style="display:none"><label id="arAlert<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["arAlert"] ?></label></div>
					<div style="display:none"><label id="iban<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["iban"] ?></label></div>
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
		$(document).ready(function() {
			$('#mySelect').select2();
			$('#mySelect3').select2();

		$(document).on("click",".edit", function(){
			var id = $(this).attr("id");
			var enTitle = $("#enTitle"+id).html();
			var arTitle = $("#arTitle"+id).html();
			var enDetails = $("#enDetails"+id).html();
			var arDetails = $("#arDetails"+id).html();
			var tiktok = $("#tiktok"+id).html();
			var instagram = $("#instagram"+id).html();
			var snapchat = $("#snapchat"+id).html();
			var youtube = $("#youtube"+id).html();
			var enAlert = $("#enAlert"+id).html();
			var arAlert = $("#arAlert"+id).html();
			var gender = $("#gender"+id).html();
			var sport = $("#sport"+id).html();
			var logo = $("#logo"+id).html();
			var iban = $("#iban"+id).html();
			$("input[name=update]").val(id);
			$("input[name=enTitle]").val(enTitle).focus();
			$("input[name=arTitle]").val(arTitle);
			$("textarea[name=enDetails]").html(enDetails);
			$("textarea[name=arDetails]").html(arDetails);
			$("input[name=tiktok]").val(tiktok);
			$("input[name=instagram]").val(instagram);
			$("input[name=snapchat]").val(snapchat);
			$("input[name=youtube]").val(youtube);
			$("input[name=arAlert]").val(arAlert);
			$("input[name=enAlert]").val(enAlert);
			$("input[name=iban]").val(iban);
			$("#logoImg").attr("src","../logos/"+logo);
			$("#images").attr("style","margin-top:10px;display:block");
			//$("select[name=genders]").val(gender);
			var genderArray = JSON.parse(gender);
			var sportArray = JSON.parse(sport);
			setSelectedOptions(genderArray, "gender");
			setSelectedOptions(sportArray, "sport");
			//$("select[name=sport]").val(sport).trigger('change');
			console.log("genderArray:", genderArray);
			console.log("sportArray:", sportArray);
		})
	});
		function setSelectedOptions(array, selectName) {
			for (var i = 0; i < array.length; i++) {
				$("select[name=" + selectName + "] option[value='" + array[i] + "']").prop("selected", true);
			}
		}
	</script>