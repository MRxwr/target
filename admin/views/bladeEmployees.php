<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
	<h6 class="panel-title txt-dark"><?php echo direction("Employee Details","تفاصيل الموظف") ?></h6>
</div>
	<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
	<form class="" method="POST" action="?v=<?php echo $_GET["v"] ?>" enctype="multipart/form-data">
		<div class="row m-0">
			<div class="col-md-6">
			<label><?php echo direction("Name","الإسم") ?></label>
			<input type="text" name="fullName" class="form-control" required>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Email","البريد الإلكتروني") ?></label>
			<input type="text" name="email" class="form-control" required>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Password","كلمة المرور") ?></label>
			<input type="text" name="password" class="form-control" required>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Mobile","الهاتف") ?></label>
			<input type="number" min="0" name="phone" class="form-control" required oninput="javascript: if (this.value.length > 8) this.value = this.value.slice(0, 8);">
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Type","النوع") ?></label>
			<select name="empType" class="form-control">
				<?php 
				if( $roles = selectDB("roles","`status` = '0' AND `hidden` = '0'") ){
					for( $i = 0; $i < sizeof($roles); $i++ ){
						$title = direction($roles[$i]["enTitle"],$roles[$i]["arTitle"]);
						echo "<option value='{$roles[$i]["id"]}'>{$title}</option>";
					}
				}
				?>
			</select>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Academy","الأكادمية") ?></label>
			<select name="academyId" class="form-control">
				<?php
				if( $academy = selectDB("academies","`status` = '0'") ){
					echo "<option value='0'>".direction("All","الكل")."</option>";
					for( $i = 0; $i < sizeof($academy); $i++ ){
						$academyTitle = direction($academy[$i]["enTitle"],$academy[$i]["arTitle"]);
						echo "<option value='{$academy[$i]["id"]}'>{$academyTitle}</option>";
					}
				}
				?>
			</select>
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
	<div class="pull-left"><h6 class="panel-title txt-dark"><?php echo direction("List of Employees","قائمة الموظفين") ?></h6></div>
	<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="table-wrap mt-40">
<div class="table-responsive">
	<table class="table display responsive product-overview mb-30" id="myTable">
		<thead>
		<tr>
		<th><?php echo direction("Name","الإسم") ?></th>
		<th><?php echo direction("Email","الإيميل") ?></th>
		<th><?php echo direction("Mobile","الهاتف") ?></th>
		<th><?php echo direction("Type","النوع") ?></th>
		<th><?php echo direction("Academy","الأكادمية") ?></th>
		<th class="text-nowrap"><?php echo direction("Actions","الخيارات") ?></th>
		</tr>
		</thead>
		
		<tbody>
		<?php 
		if( $employees = selectDB("employees","`status` = '0' AND `hidden` != '2'") ){
			for( $i = 0; $i < sizeof($employees); $i++ ){
				$counter = $i + 1;
				if ( $employees[$i]["hidden"] == 1 ){
					$icon = "fa fa-unlock";
					$link = "?v={$_GET["v"]}&show={$employees[$i]["id"]}";
					$hide = direction("Unlock","فتح الحساب");
				}else{
					$icon = "fa fa-lock";
					$link = "?v={$_GET["v"]}&hide={$employees[$i]["id"]}";
					$hide = direction("Lock","قفل الحساب");
				}
				
				if ( $role = selectDB("roles","`id` = '{$employees[$i]["empType"]}'") ){
					$type = direction($role[0]["enTitle"],$role[0]["arTitle"]);
				}else{
					$type = "Error";
				}
				
				if( $academy = selectDB("academies","`id` = '{$employees[$i]["academyId"]}'") ){
					$academy = direction($academy[0]["enTitle"],$academy[0]["arTitle"]);
				}else{
					$academy = "";
				}
				
				?>
				<tr>
				<td id="name<?php echo $employees[$i]["id"]?>" ><?php echo $employees[$i]["fullName"] ?></td>
				<td id="email<?php echo $employees[$i]["id"]?>" ><?php echo $employees[$i]["email"] ?></td>
				<td id="mobile<?php echo $employees[$i]["id"]?>" ><?php echo $employees[$i]["phone"] ?></td>
				<td><?php echo $type ?></td>
				<td><?php echo $academy ?></td>
				<td class="text-nowrap">
				
				<a id="<?php echo $employees[$i]["id"] ?>" class="edit btn btn-warning" data-toggle="tooltip" data-original-title="<?php echo direction("Edit","تعديل")  ?>"> <i class="fa fa-pencil text-inverse m-r-10"></i>
				</a>
				<a href="<?php echo $link ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $hide ?>"> <i class="<?php echo $icon ?> text-inverse m-r-10"></i>
				</a>
				<a href="<?php echo "?v={$_GET["v"]}&delId=" . $employees[$i]["id"] ?>" data-toggle="tooltip" data-original-title="<?php echo direction("Delete","حذف")  ?>" class="btn btn-danger"><i class="fa fa-close text-inverse"></i>
				</a>
				<div style="display:none">
					<label id="type<?php echo $employees[$i]["id"]?>"><?php echo $employees[$i]["empType"] ?></label>
					<label id="academy<?php echo $employees[$i]["id"]?>"><?php echo $employees[$i]["academyId"] ?></label></div>				
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
		var name = $("#name"+id).html();
		var mobile = $("#mobile"+id).html();
		var type = $("#type"+id).html();
		var academy = $("#academy"+id).html();
		var logo = $("#logo"+id).html();
		$("input[name=password]").prop("required",false);
		$("input[name=email]").val(email);
		$("input[name=phone]").val(mobile);
		$("input[name=update]").val(id);
		$("input[name=fullName]").val(name);
		$("input[name=fullName]").focus();
		$("select[name=empType]").val(type);
		$("select[name=academyId]").val(academy);
	})
</script>

