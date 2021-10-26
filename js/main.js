$(function (){
    // Defining all the variables
    var coda_response = '';
    var filename = '';
    var transaction = {};
    var table;

    $('#codaform').on('submit', function(e) {
        e.preventDefault();
        var file = $('#file').prop('files')[0];
        var form_data = new FormData();
        form_data.append("file",file);
        $.ajax({
            url:'services/readcoda.php',
            type:'POST',
            dataType: 'JSON',
            data:form_data,
            contentType:false,
            processData:false,
            cache:false,
            beforeSend:function(){
                // $('#codatable').html('Loading......');
            },
            success: function(data) {
                let sequence_number = data.sequence_number;
                $.each(data.transaction, function(i) {
                    let tr_sequence = data.transaction[i].trns_sq;
                    $.ajax({
                        url:'services/matchDB.php',
                        type:'POST',
                        // dataType: 'JSON',
                        data: {
                            sequence_number: sequence_number,
                            tr_sequence: tr_sequence
                        },
                        success: function(x){
                            data.transaction[i].is_added = x;
                            coda_response = data;
                            printCodaBasic(coda_response); 
                            printCodaTable(coda_response);
                        }
                    })
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        })
    })


    function printCodaBasic(coda_response){
        if(coda_response != '' && coda_response.message == "Coda Read Success"){
            filename = coda_response.file_name;

            // Company Fields to show in default fields section
            let fields = ['account_name', 'bic', 'cin', 'account_number', 'currency_code', 'country_code', 'date', 'timezone', 'intial_bal', 'new_bal', 'info_msg', 'file_response', 'sequence_number'];
            for (var i = 0; i < fields.length; i++) {
                $('#' + fields[i]).html(coda_response[fields[i]]);
                transaction[fields[i]] = coda_response[fields[i]];
            }
            $('#currency_code2').html(coda_response.currency_code);
        }
    }
    function printCodaTable(coda_response){
        if(coda_response != '' && coda_response.message == "Coda Read Success"){
            //display coda data in datatable
            $("#codatable").DataTable().destroy();
            table = $('#codatable').DataTable({
                data: coda_response.transaction,
                
                "columns": [
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    { "data": "name" },
                    { "data": "bic" },
                    { "data": "number" },
                    { "data": "date" },
                    { "data": "currency" },
                    { "data": "amount" },
                    { "data": 'msg' },
                ], 
                order: [[1, 'asc']],
                searching: false,
                paging: false,
                info: false,
                rowCallback: function(row, data, index){
                    if(data["is_added"] == 1){
                        $('td', row).css('background-color', 'cyan');
                    }
                }
            });
        }
    }

        // Sub row for members
        function format(d) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="width:100%;">' +
                '<tr class="expanded-row">' +
                '<td colspan="8" class="row-bg"><div class="d-flex justify-content-between"><div class="cell-hilighted"><form action="" class="mem" name="mem" method="post"><div class="d-flex"><div class="mr-2 min-width-cell"><p>Titre</p><div class="form-group"><input type="hidden" class="member_id" name="member_id"><input type="text" class="form-control titre" name="titre"></div></div><div class="mr-2 min-width-cell"><p>Intitule</p><div class="form-group"><input type="text" class="form-control intitule" name="intitule"></div></div><div class="mr-2 min-width-cell"><p>Acc Number</p><div class="form-group"><input type="text" class="form-control acn" name="acn" readonly></div></div><div class="mr-2 min-width-cell"><p>Divers</p><div class="form-group"><input type="text" class="form-control divers" name="divers" list="diveroptions"><datalist id="diveroptions"><option value="Testament"><option value="Testament/Retour"><option value="Retour"><option value="BW"><option value="BX"><option value="HT"><option value="LG"><option value="LX"><option value="NR"><option value="PAYPAL"><option value="PC"><option value="PAS ATTESTATION"><option value="DCD"></datalist></div></div><div class="mr-2 min-width-cell"><p>Naissance</p><div class="form-group"><input type="date" class="form-control naissance" name="naissance"></div></div><div class="mr-2 min-width-cell"><p>Dervst</p><div class="form-group"><input type="date" class="form-control dervst" name="dervst" readonly></div></div></div><div class="d-flex"><div class="mr-2 min-width-cell"><p>Addresse</p><div class="form-group"><input type="text" class="form-control addresse" name="addresse"></div><div class="min-width-cell"><p>Communication</p><input type="text" class="form-control communication" name="communication"></div></div><div class="mr-2 min-width-cell"><p>Localite</p><div class="form-group"><input type="text" class="form-control localite" name="localite"></div><div class="min-width-cell"><p>Rubans</p><input type="text" class="form-control rubans" name="rubans"></div></div><div class="mr-2 min-width-cell"><p>Code Postal</p><div class="form-group"><input type="text" class="form-control cp" name="cp"></div><div class="min-width-cell"><p>Newsletter</p><input type="text" class="form-control newsletter" name="newsletter"></div></div><div class="mr-2 min-width-cell"><p>Email</p><div class="form-group"><input type="email" class="form-control email" name="email"></div><div class="min-width-cell"><p>Remarks</p><input type="text" class="form-control remarks" name="remarks"></div></div><div class="mr-2 min-width-cell"><p>Telephone</p><div class="form-group"><input type="text" class="form-control telephone" name="telephone"></div><div class="form-check form-check-info mt-5"><label class="form-check-label"><input type="checkbox" class="form-check-input extourne">Extourne<i class="input-helper"></i></label></div></div><div class="mr-2 min-width-cell"><p>Cumulvst</p><div class="form-group"><input type="text" class="form-control cumulvst"  name="cumulvst" readonly></div><div class="min-width-cell extourne-monant"><p>Montant à réduire</p><input type="number" class="form-control extourne-monant-input" name="extourne" value="0"></div></div></div><div class="d-flex"><button type="submit" name="searchname"  class="btn btn-light searchname mr-2">Recherche par nom</button><button type="submit" name="insertdb" class="btn btn-info insertdb mr-2 ml-auto">Ajouter membre</button><button type="submit" name="updatedb" class="btn btn-success updatedb mr-2 ml-auto">Mettre à jour</button></div><div class="success-message mt-2"></div></form></div></div></td>'
            '</tr>' +
                '</table>';
        }

        // On click to open the codadata row
        $('#codatable').on('click', 'tbody td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            // get row data in transaction object
            transaction['tr'] = row.data(); 

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                //send transaction account number to backend to check if member present in DB
                //Get the information then open this row.
                $.ajax({
                    type: "POST", // receive with $_POST['name']
                    data: { number: transaction.tr.number },  // sending account number only
                    dataType: 'json',   // expecting json object in return
                    url: 'services/fetchMember.php', // backend URL
                    // on success 
                    success: function (data) {

                        // hide both buttons
                        tr.next('tr').find('.insertdb').hide();
                        tr.next('tr').find('.updatedb').hide();
                        var monant_val = 0;

                        // Code to distribute the amount 
                        tr.next('tr').find('.extourne-monant').hide();
                        $('.extourne').on('click', function() {
                            let target = $(this).closest('.min-width-cell').next().find(".extourne-monant");
                            target.toggle(this.checked);
                            let monant = target.find('.extourne-monant-input');
                            monant.attr({
                                'min': 0,
                                'max': transaction.tr.amount
                            })
                            let cumval = tr.next('tr').find(".cumulvst").val();

                            monant.on('input', function(){
                                monant_val = monant.val();
                                if(monant_val > transaction.tr.amount){
                                    alert('le montant à réduire ne peut pas être supérieur au montant de la transaction');
                                    monant.val(transaction.tr.amount);
                                }
                                tr.next('tr').find(".cumulvst").val(cumval - monant_val);
                            })
                        });
                                
                        
                        // if member exists    
                        if (data != "Negative") {
                            tr.next('tr').find('.updatedb').show();
                            // Let us know with an alert
                            tr.next('tr').find('.success-message').show().html("Le membre existe dans la base de données id="+data.id);
                            // alert("Member exists in DB id="+data.id);
                            // set all values of member panel from the database
                            tr.next('tr').find(".member_id").val(data.id);
                            tr.next('tr').find(".divers").val(data.divers);
                            tr.next('tr').find(".titre").val(data.titre);
                            tr.next('tr').find(".addresse").val(data.addresse);
                            tr.next('tr').find(".cp").val(data.cp);
                            tr.next('tr').find(".localite").val(data.localite);
                            tr.next('tr').find(".email").val(data.email);
                            tr.next('tr').find(".naissance").val( moment(data.naissance,["DD-MM-YYYY", "YYYY-MM-DD"]).format('YYYY-MM-DD'));
                            tr.next('tr').find(".telephone").val(data.telephone);
                            tr.next('tr').find(".communication").val(data.communication);
                            tr.next('tr').find(".rubans").val(data.rubans);
                            tr.next('tr').find(".newsletter").val(data.newsletter);
                            lastdate = moment(data.dervst,["DD-MM-YYYY", "YYYY-MM-DD"]);
                            codadate = moment(transaction.tr.date,["DD-MM-YYYY", "YYYY-MM-DD"]);
                            // console.log(lastdate.format('DD-MM-YYYY'));
                            // console.log(codadate.format('DD-MM-YYYY'));
                            
                            if(moment(lastdate).isAfter(codadate)){
                                tr.next('tr').find(".dervst").val(lastdate.format('YYYY-MM-DD'));
                            } else {
                                tr.next('tr').find(".dervst").val(codadate.format('YYYY-MM-DD'));
                            }
                          
                            tr.next('tr').find(".cumulvst").val(+data.cumulvst+transaction.tr.amount);
                        } else {
                            tr.next('tr').find('.insertdb').show();
                            // Alert us no member found - the form to be filled now.
                            tr.next('tr').find('.success-message').show().append('<h6 style="color:red">Aucun membre trouvé dans la base de données.</h6>');
                            // alert("No member found in DB");
                            // reset the form
                            tr.next('tr').find('.mem')[0].reset();
                            tr.next('tr').find(".cumulvst").val(transaction.tr.amount);
                            codadate = moment(transaction.tr.date,["DD-MM-YYYY", "YYYY-MM-DD"]);
                            tr.next('tr').find(".dervst").val(codadate.format('YYYY-MM-DD'));
                        }
                        // put value account name from the coda table
                        tr.next('tr').find(".intitule").val(transaction.tr.name);
                        // put value account number from the coda table
                        tr.next('tr').find(".acn").val(transaction.tr.number);

                        
                    } // success function end
                }) // Ajax end  
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        }); // Datatable row click end

        // Search by name
        $('#codatable').on('click', '.searchname', function (e) {
            e.preventDefault();
            let form = $(this).closest('form');
            let name = form.find('.intitule').val();

            // ajax start
            $.ajax({
                type: "POST", // type POST
                data: { name: name },  // sending name only
                dataType: 'json',   // expecting json object in return
                url: 'services/searchByName.php', // backend URL to search by name
                // on success 
                success: function (data) {
                    // console.log(data);
 
                    if(data == 'Name value null'){
                        form.find('.success-message').empty();
                        form.find('.success-message').append('<h6 style="color:red">Entrez le nom à rechercher.</h6>');
                    } else if (data == 'Negative'){
                        form.find('.success-message').empty();
                        form.find('.success-message').append('<h6 style="color:red">Pas de résultat trouvé.</h6>');
                    } else if (data == 'Query error'){
                        form.find('.success-message').empty();
                        form.find('.success-message').append('<h6 style="color:red">Quelque chose ne va pas. Essayez à nouveau dans un moment.</h6>');
                    } else {
                        form.find('.success-message').empty();
                        for(var i = 0; i<data.length; i++){
                           form.find('.success-message').append('<h6><a data-index="'+i+'" href="#" class="namelink">'+data[i]['name']+'</a></h6>');
                        }
                    }
                    $('.namelink').click(function(e){
                        e.preventDefault();
                        i = $(this).data('index');
                        form.find(".member_id").val(data[i].id);
                        form.find(".intitule").val(data[i].name);
                        form.find(".divers").val(data[i].divers);
                        form.find(".titre").val(data[i].titre);
                        form.find(".addresse").val(data[i].addresse);
                        form.find(".cp").val(data[i].cp);
                        form.find(".localite").val(data[i].localite);
                        form.find(".email").val(data[i].email);
                        form.find(".naissance").val(data[i].naissance);
                        form.find(".telephone").val(data[i].telephone);
                        form.find(".communication").val(data[i].communication);
                        form.find(".rubans").val(data[i].rubans);
                        form.find(".newsletter").val(data[i].newsletter);
                        form.find(".cumulvst").val(+data[i].cumulvst+transaction.tr.amount);
                        form.find('.insertdb').hide();
                        form.find('.updatedb').show();
                    })
                } // success function end
            }) // Ajax end   
        })//Search function end   

        // INSERT MEMBER INTO DB
        $('#codatable').on('click', '.insertdb', function (e) {
            // prevent default action
            e.preventDefault();
            thisTr = $(this).closest('table').closest('tr');
            parentTr = thisTr.prev();
            // get all form data
            let form = $(this).closest('form');
            let divers = form.find(".divers").val();
            let titre = form.find(".titre").val();
            let addresse = form.find(".addresse").val();
            let communication = form.find(".communication").val();
            let cp = form.find(".cp").val();
            let newsletter = form.find(".newsletter").val();
            let localite = form.find(".localite").val();
            let rubans = form.find(".rubans").val();
            let email = form.find(".email").val();
            let remarks = form.find(".remarks").val();
            let naissance = (form.find(".naissance").val()!="0000-00-00")?form.find(".naissance").val():'';
            let telephone = form.find(".telephone").val();
            let dervst = (form.find(".dervst").val()!="0000-00-00")?form.find(".dervst").val():'';
            let cumulvst = form.find(".cumulvst").val();
            transaction.date = moment(transaction.date).format('YYYY-MM-DD');
           transaction.tr.date = moment(transaction.tr.date).format('YYYY-MM-DD');
            console.log(transaction.date);
            // ajax start 

            $.ajax({
                type: "POST", // type POST
                // all form data
                data: {
                    transaction: transaction,
                    filename: filename,
                    divers: divers,
                    titre: titre,
                    addresse: addresse,
                    communication: communication,
                    cp: cp,
                    newsletter: newsletter,
                    localite: localite,
                    rubans: rubans,
                    email: email,
                    remarks: remarks,
                    naissance: naissance,
                    telephone: telephone,
                    dervst: dervst,
                    cumulvst: cumulvst,
                },
                url: 'services/insertindb.php', // backend URL to insert data into database
                success: function (data) {
                    // alert(data);
                    // console.log(data);
                    form.find('.insertdb').hide();
                    form.find('.updatedb').show();
                    form.find('.success-message').empty();
                    form.find('.success-message').show().html(data).delay(3000).fadeOut('slow');
                    parentTr.css('background-color', 'cyan');
                    thisTr.hide('slow')
                }
            })
        })

        // UPDATE MEMBER INTO DB
        $('#codatable').on('click', '.updatedb', function (e) {
            // prevent default action
            e.preventDefault();
            thisTr = $(this).closest('table').closest('tr');
            parentTr = thisTr.prev();
            
            parentTr.removeClass('shown');
            // get all form data
            let form = $(this).closest('form');
            let id = form.find(".member_id").val();
            let divers = form.find(".divers").val();
            let titre = form.find(".titre").val();
            let addresse = form.find(".addresse").val();
            let communication = form.find(".communication").val();
            let cp = form.find(".cp").val();
            let newsletter = form.find(".newsletter").val();
            let localite = form.find(".localite").val();
            let rubans = form.find(".rubans").val();
            let email = form.find(".email").val();
            let remarks = form.find(".remarks").val();
            let naissance = (form.find(".naissance").val() != "0000-00-00") ? form.find(".naissance").val() : '';
            let telephone = form.find(".telephone").val();
            let dervst = (form.find(".dervst").val() != "0000-00-00") ? form.find(".dervst").val() : '';
            let cumulvst = form.find(".cumulvst").val();
            transaction.date = moment(transaction.date).format('YYYY-MM-DD');
            transaction.tr.date = moment(transaction.tr.date).format('YYYY-MM-DD');

            //ajax start
            $.ajax({
                type: "POST", // type POST
                // all form data
                data: {
                    transaction: transaction,
                    filename: filename,
                    id: id,
                    divers: divers,
                    titre: titre,
                    addresse: addresse,
                    communication: communication,
                    cp: cp,
                    newsletter: newsletter,
                    localite: localite,
                    rubans: rubans,
                    email: email,
                    remarks: remarks,
                    naissance: naissance,
                    telephone: telephone,
                    dervst: dervst,
                    cumulvst: cumulvst,
                },
                url: 'services/updatedb.php', // backend URL to insert data into database
                success: function (data) {
                    console.log(data);
                    form.find('.success-message').empty();
                    form.find('.success-message').show().html(data).delay(3000).fadeOut('slow');
                    parentTr.css('background-color', 'cyan');
                    thisTr.hide('slow')
                }
            })
        })

        // Select previously uploaded CODA files
        $("#uploaded_coda").on('change', function() {
            var filename = $(this).val();
            if(filename){
                $.ajax({
                    url:'services/readcoda.php',
                    type:'POST',
                    dataType: 'JSON',
                    data: {
                        file: filename,
                    },
                    success: function(data) {
                        let sequence_number = data.sequence_number;
                        $.each(data.transaction, function(i) {
                            let tr_sequence = data.transaction[i].trns_sq;
                            $.ajax({
                                url:'services/matchDB.php',
                                type:'POST',
                                data: {
                                    sequence_number: sequence_number,
                                    tr_sequence: tr_sequence
                                },
                                success: function(x){
                                    data.transaction[i].is_added = x;
                                    coda_response = data;
                                    printCodaBasic(coda_response); 
                                    printCodaTable(coda_response);
                                }
                            })
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                })
            }
        })

        
        






//     } else console.log(coda_response.message);
// }
})