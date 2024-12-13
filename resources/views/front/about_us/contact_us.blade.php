@extends('front.layouts.app')

@section('title', 'Contact Us | BOX & TALE')

@section('content')


<div class="contact-main">
    <div class="contact-box">
        <div class="contact-right">
        <h1>Contact Us</h1>
        <h5>Ilkin Humbatov tərəfindən</h5>
            <p>
            If you have more question, don't hesitate to reach out to Box & Tale's Team through the following contacts:
            </p>
            <p>994703803333</p>
            <p>ilkin_humbatov</p>
            <p>Or, kindly leave your message to Box & Tale's Email:</p>
            <form>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter your name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="message">Your Message:</label>
        <textarea id="message" name="message" rows="4" placeholder="Write your message" required></textarea>

        <button type="submit">Submit</button>
    </form>
        </div>
        <div class="contact-left">

            <img src="assets/front/img/header.webp" alt="" />
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
        margin-top: 24px;
        width: 1100px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        height: auto;
        background-color: white;
        display: flex;
        justify-content: space-between;
        padding: 40px 25px;

    }
    .contact-left{
        width: 49%;
        height: auto;
    }
    .contact-right{
        width: 49%;
        height: auto;
        display: flex;
        flex-direction: column;
    }


    .contact-right p{
        color: #a3907a;
        font-size: 0.9rem;
    }

    .contact-left img {
        width: 507px;
        height: 676px;
        margin-top: 29px;
    }
    .contact-right h1{
        font-size: 2.25rem;
        color: #a3907a;
    }
    .contact-left p{
        font-size: 18px;
        margin-top: 17px;
        color: #a3907a;
    }

    form {
        border-radius: 5px;
        width: 100%;
    }

    label {
        display: block;
        margin: 10px 0 5px;
    }
    input, textarea, button {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    button {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }


    @media screen and (max-width: 1200px) {
        .contact-left img {
            width: 417px;
            height: 556px;
        }

    }


    @media screen and (max-width: 1100px) {
        .contact-box{
            width: 960px;
        }


    }
    @media screen and (max-width: 991px) {
        .contact-box{
            width: 720px;
        }
        .contact-left img {
            width: 297px;
            height: 396px;
        }

    }

    @media screen and (max-width: 768px) {
        .contact-box {
            width: 540px;
            display: flex;
            flex-direction: column;
            gap: 50px;
        }

        .contact-left {
            width: 100%;
        }
        .contact-left img{
            width: 444px;
            height: 592px;
        }
        .contact-right{
            width: 100%;
        }
    }

    @media screen and (max-width: 574px) {
        .contact-box{
            width: 100%;
        }
        .contact-left img{
            width: 100%;
            height: auto;
        }
    }
    /*Contact-us ends*/
</style>
@endsection
