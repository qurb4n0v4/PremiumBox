@extends('front.layouts.app')

@section('title', 'Contact Us | BOX & TALE')

@section('content')
    <div class="contact-main">
        <div class="container contact-box">
            <div class="row">
                <div class="col-md-6 contact-left">
                    <h1>Contact Us</h1>
                    <h5>Ilkin Humbatov tərəfindən</h5>
                    <p>If you have more question, don't hesitate to reach out to Box & Tale's Team through the following contacts:</p>
                    <p>994703803333</p>
                    <p>ilkin_humbatov</p>
                    <p>Or, kindly leave your message to Box & Tale's Email:</p>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message:</label>
                            <textarea id="message" name="message" class="form-control" rows="4" placeholder="Write your message" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
                <div class="col-md-6 contact-right">
                    <img src="assets/front/img/header.webp" alt="Contact Image" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>

    <style>
        /*Contact-us starts*/
        .contact-main{
            width: 100%;
            height: auto;
            background-color: rgb(248,248,248);
            display: flex;
            justify-content: center;
        }

        .contact-box {
            margin: 24px 0;
            width: 100%;
            max-width: 1100px;
            border-radius: 10px;
            background-color: white;
            padding: 40px 25px;
        }
        .contact-right {
            margin-top: 10px;
        }
        .contact-right img {
            width: 100%;
            height: auto;
        }

        .contact-left h1 {
            font-size: 2.25rem;
            color: #a3907a;
        }

        .contact-left p {
            color: #a3907a;
            font-size: 0.9rem;
        }

        /* Mobile responsive adjustments */
        @media (max-width: 991px) {
            .contact-right img {
                max-width: 100%;
                height: auto;
            }
        }

        @media (max-width: 768px) {
            .contact-main {
                padding: 20px 0;
            }

            .contact-right img {
                width: 100%;
                height: auto;
            }

            .contact-box {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .contact-left h1 {
                font-size: 1.75rem;
            }

            .contact-right img {
                width: 100%;
                height: auto;
            }
        }
    </style>
@endsection
