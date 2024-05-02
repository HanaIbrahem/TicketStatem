{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('dashbord/assets/fontawsom/css/all.min.css') }}">
    <link rel="icon" href="{{ asset('unnamed.png') }}">

    <title>Teammart-IT</title>
    <style>
        body {
            background-color: #052958;
            margin: 0;
            padding: 0;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            /* background-color: #333; */
            color: #fff;
            padding: 10px 20px;
            box-sizing: border-box;
            z-index: 9999;
        }

        .header .logo {
            float: left;
        }

        .header .login {
            float: right;
            margin-top: 22px;
        }
        .header .login a {
            margin: 20px;
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
            border: 2px solid #fff;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .header .login a:hover {
            background-color: #fff;
            color: #333;
        }

        /* Center the image horizontally and vertically */
        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 60px); /* Adjust header height */
            /* Adjust as needed */
        }

        /* Optional: Set max-width for the image */
        .image-container img {
            max-width: 100%;
            /* Adjust as needed */
            max-height: 100%;
            /* Adjust as needed */
            width: 40%;
        }
    </style>
</head>

<body>

    <div class="header">
     
        <div class="login">
            @if (auth()->check())
            <a  href="{{ route('dashbord.index') }}">Dashboard</a>
            @else
            <a href="{{ route('login') }}">Login</a>
            @endif
        </div>
    </div>

    <div class="image-container">
        <img src="{{ asset('logo-small.svg') }}" alt="Your Image">
    </div>

</body>

</html>


 --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestion Combobox</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .suggestionss {
            max-height: 200px;
            overflow-y: auto;
        }

        .suggestion {
            padding: 5px 10px;
            margin: 5px;
            background-color: #f5f5f5;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <form action="">
        <div class="container mt-5">
            <h1>Request from</h1>
            <input type="text" class="form-control" id="requetsfrom" autocomplete="off">

            <input type="hidden" id="requestfromDataHidden" name="requetsfrom" value="">

        
            <div id="requetsfromsugestion" class="mt-2 suggestionss"></div>
        </div>


        <div class="container mt-5">
            <h1>Problem Type</h1>
            <input type="text" class="form-control" id="problemtype" autocomplete="off">
            <input type="hidden" id="problemtypeDataHidden" name="problemtype" value="">

            <div id="probletypesugestion" class="mt-2 suggestionss"></div>
        </div>


        <div class="container mt-5">
            <h1>Solutions</h1>
            <input type="text" class="form-control" id="solution" autocomplete="off">

            <div id="solutionsugestion" class="mt-2 suggestionss"></div>
            <input type="hidden" id="solutionDataHidden" name="solution" value="">

        </div>



    </form>


    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS CDN (Optional, only if you plan to use Bootstrap features) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {


            var requestFromData = {!! json_encode($requetsFroms->toArray()) !!};
            var problemTypeData = {!! json_encode($problemTypes->toArray()) !!};
            var solutionData = {!! json_encode($solutions->toArray()) !!};

            function bindInputEvents(inputId, suggestions, suggestionsContainer, hiddenInputId) {
                $(inputId).on('input', function() {
                    var query = $(this).val().toLowerCase();
                    if (query === '') {
                        $(suggestionsContainer).empty();
                        $(hiddenInputId).val(
                        ''); // Set hidden input value to empty when search text is removed
                        return;
                    }

                    var filteredSuggestions = suggestions.filter(function(item) {
                        return item.title.toLowerCase().includes(query);
                    });

                    displaySuggestions(filteredSuggestions, suggestionsContainer, hiddenInputId);
                });

                // Event delegation to handle clicks on suggestions
                $(suggestionsContainer).on('click', '.suggestion', function() {
                    var selectedSuggestion = $(this).text();
                    var selectedId = suggestions.find(function(item) {
                        return item.title === selectedSuggestion;
                    }).id;
                    $(hiddenInputId).val(selectedId);
                    $(inputId).val(selectedSuggestion); // Set input value to selected suggestion text
                    $(suggestionsContainer).empty(); // Clear suggestions after selection
                });
            }

            function displaySuggestions(suggestions, suggestionsContainer, hiddenInputId) {
                var suggestionsList = $(suggestionsContainer);
                suggestionsList.empty();
                if (suggestions.length > 0) {
                    $.each(suggestions, function(index, suggestion) {
                        suggestionsList.append('<div class="suggestion">' + suggestion.title + '</div>');
                    });
                } else {
                    suggestionsList.append('<div>No suggestions found</div>');
                    $(hiddenInputId).val(''); // Set hidden input value to empty when no suggestions are found
                }
            }

            bindInputEvents('#requetsfrom', requestFromData, '#requetsfromsugestion', '#requestfromDataHidden');
            bindInputEvents('#problemtype', problemTypeData, '#probletypesugestion', '#problemtypeDataHidden');
            bindInputEvents('#solution', solutionData, '#solutionsugestion', '#solutionDataHidden');
        });
    </script>

</body>

</html>
