@extends('layouts.dashboard.app')

@section('title')
Users
@endsection

@section('content')



@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif






<div class="app-content content">






    <!-- Users Table -->
    <section id="users-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Users List</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <p class="card-text">All registered users in the system</p>
                            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>


                            <a href="{{ route('users.trash') }}" class="btn btn-warning mb-3">
                                <i class="fa fa-trash"></i> View Deleted Users
                            </a>
                            <table class="table table-striped table-bordered column-rendering">
                                <thead>
                                    <tr>

                                        <th>Full Name</th>
                                        <th>Image</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Verified</th>
                                        <th>Show</th>
                                        <th>Update</th>
                                        <th>Delete</th>

                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($users as $user)





                                    <tr>
                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $user->image) }}" alt="User Image"
                                                width="50" height="50" class="rounded-circle"
                                                style="object-fit: cover;">
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{$user->phone}}</td>

                                        <td><span class="badge badge-success">
                                                {{ $user->is_verified == 1 ? 'Yes' : 'No' }}</span></td>

                                        <td>
                                            <a href="{{ route('users.show', $user->id) }}">




                                                <svg height="40px" width="40px" version="1.1" id="Layer_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    viewBox="0 0 511.999 511.999" xml:space="preserve" fill="#000000">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path style="fill:#507C5C;"
                                                            d="M255.999,426.059c-58.135,0-120.528-28.211-180.434-81.584 c-44.524-39.668-71.926-78.859-73.07-80.509c-3.326-4.79-3.326-11.141,0-15.931c1.144-1.65,28.546-40.84,73.072-80.509 C135.473,114.154,197.865,85.941,256,85.941c38.633,0,78.631,12.107,118.882,35.983c79.124,46.936,132.393,122.898,134.622,126.11 c4.399,6.338,2.827,15.042-3.509,19.44c-6.338,4.397-15.043,2.83-19.442-3.509c-0.508-0.732-52.166-74.261-125.924-118.013 c-35.88-21.283-71.081-32.074-104.63-32.074c-107.992,0-200.798,111.051-224.637,142.114 C55.229,287.035,148.191,398.121,256,398.121c64.189,0,122.834-39.976,160.728-73.51c5.777-5.111,14.607-4.572,19.717,1.203 c5.113,5.777,4.573,14.606-1.203,19.718C375.714,398.213,313.732,426.059,255.999,426.059z">
                                                        </path>
                                                        <path style="fill:#CFF09E;"
                                                            d="M330.079,181.919c-40.913-40.913-107.248-40.913-148.161,0s-40.913,107.248,0,148.161 s107.248,40.913,148.161,0l-74.08-74.08L330.079,181.919z">
                                                        </path>
                                                        <path style="fill:#507C5C;"
                                                            d="M255.999,374.679c-30.406,0-60.81-11.575-83.958-34.721c-46.294-46.295-46.294-121.622,0-167.917 c46.297-46.295,121.62-46.294,167.917,0c5.455,5.455,5.455,14.3,0,19.756L275.755,256l64.203,64.203 c5.455,5.455,5.455,14.3,0,19.756C316.809,363.104,286.405,374.679,255.999,374.679z M255.999,165.246 c-23.254,0-46.501,8.848-64.203,26.552c-35.401,35.401-35.401,93.005,0,128.406c32.044,32.043,82.277,35.084,117.77,9.119 l-63.445-63.445c-5.455-5.455-5.455-14.3,0-19.756l63.445-63.445C293.681,171.057,274.836,165.246,255.999,165.246z">
                                                        </path>
                                                    </g>
                                                </svg>












                                            </a>
                                        </td>

                                        <td>





                                            <a href="{{route('users.edit', $user->id)}} ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                    viewBox="0 0 32 32">
                                                    <g fill="none">
                                                        <path fill="url(#SVGU1eE1b5T)"
                                                            d="m29 20l-9 9H7.5A4.5 4.5 0 0 1 3 24.5V10l13-1l13 1z" />
                                                        <path fill="url(#SVGkFtYpesI)"
                                                            d="m29 20l-9 9H7.5A4.5 4.5 0 0 1 3 24.5V10l13-1l13 1z" />
                                                        <path fill="url(#SVGJ3aOCI1z)" fill-opacity="0.3"
                                                            d="m29 20l-9 9H7.5A4.5 4.5 0 0 1 3 24.5V10l13-1l13 1z" />
                                                        <g filter="url(#SVGzEwpPcLX)">
                                                            <path fill="url(#SVGkHpQsC8g)"
                                                                d="M10.5 18a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m1.5 3.5a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0m4 1.5a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m1.5-6.5a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0m4 1.5a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3" />
                                                        </g>
                                                        <path fill="url(#SVGR8qwqQEB)"
                                                            d="M3 7.5A4.5 4.5 0 0 1 7.5 3h17A4.5 4.5 0 0 1 29 7.5V10H3z" />
                                                        <path fill="url(#SVGuLUjtdLw)"
                                                            d="m20.539 29.47l7.61-7.544v-4.074h-4.073l-7.567 7.64l.308 3.696z" />
                                                        <path fill="url(#SVGLFchkdje)"
                                                            d="m20.539 29.47l.223-.223s-1.726-.661-2.535-1.47c-.809-.81-1.47-2.534-1.47-2.534l-.248.249a2.66 2.66 0 0 0-.686 1.206l-.79 3.051a1 1 0 0 0 1.217 1.22l3.02-.778a2.8 2.8 0 0 0 1.269-.722" />
                                                        <path fill="url(#SVGbvsSaeki)"
                                                            d="m26.937 23.14l2.211-2.214a2.88 2.88 0 0 0 .072-4.017a2.88 2.88 0 0 0-4.144-.057l-2.238 2.241z" />
                                                        <path fill="url(#SVGPCCetcDD)"
                                                            d="M24.094 17.838a5.43 5.43 0 0 0 4.106 4.038l-1.55 1.551a5.43 5.43 0 0 1-4.106-4.04z" />
                                                        <defs>
                                                            <linearGradient id="SVGU1eE1b5T" x1="20.694" x2="13.492"
                                                                y1="31.456" y2="9.925" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#b3e0ff" />
                                                                <stop offset="1" stop-color="#b3e0ff" />
                                                            </linearGradient>
                                                            <linearGradient id="SVGkFtYpesI" x1="18.786" x2="22.353"
                                                                y1="17.182" y2="33.578" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#dcf8ff" stop-opacity="0" />
                                                                <stop offset="1" stop-color="#ff6ce8"
                                                                    stop-opacity="0.7" />
                                                            </linearGradient>
                                                            <linearGradient id="SVGkHpQsC8g" x1="14.727" x2="17.137"
                                                                y1="14.077" y2="30.097" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#0078d4" />
                                                                <stop offset="1" stop-color="#0067bf" />
                                                            </linearGradient>
                                                            <linearGradient id="SVGR8qwqQEB" x1="3" x2="25.069" y1="3"
                                                                y2="-4.352" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#0094f0" />
                                                                <stop offset="1" stop-color="#2764e7" />
                                                            </linearGradient>
                                                            <linearGradient id="SVGuLUjtdLw" x1="19.861" x2="26.044"
                                                                y1="19.948" y2="26.149" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#ffa43d" />
                                                                <stop offset="1" stop-color="#fb5937" />
                                                            </linearGradient>
                                                            <linearGradient id="SVGLFchkdje" x1="14.174" x2="18.325"
                                                                y1="26.847" y2="30.975" gradientUnits="userSpaceOnUse">
                                                                <stop offset=".255" stop-color="#ffd394" />
                                                                <stop offset="1" stop-color="#ff921f" />
                                                            </linearGradient>
                                                            <linearGradient id="SVGbvsSaeki" x1="28.502" x2="25.869"
                                                                y1="17.485" y2="19.968" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#f97dbd" />
                                                                <stop offset="1" stop-color="#dd3ce2" />
                                                            </linearGradient>
                                                            <linearGradient id="SVGPCCetcDD" x1="25.469" x2="21.489"
                                                                y1="21.663" y2="19.902" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#ff921f" />
                                                                <stop offset="1" stop-color="#ffe994" />
                                                            </linearGradient>
                                                            <radialGradient id="SVGJ3aOCI1z" cx="0" cy="0" r="1"
                                                                gradientTransform="rotate(135 5.719 17.306)scale(12.0208 6.0988)"
                                                                gradientUnits="userSpaceOnUse">
                                                                <stop offset=".535" stop-color="#4a43cb" />
                                                                <stop offset=".926" stop-color="#4a43cb"
                                                                    stop-opacity="0" />
                                                            </radialGradient>
                                                            <filter id="SVGzEwpPcLX" width="16.667" height="10.667"
                                                                x="7.667" y="14.333" color-interpolation-filters="sRGB"
                                                                filterUnits="userSpaceOnUse">
                                                                <feFlood flood-opacity="0"
                                                                    result="BackgroundImageFix" />
                                                                <feColorMatrix in="SourceAlpha" result="hardAlpha"
                                                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                                                                <feOffset dy=".667" />
                                                                <feGaussianBlur stdDeviation=".667" />
                                                                <feColorMatrix
                                                                    values="0 0 0 0 0.1242 0 0 0 0 0.323337 0 0 0 0 0.7958 0 0 0 0.32 0" />
                                                                <feBlend in2="BackgroundImageFix"
                                                                    result="effect1_dropShadow_72095_10112" />
                                                                <feBlend in="SourceGraphic"
                                                                    in2="effect1_dropShadow_72095_10112"
                                                                    result="shape" />
                                                            </filter>
                                                        </defs>
                                                    </g>
                                                </svg>
                                            </a>


                                        </td>
                                        {{--
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}">



                                                Edit</a>


                                            <!-- Update SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                viewBox="0 0 32 32">
                                                <g fill="none">
                                                    <path fill="#b3e0ff"
                                                        d="m29 20l-9 9H7.5A4.5 4.5 0 0 1 3 24.5V10l13-1l13 1z" />
                                                    <path fill="#0094f0"
                                                        d="M3 7.5A4.5 4.5 0 0 1 7.5 3h17A4.5 4.5 0 0 1 29 7.5V10H3z" />
                                                </g>
                                            </svg>
                                        </td> --}}



                                        <td colspan="2">
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-transparent cursor-pointer border-0 ">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                                        viewBox="0 0 48 48">
                                                        <g fill="none" stroke-linejoin="round" stroke-width="4">
                                                            <path fill="#ff2f51" stroke="#000" d="M9 10V44H39V10H9Z" />
                                                            <path stroke="#fff" stroke-linecap="round" d="M20 20V33" />
                                                            <path stroke="#fff" stroke-linecap="round" d="M28 20V33" />
                                                            <path stroke="#000" stroke-linecap="round" d="M4 10H44" />
                                                            <path fill="#ff2f51" stroke="#000"
                                                                d="M16 10L19.289 4H28.7771L32 10H16Z" />
                                                        </g>
                                                    </svg>
                                                </button>
                                            </form>

                                        </td>





                                    </tr>
                                    @endforeach

                                </tbody>


                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /Users Table -->

</div>
@endsection
