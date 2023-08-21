@extends('adminPanel.mainpage')
@section('main')
    <div class="container" style="padding-top: 10px;">
        <div class="col-md-12 mt-3">
            <link href="{{ asset('admin_welcome/assets/css/theme.css') }}" rel="stylesheet" />
            <link href="{{ asset('admin_welcome/vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <!-- ============================================-->
            <!-- <section> begin ============================-->


            {{-- for subscriber  --}}
            {{-- @if (Auth::user() && Auth::user()->role_id === 3)
            <a class="nav-link" href="{{ route('users.edit', ['username' => Auth::user()->username]) }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Update Profile
            </a>
        @endif --}}


            <section class="pt-8 py-lg-0" id="hero">

                <div class="container-xxl">
                    <div class="row align-items-center min-vh-lg-100">
                        <div class="col-lg order-lg-1 text-center"><img class="img-fluid"
                                src="{{ asset('admin_welcome/assets/img/illustrations/hero.png') }}" alt="" /></div>
                        <div class="col-lg mt-5 mt-lg-0">
                            <h1 class="lh-sm font-cursive fw-medium fs-6 fs-sm-8 fs-md-11 fs-lg-9 fs-xl-11 fs-xxl-12">
                                Hi, <span style="color:red">{{ ucfirst(Auth::user()->name) }} </span><br>
                                A model for open collaboration
                            </h1>
                            <p class="mt-4 fs-2 fs-md-4 lh-sm">Run your affiliate marketing dream here.It's hasslefree and
                                easy and obviously secure.</p>
                            @if (Auth::user() && Auth::user()->role_id === 3)
                                <form id="requestForm">
                                    @csrf
                                </form>
                                <!-- The button to trigger SweetAlert -->
                                <button class="btn btn-success mt-4" id="requestAccessBtn">Request to be Author</button>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- end of .container-->

            </section>
            <!-- <section> close ============================-->
            <!-- ============================================-->

            <!-- ============================================-->
            <!-- <section> begin ============================-->
            <section class="pt-xxl-0" id="features">

                <div class="container-xxl">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-10 col-xl-8">
                            <h1 class="display-6 font-cursive">Reimagining what it means to work</h1>
                            <p class="fs-md-1 mt-4">Teams and communities using Open Enterprise fundamentally unlock
                                a reality of work that reimagines how people engage in economic opportunity, meeting
                                the demands and expectations of a modern organization.</p>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-xl-3 g-4 mt-3 text-center">
                        <div class="col-12 col-md-6">
                            <div class="card py-md-6 px-md-4 mt-3 h-100 box-shadow-all border-0">
                                <div class="card-body"><img src="{{ asset('admin_welcome/assets/img/icons/icon1.png') }}"
                                        alt="" />
                                    <h3 class="py-3">Make Money</h3>
                                    <p class="lead mb-0">Make money with affiliate marketing.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card py-md-6 px-md-4 mt-3 h-100 box-shadow-all border-0">
                                <div class="card-body"><img src="{{ asset('admin_welcome/assets/img/icons/icon2.png') }}"
                                        alt="" />
                                    <h3 class="py-3">Home Environment</h3>
                                    <p class="lead mb-0">Work when you want at home.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card py-md-6 px-md-4 mt-3 h-100 box-shadow-all border-0">
                                <div class="card-body"><img src="{{ asset('admin_welcome/assets/img/icons/icon3.png') }}"
                                        alt="" />
                                    <h3 class="py-3">Policy of Work</h3>
                                    <p class="lead mb-0">Don't violate the term and condition. otherwise account will be
                                        terminated.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of .container-->

            </section>
            <!-- <section> close ============================-->
            <!-- ============================================-->


            <!-- ============================================-->
            <!-- <section> begin ============================-->
            <section id="rea">

                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="col-lg order-lg-1 text-center"><img class="img-fluid"
                                src="{{ asset('admin_welcome/assets/img/illustrations/hero2.png') }}" alt="" />
                        </div>
                        <div class="col-lg mt-5 mt-lg-0">
                            <h1 class="lh-sm font-cursive fw-medium display-5">Start an Open Enterprise</h1>
                            <p class="mt-4 fs-1">If you can’t wait to run a new or existing organization on Open
                                Enterprise and are willing to explore and navigate the beta, we’d love to get you
                                started.</p>
                        </div>
                    </div>
                </div>
                <!-- end of .container-->

            </section>
            <!-- <section> close ============================-->
            <!-- ============================================-->

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const requestAccessBtn = document.getElementById('requestAccessBtn');

                requestAccessBtn.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Fill the FORM for sending a request',
                        html: `
                             <input type="text" name="name" class="swal2-input input-fields-hidden" placeholder="Your Name" required>
                                 <input type="email" name="email" class="swal2-input input-fields-hidden" placeholder="Your Email" required>
                                 `,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Save it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const name = Swal.getPopup().querySelector('[name="name"]').value;
                            const email = Swal.getPopup().querySelector('[name="email"]').value;

                            // Create an object with the collected data
                            const data = {
                                name: name,
                                email: email
                            };

                            // Send the data to the server using fetch or your preferred method
                            fetch('{{ route('emails.sendEmail') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token if needed
                                    },
                                    body: JSON.stringify(data)
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire('Success', 'Data saved successfully', 'success');
                                    } else {
                                        Swal.fire('Error', 'Data could not be saved', 'error');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire('Error', 'An error occurred while saving data',
                                        'error');
                                });
                        }
                    });
                });
            });
        </script>
    </div>
@endsection
