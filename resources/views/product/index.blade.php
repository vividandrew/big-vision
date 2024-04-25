@extends('shared.template')
@section('pageheader', "Products")
@section('content')
    @if($message= Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}}</p>
        </div>
    @endif
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">

                @foreach($products as $product)
                <div class="relative">
                    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                        @if($product->ImageUrl == null)
                        <img src="{{url('/image/temp.png')}}" alt="placeholder image for {{$product->Name}}" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                        @else
                        <image src="{{url($product->ImageUrl)}}"/>
                        @endif
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <a class="bg-blue-500 rounded-2xl p-2 hover:bg-blue-300" href="{{route('products.show', $product->id)}}">
                                    View {{$product->Name}}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- More products... -->
            </div>
        </div>
@endsection
