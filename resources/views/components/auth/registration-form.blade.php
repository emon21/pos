<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Sign Up</h4>
                    <hr />
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control"
                                    type="password" />
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onRegistration()"
                                    class="btn mt-3 w-100  bg-gradient-primary">Complete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function onRegistration() {

            let fristName = document.getElementById('firstName').value;
            let lastName = document.getElementById('lastName').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let mobile = document.getElementById('mobile').value;

            if (fristName.length === 0) {
                errorToast('First Name is required');
            } else if (lastName.length === 0) {
                errorToast('Last Name is required');
            } else if (mobile.length === 0) {
                errorToast('Mobile is required');
            } else if (email.length === 0) {
                errorToast('Email is required');
            } else if (password.length === 0) {
                errorToast('Password is required');
            }
            // else if(password.length < 6){
            //     errorToast('Password must be at least 6 characters')
            // }
            // else if(password.length > 20){
            //     errorToast('Password must be less than 20 characters')
            // }
            // else if(mobile.length < 10){
            //     errorToast('Mobile must be at least 10 characters')
            // }
            // else if(mobile.length > 11){
            //     errorToast('Mobile must be less than 11 characters')
            // }
            // else if(!email.includes('@') || !email.includes('.')){
            //     errorToast('Invalid Email Address')
            // }
            // else if(password.length < 6 || password.length > 20){
            //     errorToast('Password must be between 6 and 20 characters')
            // }
            // else if(mobile.length < 10 || mobile.length > 11){
            //     errorToast('Mobile must be between 10 and 11 characters')
            // }
            else if (mobile.length === 0) {
                errorToast('Mobile is required');
            } else {
                showLoader();
                let res = await axios.post("/user-registration", {
                    firstName: fristName,
                    lastName: lastName,
                    email: email,
                    password: password,
                    mobile: mobile
                })

                if(res.status === 200 && res.data['status'] === 'success'){
                    successToast(res.data['message']);
                    setTimeout(function() {
                        window.location.href = "/userLogin"
                        
                    }, 2000);
                }else{
                    errorToast(res.data['message']);
                }
                hideLoader();
                
            }
        }
</script>
