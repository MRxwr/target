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
			<div class="col-md-12">
			<label><?php echo direction("Sports","الرياضات") ?></label>
			<select id="mySelect3" name="sport" class="select2 select2-multiple select2-hidden-accessible" data-placeholder="Choose" multiple required>
				<?php
				if( $sportsList = selectDB("sports","`status` = '0' AND `hidden` = '0' ORDER BY `enTitle` ASC") ){
					for( $i =0; $i < sizeof($sportsList); $i++ ){
						echo "<option value='{$sportsList[$i]["id"]}'>{$sportsList[$i]["enTitle"]}</option>";
					}
				}
				?>
			</select>
			</div>

			<div class="col-md-4">
			<label><?php echo direction("English Title","الإسم الإنجليزي") ?></label>
			<input type="text" name="enTitle" class="form-control" required>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Arabic Title","الإسم العربي") ?></label>
			<input type="text" name="arTitle" class="form-control" required>
			</div>

			<div class="col-md-4">
			<label><?php echo direction("English Details","التفاصيل الإنجليزي") ?></label>
			<input type="text" name="enDetails" class="form-control" required>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Arabic Details","التفاصيل العربي") ?></label>
			<input type="text" name="arDetails" class="form-control" required>
			</div>

			<div class="col-md-3">
			<label><?php echo direction("Gender","النوع") ?></label>
			<select id="mySelect" name="genders" class="select2 select2-multiple select2-hidden-accessible" data-placeholder="Choose" multiple required>
				<?php
				if( $genders = selectDB("genders","`id` != '0' ORDER BY `id` ASC") ){
					for( $i =0; $i < sizeof($genders); $i++ ){
						echo "<option value='{$genders[$i]["id"]}'>".direction($genders[$i]["enTitle"],$genders[$i]["arTitle"]) ."</option>";
					}
				}
				?>
			</select>
			</div>

			<div class="col-md-3">
			<label><?php echo direction("TikTok","التيك توك") ?></label>
			<input type="text" name="tiktok" class="form-control" required>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Instagram","الإنستجرام") ?></label>
			<input type="text" name="instagram" class="form-control" required>
			</div>

			<div class="col-md-3">
			<label><?php echo direction("Snapchat","سناب شات") ?></label>
			<input type="text" name="snapchat" class="form-control" required>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Youtube","يوتيوب") ?></label>
			<input type="text" name="youtube" class="form-control" required>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Alert","التنبيه") ?></label>
			<input type="text" step="alert" name="clothesPrice" class="form-control" required>
			</div>

			<div class="col-md-12">
			<label><?php echo direction("IBAN","الأيبان") ?></label>
			<input type="text" name="iban" class="form-control" required>
			</div>

			<div class="col-md-3">
			<label><?php echo direction("Logo","الشعار") ?></label>
			<input type="file" name="imageurl" class="form-control" >
			</div>

			<div id="images" style="margin-top: 10px; display:none">
				<div class="col-md-3">
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
		<th><?php echo direction("Country","البلد") ?></th>
		<th><?php echo direction("Gender","الجنس") ?></th>
		<th><?php echo direction("Promotion","العرض") ?></th>
		<th><?php echo direction("Clothes? ","ملابس؟") ?></th>
		<th class="text-nowrap"><?php echo direction("Actions","الخيارات") ?></th>
		</tr>
		</thead>
		
		<tbody>
		<?php 
		if( $academies = selectDB("academies","`status` = '0'") ){
			for( $i = 0; $i < sizeof($academies); $i++ ){
				$academyTitle = direction($academies[$i]["enTitle"],$academies[$i]["arTitle"]);
				$videoText = ( !empty($academies[$i]["video"]) ) ? direction("Watch","شاهد") : "";
				$locationText = ( !empty($academies[$i]["location"]) ) ? direction("View","إعرض") : "";
				$isClothesText = ( empty($academies[$i]["isClothes"]) )? direction("No","لا") : direction("Yes","نعم");
				$isPromotionText = ( empty($academies[$i]["isPromotion"]) )? direction("No","لا") : direction("Yes","نعم");
				$genderText = ( $academies[$i]["gender"] == 1 ) ? direction("Man","رجل") : ( ( $academies[$i]["gender"] == 2 ) ? direction("Woman","إمرأه") : ( ( $academies[$i]["gender"] == 3 ) ? direction("Boy","ولد") : direction("Girl","بنت") ) ) ;
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
				<td id="country<?php echo $academies[$i]["id"]?>" ><?php echo $academies[$i]["country"] ?></td>
				<td><?php echo $genderText ?><label style="display:none" id="gender<?php echo $academies[$i]["id"]?>"  ><?php echo $academies[$i]["gender"] ?></label></td>
				<td><?php echo $isPromotionText ?><label style="display:none" id="isPromotion<?php echo $academies[$i]["id"]?>"  ><?php echo $academies[$i]["isPromotion"] ?></label></td>
				<td><?php echo $isClothesText ?><label style="display:none" id="isClothes<?php echo $academies[$i]["id"]?>"  ><?php echo $academies[$i]["isClothes"] ?></label></td>
				<td class="text-nowrap">
					<a href="?v=Sessions&code=<?php echo $academies[$i]["id"] ?>" class="btn btn-primary"><?php echo direction("Sessions","المحاضرات") ?></a>
					<a href="?v=Subscriptions&code=<?php echo $academies[$i]["id"] ?>" class="btn btn-success"><?php echo direction("Subscriptions","الإشتراكات") ?></a>
					<a id="<?php echo $academies[$i]["id"] ?>" class="edit btn btn-warning" data-toggle="tooltip" data-original-title="<?php echo direction("Edit","تعديل")  ?>"> <i class="fa fa-pencil text-inverse m-r-10"></i>
					</a>
					<a href="<?php echo $link . "&v={$_GET["v"]}" ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $hide ?>"> <i class="<?php echo $icon ?> text-inverse m-r-10"></i></a>
					<a href="?delId=<?php echo $academies[$i]["id"] . "&v={$_GET["v"]}" ?>" data-toggle="tooltip" data-original-title="<?php echo direction("Delete","حذف")  ?>" class="btn btn-danger"><i class="fa fa-close text-inverse"></i>
					</a>
					<div style="display:none"><label id="logo<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["imageurl"] ?></label></div>
					<div style="display:none"><label id="sport<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["sport"] ?></label></div>
					<div style="display:none"><label id="enTitle<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["enTitle"] ?></label></div>
					<div style="display:none"><label id="arTitle<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["arTitle"] ?></label></div>
					<div style="display:none"><label id="tiktok<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["tiktok"] ?></label></div>
					<div style="display:none"><label id="instagram<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["instagram"] ?></label></div>
					<div style="display:none"><label id="snapchat<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["snapchat"] ?></label></div>
					<div style="display:none"><label id="youtube<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["youtube"] ?></label></div>
					<div style="display:none"><label id="enDetails<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["enDetails"] ?></label></div>
					<div style="display:none"><label id="arDetails<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["arDetails"] ?></label></div>
					<div style="display:none"><label id="alert<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["alert"] ?></label></div>
					<div style="display:none"><label id="email<?php echo $academies[$i]["id"]?>"><?php echo $academies[$i]["email"] ?></label></div>
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
			$('#mySelect1').select2();
			$('#mySelect2').select2();
			$('#mySelect3').select2();
		});

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
			var alert = $("#alert"+id).html();
			var gender = $("#gender"+id).html();
			var sport = $("#sport"+id).html();
			var logo = $("#logo"+id).html();
			var iban = $("#iban"+id).html();
			$("input[name=enTitle]").val(enTitle).focus();
			$("input[name=arTitle]").val(arTitle);
			$("input[name=enDetails]").val(enDetails);
			$("input[name=arDetails]").val(arDetails);
			$("input[name=tiktok]").val(tiktok);
			$("input[name=instagram]").val(instagram);
			$("input[name=snapchat]").val(snapchat);
			$("input[name=youtube]").val(youtube);
			$("input[name=alert]").val(alert);
			$("select[name=genders]").val(gender);
			$("select[name=sport]").val(sport).trigger('change');
			$("input[name=iban]").val(iban);
			$("#logoImg").attr("src","../logos/"+logo);
			$("#images").attr("style","margin-top:10px;display:block");
			$("input[name=update]").val(id);
		})
	</script>