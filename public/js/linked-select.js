function ajouterClasse(limite) {

    $('select[name="classe"]').empty();
    
    $('select[name="classe"]').append('<option disabled selected>-- Choisir la classe --</option>');
    for (let index = 1; index <= limite; index++) {
        let terminaison = (index == 1) ? 'er' : 'e' ;
        $('select[name="classe"]').append('<option value="'+ index +'">' + index + terminaison + '</option>');
    }
}

$(document).ready(function() {
    
    $('select[name="section"]').on('change', function(){

        var section = $(this).val();

        if (section != 'secondaire') {
            
            $('#optionBloc').css("visibility", "hidden");

            if (section == 'maternelle') {
                ajouterClasse(3)
            }
            else {
                ajouterClasse(6)
            }
        }
        else {
            $('#optionBloc').css("visibility", "visible");
            ajouterClasse(6)
        }
    });
});