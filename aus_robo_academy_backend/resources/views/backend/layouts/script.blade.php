<!-- jQuery -->
<script src="{{ URL::asset('/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('/admin/dist/js/adminlte.min.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ URL::asset('/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('/admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script src="{{ URL::asset('/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::asset('/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            lengthMenu: [
                [12, 25, 50, -1],
                [12, 25, 50, 'All']
            ],
        });
    });
</script>

<script>
    $('#country').change(function() {
        let appURL = '{{ env('APP_URL') }}';
        let cid = $(this).val(); // Get the selected value

        if (!cid) {
            $('#state').empty().append($('<option>', {
                value: '',
                text: 'Please select a country'
            }));
            return;
        }

        $.get(appURL + 'state/' + cid, function(data) {
            let state = $('#state');
            state.empty(); // Clear existing options

            $.each(data, function(index, item) {
                state.append($('<option>', {
                    value: item.id,
                    text: item.name
                }));
            });
        });
    });
</script>

<script>
    $('#state').change(function() {
        let appURL = '{{ env('APP_URL') }}';
        let sid = $(this).val(); // Get the selected value
        $.get(appURL + 'city/' + sid, function(data) {
            let city = $('#city');
            city.empty(); // Clear existing options

            $.each(data, function(index, item) {
                city.append($('<option>', {
                    value: item.devision_id,
                    text: item.name
                }));
            });
        });
    });
</script>

@if (session()->has('success'))
    <script>
        $(function() {
            $(document).Toasts('create', {
                position: 'topRight',
                class: 'bg-success rounded-0 mt-2',
                title: 'Message',
                subtitle: 'AUS Robo Academy',
                body: '{{ session()->get('success') }}'
            })
        });
    </script>
@elseif (session()->has('error'))
    <script>
         $(document).Toasts('create', {
            position: 'topRight',
            class: 'bg-danger rounded-0 mt-2',
            title: 'Message',
            subtitle: 'AUS Robo Academy',
            body: '{{ session()->get('error') }}'
        })
    </script>
@endif

<script
    var apiKey = '{{ env('GOOGLE_PLACES_API') }}';
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIeALFclDSbN-09Vks2r6a-O2ReygP5xo&callback=initMap&libraries=places&v=weekly"
    defer></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script>
    /**
     * @license
     * Copyright 2019 Google LLC. All Rights Reserved.
     * SPDX-License-Identifier: Apache-2.0
     */
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: 40.749933,
                lng: -73.98633
            },
            zoom: 13,
            mapTypeControl: false,
        });
        const card = document.getElementById("pac-card");
        const input = document.getElementById("pac-input");
        const biasInputElement = document.getElementById("use-location-bias");
        const strictBoundsInputElement =
            document.getElementById("use-strict-bounds");
        const options = {
            fields: ["formatted_address", "geometry", "name"],
            strictBounds: false,
            types: ["establishment"],
        };

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

        const autocomplete = new google.maps.places.Autocomplete(
            input,
            options
        );

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo("bounds", map);

        const infowindow = new google.maps.InfoWindow();
        const infowindowContent = document.getElementById("infowindow-content");

        infowindow.setContent(infowindowContent);

        const marker = new google.maps.Marker({
            map,
            anchorPoint: new google.maps.Point(0, -29),
        });

        autocomplete.addListener("place_changed", () => {
            infowindow.close();
            marker.setVisible(false);

            const place = autocomplete.getPlace();

            if (!place.geometry || !place.geometry.location) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert(
                    "No details available for input: '" + place.name + "'"
                );
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            infowindowContent.children["place-name"].textContent = place.name;
            infowindowContent.children["place-address"].textContent =
                place.formatted_address;
            infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
            const radioButton = document.getElementById(id);

            radioButton.addEventListener("click", () => {
                autocomplete.setTypes(types);
                input.value = "";
            });
        }

        setupClickListener("changetype-all", []);
        setupClickListener("changetype-address", ["address"]);
        setupClickListener("changetype-establishment", ["establishment"]);
        setupClickListener("changetype-geocode", ["geocode"]);
        setupClickListener("changetype-cities", ["(cities)"]);
        setupClickListener("changetype-regions", ["(regions)"]);
        biasInputElement.addEventListener("change", () => {
            if (biasInputElement.checked) {
                autocomplete.bindTo("bounds", map);
            } else {
                // User wants to turn off location bias, so three things need to happen:
                // 1. Unbind from map
                // 2. Reset the bounds to whole world
                // 3. Uncheck the strict bounds checkbox UI (which also disables strict bounds)
                autocomplete.unbind("bounds");
                autocomplete.setBounds({
                    east: 180,
                    west: -180,
                    north: 90,
                    south: -90,
                });
                strictBoundsInputElement.checked = biasInputElement.checked;
            }

            input.value = "";
        });
        strictBoundsInputElement.addEventListener("change", () => {
            autocomplete.setOptions({
                strictBounds: strictBoundsInputElement.checked,
            });
            if (strictBoundsInputElement.checked) {
                biasInputElement.checked = strictBoundsInputElement.checked;
                autocomplete.bindTo("bounds", map);
            }

            input.value = "";
        });
    }

    window.initMap = initMap;
</script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script>
    $(document).ready(function () {
        $("#sortable-list").sortable({
            update: function (event, ui) {
                var order = $(this).sortable('toArray', { attribute: 'data-id' });
                console.log(order); // Check if the order array is correct
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('model.step.update.order') }}",
                    type: 'PATCH',
                    dataType: 'json',
                    encode  : true,
                    data: {
                        order: order
                    },
                    success: function (response) {
                        console.log(response.message);
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        document.addEventListener('DOMContentLoaded', function() {
            console.log('page is loading');
        });
    });
</script>

<script>
    const currentDate = new Date().toISOString().split('T')[0];
    document.getElementById('expiration_date').min = currentDate;
</script>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

