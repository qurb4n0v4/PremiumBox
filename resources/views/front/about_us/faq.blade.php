@extends('front.layouts.app')

@section('title', 'FAQ | BOX & TALE')

@section('content')

    <div style="width: 100%; min-height: 100vh; background-color: red;">
        <div class="faq-container">
            <h1>Frequently Asked Questions</h1>
            <ul class="faq-list">
                @foreach ($faqs as $faq)
                    <li class="faq-item">
                        <div class="question">
                            <strong>{{ $faq->question }}</strong>
                            <div class="icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="answer">
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>



    <script>
        document.querySelectorAll('.question').forEach(question => {
            question.addEventListener('click', () => {
                const faqItem = question.closest('.faq-item');
                const wasActive = faqItem.classList.contains('active');

                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                });

                if (!wasActive) {
                    faqItem.classList.add('active');
                }
            });
        });

    </script>


    <style>
        .faq-container {
            max-width: 800px;
            margin: 15px auto;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .faq-container h1 {
            text-align: center;
            color: #2d3748;
            font-size: 2.25rem;
            margin-bottom: 2.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .faq-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .faq-item {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 1rem;
            background: white;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .faq-item.active {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-left: 4px solid transparent;
        }

        .question:hover {
            background-color: #f7fafc;
            border-left-color: #667eea;
        }

        .question strong {
            font-size: 1rem;
            font-weight: 600;
            color: #2d3748;
        }

        .icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #f7fafc;
            transition: all 0.3s ease;
        }

        .icon i {
            color: #667eea;
            font-size: 0.875rem;
            transition: transform 0.3s ease;
        }

        .faq-item.active .icon {
            background: #667eea;
        }

        .faq-item.active .icon i {
            transform: rotate(180deg);
            color: white;
        }

        .answer {
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            background-color: #f8fafc;
        }

        .faq-item.active .answer {
            max-height: 1000px;
        }

        .answer p {
            margin: 0;
            padding: 1.25rem 1.5rem;
            line-height: 1.6;
            color: #4a5568;
        }

        @media (max-width: 768px) {
            .faq-container {
                padding: 1.5rem;
            }

            .faq-container h1 {
                font-size: 1.75rem;
            }

            .question strong {
                font-size: 0.9rem;
            }
        }
    </style>

@endsection



