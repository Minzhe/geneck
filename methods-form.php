<?php
session_start();
if(isset($_SESSION['page_name'])) {
    $page_name=$_SESSION['page_name'];
    if ($page_name == 'GeneNet.php') {
        $method_index = 'GeneNet';
        $param = 'False positive rate (alpha):';
        $default = '0.2';
    } elseif ($page_name == 'ns.php') {
        $method_index = 'ns';
        $param = 'Alpha:';
        $default = '0.2';
    } elseif ($page_name == 'glasso.php') {
        $method_index = 'glasso';
        $param = 'Lambda:';
        $default = '0.6';
    } elseif ($page_name == 'glassosf.php') {
        $method_index = 'glassosf';
        $param = 'Lambda:';
        $default = '0.3';
    } elseif ($page_name == 'pcacmi.php') {
        $method_index = 'pcacmi';
        $param = 'Alpha:';
        $default = '0.03';
    } elseif ($page_name == 'cmi2ni.php') {
        $method_index = 'cmi2ni';
        $param = 'Alpha:';
        $default = '0.03';
    } elseif ($page_name == 'space.php') {
        $method_index = 'space';
        $param = 'Alpha:';
        $default = '1.0';
    } elseif ($page_name == 'bayesianglasso.php') {
        $method_index = 'bayesianglasso';
        $param = 'Alpha:';
        $default = '0.1';
    } elseif ($page_name == 'eglasso.php') {
        $method_index = 'eglasso';
        $param = 'Alpha:';
        $default = '0.8';
        $param_2 = 'Lambda:';
        $default_2 = '0.6';
    } elseif ($page_name == 'espace.php') {
        $method_index = 'espace';
        $param = 'Alpha:';
        $default = '0.8';
        $param_2 = 'Lambda:';
        $default_2 = '1.0';
    } elseif ($page_name == 'ena.php') {
        $method_index = 'ena';
        $param = 'p-value:';
        $default = '0.01';
        $param_2 = 'Include BayesianGLASSO';
    } else {
        echo 'methods error: ' . $page_name . "<br>";
    }
}
$hubgene_box = "<tr>
                    <td class=\"table-right-align\"><p>Hub genes:</p></td>
                    <td><input type=\"text\" title=\"E.g. Gene13,Gene52,Gene199\" placeholder=\"E.g. Gene13,Gene52,Gene199\" class=\"inputbox\" name=\"hubgenes\" required></td>
                </tr>";

$param_2_box = "<tr>
                    <td class=\"table-right-align\"><p>{$param_2}</p></td>
                    <td><input type=\"text\" id=\"param2\" min=\"0\" maxlength=\"5\" placeholder=\"Default: {$default_2}\" class=\"inputbox\" name=\"param_2\" required>
                    <span id='spanParam2Validation' style=\"color:red; font-size:14px\"></span>
                    </td>
                </tr>";
$param_2_select = "<tr>
                    <td class=\"table-right-align\"><p>{$param_2}</p></td>
                    <td><select name = \"param_2\">
                        <option value=\"no\">No</option>
                        <option value=\"yes\">Yes</option>
                    </select></td>
                   </tr>";
?>
<script>
    $(document).ready(function() {
        //check input for False discover rate which only allows number from 0 to 1
        $("#fdr").on('keyup blur', function (e) {
            $("#spanParamValidation").text("");
            var amt = parseFloat($(this).val())
            if ($(this).val().length > 0) {
                if(!$.isNumeric($(this).val())){
                    $("#spanParamValidation").text("Please enter a numeric value");
                    $('#fdr').addClass("error");
                    $('#submitjob').attr('disabled',true);
                }else if(amt <= 0 || amt >= 1){
                    $("#spanParamValidation").text("value must be between 0 to 1");
                    $('#fdr').addClass("error");
                    $('#submitjob').attr('disabled',true);
                }else{
                    $('#fdr').removeClass("error");
                    $('#submitjob').attr('disabled',false);
                }
            }
        });

        //check input for param which only allows number above 0
        $("#param").on('keyup blur', function (e) {
            $("#spanParamValidation").text("");
            var amt = parseFloat($(this).val())
            if ($(this).val().length > 0) {
                if(!$.isNumeric($(this).val())){
                    $("#spanParamValidation").text("Please enter a numeric value");
                    $('#param').addClass("error");
                    $('#submitjob').attr('disabled',true);
                }else if(amt <= 0){
                    $("#spanParamValidation").text("value must be greater than 0");
                    $('#param').addClass("error");
                    $('#submitjob').attr('disabled',true);
                }else{
                    $('#param').removeClass("error");
                    $('#submitjob').attr('disabled',false);
                    }
            }
        });

        //check input for param2 which only allows number above 0
        $("#param2").on('keyup blur', function (e) {
            $("#spanParam2Validation").text("");
            var amt = parseFloat($(this).val())
            if ($(this).val().length > 0) {
                if(!$.isNumeric($(this).val())){
                    $("#spanParam2Validation").text("Please enter a numeric value");
                    $('#param2').addClass("error");
                    $('#submitjob').attr('disabled',true);
                }else if(amt <= 0){
                    $("#spanParam2Validation").text("value must be greater than 0");
                    $('#param2').addClass("error");
                    $('#submitjob').attr('disabled',true);
                }else{
                    $('#param2').removeClass("error");
                    $('#submitjob').attr('disabled',false);
                }
            }
        });
    });
