<?php
error_reporting(E_ALL);

include 'db_config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />



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

</head>

<body>

<div class="container-fluid pt-5" style="width: 90%;">
<div class="row">
<div class="col-sm-12">
        <form name="search" method="post" class="form-inline">
            <div class="col-sm-2">


            <input type="text" value="" name="autocomplete" id="autocomplete" class="form-control">
                <input type='hidden' id='selectuser_ids' />

           </div>
            <div class="col-sm-2">
            <select name="fieldname" id="fieldname" class="form-control" >
                <option value="">select</option>
                <option value="intitule" selected>Intitule</option>
                <option value="account_name" >Account Name</option>
                <option value="account_number">Account Number</option>
                <option value="titre">titre</option>
                <option value="bic">BIC</option>
                <option value="diver">Diver</option>
                <option value="cp">cpe</option>
                <option value="amount">amount</option>
                <option value="email">email</option>
                <option value="tr_date">Transaction Date</option>
                <option value="tele">Telephone</option>
                <option value="tr_msg">Message</option>
                <option value="addresse">Address</option>
                <option value="naissance">NAISSANCE</option>
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

<div class="row pt-2">
     <div class="col-md-2">

  <a href="downloadcsvreports.php"  class="btn btn-info">download report as csv</a>
   
     </div>
       <div class="col-md-2">
         <a href="downloadxlsreports.php" class="btn btn-info">download report as Excel</a>

  
       </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h5>Transactions</h5>
   <table id="example" class="display border" style="width:100%">
                <thead>
                <tr>
                    <th width="20%">Account Name</th>
                    <th width="20%">Intitule</th>

                    <th  width="20%">Acn No</th>
                    <th width="10%">Bic</th>
                    <th>NAISSANCE</th>
                    <th width="20%"> Transaction Date</th>
                    <th width="20%"> Dervst Date</th>
                    <th width="5%">Telephone</th>
                    <th width="5%">Amount</th>
                    <th width="5%">Initial Bal</th>
                    <th width="5%">New Bal</th>
                    <th width="5%">CP</th>
                    <th width="5%">Message</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $search="";
                $relation="";
                $searchd="";
                $where="";
                if(isset($_POST['submit'])) {
                    $search=$_POST['autocomplete'];
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

                  $searchd = "   tr_date between CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
              $where=" where";
               }else{
                  $where="";

              }

                    if ($search != "") {
                        $search = "  $fieldname like '%".$_POST['autocomplete']."%'";
                        $where=" where";
                    }else{
                        $relation="";
                    }
                }
           $sq= "SELECT coda_data.id,coda_data.currency_code,coda_data.tr_msg,coda_data.account_name,coda_data.intial_bal,coda_data.new_bal,members.tele,members.dervst,members.naissance,coda_data.cin,members.intitule,coda_data.info_msg,coda_data.valuta_date,coda_data.tr_amount,members.id,coda_data.bic,coda_data.tr_date, coda_data.account_number   FROM coda_data INNER JOIN members ON coda_data.member_id=members.id  $where  $searchd  $relation $search order by coda_data.id desc";
                $res = $pdo->query($sq);
             while($row1 = $res->fetch()){
                ?>

                <tr>
                    <td><?php echo $row1['account_name'];?></td>
                   <td><?php echo $row1['intitule'];?></td>
                    <td><?php echo $row1['account_number'];?></td>
                    <td><?php echo $row1['bic'];?></td>
                    <td><?php echo $row1['naissance'];?></td>
                    <td><?php echo $row1['tr_date'];?></td>

                    <td><?php echo $row1['dervst'];?></td>
                    <td><?php echo $row1['tele'];?></td>
                    <td><?php echo $row1['currency_code'];?> <?php echo $row1['tr_amount'];?></td>
                    <td><?php echo $row1['currency_code'];?> <?php echo $row1['intial_bal'];?></td>
                    <td><?php echo $row1['currency_code'];?> <?php echo $row1['new_bal'];?></td>
                    <td><?php echo $row1['cin'];?></td>
                    <td><?php echo $row1['tr_msg'];?></td>
                </tr>
                <?php

                }?>
                </tbody></table>

</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#btn-upload').click(function() {
            $('.file-upload-block').hide();
        })

    });
    $('#example').DataTable({
        searching: false,
        paging: false,
        info: false,
        autoWidth: false,
    });
</script>
<script type='text/javascript' >
    $( function() {

        $( "#autocomplete" ).autocomplete({
            source: function( request, response ) {

                $.ajax({
                    url: "getsearch.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('#autocomplete').val(ui.item.label); // display the selected text
                $('#selectuser_id').val(ui.item.value); // save selected id to input
                return false;
            },
            focus: function(event, ui){
                $( "#autocomplete" ).val( ui.item.label );
                $( "#selectuser_id" ).val( ui.item.value );
                return false;
            },
        });


    });


</script>
