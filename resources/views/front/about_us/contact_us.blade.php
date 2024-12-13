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
@endsection
