<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Create Category</h6>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerNameUpdate"
                                    placeholder="Create Category">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Email *</label>
                                <input type="text" class="form-control" id="customerEmailUpdate"
                                    placeholder="Create Category">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Mobile No *</label>
                                <input type="text" class="form-control" id="customerMobileUpdate"
                                    placeholder="Create Category">
                            </div>
                            <input type="text" class="d-none" id="updateID">



                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn bg-gradient-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function FillupUpdateForm(id) {
        document.getElementById('updateID').value = id;
        showLoader()
        let res = await axios.post("/customer-by-id", {
            id: id
        });
        hideLoader();
        document.getElementById('customerNameUpdate').value = res.data['name'];
        document.getElementById('customerEmailUpdate').value = res.data['email'];
        document.getElementById('customerMobileUpdate').value = res.data['mobile'];

    }



    async function Update() {

        //   let categoryName = document.getElementById('categoryNameUpdate').value;

        let customerName = document.getElementById('customerNameUpdate').value;
        let customerEmail = document.getElementById('customerEmailUpdate').value;
        let customerMobile = document.getElementById('customerMobileUpdate').value;
        let updateID = document.getElementById('updateID').value;

        if (customerName.length === 0) {
            errorToast("Customer Name Required !")
        } else if (customerEmail.length === 0) {
            errorToast("Customer Email Required !")
        } else if (customerMobile.length === 0) {
            errorToast("Customer Mobile Required !")
        } else {
            document.getElementById('update-modal-close').click();
            showLoader();
            let res = await axios.post("/update-customer", {
                name: customerName,
                email: customerEmail,
                mobile: customerMobile,
                id: updateID
            })
            hideLoader();

            if (res.status === 200 && res.data === 1) {
                document.getElementById("update-form").reset();
                successToast("Request success !")
                await getList();
            } else {
                errorToast("Request fail !")
            }
        }

    }
</script>
