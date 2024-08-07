<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/682e8781ec.js" crossorigin="anonymous"></script>

<script type="importmap">
    {
        "imports": {
            "three": "https://unpkg.com/three@v0.149.0/build/three.module.js",
            "three/addons/": "https://unpkg.com/three@v0.149.0/examples/jsm/"
        }
    }
</script>

<script type="module">
    import * as THREE from 'three';
    import { MTLLoader } from 'three/addons/loaders/MTLLoader.js';
    import { OBJLoader } from 'three/addons/loaders/OBJLoader.js';
    import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 250;

    var renderer = new THREE.WebGLRenderer({ alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.getElementById('modelViewer').appendChild(renderer.domElement);

    // document.getElementsByClassName('modelViewer')[1].appendChild(renderer.domElement);
    // var modelViewers = document.getElementsByClassName('modelViewer');
    //     for (var i = 0; i < modelViewers.length; i++) {
    //         modelViewers[i].appendChild(renderer.domElement);
    //     }

    var controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.25;
    controls.screenSpacePanning = false;
    controls.maxPolarAngle = Math.PI / 2;

    function clearPreviousModel() {
        scene.children.forEach(child => {
            if (child instanceof THREE.Mesh) {
                child.geometry.dispose();
                child.material.dispose();
            }
        });
        scene.children = [];
    }

    function loadThreeJsModel(objPath, mtlPath, index) {
    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 250;

    var renderer = new THREE.WebGLRenderer({ alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);

    var controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.25;
    controls.screenSpacePanning = false;
    controls.maxPolarAngle = Math.PI / 2;

    var mtlLoader = new MTLLoader();
    mtlLoader.load(mtlPath, function (materials) {
        materials.preload();
        var objLoader = new OBJLoader();
        objLoader.setMaterials(materials);
        objLoader.load(objPath, function (object) {
            scene.add(object);
        });
    });

    var ambientLight = new THREE.AmbientLight(0x404040);
    scene.add(ambientLight);
    var directionalLight = new THREE.DirectionalLight(0xffffff);
    directionalLight.position.set(1, 1, 1).normalize();
    scene.add(directionalLight);

    function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    }

    window.addEventListener('resize', onWindowResize);

    function animate() {
        requestAnimationFrame(animate);
        controls.update();
        renderer.render(scene, camera);
    }

    animate();

    return renderer.domElement;
}








    $(document).ready(function () {
        $('#flexSwitchCheckDefault').on('change', function () {
        if ($(this).prop('checked')) {
            $('.modelViewer canvas').addClass('d-none');
            $('.modelViewer img').removeClass('d-none');
            var modelViewers = $('.modelViewer');
            modelViewers.each(function (index) {
                var objPath = $(this).find('.modelImageInfo').data('obj-path');
                var mtlPath = $(this).find('.modelImageInfo').data('mtl-path');
                if (objPath != "") {
                    var canvas = loadThreeJsModel(objPath, mtlPath, index);
                    $(this).append(canvas);
                    $(this).find('.imgSrc').addClass('d-none');
                }else{
                    $(this).find('.imgSrc').addClass('d-none');
                    $(this).find('.3d_not_found').removeClass('d-none');
                }
            });

        } else {
            $('.modelViewer canvas').remove();
            $('.modelViewer img').removeClass('d-none');
            $('.3d_not_found').addClass('d-none');
        }
    }).change();



        // $('.model-360').click(function () {
        //     var objPath = $('#Image').data('obj-path');
        //     var mtlPath = $('#Image').data('mtl-path');
        //     console.log(mtlPath);

        //     loadThreeJsModel(objPath, mtlPath);
        // });

        $('.model-info').click(function () {
            var modelStepId = $(this).data('model-step-id');
            var modelStepImage = $(this).data('model-step-image');

            $('#modelStepId').text(modelStepId);
            $('#modelStepImage').attr('src', modelStepImage);
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.slider-nav'
        });

        $('.slider-nav').slick({
            slidesToShow: 8,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            vertical: false,
            verticalSwiping: false,
            adaptiveHeight:true,
            variableHeight:false,
            arrows: false
        });
    });
</script>

 <script>
    // document.addEventListener("DOMContentLoaded", function () {
    //     // Hide loader when the content is fully loaded
    //     document.getElementById("loader").style.display = "none";
    // });

    // // Show loader while the page is loading
    // window.addEventListener("beforeunload", function () {
    //     document.getElementById("loader").style.display = "flex";
    // });
</script>
