<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script>
$(document).ready(function(){
    $("#name").autocomplete({
        source: "autocomplete.php",
        minLength: 2,
        select: function(event, ui) {
            // Obtener el valor seleccionado del campo de texto
            var selectedlabel = ui.item.label;

            // Autocompletar el campo textbox con el valor seleccionado
            setTimeout(function(){
                $("#name").val(selectedlabel);
            }, 0);
        }
    });
    
    $("#name").on("autocompleteselect", function(event, ui) {
        // Obtener el valor seleccionado del campo de texto
        var selectedValue = ui.item.value;

        // Asignar el valor seleccionado al campo textmax
        $("#description").val(selectedValue);
    });
});
</script>
<input id="name" class="full-width" />
<input id="description" class="full-width" />