@extends('layout.sidebar')

@section('knowledgeSopActive', 'active')

@section('content')
    {{-- Title --}}
    <div class="container">
        <h3>
            <a href="/knowledgeSop" style="text-decoration:none; color: black;">
                < {{ str_replace('_', '/', $nra) }}
            </a>
        </h3>
    </div>

    <?php
    
    // Ambil data file di dalam folderP
    // $folder = pathinfo($data->file, PATHINFO_FILENAME);
    $path = public_path('storage/masterSosialisasi/' . $nra . '/slides');
    $files = scandir($path);
    $files = array_diff($files, ['.', '..']);
    ?>

    {{-- Section --}}
    <div class="container mb-3" id="app">
        <div class="navigation">
            <button id="prev-btn" class="btn btn-secondary">Prev Page</button>
            <button id="next-btn" class="btn btn-secondary">Next Page</button>
        </div>

        <img id="gallery-image" src="{{ asset('storage') }}" alt="Gallery Image">
    </div>

    <div class="container">
        <a href="/knowledgeSop" class="btn btn-outline-secondary">Back</a>
        <a class="btn btn-outline-secondary" id="changeButton">Next</a>
    </div>

    {{-- Script --}}
    <script>
        // Images array - Update this array with your image URLs

        var path = "<?php echo asset('storage/masterSosialisasi/' . $nra . '/slides' ); ?>";
        const images = <?php echo json_encode($files); ?>;
        const combinedArray = [];

        // Loop through the images array and combine each element with the path
        for (let i = 0; i < images.length; i++) {
            combinedArray.push(path + '/' + images[i]); // Concatenate path with each image and add to combinedArray
        }

        // Log the combined array to the console
        console.log(combinedArray);

        let currentImageIndex = 0;
        const galleryImage = document.getElementById('gallery-image'); // buat ambil elementnya
        const prevButton = document.getElementById('prev-btn'); // buat buttonnya
        const nextButton = document.getElementById('next-btn'); // buat buttonnya

        // Function to show current image
        function showImage(index) {
            galleryImage.src = combinedArray[index]; // ini bakal ngirim nama filenya lewat DOM ke srcnya
            // Disable/Enable buttons based on the current image index
            prevButton.disabled = index === 0; // pake strict equality
            nextButton.disabled = index === combinedArray.length - 1; // pake strict equality
        }

        // Initial image display
        showImage(currentImageIndex);

        // Event listener for the 'Previous' button
        prevButton.addEventListener('click', function() {
            if (currentImageIndex > 0) {
                currentImageIndex--;
                showImage(currentImageIndex);
            }
        });

        // Event listener for the 'Next' button
        nextButton.addEventListener('click', function() {
            if (currentImageIndex < combinedArray.length - 1) {
                currentImageIndex++;
                showImage(currentImageIndex);
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the elements
            const imgOldElement = document.getElementById('gallery-image');
            const changeButton = document.getElementById('changeButton');

            // Add click event listener to the button
            changeButton.addEventListener('click', function () {
                // Create an image element

                const videoElement = document.createElement('video');
                videoElement.width = 800;
                videoElement.controls = true;

                const sourceElement = document.createElement('source');
                sourceElement.src = '/storage/masterSosialisasi/' + '<?php echo $nra ?>' + '/video/' + '<?php echo $nra ?>' + '.mp4';
                sourceElement.type = 'video/mp4';
                
                videoElement.appendChild(sourceElement);

                // Replace the text element with the image element
                imgOldElement.replaceWith(videoElement);
            });
        });
    </script>

@endsection
