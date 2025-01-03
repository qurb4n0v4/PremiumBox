@extends('front.layouts.app')

@section('title', 'Gizlilik Siyasəti | BOX & TALE')

@section('content')

    <div class="privacy-main">
        <div class="privacy-box">
            <div class="privacy-right">
                <h1 style="color: #a3907a; font-size: 28px">Gizlilik Siyasəti</h1>

                @if($privacyPolicies->isNotEmpty())
                    @foreach($privacyPolicies as $privacyPolicy)
                        <div class="privacy-policy">
                            {{-- Effektiv Tarix --}}
                            @if(!empty($privacyPolicy->effective_date))
                                <p>
                                    <strong>Effektiv Tarix:</strong>
                                    {{ \Carbon\Carbon::parse($privacyPolicy->effective_date)->format('d F Y') }}
                                </p>
                            @endif

                            {{-- Giriş --}}
                            @if($privacyPolicy->introduction)
                                <p>{{ $privacyPolicy->introduction }}</p>
                            @endif

                            {{-- Bölmələr --}}
                            @if(!empty($privacyPolicy->sections))
                                @foreach($privacyPolicy->sections as $section)
                                    <h2 style="font-size: 17px !important; font-weight: 600">{{ $section['heading'] ?? 'Adı olmayan Bölmə' }}</h2>

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
                                <p>Heç bir bölmə mövcud deyil.</p>
                            @endif

                        </div>
                    @endforeach
                @else
                    <p>Heç bir gizlilik siyasəti mövcud deyil.</p>
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
