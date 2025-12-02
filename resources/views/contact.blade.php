@extends('layouts.app')

@section('content')
<section class="contact section" id="contact">
    <h2 class="section__title">Contact Us</h2>
    <span class="section__subtitle">Send in your inquiries</span>

    <div class="contact__container container grid">
        <div>
            <div class="contact__information">
                <i class="uil uil-envelope contact__icon"></i>

                <div>
                    <h3 class="contact__title">Email</h3>
                    <span class="contact__subtitle">scholarship@olaarowolo.com</span>
                </div>
            </div>
        </div>

        <form action="{{ route('contact.send') }}" method="POST" class="contact__form grid">
            @csrf
            <div class="contact__inputs grid">
                <div class="contact__content">
                    <label for="name" class="contact__label">Name</label>
                    <input type="text" name="name" id="name" class="contact__input" required>
                </div>
                <div class="contact__content">
                    <label for="email" class="contact__label">Email</label>
                    <input type="email" name="email" id="email" class="contact__input" required>
                </div>
            </div>
            <div class="contact__content">
                <label for="message" class="contact__label">Message</label>
                <textarea name="message" id="message" cols="0" rows="7" class="contact__input" required></textarea>
            </div>

            <div>
                <button type="submit" class="button button--flex">
                    Send Message
                    <i class="uil uil-message button__icon"></i>
                </button>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</section>
@endsection
