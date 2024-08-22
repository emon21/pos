<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Create Category</h6>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerName"
                                    placeholder="Create Category">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Email *</label>
                                <input type="text" class="form-control" id="customerEmail"
                                    placeholder="Create Category">
                            </div>
                             <div class="col-12 p-1">
                                <label class="form-label">Mobile No *</label>
                                <input type="text" class="form-control" id="customerMobile"
                                    placeholder="Create Category">
                            </div>
                            
                            
                            
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Save()" id="save-btn" class="btn bg-gradient-success">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
   
    //save data
    async function Save() {
        document.getElementById('save-form').submit();

        let customerName = document.getElementById('customerName').value;
        let customerEmail = document.getElementById('customerEmail').value;
        let customerMobile = document.getElementById('customerMobile').value;

        if (customerName.length === 0) {
            errorToast("Customer Name Required !")
        }
        else if (customerEmail.length === 0) {
            errorToast("Customer Email Required !")
        }
        else if (customerMobile.length === 0) {
            errorToast("Customer Mobile Required !")
        }
         else {
            document.getElementById('modal-close').click();
            showLoader();
            let res =await axios.post("/create-customer", {
                name: customerName,
                email: customerEmail,
                mobile: customerMobile
            });

            hideLoader();
            if (res.status === 201) {
                successToast('Request completed');
                document.getElementById("save-form").reset();
               await getList();
            } else {
                errorToast("Request fail !")
            }
        }

    }

</script>

