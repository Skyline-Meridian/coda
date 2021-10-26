<?php
include '../header.php';
include '../db_config.php';
?>
<!-- Navbar -->
<style>
    .member-block {
        background-color: #efdcf1;
        border-radius: 20px;
        margin: 10px;
    }

    .success-message {
        max-height: 130px;
        overflow: auto
    }
</style>
<?php include '../navbar.php'; ?>
<div class="container-fluid page-body-wrapper">

    <!-- sidebar offcampus  -->
    <?php include '../sidebar-offcanvas.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12 my-4">
                                <h3 class="font-weight-bold">Add Transaction Manually</h3>
                                <h6 class="font-weight-normal mb-4">Choose your account number, then find the member and add transaction.</h6>
                            </div>
                            <div class="col-12 mb-4">
                                <form action="" name="transaction" id="transaction" method="post">
                                    <div class="d-flex">

                                        <div class="form-group mx-2">
                                            <label for="select_acc_no">Select Your Account No.</label>
                                            <select name="select_acc_no" id="select_acc_no" class="form-control">
                                                <option selected disabled hidden>Select Account Number</option>
                                                <option value="BE04250007201731">BE04 2500 0720 1731</option>
                                                <option value="BE26001202832029">BE26 0012 0283 2029</option>
                                                <option value="BE27001709215273">BE27 0017 0921 5273</option>
                                                <option value="BE29001318090964">BE29 0013 1809 0964</option>
                                                <option value="BE36271021277081">BE36 2710 2127 7081</option>
                                                <option value="BE40250013830063">BE40 2500 1383 0063</option>
                                                <option value="BE49250009844171">BE49 2500 0984 4171</option>
                                                <option value="BE53240039610053">BE53 2400 3961 0053</option>
                                                <option value="BE60240036100370">BE60 2400 3610 0370</option>
                                                <option value="BE68271039130034">BE68 2710 3913 0034</option>
                                                <option value="BE71210003416169">BE71 2100 0341 6169</option>
                                                <option value="BE71250013850069">BE71 2500 1385 0069</option>
                                                <option value="BE96001769309605">BE96 0017 6930 9605</option>
                                                <option value="BE09360051075657">BE09 3600 5107 5657</option>
                                                <option value="BE35360051073637">BE35 3600 5107 3637</option>
                                                <option value="BE91340184061376">BE91 3401 8406 1376</option>
                                            </select>
                                        </div>

                                        <div class="form-group mx-2">
                                            <label>Account Name</label>
                                            <input type="text" name="acc_name" id="acc_name" class="form-control" placeholder="Account Name" aria-label="account_name">
                                        </div>
                                        <div class="form-group mx-2">
                                            <label>BIC</label>
                                            <input type="text" name="bic" id="bic" class="form-control" placeholder="BIC" aria-label="bic_number">
                                        </div>
                                        <div class="form-group mx-2">
                                            <label>CIN</label>
                                            <input type="text" name="cin" id="cin" class="form-control" placeholder="N° CIN" aria-label="cin_number">
                                        </div>

                                    </div>
                                    <div class="d-flex">
                                        <div class="form-group mx-2">
                                            <label>Search Member by Name</label>
                                            <input type="text" class="form-control" id="searchByName" placeholder="Intitule" aria-label="members_name">
                                            <div class="success-message m-2 mt-4"></div>
                                        </div>
                                        <div class="form-group mx-2 pt-2">
                                            <button class="btn btn-info mt-4" id="searchByNameBtn">Search Members</button>
                                        </div>

                                        <div class="member-block p-4" style="flex:1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5 class="mb-3"><b>Titre: </b><span class="titre"></span></h5>
                                                    <h5 class="mb-3"><b>Intitule: </b><span class="intitule"></span></h5>
                                                    <h5 class="mb-3"><b>Acc No: </b><span class="accno"></span></h5>
                                                    <h5 class="mb-3"><b>Email: </b><span class="email"></span></h5>
                                                    <h5 class="mb-3"><b>Telephone: </b><span class="tele"></span></h5>
                                                    <h5 class="mb-3"><b>Diver: </b><span class="divers"></span></h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="mb-3"><b>Addresse: </b><span class="addresse"></span></h5>
                                                    <h5 class="mb-3"><b>Localite: </b><span class="localite"></span></h5>
                                                    <h5 class="mb-3"><b>Code Postal: </b><span class="cp"></span></h5>
                                                    <h5 class="mb-3"><b>Naissance: </b><span class="naissance"></span></h5>
                                                    <h5 class="mb-3"><b>Dervst: </b><span class="dervst"></span></h5>
                                                    <h5 class="mb-3"><b>Cumulvst: </b><span class="cumulvst"></span></h5>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="d-flex mt-4">

                                        <div class="form-group mx-2">
                                            <label>Transaction Date</label>
                                            <input type="hidden" class="form-control member_id" name="member_id">
                                            <input type="date" class="form-control transaction_date" name="tr_date" placeholder="Transaction date" aria-label="transaction_date">
                                        </div>
                                        <div class="form-group mx-2">
                                            <label>Transaction Currency</label>
                                            <input type="text" class="form-control transaction_currency" name="tr_curr" value="EUR" aria-label="transaction_currency" readonly>
                                        </div>
                                        <div class="form-group mx-2">
                                            <label>Transaction Amount</label>
                                            <input type="text" class="form-control transaction_amount" name="tr_amount" placeholder="Amount" aria-label="transaction_amount">
                                        </div>
                                        <div class="form-group mx-2">
                                            <label>Remarks</label>
                                            <input type="text" class="form-control transaction_msg" name="remarks" placeholder="Remarks" aria-label="transaction_msg">
                                        </div>
                                        <div class="form-group mx-2 pt-2">
                                            <button class="btn btn-primary mt-4" id="addTransaction">Add New Transaction</button>
                                        </div>

                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <?php include '../footer.php'; ?>

            <script>
                $(function() {
                    // Search by name
                    $('#searchByNameBtn').on('click', function(e) {
                        e.preventDefault();

                        let name = $('#searchByName').val();

                        // ajax start
                        $.ajax({
                            type: "POST", // type POST
                            data: {
                                name: name
                            }, // sending name only
                            dataType: 'json', // expecting json object in return
                            url: '../services/searchByName.php', // backend URL to search by name
                            // on success 
                            success: function(data) {
                                console.log(data);

                                if (data == 'Name value null') {
                                    $('.success-message').empty();
                                    $('.success-message').append('<h6 style="color:red">Entrez le nom à rechercher.</h6>');
                                } else if (data == 'Negative') {
                                    $('.success-message').empty();
                                    $('.success-message').append('<h6 style="color:red">Pas de résultat trouvé.</h6>');
                                } else if (data == 'Query error') {
                                    $('.success-message').empty();
                                    $('.success-message').append('<h6 style="color:red">Quelque chose ne va pas. Essayez à nouveau dans un moment.</h6>');
                                } else {
                                    $('.success-message').empty();
                                    for (var i = 0; i < data.length; i++) {
                                        $('.success-message').append('<h6><a data-index="' + i + '" href="#" class="namelink">' + data[i]['name'] + '</a></h6>');
                                    }
                                }
                                $('.namelink').click(function(e) {
                                    e.preventDefault();
                                    i = $(this).data('index');

                                    $(".member_id").val(data[i].id);
                                    $(".accno").text(data[i].accno);
                                    $(".intitule").text(data[i].name);
                                    $(".divers").text(data[i].divers);
                                    $(".titre").text(data[i].titre);
                                    $(".addresse").text(data[i].addresse);
                                    $(".cp").text(data[i].cp);
                                    $(".localite").text(data[i].localite);
                                    $(".email").text(data[i].email);
                                    $(".naissance").text(data[i].naissance);
                                    $(".telephone").text(data[i].telephone);
                                    $(".dervst").text(+data[i].dervst);
                                    $(".cumulvst").text(+data[i].cumulvst);
                                    $(".remarks").text(+data[i].remarks);
                                })
                            } // success function end
                        }) // Ajax end   
                    }) //Search function end 

                    // Select account no
                    $("#select_acc_no").on('change', function(){
                        accNo = $("#select_acc_no").val();
                        $.ajax({ 
                            type: 'post',
                            url: '../services/getAccDetails.php',
                            dataType: 'json',
                            data: {'accNo': accNo},
                            success: function(data){
                                console.log(data);
                                $("#acc_name").val(data.acc_name);
                                $("#bic").val(data.bic);
                                $("#cin").val(data.cin); 
                            }
                        })
                    })
                    // INSERT Transaction INTO DB
                    $('#addTransaction').click(function(e) {
                        e.preventDefault();

                        // get all form data
                        let formData = $('#transaction').serialize();

                        // ajax start
                        $.ajax({
                            type: "POST", // type POST
                            data: formData,
                            // dataType: 'json', // expecting json object in return
                            url: '../services/insertTransaction.php', // backend URL to search by name
                            // on success 
                            success: function(data) {
                                alert(data);
                            }
                        })

                    });
                });
            </script>