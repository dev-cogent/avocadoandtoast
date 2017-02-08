$(document).on('click','.campaign',function(){
        if(checkLogin() == 0){
            swal("You don't have access!","You don't have access to this feature. Please login.", "warning");
            return 0;
        }
        const campaignlength = usercampaigns.length;
        const userid = $(this).attr('data-id');
        const users = [];
        users.push(userid);
        var html = '<select id="listoptions">';
        for(var i = 0; i < campaignlength; i++){
         html = html.concat('<option>'+usercampaigns[i]+'</option>');
        }

        html = html.concat('</select>');
                swal({
                title: 'Add to campaign',
                type: 'info',
                html: html,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Add to list',
                cancelButtonText: 'Create new campaign',
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: true
                }).then(function() {
                        var campaignname = $('#listoptions').val();
                        $.ajax({
                            type: 'POST',
                            url: '/includes/ajax/addtocampaign.php',  
                            data: {
                            campaignname:campaignname,
                            users:users
                            },
                            success: function (jqXHR, textStatus, errorThrown) {
                            if(jqXHR === "1") swal('Success', 'Influencer(s) have been added to your campaign!','success'); 
                            if(jqXHR === "User in campaign") swal('Error', 'You already have this user in your campaign!','error');          
                            } // end success  
                        }); // end ajax request*/
                    }, function(dismiss) {
                    // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                    if (dismiss === 'cancel') {
                            swal({
                            title: 'Create new campaign',
                            type: 'info',
                            html: '<input type="text" id="in">',
                            showCancelButton: true, 
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Create new campaign',
                            cancelButtonText: 'Cancel',
                            }).then(function(){
                            var campaignname = $('#in').val();
                            var users = [];
                            users.push(userid);
                            $.ajax({
                                type: 'POST',
                                url: '/includes/ajax/createcampaign.php',  
                                data: {
                                campaignname: campaignname,
                                users:users
                                },
                                success: function (jqXHR, textStatus, errorThrown) {
                                console.log(jqXHR);
                                if(jqXHR === "1"){
                                     swal('Success', 'Your Campaign has been created and the Influencer(s) have been added to your campaign. The page will now reload.','success');
                                     setTimeout(function(){
                                     location.reload();
                                    }, 2000);
                                }
                                if(jqXHR === "300") swal('Campaign already exist!', 'The Campaign you entered already exist!','warning');
                                
                                }// end success

                            }); // end ajax request*/
                         }) // end then 
                     } // end if 
                }) // end outer  then 
});

