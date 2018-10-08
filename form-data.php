<tr>
    <td colspan="3"><strong>Data & parameters (Required)</strong></td>
</tr>
<tr>
    <td colspan="3"><hr/></td>
</tr>
<tr>
    <td class="table-right-align"><p>Gene expression data:</p></td>
    <td><label><input name="expression_data" type="file"></label></td>
    <td><a class="button" data-target="#myModal" data-toggle="modal" type="button">Example</a></td>
    <td>
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
                        <img style="width:auto;height:auto;" src="images/example.png"/>
                        <h2 style="font-size: 17px;"><strong>Expression data requirements:</strong></h2>
                        <ol style="list-style-position: inside;">
                            <li>Only CSV file is accepted here, and the maximum size is 12MB.</li>
                            <li>The first row will be used as gene name. The rest of the row must be numeric type.</li>
                            <li>Each sample (row) must contain the same number of columns (genes) as the first row.</li>
                            <li>Each sample will be scaled to have mean 0 and standard deviation 1.</li>
                        </ol>
                        <br/>
                        <strong style="font-size: 17px">Download demo data</strong><br/>
                        <strong style="font-size: 17px">moderate size:</strong><a href="data/demo_data.csv"><img
                                style="width: 40px; padding-left: 15px;" src="images/down.png"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <strong style="font-size: 17px">small size:</strong><a
                            href="data/demo_data_small.csv"><img style="width: 40px; padding-left: 15px;" src="images/down.png"/></a>
                    </div>
                    <div class="modal-footer">
                        <div class="btn btn-default" data-dismiss="modal">Close</div>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>