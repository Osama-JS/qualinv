@props(['page'])

@php
    $sections = \App\Models\ContentSection::active()
        ->forPage($page)
        ->ordered()
        ->get();
@endphp

@if($sections->isNotEmpty())
    <div class="content-sections">
        @foreach($sections as $section)
            <section class="py-12 px-4 sm:px-6 lg:px-8" id="content-section-{{ $section->id }}">
                <div class="max-w-7xl mx-auto">
                    @if($section->getLocalizedTitle())
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                                {{ $section->getLocalizedTitle() }}
                            </h2>
                        </div>
                    @endif
                    
                    @if($section->getLocalizedContent())
                        <div class="prose prose-lg max-w-none dark:prose-invert mx-auto {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {!! $section->getLocalizedContent() !!}
                        </div>
                    @endif
                </div>
            </section>
        @endforeach
    </div>
@endif
