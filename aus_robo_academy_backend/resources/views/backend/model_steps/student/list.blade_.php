<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('/admin/dist/css/student.css') }}">
    <title>Start Building - AU Robo Academy</title>
</head>

<body>
    <div class="container-fluid position-fixed top-0 w-100 bg-warning bg-gradient text-dark p-3 shadow rounded-bottom-5">
        <div class="row">
            <div class="col-4 d-flex align-items-center justify-content-start">
                <img src="{{ URL::asset('/admin/dist/img/logo.png') }}" height="100" alt="AU Robo Academy Logo">
            </div>
            <div class="col-4 d-flex align-items-center justify-content-center">
                <h1 class="display-6 fw-bold text-uppercase" id="title">{{ $modelSteps[0]->title ?? null }}</h1>
            </div>
            <div class="col-4 d-flex align-items-center justify-content-end">
                <a href="#" onclick="{{ request()->segment(1) == 'student' ? 'closeWindow()' : 'goBack()' }}">
                    <i class="fas fa-3x {{ request()->segment(1) == 'student' ? 'fa-close' : 'fa-reply' }} text-danger"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row gx-5 gx-5 p-5 d-flex align-items-center justify-content-center vh-100 w-100" style="margin-top: -20px;">
        <div class="col-md-10">
            <div class="bg-dark rounded-5 shadow position-relative" style="height: 400px;">
                <input type="hidden" id="modelRouteID" value="{{ App\Models\Models::where('id', $model->id)->first()->category_id }}">
                <div class="slider-for">
                    @foreach ($modelSteps as $modelStep)
                        <div class="row imageDev">
                            <input type="hidden" id="modelID" value="{{ $modelStep->id }}">
                            <input type="hidden" id="modelImage" value="{{ url($modelStep->image) }}">

                            <div class="col-6 offset-md-3 modelViewer" id="modelViewer">
                                <input type="hidden" class="modelImageInfo" id="modelImageInfo"
                                    data-obj-path="{{ isset($modelStep->obj) ? url($modelStep->obj) : '' }}"
                                    data-mtl-path="{{ isset($modelStep->mtl) ? url($modelStep->mtl) : '' }}"
                                    data-img-path="{{ isset($modelStep->image) ? url($modelStep->image) : '' }}">

                                <img class="w-100 imgSrc" id="Image" style="height: 400px;"
                                    src="{{ isset($modelStep->image) ? url($modelStep->image) : '' }}"
                                    data-modelstep_id="{{ $modelStep->id }}"
                                    data-modeltitle="{{ $modelStep->title }}">

                                <p class="text-light 3d_not_found d-flex justify-content-center d-none" style="margin-top: 200px;">3D Image Not Availabe</p>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="bg-success-subtle shadow p-2 d-grid align-items-center justify-content-center rounded-5" style="height: 400px;">

                <div class="totalCount">
                    <span id="startSteps" class="bg-secondary fw-bold p-2 ps-5 pe-5 text-light rounded-pill">1</span>
                </div>



                <i class="fas fa-4x fa-info-circle model-info text-center" id="stepInformation" class=" btn rounded-0" data-bs-toggle="modal" data-bs-target="#info"></i>


                <div class="form-check form-switch fs-2 d-flex justify-content-center" id="360model">
                    <input class="form-check-input model-360" type="checkbox" id="flexSwitchCheckDefault">
                </div>

                <button id="showSlider" type="button" class="btn btn-success">
                    Hide Steps
                </button>

            </div>
        </div>
    </div>

    <div class="container-fluid position-fixed bottom-0 w-100 bg-info shadow text-light p-3 rounded-top-5" id="slideBar">
        <div class="row">
            <div class="col-12">
                <div class="slider-nav ">
                    @foreach ($modelSteps as $modelStep)
                        <img class="img-fluid rounded-4 m-2 slideImages " data-slider-show="show"
                            src="{{ url($modelStep->image) }}" style="height: 127px;">
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Model Step Information Modal --}}
    <div class="modal fade" id="info" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-success-subtle bg-gradient    shadow-lg">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Model Step ID: <span
                            id="modelStepId"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modelStepImage" class="img-fluid rounded" src="" alt="Model Image">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Model Step Information Modal --}}


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            showLoader();
        });
        //     setTimeout(function() {
        //     hideLoader();
        // }, 500);
        window.addEventListener("load", function() {
            hideLoader();
        });

        function showLoader() {
            document.getElementById("loader").style.display = "block";
        }

        function hideLoader() {
            document.getElementById("loader").style.display = "none";
        }
    </script>
    <script>
        $(document).ready(function() {


            $(document).on('click', '#showSlider', function(e) {
                e.preventDefault();
                if ($('.slideImages').data('slider-show') == "show") {
                    $('#showSlider').text('Show Steps');
                    $('#slideBar').addClass('d-none');
                    $('.slideImages').data('slider-show', 'hide');
                } else {
                    $('#showSlider').text('Hide Steps');
                    $('.slideImages').data('slider-show', 'show');
                    $('#slideBar').removeClass('d-none');
                    window.location.reload();
                }
            });

            $('.previous').attr('href', "{{ url('models') }}" + "/" + $('#modelRouteID').val());

            function updateModalContent(activeImage, currentSlide = null) {
                var activeImageNumber = currentSlide + 1;
                var activeImageID = activeImage.data('modelstep_id');
                var activeImageSrc = activeImage.attr('src');
                var title = activeImage.data('modeltitle');
                $('#startSteps').text(activeImageNumber + " / {{ $modelSteps->count() }}");


                $('#modelStepImage').attr('src', activeImageSrc);
                $('#title').text(title);
                $('#modelStepId').text(activeImageID);

            }


            $('.slider-for').on('afterChange', function(event, slick, currentSlide) {
                var activeImage = $(slick.$slides[currentSlide]).find('img');
                updateModalContent(activeImage, currentSlide);
            });
            var initialImage = $('.slider-for .slick-current img');
            updateModalContent(initialImage);

        });
    </script>

    <!-- Script -->
    @include('backend.layouts.student_script')


    <script>
        function closeWindow() {
            window.close();
        }

        function goBack() {
            window.history.go(-1);
        }
    </script>

</body>

</html>
