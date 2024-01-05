@extends('layout.sidebar')

@section('approvalSopActive', 'active')

@section('content')
    {{-- Title --}}
    <div class="container">
        <h3>{{ $data->judul }}</h3>
    </div>

    <?php
    
    // Ambil data file di dalam folderP
    $folder = pathinfo($data->file, PATHINFO_FILENAME);
    $path = public_path('storage/approvalSop/' . $folder);
    $files = scandir($path);
    $files = array_diff($files, ['.', '..']);
    array_pop($files);
    
    ?>

    {{-- Section --}}
    <div class="container">
        <div class="navigation">
            <button id="prev-btn" class="btn btn-secondary">Previous</button>
            <button id="next-btn" class="btn btn-secondary">Next</button>
        </div>

        <img id="gallery-image" src="{{ asset('storage/approvalSop') }}/{{ $folder }}" alt="Gallery Image">
    </div>









    {{-- Script --}}
    <script>
        // Images array - Update this array with your image URLs
        
        var path = "<?php echo asset('storage/approvalSop' . '/' . $folder); ?>";
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
    
@endsection
