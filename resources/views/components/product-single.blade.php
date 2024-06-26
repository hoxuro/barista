<div class="product-single">

    <div class="product-single__img-box">
        @php
            // Obtain the product main image, if not found set not found image
            $imagesArray = json_decode($product->images);
            $firstImage = !empty($imagesArray) ? $imagesArray[0] : 'no-image.png';
            $folderName = !empty($imagesArray) ? explode('_', $firstImage)[0] : 'no-image.png';
        @endphp
        @if($imagesArray)

            @foreach($imagesArray as $index => $image)
                {{-- first image set as main image --}}
                @if(!$index)
                    <div class="product-single__main-img-box u-margin-bottom-small">

                        <!-- discount -->
                        @if($product->discount)
                            <div class="product-single__discount-box">
                                <p class="product-single__discount">-{{$product->discount}}%</p>
                            </div>
                        @endif

                        <!-- btn left -->
                        <span class="chev-box chev-box--left" onclick="changeImg(-1)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24"><path
                                    fill="currentColor" d="M15.41 16.58L10.83 12l4.58-4.59L14 6l-6 6l6 6z"/></svg>
                        </span>
                        <div class="product-single__main-img"
                             style="background-image: url({{ !($folderName === 'no-image.png') ? asset('storage/products/' . $folderName . '/' . $firstImage) :  asset('storage/products/' . 'no-image.png') }});"
                             aria-label="{{$product->title}}"></div>
                        <!-- btn right -->
                        <span class="chev-box chev-box--right" onclick="changeImg(1)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24"><path
                                    fill="currentColor" d="M8.59 16.58L13.17 12L8.59 7.41L10 6l6 6l-6 6z"/></svg>
                        </span>
                    </div>
                    {{-- open the carousel tag --}}
                    <div class="product-single__img-carousel">
                        <div class="product-single__sec-img product-single__sec-img--active"
                             style="background-image: url({{ !($folderName === 'no-image.png') ? asset('storage/products/' . $folderName . '/' . $image) :  asset('storage/products/' . 'no-image.png') }});"></div>
                        @else
                            <div class="product-single__sec-img"
                                 style="background-image: url({{ !($folderName === 'no-image.png') ? asset('storage/products/' . $folderName . '/' . $image) :  asset('storage/products/' . 'no-image.png') }});"></div>
                        @endif
                        @endforeach
                        {{-- close the carousel tag --}}
                    </div>

                @else

                    <div class="product-single__main-img-box u-margin-bottom-small">
                        <!-- btn left -->
                        <span class="chev-box chev-box--left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24"><path
                                    fill="currentColor" d="M15.41 16.58L10.83 12l4.58-4.59L14 6l-6 6l6 6z"/></svg>
                        </span>
                        <div class="product-single__main-img"
                             style="background-image: url({{ !($folderName === 'no-image.png') ? asset('storage/products/' . $folderName . '/' . $firstImage) :  asset('storage/products/' . 'no-image.png') }});"
                             aria-label="{{$product->title}}"></div>
                        <!-- btn right -->
                        <span class="chev-box chev-box--right">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24"><path
                                    fill="currentColor" d="M8.59 16.58L13.17 12L8.59 7.41L10 6l6 6l-6 6z"/></svg>
                        </span>
                    </div>
                    <div class="product-single__img-carousel">
                        <div class="product-single__sec-img"
                             style="background-image: url({{ !($folderName === 'no-image.png') ? asset('storage/products/' . $folderName . '/' . $firstImage) :  asset('storage/products/' . 'no-image.png') }});"></div>
                    </div>

                @endif

    </div>

    <div class="product-single__text-box">
        @if(auth()->check() && auth()->user()->wishlist->contains($product))
            <form class="u-margin-bottom-small" action="{{route('removeFromWishlist', $product->id)}}" method="post">
                @csrf
                <button type="submit" class="product__wish-icon product__wish-icon--included">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="#ff0000"
                              d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.27 2 8.5 2 5.41 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.08C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.41 22 8.5c0 3.77-3.4 6.86-8.55 11.53L12 21.35z"/>
                    </svg>
                </button>
            </form>
        @else
            <form class="u-margin-bottom-small" action="{{route('addToWishlist', $product->id)}}" method="post">
                @csrf
                <button type="submit" class="product__wish-icon product__wish-icon--excluded">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="#222222"
                              d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.27 2 8.5 2 5.41 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.08C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.41 22 8.5c0 3.77-3.4 6.86-8.55 11.53L12 21.35z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="#ff0000"
                              d="m12.1 18.55l-.1.1l-.11-.1C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5c1.54 0 3.04 1 3.57 2.36h1.86C13.46 6 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5c0 2.89-3.14 5.74-7.9 10.05M16.5 3c-1.74 0-3.41.81-4.5 2.08C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.41 2 8.5c0 3.77 3.4 6.86 8.55 11.53L12 21.35l1.45-1.32C18.6 15.36 22 12.27 22 8.5C22 5.41 19.58 3 16.5 3"/>
                    </svg>
                </button>
            </form>
        @endif

        <div class="u-margin-bottom-small">
            <p class="product-single__title">{{ucfirst(strtolower($product->title))}}</p>
        </div>

        <div class="product-single__rating-box u-margin-bottom-big">

            @for ($i = 0; $i < round($ratingInfo['rating']); $i++)
                <div class="main-star full">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="currentcolor"
                              d="m5.825 21l1.625-7.025L2 9.25l7.2-.625L12 2l2.8 6.625l7.2.625l-5.45 4.725L18.175 21L12 17.275z"/>
                    </svg>
                </div>
            @endfor
            @for ($i = round($ratingInfo['rating']) + 1; $i <= 5; $i++)
                <div class="main-star">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="currentColor"
                              d="m12 15.39l-3.76 2.27l.99-4.28l-3.32-2.88l4.38-.37L12 6.09l1.71 4.04l4.38.37l-3.32 2.88l.99 4.28M22 9.24l-7.19-.61L12 2L9.19 8.63L2 9.24l5.45 4.73L5.82 21L12 17.27L18.18 21l-1.64-7.03z"/>
                    </svg>
                </div>
            @endfor

            <p class="product-single__total-reviews">({{$ratingInfo['totalReviews']}})</p>

        </div>

        <form action="{{route('addToCart',  $product->id)}}" method="post">
            @csrf
            <div class="properties u-margin-bottom-medium">
                <div class="property">
                    @if($product->category === 'beans')
                        <p class="property__title">Format:</p>
                        <span
                            style="margin-right: .7rem">{{$product->bean->format == 1000  ? $product->bean->format/1000 . 'kg' : $product->bean->format .'g'}}</span>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px" width="24.54px"
                             height="28.39px" viewBox="0 0 24.54 28.39" style="enable-background:new 0 0 24.54 28.39;"
                             xml:space="preserve">
                                <defs>
                                </defs>
                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)">
                                <path fill="#ffffff" d="M28.38,5119.41c-0.72-0.3-1.69-1.14-2.23-1.93c-1.2-1.93-6.38-29.27-6.38-33.78c0-2.35,0.42-4.64,1.14-6.2l1.14-2.47
                                        l-9.58-68.89C7.24,4968.25,2.36,4932.66,1.7,4927c-1.63-13.67-2.17-31.32-1.26-43.36c1.32-18.13,4.82-37.82,7.17-40.17
                                        c1.14-1.14,3.97-1.32,86.6-4.1c47.03-1.63,89.01-3.01,93.28-3.13l7.83-0.18l21.8,11.32c17.83,9.33,21.86,11.62,22.4,12.95
                                        c0.9,2.23,2.83,14.27,3.97,24.63c3.07,28.49,2.41,59.56-1.81,84.19c-0.78,4.64-6.32,39.63-12.35,77.69
                                        c-5.96,38.12-11.14,69.86-11.56,70.58c-0.36,0.72-1.45,1.63-2.47,1.99C213.02,5120.2,30.37,5120.2,28.38,5119.41z M208.26,5110.26
                                        c0-0.12-1.08-5.72-2.41-12.53c-2.77-14.27-3.61-16.02-8.97-18.79l-3.19-1.69h-79.43c-85.64,0-82.2-0.12-84.49,3.07
                                        c-0.54,0.78-0.96,2.29-0.96,3.31c0,1.57,3.49,20.78,4.64,25.41l0.3,1.32H121C169,5110.38,208.26,5110.32,208.26,5110.26z
                                         M223.32,5026.07c4.64-29.63,8.85-56.07,9.27-58.72c2.53-14.15,3.07-21.8,3.07-46.07c0-15.42-0.3-26.2-0.78-30.71
                                        c-1.32-11.74-3.25-24.33-3.85-25.11c-0.96-1.2-34.39-18.31-34.87-17.83c-0.54,0.6-3.19,19.39-4.22,29.99
                                        c-0.96,9.94-0.96,37.16,0,45.47c0.42,3.49,2.59,19.45,4.88,35.53c2.29,16.08,7.05,50.41,10.66,76.36
                                        c3.61,26.02,6.68,46.61,6.93,46.07C214.65,5080.45,218.62,5055.7,223.32,5026.07z M197.36,5028.96
                                        c-3.25-23.31-7.83-55.89-10.12-72.45c-4.76-33.54-5.48-41.13-5.48-55.65c0-15,1.87-36.25,4.46-50.89l0.78-4.7l-8.19,0.36
                                        c-4.52,0.24-16.02,0.66-25.65,0.96c-9.58,0.3-41.73,1.38-71.36,2.35c-57.99,1.93-66.91,2.29-67.27,2.71
                                        c-0.18,0.18-0.78,2.53-1.45,5.36c-2.17,9.88-3.07,19.63-3.37,36.98c-0.36,17.83,0.12,26.5,2.23,40.83c0.66,4.34,5,35.47,9.64,69.26
                                        c4.64,33.79,8.61,62.09,8.73,62.93l0.3,1.51h83.29h83.23l2.71,1.33c1.51,0.72,2.83,1.32,3.07,1.32
                                        C203.08,5071.23,200.55,5052.2,197.36,5028.96z"/>
                                <path fill="#ffffff" d="M36.99,4996.62c-0.96-1.08-3.07-15.12-10.12-66.61c-1.02-7.47-1.02-33.84,0.06-41.85c0.9-7.05,2.71-14.63,4.03-16.68
                                        c0.48-0.78,1.45-1.51,2.23-1.69c2.47-0.54,129.9-6.44,131.41-6.08c0.84,0.24,1.93,1.02,2.47,1.87c0.84,1.33,0.78,2.41-1.02,14.57
                                        c-1.87,12.47-1.99,13.97-1.99,29.69v16.56l4.64,32.34c2.53,17.83,4.64,33.36,4.64,34.51c0,1.32-0.48,2.59-1.2,3.31
                                        c-1.2,1.2-1.99,1.2-67.63,1.2C40.06,4997.76,38.01,4997.7,36.99,4996.62z M163.4,4987.1c-0.18-0.96-1.81-12.53-3.61-25.78
                                        c-1.87-13.25-3.61-25.71-3.91-27.76c-2.05-12.95-1.81-35.29,0.6-51.97c0.66-4.46,1.08-8.25,0.9-8.37
                                        c-0.12-0.18-26.74,0.96-59.14,2.53s-59.2,2.77-59.56,2.77c-0.84,0-1.81,4.28-2.77,11.74c-0.9,7.35-0.9,30.71-0.06,37.34
                                        c2.11,15.66,8.07,58.66,8.31,59.8l0.3,1.32h59.62h59.62L163.4,4987.1z"/>
                            </g>
                            </svg>

                    @elseif($product->category === 'pods')
                        <p class="property__title">Pods:</p>
                        <p class="property__title">x{{$product->pod->quantity}}</p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22.4 15.4" height="20px">
                            <style>
                                .line {
                                    fill: none;
                                    stroke: #fff; /* Cambia el color aquí */
                                    stroke-width: 1;
                                    stroke-linecap: round;
                                    stroke-linejoin: round;
                                }

                                .shape {
                                    fill: none;
                                    stroke: #fff; /* Cambia el color aquí */
                                    stroke-width: 1;
                                }
                            </style>
                            <line class="line" x1="21.9" y1="0.5" x2="0.5" y2="0.5"/>
                            <path class="shape" d="M13.4,14c0,0.5-0.4,0.9-0.9,0.9h-2.5c-0.5,0-0.9-0.4-0.9-0.9"/>
                            <path class="line"
                                  d="M21.1,0.8l-0.5,1.6c-0.1,0.2-0.2,0.3-0.4,0.3H2.3c-0.2,0-0.4-0.1-0.4-0.3L1.4,0.8"/>
                            <path class="line" d="M17.8,12c-0.8,1.3-2.7,2.2-4.9,2.2H9.4c-2.2,0-4.1-0.9-4.9-2.2"/>
                            <path class="shape"
                                  d="M2.1,2.6l1.3,8c0.2,0.9,1.1,1.5,2.1,1.5h11.4c1,0,1.9-0.6,2.1-1.5l1.3-8"/>
                        </svg>

                    @elseif($product->category === 'machines')
                        <p class="property__title">Available colors:</p>
                        <div class="colors">
                            @foreach($product->machine->colors as $color)

                                <div class="colors__color"
                                     style="background-color: {{$color->code}}"></div>

                            @endforeach
                        </div>

                    @endif
                </div>
                <div class="property">
                    {{-- beans product --}}
                    @if($product->category === 'beans')
                        @if($product->bean->type === 'specialty')
                            <p class="property__title">Specialty</p>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24.5px"
                                 height="28px" viewBox="0 0 24.5 24.51"
                                 style="enable-background:new 0 0 24.5 24.51;" xml:space="preserve">
                                        <defs>
                                        </defs>
                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)">
                                    <path fill="#ffffff" d="M49.57,5119.51c-13.9-1.98-27.4-10.98-36.15-23.98c-17.06-25.57-17.95-63.44-2.13-95.49c4.9-9.99,7.22-12.12,10.53-9.49
                                                c1.68,1.34,1.73,3.76,0.1,6.28c-4.01,6.38-8.31,16.62-10.63,25.32c-6.68,25.12-3.51,50.49,8.55,68.98
                                                c2.87,4.3,11.27,12.46,15.38,14.88c10.14,5.93,20.37,7.42,31.8,4.65c19.58-4.75,37.93-22.99,47.22-47.13l1.68-4.4l-2.13-3.76
                                                c-4.45-7.76-7.07-16.12-8.11-25.71c-0.59-5.74-0.25-7.27,2.08-8.41c1.14-0.49,1.63-0.49,3.07,0.1c1.98,0.84,2.03,0.94,2.77,7.71
                                                c1.19,10.63,4.65,20.27,9.2,25.66c1.48,1.73,3.56,2.03,4.75,0.69c0.4-0.49,1.24-3.12,1.88-5.83c3.56-15.68,10.83-32.44,20.03-46.24
                                                c11.77-17.65,25.66-31.3,45.25-44.5c7.07-4.75,7.86-5.14,10.38-5.34c4.4-0.25,7.91,2.37,8.7,6.63c0.74,4.1,0.74,4.15-16.12,21.41
                                                c-16.81,17.21-21.26,22.3-26.95,30.96c-9.3,14.09-14.29,26.16-19.04,45.94l-2.57,10.78l0.94,1.29c1.29,1.73,3.96,2.23,10.34,1.88
                                                c35.85-1.93,70.71-38.03,76.1-78.82c5.93-44.75-27.4-72.15-67.45-55.43c-2.57,1.04-5.19,1.93-5.84,1.93
                                                c-1.63,0-3.61-2.13-3.61-3.86c0-2.18,1.29-3.31,5.93-5.19c18.59-7.57,35.46-7.67,50.19-0.35c32.93,16.37,39.02,63.94,13.45,105.18
                                                c-13.99,22.5-35.65,38.52-58.7,43.47c-5.29,1.14-18.54,1.29-21.41,0.25c-2.42-0.84-5.09-3.17-6.23-5.44
                                                c-1.68-3.31-1.68-5.04,0-12.02c4.7-20.08,7.27-27.74,13.1-39.41c8.21-16.47,14.74-24.92,35.01-45.44
                                                c8.41-8.46,15.13-15.58,14.93-15.77c-0.45-0.44-13.15,8.21-19.83,13.5c-6.82,5.44-17.11,15.68-22.5,22.45
                                                c-13.2,16.57-22.55,36-26.9,55.93c-1.14,5.29-3.02,8.06-6.53,9.69c-2.03,0.89-3.31,1.19-5.14,1.04l-2.42-0.15l-1.58,3.96
                                                c-8.26,20.82-22.8,37.68-39.86,46.19C71.13,5119.07,59.9,5121,49.57,5119.51z"/>
                                    <path fill="#ffffff" d="M46.45,5094.49c-2.57-1.24-4.2-3.76-4.45-6.82c-0.2-2.52,0.1-3.26,8.21-21.12c4.6-10.14,9.2-20.67,10.24-23.34
                                                c1.83-4.99,4.7-15.08,5.69-20.18c0.89-4.45,3.76-6.08,6.63-3.81c1.83,1.43,1.68,3.71-0.64,12.91c-2.67,10.53-4.9,16.32-14.24,36.89
                                                c-4.5,9.89-8.06,18.1-7.91,18.2c0.49,0.49,9.25-11.67,13.55-18.84c7.32-12.17,13.01-25.62,16.27-38.57
                                                c1.58-6.28,2.08-7.57,3.21-8.16c2.62-1.43,5.88,0.4,5.88,3.26c0,3.66-3.91,16.62-7.91,26.36c-5.29,12.86-10.38,21.76-21.02,36.64
                                                c-4.45,6.23-6.03,7.42-9.79,7.42C49.02,5095.33,47.34,5094.94,46.45,5094.49z"/>
                                    <path fill="#ffffff" d="M84.93,5012.95c-17.8-2.52-36.64-10.83-51.43-22.8c-5.09-4.1-13.5-12.86-17.26-17.9c-10.83-14.69-16.12-29.42-16.02-45.05
                                                c0-7.91,0.59-11.47,3.12-18.4c4.6-12.66,15.97-23.93,29.37-29.13c17.46-6.73,37.83-6.43,58.4,0.94c6.53,2.32,16.57,7.47,22.8,11.62
                                                c6.23,4.15,7.27,5.88,4.99,8.55c-1.88,2.18-3.46,1.83-9.59-2.13c-16.37-10.68-32.93-15.97-50.09-15.97
                                                c-26.11,0-44.55,12.46-50.24,33.97c-1.19,4.55-1.24,16.62-0.05,21.81c5.39,23.54,23.24,44.85,47.82,57.21
                                                c25.32,12.71,52.57,13.45,71.11,1.93c3.61-2.27,4.55-3.31,4.55-5.04c0-1.73-1.78-2.62-7.52-3.86c-11.72-2.47-22.7-6.38-33.63-11.92
                                                c-8.21-4.15-9.74-6.08-7.27-9.25c1.53-1.93,3.16-1.63,10.19,1.88c11.37,5.69,20.27,8.85,32.69,11.67c7.57,1.68,8.85,2.27,10.93,4.8
                                                c4.35,5.24,2.97,12.51-3.16,16.81c-6.18,4.4-15.38,8.16-23.98,9.84C104.76,5013.69,91.55,5013.89,84.93,5012.95z"/>
                                    <path fill="#ffffff" d="M137.59,4975.37c-2.97-0.69-8.01-1.78-11.13-2.47c-19.63-4.4-38.67-13.45-55.24-26.31c-4.65-3.61-6.48-5.29-24.28-22.25
                                                c-5.79-5.49-10.78-9.89-11.03-9.69c-0.3,0.15-0.3,0.49-0.05,0.84c0.25,0.35,2.52,3.51,5.04,7.02c9.1,12.71,18.4,22.7,28.83,31.1
                                                c2.57,2.08,4.85,4.15,4.99,4.55c0.94,2.47-0.89,5.64-3.31,5.64c-3.26,0-18.49-13.6-27.89-24.87c-6.03-7.32-14.88-19.93-15.48-22.15
                                                c-1.78-6.58,5.84-12.71,11.72-9.45c0.89,0.45,8.26,7.12,16.32,14.79c16.12,15.23,20.82,19.24,29.08,24.68
                                                c14.49,9.54,29.47,15.63,48.02,19.48c4.01,0.84,8.21,1.73,9.44,2.03c4.6,1.19,5.93-1.24,5.39-9.59
                                                c-0.94-14.44-7.02-28.73-17.55-41.29c-1.68-1.98-3.26-4.15-3.51-4.8c-0.99-2.62,1.58-5.59,4.4-4.95
                                                c2.97,0.64,11.77,12.36,16.76,22.3c5.29,10.48,7.62,19.83,7.71,30.36c0.05,7.47-0.4,9.44-2.82,12.16
                                                C149.56,4976.5,145.65,4977.2,137.59,4975.37z"/>
                                </g>
                                    </svg>
                        @else
                            <p class="property__title">Blend</p>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24.41px"
                                 height="28px" viewBox="0 0 24.41 29.6"
                                 style="enable-background:new 0 0 24.41 29.6;" xml:space="preserve">
                                        <defs>
                                        </defs>
                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)">
                                    <path fill="#ffffff" d="M115.93,5119.31c-1.68-0.46-5.44-1.91-8.39-3.3l-5.44-2.49l-8.68-0.06c-13.13-0.06-15.56-1.04-25.17-10.36
                                                c-4.63-4.45-6.77-6.13-8.97-6.94c-14.58-5.26-18.4-8.62-22.62-20.02c-2.66-7.12-3.41-8.16-8.56-12.84
                                                c-2.37-2.14-5.21-5.09-6.19-6.48l-1.85-2.6H10.01H0v-29.21v-29.21h8.04c4.45,0,8.21-0.17,8.33-0.4c0.12-0.29-2.83-30.66-6.6-67.57
                                                c-3.76-36.91-6.83-67.69-6.88-68.32c0-0.81,5.21-7,15.45-18.4l15.5-17.12h88.22h88.22l15.5,17.12
                                                c10.18,11.34,15.45,17.59,15.45,18.4c-0.06,0.64-3.12,31.41-6.88,68.32c-3.76,36.91-6.71,67.28-6.6,67.57
                                                c0.12,0.23,3.88,0.4,8.33,0.4h8.04v29.21v29.21h-10.07h-10.01l-1.56,2.26c-0.87,1.21-3.99,4.57-6.94,7.35
                                                c-5.26,5.09-5.38,5.21-7.75,11.51c-4.8,12.44-8.1,15.45-22.97,20.83c-2.2,0.81-4.4,2.55-9.26,7.23c-9.37,9.02-14,10.82-26.03,10.07
                                                c-5.44-0.35-6.02-0.29-9.55,1.21c-10.88,4.51-12.44,5.03-16.78,5.26C120.5,5120.12,117.78,5119.89,115.93,5119.31z M128.14,5100.74
                                                c9.78-4.34,10.36-4.45,19.09-4.63c4.45-0.06,8.85-0.12,9.72-0.17c1.21-0.06,3.01-1.45,7.52-6.07c6.36-6.48,9.02-8.16,18.11-11.4
                                                c5.73-2.08,6.88-3.3,9.14-9.6c2.02-5.84,4.11-9.66,6.54-12.32l2.02-2.31h-78.21H43.85l2.02,2.31c2.49,2.72,4.45,6.42,6.83,12.96
                                                c0.93,2.66,2.31,5.38,3.07,6.07c0.69,0.64,3.41,2.02,6.02,2.95c8.85,3.24,11.57,4.92,17.93,11.34c4.45,4.51,6.36,6.02,7.52,6.07
                                                c0.87,0.06,5.21,0.12,9.66,0.17c8.74,0.17,9.37,0.29,19.09,4.63c2.55,1.1,5.26,2.08,6.07,2.08S125.59,5101.89,128.14,5100.74z
                                                 M226.78,5025.01v-11.86H122.07H17.36v11.86v11.86h104.71h104.71V5025.01z M210.23,4993.08c0.17-1.56,3.24-31.12,6.71-65.78
                                                l6.36-62.94l-6.83-7.52c-3.7-4.17-8.33-9.31-10.24-11.51l-3.47-3.93h-80.7h-80.7l-3.47,3.93c-1.91,2.2-6.54,7.35-10.24,11.51
                                                l-6.83,7.52l6.36,62.94c3.47,34.65,6.48,64.21,6.71,65.78l0.35,2.72h87.82h87.82L210.23,4993.08z"/>
                                    <path fill="#ffffff" d="M121.2,4967.1c-2.2-0.46-6.48-2.08-9.49-3.53c-5.09-2.43-6.13-3.3-14.69-11.69c-11.74-11.45-15.91-16.37-18.8-21.93
                                                c-3.3-6.31-4.34-10.76-4.4-18.34c-0.06-7.69,0.69-11.05,4.11-18.22c2.26-4.74,3.36-6.19,7.93-10.7c6.07-6.02,10.93-8.79,18.8-10.76
                                                c6.71-1.68,15.62-1.33,22.39,0.87c7.46,2.37,11.92,5.79,24.3,18.34c11.69,11.86,14.64,15.85,16.95,22.85
                                                c5.09,15.39,1.45,30.83-10.07,42.29c-3.93,3.88-5.73,5.15-10.18,7.35C139.25,4967.85,130.34,4969.01,121.2,4967.1z M139.71,4948.47
                                                c6.36-3.01,11.8-9.78,12.84-16.02c0.35-2.02,0.23-2.2-0.75-1.74c-5.38,2.37-8.91,3.12-13.88,3.18c-8.33,0-14.12-2.2-20.54-7.81
                                                c-6.36-5.55-11.63-6.07-18.4-1.85l-2.89,1.85l9.95,10.24c12.67,12.96,15.39,14.52,25.11,14.12
                                                C134.97,4950.27,136.64,4949.86,139.71,4948.47z M144.11,4914.92c1.68-0.87,3.12-1.85,3.24-2.2c0.29-0.93-17.3-18.92-20.48-20.94
                                                c-9.49-6.02-22.5-4.28-29.91,3.93c-2.55,2.83-4.8,7.29-5.32,10.36l-0.4,2.37l3.24-1.45c11.57-5.32,24.12-3.24,33.55,5.5
                                                c3.3,3.01,5.73,3.99,9.72,4.05C140.23,4916.54,141.79,4916.13,144.11,4914.92z"/>
                                </g>
                                    </svg>
                        @endif
                        {{-- pods product --}}
                    @elseif($product->category === 'pods')

                        <p class="property__title">Cup size:</p>

                        {{-- small --}}
                        <svg class="property__size" xmlns="http://www.w3.org/2000/svg" height="24px"
                             viewBox="0 0 31 25" fill="none">
                            <title>small</title>
                            <path
                                d="M15.3917 12.6957C20.5257 12.6957 24.6877 11.657 24.6877 10.3757C24.6877 9.09436 20.5257 8.05566 15.3917 8.05566C10.2577 8.05566 6.0957 9.09436 6.0957 10.3757C6.0957 11.657 10.2577 12.6957 15.3917 12.6957Z"
                                stroke="{{$product->pod->size == 'small' ? '#ffffff' : '#777777'}}"
                                stroke-linecap="round" stroke-linejoin="round"/>
                            <path
                                d="M24.6877 10.3755C24.6877 15.1275 23.1597 20.8315 15.3917 20.8315C7.6237 20.8315 6.0957 15.1275 6.0957 10.3755"
                                stroke="{{$product->pod->size == 'small' ? '#ffffff' : '#777777'}}"
                                stroke-linecap="round" stroke-linejoin="round"/>
                            <path
                                d="M24.6792 18.5356C26.4872 19.1596 27.5832 19.9596 27.5832 20.8316C27.5832 22.7756 22.1192 24.3196 15.3912 24.3196C8.66322 24.3196 3.19922 22.7836 3.19922 20.8316C3.19922 19.9596 4.29522 19.1516 6.10322 18.5356"
                                stroke="{{$product->pod->size == 'small' ? '#ffffff' : '#777777'}}"
                                stroke-linecap="round" stroke-linejoin="round"/>
                            <path
                                d="M24.5687 12.7036C24.7847 11.9756 26.0407 11.1116 27.3847 11.4716C28.5047 11.7756 29.0887 12.8716 28.6487 14.3036C27.9847 16.4716 24.4727 15.5996 22.7207 17.6956"
                                stroke="{{$product->pod->size == 'small' ? '#ffffff' : '#777777'}}"
                                stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        {{-- medium --}}
                        <svg class="property__size" xmlns="http://www.w3.org/2000/svg" height="32px"
                             viewBox="0 0 22 22">
                            <title>medium</title>
                            <g fill="none" stroke="{{$product->pod->size == 'medium' ? '#ffffff' : '#777777'}}"
                               stroke-linecap="round" stroke-linejoin="round"
                               stroke-width="1">
                                <path
                                    d="M3.5 9.256h12v7.996a3.997 3.997 0 0 1-4 3.998h-4a4.001 4.001 0 0 1-4-3.998z"/>
                                <path
                                    d="M15.5 10.256h3a2 2 0 0 1 2 1.999v3.998a1.998 1.998 0 0 1-2 1.999h-3.13M5.89 6.748a1.41 1.41 0 0 0 0-2a1.41 1.41 0 0 1 0-1.998m3.25 3.998a1.419 1.419 0 0 0 0-2a1.41 1.41 0 0 1 0-1.998m3.49 3.998a1.41 1.41 0 0 0 0-2a1.41 1.41 0 0 1 0-1.998"/>
                            </g>
                        </svg>

                        {{-- large --}}
                        <svg class="property__size" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             fill="{{$product->pod->size == 'large' ? '#ffffff' : '#777777'}}" height="32px"
                             version="1.1" id="Layer_1" viewBox="0 0 512 512"
                             xml:space="preserve">
                                    <title>large</title>
                            <g>
                                <g>
                                    <path
                                        d="M113.895,53.067c-10.979-8.783-16.542-16.992-15.667-23.1c1-6.942,10.112-12.117,13.508-13.508    c4.375-1.75,6.504-6.717,4.754-11.092c-1.754-4.375-6.704-6.5-11.096-4.758c-2.183,0.875-21.408,9.05-24.042,26.808    c-1.888,12.742,5.475,25.858,21.883,38.983c10.979,8.783,16.542,16.992,15.667,23.1c-0.996,6.933-10.087,12.1-13.529,13.517    c-4.358,1.758-6.479,6.717-4.733,11.083c1.338,3.342,4.542,5.367,7.929,5.367c1.054,0,2.125-0.192,3.167-0.608    c2.183-0.875,21.408-9.05,24.042-26.808C137.665,79.308,130.303,66.191,113.895,53.067z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M216.295,53.067c-10.979-8.783-16.542-16.992-15.667-23.1c1-6.942,10.112-12.117,13.508-13.508    c4.375-1.75,6.504-6.717,4.754-11.092c-1.754-4.375-6.7-6.5-11.096-4.758c-2.183,0.875-21.408,9.05-24.042,26.808    c-1.888,12.742,5.475,25.858,21.883,38.983c10.979,8.783,16.542,16.992,15.667,23.1c-0.996,6.933-10.087,12.1-13.529,13.517    c-4.358,1.758-6.479,6.717-4.733,11.083c1.338,3.342,4.542,5.367,7.929,5.367c1.054,0,2.125-0.192,3.167-0.608    c2.183-0.875,21.408-9.05,24.042-26.808C240.065,79.308,232.703,66.191,216.295,53.067z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M318.695,53.067c-10.979-8.783-16.542-16.992-15.667-23.1c1-6.942,10.112-12.117,13.508-13.508    c4.375-1.75,6.504-6.717,4.754-11.092c-1.75-4.375-6.696-6.5-11.096-4.758c-2.183,0.875-21.408,9.05-24.042,26.808    c-1.888,12.742,5.475,25.858,21.883,38.983c10.979,8.783,16.542,16.992,15.667,23.1c-0.996,6.933-10.087,12.1-13.529,13.517    c-4.358,1.758-6.479,6.717-4.733,11.083c1.338,3.342,4.542,5.367,7.929,5.367c1.054,0,2.125-0.192,3.167-0.608    c2.183-0.875,21.408-9.05,24.042-26.808C342.466,79.308,335.103,66.191,318.695,53.067z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M384.003,170.667h-31.885l1.956-16.033c0.296-2.425-0.463-4.858-2.083-6.692c-1.617-1.825-3.946-2.875-6.387-2.875h-256    c-2.442,0-4.771,1.05-6.387,2.875c-1.621,1.833-2.379,4.267-2.083,6.692L123.799,504.5c0.521,4.283,4.158,7.5,8.471,7.5h170.667    c4.313,0,7.95-3.217,8.471-7.5l15.735-129.033h56.86c25.879,0,46.933-21.075,46.933-46.975v-110.85    C430.936,191.742,409.882,170.667,384.003,170.667z M295.382,494.933H139.824l-40.583-332.8h236.725L295.382,494.933z     M413.87,328.492c0,16.492-13.4,29.908-29.867,29.908h-54.779l20.813-170.667h33.966c16.467,0,29.867,13.417,29.867,29.908    V328.492z"/>
                                </g>
                            </g>
                                </svg>

                    @elseif($product->category === 'machines')
                        <p>{{$product->machine->isAuto ? 'Automatic' : 'Manual'}}</p>
                        <span>&nbsp;|&nbsp;</span>
                        <p>{{$product->machine->capacity <= 1000 ? $product->machine->capacity . 'ml' : $product->machine->capacity/1000 . 'L'}}</p>

                    @endif
                </div>
            </div>

            <div class="product-single__description u-margin-bottom-medium">
                {{ucwords($product->description)}}
            </div>

            <div class="product-single__price-box u-margin-bottom-big">
                @if($product->discount !== 0)
                    <div class="product-single__price">
                        <del>
                            <span class="amount">{{intdiv($product->price, 100)}},<sup>{{str_pad($product->price%100, 2, '0', STR_PAD_LEFT)}}€</sup></span>
                        </del>
                        <ins>
                            <span class="amount">{{intdiv(($product->price - ($product->price * ($product->discount/100))), 100)}},<sup>{{str_pad(($product->price - ($product->price * ($product->discount/100)))%100, 2, '0', STR_PAD_LEFT)}}€</sup></span>
                        </ins>
                    </div>
                @else
                    <div class="product-single__price">
                        <p>{{intdiv($product->price, 100)}},{{str_pad($product->price%100, 2, '0', STR_PAD_LEFT)}}€</p>
                    </div>
                @endif
            </div>

            <div class="product-single__actions">
                <div class="product-single__action">
                    <div class="u-margin-bottom-small"><p>Quantity:</p></div>
                    <div class="product-single__input-quantity-box">
                        <button class="product-single__quantity-arrow product-single__quantity-arrow--minus">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24">
                                <path fill="#ffffff" d="M19 12.998H5v-2h14z"/>
                            </svg>
                        </button>
                        <input name="quantity" type="number" min="1" step="1" max="10" value="1"/>
                        <button class="product-single__quantity-arrow product-single__quantity-arrow--plus">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24">
                                <path fill="#ffffff" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="product-single__action">
                    <button class="btn btn--primary">
                        Add to cart
                    </button>
                </div>
            </div>

        </form>

    </div>

</div>
