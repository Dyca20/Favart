@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
    <div class="flex justify-between flex-1 sm:hidden">
        @if ($paginator->onFirstPage())
        <a href="#" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-blue-500 group-hover:to-cyan-500 hover:text-white  focus:ring-4 focus:outline-none focus:ring-cyan-200">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white  rounded-md group-hover:bg-opacity-0">
                {!! __('Anterior') !!}
            </span></a>
        @else
        <a href="{{ $paginator->previousPageUrl()}}" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-blue-500 group-hover:to-cyan-500 hover:text-white  focus:ring-4 focus:outline-none focus:ring-cyan-200">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white  rounded-md group-hover:bg-opacity-0">
                {!! __('Anterior') !!}
            </span></a>
        @endif
        <div>
            <p class="text-base text-gray-700 leading-5">
                {!! __('Mostrando ') !!}
                @if ($paginator->firstItem())
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                {!! __(' de ') !!}
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                {{ $paginator->count() }}
                @endif
                {!! __(' de ') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('resultados') !!}
            </p>
        </div>
        @if ($paginator->hasMorePages())
        
        <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-blue-500 group-hover:to-cyan-500 hover:text-white  focus:ring-4 focus:outline-none focus:ring-cyan-200">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white  rounded-md group-hover:bg-opacity-0">
            {!! __('Siguiente') !!}
            </span></a>
        @else
        <a href="#" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-blue-500 group-hover:to-cyan-500 hover:text-white  focus:ring-4 focus:outline-none focus:ring-cyan-200">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white  rounded-md group-hover:bg-opacity-0">
            {!! __('Siguiente') !!}
            </span></a>
        @endif
    </div>

</nav>
@endif