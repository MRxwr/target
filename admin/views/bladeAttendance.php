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
                $where = ( empty($empAcademy) ) ? "AND `id` != '0'": " AND `id` = '{$empAcademy}'";
                $orderBy = direction("enTitle","arTitle");
                echo "<option value='0' selected >".direction("Please select academy","يرجى تحديد الأكادمية")."</option>";
				if( $academies = selectDB("academies","`status` = '0' {$where} ORDER BY `{$orderBy}` ASC") ){
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
			<select id="mySelect3" name="branchId" class="form-control" required >
				
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
                $where = ( empty($empAcademy) ) ? "AND `academyId` != '0'": " AND `academyId` = '{$empAcademy}'";
                $orderBy = direction("enTitle","arTitle");
				if( $branches = selectDB("branches","`status` = '0' {$where} GROUP BY `sportId` ORDER BY `{$orderBy}` ASC") ){
					for( $i =0; $i < sizeof($branches); $i++ ){
                        $sport = selectDB("sports","`id` = '{$branches[$i]["sportId"]}'");
                        echo "<option value='{$sport[0]["id"]}' id='academy{$branches[$i]["academyId"]}'>".direction("{$sport[0]["enTitle"]}","{$sport[0]["arTitle"]}");
					}
				}
            ?>
        </div>
        <div id="hiddenBranch">
            <?php 
                $where = ( empty($empAcademy) ) ? "AND `academyId` != '0'": " AND `academyId` = '{$empAcademy}'";
                $orderBy = direction("enTitle","arTitle");
				if( $branches = selectDB("branches","`status` = '0' {$where} ORDER BY `{$orderBy}` ASC") ){
					for( $i =0; $i < sizeof($branches); $i++ ){
                        echo "<option value='{$branches[$i]["id"]}' id='sport{$branches[$i]["sportId"]}'>".direction("{$branches[$i]["enTitle"]}","{$branches[$i]["arTitle"]}");
					}
				}
            ?>
        </div>
        <div id="hiddenDay">
            <?php 
                $where = ( empty($empAcademy) ) ? "AND `academyId` != '0'": " AND `academyId` = '{$empAcademy}'";
                $orderBy = direction("enTitle","arTitle");
				if( $branches = selectDB("branches","`status` = '0' {$where} ORDER BY `{$orderBy}` ASC") ){
					for( $i =0; $i < sizeof($branches); $i++ ){
                        $days = selectDB("days","`branchId` = '{$branches[$i]["id"]}' AND `status` = '0' AND `hidden` = '0'");
                        for( $y = 0; $y < sizeof($days); $y++){
                            echo "<option value='{$days[$y]["id"]}' id='sport{$branches[$i]["sportId"]}branch{$branches[$i]["id"]}'>".direction("{$days[$y]["enTitle"]}","{$days[$y]["arTitle"]}");
                        }
					}
				}
            ?>
        </div>
        <div id="hiddenSession">
            <?php 
                $where = ( empty($empAcademy) ) ? "AND `academyId` != '0'": " AND `academyId` = '{$empAcademy}'";
                $orderBy = direction("enTitle","arTitle");
				if( $branches = selectDB("branches","`status` = '0' {$where} ORDER BY `{$orderBy}` ASC") ){
					for( $i =0; $i < sizeof($branches); $i++ ){
                        $sessions = selectDB("sessions","`branchId` = '{$branches[$i]["id"]}' AND `status` = '0' AND `hidden` = '0'");
                        for( $y = 0; $y < sizeof($sessions); $y++){
                            echo "<option value='{$sessions[$y]["id"]}' id='sport{$branches[$i]["sportId"]}branch{$branches[$i]["id"]}'>".direction("{$sessions[$y]["enTitle"]}","{$sessions[$y]["arTitle"]}");
                        }
					}
				}
            ?>
        </div>
</div>
				
				<!-- Bordered Table -->
<?php 
if ( isset($_POST["date"] )){
?>
<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
<h6 class="panel-title txt-dark"><?php echo direction("List of students","قائمة الطلاب") ?></h6>
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
		<th><?php echo direction("Name","الإسم") ?></th>
		<th><?php echo direction("Mobile","الهاتف") ?></th>
		<th><?php echo direction("Total Sessions","مجموع الجلسات") ?></th>
		<th><?php echo direction("Attended","حاضر") ?></th>
		<th class="text-nowrap"><?php echo direction("Actions","الخيارات") ?></th>
		</tr>
		</thead>
		
		<tbody>
		<?php 
		$orderBy = direction("id","id");
		if( $students = selectDB("students","`status` = '0' AND `academyId` = '{$_POST["academyId"]}' AND `sportId` = '{$_POST["sportId"]}' AND `branchId` = '{$_POST["branchId"]}' AND `sessionId` = '{$_POST["sessionId"]}' AND `dayId` = '{$_POST["dayId"]}' AND ( `attendedClasses` < `totalClasses` ) ORDER BY `{$orderBy}` ASC") ){
			for( $i = 0; $i < sizeof($students); $i++ ){
				?>
				<tr>
				<td><?php echo str_pad(($counter = 1+$i), 5, "0", STR_PAD_LEFT) ?></td>
				<td id="studentName<?php echo $students[$i]["id"] ?>"><?php echo "{$students[$i]["fName"]} {$students[$i]["mName"]} {$students[$i]["lName"]}" ?></td>
				<td><?php echo "{$students[$i]["mobile"]}" ?></td>
				<td><?php echo "{$students[$i]["totalClasses"]}" ?></td>
				<td><?php echo "{$students[$i]["attendedClasses"]}" ?></td>
				<td class="text-nowrap">
					<a id="<?php echo $students[$i]["id"] ?>" class="attended btn btn-success" data-toggle="tooltip" data-original-title="<?php echo direction("Attended","حاضر") ?>"> <i class="fa fa-check text-inverse m-r-10"></i>
					</a>
					<a id="<?php echo $students[$i]["id"] ?>" class="absent btn btn-danger" data-toggle="tooltip" data-original-title="<?php echo direction("Absent","غائب") ?>"> <i class="fa fa-close text-inverse m-r-10"></i>
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
<?php
}
?>
	<!-- JavaScript -->
	
	<script>
		$(document).ready(function() {
            // Initialize select2 for all your select elements
           //$('#mySelect1, #mySelect2, #mySelect3, #mySelect4, #mySelect5').select2();
        });
        $(document).on("change", "#mySelect1", function() {
            var academyId = $(this).val();
            var sports = $("#hiddenSport").find("option[id='academy" + academyId + "']").clone();
            var $mySelect2 = $("#mySelect2");
            $mySelect2.empty().append("<?php echo "<option value='0' selected >".direction("Please select sport","يرجى تحديد الرياضة")."</option>"; ?>").append(sports).trigger('change');
            $("#mySelect3, #mySelect4, #mySelect5").empty();
        });

        $(document).on("change", "#mySelect2", function() {
            var sportId = $(this).val();
            var branches = $("#hiddenBranch").find("option[id='sport" + sportId + "']").clone();
            var $mySelect3 = $("#mySelect3");
            $mySelect3.empty().append("<?php echo "<option value='0' selected >".direction("Please select branch","يرجى تحديد الفرع")."</option>"; ?>").append(branches).trigger('change');
            $("#mySelect4, #mySelect5").empty();
        });

        $(document).on("change", "#mySelect3", function() {
            var branchId = $(this).val();
            var sportId = $("#mySelect2").val();
            var days = $("#hiddenDay").find("option[id='sport" + sportId + "branch" + branchId + "']").clone();
            var $mySelect4 = $("#mySelect4");
            $mySelect4.empty().append("<?php echo "<option value='0' selected >".direction("Please select day","يرجى تحديد اليوم")."</option>"; ?>").append(days).trigger('change');
        });

        $(document).on("change", "#mySelect3", function() {
            var branchId = $(this).val();
            var sportId = $("#mySelect2").val();
            var sessions = $("#hiddenSession").find("option[id='sport" + sportId + "branch" + branchId + "']").clone();
            var $mySelect5 = $("#mySelect5");
            $mySelect5.empty().append("<?php echo "<option value='0' selected >".direction("Please select session","يرجى تحديد الجلسه")."</option>"; ?>").append(sessions).trigger('change');
        });

		$(document).on("click", ".attended", function() {
			var id = $(this).attr("id");
			var studentName = $("#studentName" + id).html();
			$.ajax({
				type: "POST",
				url: "../requests?a=Attendance",
				data: {
					studentId: id,
					type: 1,
					attendanceDate: <?php echo $_POST["date"] ?>,
					academyId: <?php echo $_POST["academyId"] ?>,
					sportId: <?php echo $_POST["sportId"] ?>,
					branchId: <?php echo $_POST["branchId"] ?>,
					dayId: <?php echo $_POST["dayId"] ?>,
					sessionId: <?php echo $_POST["sessionId"] ?>,
				},
				success: function(data){
					alert( data )
					alert( studentName + " <?php echo direction("Attended","حاضر") ?>");
				},
			})
		})

		$(document).on("click", ".absent", function() {
			var id = $(this).attr("id");
			var studentName = $("#studentName" + id).html();
			$.ajax({
				type: "POST",
				url: "../requests?a=Attendance",
				data: {
					studentId: id,
					type: 2,
					attendanceDate: <?php echo $_POST["date"] ?>,
					academyId: <?php echo $_POST["academyId"] ?>,
					sportId: <?php echo $_POST["sportId"] ?>,
					branchId: <?php echo $_POST["branchId"] ?>,
					dayId: <?php echo $_POST["dayId"] ?>,
					sessionId: <?php echo $_POST["sessionId"] ?>,
				},
				success: function(data){
					alert( data )
					alert( studentName + " <?php echo direction("Absent","غائب") ?>");
				},
			})
		})
	</script>