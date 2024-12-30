@extends('front.layouts.app')

@section('title', 'Privacy Policy | BOX & TALE')

@section('content')

    <div class="privacy-main">
        <div class="privacy-box">
            <div class="privacy-right">
                <h1 style="color: #a3907a; font-size: 28px">Privacy Policy</h1>

                @if($privacyPolicies->isNotEmpty())
                    @foreach($privacyPolicies as $privacyPolicy)
                        <div class="privacy-policy">
                            {{-- Effective Date --}}
                            @if(!empty($privacyPolicy->effective_date))
                                <p>
                                    <strong>Effective Date:</strong>
                                    {{ \Carbon\Carbon::parse($privacyPolicy->effective_date)->format('d F Y') }}
                                </p>
                            @endif

                            {{-- Introduction --}}
                            @if($privacyPolicy->introduction)
                                <p>{{ $privacyPolicy->introduction }}</p>
                            @endif

                            {{-- Sections --}}
                            @if(!empty($privacyPolicy->sections))
                                @foreach($privacyPolicy->sections as $section)
                                    <h2 style="font-size: 17px !important; font-weight: 600">{{ $section['heading'] ?? 'Untitled Section' }}</h2>

                                    @if(isset($section['content']))
                                        <p>{{ $section['content'] }}</p>
                                    @endif

                                    @if(!empty($section['subsections']))
                                        @foreach($section['subsections'] as $subsection)
                                            @if(isset($subsection['title']) && $subsection['title'])
                                                <h5 style="font-weight: 600">{{ $subsection['title'] }}</h5>
                                            @endif

                                            @if(isset($subsection['content']) && $subsection['content'])
                                                <p>{{ $subsection['content'] }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @else
                                <p>No sections available.</p>
                            @endif

                        </div>
                    @endforeach
                @else
                    <p>No privacy policies available.</p>
                @endif
            </div>
        </div>
    </div>

    <style>
        .privacy-main {
            width: 100%;
            height: auto;
            background-color: rgb(248,248,248);
            display: flex;
            justify-content: center;
        }
        .privacy-box {
            margin-top: 24px;
            margin-bottom: 24px;
            width: 1100px;
            border-radius: 10px;
            height: auto;
            background-color: white;
            display: flex;
            justify-content: space-between;
            padding: 40px 25px;
        }
        h2, h5, p {
            color: #898989;
            font-size: 14px;
        }
        p{
            margin: 10px 0;
        }
    </style>

@endsection
