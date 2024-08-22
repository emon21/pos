<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Category</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0 bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-secondary" />
                <div class="table-responsive">
                    <table class="table" id="tableData">
                        <thead>
                            <tr class="bg-light">
                                <th>No</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableList">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    getList();
    async function getList() {

        showLoader();
        let res = await axios.get("/list-category");
        hideLoader();


        let tableList = $('#tableList');
        let tableData = $('#tableData');

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item, index) {

            let row = `<tr>
                     <td>${index+1}</td>
                     <td>${item['name']}</td>
                     <td>${item['user']['firstName']}</td>
                     <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                     </td>
         </tr>`

            tableList.append(row)


        });



        //Edit

        // document.getElementByClassName('editBtn');
        // document.getElementByClassName('deleteBtn');

        $('.editBtn').on('click', async function() {
            let id = $(this).data('id');
            await FillupUpdateForm(id)
            $('#update-modal').modal('show');
        });

        // $('.editBtn').on('click', async function() {
        //     let id = $(this).data('id');
        //     await FillupUpdateForm(id)
        //     $('#update-modal').modal('show');
        // });





        //Delete
        $('.deleteBtn').on('click', function() {
            let id = $(this).data('id');
            // alert(id);
            $('#delete-modal').modal('show');
            $('#deleteID').val(id);
        });


        // let table = new DataTable('#tableData');
        //customize Data Tabile
        tableData.DataTable({
            order: [
                [0, 'desc']
            ],
            lengthMenu: [5, 10, 25, 50, 75, 100],

        });
    }


    // document.getElementById('tableData').addEventListener('click', async function(e) {

    //             if (e.target.classList.contains('deleteBtn')) {
    //                 let id = e.target.dataset.id;
    //                 $("#delete-modal").modal('show');
    //                 $("#deleteID").val(id);
    //             }

    //         });


    // $('.editBtn').on('click', async function() {

    //     let id = $(this).data('id');
    //     await FillUpUpdateForm(id)
    //     $("#update-modal").modal('show');

    // }
</script>
