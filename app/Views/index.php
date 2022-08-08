<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- STYLES -->

    <style {csp-style-nonce}>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .border {
            border: red solid 1px;
        }

        .strike {
            text-decoration: line-through;
        }
    </style>
</head>

<body>

    <!-- HEADER: MENU + HEROE SECTION -->
    <header>

        <section class="vh-100" style="background-color: #3da2c3;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-8 col-xl-6">
                        <div class="card rounded-3">
                            <div class="card-body p-4">

                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <div class="form-outline flex-fill">
                                        <h2>Todo List</h2>
                                        <input type="text" id="title" name="title" class="form-control" placeholder="New Task..." />
                                    </div>
                                    <button class="btn btn-info mt-5 ms-2" id="submit_btn">Add</button>
                                </div>

                                <ul class="list-group rounded-0" id="task">
                                    <?php
                                    foreach ($pageData as $t) {
                                        echo '<li class="list-group-item border-0 ps-0 ">';
                                        echo '<div class="row align-items-center">';
                                        echo '<div class="col-1">';
                                        echo '<input class="form-check-input me-3" name="check" id = "check" type="checkbox" data-id="' . $t['id'] . '"  value="' . $t['is_done'] . '" aria-label="..."  />';
                                        echo '</div>';
                                        echo '<div class="col-7 done" id="">';
                                        echo '<span>' . $t['title'] . '</span>';
                                        echo '</div>';
                                        echo '<div class="col-4 done" id="" style="text-align: right;">';
                                        echo '<small><span>' . $t['date_created'] . ' 
                                        <a  class="btn_delete btn btn-danger btn-small ms-2 p-1" data-id="'.$t['id'].'" >x</a> </span></small>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</li>';
                                    }
                                    ?>
                                </ul>

                                <div class="divider d-flex align-items-center my-4">
                                    <p class="text-center mx-3 mb-0" style="color: #a2aab7;">Shared with</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- SCRIPTS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <script>
            // check btn
            $(document).ready(function() {
                let list = [];
                let is_checked = $(this).val();

                //get list of data
                $('input[value="1"]').attr('checked', true);

                //done tasks
                $("input:checkbox").on('change', function() {
                    let id = $(this).data("id");

                    if ($(this).is(':checked')) {
                        var postData = {
                            id: $(this).data("id"),
                            is_checked: 1
                        }

                    } else {
                        var postData = {
                            id: $(this).data("id"),
                            is_checked: 0
                        }
                    }

                    $.ajax({
                        url: '/updateTodos',
                        method: 'POST',
                        data: postData,
                        success: function(data) {
                            alert('Updated Successfully!');
                        }

                    });
                });

                //insert task
                $("#submit_btn").click(function() {
                    let title = $('#title').val();
                    let d = new Date().toISOString().substr(0, 19).replace('T', ' ');


                    $('#task').append(`<li class='list-group-item border-0 ps-0 '> 
                                       <div class="row align-items-center"> 
                                       <div class="col-1"> <input class="form-check-input me-3" name="check" id = "check" type="checkbox" data-id="' . $t['id'] . '"  value="' . $t['is_done'] . '" aria-label="..."  />
                                       </div>
                                       <div class="col-7">
                                        ${title}  
                                       </div>
                                       <div class="col-4" style="text-align: right;">
                                       <small>${d}</small>  
                                       </div>
                                       </div>
                                       </li>`)
                    console.log(title)

                    var postData = {
                        title: title
                    }

                    $.ajax({
                        url: '/insertTodos',
                        method: 'POST',
                        data: postData,
                        success: function(data) {
                            alert('Add new task successfully!');
                        }

                    });
                })

                //delete
                $('.btn_delete').click( function() {
                    let id = $(this).data("id");
                    var postData = {
                        id: id, 
                        is_deleted: 1
                    }

                    console.log(postData);

                    $.ajax({
                        url:'/deleteTodos',
                        method: 'POST', 
                        data: postData,
                        success:function(data){
                            alert('Task Deleted ');
                        }
                    })
                    window.location.reload();
                    
                })

            });
        </script>

</body>

</html>