</script>
<form id="myform" action="submitjob.php" enctype="multipart/form-data" method="POST">
    <div class="text-bg">
        <table class="para-table">
            <!-- parameters -->
            <tr>
                <td><strong>Data & parameters</strong></td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr/>
                </td>
            </tr>
            <tr>
                <td class="table-right-align"><p>Gene expression data:</p></td>
                <td><label><input name="expression_data" type="file"></label></td>
                <td><a class="button" data-target="#myModal" data-toggle="modal" type="button">Example</a></td>
                <div class="modal modal-wide fade in" id="myModal" role="dialog" style="padding-right: 13px;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">
                                    <strong style="font-size: 18px">Submit Form requirements</strong>
                                </h4>
                            </div>
                            <div class="modal-body">
                                <p><img style="width:auto;height:auto;" src="images/example.png"></img></p>
                                <h2 style="font-size: 17px;"><strong>Expression data requirements:</strong></h2>
                                <ol style="list-style-type: disc; list-style-position: inside">
                                    <li>Only CSV file is accepted here, and the maximum size is 12MB. </li>
                                    <li>The first row will be used as gene name. The rest of the row must be numeric type.</li>
                                    <li>Each row has to contain the same columns as the first row.</li>
                                    <li>The program will normalize the expression data automatically.</li>
                                </ol><br/>
                                <strong style="font-size: 17px">Download demo data</strong><br/>
                                <strong style="font-size: 17px">moderate size:</strong><a href="data/demo_data.csv""><img style="width: 40px; padding-left: 15px;" src="images/down.png"/></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <strong style="font-size: 17px">small size:</strong><a href="data/demo_data_small.csv""><img style="width: 40px; padding-left: 15px;" src="images/down.png"/></a>
                            </div>
                            <div class="modal-footer">
                               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                         </div>
                    </div>
                 </div>
            </tr>
            <tr>
                <td class="table-right-align"><p><?php echo $param; ?></p></td>
                <?php
                $echoid = 'param';
                if ($param == "False positive rate (alpha):") {
                    $echoid = 'fdr';
                } elseif (in_array($method_index, array('eglasso', 'espace', 'ena'))) {
                    $echoid = 'fdr';
                }
                ?>
                <td><input type="text" id="<?php echo $echoid?>" min="0" maxlength=5 placeholder="Default: <?php echo $default;?>"  class="inputbox" name="param" required>
                <span id='spanParamValidation' style="color:red; font-size:14px"></span>
                </td>
            </tr>
            <?php if (in_array($method_index, array('eglasso', 'espace'))) { echo $param_2_box; echo $hubgene_box; } ?>
            <?php if ($method_index == 'ena') { echo $param_2_select; } ?>
            <tr>
                <td class="table-right-align"><p>Enter the code:</p></td>
                <td><input type="text" name="input_verifycode" id="input_verifycode" maxlength=4
                           placeholder="Enter code here" autocomplete=" off" class="inputbox" required></td>
            </tr>
            <tr>
                <td class="table-right-align"><p></p></td>
                <td><img style="cursor: pointer;"
                         title="click to change"
                         id="refresh" border="0"
                         src="imgverify.php?"
                         onclick="document.getElementById('refresh').src='imgverify.php?t='+Math.random()">
                </td>
            </tr>
            <tr>
                <td><br/></td>
            </tr>
            <!-- user information -->
            <tr>
                <td><strong>User information (optional)</strong></td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr/>
                </td>
            </tr>
            <tr>
                <td class="table-right-align"><p>Name:</p></td>
                <td colspan="2"><input type="text" placeholder="Your name" class="inputbox fullwidth" name="username">
                </td>
            </tr>
            <tr>
                <td class="table-right-align"><p>Organization:</p></td>
                <td colspan="2"><input type="text" placeholder="Your organization" class="inputbox fullwidth"
                                       name="organization"></td>
            </tr>
            <tr>
                <td class="table-right-align"><p>Email:</p></td>
                <td colspan="2"><input type="email" placeholder="Your e-mail address" class="inputbox fullwidth"
                                       name="email"></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2"><p style="font-size: 12px">You will be notified through e-mail when you submit your job.</p></td>
            </tr>
            <tr>
                <td><br/></td>
            </tr>
            <tr>
                <!-- pass method -->
                <td><input name="method" value=<?php echo $method_index;?> style="display: none"></td>
                <td><label for="submitjob"><a class="button" id="submit">submit</a></label></td>
                <td><input type="submit" id="submitjob" style="display: none"></td>
            </tr>
        </table>
    </div>
</form>
