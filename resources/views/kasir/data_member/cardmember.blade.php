@extends('/dashboard')
@section('container')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <body class="card-body">
        <div class="container">
            <style>
                body {
                    background-color: #f9f9fa
                }

                .padding {
                    padding: 3rem !important
                }

                .user-card-full {
                    overflow: hidden;
                }

                .card {
                    border-radius: 5px;
                    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
                    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
                    border: none;
                    margin-bottom: 30px;
                }

                .m-r-0 {
                    margin-right: 0px;
                }

                .m-l-0 {
                    margin-left: 0px;
                }

                .user-card-full .user-profile {
                    border-radius: 5px 0 0 5px;
                }

                .bg-c-lite-green {
                    background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
                    background: linear-gradient(to right, #ee5a6f, #f29263);
                }

                .user-profile {
                    padding: 20px 0;
                }

                .card-block {
                    padding: 1.25rem;
                }

                .m-b-25 {
                    margin-bottom: 25px;
                }

                .img-radius {
                    border-radius: 5px;
                }

                h6 {
                    font-size: 14px;
                }

                .card .card-block p {
                    line-height: 25px;
                }

                @media only screen and (min-width: 1400px) {
                    p {
                        font-size: 14px;
                    }
                }

                .b-b-default {
                    border-bottom: 1px solid #e0e0e0;
                }

                .m-b-20 {
                    margin-bottom: 20px;
                }

                .p-b-5 {
                    padding-bottom: 5px !important;
                }

                .card .card-block p {
                    line-height: 25px;
                }

                .m-b-10 {
                    margin-bottom: 10px;
                }

                .text-muted {
                    color: #919aa3 !important;
                }

                .b-b-default {
                    border-bottom: 1px solid #e0e0e0;
                }

                .f-w-600 {
                    font-weight: 600;
                }

                .m-b-20 {
                    margin-bottom: 20px;
                }

                .m-t-40 {
                    margin-top: 20px;
                }

                .p-b-5 {
                    padding-bottom: 5px !important;
                }

                .m-b-10 {
                    margin-bottom: 10px;
                }

                .m-t-40 {
                    margin-top: 20px;
                }

                .user-card-full .social-link li {
                    display: inline-block;
                }

                .user-card-full .social-link li a {
                    font-size: 20px;
                    margin: 0 10px 0 0;
                    -webkit-transition: all 0.3s ease-in-out;
                    transition: all 0.3s ease-in-out;
                }
            </style>
            <div class="card user-card-full">
                <div class="row m-l-0 m-r-0">
                    <div class="col-sm-4 bg-c-lite-green user-profile">
                        <div class="card-block text-center text-white">
                            <div class="">
                                <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius"
                                    alt="User-Profile-Image">
                            </div>
                            <h6 class="f-w-600">GO FIT</h6>
                            <p>we go GYM</p>
                            <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card-block">
                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">MEMBER CARD</h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">NAMA</p>
                                    <h6 class="text-muted f-w-400">{{ $member->NAMA_MEMBER }}</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">MASA AKTIVASI</p>
                                    <h6 class="text-muted f-w-400">{{ $member->MASA_AKTIVASI }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">ID</p>
                                    <h6 class="text-muted f-w-400">{{ $member->ID_MEMBER }}</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">NO TELEPON</p>
                                    <h6 class="text-muted f-w-400">{{ $member->TELEPON_MEMBER }}</h6>
                                </div>
                            </div>
                            <ul class="social-link list-unstyled m-t-40 m-b-10">
                                <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                        data-original-title="facebook" data-abc="true"><i
                                            class="mdi mdi-facebook feather icon-facebook facebook"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                        data-original-title="twitter" data-abc="true"><i
                                            class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a>
                                </li>
                                <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                        data-original-title="instagram" data-abc="true"><i
                                            class="mdi mdi-instagram feather icon-instagram instagram"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </body>
    <script type="text/javascript">
        window.print();
    </script>
@endsection
