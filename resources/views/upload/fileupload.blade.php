@extends('layouts.default', ['title' => __('Upload CSV')])
@section('content')
    <section>
        <x-general.card class="px-4 bg-white">
                <div class="flex flex-col justify-between px-4 py-4 space-y-4 border-b-2 md:space-y-0 lg:flex-row">
                    <form name="upload-csv" method="POST" action="{{ route('UploadCSV.store') }}" enctype="multipart/form-data" accept-charset="utf-8">
                        @csrf
                        <div class="flex justify-center space-x-4">
                            <label>Select a CSV file to upload</label>
                            <input type="file" class="px-4 py-2 border-2 border-gray-500 rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300" id="upload_file" name="upload_file" accept=".csv" />
                            <input type="submit" name="submit" class="px-4 py-2 border-2 border-blue-500 rounded-lg text-white bg-blue-600 hover:bg-blue-700" value="Upload"/>
                        </div>
                        <div id="progress_section" class="mt-4" style="display: none;">
                            <div class="flex items-center space-x-4">
                                <progress value="0" max="100"></progress>
                                <p id="percentage" class="flex -mt-6 font-semibold text-gray-700"></p>
                            </div>
                            <div>
                                <p class="success"></p>
                                <p class="error"></p>
                            </div>
                        </div>
                    </form>
                </div>
        </x-general.card>
        <x-general.card class="px-4 bg-white">
            <div class="mt-3">
                <table class="w-full mt-3" style="border:1px solid black;border-collapse:collapse;">
                    <thead class="bg-blue-300">
                        <th class="p-2" style="border:1px solid black;">Time</th>
                        <th class="p-2" style="border:1px solid black;">File Name</th>
                        <th class="p-2" style="border:1px solid black;">Status</th>
                    </thead>
                    <tbody class="bg-blue-100" id="uploadData">
                    </tbody>
                </table>
            </div>
        </x-general.card>
    </section>
@endsection

@push('js')

<script>
    window.uploadCsvStoreRoute = "{{ route('UploadCSV.store') }}";
    window.uploadHistoryRoute = "{{ route('upload-history') }}";
    window.csrfToken = "{{ csrf_token() }}";

    $(document).ready(function(){
        refreshUploadHistory();
    });

    function refreshUploadHistory() {
        $.get(window.uploadHistoryRoute, function(data) {
            $('#uploadData').html(data);
        });
    }

    // refresh the table every 10 seconds
    setInterval(refreshUploadHistory, 10000);
</script>

<script>
    function checkCSVStatus(uploadId) {
        setInterval(function() {
            $.ajax({
                url: `/csv-status/${uploadId}`,
                type: 'GET',
                success: function(data) {
                    if (data.status == 2) { // Assuming 2 means processed
                        alert('CSV is processed');
                        // Notify the user, e.g., using an alert or updating the DOM
                    }
                },
                error: function(error) {
                    console.error("Error checking CSV status:", error);
                }
            });
        }, 5000); // Check every 5 seconds
    }
</script>

@endpush