<?php
error_reporting(E_ALL);

include 'db_config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <style>
        body{
            font-size: 0.9rem;
        }
        table.dataTable thead tr th {
            text-transform: uppercase;
            font-size: 12px;
        }

        table.dataTable tbody tr td {
            font-size: 12px;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 12px;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
    </style>
    <script>
        $(document).ready(function(){

            $("#txt_search").keyup(function(){
                var search = $(this).val();

                if(search != ""){

                    $.ajax({
                        url: 'getsearch.php',
                        type: 'post',
                        data: {search:search, type:1},
                        dataType: 'json',
                        success:function(response){

                            var len = response.length;
                            $("#searchResult").empty();
                            for( var i = 0; i<len; i++){
                                var id = response[i]['id'];
                                var name = response[i]['uname'];

                                $("#searchResult").append("<tr><td>"+name+"</td></tr>");

                            }

                            // binding click event to li
                            $("#searchResult li").bind("click",function(){
                                setText(this);
                            });


                        }
                    });
                }

            });


        });


        function setText(element){

            var value = $(element).text();
            var userid = $(element).val();

            $("#txt_search").val(value);
            $("#searchResult").empty();

            // Request User Details
            $.ajax({
                url: 'getSearch.php',
                type: 'post',
                data: {userid:userid, type:2},
                dataType: 'json',
                success: function(response){

                    var len = response.length;
                    $("#userDetail").empty();
                    if(len > 0){
                        var uname = response[0]['uname'];
                        var accno = response[0]['accno'];
                        $("#userDetail").append("Name : " + uname + "<br/>");
                        $("#userDetail").append("Account Number : " + accno);
                    }
                }

            });
        }


    </script>
</head>

<body>

<div class="container-fluid pt-5" style="width: 90%;">
<div class="row">
<div class="col-md-11">
        <form name="search" method="post" class="form-inline">
            <div class="col-sm-2">


            <input type="text" value="" name="search" id="txt_search" class="form-control">

           </div>
            <div class="col-sm-2">
            <select name="fieldname" id="fieldname" class="form-control" >
                <option value="">select</option>
                <option value="uname" selected>Name</option>
                <option value="accno">Acc Number</option>
                <option value="intitule">Intitule</option>
                <option value="titr">titre</option>
                <option value="bic">BIC</option>
                <option value="divre">divre</option>
                <option value="cpe">cpe</option>
                <option value="amount">amount</option>
                <option value="email1">email</option>
                <option value="transaction_date">Transaction Date</option>
                <option value="dervst_date">Dervst Date</option>
                <option value="tele">Telephone</option>
                <option value="info_msg">Message</option>
                <option value="NAISSANCE">NAISSANCE</option>

            </select></div>
            <div class="col-sm-2">
            <select name="relation" id="relation" class="form-control" >
                <option value="AND">AND</option>
                <option value="OR">OR</option>
            </select></div>
            <div class="col-sm-2">
            <input type="date" value="" name="startd" class="form-control"  placeholder="Enter start transaction date">
            </div>
            <div class="col-sm-2">
            <input type="date" value="" name="endd" class="form-control" placeholder="Enter end transaction date">
            </div>
            <div class="col-sm-2">
            <input type="submit" name="submit"  id="submit" value="Search" class="btn btn-primary">
            </div>
        </form>
</div>
</div>

    <div class="row">
        <div class="col-md-8">
            <h5>Transactions</h5>
   <table id="example" class="display border" style="width:100%">
                <thead>
                <tr>
                    <th width="20%">Name</th>
                    <th width="20%">Intitule</th>

                    <th  width="20%">Account No</th>
                    <th width="10%">Bic</th>
                    <th>NAISSANCE</th>
                    <th width="15%"> Transaction Date</th>
                    <th width="15%"> Valuta Date</th>
                    <th width="15%"> Dervst Date</th>
                    <th width="5%">Telephone</th>
                    <th width="5%">Amount</th>
                    <th width="25%">CP</th>
                    <th>Message</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $search="";
                $relation="";
                $searchd="";
                $where="";
                if(isset($_POST['submit'])) {
                    $search=$_POST['search'];
                    $relation=$_POST['relation'];
                    $fieldname=$_POST['fieldname'];
                    $from = $_POST['startd'];
                    $to = $_POST['endd'];
                if($_POST['startd']==''){
                    $from ="";
                    $relation="";
                    }
                    if($_POST['endd']==''){
                        $to ="";
                        $relation="";
                    }
              if($from!="" and $to!=""){

                  $searchd = "   transaction_date between CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
              $where=" where";
               }else{
                  $where="";

              }

                    if ($search != "") {
                        $search = "  $fieldname like '%".$_POST['search']."%'";
                        $where=" where";
                    }else{
                        $relation="";
                    }
                }
           $sq= "SELECT coda_data.id,coda_data.currency_code,members.tele,members.dervst_date,members.NAISSANCE,members.cpe,members.intitule,coda_data.info_msg,coda_data.valuta_date,coda_data.amount, members.uname,members.id,coda_data.bic,coda_data.transaction_date, coda_data.acno FROM coda_data INNER JOIN members ON coda_data.m_id=members.id  $where  $searchd  $relation $search order by coda_data.id desc";
                $res = $conn->query($sq);
                ?>
                <div id="searchResult"></div>
                <div id="userDetail"></div>
                <?php
             while($row1 = $res->fetch_assoc()){
                ?>

                <tr>
                    <td><?php echo $row1['uname'];?></td>
                   <td><?php echo $row1['intitule'];?></td>
                    <td><?php echo $row1['acno'];?></td>
                    <td><?php echo $row1['bic'];?></td>
                    <td><?php echo $row1['NAISSANCE'];?></td>
                    <td><?php echo $row1['transaction_date'];?></td>
                    <td><?php echo $row1['valuta_date'];?></td>
                    <td><?php echo $row1['dervst_date'];?></td>
                    <td><?php echo $row1['tele'];?></td>
                    <td><?php echo $row1['currency_code'];?><?php echo $row1['amount'];?></td>
                    <td><?php echo $row1['cpe'];?></td>
                    <td><?php echo $row1['info_msg'];?></td>
                </tr>
                <?php

                }?>
                </tbody></table>

</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#btn-upload').click(function() {
            $('.file-upload-block').hide();
        })
        $('#example').DataTable({
            searching: false,
            paging: false,
            info: false,
            autoWidth: false,
        });
    });
</script>