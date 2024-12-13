@extends('front.layouts.app')

@section('title', 'FAQ | BOX & TALE')

@section('content')
    <div class="faq-page">
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
                        <div class="animated-line"></div>
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
                const animatedLine = faqItem.querySelector('.animated-line');
                const wasActive = faqItem.classList.contains('active');

                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                    item.querySelector('.animated-line').classList.remove('active');
                });

                if (!wasActive) {
                    faqItem.classList.add('active');
                    animatedLine.classList.add('active');
                }
            });
        });
    </script>

    <style>
        .faq-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: auto;
            background-color: rgb(248,248,248);
            padding: 2rem;
            box-sizing: border-box;
        }

        .faq-container {
            width: 100%;
            max-width: 800px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .faq-container h1 {
            text-align: center;
            color: rgb(163, 144, 122);
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
            position: relative;
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
            position: relative;
            z-index: 2;
        }

        .faq-item.active .question,
        .question:hover {
            background-color: rgb(248,248,248);
            border-left-color: rgb(211, 211, 211);
        }

        .question strong {
            font-size: 1rem;
            font-weight: 700;
            color: rgb(163, 144, 122);
        }

        .icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgb(211, 211, 211);
            transition: all 0.3s ease;
        }

        .icon i {
            color: rgb(248,248,248);
            font-size: 0.875rem;
            transition: transform 0.3s ease;
        }

        .faq-item.active .icon {
            background: rgb(248,248,248);
        }

        .faq-item.active .icon i {
            transform: rotate(180deg);
            color: rgb(211, 211, 211);
        }

        .answer {
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            background-color: rgb(248,248,248);
            position: relative;
        }

        .faq-item.active .answer {
            max-height: 1000px;
        }

        .faq-item::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 4px;
            background-color: transparent;
            transition: background-color 0.3s ease;
            z-index: 1;
        }

        .faq-item.active::before,
        .faq-item:hover::before {
            background-color: rgb(211, 211, 211);
        }

        .answer p {
            margin: 0;
            padding: 1.25rem 1.5rem;
            line-height: 1.6;
            color: rgb(163, 144, 122);
        }

        .animated-line {
            height: 2px;
            width: 0;
            background-color: rgb(211, 211, 211);
            margin: 0 1.5rem;
            transition: width 0.3s ease-in-out;
        }

        .animated-line.active {
            width: calc(100% - 3rem);
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
