<div class="modal animated zoomIn" id="view-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">view Product</h5>
                <button id="view-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    {{-- <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>:</th>
                            <th>Raj</th>
                        </tr>
                    </thead> --}}
                    <tbody>

                        <tr>
                            <td>Category</td>
                            <td>
                                <select type="text" class="form-control form-select" readonly="readonly"
                                    id="productCategoryview">
                                    <option value="">Select Category</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Name : </td>
                            <td><input type="text" class="form-control" readonly="readonly" id="productNameview">
                            </td>
                        </tr>
                        <tr>
                            <td>Price : </td>
                            <td><input type="text" class="form-control" readonly="readonly" id="productPriceview">
                            </td>
                        </tr>
                        <tr>
                            <td>Price : </td>
                            <td><input type="text" class="form-control" readonly="readonly" id="productUnitview">
                            </td>
                        </tr>

                        <tr>
                            <td>CategoryID : </td>
                            <td><input type="text" class="form-control" readonly="readonly"
                                    id="productCategoryIDview">
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>Picture : </td>
                            <td><input type="text" class="form-control" readonly="readonly" id="productImgview">
                            </td>
                        </tr> --}}
                        <img src="{{ asset('images/default.jpg') }} " id="viewImg" width="250" height="150"
                            alt="">
                    </tbody>

                    <!-- how to img show in modal -->


                    {{-- <img class="w-15" id="oldImg" src="{{ asset('images/default.jpg') }}" /> --}}
                    <br />
                    <label class="form-label mt-2">Image</label>
                    {{-- <input oninput="viewImg.src=window.URL.createObjectURL(this.files[0])" type="file"
                        class="form-control" id="productImgview"> --}}

                    <input type="text" class="d-none" id="viewID">
                    <input type="text" class="d-none" id="filePath">
                </table>

            </div>

        </div>
    </div>
</div>

<script>
    // fill up category
    async function ViewCategoryDropDown() {

        let res = await axios.get("/list-category")
        res.data.forEach(function(item, i) {
            let option = `<option value="${item['id']}">${item['name']}</option>`
            $("#productCategoryview").append(option);
        });

    }

    // fill up View Data
    async function ViewFillForm(id, filePath) {

        document.getElementById('viewID').value = id;
        document.getElementById('filePath').value = filePath;
        document.getElementById('viewImg').src = filePath;

        showLoader();
        await ViewCategoryDropDown();

        let res = await axios.post("/single-product", {
            id: id
        });

        document.getElementById('productNameview').value = res.data['name'];
        document.getElementById('productPriceview').value = res.data['price'];
        document.getElementById('productUnitview').value = res.data['unit'];
        document.getElementById('productCategoryview').value = res.data['category_id'];
        document.getElementById('productCategoryIDview').value = res.data['category_id'];

        hideLoader();

    }
</script>
