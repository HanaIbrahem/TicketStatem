

function suggestionsContent(  requestFromData,  problemTypeData,solutionData)
{
    $(document).ready(function() {


        // var requestFromData = {!! json_encode($requetsFroms->toArray()) !!};
        // var problemTypeData = {!! json_encode($problemTypes->toArray()) !!};
        // var solutionData = {!! json_encode($solutions->toArray()) !!};
    
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
}

//real time validation for solution column 
$(document).ready(function() {
    $('#add-solution-form input[name="title"]').keyup(function() {
        var title = $(this).val().toLowerCase(); // Convert entered title to lowercase
        var titleExists = false;
        solutionData.forEach(function(solution) {
            var solutionTitle = solution.title.toLowerCase(); // Convert solution title to lowercase
            if (solutionTitle === title) {
                titleExists = true;
                return;
            }
        });

        if (titleExists) {
            $('#validation-messages').html('<p class="text-danger">Title already exists!</p>');
        } else {
            $('#validation-messages').html('<p class="text-success">Title does not exist!</p>');
        }
    });
});


//realtime validation for problem type table

$(document).ready(function() {
    $('#add-problem-form input[name="title"]').keyup(function() {
        var title = $(this).val().toLowerCase(); // Convert entered title to lowercase
        var titleExists = false;
        problemTypeData.forEach(function(solution) {
            var solutionTitle = solution.title.toLowerCase(); // Convert solution title to lowercase
            if (solutionTitle === title) {
                titleExists = true;
                return;
            }
        });

        if (titleExists) {
            $('#problem-validation').html('<p class="text-danger">Title already exists!</p>');
        } else {
            $('#problem-validation').html('<p class="text-success">Title does not exist!</p>');
        }
    });
    
});