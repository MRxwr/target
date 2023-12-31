    <!-- footer_area -->
    <div class="footer_area">
        <div class="container">
            <div class="footer_new_wap">
                <a href="#"><img src="logos/<?php echo $mainAcademy[0]["imageurl"] ?>" alt=""></a>
                <p>Powered By Target<img src="img/brand.svg" alt=""></p>
            </div>
        </div>
    </div>
    <!-- back to top -->
    <a href="#" class="back-to-top"><i class="fal fa-angle-up"></i></a>
    <!-- whatsapp -->
    <?php echo $whatsapp = ( !empty($mainAcademy[0]["whatsapp"])) ? "<a href='https://wa.me/{$mainAcademy[0]["whatsapp"]}' class='whatsapp'><img src='img/what_2.svg' alt=''></a>": ""; ?>
    
    <!-- all js here -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab
        
        function showTab(n) {
        // This function will display the specified tab of the form ...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        // ... and fix the Previous/Next buttons:
        if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
        document.getElementById("payBtn").style.display = "none";
        } else {
        document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("payBtn").style.display = "inline";
        } else {
        document.getElementById("nextBtn").innerHTML = "Next";
        document.getElementById("nextBtn").classList.remove("nxtBtn");
        document.getElementById("nextBtn").style.display = "inline";
        document.getElementById("payBtn").style.display = "none";
        }
        // ... and run a function that displays the correct step indicator:
        fixStepIndicator(n)
        }
        
        function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
        }
        
        function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false:
        valid = false;
        }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
        }
        
        function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
        }

        $(document).on("click",".clickedBranch",function(){
            var id = $(this).attr("id");
            console.log(id);
            $(".dayBranch").attr("style", "display: none");
            $("#dayBranch" + id).attr("style", "display: flex");
            $(".sessionBranch").attr("style", "display: none");
            $("#sessionBranch" + id).attr("style", "display: flex");
        });

        $(document).on("click","input[name=branch]",function(){
            var id = $(this).attr("id");
            var text = $("."+id).html();
            $("#branchSel").html(text);
            $("input[name=session]").prop("checked", false);
            $("input[name=day]").prop("checked", false);
            $("#timeSel").html('');
            $("#daySel").html('');
        })

        $(document).on("click","input[name=session]",function(){
            var id = $(this).attr("id");
            var text = $("."+id).html();
            $("#timeSel").html(text);
        })

        $(document).on("click","input[name=day]",function(){
            var id = $(this).attr("id");
            var text = $("."+id).html();
            $("#daySel").html(text);
        })
    </script>
</body>
</html>